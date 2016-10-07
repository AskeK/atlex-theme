<?php

add_action( 'wp_ajax_save_user_meta', 'smamo_save_user_meta' );

function smamo_save_user_meta(){

    $response = array();

    $remove = esc_attr($_POST['remove']);
    $user_id = get_current_user_id();
    $meta_key = esc_attr($_POST['key']);
    $meta_value = esc_attr($_POST['value']);
    $unique = (isset($_POST['unique']) && $_POST['unique'] === 'true') ? true : false;


    $response['post_vars'] = $_POST;

    if($remove === 'true'){
        $response['action'] = 'removing from saved_posts';
        $response['result'] = delete_user_meta( $user_id, $meta_key, $meta_value );

    }

    else{
        $response['action'] = 'adding to saved_posts';
        $response['result'] = add_user_meta( $user_id, $meta_key, $meta_value, $unique);

    }

    // ved saved_posts, opdater posts save count
    if($meta_key === 'saved_posts'){

        $count = get_post_meta($meta_value, 'saved_count', true);
        $pop = get_post_meta($meta_value, 'popularity', true);

        $response['count-before'] = $count;
        $response['popularity-before'] = $pop;

        if(!$count){$count = 0;}
        if(!$pop){$pop = 0;}

        if($remove === 'true'){

            $count --;
            $pop -= 10;

            if($count < 0){$count = 0;}
            if($pop < 0){$pop = 0;}
        }

        else{
            $count ++;
            $pop += 10;
        }

        update_post_meta($meta_value, 'saved_count', $count);
        update_post_meta($meta_value, 'popularity', $pop);

        $response['saved-count'] = $count;

        $response['saved-pop'] = $pop;
    }

    wp_die(json_encode($response));
}
