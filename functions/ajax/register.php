<?php

add_action( 'wp_ajax_register', 'smamo_register' );
add_action( 'wp_ajax_nopriv_register', 'smamo_register' );

function smamo_register(){
    $response = array();

    $v = array();
    $post_vars = array(
        'usr' => 'Brugernavn',
        'email' => 'Email',
        'fname' => 'Fornavn',
        'lname' => 'Efternavn',
        'pass' => 'Adgangskode',
    );

    foreach( $post_vars as $key => $val){

        if (!isset($_POST[$key]) || '' === str_replace(' ','',esc_attr($_POST[$key]))){
            $response['error'] = 'Udfyld venligst dette felt korrekt: ' . $val;
            wp_die(jeson_encode($response));
        }

        else{
            $v[$key] = esc_attr($_POST[$key]);
        }
    }


    // Opret bruger
    $user_id = wp_insert_user( array(
        'user_login'  =>  $v['usr'],
        'user_email'    =>  $v['email'],
        'first_name'    =>  $v['fname'],
        'last_name'    =>  $v['lname'],
        'user_pass'   =>  $v['pass']
    ) ) ;

    if(is_wp_error($user_id)){
        $response['error'] = $user_id->get_error_message();
        wp_die(json_encode($response));
    }

    // Log ind
    $signon = wp_signon(array(
        'user_login' => $v['usr'],
        'user_password' => $v['pass'],
        'remember' => 1,
    ));

    if(is_wp_error($signon)){
        $response['error'] = $signon->get_error_message();
        wp_die(json_encode($response));
    }

    $response['user_id'] = $user_id;
    wp_die(json_encode($response));
}

