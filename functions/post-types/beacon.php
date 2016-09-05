<?php

add_action( 'init', 'smamo_add_beacons' );

function smamo_add_beacons() {
	register_post_type( 'beacon', array(

        'menu_icon' 		 => 'dashicons-share-alt',
		'public'             => false,
		'publicly_queryable' => false,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'beacon' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => 22,
		'supports'           => array( 'title'),
        'labels'             => array(

            'name'               => _x( 'Beacons', 'post type general name', 'smamo' ),
            'singular_name'      => _x( 'Beacon', 'post type singular name', 'smamo' ),
            'menu_name'          => _x( 'Beacons', 'admin menu', 'smamo' ),
            'name_admin_bar'     => _x( 'Beacons', 'add new on admin bar', 'smamo' ),
            'add_new'            => _x( 'Tilføj ny ', 'beacon', 'smamo' ),
            'add_new_item'       => __( 'Tilføj ny', 'smamo' ),
            'new_item'           => __( 'Ny beacon', 'smamo' ),
            'edit_item'          => __( 'Rediger', 'smamo' ),
            'view_item'          => __( 'Se beacon', 'smamo' ),
            'all_items'          => __( 'Se alle', 'smamo' ),
            'search_items'       => __( 'Find beacon', 'smamo' ),
            'parent_item_colon'  => __( 'Forældre:', 'smamo' ),
            'not_found'          => __( 'Start med at oprette et nyt beacon.', 'smamo' ),
            'not_found_in_trash' => __( 'Papirkurven er tom.', 'smamo' ),
            ),
	   )
    );
}
