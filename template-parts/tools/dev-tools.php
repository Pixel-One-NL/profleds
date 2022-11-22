<?php
  /**
   * DEV tools
   * Show information about the website and template parts
   * 
   * @package PixelOne
   * @since 1.0.0
   * @version 1.0.0
   */

   defined( 'ABSPATH' ) || die;
?>

<?php
    function render_table( $data, $title = '', $col_span = 1 ) {
        ?>
            <div class="tw-col-span-<?= $col_span; ?>">
                <?php if( $title ): ?>
                    <p class="mb-2">
                        <strong><?= $title; ?></strong>
                    </p>
                <?php endif; ?>
                <table class="table-auto">
                    <tbody>
                        <?php foreach( $data as $key => $value ): ?>
                            <tr>
                                <?php foreach( $value as $key => $value ): ?>
                                    <td class="px-2 py-1 border border-gray-200"><strong><?php echo $key; ?></strong></td>
                                    <td class="px-2 py-1 border border-gray-200"><?php echo $value; ?></td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php
    }
?>

<?php if( WP_ENV === 'development' && is_user_logged_in() ): ?>
    <div x-data="{show: true, activeTab: 1}">
        <!-- Toggle -->
        <div class="items-center justify-center z-40 fixed bottom-0 right-0 m-10">
            <div x-data="{tooltip: false}" class="relative z-40">
                <button x-on:click="show = !show" x-on:mouseover="tooltip = true" x-on:mouseleave="tooltip = false" class="rounded-md p-1 bg-primary text-white cursor-pointer transition hover:bg-primary-hover relative">
                    <i class="fa-solid fa-wrench p-1" ></i>

                    <!-- Tooltip -->
                    <span x-show="tooltip" class="absolute right-full whitespace-nowrap text-xs bg-gray-600 px-2 py-1 rounded mr-2">Debug menu</span>
                </button>
            </div>
        </div>


        <!-- Tabs -->
        <div x-show="show" x-data="activeTab: false"  class="z-50 fixed w-full h-1/3 max-h-96 bottom-0 left-0 right-0 bg-gray-50 border-t">
            <!-- Header -->
            <header class="border-b px-2 w-full h-6 flex justify-between">
                <!-- Tab buttons -->
                <div>
                    <button class=" px-1 hover:bg-gray-200 mr-2" x-on:click="activeTab = 1" :class="{ 'border-orange-400 border-b' : activeTab == 1  } " >
                        Server info
                    </button>

                    <button class=" px-1 hover:bg-gray-200 mr-2" x-on:click="activeTab = 2" :class="{' border-orange-400 border-b' : activeTab == 2  } ">
                        Tab 2
                    </button>

                    <button class=" px-1 hover:bg-gray-200 mr-2" x-on:click="activeTab = 3" :class="{ 'border-orange-400 border-b' : activeTab == 3  } ">
                        Tab 3
                    </button>
                </div>

                <!-- Close button -->
                <button x-on:click="show = false" class="px-1 hover:bg-red-500 hover:text-white">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </header>

            <!-- Tabs -->
            <div class="mx-4 py-4 debug-menu-tab overflow-y-scroll" x-show="activeTab === 1">
                <div class="grid grid-cols-4 gap-4">
                        <?php
                            // PHP and envoirnment info
                            $values = array(
                                array( __( 'PHP Version', 'pixelone' ) => phpversion() ),
                                array( __( 'Environment', 'pixelone' ) => WP_ENV ),
                                array( __( 'Max execution time', 'pixelone' ) => ini_get( 'max_execution_time' ) ),
                                array( __( 'Memory limit', 'pixelone' ) => ini_get( 'memory_limit' ) ),
                                array( __( 'Upload max filesize', 'pixelone' ) => ini_get( 'upload_max_filesize' ) ),
                                array( __( 'Post max size', 'pixelone' ) => ini_get( 'post_max_size' ) ),
                            );

                            render_table( $values, __( 'PHP and environment info', 'pixelone' ) );

                            // Database info
                            global $wpdb;

                            $values = array(
                                array( __( 'Database version', 'pixelone' ) => $wpdb->db_version() ),
                                array( __( 'Database type', 'pixelone' ) => $wpdb->get_var( 'SELECT VERSION() as version' ) ),
                                array( __( 'Database prefix', 'pixelone' ) => $wpdb->prefix ),
                                array( __( 'Database size', 'pixelone' ) => size_format( (int) $wpdb->get_var( "SELECT SUM( data_length + index_length ) FROM information_schema.TABLES WHERE table_schema = '" . DB_NAME . "'" ) ) ),
                                array( __( 'Database tables', 'pixelone' ) => $wpdb->get_var( "SELECT COUNT(*) FROM information_schema.TABLES WHERE table_schema = '" . DB_NAME . "'" ) ),
                                array( __( 'Database user', 'pixelone' ) => DB_USER ),
                                array( __( 'Database name', 'pixelone' ) => DB_NAME ),
                            );

                            render_table( $values, __( 'Database info', 'pixelone' ) );

                            // WordPress info
                            $values = array(
                                array( __( 'WordPress version', 'pixelone' ) => get_bloginfo( 'version' ) ),
                                array( __( 'WordPress language', 'pixelone' ) => get_locale() ),
                                array( __( 'WordPress URL', 'pixelone' ) => get_bloginfo( 'wpurl' ) ),
                                array( __( 'WordPress home URL', 'pixelone' ) => get_bloginfo( 'url' ) ),
                                array( __( 'WordPress theme', 'pixelone' ) => get_template() ),
                                array( __( 'WordPress theme version', 'pixelone' ) => wp_get_theme()->get( 'Version' ) ),
                                array( __( 'WordPress multisite', 'pixelone' ) => is_multisite() ? __( 'Yes', 'pixelone' ) : __( 'No', 'pixelone' ) ),
                                array( __( 'WordPress debug mode', 'pixelone' ) => defined( 'WP_DEBUG' ) && WP_DEBUG ? __( 'Yes', 'pixelone' ) : __( 'No', 'pixelone' ) ),
                                array( __( 'WordPress memory limit', 'pixelone' ) => WP_MEMORY_LIMIT ),
                                array( __( 'WordPress timezone', 'pixelone' ) => get_option( 'timezone_string' ) ),
                                array( __( 'WordPress permalink structure', 'pixelone' ) => get_option( 'permalink_structure' ) ),
                                array( __( 'WordPress registered post types', 'pixelone' ) => implode( ', ', get_post_types() ) ),
                                array( __( 'WordPress registered taxonomies', 'pixelone' ) => implode( ', ', get_taxonomies() ) ),
                                array( __( 'WordPress registered widgets', 'pixelone' ) => implode( ', ', array_keys( $GLOBALS['wp_widget_factory']->widgets ) ) ),
                                array( __( 'WordPress registered menus', 'pixelone' ) => implode( ', ', get_registered_nav_menus() ) ),
                                array( __( 'WordPress registered image sizes', 'pixelone' ) => implode( ', ', get_intermediate_image_sizes() ) ),
                                array( __( 'WordPress registered sidebars', 'pixelone' ) => implode( ', ', array_keys( $GLOBALS['wp_registered_sidebars'] ) ) ),
                                array( __( 'WordPress registered shortcodes', 'pixelone' ) => implode( ', ', array_keys( $GLOBALS['shortcode_tags'] ) ) ),
                            );

                            render_table( $values, __( 'WordPress Info', 'pixelone' ), 2 );
                        ?>
                </div>
            </div>
            <div class="container debug-menu-tab overflow-y-scroll" x-show="activeTab === 2" >
                <div class="row">
                </div>
            </div>
            <div class="container debug-menu-tab overflow-y-scroll" x-show="activeTab === 3" >
                tab3
            </div>
        </div>
    </div>
<?php endif; ?>