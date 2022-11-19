<?php
  defined( 'ABSPATH' ) || die;

  /**
   * Pixel One default template header
   * 
   * @package PixelOne
   * @since 1.0.0
   * @version 1.0.0
   */
?>

<!-- Toaster -->
<?php get_template_part( 'template-parts/partials/toaster', 'toaster' ); ?>

<div class="py-6 shadow-md">
  <div class="container">
    <div class="flex justify-between items-center">
      <div class="flex items-center">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="h-12">
          <?php if( get_theme_mod( 'custom_logo' ) ) : ?>
            <?php the_custom_logo(); ?>
          <?php else : ?>
            <h1 class="text-2xl font-bold"><?php bloginfo( 'name' ); ?></h1>
          <?php endif; ?>
        </a>
      </div>

      <!-- Desktop Menu -->
      <div class="hidden lg:block">
        <?php if( has_nav_menu( 'primary' ) ) : ?>
          <nav role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'pixelone' ); ?>">
            <?php
              wp_nav_menu( array(
                'theme_location'    => 'primary',
                'container'         => false,
                'menu_class'        => 'pone-menu',
                'items_wrap'        => '<ul id="%1$s" class="%2$s" x-data="{open: false}">%3$s</ul>',
                'walker'            => new Pone_Nav_Walker(),
                'sub_menu_position' => 'left',
              ) );
            ?>
          </nav>
        <?php endif; ?>
      </div>

      <!-- Mobile Menu -->
      <div class="lg:hidden" x-data="{open: true}">
        <button class="pone-menu-toggle" x-on:click="open = !open" x-bind:aria-expanded="open" x-bind:aria-label="open ? 'Close Menu' : 'Open Menu'" x-bind:class="open ? 'open' : ''">
          <span class="block w-6 h-1 bg-gray-900 rounded transition-all"></span>
          <span class="block w-6 h-1 bg-gray-900 rounded transition-all mt-1"></span>
          <span class="block w-6 h-1 bg-gray-900 rounded transition-all mt-1"></span>
        </button>

        <div class="mobile-menu-background-overlay fixed top-0 left-0 w-screen h-screen bg-black opacity-50 z-40" x-show="open"></div>
        <div class="overflow-y-auto mobile-menu fixed bg-white w-full h-full top-0 right-0 max-w-3xl z-50" role="navigation" x-show="open" x-on:click.away="open = false" x-bind:aria-expanded="open" x-bind:aria-label="open ? 'Close Menu' : 'Open Menu'" x-bind:class="open ? 'open' : ''">
          <div class="mt-8 px-14 flex justify-between">
            <div></div>

            <div>
              <button class="pone-menu-toggle" x-on:click="open = !open" x-bind:aria-expanded="open" x-bind:aria-label="open ? 'Close Menu' : 'Open Menu'" x-bind:class="open ? 'open' : ''">
                <span class="block w-6 h-1 bg-gray-900 rounded transition-all"></span>
                <span class="block w-6 h-1 bg-gray-900 rounded transition-all mt-1"></span>
                <span class="block w-6 h-1 bg-gray-900 rounded transition-all mt-1"></span>
              </button>
            </div>
          </div>

          <?php if( has_nav_menu( 'primary' ) ) : ?>
            <nav role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'pixelone' ); ?>" class="py-12 px-14">
              <?php
                wp_nav_menu( array(
                  'theme_location'    => 'primary',
                  'container'         => false,
                  'menu_class'        => 'pone-mobile-menu',
                  'items_wrap'        => '<ul id="%1$s" class="%2$s" x-data="{open: false}">%3$s</ul>',
                  'walker'            => new Pone_Mobile_Nav_Walker(),
                ) );
              ?>
            </nav>
          <?php endif; ?>

        </div>
      </div>

    </div>
  </div>
</div>