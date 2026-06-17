<?php
/**
 * Manual XSS payload check for sanitise_post_html().
 * Run from repo root: php tools/test_sanitiser.php
 * Prints PASS/FAIL per case; non-zero exit if any case fails.
 */

require_once(__DIR__ . '/../dashboard/sanitiser.php');

$cases = [
    // [label, input, must_contain (or null), must_not_contain (or null)]
    ['plain paragraph',
        '<p>Hello <strong>world</strong></p>',
        '<strong>world</strong>',  null],

    ['script tag stripped',
        '<p>hi</p><script>alert(1)</script>',
        '<p>hi</p>', '<script'],

    ['onerror handler stripped',
        '<img src="x" onerror="alert(1)">',
        null, 'onerror'],

    ['javascript: href stripped',
        '<a href="javascript:alert(1)">click</a>',
        'click', 'javascript:'],

    ['data: URL stripped',
        '<img src="data:image/svg+xml;base64,PHN2Zy8+">',
        null, 'data:'],

    ['iframe stripped',
        '<iframe src="https://evil.example/"></iframe>',
        null, '<iframe'],

    ['inline style stripped',
        '<p style="background:url(javascript:alert(1))">x</p>',
        '<p>x</p>', 'javascript:'],

    ['svg with embedded script stripped',
        '<svg><script>alert(1)</script></svg>',
        null, '<script'],

    ['quill ql-align-center class kept',
        '<p class="ql-align-center">centered</p>',
        'ql-align-center', null],

    ['unknown class stripped',
        '<p class="evil">x</p>',
        '<p>x</p>', 'evil'],

    ['legitimate https link kept',
        '<a href="https://example.com">link</a>',
        'href="https://example.com"', null],

    ['target=_blank gets noopener',
        '<a href="https://example.com" target="_blank">x</a>',
        'noopener', null],

    ['ordered list survives',
        '<ol><li>a</li><li>b</li></ol>',
        '<ol><li>a</li><li>b</li></ol>', null],

    ['blockquote survives',
        '<blockquote>quote</blockquote>',
        '<blockquote>quote</blockquote>', null],
];

$fail = 0;
foreach ($cases as [$label, $input, $must_have, $must_not_have]) {
    $out = sanitise_post_html($input);
    $ok = true;
    if ($must_have !== null && strpos($out, $must_have) === false) $ok = false;
    if ($must_not_have !== null && stripos($out, $must_not_have) !== false) $ok = false;

    echo ($ok ? "PASS " : "FAIL ") . $label . "\n";
    if (!$ok) {
        echo "  in:  $input\n";
        echo "  out: $out\n";
        $fail++;
    }
}

echo "\n" . (count($cases) - $fail) . " / " . count($cases) . " passed\n";
exit($fail === 0 ? 0 : 1);
