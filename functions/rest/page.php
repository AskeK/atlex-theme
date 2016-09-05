<?php

add_action( 'rest_api_init', 'smamo_rest_register_page_meta' );
function smamo_rest_register_page_meta() {

    $fields = array(
        'fb_link' => 'smamo_rest_get_fb_link',
        'tw_link' => 'smamo_rest_get_tw_link',
        'img' => 'smamo_rest_get_img_link',
        'description' => null,

    );


    foreach($fields as $field => $callback){

        if($callback === null){
            $callback = 'smamo_rest_get_meta';
        }

        register_rest_field( 'page',
            $field,
            array(
                'get_callback'    => $callback,
                'update_callback' => null,
                'schema'          => null,
            )
        );
    }
}
