<?php

add_action('init', 'smamo_make_u_rewrite');
function smamo_make_u_rewrite() {

    add_rewrite_rule('^u/([^/]*)(/([^/]+))?(/([^/]+))?/?','index.php?author_page=true&author_name=$matches[1]&usr_page=$matches[3]&usr_subpage=$matches[5]','top');

    global $wp_rewrite;

    $wp_rewrite->author_base = 'u';
    $wp_rewrite->author_structure = '/' . $wp_rewrite->author_base . '/%author%';


}


add_filter('query_vars', 'smamo_add_query_vars');
function smamo_add_query_vars($vars) {
    $vars[] = "usr_page";
    $vars[] = "usr_subpage";
    $vars[] = "author_page";
    return $vars;
}


