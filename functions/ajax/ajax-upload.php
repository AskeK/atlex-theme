<?php

function upload_user_file( $file = array() ) {


    $file_return = wp_handle_upload( $file, array('test_form' => false ) );

    $function_return = false;

    if( isset( $file_return['error'] ) || isset( $file_return['upload_error_handler'] ) ) {
        return false;
    }

    else {

        $filename = $file_return['file'];

        $attachment = array(
            'post_mime_type' => $file_return['type'],
            'post_title' => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
            'post_content' => '',
            'post_status' => 'inherit',
            'guid' => $file_return['url']
        );

        $attachment_id = wp_insert_attachment( $attachment, $file_return['url'] );

        $attachment_data = wp_generate_attachment_metadata( $attachment_id, $filename );
        wp_update_attachment_metadata( $attachment_id, $attachment_data );

        if( 0 < intval( $attachment_id ) ) {

			$image_url = wp_get_attachment_image_src( $attachment_id, 'dz');


			$function_return = array(
                'id'=>$attachment_id,
                'url'=>$image_url[0],
            );
        }
    }

    return $function_return;
}


add_action( 'wp_ajax_file_upload', 'smamo_file_upload' );

function smamo_file_upload(){

    if(isset($_POST['delete'])){

        $id = esc_attr($_POST['delete']);

        $response['return'] = wp_delete_attachment( $id, true );

        wp_die(json_encode($response));

        if(isset($_POST['post_id'])){
            delete_post_meta(esc_attr($_POST['post_id']), 'images', $id);
        }
    }


    else{
        header('Content-type: application/json');

        $response = array();

        $atts = array();

        if( ! empty( $_FILES ) ) {
            foreach( $_FILES as $file ) {
                if( is_array( $file ) ) {
                    $atts[] = upload_user_file( $file );
                }
            }
        }


        $response['files'] = $atts;
        wp_die(json_encode($response));
    }
}
