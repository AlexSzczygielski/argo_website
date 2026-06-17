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