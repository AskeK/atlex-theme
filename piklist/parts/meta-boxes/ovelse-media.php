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
    'type' => 'text',
    'label' => __('Tilføj video (youtube video ID)'),
    'scope' => 'post_meta',
    'columns' => 9,
    'field' => 'video-id',
    'serialize' => 'true',
));
