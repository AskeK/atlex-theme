<section class="main-section">
    <main>
    <?php
        $posts = new WP_Query(array('post_type' => 'page', 'orderby' => 'menu_order', 'post__in' => get_tree_array($GLOBALS['current_id'])));
        while($posts->have_posts()){$posts->the_post();
            get_template_part('template-parts/modules/article');
        }

        ?>
    </main>

    <aside>
        <?php get_sidebar(); ?>
    </aside>
</section>
