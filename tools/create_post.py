import os
import re
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


def read_multiline(prompt="Enter content (end with empty line):"):
    print(prompt)
    lines = []
    while True:
        line = input()
        if line.strip() == "":
            break
        lines.append(line)
    return "\n".join(lines)


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
# HTML IMAGE BLOCK (2 per row + modal)
# ----------------------------

def build_extra_images_html(images):
    if not images:
        return ""

    html = """
<div class="post-extra-images mt-5">
    <div class="row g-3">
"""

    modals = ""

    for idx, img in enumerate(images):
        modal_id = f"imgModal{idx}"

        html += f"""
        <div class="col-6">
            <a href="#" data-bs-toggle="modal" data-bs-target="#{modal_id}">
                <img src="{img}" class="img-fluid rounded shadow-sm" style="cursor:pointer;">
            </a>
        </div>
"""

        modals += f"""
<div class="modal fade" id="{modal_id}" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content bg-transparent border-0">

      <div class="modal-body text-center p-0">
        <img src="{img}" class="img-fluid rounded shadow">
      </div>

    </div>
  </div>
</div>
"""

    html += """
    </div>
</div>
"""

    return html + modals


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


# ----------------------------
# MAIN
# ----------------------------

def main():
    print("=== BLOG POST GENERATOR ===")

    # ------------------------
    # COVER IMAGE
    # ------------------------
    cover = get_image_path()

    if not cover:
        cover = "storage/images/placeholder.jpg"
    else:
        validate_image_size(cover)
        cover = to_rel(cover)

    # ------------------------
    # EXTRA IMAGES
    # ------------------------
    extra_html = """
    <div class="mt-5 text-muted"
        style="font-style: italic; font-size: 0.9rem;">
        AUTOR: <?= htmlspecialchars($post['author'] ?? 'ARGO') ?>
    </div>
    """

    if input("Add extra images? (y/n): ").lower() == "y":
        imgs = get_image_paths()

        valid = []
        for i in imgs:
            validate_image_size(i)
            valid.append(to_rel(i))

        extra_html = extra_html + build_extra_images_html(valid)

    # ------------------------
    # SAFE INPUT (LAST)
    # ------------------------
    title = input("\nTitle: ").strip()
    author = input("Author (optional): ").strip()

    slug = slugify(title)
    filename = f"{slug}.php"

    check_duplicates(slug, title)

    print("\nPaste content:")
    content = read_multiline()

    final_content = content + "\n\n" + extra_html

    create_post_file(filename, final_content)

    post = {
        "id": slug,
        "title": title,
        "excerpt": extract_first_sentence(content),
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