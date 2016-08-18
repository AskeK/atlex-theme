<section class="main-section">
    <main>
        <?php
        get_template_part('template-parts/modules/main-header');

        $GLOBALS['current_id'] = get_the_ID();
        $parents = get_post_ancestors( $GLOBALS['current_id'] );
        $parent_id = ($parents) ? $parents[count($parents)-1]: $GLOBALS['current_id'];


        $posts = array($parent_id);
        foreach(get_posts(array('post_type' => array('post','page'), 'post_parent' => $parent_id)) as $p){
            array_push($posts,$p->ID);
        }


        $p = new WP_Query(array(
            'post_type' => array('post','page'),
            'post__in' => $posts,
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

    </aside>
</section>
