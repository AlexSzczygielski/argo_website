<?php
/**
 * Handles gallery uploads
 */

/**
 * Resizing function
 */
function resize_if_needed(string $path, string $mime, int $max_px = 1920): void {
    [$width, $height] = getimagesize($path);

    // Read EXIF orientation for JPEGs - iPhone stores landscape pixels with a rotation tag.
    // We re-encode below (which strips EXIF), so we must bake the rotation into pixels.
    $orientation = 1;
    if ($mime === 'image/jpeg' && function_exists('exif_read_data')) {
        $exif = @exif_read_data($path);
        if (!empty($exif['Orientation'])) $orientation = (int)$exif['Orientation'];
    }

    $needs_resize = ($width > $max_px || $height > $max_px);
    if (!$needs_resize && $mime === 'image/jpeg' && $orientation === 1) return;

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

    // Apply EXIF orientation. imagerotate angles are counter-clockwise.
    switch ($orientation) {
        case 2: imageflip($dst, IMG_FLIP_HORIZONTAL); break;
        case 3: $dst = imagerotate($dst, 180, 0); break;
        case 4: imageflip($dst, IMG_FLIP_VERTICAL); break;
        case 5: imageflip($dst, IMG_FLIP_VERTICAL);   $dst = imagerotate($dst, -90, 0); break;
        case 6: $dst = imagerotate($dst, -90, 0); break;
        case 7: imageflip($dst, IMG_FLIP_HORIZONTAL); $dst = imagerotate($dst, -90, 0); break;
        case 8: $dst = imagerotate($dst, 90, 0); break;
    }

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
    $error_details = [];
    $upload_err_messages = [
        UPLOAD_ERR_INI_SIZE   => 'Plik przekracza limit serwera (upload_max_filesize).',
        UPLOAD_ERR_FORM_SIZE  => 'Plik przekracza limit formularza.',
        UPLOAD_ERR_PARTIAL    => 'Plik został przesłany tylko częściowo.',
        UPLOAD_ERR_NO_FILE    => 'Nie wybrano pliku.',
        UPLOAD_ERR_NO_TMP_DIR => 'Brak katalogu tymczasowego na serwerze.',
        UPLOAD_ERR_CANT_WRITE => 'Nie udało się zapisać pliku na dysku.',
        UPLOAD_ERR_EXTENSION  => 'Rozszerzenie PHP zablokowało przesyłanie.',
    ];

    $sort_stmt = $pdo->prepare('SELECT COALESCE(MAX(sort_order), 0) FROM post_gallery WHERE post_id = ?');
    $sort_stmt->execute([$post_id]);
    $sort_start = (int)$sort_stmt->fetchColumn();

    foreach ($files as $i => $file) {
        $orig_name = $file['name'] !== '' ? $file['name'] : ('plik_' . ($i + 1));

        if ($file['error'] !== UPLOAD_ERR_OK) {
            $errors++;
            $error_details[] = ['name' => $orig_name, 'reason' => $upload_err_messages[$file['error']] ?? ('Błąd przesyłania (kod ' . $file['error'] . ').')];
            continue;
        }
        if ($file['size'] > $max_bytes) {
            $errors++;
            $error_details[] = ['name' => $orig_name, 'reason' => 'Plik większy niż 5 MB (' . round($file['size'] / 1048576, 1) . ' MB).'];
            continue;
        }

        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $allowed_ext, true)) {
            $errors++;
            $error_details[] = ['name' => $orig_name, 'reason' => 'Nieobsługiwane rozszerzenie „' . $ext . '” (dozwolone: jpg, jpeg, png, webp, gif).'];
            continue;
        }

        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime  = $finfo->file($file['tmp_name']);
        if (!in_array($mime, $allowed_mime, true)) {
            $errors++;
            $error_details[] = ['name' => $orig_name, 'reason' => 'Nieobsługiwany typ pliku (' . ($mime ?: 'nieznany') . ').'];
            continue;
        }

        $filename = $slug . '_' . uniqid() . '.jpg';
        $dest     = $fs_directory . '/' . $filename;

        if (!move_uploaded_file($file['tmp_name'], $dest)) {
            $errors++;
            $error_details[] = ['name' => $orig_name, 'reason' => 'Nie udało się zapisać pliku w katalogu docelowym.'];
            continue;
        }

        try {
            resize_if_needed($dest, $mime);
        } catch (Throwable $e) {
            @unlink($dest);
            $errors++;
            $error_details[] = ['name' => $orig_name, 'reason' => 'Błąd przetwarzania obrazu: ' . $e->getMessage()];
            error_log('upload_gallery resize failed for ' . $orig_name . ': ' . $e->getMessage());
            continue;
        }

        $stmt = $pdo->prepare(
            'INSERT INTO post_gallery (post_id, filename, directory, sort_order)
            VALUES (?, ?, ?, ?)'
        );
        $stmt->execute([$post_id, $filename, $db_directory, $sort_start + $i + 1]);
    }

    if (!empty($error_details)) {
        $_SESSION['gallery_upload_errors'] = $error_details;
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