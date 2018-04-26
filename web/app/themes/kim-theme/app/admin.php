<?php

namespace App;

use PostTypes\PostType;
use PostTypes\Taxonomy;

/**
 * Theme customizer
 */
add_action( 'customize_register',
    function ( \WP_Customize_Manager $wp_customize ) {
        // Add postMessage support
        $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
        $wp_customize->selective_refresh->add_partial( 'blogname',
            [
                'selector' => '.brand',
                'render_callback' => function () {
                    bloginfo( 'name' );
                },
            ] );
    } );

/**
 * Customizer JS
 */
add_action( 'customize_preview_init',
    function () {
        wp_enqueue_script( 'sage/customizer.js',
            asset_path( 'scripts/customizer.js' ),
            [ 'customize-preview' ],
            null,
            true );
    } );

/*add_action( 'admin_bar_menu',
    function () {
        global $template;
        print_r( $template );
    } );*/

/**
 * Add Custom Post Type: Lookbook
 */
$lookbooks = new PostType( [
    'name'     => 'lookbook',
    'singular' => 'Lookbook',
    'plural'   => 'Lookbooks',
    'slug'     => 'lookbooks',
], [
    'public'       => true,
    'has_archive'  => true,
    'hierarchical' => true,
    'supports'     => [
        'title',
        'editor',
        'thumbnail',
        'page-attributes',
    ],
] );
//$lookbooks->icon( 'dashicons-cart' );
$lookbooks->register();
