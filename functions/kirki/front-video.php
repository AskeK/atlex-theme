<?php

if (class_exists('Kirki')){

    Kirki::add_section( 'front_banner', array(
        'title'          => __( 'Forsidebanner' ),
        'description'    => __( 'Vælg billede til forsidens banner' ),
        'panel'          => '', // Not typically needed.
        'priority'       => 160,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '', // Rarely needed.
    ) );

    Kirki::add_field( 'smamo_config', array(
        'settings' => 'front_banner_video',
        'label'    => __( 'Forsidens video (Youtube link)', 'smamo' ),
        'section'  => 'front_banner',
        'type'     => 'url',
        'priority' => 10,
        'default'  => '',
    ) );

    Kirki::add_field( 'smamo_config', array(
        'settings' => 'front_banner_img',
        'label'    => __( 'Forsidens baggrundsbillede', 'smamo'),
        'description'    => __( 'Bruges som fallback på telefoner og tablets', 'smamo'),
        'section'  => 'front_banner',
        'type'     => 'image',
        'priority' => 10,
        'default'  => '',
    ) );
}
