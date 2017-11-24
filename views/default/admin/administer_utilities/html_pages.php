<?php
$pages = json_decode(elgg_get_plugin_setting('pages', 'html_pages'), true);

echo elgg_view_form('html_pages/settings', array(), array('pages' => $pages));