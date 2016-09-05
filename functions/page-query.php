<?php

add_filter('request','smamo_page_query');
function smamo_page_query($query){
    var_dump($query);
    if (isset($query['page'])){


        $GLOBALS['current_id'] = get_queried_object_id();
        $parents = get_post_ancestors( $GLOBALS['current_id'] );
        $parent_id = ($parents) ? $parents[count($parents)-1]: $GLOBALS['current_id'];


        $posts = array($parent_id);
        foreach(get_posts(array('post_type' => array('post','page'), 'post_parent' => $parent_id)) as $p){
            array_push($posts,$p->ID);
        }

        $new = array(
            'post__in' => $posts,
        );

        var_dump($new);
        return $new;
    }
}
