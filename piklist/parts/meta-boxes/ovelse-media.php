<?php

/*
Title: Medier
Post Type: ovelse
scope: post_meta
order: 20
*/

piklist('field', array(
    'type' => 'group',
    'label' => __('Tilføj medier'),
    'columns' => 12,
    'add_more' => true,
    'scope' => 'post_meta',
    'field' => 'media',
    'serialize' => 'true',
    'fields' => array(
        array(
            'columns' => 4,
            'type' => 'select',
            'scope' => 'post_meta',
            'field' => 'media_type',
            'choices' => array(
                '0' => 'Vælg type',
                '1' => 'Billede',
                '2' => 'Video fra mediebiblioteket',
                '3' => 'Youtube video',
                '4' => 'Vimeo video',
            ),
        ),

        array(
            'columns' => 7,
            'type' => 'file',
            'scope' => 'post_meta',
            'field' => 'img',
            'label' => 'Vælg eller upload',
            'save' => 'url',
            'conditions' => array(
                array(
                    'field' => 'media:media_type',
                    'value' => array('1','2'),
                ),
            ),
        ),

        array(
            'columns' => 7,
            'type' => 'url',
            'label' => 'Indsæt link',
            'scope' => 'post_meta',
            'field' => 'video_url',
            'conditions' => array(
                array(
                    'field' => 'media:media_type',
                    'value' => array('3','4'),
                ),
            ),
        ),
    )
));
