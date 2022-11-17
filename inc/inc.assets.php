<?php
  defined( 'ABSPATH' ) || die;

  // Styles
  add_action( 'wp_enqueue_scripts', 'pixelone_styles' );
  function pixelone_styles() {
    wp_enqueue_style( 'bootstrap-grid', get_template_directory_uri() . '/assets/css/bootstrap-grid.min.css', PONE_CSS_DEPENDENCIES, PONE_CSS_VERSION, PONE_CSS_MEDIA );
  }