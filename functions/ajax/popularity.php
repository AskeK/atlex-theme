<?php

add_action( 'wp_ajax_update_pop', 'smamo_update_pop' );
add_action( 'wp_ajax_nopriv_update_pop', 'smamo_update_pop' );

function smamo_update_pop(){
    $response = array();

    if(isset($_POST['post_id']) && isset($_POST['value'])){
        $id = esc_attr($_POST['post_id']);
        $val = esc_attr($_POST['value']);

        $pop = (int)get_post_meta($id, 'popularity', true);

        if(!$pop){$pop = 0;}
        $pop += (int)$val;
        if($pop < 0){$pop = 0;}

        update_post_meta($id, 'popularity', $pop);

    }

    wp_die(json_encode($response));
}

