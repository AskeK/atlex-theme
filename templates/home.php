<?php get_template_part('template-parts/sections/hero-banner');?>
<section class="main-section">
    <main>
        <div class="article-pages" data-page="1">
            <div class="article-page article-page-ovelse">
                <?php

                    $ovelser = new WP_Query(array(
                        'post_type' => 'ovelse',
                        'posts_per_page' => -1,
                        'orderby' => 'meta_value_num',
                        'meta_key' => 'popularity',
                        'order' => 'DESC',
                    ));


                    $i = 0;
                    while($ovelser->have_posts()) :

                        $ovelser->the_post();

                        $i++;
                        if ($i === 1){

                            get_template_part('template-parts/article/article-page-header');
                        }


                        get_template_part('template-parts/modules/article');

                    endwhile;

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
