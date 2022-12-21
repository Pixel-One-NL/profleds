<?php   
    defined( 'ABSPATH' ) || die;

    // Hide the product_cat and product_tag description field
    add_action( 'admin_init', 'pone_hide_product_cat_description' );
    function pone_hide_product_cat_description() {
        if( is_admin() && isset( $_GET['taxonomy'] ) && ( $_GET['taxonomy'] == 'product_cat' || $_GET['taxonomy'] == 'product_tag' ) ) {
            ?>
            <style>
                .term-description-wrap {
                    display: none;
                }
            </style>
            <?php
        }
    }

    // Seo text before the product loop
    add_action( 'woocommerce_before_shop_loop', 'pone_before_shop_loop', 5 );
    function pone_before_shop_loop() {
        if( is_shop() || is_product_category() || is_product_tag() ) {
            $cat_id = get_queried_object_id();

            if( have_rows( 'products_seo', 'product_cat_' . $cat_id ) ) {
                while( have_rows( 'products_seo', 'product_cat_' . $cat_id ) ) {
                    the_row();
                    ?>
                        <div class="mb-3">
                            <?php get_template_part( 'template-parts/partials/wysiwyg', null, array( 'content' => get_sub_field( 'before_products' ) ) ); ?>
                        </div>
                    <?php
                }
            }
        }
    }

    // Seo text after the product loop
    add_action( 'woocommerce_after_shop_loop', 'pone_after_shop_loop', 30 );
    function pone_after_shop_loop() {
        if( is_shop() || is_product_category() || is_product_tag() ) {
            $cat_id = get_queried_object_id();

            if( have_rows( 'products_seo', 'product_cat_' . $cat_id ) ) {
                while( have_rows( 'products_seo', 'product_cat_' . $cat_id ) ) {
                    the_row();
                    ?>
                        <div class="mt-3">
                            <?php get_template_part( 'template-parts/partials/wysiwyg', null, array( 'content' => get_sub_field( 'after_products' ) ) ); ?>
                        </div>
                    <?php
                }
            }
        }
    }

    // Remove default WooCommerce sorting dropdown
    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

    // Replace woocommerce search result count with custom one
    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
    
    // Add searchandfilter results count at the top of the products loop
    add_action( 'woocommerce_before_shop_loop', 'pone_woocommerce_result_count', 20 );
    function pone_woocommerce_result_count() {
        if ( ! wc_get_loop_prop( 'is_paginated' ) || ! woocommerce_products_will_display() )
			return;

        $total       = wc_get_loop_prop( 'total' );
        $total_pages = wc_get_loop_prop( 'total_pages' );
        $current     = wc_get_loop_prop( 'current_page' );

        ?>
            <div class="mb-4 text-sm">
                <span>
                    <?= sprintf( __( 'Page %s of %s', 'pixelone' ), $current, $total_pages ); ?>
                </span>
                <span>&nbsp;-&nbsp;</span>
                <span class="font-bold">
                    <?= sprintf( _n( '%s product', '%s products', $total, 'pixelone' ), $total ); ?>
                </span>
            </div>
        <?php
    }

    // Remove default WooCommerce pagination
    remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );

    // Add pagination at the bottom of the products loop
    add_action( 'woocommerce_after_shop_loop', 'pone_woocommerce_pagination', 20 );
    function pone_woocommerce_pagination() {
        if ( ! wc_get_loop_prop( 'is_paginated' ) || ! woocommerce_products_will_display() )
            return;

        $total_pages = wc_get_loop_prop( 'total_pages' );

        ?>
            <div class="pagination">
                <?php
                    $big = 999999999; // need an unlikely integer

                    echo paginate_links( array(
                        'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                        'format'    => '?paged=%#%',
                        'current'   => max( 1, get_query_var( 'paged' ) ),
                        'total'     => $total_pages,
                        'prev_text' => '<i class="fa-solid fa-chevron-left"></i>',
                        'next_text' => '<i class="fa-solid fa-chevron-right"></i>',
                        'show_all'  => true,
                    ) );
                ?>
            </div>
        <?php
    }