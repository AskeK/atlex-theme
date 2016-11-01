<?php

/*
Title: Medier
Post Type: ovelse
scope: post_meta
*/

piklist('field', array(
    'type' => 'file',
    'label' => __('Tilføj billeder'),
    'scope' => 'post_meta',
    'field' => 'images',
    'serialize' => 'true',
));

piklist('field', array(
    'type' => 'url',
    'label' => __('Tilføj video'),
    'scope' => 'post_meta',
    'columns' => 9,
    'field' => 'video',
    'serialize' => 'true',
));
