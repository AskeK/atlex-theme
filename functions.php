<?php


get_functions_part(array(
    'menus',
    'scripts',
));

get_functions_part(array(
    'ovelse',
    'forlob',
),'post-types');

// email
function sendEmail( $from_name, $from, $to, $subject, $message ){
    $header = "From: ".$from_name." <".$from.">\r\n";
    $header.= "MIME-Version: 1.0\r\n";
    $header.= "Content-Type: text/html; charset=utf-8\r\n";
    $header.= "X-Priority: 1\r\n";
    $email = wp_mail($to, $subject, $message, $header);
    return $email;
}

// get_functions_part([$filnavn],[$undermappe]);
function smamo_include_functions_part_if_exists($fetch, $in = false){
    if ($in){$fetch = $in . '/' . $fetch;}
    $fetch = get_template_directory() . '/functions/' . $fetch . '.php';
    if(file_exists($fetch)){include_once $fetch;}
}

function get_functions_part($fetch, $in = false){
    if(is_array($fetch)){foreach($fetch as $p){smamo_include_functions_part_if_exists($p,$in);}}
    else{smamo_include_functions_part_if_exists($fetch,$in);}
}


function get_image_link($post_id = false, $size = 'full'){

    if(!$post_id){return;}

    $top_pic = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), $size );
    if(!isset($top_pic[0])){
        $top_pic = array(
            0 => get_template_directory_uri() . '/statics/default.jpg',
        );
    }

    return esc_url($top_pic[0]);
}


// social knapper
function smamo_share($id = false, $platform = false){
    if(!$id || !$platform){return '#';}

    // Facebook
    if('fb' === $platform){
        return 'https://www.facebook.com/sharer/sharer.php?u=' . get_permalink($id);
    }

    // Twitter
    if('tw' === $platform){
        return 'https://twitter.com/intent/tweet?url=' . urlencode(get_permalink($id));
    }
}
