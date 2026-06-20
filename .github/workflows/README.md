# GitHub Actions Workflows

TODO:
- [ ] fix the db_psswd.php issue
## `deploy_website.yaml`
Automatically deploys the website to AGH VPS on every push to `main`.

### Requirements
| Secret | Description |
|--------|-------------|
| `OVPN_CONFIG` | AGH VPN certificate (renewed annually via [panel.agh.edu.pl](https://panel.agh.edu.pl)) |
| `ARGO_DEPLOY_KEY_PRIVATE` | SSH private key for `argo@web.agh.edu.pl` |

### How it works
1. Connects to AGH internal network via OpenVPN
2. Loads SSH deploy key onto the runner
3. Syncs repository contents to `public_html/` via rsync over SSH
   - Excludes: `.git`, `.github`, `tools/`, `db_backups/`, `storage/cache/`, `storage/images/2*`, `*.ovpn`, `*.md`

**Why `storage/images/2*` is excluded:** user uploads land under `storage/images/YYYY/<slug>/` (see `dashboard/upload_gallery.php`). Treating those year-prefixed directories as VPS-owned prevents `rsync --delete` from wiping photos that members uploaded after the last reverse sync into the repo. Site assets directly under `storage/images/` (logos, `landing_page.jpeg`, `dla_czlonkow/`) still deploy normally because they don't start with `2`.

**Why `storage/cache/` is excluded:** HTMLPurifier writes its definition cache there at runtime; the directory is owned by the VPS and should persist across deploys.

### Skipping no-op deploys
The trigger uses `paths-ignore` to skip pushes that only touch paths the rsync wouldn't push anyway (`storage/images/2*/**`, `db_backups/**`, `tools/**`, `**/*.md`, `.github/**`). This means merging a CMS sync PR — which only touches `storage/images/YYYY/<slug>/` or `db_backups/data.sql` — does not trigger a deploy. Mixed PRs (e.g. PHP edits + new blog images) still deploy correctly.

Keep this list in sync with the rsync `--exclude` flags in the deploy step. If you start pushing a path the rsync excludes, you'll waste a VPN session on a no-op deploy; if you start excluding a path the rsync pushes, real changes will silently fail to deploy.

For setup and key rotation instructions see the main [README.md](../../README.md).

---

## `sync_files_vps.yaml`
Manually triggered (or called by `full_sync.yaml`) — pulls the current state of `public_html/` from the VPS into a PR for review. Used by the CMS to get new blog posts into the repository without giving the CMS direct git access.

### Requirements
| Secret | Description |
|--------|-------------|
| `OVPN_CONFIG` | AGH VPN certificate (shared with deploy workflow) |
| `ARGO_DEPLOY_KEY_PRIVATE` | SSH private key for `argo@web.agh.edu.pl` (shared with deploy workflow) |

### How it works
1. Connects to AGH internal network via OpenVPN
2. Loads SSH deploy key onto the runner
3. Rsyncs `public_html/` from VPS into the repo checkout
4. If anything changed, creates a new branch `cms/sync-TIMESTAMP`
5. Commits the diff and opens a PR targeting `main`

### Triggering
Go to **Actions → Argo - CMS automated post generation file synchronization → Run workflow**.

### Security model
- The workflow can only push to new branches, never directly to `main`
- Every change must be reviewed and manually merged via PR
- `GITHUB_TOKEN` is scoped to this repository only
- Even if the CMS is compromised, nothing reaches production without a PR merge

### Repository settings required
Under **Settings → Actions → General → Workflow permissions**:
- Read and write permissions ✅
- Allow GitHub Actions to create and approve pull requests ✅

---

## `dump_db.yaml`
Manually triggered (or called by `full_sync.yaml`) — dumps the full `argo` MySQL database and opens a PR with the updated dump.

**Excluded tables:**
- `users` — prevents credential exposure in version control
- `activity_log` — audit trail isn't needed in backups and grows unbounded; references to user_ids would also require scrubbing on user deletion if committed to PRs

### Requirements
| Secret | Description |
|--------|-------------|
| `OVPN_CONFIG` | AGH VPN certificate (shared with deploy workflow) |
| `ARGO_DEPLOY_KEY_PRIVATE` | SSH private key for `argo@web.agh.edu.pl` (shared with deploy workflow) |
| `DB_PASS` | MySQL password for `argo@mysql.agh.edu.pl` |

### How it works
1. Connects to AGH internal network via OpenVPN
2. Dumps all tables from the `argo` database into `db_backups/data.sql`
3. If the dump changed, creates a new branch `cms/sync-TIMESTAMP`
4. Commits the dump and opens a PR targeting `main`

---

## `full_sync.yaml`
Runs `sync_files_vps.yaml` and `dump_db.yaml` in parallel. Triggered manually or automatically every Sunday at 2am.

---

## `lint.yaml`
Runs `php -l` (syntax check) on every PHP file in the repo. Triggered on PRs targeting `main` and on pushes to `main`.

### How it works
1. Checks out the repo
2. Installs PHP via [`shivammathur/setup-php`](https://github.com/shivammathur/setup-php), pinned to the AGH VPS version (currently 8.2)
3. Runs `php -l` on every `.php` file, excluding `tools/` and `storage/cache/`, parallelized 4-way to match the runner's vCPU count

### What it catches
Syntax errors only — missing semicolons, unbalanced braces, typos in keywords. It does not catch undefined variables, missing function calls, or type mismatches; for that, a static analyzer like PHPStan or Psalm would be the next step.

### Why this matters here
`deploy_website.yaml` auto-deploys every push to `main` straight to production. Without a syntax gate, a typo in a `.php` file goes live immediately. Lint runs in seconds and catches the cheap-to-prevent class of breakage before it ships.

### Keeping the PHP version in sync
The pinned `php-version` should match the AGH VPS. 

---

## Branch protection

`main` is protected via the `protect-main` ruleset (Settings → Rules → Rulesets). This is what enforces the security guarantees documented under `sync_files_vps.yaml`:

- **Require a pull request before merging** — no direct pushes to `main`, so the CMS sync workflows (and any future automation) must go through PR review
- **Block force pushes** — deploy history on `main` cannot be rewritten
- **Restrict deletions** — `main` cannot be deleted

The repository admin is on the bypass list for emergency direct pushes. Do not remove protection without understanding that `deploy_website.yaml` auto-deploys every push to `main` straight to production.
