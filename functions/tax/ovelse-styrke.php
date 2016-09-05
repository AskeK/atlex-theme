<?php

add_action( 'init', 'smamo_add_styker', 0 );

function smamo_add_styker() {
	$labels = array(
		'name'              => _x( 'Styrkeområder', 'taxonomy general name' ),
		'singular_name'     => _x( 'Område', 'taxonomy singular name' ),
		'search_items'      => __( 'Søg i Styrkeområder' ),
		'all_items'         => __( 'Alle Styrkeområder' ),
		'parent_item'       => __( 'Forælder' ),
		'parent_item_colon' => __( 'Forælder:' ),
		'edit_item'         => __( 'Rediger område' ),
		'update_item'       => __( 'Opdater område' ),
		'add_new_item'      => __( 'Tilføj nyområde' ),
		'new_item_name'     => __( 'Nyområde' ),
		'menu_name'         => __( 'Styrkeområder' ),
	);

	$args = array(
        'public'            => false,
		'hierarchical'      => true,
		'labels'            => $labels,
        'show_ui'           => true,
		'show_in_menu'      => true,
        'show_in_nav_menus' => false,
        'show_in_quick_edit'=> false,
		'show_admin_column' => false,
        'description'       => false,
		'query_var'         => false,
		'rewrite'           => array( 'slug' => 'styrke' ),
        'show_in_rest'       => true,
  		'rest_base'          => 'styrke',
  		'rest_controller_class' => 'WP_REST_Terms_Controller',
	);

	register_taxonomy( 'styrke', array( 'ovelse' ), $args );

}
