<?php
if (class_exists('WACC')){

    $new = new WACC(array(
        'post_type' => 'page',

        'defaults' => array(
            'author' => false,
        ),

        'columns' => array(),
    ));
}
