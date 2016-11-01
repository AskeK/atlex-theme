<section class="main-section">
    <main>
    <?php

        $usr_page = (isset($wp_query->query_vars['usr_page'])) ? esc_attr(urldecode($wp_query->query_vars['usr_page'])) : false;
        $locate = locate_template('template-parts/user/' . $usr_page . '.php');

        $private_pages = array(
            'edit',
            'profile',
            'settings',
        );

        $cur_user = (int)get_current_user_id();
        global $post; $cur_author = (int)get_query_var('author');


        if($cur_user === $cur_author && $locate !== ''){
            get_template_part('template-parts/user/' . $usr_page);
        }

        elseif($cur_user !== $cur_author && $locate !== '' && !in_array($usr_page, $private_pages)){
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
