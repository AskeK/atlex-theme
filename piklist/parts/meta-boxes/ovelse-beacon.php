<?php

/*

Title: Tilknyt beacon
Post Type: ovelse
scope: post_meta
order: 40

*/

$beacon_q = get_posts(array(
    'post_type' => 'beacon',
    'posts_per_page' => -1,
));

if(!empty($beacon_q)){

    $beacons = array(
        '0' => 'Vælg beacon',
    );

    foreach($beacon_q as $b){
        $beacons[$b->ID] = $b->post_title;
    }

    piklist('field',array(
        'type' => 'checkbox',
        'field' => 'beacon_active',
        'label' => 'Aktiver beacon',
        'choices' => array(
            'active' => 'Tilknyt beacon til denne øvelse',
        ),
    ));

    piklist('field',array(
        'type' => 'select',
        'field' => 'beacon',
        'label' => 'Vælg beacon fra listen',
        'choices' => $beacons,
        'conditions' => array(
            array(
                'field' => 'beacon_active',
                'value' => 'active',
            )
        ),
    ));

}

else{

    piklist('field',array(
        'type' => 'paragraph',
        'value' => 'Opret beacons i systemet for at kunne tilknytte dem til øvelser',
        'label' => false,
    ));

}
