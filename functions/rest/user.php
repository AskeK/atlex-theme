<?php


add_action( 'rest_api_init', 'smamo_rest_register_user_meta' );
function smamo_rest_register_user_meta() {

    $fields = array(
        'saved_posts' => 'smamo_rest_get_user_meta_array',
    );


    foreach($fields as $field => $callback){

        if($callback === null){
            $callback = 'smamo_rest_get_meta';
        }

        register_rest_field( 'user',
            $field,
            array(
                'get_callback'    => $callback,
                'update_callback' => null,
                'schema'          => null,
            )
        );
    }
}
