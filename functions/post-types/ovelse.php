<?php

add_action( 'init', 'smamo_add_ovelse' );

function smamo_add_ovelse() {
	register_post_type( 'ovelse', array(

        'menu_icon' 		 => 'dashicons-businessman',
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'ovelse' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 22,
		'supports'           => array( 'title'),
        'show_in_rest'       => true,
  		'rest_base'          => 'ovelse',
  		'rest_controller_class' => 'WP_REST_Posts_Controller',
        'labels'             => array(

            'name'               => _x( 'Øvelser', 'post type general name', 'smamo' ),
            'singular_name'      => _x( 'Øvelse', 'post type singular name', 'smamo' ),
            'menu_name'          => _x( 'Øvelser', 'admin menu', 'smamo' ),
            'name_admin_bar'     => _x( 'Øvelser', 'add new on admin bar', 'smamo' ),
            'add_new'            => _x( 'Tilføj ny ', 'øvelse', 'smamo' ),
            'add_new_item'       => __( 'Tilføj ny', 'smamo' ),
            'new_item'           => __( 'Ny øvelse', 'smamo' ),
            'edit_item'          => __( 'Rediger', 'smamo' ),
            'view_item'          => __( 'Se øvelse', 'smamo' ),
            'all_items'          => __( 'Se alle', 'smamo' ),
            'search_items'       => __( 'Find øvelse', 'smamo' ),
            'parent_item_colon'  => __( 'Forældre:', 'smamo' ),
            'not_found'          => __( 'Start med at oprette en ny øvelse.', 'smamo' ),
            'not_found_in_trash' => __( 'Papirkurven er tom.', 'smamo' ),
            ),
	   )
    );
}
