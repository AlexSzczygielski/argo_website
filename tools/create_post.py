import os
import re
import tempfile
import subprocess
import sys
from datetime import date
import tkinter as tk
from tkinter import filedialog
import requests

POSTS_DATA_PATH = "blog/posts_data.php"
POSTS_DIR = "blog/posts"
IMAGES_DIR = "storage/images"

MAX_FILE_SIZE_MB = 1
MAX_FILE_SIZE_BYTES = MAX_FILE_SIZE_MB * 1024 * 1024


# ----------------------------
# Exceptions
# ----------------------------

class ImageTooLargeException(Exception):
    pass


# ----------------------------
# Helpers
# ----------------------------

def slugify(title: str) -> str:
    slug = title.lower()
    slug = re.sub(r"[^\w\s-]", "", slug)
    slug = re.sub(r"\s+", "_", slug)
    return slug


def extract_first_sentence(text: str) -> str:
    text = text.strip().replace("\n", " ")
    sentences = re.split(r'(?<=[.!?])\s', text)
    return sentences[0].strip() if sentences else text[:120]


def open_editor(placeholder: str = "") -> str:
    with tempfile.NamedTemporaryFile(
        mode="w", suffix=".txt", delete=False, encoding="utf-8"
    ) as tmp:
        tmp.write(placeholder)
        tmp_path = tmp.name

    if sys.platform == "win32":
        os.startfile(tmp_path)
        input("\nEditor opened. Press Enter when you're done editing and have saved the file...")
    else:
        editor = os.environ.get("EDITOR", "nano")
        subprocess.call([editor, tmp_path])

    with open(tmp_path, encoding="utf-8") as f:
        content = f.read()

    os.unlink(tmp_path)

    # Strip placeholder lines
    lines = content.splitlines()
    lines = [l for l in lines if l.strip() not in (
        "Write your post here.",
        "Separate paragraphs with a blank line."
    )]
    return "\n".join(lines).strip()


def paragraphs_to_html(text: str) -> str:
    """Convert plain text paragraphs (separated by blank lines) to <p> tags."""
    blocks = re.split(r'\n\s*\n', text.strip())
    return "\n\n".join(f"    <p>\n        {block.strip()}\n    </p>" for block in blocks if block.strip())


# ----------------------------
# File pickers
# ----------------------------

def get_image_path():
    root = tk.Tk()
    root.withdraw()
    return filedialog.askopenfilename(
        title="Select cover image",
        initialdir=IMAGES_DIR,
        filetypes=[("Image files", "*.jpg *.jpeg *.png *.webp")]
    )


def get_image_paths():
    root = tk.Tk()
    root.withdraw()
    return filedialog.askopenfilenames(
        title="Select extra images",
        initialdir=IMAGES_DIR,
        filetypes=[("Image files", "*.jpg *.jpeg *.png *.webp")]
    )


# ----------------------------
# Validation
# ----------------------------

def validate_image_size(path: str):
    size_mb = os.path.getsize(path) / (1024 * 1024)
    print(f"[INFO] {os.path.basename(path)} = {size_mb:.2f} MB")
    if size_mb > MAX_FILE_SIZE_MB:
        raise ImageTooLargeException(
            f"{path} too large ({size_mb:.2f} MB). Max allowed is {MAX_FILE_SIZE_MB} MB."
        )


def to_rel(path: str) -> str:
    return os.path.relpath(path, os.getcwd()).replace("\\", "/")


# ----------------------------
# PHP post file builder
# ----------------------------

