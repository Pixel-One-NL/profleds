<?php
    /**
     * The header template
     * 
     * Display all of the <head>
     * 
     * @package PixelOne
     * @since 1.0.0
     */
?>

<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->

    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <meta name="viewport" content="width=device-width" />
        <link rel="profile" href="https://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>">
        
        <title><?php wp_title( '|', true, 'right' ); ?></title>

        <!--[if lt IE 9]>
        <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js?ver=3.7.0" type="text/javascript"></script>
        <![endif]-->

        <?php wp_head(); ?>

        <!-- FontAwesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    </head>
    <body <?php body_class(); ?>>
        <?php wp_body_open(); ?>
        <?php if( WP_ENV === 'development' && ! is_user_logged_in() ): ?>
            <div class="py-1 bg-red-500 text-white">
                <div class="container flex justify-between">
                    <div>
                        <i class="fa-solid fa-bell w-4 h-4 bg-red-700 box-content p-1 rounded-sm text-white mr-2"></i> <?php echo wp_sprintf( __( 'Development environment (Theme version: %l)', 'pixelone' ), wp_get_theme()->get( 'Version' ) ); ?>
                    </div>
                    <div>
                        <a href="<?php echo esc_url( wp_login_url() ); ?>" class="text-white underline"><?php echo __( 'WP Admin', 'pixelone' ); ?></a>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php get_template_part( 'template-parts/partials/header', 'header' ); ?>

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
                        <button class=" px-1 hover:bg-gray-200 mr-2" x-on:click="activeTab = 1" :class="{ 'border-orange-400 border-b-4' : activeTab == 1  } " >
                            Tab 1
                        </button>

                        <button class=" px-1 hover:bg-gray-200 mr-2" x-on:click="activeTab = 2" :class="{' border-orange-400 border-b-4' : activeTab == 2  } ">
                            Tab 2
                        </button>

                        <button class=" px-1 hover:bg-gray-200 mr-2" x-on:click="activeTab = 3" :class="{ 'border-orange-400 border-b-4' : activeTab == 3  } ">
                            Tab 3
                        </button>
                    </div>

                    <!-- Close button -->
                    <button x-on:click="show = false" class="px-1 hover:bg-red-500 hover:text-white">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </header>

                <!-- Tabs -->
                <div class="container debug-menu-tab overflow-y-scroll" x-show="activeTab === 1">
                    <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin fermentum felis rhoncus, bibendum nunc sed, sagittis dolor. Curabitur lobortis quis mauris a pretium. Quisque in ex at ex tempor iaculis ut sed nisl. Donec porttitor purus eget dui scelerisque eleifend. Nullam ornare cursus metus, at convallis ex sodales in. Aliquam feugiat magna a lectus euismod consectetur. Aliquam auctor luctus porttitor. Proin vulputate non orci sit amet placerat. Integer in est sapien. Integer ac lorem varius, mollis turpis et, pharetra ante. Mauris eleifend nisl at mauris semper, sed tristique ante tincidunt. Mauris at urna id augue luctus maximus non non nisl. Nullam pretium mauris et tincidunt egestas. Nullam non luctus lectus, molestie dignissim libero.

                    Cras sed mi at velit imperdiet commodo sit amet eget ex. Donec quis porttitor nisi. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Nam accumsan, lorem eu consequat vestibulum, est nisl semper justo, sit amet tristique eros dui non massa. Aliquam eu facilisis sapien. Sed eu turpis mi. Maecenas eget sollicitudin turpis. Ut pretium nulla ac felis malesuada, at pretium risus lacinia. Mauris sit amet mattis urna, sit amet commodo lectus. Vivamus finibus risus at ipsum dignissim vestibulum. Mauris ex nisl, rutrum et lacinia at, vestibulum sed lacus. Maecenas risus lectus, lobortis eget aliquet a, congue vitae est. Vestibulum maximus maximus euismod.

                    Vivamus viverra ante vel interdum consectetur. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Pellentesque ac massa nec arcu tempor condimentum a ac lectus. Aliquam consequat lobortis commodo. Aliquam dignissim, risus sit amet rutrum tincidunt, orci nisl placerat ligula, at aliquam magna felis ac neque. In ante mauris, bibendum et augue vel, posuere lobortis ligula. Fusce id vestibulum nisl.

                    Pellentesque semper enim non magna molestie, a pretium urna sagittis. Donec sed lorem ac tellus vulputate commodo in ac elit. Vestibulum ut convallis eros, vel vestibulum lectus. In malesuada posuere ipsum, in tempus mi dictum nec. Sed suscipit neque id diam dapibus sollicitudin. Maecenas et lacinia enim. Sed posuere elit non libero vulputate, ac pulvinar lorem pulvinar. Nullam tempus odio a dolor suscipit vulputate. Maecenas eget rutrum nulla. Donec vulputate sed arcu sed lacinia.

                    Cras quis erat vitae libero elementum aliquet nec at elit. Nunc faucibus dapibus sapien, id vehicula mauris pulvinar non. Duis auctor luctus nulla a accumsan. Morbi mollis pretium feugiat. Fusce eget aliquam ipsum, quis consectetur elit. Aliquam sollicitudin vehicula neque, vitae lacinia metus dapibus at. Integer felis ante, feugiat eu turpis non, sollicitudin convallis leo. Phasellus a quam nec est elementum tristique vel vel ante. Sed varius elementum elit vel volutpat. Vivamus bibendum tempus interdum. Sed eu porttitor justo. Aliquam commodo, sem nec molestie pellentesque, elit eros tempus sem, id malesuada dui risus sit amet odio. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Praesent lacinia justo in finibus congue. Donec convallis in neque varius aliquet. Donec ante nunc, porttitor sed sollicitudin vitae, pretium vitae odio.
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin fermentum felis rhoncus, bibendum nunc sed, sagittis dolor. Curabitur lobortis quis mauris a pretium. Quisque in ex at ex tempor iaculis ut sed nisl. Donec porttitor purus eget dui scelerisque eleifend. Nullam ornare cursus metus, at convallis ex sodales in. Aliquam feugiat magna a lectus euismod consectetur. Aliquam auctor luctus porttitor. Proin vulputate non orci sit amet placerat. Integer in est sapien. Integer ac lorem varius, mollis turpis et, pharetra ante. Mauris eleifend nisl at mauris semper, sed tristique ante tincidunt. Mauris at urna id augue luctus maximus non non nisl. Nullam pretium mauris et tincidunt egestas. Nullam non luctus lectus, molestie dignissim libero.

                    Cras sed mi at velit imperdiet commodo sit amet eget ex. Donec quis porttitor nisi. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Nam accumsan, lorem eu consequat vestibulum, est nisl semper justo, sit amet tristique eros dui non massa. Aliquam eu facilisis sapien. Sed eu turpis mi. Maecenas eget sollicitudin turpis. Ut pretium nulla ac felis malesuada, at pretium risus lacinia. Mauris sit amet mattis urna, sit amet commodo lectus. Vivamus finibus risus at ipsum dignissim vestibulum. Mauris ex nisl, rutrum et lacinia at, vestibulum sed lacus. Maecenas risus lectus, lobortis eget aliquet a, congue vitae est. Vestibulum maximus maximus euismod.

                    Vivamus viverra ante vel interdum consectetur. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Pellentesque ac massa nec arcu tempor condimentum a ac lectus. Aliquam consequat lobortis commodo. Aliquam dignissim, risus sit amet rutrum tincidunt, orci nisl placerat ligula, at aliquam magna felis ac neque. In ante mauris, bibendum et augue vel, posuere lobortis ligula. Fusce id vestibulum nisl.

                    Pellentesque semper enim non magna molestie, a pretium urna sagittis. Donec sed lorem ac tellus vulputate commodo in ac elit. Vestibulum ut convallis eros, vel vestibulum lectus. In malesuada posuere ipsum, in tempus mi dictum nec. Sed suscipit neque id diam dapibus sollicitudin. Maecenas et lacinia enim. Sed posuere elit non libero vulputate, ac pulvinar lorem pulvinar. Nullam tempus odio a dolor suscipit vulputate. Maecenas eget rutrum nulla. Donec vulputate sed arcu sed lacinia.

                    Cras quis erat vitae libero elementum aliquet nec at elit. Nunc faucibus dapibus sapien, id vehicula mauris pulvinar non. Duis auctor luctus nulla a accumsan. Morbi mollis pretium feugiat. Fusce eget aliquam ipsum, quis consectetur elit. Aliquam sollicitudin vehicula neque, vitae lacinia metus dapibus at. Integer felis ante, feugiat eu turpis non, sollicitudin convallis leo. Phasellus a quam nec est elementum tristique vel vel ante. Sed varius elementum elit vel volutpat. Vivamus bibendum tempus interdum. Sed eu porttitor justo. Aliquam commodo, sem nec molestie pellentesque, elit eros tempus sem, id malesuada dui risus sit amet odio. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Praesent lacinia justo in finibus congue. Donec convallis in neque varius aliquet. Donec ante nunc, porttitor sed sollicitudin vitae, pretium vitae odio.
                    </p>
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

