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
            <?php get_template_part('template-parts/header/site-header-menu') ?>
            <?php get_template_part('template-parts/header/login-menu') ?>
            <?php wp_nav_menu(array(
                'theme_location' => 'main-menu',
                'container' => 'nav',
                'container_class' => 'site-hamburger-menu',
            )); ?>
        </div>
    </div>
</header>
