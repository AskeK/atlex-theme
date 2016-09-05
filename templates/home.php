<?php get_template_part('template-parts/sections/hero-banner');?>
<section class="main-section">
    <main>
        <?php
        $ovelser = new WP_Query(array(
            'post_type' => 'ovelse',
            'posts_per_page' => -1,

        ));
        while($ovelser->have_posts()) : $ovelser->the_post(); get_template_part('template-parts/modules/article'); endwhile;

        ?>
    </main>
    <aside>
        <?php get_sidebar(); ?>
    </aside>
</section>
