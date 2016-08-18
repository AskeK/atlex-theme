<?php

add_action('wp_enqueue_scripts','theme_enqueue_scripts');
function theme_enqueue_scripts(){

    wp_enqueue_style( 'theme-style', get_template_directory_uri() . '/style/style.css', false, false, 'all' );

    wp_deregister_script('jquery');
    wp_register_script('jquery','//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js',array(),'1',true);
    wp_enqueue_script('jquery');

    wp_enqueue_script( 'wp-api' );

    wp_enqueue_script('theme-script', get_template_directory_uri() . '/script/script-min.js' , array('jquery','wp-api'), '1', true);

}
