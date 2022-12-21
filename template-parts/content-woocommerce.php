<?php
    defined( 'ABSPATH' ) || die;

    /**
     * The template for displaying content on pages
     * 
     * @package PixelOne
     * @since 1.0.0
     * @version 1.0.0
     */
?>

<?php if( is_shop() || is_product_category() || is_product_tag() ): ?>
    <div class="container my-8 grid grid-cols-12 gap-8" x-data="{ filtersOpen: false }">
        <div class="col-span-12 lg:col-span-3">
            <div class="hidden lg:block">
                <?php dynamic_sidebar( 'shop-sidebar' ); ?>
            </div>

            <button class="text-primary font-semibold hover:text-primary-hover lg:hidden" data-toggle="modal" data-target="#shop-sidebar" x-on:click="filtersOpen = true">
                <i class="fa-solid fa-bars mr-1"></i>
                <?= __( 'Open filters', 'pixelone' ); ?>
            </button>

            <div class="fixed top-0 right-0 bottom-0 left-0 bg-white z-50" x-show="filtersOpen">
                <div class="p-4 overflow-y-auto h-full">
                    <button class="text-primary font-semibold hover:text-primary-hover float-right" data-toggle="modal" data-target="#shop-sidebar" x-on:click="filtersOpen = false">
                        <i class="fa-solid fa-times mr-1"></i>
                        <?= __( 'Close filters', 'pixelone' ); ?>
                    </button>
                </div>
            </div>
        </div>

        <div class="col-span-12 lg:col-span-9">
            <?php the_content(); ?>
        </div>
    </div>
<?php else: ?>
    <article id="post-<?php the_id(); ?>" <?php post_class( array( 'tw-container', 'tw-mx-auto', 'tw-py-8' ) ); ?>>
        <?php the_content(); ?>
    </article>
<?php endif; ?>