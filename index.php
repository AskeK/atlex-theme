<?php
get_header();
get_template_part('template-parts/header/site-header');

$template = array(
    'home'      => is_front_page(),
    '404'       => is_404(),
    'search'    => is_search(),
    'archive'   => is_home() || is_archive() || is_tax(),
    'page'      => is_page() && is_singular(),
    'single'    => is_singular() || is_single(),
);

$f = true;
foreach($template as $t => $b){
    if($b && $f){
        get_template_part('templates/' . $t);
        $f = false; // hent kun første godkendte template
    }
}

get_footer();
