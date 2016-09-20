<section class="main-section">
    <main>
    <?php

        $usr_page = (isset($wp_query->query_vars['usr_page'])) ? esc_attr(urldecode($wp_query->query_vars['usr_page'])) : false;
        $locate = locate_template('template-parts/user/' . $usr_page . '.php');

        if($locate !== ''){
            get_template_part('template-parts/user/' . $usr_page);
        }

        else{
            get_template_part('template-parts/user/home');
        }
    ?>
    </main>
    <aside>
        <?php get_sidebar(); ?>
    </aside>
</section>
