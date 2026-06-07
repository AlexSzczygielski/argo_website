<?php
require_once(__DIR__ . '/db_config.php');
require_once(__DIR__ . '/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_id   = $_POST['sql_post_id'];
    $directory = $_POST['directory'];
    // Try quoted format first
    preg_match_all('/"([^"]+)"/', $_POST['gallery_str'], $matches);
    $filenames = $matches[1];

    // Fallback to comma-separated
    if (empty($filenames)) {
        $filenames = array_filter(array_map('trim', explode(',', $_POST['gallery_str'])));
    }


    $pdo  = get_pdo();
    $stmt = $pdo->prepare("INSERT INTO post_gallery (post_id, filename, directory, sort_order) VALUES (:post_id, :filename, :directory, :sort_order)");

    foreach ($filenames as $index => $filename) {
        $stmt->execute([
            ':post_id'    => $post_id,
            ':filename'   => $filename,
            ':directory'  => $directory,
            ':sort_order' => $index
        ]);
        echo "Inserted: $filename <br>";
    }
    echo "Done";
}
?>
<body>
    <form method="POST" enctype="multipart/form-data">
        <p>SQL POST ID</p>
        <textarea name="sql_post_id"></textarea>
 
        <p>directory path</p>
        <textarea name="directory"></textarea>

        <p>Gallery string:</p>
        <textarea name="gallery_str"></textarea>

        <br>
        <input type="submit" value="Submit"></input>
    </form>
    
</body>