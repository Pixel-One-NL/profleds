<?php
  /**
   * Title component
   * 
   * Renders H tags with dynamic size and classes
   * 
   * Expected arguments: size, text, class
   * 
   * @package PixelOne
   * @since 1.0.0
   * @version 1.0.0
   */

  $size = $args['size'] ?? 'h1';
  $text = $args['text'] ?? '';
  $class = $args['class'] ?? '';
?>

<?php if( $text ) : ?>
  <<?php echo $size; ?> class="p1-component title <?php echo $class; ?>">
    <?php echo $text; ?>
  </<?php echo $size; ?>>
<?php endif; ?>