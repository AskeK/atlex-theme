<header class="site-header">
    <div class="inner">
        <a class="site-header-logo" href="<?php echo esc_url(get_bloginfo('url')); ?>">
            <?php echo esc_attr(get_bloginfo('name')); ?>
            <img src="<?php echo esc_url(get_template_directory_uri()) ?>/statics/logo.png" alt="Logo">
        </a>
        <a href="#" class="site-header-hamburger">
            <svg class="svg-icon icon-menu"><use xlink:href="#icon-menu"></use></svg>
            <svg class="svg-icon icon-close"><use xlink:href="#icon-cross"></use></svg>
        </a>
        <div class="site-header-navs">
            <nav class="site-header-menu">
                <ul>
                    <li><a href=""><svg><use xlink:href="#icon-ovelse"></use></svg><span>Find øvelse</span></a></li>
                    <li><a href=""><svg><use xlink:href="#icon-forlob"></use></svg><span>Find forløb</span></a></li>
                    <li><a href=""><svg><use xlink:href="#icon-atlex"></use></svg><span>Mit atlex</span></a></li>
                </ul>
            </nav>
            <?php if (is_user_logged_in()) : $u = wp_get_current_user(); ?>
            <nav class="site-login-menu">
                <a class="login-name" href="#"><span><?php echo esc_attr($u->display_name); ?></span> <svg><use xlink:href="#icon-cog"></use></svg></a>
                <a href="#" class="login-ovelse"><span>Øvelser</span><i>3</i></a>
                <a href="#" class="login-forlob"><span>Forløb</span><i>4</i></a>
                <a href="#" class="login-add"><span>Tilføj</span> <svg><use xlink:href="#icon-plus"></use></svg></a>
                <a href="#" class="login-out"><span>Log ud</span> <svg><use xlink:href="#icon-unlock"></use></svg></a>
            </nav>
            <?php endif; ?>
            <?php wp_nav_menu(array(
                'container' => 'nav',
                'container_class' => 'site-hamburger-menu',
            )); ?>
        </div>
    </div>
</header>
