<?php
  defined( 'ABSPATH' ) || die;

  /**
   * Custom walker for nav menu
   * 
   * @package PixelOne
   * @since 1.0.0
   * @version 1.0.0
   */

   class Pone_Nav_Walker extends Walker_Nav_Menu {
    /**
     * @see Walker::start_lvl()
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int $depth Depth of page. Used for padding.
     */
    public function start_lvl( &$output, $depth = 0, $args = array() ) {
      $sub_menu_position = $args->sub_menu_position ?? 'right';
      $output .= '<ul role="menu" class="pone-sub-menu sub-menu-' . $sub_menu_position . '">';
    }

    /**
     * @see Walker::end_el()
     * @since 3.0.0
     * 
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item Page data object. Not used.
     * @param int $depth Depth of page. Not Used.
     */
    public function end_el( &$output, $item, $depth = 0, $args = array() ) {
      // If the item has children, add <box-icon name='chevron-right' ></box-icon>
      if( in_array( 'menu-item-has-children', $item->classes ) && $depth == 0 ) {
        $output .= '<i class="fa-solid fa-chevron-down"></i>';
      }

      if( in_array( 'menu-item-has-children', $item->classes ) && $depth > 0 ) {
        $output .= '<i class="fa-solid fa-chevron-right"></i>';
      }

      $output .= "</li>";
    }
   }