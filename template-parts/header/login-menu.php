<?php

if (is_user_logged_in()) : $u = wp_get_current_user();

$create_href = false;
$pages = get_pages(array('meta_key' => '_wp_page_template', 'meta_value' => 'templates/create.php', ));
foreach($pages as $p){$create_href = get_permalink($p->ID);}

$author_base = get_author_posts_url(get_current_user_id());

//$ovelse_count = count(get_posts(array('post_type' => 'ovelse', 'posts_per_page' => -1, 'post_author' => get_current_user_id())));
//$forlob_count = count(get_posts(array('post_type' => 'forlob', 'posts_per_page' => -1, 'post_author' => get_current_user_id())));

$posts__in = array();
$ids = get_user_meta(get_current_user_id(),'saved_posts',false);
foreach($ids as $id){
    array_push($posts__in,$id);
}

$query_vars = array(
    'post_type' => 'ovelse',
    'post__in' => $posts__in,
    'posts_per_page' => -1,
);

$ovelse_count = (!empty($posts__in)) ? count(get_posts($query_vars)) : 0;

$query_vars['post_type'] = 'forlob';
$forlob_count = (!empty($posts__in)) ? count(get_posts($query_vars)) : 0;

?>
<nav class="site-login-menu">
    <a class="login-name" href="<?php echo get_author_posts_url(get_current_user_id()); ?>">
        <span><?php echo esc_attr($u->display_name); ?></span>
        <svg><use xlink:href="#icon-cog"></use></svg>
    </a>
    <a href="<?php echo $author_base ?>/ovelse/saved/" class="login-ovelse"><span>Gemte øvelser</span><i><?php echo $ovelse_count ?></i></a>
    <a href="<?php echo $author_base ?>/forlob/saved/" class="login-forlob"><span>Gemte forløb</span><i><?php echo $forlob_count ?></i></a>
    <?php if ($create_href) : ?><a href="<?php echo $create_href ?>" class="login-add"><span>Tilføj</span> <svg><use xlink:href="#icon-plus"></use></svg></a><?php endif; ?>
    <a href="<?php echo wp_logout_url(get_bloginfo('url')); ?>" class="login-out"><span>Log ud</span> <svg><use xlink:href="#icon-unlock"></use></svg></a>
</nav>
<?php endif;
