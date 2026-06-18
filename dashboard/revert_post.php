<?php
/**
 * Reverts a "pending" or "published" post back to "draft" so the author
 * can edit it. Triggered from the read-only lockout view in post_form.php
 * that members see when they open a post that is either awaiting review
 * or live on the blog.
 *
 * POST-only — no confirmation page, because reaching it already requires
 * an explicit click on "Cofnij do szkicu" / "Wycofaj z bloga" in the
 * lockout card, which itself spells out the consequence.
 */
require_once(__DIR__ . '/auth_check.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /dashboard/panel.php');
    exit;
}
csrf_verify();

$post_id = (int)($_POST['post_id'] ?? 0);
if ($post_id <= 0) {
    header('Location: /dashboard/panel.php');
    exit;
}

try {
    require_once(__DIR__ . '/../db/db.php');
    $pdo = get_pdo();
    // Guard with status IN ('pending','published') — covers both lockout
    // paths in post_form.php and stays idempotent if double-submitted.
    // Won't touch a post already in draft (no-op redirect still fine).
    // capture pre-update status for the log
    $pre = $pdo->prepare("SELECT status FROM posts WHERE id = :id");
    $pre->bindValue(':id', $post_id, PDO::PARAM_INT);
    $pre->execute();
    $previous_status = $pre->fetchColumn() ?: null;

    $stmt = $pdo->prepare("UPDATE posts SET status = 'draft' WHERE id = :id AND status IN ('pending', 'published')");
    $stmt->bindValue(':id', $post_id, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        require_once(__DIR__ . '/activity_log.php');
        log_action('post.revert', $post_id, ['from' => $previous_status, 'to' => 'draft']);
    }
} catch (Exception $e) {
    error_log("revert_post error: " . $e->getMessage());
    header('Location: /dashboard/post_form.php?id=' . $post_id . '&message=error');
    exit;
}

require_once(__DIR__ . '/messages.php');
header('Location: /dashboard/post_form.php?id=' . $post_id . '&message=' . MSG_REVERTED);
exit;
