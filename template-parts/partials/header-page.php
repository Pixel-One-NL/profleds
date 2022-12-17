<?php
  defined( 'ABSPATH' ) || die;

  /**
   * Page header template
   * 
   * @package PixelOne
   * @since 1.0.0
   * @version 1.0.0
   */
?>

<header class="page-header">
    <div class="container">
        <?php if( function_exists( 'yoast_breadcrumb' ) && ! is_front_page() ): ?>
            <div class="breadcrumbs">
                <?php yoast_breadcrumb( '<p id="breadcrumbs">', '</p>' ); ?>
            </div>
        <?php endif; ?>

        <h1 class="text-3xl font-bold">
            <?php the_title(); ?>
        </h1>
    </div>
</header>