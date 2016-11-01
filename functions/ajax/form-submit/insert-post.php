<?php

// Type
if (!isset($_POST['post-type'])){
    $response['error'] = 'please specify post type.';
    wp_die(json_encode($response));
}
$post_type = esc_attr($_POST['post-type']);


// Titel
if (!isset($_POST['title'])){
    $response['error'] = 'please specify post title.';
    wp_die(json_encode($response));
}

$post_title = esc_attr($_POST['title']);

// ID (eller false, opret ny)
$post_id = (isset($_POST['post-id'])) ? esc_attr($_POST['post-id']) : 0;

// Indhold
$post_content = (isset($_POST['content'])) ? esc_textarea($_POST['content']) : '';

// Status
$post_status = (isset($_POST['draft'])) ? 'draft' : 'publish';


// Opret eller Opdater
$p = wp_insert_post(
    array(
        'ID'             => $post_id,
        'post_content'   => $post_content,
        'post_title'     => $post_title,
        'post_status'    => $post_status,
        'post_type'      => $post_type,
    ), true
);

// Returner evt. fejl
if (is_wp_error($p)){
    $response['error'] = $p->get_error_message;
    wp_die($response);
}

$response['post_id'] = $p;
$response['post_status'] = $post_status;

// Thumbnail
if(isset($_POST['coverphoto'])){
    set_post_thumbnail( $p, esc_attr($_POST['coverphoto']) );
}


// Felter til Øvelser
if ('ovelse' === $post_type){

    // Tid
    if(isset($_POST['time'])){
        update_post_meta($p,'time',esc_attr($_POST['time']));
    }

    // Øvelsestyper
    $typer = array();
    if(isset($_POST['type']) && is_array($_POST['type']) && !empty($_POST['type'])){
        $typer = $_POST['type'];
    }
    wp_set_post_terms( $p, $typer, 'type', false );


    // beacon
    if(isset($_POST['beacon'])){
        update_post_meta($p,'beacon',esc_attr($_POST['beacon']));
        update_post_meta($p,'beacon_active','active');
    }
    else{
        delete_post_meta($p,'beacon');
        delete_post_meta($p,'beacon_active');
    }

    // Styrkeområder
    $styrker = array();
    if(isset($_POST['styrke']) && is_array($_POST['styrke']) && !empty($_POST['styrke'])){
        $styrker = $_POST['styrke'];
    }
    wp_set_post_terms( $p, $styrker, 'styrke', false );

    // Medier
    if(isset($_POST['images']) && is_array($_POST['images']) && !empty($_POST['images'])){

        delete_post_meta($p,'images');
        foreach($_POST['images'] as $img){

            if (wp_get_attachment_url( $img )){
                add_post_meta($p, 'images', $img, false);
            }
        }
    }
}


// Felter til forløb
if('forlob' === $post_type){

    // Øvelser
    $attach_ovelse = array();
    if(isset($_POST['attach_ovelse']) && is_array($_POST['attach_ovelse']) && !empty($_POST['attach_ovelse'])){

        // popularity - 5
        $ovelser = get_post_meta($p,'attach_ovelse',false);
        if(!empty($ovelser)){
            foreach($ovelser as $o){
                $pop = get_post_meta($o, 'popularity', true);
                if(!$pop){
                    $pop = 0;
                }
                else{
                    $pop -= 5;
                    if($pop < 0){$pop = 0;}
                }
                update_post_meta($o, 'popularity', $pop, true);
            }
        }

        delete_post_meta($p,'attach_ovelse');

        foreach($_POST['attach_ovelse'] as $ovelse){
            array_push($attach_ovelse, $ovelse);
            add_post_meta($p, 'attach_ovelse', $ovelse, false);

            // popularity +5
            $pop = get_post_meta($ovelse, 'popularity', true);

            if(!$pop){
                $pop = 0;
            }

            $pop += 5;

            update_post_meta($ovelse, 'popularity', $pop, true);

            if($post_status === 'publish'){

                $set_status = wp_update_post(array(
                    'ID' => $ovelse,
                    'post_status' => 'publish',
                ));

                $response['update_post_status'] = $set_status;
            }
        }
    }
}
