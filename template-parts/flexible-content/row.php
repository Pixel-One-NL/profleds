<?php
  defined( 'ABSPATH' ) || die;

  /**
   * Row layout
   * 
   * Render the row layout with column
   * 
   * @package PixelOne
   * @since 1.0.0
   * @version 1.0.0
   */
?>

<div class="container">
  <div class="row">
    <?php if( have_rows( 'columns' ) ): ?>

      <?php while( have_rows( 'columns' ) ): the_row(); ?>
        <?php get_template_part( 'template-parts/flexible-content/column' ); ?>
      <?php endwhile; ?>

    <?php endif; ?>
  </div>
</div>