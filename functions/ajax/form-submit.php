<?php
add_action( 'wp_ajax_form_submit', 'smamo_form_submit' );

function smamo_form_submit(){
    $response = array();
    if (!isset($_POST['do'])){
        $response['error'] = 'Please specify what to do.';
        $response['error_code'] = '404';
        wp_die(json_encode($response));
    }

    include get_template_directory() . '/functions/ajax/form-submit/' . esc_attr($_POST['do']) . '.php';
    wp_die(json_encode($response));
}

