<?php
  defined( 'ABSPATH' ) || die;

  /**
   * Pixel One toaster
   * Shows a toaster message based on the theme options
   * You can add a toaster message by start date, end date and always show
   * 
   * @package PixelOne
   * @since 1.0.0
   * @version 1.0.0
   */
?>

<?php
  $message = null;

  if( have_rows( 'toaster_messages', 'option' ) ) {
    while( have_rows( 'toaster_messages', 'option' ) ) {
      the_row();

      if( $message ) continue;
      if( ! get_sub_field( 'message_active' ) ) continue;

      if( get_sub_field( 'start_date' ) || get_sub_field( 'end_date' ) ) {
        $start_date   = get_sub_field( 'start_date' );
        $end_date     = get_sub_field( 'end_date' );
        $current_date = new DateTime( 'now', new DateTimeZone( wp_timezone_string() ) );
        $current_date = $current_date->format( 'd/m/Y g:i a' );

        if( $start_date && $end_date ) {
          if( $current_date >= $start_date && $current_date <= $end_date ) {
            $message = get_sub_field( 'message' );
          }
        } else if( $start_date ) {
          if( $current_date >= $start_date ) {
            $message = get_sub_field( 'message' );
          }
        } else if( $end_date ) {
          if( $current_date <= $end_date ) {
            $message = get_sub_field( 'message' );
          }
        }
      } else {
        $message = get_sub_field( 'message' );
      }
    }
  }
?>

<?php if( $message ): ?>
  <div class="bg-primary text-white py-1.5">
    <div class="container text-center">
      <?= $message; ?>
    </div>
  </div>
<?php endif; ?>