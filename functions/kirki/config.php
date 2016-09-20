<?php
if (class_exists('Kirki')){
    Kirki::add_config( 'smamo_config', array(
	   'capability'    => 'edit_theme_options',
	   'option_type'   => 'theme_mod',
    ));
}
