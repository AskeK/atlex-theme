<?php

add_action( 'wp_ajax_google_api_token', 'smamo_google_token' );

function smamo_google_token(){
    $response = array();

    if(get_transient('google_api_token')){

        $response['token'] = get_transient('google_api_token');
        wp_die(json_encode($response));
    }


    else{







    /*
        set_transient('google_api_token',$token, 30 * 60 * 60);
        $response['token'] = get_transient('google_api_token');
        wp_die(json_encode($response));

    */
    }
}
