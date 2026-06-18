<?php
/**
 * Handles gallery uploads
 */

/**
 * Resizing function
 */
function resize_if_needed(string $path, string $mime, int $max_px = 1920): void {
    [$width, $height] = getimagesize($path);

    // always convert to JPEG - resize only if needed
    $needs_resize = ($width > $max_px || $height > $max_px);
    if (!$needs_resize && $mime === 'image/jpeg') return; // already JPEG, already small

    $ratio = $needs_resize ? min($max_px / $width, $max_px / $height) : 1;
    $new_w = (int)($width * $ratio);
    $new_h = (int)($height * $ratio);

    switch ($mime) {
        case 'image/jpeg': $src = imagecreatefromjpeg($path); break;
        case 'image/png':  $src = imagecreatefrompng($path);  break;
        case 'image/webp': $src = imagecreatefromwebp($path); break;
        case 'image/gif':  $src = imagecreatefromgif($path);  break;
        default: return;
    }

    $dst = imagecreatetruecolor($new_w, $new_h);

    // fill transparency with white before converting to JPEG
    $white = imagecolorallocate($dst, 255, 255, 255);
    imagefill($dst, 0, 0, $white);

    imagecopyresampled($dst, $src, 0, 0, 0, 0, $new_w, $new_h, $width, $height);
    imagejpeg($dst, $path, 85);

    imagedestroy($src);
    imagedestroy($dst);
}
/** --- */
require_once __DIR__ . '/auth_check.php';
require_once __DIR__ . '/../db/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: panel.php');
    exit;
}
csrf_verify();

$post_id = isset($_GET['post_id']) ? (int)$_GET['post_id'] : 0;
if ($post_id <= 0) {
    header('Location: panel.php');
    exit;
}

$redirect_base = '/dashboard/post_form.php?id=' . $post_id;

try{
    // Verify post exists
    $pdo = get_pdo();
    $stmt = $pdo->prepare('SELECT id FROM posts WHERE id = :id');
    $stmt->bindValue(':id', $post_id, PDO::PARAM_INT);
    $stmt->execute();
    if (!$stmt->fetch()) {
        header('Location: panel.php');
        exit;
    }

    // Check files were sent
    if (empty($_FILES['images']['name'][0])) {
        header('Location: ' . $redirect_base . '&message=no_file');
        exit;
    }

    $allowed_ext  = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
    $allowed_mime = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
    $max_bytes    = 5 * 1024 * 1024;
    $year         = date('Y');

    // slugify the post title
    $title_row = $pdo->prepare('SELECT title FROM posts WHERE id = :id');
    $title_row->bindValue(':id', $post_id, PDO::PARAM_INT);
    $title_row->execute();
    $title = $title_row->fetchColumn();

    $slug = strtolower(trim(preg_replace('/[^a-z0-9]+/i', '_', $title), '_'));
    $slug = substr($slug, 0, 40); // cap length

    $db_directory = 'storage/images/' . $year . '/' . $slug;
    $fs_directory = __DIR__ . '/../' . $db_directory;

    if (!is_dir($fs_directory)) {
        mkdir($fs_directory, 0755, true);
    }

    // Re-index $_FILES['images'] into a normal array of files
    $files = [];
    foreach ($_FILES['images']['name'] as $i => $name) {
        $files[] = [
            'name'     => $name,
            'tmp_name' => $_FILES['images']['tmp_name'][$i],
            'error'    => $_FILES['images']['error'][$i],
            'size'     => $_FILES['images']['size'][$i],
        ];
    }

    $errors = 0;
    $sort_stmt = $pdo->prepare('SELECT COALESCE(MAX(sort_order), 0) FROM post_gallery WHERE post_id = ?');
    $sort_stmt->execute([$post_id]);
    $sort_start = (int)$sort_stmt->fetchColumn();

    foreach ($files as $i => $file) {
        if ($file['error'] !== UPLOAD_ERR_OK)          { $errors++; continue; }
        if ($file['size'] > $max_bytes)                 { $errors++; continue; }

        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $allowed_ext, true))        { $errors++; continue; }

        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime  = $finfo->file($file['tmp_name']);
        if (!in_array($mime, $allowed_mime, true))      { $errors++; continue; }

        $filename = uniqid('img_', true) . '.' . $ext;
        $dest     = $fs_directory . '/' . $filename;

        // always save as jpg regardless of upload format
        $filename = $slug . '_' . uniqid() . '.jpg';
        $dest     = $fs_directory . '/' . $filename;

        if (!move_uploaded_file($file['tmp_name'], $dest)) { $errors++; continue; }
        resize_if_needed($dest, $mime);

        $stmt = $pdo->prepare(
            'INSERT INTO post_gallery (post_id, filename, directory, sort_order)
            VALUES (?, ?, ?, ?)'
        );
        $stmt->execute([$post_id, $filename, $db_directory, $sort_start + $i + 1]);
    }

    $uploaded = count($files) - $errors;
    if ($uploaded > 0) {
        require_once(__DIR__ . '/activity_log.php');
        log_action('gallery.upload', $post_id, ['uploaded' => $uploaded, 'errors' => $errors]);
    }
    $msg = $errors === 0 ? 'saved' : ($errors === count($files) ? 'error' : 'partial');
    header('Location: ' . $redirect_base . '&message=' . $msg);
    exit;
} catch(Exception $e){
    error_log("upload_gallery error: " . $e->getMessage());
    header('Location: ' . $redirect_base . '&message=error');
    exit;
}