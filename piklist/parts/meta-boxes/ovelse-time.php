<?php

/*
Title: Varighed
Post Type: ovelse
scope: post_meta
order: 30
*/


piklist('field', array(
    'type' => 'number',
    'label' => __('Øvelsens varighed (i minutter)'),
    'scope' => 'post_meta',
    'field' => 'time',
));
