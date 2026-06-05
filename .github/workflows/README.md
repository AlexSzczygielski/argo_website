# GitHub Actions Workflows

## `deploy_website.yml`
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

For setup and key rotation instructions see the main [README.md](../../README.md).

---

## `sync_vps.yml`
Manually triggered workflow that pulls the current state of the VPS into a PR for review. Used by the CMS to get new blog posts into the repository without giving the CMS direct git access.

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