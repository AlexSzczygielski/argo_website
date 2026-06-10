<?php
/**
 * layout/post_content.php
 * Reusable post rendering partial.
 * Requires $post to be defined by the including file.
 * $gallery is optional — defaults to empty array.
 */
if (!isset($post)) {
    http_response_code(403);
    die('Direct access not allowed.');
}
$gallery = $gallery ?? [];
?>

<!-- POST CONTENT -->
<div class="container p-4">

    <div class="row g-5">

        <!-- LEFT COLUMN -->
        <div class="col-md-7">

            <h1 class="mt-4 mb-3">
                <?= htmlspecialchars($post['title']) ?>
            </h1>

            <p class="text-muted mb-4" style="font-size: 0.9rem;">
                <?= date("d.m.Y", strtotime($post['date'])) ?>
            </p>

            <p class="lead mb-4">
                <?= htmlspecialchars($post['excerpt']) ?>
            </p>

            <!-- MOBILE IMAGE -->
            <div class="d-block d-md-none mb-4 text-center">
                <img
                    src="/<?= htmlspecialchars($post['cover_image']) ?>"
                    alt="<?= htmlspecialchars($post['title']) ?>"
                    class="img-fluid rounded shadow-sm"
                    style="cursor:pointer;"
                    data-bs-toggle="modal"
                    data-bs-target="#titleImageModal"
                >
            </div>

            <article class="mb-4">
                <div class="blog-post-content">
                    <?= $post['content'] ?>
                    <div class="mt-5 text-muted" style="font-style: italic; font-size: 0.9rem;">
                        AUTOR: <?= htmlspecialchars($post['author'] ?? 'ARGO') ?>
                    </div>

                    <?php if (!empty($post['results_url'])): ?>
                        <div id="upwind-results" data-regatta-url="<?= htmlspecialchars($post['results_url']) ?>"></div>
                    <?php endif; ?>
                </div>

                <!-- Gallery -->
                <?php if (!empty($gallery)): ?>
                <div class="post-gallery mt-5">
                    <div class="row g-3">
                        <?php foreach ($gallery as $index => $image): ?>
                            <div class="col-6">
                                <a
                                    href="#"
                                    class="gallery-item"
                                    onclick="openGallery(<?= $index ?>); return false;"
                                >
                                    <img
                                        src="/<?= htmlspecialchars($image['directory'] . '/' . $image['filename']) ?>"
                                        alt="Studencki Klub Regatowy ARGO AGH Kraków - zdjęcie z regat"
                                        class="img-fluid rounded shadow-sm gallery-image"
                                        loading="lazy"
                                    >
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Gallery Modal -->
                <div class="modal fade" id="galleryModal" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered modal-xl">
                        <div class="modal-content bg-transparent border-0">
                            <div class="modal-header border-0 justify-content-end">
                                <button type="button"
                                        class="btn-close btn-close-white"
                                        data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body text-center p-0 position-relative d-flex justify-content-center align-items-center">
                                <button type="button"
                                        class="btn btn-dark modal-nav-btn modal-prev"
                                        onclick="prevImage()">‹</button>
                                <img id="galleryModalImage"
                                     src=""
                                     class="img-fluid rounded shadow"
                                     alt="gallery image">
                                <button type="button"
                                        class="btn btn-dark modal-nav-btn modal-next"
                                        onclick="nextImage()">›</button>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if ($post['photo_credits']): ?>
                    <div class="mt-5 text-muted" style="font-style: italic; font-size: 0.9rem;">
                        Zdjęcia dzięki uprzejmości organizatora.
                    </div>
                <?php endif; ?>
                <?php endif; ?>
            </article>

        </div>

        <!-- DESKTOP IMAGE -->
        <div class="col-md-5 text-center text-md-end d-none d-md-block">
            <img
                src="/<?= htmlspecialchars($post['cover_image']) ?>"
                alt="<?= htmlspecialchars($post['title']) ?>"
                class="img-fluid rounded shadow-sm"
                style="cursor:pointer;"
                data-bs-toggle="modal"
                data-bs-target="#titleImageModal"
            >
        </div>

    </div>

</div>

<!-- Title Image Modal -->
<div class="modal fade" id="titleImageModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-header border-0 justify-content-end">
                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-0">
                <img
                    src="/<?= htmlspecialchars($post['cover_image']) ?>"
                    class="img-fluid rounded shadow"
                    alt="<?= htmlspecialchars($post['title']) ?>"
                >
            </div>
        </div>
    </div>
</div>

<script src="/js/upwind_api.js"></script>
<script>
const galleryImages = [
    <?php foreach ($gallery as $image): ?>
        "/<?= htmlspecialchars($image['directory'] . '/' . $image['filename']) ?>",
    <?php endforeach; ?>
];

let currentIndex = 0;

function openGallery(index) {
    currentIndex = index;
    document.getElementById('galleryModalImage').src = galleryImages[currentIndex]; // relative path already in the element
    const modal = new bootstrap.Modal(document.getElementById('galleryModal'));
    modal.show();
}

function nextImage() {
    currentIndex = (currentIndex + 1) % galleryImages.length;
    document.getElementById('galleryModalImage').src = galleryImages[currentIndex]; // relative path already in the element
}

function prevImage() {
    currentIndex = (currentIndex - 1 + galleryImages.length) % galleryImages.length;
    document.getElementById('galleryModalImage').src = galleryImages[currentIndex]; // relative path already in the element
}
</script>