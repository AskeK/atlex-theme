<?php

$GLOBALS['current_id'] = get_the_ID();
$GLOBALS['jstemplates'] = false;

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="UTF-8">

    <meta name="post-id" content="<?php echo $GLOBALS['current_id'] ?>">
    <title><?php wp_title(' · ', true, 'right')?></title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php get_template_part('template-parts/header/vector'); ?>
    <div class="wrapper">

