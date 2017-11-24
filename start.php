<?php
elgg_register_event_handler('init','system','html_pages_init');

function html_pages_init() {
    elgg_register_event_handler('pagesetup', 'system', 'html_pages_pagesetup');
    elgg_register_action('html_pages/settings', dirname(__FILE__) . '/actions/html_pages/settings.php', 'admin');

    elgg_extend_view('js/admin', 'html_pages/js/admin');
    elgg_extend_view('css/admin', 'html_pages/css/admin');

    foreach (html_pages_get_pages() as $page) {
        html_pages_register_page($page);
    }
}

function html_pages_get_pages() {
    static $pages;

    if ($pages) {
        return $pages;
    }

    $pages = json_decode(elgg_get_plugin_setting('pages', 'html_pages'), true);
    return $pages;
}

function html_pages_get_page($handler) {
    foreach (html_pages_get_pages() as $page) {
        if ($page['url'] === $handler) {
            return $page;
        }
    }

    return null;
}

function html_pages_register_page($page) {
    if ($page['url'] === "index") {
        elgg_register_plugin_hook_handler('index', 'system', 'html_pages_index_handler', 0); // make sure priority is zero to be before walled garden
    } else {
        elgg_register_page_handler($page['url'], 'html_pages_page_handler');
    }
}

function html_pages_pagesetup() {
    elgg_register_admin_menu_item('administer', 'html_pages', 'administer_utilities');
}

function html_pages_index_handler($hook, $type, $return_value, $params) {
    $page = html_pages_get_page("index");

    if ($page) {
        echo elgg_view_page(null, $page['content'], "default");
        return true;
    }
}

function html_pages_page_handler($hook, $type, $return_value, $params) {
    $page = html_pages_get_page($type);

    if ($page) {
        echo elgg_view_page(null, $page['content'], "default");
        return true;
    }
}