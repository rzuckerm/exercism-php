<?php

declare(strict_types=1);

function parseMarkdown($markdown)
{
    // Headers
    $html = preg_replace_callback('/^(#{1,6}) (.*)/', fn(array $m): string =>
        "<h" . ($l = strlen($m[1])) . ">" . trim($m[2]) . "</h$l>", $markdown);

    // Bold
    $html = preg_replace('/__(.*)__/', '<em>\1</em>', $html);

    // Italics
    $html = preg_replace('/_(.*)_/', '<i>\1</i>', $html);

    // List items
    $html = preg_replace('/^\* (.*)/m', '<li>\1</li>', $html);

    // Nested paragraphs
    $html = preg_replace('#^<li>(?!<i>|<em>)(.*)</li>#m', '<li><p>\1</p></li>', $html);

    // Unordered lists
    $html = preg_replace('!(<li>.*</li>)!s', '<ul>\1</ul>', $html);

    // Paragraphs
    return str_replace("\n", "", preg_replace('/^(?!<h[1-6]>|<li>|<ul>|<p>)(.*)/m', '<p>\1</p>', $html));
}
