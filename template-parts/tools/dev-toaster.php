<?php
  /**
   * DEV toaster
   * Show a notification on the top of the page if the website is in development mode
   * Also add a quick link to WP ADMIN
   * 
   * @package PixelOne
   * @since 1.0.0
   * @version 1.0.0
   */

   defined( 'ABSPATH' ) || die;
?>

<?php if( WP_ENV === 'development' && ! is_user_logged_in() ): ?>
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