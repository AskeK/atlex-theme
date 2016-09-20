<?php

add_action( 'wp_ajax_get_posts', 'smamo_get_posts' );
add_action( 'wp_ajax_nopriv_get_posts', 'smamo_get_posts' );

function smamo_get_posts(){
    $response = array();
    $response['post_vars'] = $_POST;

    $post_vars = array();
    foreach($_POST as $key => $var){
        $post_vars[esc_attr($key)] = esc_attr($var);
    }

    $posts = get_posts($post_vars);
    $response['posts'] = array();
    $response['post_meta'] = array();

    foreach($posts as $post){

        $response['post_meta'][$post->ID] = get_post_meta($post->ID, '', false);
        $response['posts'][$post->ID] = $post;

    }


    wp_die(json_encode($response));
}
