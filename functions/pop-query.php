<?php

function smamo_pop_query( $query ) {

    if(!$query->is_main_query() && !$query->is_admin()){
        return;
    }

    $query->set('meta_query', array(
        'relation' => 'OR',
        array(
            'key' => 'popularity',
            'compare' => 'NOT EXISTS',
        ),
        array(
            'key' => 'popularity',
            'compare' => 'EXISTS',
        )
      ));
      $query->set('orderby', array('meta_value_num' => 'DESC', 'date' => 'DESC'));
}
add_action( 'pre_get_posts', 'smamo_pop_query' );
