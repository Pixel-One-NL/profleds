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
            <div class="max-w-md">
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
                                    <td class="px-2 py-1 border border-gray-200 text-sm break-all min-w-[6rem]"><strong><?php echo $key; ?></strong></td>
                                    <td class="px-2 py-1 border border-gray-200 text-sm break-all">
                                        <?php if( is_string( $value ) ): ?>
                                            <?php echo $value; ?>
                                        <?php elseif( is_array( $value ) ): ?>
                                            <ul class="list-disc list-inside">
                                                <?php foreach( $value as $item ): ?>
                                                    <li><?php echo $item; ?></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php endif; ?>
                                    </td>
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
    <div x-data="{show: false, activeTab: 1}">
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
        <div x-show="show" class="z-50 fixed w-full h-1/3 max-h-96 bottom-0 left-0 right-0 bg-gray-50 border-t">
            <!-- Header -->
            <header class="border-b px-2 w-full h-6 flex justify-between">
                <!-- Tab buttons -->
                <div>
                    <button class=" px-1 hover:bg-gray-200 mr-2 text-sm" x-on:click="activeTab = 1" :class="{ 'border-primary border-b-2 font-bold' : activeTab == 1  } " >
                        Server info
                    </button>

                    <button class=" px-1 hover:bg-gray-200 mr-2 text-sm" x-on:click="activeTab = 2" :class="{' border-primary border-b-2 font-bold' : activeTab == 2  } ">
                        Template / WordPress info
                    </button>
                </div>

                <!-- Close button -->
                <button x-on:click="show = false" class="px-1 hover:bg-red-500 hover:text-white">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </header>

            <!-- Tabs -->
            <div class="p-4 debug-menu-tab overflow-y-scroll" x-show="activeTab === 1">
                <div class="flex flex-wrap gap-4">
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

                            // Server info
                            $values = array(
                                array( __( 'Server software', 'pixelone' ) => $_SERVER['SERVER_SOFTWARE'] ?? __( 'Unknown', 'pixelone' ) ),
                                array( __( 'Server IP', 'pixelone' ) => $_SERVER['SERVER_ADDR'] ?? __( 'Unknown', 'pixelone' ) ),
                                array( __( 'Server name', 'pixelone' ) => $_SERVER['SERVER_NAME'] ?? __( 'Unknown', 'pixelone' ) ),
                                array( __( 'Server protocol', 'pixelone' ) => $_SERVER['SERVER_PROTOCOL'] ?? __( 'Unknown', 'pixelone' ) ),
                                array( __( 'Server port', 'pixelone' ) => $_SERVER['SERVER_PORT'] ?? __( 'Unknown', 'pixelone' ) ),
                                array( __( 'Server admin', 'pixelone' ) => $_SERVER['SERVER_ADMIN'] ?? __( 'Unknown', 'pixelone' ) ),
                                array( __( 'Server signature', 'pixelone' ) => $_SERVER['SERVER_SIGNATURE'] ?? __( 'Unknown', 'pixelone' ) ),
                                array( __( 'Server user agent', 'pixelone' ) => $_SERVER['HTTP_USER_AGENT'] ?? __( 'Unknown', 'pixelone' ) ),
                                array( __( 'Server request method', 'pixelone' ) => $_SERVER['REQUEST_METHOD'] ?? __( 'Unknown', 'pixelone' ) ),
                                array( __( 'Server request time', 'pixelone' ) => $_SERVER['REQUEST_TIME'] ?? __( 'Unknown', 'pixelone' ) ),
                                array( __( 'Server request time float', 'pixelone' ) => $_SERVER['REQUEST_TIME_FLOAT'] ?? __( 'Unknown', 'pixelone' ) ),
                                array( __( 'Server query string', 'pixelone' ) => $_SERVER['QUERY_STRING'] ?? __( 'Unknown', 'pixelone' ) ),
                                array( __( 'Server document root', 'pixelone' ) => $_SERVER['DOCUMENT_ROOT'] ?? __( 'Unknown', 'pixelone' ) ),
                                array( __( 'Server remote address', 'pixelone' ) => $_SERVER['REMOTE_ADDR'] ?? __( 'Unknown', 'pixelone' ) ),
                                array( __( 'Server remote host', 'pixelone' ) => $_SERVER['REMOTE_HOST'] ?? __( 'Unknown', 'pixelone' ) ),
                                array( __( 'Server remote port', 'pixelone' ) => $_SERVER['REMOTE_PORT'] ?? __( 'Unknown', 'pixelone' ) ),
                                array( __( 'Server remote user', 'pixelone' ) => $_SERVER['REMOTE_USER'] ?? __( 'Unknown', 'pixelone' ) ),
                                array( __( 'Server redirect remote user', 'pixelone' ) => $_SERVER['REDIRECT_REMOTE_USER'] ?? __( 'Unknown', 'pixelone' ) ),
                                array( __( 'Server script filename', 'pixelone' ) => $_SERVER['SCRIPT_FILENAME'] ?? __( 'Unknown', 'pixelone' ) ),
                                array( __( 'Server path translated', 'pixelone' ) => $_SERVER['PATH_TRANSLATED'] ?? __( 'Unknown', 'pixelone' ) ),
                                array( __( 'Server script name', 'pixelone' ) => $_SERVER['SCRIPT_NAME'] ?? __( 'Unknown', 'pixelone' ) ),
                                array( __( 'Server request uri', 'pixelone' ) => $_SERVER['REQUEST_URI'] ?? __( 'Unknown', 'pixelone' ) ),
                            );

                            render_table( $values, __( 'Server info', 'pixelone' ) );
                        ?>
                </div>
            </div>
            <div class="p-4 debug-menu-tab overflow-y-scroll" x-show="activeTab === 2" >
                <div class="flex flex-wrap gap-4">
                    <?php
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
                            array( __( 'WordPress registered post types', 'pixelone' ) => get_post_types() ),
                            array( __( 'WordPress registered taxonomies', 'pixelone' ) => get_taxonomies() ),
                            array( __( 'WordPress registered widgets', 'pixelone' ) => implode( ', ', array_keys( $GLOBALS['wp_widget_factory']->widgets ) ) ),
                            array( __( 'WordPress registered menus', 'pixelone' ) => get_registered_nav_menus() ),
                            array( __( 'WordPress registered image sizes', 'pixelone' ) => implode( ', ', get_intermediate_image_sizes() ) ),
                            array( __( 'WordPress registered sidebars', 'pixelone' ) => implode( ', ', array_keys( $GLOBALS['wp_registered_sidebars'] ) ) ),
                            array( __( 'WordPress registered shortcodes', 'pixelone' ) => implode( ', ', array_keys( $GLOBALS['shortcode_tags'] ) ) ),
                        );

                        render_table( $values, __( 'WordPress Info', 'pixelone' ), 2 );

                        // Theme info
                        $values = array(
                            array( __( 'Theme name', 'pixelone' ) => wp_get_theme()->get( 'Name' ) ),
                            array( __( 'Theme version', 'pixelone' ) => wp_get_theme()->get( 'Version' ) ),
                            array( __( 'Theme author', 'pixelone' ) => wp_get_theme()->get( 'Author' ) ),
                            array( __( 'Theme author URI', 'pixelone' ) => wp_get_theme()->get( 'AuthorURI' ) ),
                            array( __( 'Theme description', 'pixelone' ) => wp_get_theme()->get( 'Description' ) ),
                            array( __( 'Theme text domain', 'pixelone' ) => wp_get_theme()->get( 'TextDomain' ) ),
                            array( __( 'Theme domain path', 'pixelone' ) => wp_get_theme()->get( 'DomainPath' ) ),
                            array( __( 'Theme template', 'pixelone' ) => wp_get_theme()->get( 'Template' ) ),
                            array( __( 'Theme status', 'pixelone' ) => wp_get_theme()->get( 'Status' ) ),
                            array( __( 'Theme tags', 'pixelone' ) => implode( ', ', wp_get_theme()->get( 'Tags' ) ) ),
                            array( __( 'Theme theme root', 'pixelone' ) => wp_get_theme()->get_theme_root() ),
                            array( __( 'Theme theme root URI', 'pixelone' ) => wp_get_theme()->get_theme_root_uri() ),
                        );

                        render_table( $values, __( 'Theme Info', 'pixelone' ), 2 );

                        // Plugins info
                        $values = array(
                            array( __( 'Plugins', 'pixelone' ) => array_map( function( $plugin ) {
                                return $plugin['Name'] . ' ' . $plugin['Version'];
                            }, get_plugins() ) ),
                        );

                        render_table( $values, __( 'Plugins Info', 'pixelone' ), 2 );
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>