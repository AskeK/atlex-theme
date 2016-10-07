<section class="main-section">
    <main>
        <div class="article-pages" data-page="3">
            <div class="article-page article-page-ovelse"></div>
            <div class="article-page article-page-forlob"></div>
            <div class="article-page article-page-single">
                <?php while(have_posts()) { the_post(); get_template_part('template-parts/modules/article'); } ?>
            </div>
        </div>
    </main>
    <aside>
        <?php get_sidebar(); ?>
    </aside>
</section>
