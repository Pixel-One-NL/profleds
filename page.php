<?php get_header(); ?>


<?php if( have_posts() ): ?>
  <div id="content" class="site-content">
    <main id="main">
        <?php get_template_part( 'template-parts/partials/header', 'page' ); ?>
        <div id="primary">
            <?php while( have_posts() ): the_post(); ?>
              <?php if( is_woocommerce() || is_cart() || is_checkout() || is_account_page() ): ?>
                <?php get_template_part( 'template-parts/content', 'woocommerce' ); ?>
              <?php else: ?>
                <?php get_template_part( 'template-parts/content', 'page' ); ?>
              <?php endif; ?>
            <?php endwhile; ?>
          </div>
        </main>
      </div>
  <?php endif; ?>

  <?php PONE_Render::render(); ?>

<?php get_footer(); ?>