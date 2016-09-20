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

// Thumbnail
if(isset($_POST['cover-photo'])){
    set_post_thumbnail( $p, esc_attr($_POST['cover-photo']) );
}


/* Felter til Øvelser
-------------------------*/
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


    // Styrkeområder
    $styrker = array();
    if(isset($_POST['styrke']) && is_array($_POST['styrke']) && !empty($_POST['styrke'])){
        $styrker = $_POST['styrke'];
    }
    wp_set_post_terms( $p, $styrker, 'styrke', false );

    // Medier
    $media_array = array();
    if(isset($_POST['images']) && is_array($_POST['images']) && !empty($_POST['images'])){
        foreach($images as $img){
            $media_array[] = esc_attr($img);
        }
    }
    update_post_meta($p,'images',$media_array);
}
