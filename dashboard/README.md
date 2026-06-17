# Dashboard Documentation

Password-protected CMS panel for managing blog posts. Accessible at `/dashboard/`.

---

## Access

- URL: `/dashboard/login.php`
- Authentication: email + bcrypt password stored in `users` DB table
- Sessions expire after 24 minutes of inactivity (PHP default)

---

## Files

| File | Purpose |
|------|---------|
| `login.php` | Login page with frosted glass UI |
| `logout.php` | Destroys session, redirects to `/` |
| `auth_check.php` | Session guard — include at top of every protected page |
| `session_bootstrap.php` | Sets session cookie flags (`secure`/`httponly`/`samesite`) and calls `session_start()` — required by every entry point that uses sessions |
| `csrf.php` | CSRF token helpers — `csrf_field()` for forms, `csrf_verify()` in POST handlers |
| `sanitiser.php` | HTMLPurifier wrapper — `sanitise_post_html()` for Quill content |
| `panel.php` | Main dashboard — paginated post list with status filter |
| `post_form.php` | Add/edit post form with Quill editor and live iframe preview |
| `preview.php` | Preview endpoint — renders post via `layout/post_content.php` |
| `approve_post.php` | Sets post status to `published` (admin only) |
| `delete_post.php` | Deletes post and cascades gallery rows (admin only) |
| `upload_gallery.php` | Handles gallery image uploads — validates, resizes, stores to `storage/images/YYYY/slug/` |
| `delete_gallery_image.php` | Deletes a gallery image from disk and DB — post owner or admin only |
| `set_cover.php` | Sets `cover_image` on a post by selecting from existing gallery images |

---

## User Roles

| Role | `admin` column | Can do |
|------|---------------|--------|
| Member | `0` | Create drafts, submit for review, edit own posts, upload/delete own gallery images |
| Admin | `1` | All of the above + approve/reject pending posts, delete any post or gallery image |

Manage users manually via phpMyAdmin — user table is excluded from automated DB dumps.

---

## Account Provisioning

Accounts are created manually by an admin via phpMyAdmin. There is **no self-serve password change** by design.

**Flow:**
1. Admin generates a strong random password (16+ chars).
2. Admin bcrypts it: `php -r "echo password_hash('<password>', PASSWORD_BCRYPT) . PHP_EOL;"`.
3. Admin runs `INSERT INTO users (name, surname, email, password, admin) VALUES (...)` with the bcrypt hash.
4. Admin emails the plaintext password to the new member.
5. Member logs in with that password and continues to use it.

**Forgotten password:** member retrieves it from their email. If email access is also lost, admin generates and inserts a new password.

**Deletion request (RODO art. 17):** when a member asks to be removed:
1. `DELETE FROM users WHERE email = '<email>';` via phpMyAdmin.
2. Decide on posts authored by them — `UPDATE posts SET author = 'ARGO' WHERE author = '<their name>';` is the usual call (keep content, anonymise authorship). The posts themselves are club content, not personal data.
3. Delete any gallery directories owned only by them via SFTP if applicable.

See [`prywatnosc.php`](../prywatnosc.php) §8 — this is the procedure that backs the rights advertised there.

**Rationale.** This is the deliberate alternative to the usual "user picks their own password + change-password page" pattern. Two reasons:

- **Prevents weak passwords.** A user-chosen `user` or `password123` is crackable in seconds regardless of bcrypt — bcrypt only protects against brute-force when the password itself has entropy. Admin-set strong passwords keep that guarantee.
- **Eliminates credential cross-contamination.** If a member reused their banking password on Argo, a DB compromise could expose it across other services. Admin-set passwords guarantee no overlap with the member's other accounts.

The trade-off accepted: passwords live in members' inboxes indefinitely. If a member's email is compromised, their Argo password is exposed alongside everything else in that inbox. This is the same exposure model as every "password reset link" email used by major sites, so the risk is conventional, not elevated.

---

## Post Workflow

```
Draft → Pending → Published
  ↑         ↓
  └─ reject ─┘
```

1. Member writes post in `post_form.php`
2. Clicks "Zapisz szkic" → saved as `draft`
3. Clicks "Wyślij do zatwierdzenia" → status changes to `pending`
4. Admin sees pending badge in `panel.php`
5. Admin clicks "Zatwierdź" → status changes to `published`, post visible on blog
6. Admin can delete at any time

---

## Gallery & Cover Image Workflow

1. Post must be saved (has an ID) before images can be uploaded
2. Upload images via the gallery form in `post_form.php` — accepts jpg, jpeg, png, webp, gif
3. Images are resized to max 1920px and converted to JPEG on upload
4. Files are stored at `storage/images/YYYY/post-title-slug/`
5. Select a cover image by clicking "Ustaw okładkę" on any gallery thumbnail
6. Gallery images can be deleted individually — owner or admin only
7. Deleting a post cascades and removes all gallery DB rows (files remain on disk)

---

## Gallery Uploads

- 5MB per file limit (server allows up to 30MB — limit is intentional)
- Accepted formats: jpg, jpeg, png, webp, gif — validated by MIME type, not just extension
- All formats converted to JPEG on save, resized to max 1920px
- Uploaded immediately regardless of post status — orphaned files cleaned up manually if post rejected
- Upload directory: `storage/images/YYYY/slug/`

---

## Security

- Passwords hashed with bcrypt via `password_hash()`
- All DB queries use PDO prepared statements
- Status filter uses whitelist validation — no direct interpolation
- Upload MIME type validated via `finfo` — browser-supplied `Content-Type` ignored
- Path traversal protection on `delete_gallery_image.php` via `realpath()` + base path check
- Path traversal protection on `set_cover.php` via `storage/images/` prefix check
- Gallery delete checks post ownership — members can only delete their own images
- Session guard on every protected page via `auth_check.php`
- **CSRF tokens** on every state-changing form — helper in `csrf.php` (`csrf_field()` / `csrf_verify()`), one token per session, verified in every POST handler
- **Session regenerated on login** (`session_regenerate_id(true)` + CSRF token rotation in `login.php`) — defeats session fixation
- **Stored-XSS protection on post content** — Quill HTML runs through HTMLPurifier (`sanitiser.php`, library vendored at `plugins/htmlpurifier/`) on both save and preview. Strips `<script>`, event handlers, `javascript:`/`data:` URLs, iframes; preserves Quill's `ql-*` classes. Payload assertions in `tools/test_sanitiser.php`.
- **Session cookie flags** (`session_bootstrap.php`) — `Secure` (env-pinned via `APP_ENV`, so dev over plain HTTP still works), `HttpOnly` (JS can't read PHPSESSID), `SameSite=Lax` (browser blocks cookie on cross-site POSTs — second layer alongside CSRF tokens).
- **Upload directory hardening** (`storage/.htaccess`) — Apache refuses to serve `.php`/`.phtml`/`.phar`/`.pl`/`.py`/`.cgi`/`.sh`/etc. under `storage/`. If a malicious file ever bypasses the MIME check in `upload_gallery.php`, it can't be executed by hitting its URL. (Originally also `php_flag engine off` for belt-and-braces, removed because AGH's `AllowOverride` doesn't permit `Options`.)
- **Login rate-limit** (`login.php`) — every failed login path (bad email, bad password, DB error) sleeps 2 s before responding. Reduces brute-force throughput by ~100×; no DB state, no per-IP tracking, no timing oracle on which field was wrong.