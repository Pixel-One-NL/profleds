<?php
    /**
     * No products found template
     */

    defined( 'ABSPATH' ) || die;

    $search_query = get_search_query();

    echo '<div class="woocommerce">';
        echo '<p class="woocommerce-info">';
            if( $search_query ) {
                echo sprintf( __( 'No products found for "%s".', 'woocommerce' ), $search_query );
            } else {
                echo __( 'No products found.', 'woocommerce' );
            }
        echo '</p>';
    echo '</div>';