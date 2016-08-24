<?php $GLOBALS['current_id'] = 0; ?>
<section class="main-section">
    <main>
        <?php while(have_posts()) { the_post(); get_template_part('template-parts/modules/article'); } ?>
    </main>
    <aside>
        <?php get_sidebar(); ?>
    </aside>
</section>