def build_post_php(content_html: str, author_line: str, gallery_array: list, gallery_dir: str, results_html: str) -> str:
    gallery_items = "\n".join(f'    "{os.path.basename(img)}",' for img in gallery_array)

    php = f"""<?php
$gallery = [
{gallery_items}
];
?>

<div class="blog-post-content">

{content_html}

{author_line}
{results_html}
</div>

<!-- GALERIA -->
<div class="post-gallery mt-5">
    <div class="row g-3">

        <?php foreach ($gallery as $index => $image): ?>
            <div class="col-6">
                <a
                    href="#"
                    class="gallery-item"
                    onclick="openGallery(<?= $index ?>); return false;"
                >
                    <img
                        src="{gallery_dir}/<?= $image ?>"
                        alt="Studencki Klub Regatowy ARGO AGH Kraków - zdjęcie z regat"
                        class="img-fluid rounded shadow-sm gallery-image"
                        loading="lazy"
                    >
                </a>
            </div>
        <?php endforeach; ?>

    </div>
</div>

<!-- SINGLE GALLERY MODAL -->
<div class="modal fade" id="galleryModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content bg-transparent border-0">

            <div class="modal-header border-0 justify-content-end">
                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body text-center p-0 position-relative d-flex justify-content-center align-items-center">

                <!-- LEFT BUTTON -->
                <button type="button"
                        class="btn btn-dark modal-nav-btn modal-prev"
                        onclick="prevImage()">
                    ‹
                </button>

                <img id="galleryModalImage"
                    src=""
                    class="img-fluid rounded shadow"
                    alt="gallery image">

                <!-- RIGHT BUTTON -->
                <button type="button"
                        class="btn btn-dark modal-nav-btn modal-next"
                        onclick="nextImage()">
                    ›
                </button>

            </div>

        </div>
    </div>
</div>

<script>
const galleryImages = [
<?php foreach ($gallery as $image): ?>
    "<?= "{gallery_dir}" . '/' . $image ?>",
<?php endforeach; ?>
];

let currentIndex = 0;

function openGallery(index) {{
    currentIndex = index;
    document.getElementById('galleryModalImage').src = galleryImages[currentIndex];

    const modal = new bootstrap.Modal(document.getElementById('galleryModal'));
    modal.show();
}}

function nextImage() {{
    currentIndex = (currentIndex + 1) % galleryImages.length;
    document.getElementById('galleryModalImage').src = galleryImages[currentIndex];
}}

function prevImage() {{
    currentIndex = (currentIndex - 1 + galleryImages.length) % galleryImages.length;
    document.getElementById('galleryModalImage').src = galleryImages[currentIndex];
}}
</script>
"""
    return php


# ----------------------------
# File operations
# ----------------------------

def create_post_file(filename, content):
    path = os.path.join(POSTS_DIR, filename)
    with open(path, "w", encoding="utf-8") as f:
        f.write(content)
    print(f"[OK] Created {path}")


def update_posts_file(entry: dict):
    with open(POSTS_DATA_PATH, "r", encoding="utf-8") as f:
        data = f.read()

    pos = data.rfind("];")

    php_block = f"""
    [
        "id" => "{entry['id']}",
        "title" => "{entry['title']}",
        "excerpt" => "{entry['excerpt']}",
        "image" => "{entry['image']}",
        "content" => "{entry['content']}",
"""
    if entry.get("author"):
        php_block += f'        "author" => "{entry["author"]}",\n'

    php_block += f'        "date" => "{entry["date"]}"\n    ],\n'

    updated = data[:pos] + php_block + data[pos:]

    with open(POSTS_DATA_PATH, "w", encoding="utf-8") as f:
        f.write(updated)

    print("[OK] posts_data.php updated")


def check_duplicates(slug, title):
    with open(POSTS_DATA_PATH, "r", encoding="utf-8") as f:
        data = f.read()

    if f'"id" => "{slug}"' in data:
        raise Exception("Duplicate post ID")

    if f'"title" => "{title}"' in data:
        print("[WARN] Duplicate title")

# ------ UPWIND FETCHING ----
import requests
from bs4 import BeautifulSoup
from urllib.parse import urljoin

import requests


def extract_slug(url: str) -> str:
    return url.rstrip("/").split("/regatta/")[-1]


def get_leaderboards(slug: str) -> list:
    url = f"https://api.upwind24.pl/v1/regattas/{slug}/leaderboards"
    r = requests.get(url)
    r.raise_for_status()
    return r.json().get("data", [])


