# Tools (Internal)

This folder contains internal helper scripts used for maintaining and managing the SKR Argo AGH website.

These tools are **not part of the deployed website** and are excluded from production deployment via GitHub Actions.

---

## create_post.py

A local Python script used to quickly create new blog posts.

### What it does:
1. Prompts for:
   - title
   - author
   - post content
   - image (via file picker)
2. Automatically:
   - generates a slug (post ID)
   - creates a new PHP post file
   - extracts excerpt from first sentence
   - updates `blog/posts_data.php`

---

## Important

- This script is meant for **local use only**
- It should NOT be deployed to the server
- It is excluded from deployment in `.github/workflows/deploy.yml`
- It requires Python and tkinter (for file selection dialog)

> Creator is responsible to check if generated post and changes to the code are OK and working, before committing to the repo.

---

## Usage

```bash
cd argo_website
```
```bash
python3 tools/create_post.py
```

## Purpose

These tools exist to simplify content management without needing a full CMS.