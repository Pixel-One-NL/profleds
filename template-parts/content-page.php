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

<article id="post-<?php the_id(); ?>" <?php post_class(); ?>>
    <?php the_content(); ?>
</article>