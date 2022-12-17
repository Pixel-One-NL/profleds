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

    // Seo text before and after the product loop
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

    add_action( 'woocommerce_after_shop_loop', 'pone_after_shop_loop', 5 );
    function pone_after_shop_loop() {
        if( is_shop() || is_product_category() || is_product_tag() ) {
            $cat_id = get_queried_object_id();

            if( have_rows( 'products_seo', 'product_cat_' . $cat_id ) ) {
                while( have_rows( 'products_seo', 'product_cat_' . $cat_id ) ) {
                    the_row();
                    ?>
                        <div class="mb-3">
                            <?php get_template_part( 'template-parts/partials/wysiwyg', null, array( 'content' => get_sub_field( 'after_products' ) ) ); ?>
                        </div>
                    <?php
                }
            }
        }
    }