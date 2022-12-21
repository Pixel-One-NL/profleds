<?php
    defined( 'ABSPATH' ) || die;
    
    /**
     * Vite & TailwindCSS JIT development
     */

    // Define dist folder, this is defined in vite.config.js
    define( 'PONE_DIST_DEF', 'dist' );

    // Define dist folder URI and path
    define( 'PONE_DIST_URI', get_template_directory_uri() . '/' . PONE_DIST_DEF );
    define( 'PONE_DIST_PATH', get_template_directory() . '/' . PONE_DIST_DEF );

    // Define JS enqueue settings
    define( 'PONE_JS_DEPENDENCIES', array( 'jquery', 'wp-i18n' ) );
    define( 'PONE_JS_VERSION', '1.0.0' );
    define( 'PONE_JS_IN_FOOTER', true );

    // Dfine CSS enqueue settings
    define( 'PONE_CSS_DEPENDENCIES', array() );
    define( 'PONE_CSS_VERSION', '1.0.0' );
    define( 'PONE_CSS_MEDIA', 'all' );

    // Define default server address, port and entry point. This is defined in vite.config.js
    define( 'PONE_VITE_SERVER', 'http://localhost:3000' );
    define( 'PONE_VITE_ENTRY_POINT', '/main.js' );

    // Enqueue scripts and styles
    add_action( 'wp_enqueue_scripts', 'pone_enqueue_scripts' );
    function pone_enqueue_scripts() {
        // Enqueue main.js
        if( defined( 'PONE_IS_VITE_DEVELOPMENT' ) && PONE_IS_VITE_DEVELOPMENT === true ) {
            // Insert HMR into head for live reload
            add_action( 'wp_head', 'pone_vite_hmr' );
            function pone_vite_hmr() {
                echo wp_sprintf( '<script type="module" crossorigin src="%s"></script>', PONE_VITE_SERVER . PONE_VITE_ENTRY_POINT );
            }
        } else {
            /**
             * Production version
             * Note: You need to run 'npm run build' or 'yarn build' to generate the assets
             */

            // Get the manifest to see which files to enqueue
            $manifest = json_decode( file_get_contents( PONE_DIST_PATH . '/manifest.json' ), true );

            if( is_array( $manifest ) ) {
                $manifest_key = array_keys( $manifest );
                if( isset( $manifest_key[0] ) ) {

                    // Enqueue CSS
                    foreach( @$manifest[$manifest_key[0]]['css'] as $css_file ) {
                        wp_enqueue_style( 'pone-main', PONE_DIST_URI . '/' . $css_file, PONE_CSS_DEPENDENCIES, PONE_CSS_VERSION, PONE_CSS_MEDIA );
                    }

                    // Enqueue JS
                    foreach( @$manifest[$manifest_key[0]]['js'] as $js_file ) {
                        wp_enqueue_script( 'pone-main', PONE_DIST_URI . '/' . $js_file, PONE_JS_DEPENDENCIES, PONE_JS_VERSION, PONE_JS_IN_FOOTER );
                    }
                }
            }
        }
    }