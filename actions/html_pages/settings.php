<?php

$pages = get_input('pages', null, false);

// remove rows with empty source or value
foreach ($pages as $i => $page) {
    if ($page['url'] == "" | $page['content'] == "") {
        unset($pages[$i]);
    }
}

// unset pages when no page is defined
if (count($pages) == 0) {
    elgg_unset_plugin_setting('html_pages', 'pages');
} else {
    elgg_set_plugin_setting('pages', json_encode($pages), 'html_pages');
}

system_message(elgg_echo('admin:configuration:success'));
forward(REFERER);