<?php
$GLOBALS['current_id'] = 0;
$articles = new WP_Query(array(
    'post_type' => array('ovelse'),
));

get_template_part('template-parts/sections/hero-banner');

?>
<section class="main-section">
    <main>
        <?php
            while($articles->have_posts()) {
                $articles->the_post();
                get_template_part('template-parts/modules/article');
            }
            wp_reset_postdata();
        ?>
    </main>

    <aside>
        <?php get_sidebar(); ?>
    </aside>
</section>
