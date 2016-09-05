<?php

add_action( 'init', 'smamo_register_ovelse_type', 0 );

function smamo_register_ovelse_type() {
	$labels = array(
		'name'              => _x( 'Øvelsestyper', 'taxonomy general name' ),
		'singular_name'     => _x( 'Type', 'taxonomy singular name' ),
		'search_items'      => __( 'Søg i Typer' ),
		'all_items'         => __( 'Alle Typer' ),
		'parent_item'       => __( 'Forælder' ),
		'parent_item_colon' => __( 'Forælder:' ),
		'edit_item'         => __( 'Rediger type' ),
		'update_item'       => __( 'Opdater type' ),
		'add_new_item'      => __( 'Tilføj nytype' ),
		'new_item_name'     => __( 'Ny type' ),
		'menu_name'         => __( 'Typer' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'type' ),
        'show_in_rest'       => true,
  		'rest_base'          => 'o_type',
  		'rest_controller_class' => 'WP_REST_Terms_Controller',
	);

	register_taxonomy( 'type', array( 'ovelse' ), $args );

}
