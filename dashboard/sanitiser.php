<?php
/**
 * HTML sanitiser for Quill post content.
 * Strips <script>, event handlers, javascript: URLs, iframes, etc.
 * Allowlist matches Quill's default Snow toolbar output.
 *
 * Called from post_form.php (save) and preview.php so the preview
 * reflects exactly what gets stored.
 */

require_once(__DIR__ . '/../plugins/htmlpurifier/library/HTMLPurifier.auto.php');

function sanitise_post_html(string $html): string {
    static $purifier = null;

    if ($purifier === null) {
        $cache_dir = __DIR__ . '/../storage/cache/htmlpurifier';
        if (!is_dir($cache_dir)) {
            // 0775 so the web user can write; deploy user owns the parent
            @mkdir($cache_dir, 0775, true);
        }

        $config = HTMLPurifier_Config::createDefault();
        $config->set('Cache.SerializerPath', $cache_dir);
        $config->set('HTML.Doctype', 'HTML 4.01 Transitional');

        // tags Quill's default Snow toolbar can emit.
        // [class] is allowed on block elements because Quill applies
        // ql-align-* / ql-indent-* / ql-syntax to them.
        $config->set('HTML.Allowed',
            'p[class],br,strong,em,u,s,sub,sup,'
            . 'h1[class],h2[class],h3[class],h4[class],h5[class],h6[class],'
            . 'ol,ul,li[class],'
            . 'blockquote[class],pre[class],code,'
            . 'a[href|title|target],'
            . 'img[src|alt|width|height],'
            . 'span[class],div[class]'
        );

        // only safe URL schemes; blocks javascript:, data:, etc.
        $config->set('URI.AllowedSchemes', ['http' => true, 'https' => true, 'mailto' => true]);

        // links open in new tab safely — HTMLPurifier auto-adds noopener
        $config->set('HTML.TargetBlank', true);

        // Quill emits ql-align-*, ql-indent-*, ql-syntax on its elements
        $config->set('Attr.AllowedClasses', [
            'ql-align-center', 'ql-align-right', 'ql-align-justify',
            'ql-indent-1', 'ql-indent-2', 'ql-indent-3', 'ql-indent-4',
            'ql-indent-5', 'ql-indent-6', 'ql-indent-7', 'ql-indent-8',
            'ql-syntax',
        ]);

        $purifier = new HTMLPurifier($config);
    }

    return $purifier->purify($html);
}
