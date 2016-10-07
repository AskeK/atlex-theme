<div class="article-pages" data-page="1">
    <div class="article-page article-page-ovelse">
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
            'post_type' => 'ovelse',
            'post__in' => $posts__in,
            'posts_per_page' => -1,
        );

        break;

    case 'draft' :
        $query_vars = array(
            'post_type' => 'ovelse',
            'post_status' => 'draft',
            'post_author' => get_current_user_id(),
            'posts_per_page' => -1,
        );
        break;

    default :
        $query_vars = array(
            'post_type' => 'ovelse',
            'post_status' => 'publish',
            'post_author' => get_the_author(),
            'posts_per_page' => -1,
        );
        break;
}

if ('saved' !== $q || !empty($ids)){

    $posts = new WP_Query($query_vars);

    if ($posts->have_posts()) : while($posts->have_posts()) : $posts->the_post();

    get_template_part('template-parts/modules/article');

    endwhile; else:

    get_template_part('template-parts/modules/article-no-posts');

    endif; wp_reset_postdata();

}


else{
    get_template_part('template-parts/modules/article-no-posts');
}
?>
    </div>
    <div class="article-page article-page-forlob"></div>
    <div class="article-page article-page-single"></div>
</div>
