<?php
/**
 * Activity log helper.
 *
 * Single entry point: log_action(action, target_id, details).
 * Never throws — log failures are swallowed and reported via error_log()
 * so a logging issue can't break the user's actual action.
 *
 * Conventions:
 *  - action: dotted lowercase, "category.event" — e.g. "post.submit",
 *    "auth.login.failure", "gallery.delete".
 *  - target_id: id of the affected entity (post id, gallery image id).
 *  - target_type is derived from the action prefix unless explicit.
 *  - details: optional JSON-serialisable array for context (e.g. old/new
 *    status, attempted email on failed login).
 */

function log_action(string $action, ?int $target_id = null, ?array $details = null, ?string $target_type = null): void {
    try {
        require_once(__DIR__ . '/../db/db.php');
        $pdo = get_pdo();

        // derive target_type from action prefix if not given
        if ($target_type === null) {
            $prefix = strstr($action, '.', true);
            $target_type = $prefix !== false ? $prefix : null;
        }

        $stmt = $pdo->prepare(
            'INSERT INTO activity_log (user_id, action, target_type, target_id, details)
             VALUES (:user_id, :action, :target_type, :target_id, :details)'
        );
        $user_id = isset($_SESSION['user_id']) ? (int)$_SESSION['user_id'] : null;
        $stmt->bindValue(':user_id', $user_id, $user_id === null ? PDO::PARAM_NULL : PDO::PARAM_INT);
        $stmt->bindValue(':action', $action);
        $stmt->bindValue(':target_type', $target_type);
        $stmt->bindValue(':target_id', $target_id, $target_id === null ? PDO::PARAM_NULL : PDO::PARAM_INT);
        $stmt->bindValue(':details', $details === null ? null : json_encode($details, JSON_UNESCAPED_UNICODE));
        $stmt->execute();
    } catch (Throwable $e) {
        error_log('activity_log write failed: ' . $e->getMessage() . ' (action=' . $action . ')');
    }
}
