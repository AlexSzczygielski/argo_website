# GitHub Actions Workflows

TODO:
- [ ] add file synchro before new push
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
   - Excludes: `.git`, `.github`, `tools/`, `db_backups/`, `*.ovpn`, `*.md`

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

**The `users` table is excluded from the dump (--ignore-table=argo.users) to prevent credential exposure in version control.**

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
