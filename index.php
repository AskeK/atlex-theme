<?php
get_header();
get_template_part('template-parts/header/site-header');
$is_author_page = isset($wp_query->query_vars['author_page']) && $wp_query->query_vars['author_page'] === 'true';
$template = array(
    'author'    => $is_author_page,
    'home'      => is_front_page(),
    'search'    => is_search(),
    'archive'   => is_home() || is_archive() || is_tax(),
    'page'      => is_page() && is_singular(),
    'single'    => is_singular() || is_single(),
    '404'       => is_404(),
);

$f = true;
foreach($template as $t => $b){
    if($b && $f){
        get_template_part('templates/' . $t);
        $f = false; // hent kun første godkendte template
    }
}

get_footer();
