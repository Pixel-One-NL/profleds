<?php
  defined( 'ABSPATH' ) || die;

  /**
   * Pixel One theme customization
   * 
   * @package PixelOne
   * @since 1.0.0
   */

  // Admin styles
  add_action( 'admin_enqueue_scripts', 'pixelone_admin_styles' );
  function pixelone_admin_styles() {
    wp_enqueue_style( 'pixelone-admin-styles', get_template_directory_uri() . '/assets/css/admin.css', PONE_CSS_DEPENDENCIES, PONE_CSS_VERSION, PONE_CSS_MEDIA );
  }