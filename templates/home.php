<?php get_template_part('template-parts/sections/hero-banner');?>
<section class="main-section">
    <main>
        <header class="main-header">

        </header>
        <div class="article-pages" data-page="1">
            <div class="article-page article-page-ovelse">
                <?php
                    $ovelser = new WP_Query(array(
                        'post_type' => 'ovelse',
                        'posts_per_page' => -1,
                        'orderby' => 'meta_value_num',
                        'meta_key' => 'popularity',

                    ));
                    while($ovelser->have_posts()) : $ovelser->the_post(); get_template_part('template-parts/modules/article'); endwhile;

                    ?>
            </div>
            <div class="article-page article-page-forlob"></div>
            <div class="article-page article-page-single"></div>
        </div>
    </main>
    <aside>
        <?php get_sidebar(); ?>
    </aside>
</section>
