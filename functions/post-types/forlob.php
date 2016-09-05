<?php

add_action( 'init', 'smamo_add_forlob' );

function smamo_add_forlob() {
	register_post_type( 'forlob', array(

        'menu_icon' 		 => 'dashicons-list-view',
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'forlob' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 22,
		'supports'           => array( 'title', 'thumbnail', 'author', 'editor'),
        'show_in_rest'       => true,
  		'rest_base'          => 'forlob',
  		'rest_controller_class' => 'WP_REST_Posts_Controller',
        'labels'             => array(

            'name'               => _x( 'Forløb', 'post type general name', 'smamo' ),
            'singular_name'      => _x( 'Forløb', 'post type singular name', 'smamo' ),
            'menu_name'          => _x( 'Forløb', 'admin menu', 'smamo' ),
            'name_admin_bar'     => _x( 'Forløb', 'add new on admin bar', 'smamo' ),
            'add_new'            => _x( 'Tilføj ny ', 'forløb', 'smamo' ),
            'add_new_item'       => __( 'Tilføj ny', 'smamo' ),
            'new_item'           => __( 'Nyt forløb', 'smamo' ),
            'edit_item'          => __( 'Rediger', 'smamo' ),
            'view_item'          => __( 'Se forløb', 'smamo' ),
            'all_items'          => __( 'Se alle', 'smamo' ),
            'search_items'       => __( 'Find forløb', 'smamo' ),
            'parent_item_colon'  => __( 'Forældre:', 'smamo' ),
            'not_found'          => __( 'Start med at oprette et nyt forløb.', 'smamo' ),
            'not_found_in_trash' => __( 'Papirkurven er tom.', 'smamo' ),
            ),
	   )
    );
}
