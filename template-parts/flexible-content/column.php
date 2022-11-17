<?php
  defined( 'ABSPATH' ) || die;
  
  /**
   * Column layout
   * 
   * Render the column
   * Also place blocks inside
   * 
   * @package PixelOne
   * @since 1.0.0
   * @version 1.0.0
   */
?>

<?php
  // Get the column width
  $column_width = get_sub_field( 'width' );

  // Get the column offset
  $column_offset = get_sub_field( 'offset' );
?>

<div class="col-md-<?= $column_width; ?> offset-md-<?= $column_offset; ?>">
  <?php if( have_rows( 'blocks' ) ): ?>
    <h1>Blocks</h1>
    <?php while( have_rows( 'blocks' ) ): the_row(); ?>
      <?php get_template_part( 'template-parts/flexible-content/block' ); ?>
    <?php endwhile; ?>

  <?php endif; ?>
</div>
