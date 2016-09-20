<?php

add_action( 'rest_api_init', 'smamo_rest_register_ovelse_meta' );
function smamo_rest_register_ovelse_meta() {

    $fields = array(
        'fb_link' => 'smamo_rest_get_fb_link',
        'tw_link' => 'smamo_rest_get_tw_link',
        'img' => 'smamo_rest_get_img_link',
        'media' => null,
        'images' => null,
    );


    foreach($fields as $field => $callback){

        if($callback === null){
            $callback = 'smamo_rest_get_meta';
        }

        register_rest_field( 'ovelse',
            $field,
            array(
                'get_callback'    => $callback,
                'update_callback' => null,
                'schema'          => null,
            )
        );
    }
}
