import os
import re
from datetime import date
import tkinter as tk
from tkinter import filedialog

POSTS_DATA_PATH = "blog/posts_data.php"
POSTS_DIR = "blog/posts"
IMAGES_DIR = "storage/images"

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


def get_image_path():
    root = tk.Tk()
    root.withdraw()

    return filedialog.askopenfilename(
        title="Select image for blog post",
        initialdir=IMAGES_DIR,
        filetypes=[("Image files", "*.jpg *.jpeg *.png *.webp")]
    )


# ----------------------------
# Validation
# ----------------------------

def check_duplicates(slug, title):
    with open(POSTS_DATA_PATH, "r", encoding="utf-8") as f:
        data = f.read()

    if f'"id" => "{slug}"' in data:
        raise Exception(f"❌ ERROR: Post with id '{slug}' already exists!")

    if f'"title" => "{title}"' in data:
        print(f"⚠️ WARNING: A post with title '{title}' already exists!")


# ----------------------------
# File writing
# ----------------------------

def create_post_file(filename, content):
    path = os.path.join(POSTS_DIR, filename)

    with open(path, "w", encoding="utf-8") as f:
        f.write(content)

    print(f"[OK] Created post file: {path}")


def update_posts_file(entry: dict):
    with open(POSTS_DATA_PATH, "r", encoding="utf-8") as f:
        data = f.read()

    pos = data.rfind("];")
    if pos == -1:
        raise Exception("Could not find end of posts array")

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

    print("[OK] Updated posts_data.php")


# ----------------------------
# Main
# ----------------------------

def main():
    print("=== CREATE NEW BLOG POST ===")

    title = input("Title: ").strip()
    author = input("Author (optional): ").strip()

    print("\nPaste content:")
    content = read_multiline()

    slug = slugify(title)
    filename = f"{slug}.php"

    # check duplicates first
    check_duplicates(slug, title)

    print("\nSelect image...")

    image_path = get_image_path()

    if not image_path:
        image_path = "storage/images/placeholder.jpg"
    else:
        # convert absolute path -> project relative path
        image_path = os.path.relpath(image_path, os.getcwd())
        image_path = image_path.replace("\\", "/")

    # create post file
    create_post_file(filename, content)

    post = {
        "id": slug,
        "title": title,
        "excerpt": extract_first_sentence(content),
        "image": image_path,
        "content": f"blog/posts/{filename}",
        "author": author if author else None,
        "date": str(date.today())
    }

    update_posts_file(post)

    print("\n[DONE] Post successfully created!")


if __name__ == "__main__":
    main()