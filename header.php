<?php
    /**
     * The header template
     * 
     * Display all of the <head>
     * 
     * @package PixelOne
     * @since 1.0.0
     */
?>

<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->

    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <meta name="viewport" content="width=device-width" />
        <link rel="profile" href="https://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>">
        
        <title><?php wp_title( '|', true, 'right' ); ?></title>

        <!--[if lt IE 9]>
        <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js?ver=3.7.0" type="text/javascript"></script>
        <![endif]-->

        <?php wp_head(); ?>

        <!-- FontAwesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    </head>
    <body <?php body_class(); ?>>
        <?php wp_body_open(); ?>

        <?php get_template_part( 'template-parts/tools/dev-toaster', 'dev-toaster' ); ?>
        <?php get_template_part( 'template-parts/tools/dev-tools', 'dev-tools' ); ?>
        <?php get_template_part( 'template-parts/partials/header', 'header' ); ?>

