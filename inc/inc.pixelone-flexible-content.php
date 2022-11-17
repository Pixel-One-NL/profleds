<?php
  defined( 'ABSPATH' ) || die;

  /**
   * Pixel One Flexible Content module
   * Render ACF Flexible Content fields
   * 
   * @package PixelOne
   * @since 1.0.0
   * @version 1.0.0
   */

   class PONE_Render {
    public function __construct() {
      // Check if ACF plugin is enabled
      add_action( 'admin_init', array( $this, 'acf_notice' ) );
    }

    /**
     * Get an instance of the class.
     * 
     * @return PONE_Render
     */
    static function get_instance() {
      static $instance = null;

      if ( null === $instance ) {
        $instance = new self();
      }

      return $instance;
    }

    /**
     * Check if ACF is installed and active
     * 
     * @since 1.0.0
     * @version 1.0.0
     * @return void
     */
    private function check_acf() {
      if( function_exists( 'is_plugin_active' )  ) {
        if( ! is_plugin_active( 'advanced-custom-fields-pro/acf.php' ) ) {
          return false;
        }
      } else {
        return false;
      }

      return true;
    }

    /**
     * Display ACF notice
     * 
     * @since 1.0.0
     * @version 1.0.0
     * @return void
     */
    public function acf_notice() {
      if( ! $this->check_acf() ): ?>
        <div class="notice notice-error">
          <p><?php esc_html_e( 'Pixel One Flexible Content module requires Advanced Custom Fields Pro plugin to be installed and activated.', 'pixelone' ); ?></p>
        </div>
      <?php endif;
   }

    /**
     * Render ACF Flexible Content fields
     * 
     * @since 1.0.0
     * @version 1.0.0
     * @return void
     */
    static function render() {
      if( ! (new PONE_Render)->check_acf() ) return false;

      if( have_rows( 'flexible_content' ) ) {
        while( have_rows( 'flexible_content' ) ) {
          the_row();

          $layout = get_row_layout();
          if( $layout ) {
            get_template_part( 'template-parts/flexible-content/' . $layout );
          }
        }
      }
    }
  }

  PONE_Render::get_instance();