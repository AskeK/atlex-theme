<?php

add_filter( 'display_post_states', 'smamo_template_state', 10, 2 );
function smamo_template_state($post_states, $post){

    $templates = get_page_templates();
    if('page' === get_post_type($post->ID)){

        foreach($templates as $name => $slug){
            if($slug === get_page_template_slug($post->ID)){
                $post_states[] = $name;
            }
        }
    }
    return $post_states;
}
