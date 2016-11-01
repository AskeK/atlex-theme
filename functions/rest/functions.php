<?php
function smamo_rest_get_meta( $object, $field_name, $request ) {
    return get_post_meta( $object[ 'id' ], $field_name, true );
}

function smamo_rest_get_meta_array( $object, $field_name, $request ) {
    return get_post_meta( $object[ 'id' ], $field_name, false );
}

function smamo_rest_get_user_meta_array( $object, $field_name, $request ) {
    return get_user_meta( $object[ 'id' ], $field_name, false );
}

function smamo_rest_get_fb_link($object,$field_name,$request){
    return smamo_share($id = $object['id'], $platform = 'fb');
}

function smamo_rest_get_tw_link($object,$field_name,$request){
    return smamo_share($id = $object['id'], $platform = 'tw');
}

function smamo_rest_get_author_name($object,$field_name,$request){
    return get_the_author($object['id']);
}

function smamo_rest_get_img_link($object, $field_name, $request){
    $ret = array();
    $image_sizes = get_intermediate_image_sizes();

    foreach($image_sizes as $name){
       $ret[$name] = get_image_link($object['id'],$name);

    }
    return $ret;
}
function smamo_rest_has_cover($object,$field_name,$request){
    return has_post_thumbnail($object['id']);
}
