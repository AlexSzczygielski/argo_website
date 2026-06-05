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