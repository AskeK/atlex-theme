<?php $GLOBALS['current_id'] = 0;?>
<section class="main-section">
    <main>
        <div class="article-pages" data-page="<?php echo ('ovelse' === get_post_type(get_the_ID())) ? '1':'2'; ?>">
            <div class="article-page article-page-ovelse">
                <?php
                if ('ovelse' === get_post_type(get_the_ID())) {
                    $i = 0;
                    while(have_posts()) {
                        the_post();
                        $i++;
                        if ($i === 1){ get_template_part('template-parts/article/article-page-header'); }
                        get_template_part('template-parts/modules/article');
                    }
                }?>
            </div>
            <div class="article-page article-page-forlob">
                <?php if ('forlob' === get_post_type(get_the_ID())) {
                    $i = 0;
                    while(have_posts()) {
                        the_post();
                        $i++;
                        if ($i === 1){ get_template_part('template-parts/article/article-page-header'); }
                        get_template_part('template-parts/modules/article');
                    }
                }?>
            </div>
            <div class="article-page article-page-single">
            </div>
        </div>
    </main>
    <aside>
        <?php get_sidebar(); ?>
    </aside>
</section>