def build_leaderboard_urls(slug: str, leaderboards: list):
    base = f"https://api.upwind24.pl/v1/regattas/{slug}/leaderboards"

    return [
        {
            "name": lb.get("name"),
            "url": f"{base}/{lb.get('id')}"
        }
        for lb in leaderboards
    ]


def resolve_upwind24(regatta_url: str):
    slug = extract_slug(regatta_url)

    print(f"[+] slug: {slug}")

    leaderboards = get_leaderboards(slug)

    print(f"[+] found leaderboards: {len(leaderboards)}")

    return build_leaderboard_urls(slug, leaderboards)

def build_upwind_html(api_url: str, keyword: str = "agh", post_number: int = 0, class_label: str = ""):
    """
    Build a styled HTML+JS block for an Upwind24 regatta leaderboard.
    """

    label_html = ""
    if class_label:
        label_html = f'<div class="argo-class-label"><i class="ti ti-sailboat" aria-hidden="true"></i> {class_label}</div>'

    php = f"""
<div class="argo-table-wrap">
  {label_html}
  <table class="argo-table" id="argo-tbl-{post_number}">
    <thead>
      <tr>
        <th>#</th>
        <th>Nr żagla</th>
        <th>Załoga</th>
        <th>Klub</th>
      </tr>
    </thead>
    <tbody>
      <tr class="loading-row"><td colspan="4">Ładowanie wyników…</td></tr>
    </tbody>
  </table>
</div>

<script>
(() => {{
    const tableId = "argo-tbl-{post_number}";
    const url     = "{api_url}";
    const KEYWORD = "{keyword}".toLowerCase();

    function placeBadge(n) {{
        const cls = n === 1 ? "place-1" : n === 2 ? "place-2" : n === 3 ? "place-3" : "place-other";
        return `<span class="place-badge ${{cls}}">${{n}}</span>`;
    }}

    function renderTable(data) {{
        const tbody = document.querySelector("#" + tableId + " tbody");
        if (!tbody) return;

        tbody.innerHTML = data.map(item => {{

            const boat = item.boat || {{}};
            const helm = boat.helmsman || {{}};
            const crew = boat.crew || [];
            const place = item.overallPlace ?? "";

            const helmName = `${{helm.firstName ?? ""}} ${{helm.lastName ?? ""}}`.trim();

            const crewNames = crew
                .map(c => `${{c.firstName ?? ""}} ${{c.lastName ?? ""}}`.trim())
                .filter(Boolean);

            const allPeople = [helmName, ...crewNames].filter(Boolean).join(", ");

            return `<tr>
                <td>${{place}}</td>
                <td><span class="sail-no">${{boat.sailNumber ?? ""}}</span></td>
                <td>${{allPeople}}</td>
                <td>${{helm.sailingClub?.fullName ?? ""}}</td>
            </tr>`;
        }}).join("");
    }}

    function renderEmpty() {{
        const tbody = document.querySelector("#" + tableId + " tbody");
        if (!tbody) return;
        tbody.innerHTML = `<tr class="empty-row"><td colspan="4">Brak wyników dla: <strong>{keyword}</strong></td></tr>`;
    }}

    function renderError() {{
        const tbody = document.querySelector("#" + tableId + " tbody");
        if (tbody) tbody.innerHTML = `<tr class="error-row"><td colspan="4">Błąd ładowania wyników.</td></tr>`;
    }}

    function load() {{
        fetch(url)
            .then(res => res.json())
            .then(json => {{
                const results  = json?.data?.results ?? [];
                const filtered = results.filter(item => {{
                    const boat = item.boat || {{}};
                    const helm = boat.helmsman || {{}};
                    const club = helm.sailingClub || {{}};

                    return [boat.name, boat.sailNumber, helm.firstName, helm.lastName, club.fullName]
                        .some(v => (v || "").toLowerCase().includes(KEYWORD));
                }});

                filtered.length === 0 ? renderEmpty() : renderTable(filtered);
            }})
            .catch(err => {{
                console.error("API error:", err);
                renderError();
            }});
    }}

    if (document.readyState === "loading") {{
        document.addEventListener("DOMContentLoaded", load);
    }} else {{
        load();
    }}
}})();
</script>
"""
    return php

