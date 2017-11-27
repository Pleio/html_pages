<?php
$pages = elgg_extract("pages", $vars, []);

echo "<div class=\"html_pages-table\">";

echo "<div class=\"html_pages-row html_pages-head\">";
    echo "<div class=\"html_pages-cell\">" . elgg_echo("html_pages:url") . "</div>";
    echo "<div class=\"html_pages-cell\">" . elgg_echo("html_pages:content") . "</div>";
echo "</div>";

foreach ($pages as $i => $page) {
    echo "<div class=\"html_pages-row\">";

    echo "<div class=\"html_pages-cell\">";
    echo elgg_view('input/text', array(
        'name' => 'pages[' . $i . '][url]',
        'value' => $page['url']
    ));
    echo "</div>";

    echo "<div class=\"html_pages-cell\">";
    echo elgg_view('input/plaintext', array(
        'name' => 'pages[' . $i . '][content]',
        'value' => $page['content']
    ));
    echo "</div>";

    echo "<div class=\"html_pages-cell\">";
    echo elgg_view('output/url', array(
        'text' => elgg_view('output/icon', array('class' => 'elgg-icon-delete')),
        'class' => 'html_pages-remove',
        'onClick' => 'elgg.html_pages.remove(this);'
    ));
    echo "</div>";

    echo "</div>";
}

echo "</div>";

echo '<div class="elgg-foot">';
    echo '<p>';
    echo elgg_view('input/button', array(
        'value' => elgg_echo('add'),
        'class' => 'html_pages-add'
    ));
    echo elgg_view('input/submit', array('value' => elgg_echo('save')));
    echo '</p>';
echo '</div>';
