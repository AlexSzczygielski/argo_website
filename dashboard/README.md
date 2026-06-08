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

---

## User Roles

| Role | `admin` column | Can do |
|------|---------------|--------|
| Member | `0` | Create drafts, submit for review, edit own posts |
| Admin | `1` | All of the above + approve/reject pending posts, delete posts |

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

## Gallery Uploads

- Images upload immediately to `storage/images/` regardless of post status
- Gallery rows are cascade-deleted when a post is deleted
- ~~Orphaned image files must be cleaned up manually if a post is rejected~~
- ~~Limits: 10MB per file, image types only (jpg, jpeg, png, webp, gif)~~

---

## Security

- Passwords hashed with bcrypt via `password_hash()`
- All DB queries use PDO prepared statements
- Status filter uses whitelist validation — no direct interpolation
- ~~Upload directory has PHP execution disabled via `.htaccess`~~
- Session guard on every protected page via `auth_check.php`