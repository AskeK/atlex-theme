<?php

/*
Title: Øvelser
Post Type: forlob
scope: post_meta
order: 10
*/

$ovelse_q = get_posts(array(
    'post_type' => 'ovelse',
    'numberposts' => -1,
    'orderby' => 'title',
    'order' => 'ASC',
));

$ovelser = array('0' => 'Vælg øvelse');
foreach($ovelse_q as $o){
    $ovelser[$o->ID] = $o->post_title;
}


$styrke_q = get_terms('styrke',array('hide_empty' => false));
$styrker = array();
foreach($styrke_q as $s){
    $styrker[$s->term_id] = $s->name;
}


$beacon_q = get_posts(array('post_type' => 'beacon','numberposts'=>-1));
$beacons = array('0' => '');
foreach($beacon_q as $b){
    $beacons[$b->ID] = $b->post_title;
}

$conditions = array(
    array(
        'field' => 'attach_ovelse:id',
        'value' => '0',
        'compare' => '!=',
    ),
);



piklist('field', array(
    'type' => 'group',
    'label' => __('Tilknyttede øvelser'),
    'columns' => 12,
    'add_more' => true,
    'scope' => 'post_meta',
    'field' => 'attach_ovelse',
    'serialize' => 'true',
    'fields' => array(

        array(
            'columns' => 10,
            'type' => 'select',
            'scope' => 'post_meta',
            'field' => 'id',
            'choices' => $ovelser,
            'relate' => array('scope' => 'post'),
        ),

        array(
            'columns' => 10,
            'attributes' => array(
                'rows' => 7,
            ),
            'type' => 'textarea',
            'scope' => 'post_meta',
            'field' => 'description',
            'label' => 'Overskriv beskrivelse',
            'conditions' => $conditions,
        ),

        array(
            'columns' => 10,
            'type' => 'checkbox',
            'label' => 'Overskriv styrkeområder',
            'field' => 'styrke',
            'choices' => $styrker,
            'conditions' => $conditions,
        ),

        array(
            'columns' => 10,
            'type' => 'number',
            'label' => 'Overskriv varighed',
            'field' => 'time',
            'conditions' => $conditions,
        ),

        array(
            'columns' => 10,
            'type' => 'select',
            'label' => 'Overskriv placering',
            'field' => 'beacon',
            'choices' => $beacons,
            'conditions' => $conditions,
        ),
    )
));
