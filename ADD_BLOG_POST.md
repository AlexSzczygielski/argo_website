# How to Add a New Blog Post

## 1. Create the content file

1. Go to the directory:

   ```
   blog/posts/
   ```

2. Create a new file:

   ```
   your_post_name.php
   ```

3. Example:

   ```
   blog/posts/argo_history.php
   ```

---

## 2. Write the content

1. The file must contain **only the post content**.

2. Do NOT include:

   * container / row / col divs
   * `<h1>` title
   * author section
   * image
   * navbar or footer

3. Correct example:

   ```php
   <p>Treść wpisu...</p>

   <h4>Podtytuł</h4>

   <ul>
     <li>Element 1</li>
     <li>Element 2</li>
   </ul>
   ```

---

## 3. Add entry to `posts_data.php`

1. Open:

   ```
   blog/posts_data.php
   ```

2. Add a new element to the `$posts` array:

   ```php
   [
       "id" => "unique_id",
       "title" => "Tytuł wpisu",
       "excerpt" => "Krótki opis wpisu",
       "image" => "ścieżka/do/obrazu.jpg",
       "content" => "blog/posts/your_post_name.php",
       "author" => "Autor",
       "date" => "YYYY-MM-DD"
   ],
   ```

---

## 4. Example entry

```php
[
    "id" => "argo_history",
    "title" => "Skąd wzięła się nazwa Argo?",
    "excerpt" => "Krótka historia nazwy naszej łodzi.",
    "image" => "storage/images/argo_painting.jpg",
    "content" => "blog/posts/argo_history.php",
    "author" => "GALL ANONIM",
    "date" => "2025-06-01"
],
```

---

## 5. Field rules

1. `id`

   * must be unique
   * used in URL:

     ```
     blog_post.php?page=your_id
     ```

2. `image`

   * must point to a file in:

     ```
     storage/images/
     ```

3. `content`

   * must match the file path exactly:

     ```
     blog/posts/file.php
     ```

4. `date`

   * format: `YYYY-MM-DD`
   * determines post order (newest first)

---

## 6. Check the post

1. Open in browser:

   ```
   blog_post.php?page=your_id
   ```

---

## 7. Common mistakes

1. Adding layout (container, row, etc.) to content file
2. Wrong file path in `content`
3. Duplicate `id`
4. Missing or incorrect image path

---

## 8. Summary

1. Create file in `blog/posts/`
2. Add entry to `posts_data.php`
3. Done


---

# Prompt for Generating a New Blog Post

Use this prompt whenever you want to create a new post.

---

## Instructions

1. Replace the content section with your post text
2. Send the prompt
3. Copy the generated output into your project

---

## Prompt

```
I want to create a new blog post.

Here is the content:

[PASTE YOUR POST CONTENT HERE]

Generate:

1. Clean content file for blog/posts/your_post_name.php
   - only content (no layout, no container, no h1, no author, no image)

2. Ready-to-copy entry for posts_data.php:
   - id (based on title, lowercase, underscores)
   - title
   - excerpt (short summary)
   - image (leave placeholder if not provided)
   - content path
   - author (default: ARGO if not specified)
   - date (today)

3. Suggested filename

Keep everything clean and consistent with my current blog system.
```

---

## Notes

* You can write content in Polish or English
* If you include headings or lists, they will be preserved
* If you include raw text, it will be formatted properly
* You can optionally specify:

  * author
  * image path
  * date

If not provided, defaults will be used