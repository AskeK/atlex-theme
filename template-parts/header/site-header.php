<header class="site-header">
    <div class="inner">
        <a class="site-header-logo" href="<?php echo esc_url(get_bloginfo('url')); ?>">
            <?php echo esc_attr(get_bloginfo('name')); ?>
            <svg viewBox="0 0 254 50"><use xlink:href="#vector-logo"></use></svg>
        </a>
        <a href="#" class="site-header-hamburger">
            <svg class="svg-icon icon-menu"><use xlink:href="#icon-menu"></use></svg>
            <svg class="svg-icon icon-close"><use xlink:href="#icon-cross"></use></svg>
        </a>
        <div class="site-header-navs">
            <nav class="site-header-menu">
                <ul>
                    <li>
                        <a href="<?php echo get_bloginfo('url') ?>/ovelse/">
                            <svg viewBox="0 0 50 50"><use xlink:href="#icon-alle-ovelser"></use></svg>
                            <span>Alle øvelser</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo get_bloginfo('url') ?>/forlob/">
                            <svg viewBox="0 0 50 50"><use xlink:href="#icon-alle-forlob"></use></svg>
                            <span>Alle forløb</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo get_bloginfo('url') ?>/mit-atlex/">
                            <svg viewBox="0 0 50 50"><use xlink:href="#icon-mit-atlex"></use></svg>
                            <span>Mit atlex</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo get_bloginfo('url') ?>/app/">
                            <svg viewBox="0 0 50 50"><use xlink:href="#icon-get-app"></use></svg>
                            <span>Hent app</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <?php if (is_user_logged_in()) : $u = wp_get_current_user(); ?>
            <nav class="site-login-menu">
                <a class="login-name" href="#"><span><?php echo esc_attr($u->display_name); ?></span> <svg><use xlink:href="#icon-cog"></use></svg></a>
                <a href="#" class="login-ovelse"><span>Øvelser</span><i>3</i></a>
                <a href="#" class="login-forlob"><span>Forløb</span><i>4</i></a>
                <a href="#" class="login-add"><span>Tilføj</span> <svg><use xlink:href="#icon-plus"></use></svg></a>
                <a href="<?php echo wp_logout_url(get_bloginfo('url')); ?>" class="login-out"><span>Log ud</span> <svg><use xlink:href="#icon-unlock"></use></svg></a>
            </nav>
            <?php endif; ?>
            <?php wp_nav_menu(array(
                'theme_location' => 'main-menu',
                'container' => 'nav',
                'container_class' => 'site-hamburger-menu',
            )); ?>
        </div>
    </div>
</header>
