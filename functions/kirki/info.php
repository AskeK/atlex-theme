<?php

if (class_exists('Kirki')){

    Kirki::add_section( 'footer_info', array(
        'title'          => __( 'Information i footer' ),
        'description'    => __( 'Oplysninger der vises i sidens footer' ),
        'panel'          => '', // Not typically needed.
        'priority'       => 160,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '', // Rarely needed.
    ) );

    Kirki::add_field( 'smamo_config', array(
        'type' => 'repeater',
        'priority'    => 30,
        'label'       => __( 'Logoer', 'fagy' ),
        'settings' => 'footer_info_logo',
        'section' => 'footer_info',
        'row_label' => array( 'type' => 'text', 'value' => 'Logo', ),
        'add_new' => 'Tilføj logo',
        'default' => array(),
        'fields' => array(

            'img' => array(
                'label'  => __( 'Billede', 'rwmb' ),
                'type' => 'image',
            ),

            'url' => array(
                'label'  => __( 'Link', 'rwmb' ),
                'type' => 'url',
            ),

            'blank' => array(
                'label'  => __( 'Åben i nyt vindue', 'rwmb' ),
                'type' => 'checkbox',
                'default' => '0',
            ),
        )
    ));

    Kirki::add_field( 'smamo_config', array(
        'type' => 'repeater',
        'priority'    => 30,
        'label'       => __( 'Adresselinjer', 'fagy' ),
        'settings' => 'footer_info_lines',
        'section' => 'footer_info',
        'row_label' => array( 'type' => 'text', 'value' => 'Linje', ),
        'add_new' => 'Tilføj linje',
        'default' => array(),
        'fields' => array(

            'text' => array(
                'label'  => __( 'Tekst', 'rwmb' ),
                'type' => 'text',
            ),
        )
    ));

}


