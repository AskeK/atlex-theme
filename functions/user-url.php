<?php

add_action('init', 'smamo_make_u_rewrite');
function smamo_make_u_rewrite() {
    global $wp_rewrite;
    $wp_rewrite->author_base = 'u';
    $wp_rewrite->author_structure = '/' . $wp_rewrite->author_base . '/%author%';


}

add_rewrite_rule('^u/([^/]*)(/([^/]+))?(/([^/]+))?/?','index.php?author=$matches[1]&usr_page=$matches[3]&usr_subpage=$matches[5]','top');
add_filter('query_vars', 'smamo_add_query_vars');
function smamo_add_query_vars($vars) {
    $vars[] = "usr_page";
    $vars[] = "usr_subpage";
    return $vars;
}
