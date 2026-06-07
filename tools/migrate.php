<?php
/**
 * migrate.php
 * Script to migrate old style file - based blog to new SQL DB solution
 */
require_once(__DIR__ . '/../blog/posts_data.php');
require_once(__DIR__ . '/db_config.php');
require_once(__DIR__ . '/db.php');

// Open DB connection
$pdo = get_pdo();
$count = $pdo->query("SELECT COUNT(*) FROM posts")->fetchColumn();
if ($count > 0) {
    die("DB already has data. Run DELETE FROM posts; in phpMyAdmin first if you want to re-migrate.");
}

echo("opened conn");

// Execute SQL
$stmt = $pdo->prepare(
    "INSERT INTO posts (title,date,author, excerpt, cover_image, content) VALUES (:title, :date, :author, :excerpt, :cover_image, :content)");

foreach($posts as $post){
    try {
        $stmt->execute([
            ':title'       => $post['title'],
            ':date'        => $post['date'], 
            ':author'      => $post['author'] ?? null, 
            ':excerpt'     => $post['excerpt'] ?? null,
            ':cover_image' => $post['image'],
            ':content'     => null
        ]);
        echo "Inserted: " . $post['title'] . "<br>";
    } catch (PDOException $e) {
        die("Failed on: " . $post['title'] . " — " . $e->getMessage());
    }
}
echo "Done";
?>