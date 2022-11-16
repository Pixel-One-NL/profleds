<?php
  defined( 'ABSPATH' ) || die;

  // Vite assets
  define( 'PONE_IS_VITE_DEVELOPMENT', WP_ENV === 'development' );
  require __DIR__ . '/inc/inc.vite.php';

  // Customization
  require __DIR__ . '/inc/inc.customization.php';

  // Flexible content package
  require __DIR__ . '/inc/inc.pixelone-flexible-content.php';

  // Components
  require __DIR__ . '/inc/inc.pixelone-component.php';

