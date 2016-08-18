<header class="site-header">
    <div class="inner">
        <a class="site-header-logo" href="<?php echo esc_url(get_bloginfo('url')); ?>">
            <?php echo esc_attr(get_bloginfo('name')); ?>
            <img src="<?php echo esc_url(get_template_directory_uri()) ?>/statics/logo.png" alt="Logo">
        </a>
        <nav class="site-header-menu">
            <ul>
                <li><a href=""><svg><use xlink:href="#icon-ovelse"></use></svg><span>Find øvelse</span></a></li>
                <li><a href=""><svg><use xlink:href="#icon-forlob"></use></svg><span>Find forløb</span></a></li>
                <li><a href=""><svg><use xlink:href="#icon-atlex"></use></svg><span>Mit atlex</span></a></li>
            </ul>
        </nav>

        <a href="#" class="site-header-hamburger">
            <svg class="svg-icon icon-menu"><use xlink:href="#icon-menu"></use></svg>
            <svg class="svg-icon icon-close"><use xlink:href="#icon-cross"></use></svg>
        </a>
    </div>
</header>
