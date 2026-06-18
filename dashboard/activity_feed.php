<?php
/**
 * Admin-only activity feed — paginated view of the activity_log table,
 * joined with users for current-name display.
 * Deleted users show up as "(usunięty użytkownik)" because user_id was
 * SET NULL by the FK when their row was deleted.
 */
require_once(__DIR__ . '/auth_check.php');
if (empty($_SESSION['admin'])) {
    header('Location: /dashboard/panel.php');
    exit;
}

$page_title = "SKR Argo AGH - Log aktywności";
$page_description = "Log aktywności użytkowników w panelu CMS";
$page_image = "https://argo.agh.edu.pl/storage/images/argologo.png";

$per_page = 50;
$page = max(1, (int)($_GET['page'] ?? 1));
$offset = ($page - 1) * $per_page;

$entries = [];
$total = 0;
try {
    require_once(__DIR__ . '/../db/db.php');
    $pdo = get_pdo();
    $total = (int)$pdo->query("SELECT COUNT(*) FROM activity_log")->fetchColumn();

    $stmt = $pdo->prepare(
        'SELECT a.id, a.user_id, a.action, a.target_type, a.target_id,
                a.details, a.created_at,
                u.name, u.surname
         FROM activity_log a
         LEFT JOIN users u ON u.id = a.user_id
         ORDER BY a.created_at DESC, a.id DESC
         LIMIT :limit OFFSET :offset'
    );
    $stmt->bindValue(':limit', $per_page, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $entries = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    error_log("activity_feed error: " . $e->getMessage());
}
$total_pages = max(1, (int)ceil($total / $per_page));
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <?php require_once(__DIR__ . '/../layout/header.php');?>
</head>
<body>
    <div class="page-container">
        <div class="content-wrap">
            <?php require_once(__DIR__ . '/../layout/navbar.php'); ?>
            <!-- Page content starts here -->
            <div class="container p-4">
                <h1 class="mt-5">Log aktywności</h1>
                <p class="text-muted">Wszystkie akcje w panelu CMS, najnowsze pierwsze.</p>
                <a href="/dashboard/panel.php" class="btn btn-sm btn-outline-secondary mb-4">← Wróć do panelu</a>

                <p class="small text-muted">Wpisów: <?= $total ?> &middot; strona <?= $page ?> / <?= $total_pages ?></p>

                <div class="table-responsive">
                    <table class="table table-sm table-striped">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Użytkownik</th>
                                <th>Akcja</th>
                                <th>Cel</th>
                                <th>Szczegóły</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($entries as $e): ?>
                            <tr>
                                <td class="text-nowrap small"><?= htmlspecialchars($e['created_at']) ?></td>
                                <td class="small">
                                    <?php if ($e['user_id'] === null): ?>
                                        <span class="text-muted">(usunięty użytkownik)</span>
                                    <?php elseif ($e['name'] === null && $e['surname'] === null): ?>
                                        <span class="text-muted">(brak danych)</span>
                                    <?php else: ?>
                                        <?= htmlspecialchars(trim(($e['name'] ?? '') . ' ' . ($e['surname'] ?? ''))) ?>
                                    <?php endif; ?>
                                </td>
                                <td class="small"><code><?= htmlspecialchars($e['action']) ?></code></td>
                                <td class="small">
                                    <?php if ($e['target_type'] && $e['target_id']): ?>
                                        <?= htmlspecialchars($e['target_type']) ?> #<?= (int)$e['target_id'] ?>
                                    <?php endif; ?>
                                </td>
                                <td class="small">
                                    <?php if (!empty($e['details'])): ?>
                                        <code style="font-size: 0.75rem;"><?= htmlspecialchars($e['details']) ?></code>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($entries)): ?>
                            <tr><td colspan="5" class="text-muted text-center py-4">Brak wpisów.</td></tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <?php if ($total_pages > 1): ?>
                    <nav>
                        <ul class="pagination pagination-sm">
                            <?php for ($p = 1; $p <= $total_pages; $p++): ?>
                                <li class="page-item <?= $p === $page ? 'active' : '' ?>">
                                    <a class="page-link" href="?page=<?= $p ?>"><?= $p ?></a>
                                </li>
                            <?php endfor; ?>
                        </ul>
                    </nav>
                <?php endif; ?>
            </div>
            <!-- Page content ends here -->
        </div>
        <?php require_once(__DIR__ . '/../layout/footer.php');?>
    </div>
</body>
</html>
