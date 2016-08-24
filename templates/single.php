<section class="main-section">
    <main>
        <?php
        get_template_part('template-parts/modules/main-header');

        $GLOBALS['current_id'] = get_the_ID();

        $p = new WP_Query(array(
            'post_type' => get_post_type(get_the_ID()),
            'orderby' => 'parent',
            'order' => 'ASC',
        ));

        while($p->have_posts()){
            $p->the_post();
            get_template_part('template-parts/modules/article');

        }

        ?>
    </main>
    <aside>
        <?php get_sidebar(); ?>
    </aside>
</section>