# ----------------------------
# MAIN
# ----------------------------

def main():
    print("=== BLOG POST GENERATOR ===")

    # --- COVER IMAGE ---
    cover = get_image_path()
    if not cover:
        cover = "storage/images/placeholder.jpg"
    else:
        validate_image_size(cover)
        cover = to_rel(cover)

    # --- EXTRA IMAGES (gallery) ---
    gallery_paths = []
    gallery_dir = ""

    if input("\nAdd gallery images? (y/n): ").lower() == "y":
        imgs = get_image_paths()
        for i in imgs:
            validate_image_size(i)
            gallery_paths.append(i)

        if gallery_paths:
            gallery_dir = os.path.dirname(to_rel(gallery_paths[0])).replace("\\", "/")

    # --- TITLE & AUTHOR ---
    title = input("\nTitle: ").strip()
    author = input("Author (optional): ").strip()

    slug = slugify(title)
    filename = f"{slug}.php"

    check_duplicates(slug, title)

    # --- CONTENT ---
    print("\nOpening editor for post content (separate paragraphs with a blank line)...")
    raw_content = open_editor("Write your post here.\nSeparate paragraphs with a blank line.\n\n")
    content_html = paragraphs_to_html(raw_content)

    # --- RESULTS ---
    results_html = ""

    if input("\nAdd results section? (y/n): ").lower() == "y":
        print("Fetching Upwind results...")

        regatta_url = input("Regatta URL (Upwind24): ").strip()

        # 1. slug_upwind
        slug_upwind = extract_slug(regatta_url)
        print(f"[+] Extracted slug_upwind: {slug_upwind}")

        # 2. leaderboards
        leaderboards = get_leaderboards(slug_upwind)
        print(f"[+] Found {len(leaderboards)} leaderboards")

        # 3. build API URLs
        leaderboard_urls = build_leaderboard_urls(slug_upwind, leaderboards)

        print("\n--- AVAILABLE LEADERBOARDS ---")
        for i, lb in enumerate(leaderboard_urls):
            print(f"[{i}] {lb['name']} → {lb['url']}")

        results_html = ""

        print("\n--- USING LEADERBOARDS ---")

        # 4. loop through ALL leaderboards
        for i, lb in enumerate(leaderboard_urls):

            print(f"[+] Using leaderboard: {lb['name']}")
            print(f"    URL: {lb['url']}")

            api_url = lb["url"]

            results_html += f"<h3 class='mt-4'>{lb['name']}</h3>\n"

            results_html += build_upwind_html(
                api_url,
                keyword="agh",
                post_number=i,
            )

        # 5 Add Pelne wyniki after the last table
        results_html+=f"""
        <a href="{regatta_url}" target="_blank" class="btn btn-outline-secondary mt-3 d-inline-block">
            Pełne wyniki na stronie Upwind24 ↗
        </a>
        """
        

    # --- AUTHOR LINE ---
    author_line = """    <div class="mt-5 text-muted" style="font-style: italic; font-size: 0.9rem;">
        AUTOR: <?= htmlspecialchars($post['author'] ?? 'ARGO') ?>
    </div>"""

    # --- BUILD PHP ---
    post_php = build_post_php(
        content_html=content_html,
        author_line=author_line,
        gallery_array=gallery_paths,
        gallery_dir=gallery_dir,
        results_html=results_html
    )

    create_post_file(filename, post_php)

    # --- UPDATE INDEX ---
    first_paragraph = re.sub(r'<[^>]+>', '', content_html).strip()

    post = {
        "id": slug,
        "title": title,
        "excerpt": extract_first_sentence(first_paragraph),
        "image": cover,
        "content": f"blog/posts/{filename}",
        "author": author if author else None,
        "date": str(date.today())
    }

    update_posts_file(post)

    print("\n[DONE] Post created successfully!")


if __name__ == "__main__":
    try:
        main()
    except ImageTooLargeException as e:
        print(f"[ERROR] {e}")
        print("[ABORTED] Nothing saved.")
    except Exception as e:
        print(f"[ERROR] {e}")