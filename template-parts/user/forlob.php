<div class="article-pages" data-page="2">
    <div class="article-page article-page-ovelse"></div>
    <div class="article-page article-page-forlob">
<?php

$q = (isset($wp_query->query_vars['usr_subpage'])) ? esc_attr(urldecode($wp_query->query_vars['usr_subpage'])) : false;

switch ($q){

    case 'saved' :
        $posts__in = array();
        $ids = get_user_meta(get_current_user_id(),'saved_posts',false);
        foreach($ids as $id){
            array_push($posts__in,$id);
        }

        $query_vars = array(
            'post_type' => 'forlob',
            'post__in' => $posts__in,
            'posts_per_page' => -1,
        );

        break;

    case 'draft' :
        $query_vars = array(
            'post_type' => 'forlob',
            'post_status' => 'draft',
            'post_author' => get_current_user_id(),
            'posts_per_page' => -1,
        );
        break;

    default :
        $query_vars = array(
            'post_type' => 'forlob',
            'post_status' => 'publish',
            'post_author' => get_the_author(),
            'posts_per_page' => -1,
        );
        break;
}


if ('saved' !== $q || !empty($ids)){

    $forlob = new WP_Query($query_vars);

    if ($forlob->have_posts()) : while($forlob->have_posts()) : $forlob->the_post();

    get_template_part('template-parts/modules/article');

    endwhile; else :

    get_template_part('template-parts/modules/article-no-posts');

    endif; wp_reset_postdata();
}

else{
    get_template_part('template-parts/modules/article-no-posts');
}

?>
    </div>
    <div class="article-page article-page-single"></div>
</div>
