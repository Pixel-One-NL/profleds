<?php
/**
 * View Order
 *
 * Shows the details of a particular order on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/view-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.0.0
 */

defined( 'ABSPATH' ) || exit;

$notes = $order->get_customer_order_notes();
?>

<h2 class="text-3xl font-bold mb-8">
	<?= __( sprintf( 'Order #%s', $order->get_order_number() ), 'pixelone' ); ?>
	<span class="text-sm italic text-gray-500 ml-4"><?= date_i18n( 'd-m-Y H:i', strtotime( $order->get_date_created() ) ); ?></span>
</h2>

<?php $notes = $order->get_customer_order_notes(); if( $notes ): ?>
	<div class="mb-8" x-data="{ open: false }">
		<h3 class="text-xl font-bold mb-2"><?= __( 'Order updates', 'woocommerce' ); ?></h3>

		<button
			x-on:click="open = !open"
			x-html="open ? '<?= __( 'Hide updates', 'pixelone' ); ?>' : '<?= __( 'Show updates', 'pixelone' ); ?>'"
			class="bg-primary text-white rounded-lg font-semibold transition-all hover:bg-[#2e8a2e] py-2 px-4">
		></button>

		<ul x-show="open" class="space-y-4 py-4 border-t border-b border-gray-200 mt-4">
			<?php foreach( $notes as $note ): ?>
				<li>
					<span class="text-sm italic text-gray-500"><?= sprintf( '%s (%s):', $note->comment_author, date_i18n( 'd-m-Y H:i', strtotime( $note->comment_date ) ) ); ?></span>
					<p class="text-sm"><?= $note->comment_content; ?></p>
				</li>	
			<?php endforeach; ?>
		</ul>
	</div>
<?php endif; ?>

<?php do_action( 'woocommerce_view_order', $order_id ); ?>
