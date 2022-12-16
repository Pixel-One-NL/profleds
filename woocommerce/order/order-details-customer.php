<?php
/**
 * Order Customer Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-customer.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.6.0
 */

defined( 'ABSPATH' ) || exit;

$show_shipping = ! wc_ship_to_billing_address_only() && $order->needs_shipping_address();
?>

<?php
	$show_shipping = ! wc_ship_to_billing_address_only() && $order->needs_shipping_address();
	
	function address_html( $order ) {
		$address = $order->get_formatted_billing_address( esc_html__( 'N/A', 'woocommerce' ) );
		$phone = $order->get_billing_phone();
		$email = $order->get_billing_email();

		?>
			<p>
				<?= $address; ?>

				<?php if ( $phone ) : ?>
					<br>
					<span>
						<?= $phone; ?>
					</span>
				<?php endif; ?>

				<?php if ( $email ) : ?>
					<br>
					<span>
						<?= $email; ?>
					</span>
				<?php endif; ?>
			</p>
		<?php
	}
?>
<section id="customer-details" class="bg-primary-light py-8 px-12 rounded-lg">
	<div class="grid grid-cols-2">
		<?php if ( $show_shipping ) : ?>
			<div class="col-span-1">
				<h2 class="text-lg font-bold mb-2"><?= __( 'Billing address', 'pixelone' ); ?></h2>
				<?php address_html( $order ); ?>
			</div>
			<div class="col-span-1">
				<h2 class="text-lg font-bold mb-2"><?= __( 'Shipping address', 'pixelone' ); ?></h2>
				<?php address_html( $order ); ?>
			</div>
		<?php else : ?>
			<div class="col-span-1">
				<h2 class="text-lg font-bold mb-2"><?= __( 'Billing address', 'pixelone' ); ?></h2>
				<?php address_html( $order ); ?>
			</div>
		<?php endif; ?>
	</div>

	<?php do_action( 'woocommerce_order_details_after_customer_details', $order ); ?>
</section>
