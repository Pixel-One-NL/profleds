<?php
  defined( 'ABSPATH' ) || die;

  /**
   * Pixel One theme customization
   * 
   * @package PixelOne
   * @since 1.0.0
   */

  // Admin styles
  add_action( 'admin_enqueue_scripts', 'pone_admin_styles' );
  function pone_admin_styles() {
    wp_enqueue_style( 'pixelone-admin-styles', get_template_directory_uri() . '/assets/css/admin.css', PONE_CSS_DEPENDENCIES, PONE_CSS_VERSION, PONE_CSS_MEDIA );
  }

  // Theme support
  add_action( 'after_setup_theme', 'pone_theme_support' );
  function pone_theme_support() {
    add_theme_support( 'custom-logo' );
    add_theme_support( 'widgets' );
  }

  // Register menus
  add_action( 'after_setup_theme', 'pone_register_menus' );
  function pone_register_menus() {
    register_nav_menus( array(
      'primary' => __( 'Primary Menu', 'pixelone' ),
    ) );
  }

  // ACF options page
  add_action( 'acf/init', 'pone_acf_options_page' );
  function pone_acf_options_page() {
    if( function_exists( 'acf_add_options_page' ) ) {
      acf_add_options_page( array(
        'page_title'  => __( 'Theme Options', 'pixelone' ),
        'menu_title'  => __( 'Theme Options', 'pixelone' ),
        'menu_slug'   => 'theme-options',
        'capability'  => 'edit_posts',
        'redirect'    => false
      ) );
    }
  }

  // Add theme support for WooCommerce
  add_action( 'after_theme_setup', 'pone_woocommerce_support' );
  function pone_woocommerce_support() {
    add_theme_support( 'woocommerce' );
  }

  // Add sidebars
  add_action( 'widgets_init', 'pone_register_sidebars' );
  function pone_register_sidebars() {
    // Shop sidebar
    register_sidebar( array(
      'name'          => __( 'Shop Sidebar', 'pixelone' ),
      'id'            => 'shop-sidebar',
      'description'   => __( 'Add widgets here to appear in your shop sidebar.', 'pixelone' ),
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget'  => '</div>',
      'before_title'  => '<h3 class="widget-title">',
      'after_title'   => '</h3>',
    ) );
  }

  // Load language files
  add_action( 'after_setup_theme', 'pone_load_textdomain' );
  function pone_load_textdomain() {
    load_theme_textdomain( 'pixelone', get_template_directory() . '/languages' );
  }