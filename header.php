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

        <?php if( WP_ENV === 'development' ): ?>
            <div class="py-1 bg-red-500 text-white">
                <div class="container flex justify-between">
                    <div>
                        <i class="fa-solid fa-bell w-4 h-4 bg-red-700 box-content p-1 rounded-sm text-white mr-2"></i> <?php echo wp_sprintf( __( 'Development environment (Theme version: %l)', 'pixelone' ), wp_get_theme()->get( 'Version' ) ); ?>
                    </div>

                    <div>
                        <a href="<?php echo esc_url( wp_login_url() ); ?>" class="text-white underline"><?php echo __( 'WP Admin', 'pixelone' ); ?></a>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php get_template_part( 'template-parts/partials/header', 'header' ); ?>
