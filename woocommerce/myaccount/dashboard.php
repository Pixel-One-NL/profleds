<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>

<h3 class="font-semibold text-3xl">
	<?php if( $current_user->display_name ): ?>
		<?= sprintf( 'Hallo %s, ', $current_user->display_name ) ?>
	<?php else: ?>
		<?= 'Hallo, ' ?>
	<?php endif; ?>
</h3>

<p class="text-sm italic mt-1">
	<?= __( 'Navigeer in het menu om gegevens in te zien of aan te passen', 'pixelone' ); ?>
</p>

<div class="mt-4">
	<?php
		get_template_part( 'template-parts/partials/wysiwyg', null, array(
			'content' => get_field( 'account_welcome_message', 'option' )
		) );
	?>
</div>

<?php
	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_dashboard' );

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_before_my_account' );

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_after_my_account' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
