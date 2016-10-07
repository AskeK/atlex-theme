<nav class="site-header-menu">
    <ul>
        <li>
            <a class="forlob-link" href="<?php echo get_bloginfo('url') ?>/ovelse/">
                <svg viewBox="0 0 50 50"><use xlink:href="#icon-alle-ovelser"></use></svg>
                <span>Alle øvelser</span>
            </a>
        </li>
        <li>
            <a class="forlob-link" href="<?php echo get_bloginfo('url') ?>/forlob/">
                <svg viewBox="0 0 50 50"><use xlink:href="#icon-alle-forlob"></use></svg>
                <span>Alle forløb</span>
            </a>
        </li>
        <?php $u_href = false;

        if (is_user_logged_in()) {$u_href = get_author_posts_url(get_current_user_id());}
        else{
            $pages = get_pages(array('meta_key' => '_wp_page_template', 'meta_value' => 'templates/register.php', ));
            foreach($pages as $p){$u_href = get_permalink($p->ID);}
        }
        if ($u_href) : ?>
        <li>
            <a class="login-link" href="<?php echo $u_href; ?>">
                <svg viewBox="0 0 50 50"><use xlink:href="#icon-mit-atlex"></use></svg>
                <span>Mit atlex</span>
            </a>
        </li>
        <?php endif;
        $app_href = false;
        $pages = get_pages(array('meta_key' => '_wp_page_template', 'meta_value' => 'templates/app-page.php', ));
        foreach($pages as $p){$app_href = get_permalink($p->ID);}
        if ($app_href) : ?>
        <li>
            <a class="get-app-link" href="<?php echo $app_href ?>">
                <svg viewBox="0 0 50 50"><use xlink:href="#icon-get-app"></use></svg>
                <span>Hent app</span>
            </a>
        </li>
        <?php endif; ?>
    </ul>
</nav>
