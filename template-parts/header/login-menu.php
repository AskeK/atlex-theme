<?php

if (is_user_logged_in()) : $u = wp_get_current_user();

$create_href = false;
$pages = get_pages(array('meta_key' => '_wp_page_template', 'meta_value' => 'templates/create.php', ));
foreach($pages as $p){$create_href = get_permalink($p->ID);}

$author_base = get_author_posts_url(get_current_user_id());

?>
<nav class="site-login-menu">
    <a class="login-name" href="<?php echo get_author_posts_url(get_current_user_id()); ?>">
        <span><?php echo esc_attr($u->display_name); ?></span>
        <svg><use xlink:href="#icon-cog"></use></svg>
    </a>
    <a href="<?php echo $author_base ?>/ovelse/" class="login-ovelse"><span>Øvelser</span><i>3</i></a>
    <a href="<?php echo $author_base ?>/forlob/" class="login-forlob"><span>Forløb</span><i>4</i></a>
    <?php if ($create_href) : ?><a href="<?php echo $create_href ?>" class="login-add"><span>Tilføj</span> <svg><use xlink:href="#icon-plus"></use></svg></a><?php endif; ?>
    <a href="<?php echo wp_logout_url(get_bloginfo('url')); ?>" class="login-out"><span>Log ud</span> <svg><use xlink:href="#icon-unlock"></use></svg></a>
</nav>
<?php endif;
