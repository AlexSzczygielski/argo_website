# Database Backups

This directory contains automated SQL dumps of the `argo` database.

---

## Files

| File | Purpose |
|------|---------|
| `data.sql` | Latest full DB dump — updated automatically by `dump_db.yaml` workflow |

---

## How it works

The `dump_db.yaml` GitHub Actions workflow runs:
- Manually via **Actions → Argo - CMS DB backup/synchronization → Run workflow**
- Automatically every Sunday at 2am via `full_sync.yaml`

It connects to `mysql.agh.edu.pl` over AGH VPN, dumps the `argo` database excluding the `users` table, and opens a PR with the updated `data.sql`.

---

## Excluded tables

| Table | Reason |
|-------|--------|
| `users` | Contains hashed passwords — excluded for security |

---

## Restoring from backup

1. Log into [phpMyAdmin](https://mysql.agh.edu.pl/phpmyadmin)
2. Select the `argo` database
3. Go to the **Import** tab
4. Upload `data.sql` and execute

Or via command line (requires AGH VPN):

```bash
mysql -h mysql.agh.edu.pl -u argo -p argo < db_backups/data.sql
```

---

## New VPS setup

To recreate the full DB from scratch:

1. Run `db/schema.sql` to create tables
2. Run `db_backups/data.sql` to restore data
3. Add users manually via phpMyAdmin