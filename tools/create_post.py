import os
import re
import tempfile
import subprocess
import sys
from datetime import date
import tkinter as tk
from tkinter import filedialog

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
                    data-bs-toggle="modal"
                    data-bs-target="#galleryModal<?= $index ?>"
                    class="gallery-item"
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

<!-- MODALE -->
<?php foreach ($gallery as $index => $image): ?>
    <div class="modal fade" id="galleryModal<?= $index ?>" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content bg-transparent border-0">
                <div class="modal-body text-center p-0">
                    <img
                        src="{gallery_dir}/<?= $image ?>"
                        class="img-fluid rounded shadow"
                        alt="Studencki Klub Regatowy ARGO AGH Kraków - zdjęcie z regat"
                    >
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
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


class UpwindResultsFetcher:
    def __init__(self, club_filter="AGH"):
        self.club_filter = club_filter
        self.headers = {
            "User-Agent": "Mozilla/5.0"
        }

    # -------------------------
    # HTTP + parsing helpers
    # -------------------------
    def get_soup(self, url):
        r = requests.get(url, headers=self.headers)
        r.raise_for_status()
        return BeautifulSoup(r.text, "lxml")

    # -------------------------
    # Find results page
    # -------------------------
    def find_results_table_url(self, regatta_url):
        soup = self.get_soup(regatta_url)

        print("Scanning results links from:", regatta_url)

        results_links = []

        for a in soup.find_all("a", href=True):
            href = a["href"]

            if "results" in href:
                full_url = urljoin(regatta_url, href)
                results_links.append(full_url)

        if not results_links:
            raise Exception("Results link not found")

        # -----------------------------
        # PRIORITY 1: table-based results
        # -----------------------------
        for url in results_links:
            if "table=" in url:
                print("Selected table-based results:", url)
                return url

        # -----------------------------
        # PRIORITY 2: normal results page
        # -----------------------------
        for url in results_links:
            if "/results" in url:
                print("Selected fallback results:", url)
                return url

        # fallback (shouldn't happen)
        return results_links[0]

    # -------------------------
    # Parse results table
    # -------------------------
    def parse_results(self, results_url):
        soup = self.get_soup(results_url)

        rows = []

        # STEP 1: find ALL cells
        cells = soup.select('div[role="cell"]')

        current_row = []
        
        for cell in cells:
            text_blocks = cell.get_text(" ", strip=True)

            if not text_blocks:
                continue

            # filter obvious UI junk
            if text_blocks.startswith("Klasyfikacja") or "Szukaj" in text_blocks:
                continue

            current_row.append(text_blocks)

            # heuristic: row boundary (Upwind groups cells in fixed chunks)
            if len(current_row) >= 8:
                row_str = " | ".join(current_row)

                if self.club_filter.lower() in row_str.lower():

                    # extract position = first number in row
                    position = next(
                        (t for t in current_row if t.strip().isdigit()),
                        None
                    )

                    if position:
                        crew = " ".join(
                            t for t in current_row
                            if self.club_filter.lower() not in t.lower()
                            and not t.strip().isdigit()
                        )

                        rows.append((position, crew, self.club_filter))

                current_row = []

        return rows

    # -------------------------
    # HTML generator
    # -------------------------
    def build_html(self, rows, results_url):
        print(rows)
        if not rows:
            return f"""
    <h4 class="mt-5">Wyniki ({self.club_filter})</h4>
    <p>Brak wyników dla {self.club_filter}</p>
    <strong><a href="{results_url}" target="_blank">Pełne wyniki na stronie Upwind</a></strong>
    """

        html = f"""
    <h4 class="mt-5">Wyniki ({self.club_filter})</h4>
    <ul class="list-unstyled">
    """

        for position, raw_text, club in rows:

            parts = raw_text.split()

            # remove leading "-" garbage
            while parts and parts[0] == "-":
                parts.pop(0)

            # remove numeric scoring junk (6, (6.00), etc.)
            cleaned_parts = []
            for p in parts:
                
                if "(" in p or ")" in p or "-" in p:
                    continue
                cleaned_parts.append(p)

            cleaned = " ".join(cleaned_parts)

            html += f"    <li><strong>{position}.</strong> {cleaned}</li>\n"

        html += f"""
    </ul>

    <strong>
        <a href="{results_url}" target="_blank">
            Pełne wyniki na stronie Upwind
        </a>
    </strong>
    """

        return html

    # -------------------------
    # PUBLIC API (what you use)
    # -------------------------
    def fetch(self, regatta_url):
        results_url = self.find_results_table_url(regatta_url)
        print(regatta_url)
        print(results_url)
        rows = self.parse_results(results_url)
        return self.build_html(rows, results_url)


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

        regatta_url = input("Regatta URL: ")

        fetcher = UpwindResultsFetcher(club_filter="AGH")

        try:
            results_html = fetcher.fetch(regatta_url)

            print("Opening editor for results (you can use plain HTML here)...")
            results_html = open_editor(results_html)

        except Exception as e:
            print(f"Error: {e}")

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