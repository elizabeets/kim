<?php

namespace App;

//region Sage Theme Filters
/**
 * Add <body> classes
 */
add_filter( 'body_class',
    function ( array $classes ) {
        /** Add page slug if it doesn't exist */
        if ( is_single() || is_page() && ! is_front_page() ) {
            if ( ! in_array( basename( get_permalink() ), $classes ) ) {
                $classes[] = basename( get_permalink() );
            }
        }

        /** Add class if sidebar is active */
        if ( display_sidebar() ) {
            $classes[] = 'sidebar-primary';
        }

        /** Clean up class names for custom templates */
        $classes = array_map( function ( $class ) {
            return preg_replace( [
                '/-blade(-php)?$/',
                '/^page-template-views/',
            ],
                '',
                $class );
        },
            $classes );

        return array_filter( $classes );
    } );

/**
 * Add "… Continued" to the excerpt
 */
add_filter( 'excerpt_more',
    function () {
        return ' &hellip; <a href="' . get_permalink() . '">' . __( 'Continued',
                'sage' ) . '</a>';
    } );

/**
 * Template Hierarchy should search for .blade.php files
 */
collect( [
    'index',
    '404',
    'archive',
    'author',
    'category',
    'tag',
    'taxonomy',
    'date',
    'home',
    'frontpage',
    'page',
    'paged',
    'search',
    'single',
    'singular',
    'attachment',
] )->map( function ( $type ) {
    add_filter( "{$type}_template_hierarchy",
        __NAMESPACE__ . '\\filter_templates' );
} );

/**
 * Render page using Blade
 */
add_filter( 'template_include',
    function ( $template ) {
        $data = collect( get_body_class() )->reduce( function (
            $data,
            $class
        ) use ( $template ) {
            return apply_filters( "sage/template/{$class}/data",
                $data,
                $template );
        },
            [] );
        if ( $template ) {
            echo template( $template, $data );

            return get_stylesheet_directory() . '/index.php';
        }

        return $template;
    },
    PHP_INT_MAX );

/**
 * Tell WordPress how to find the compiled path of comments.blade.php
 */
add_filter( 'comments_template',
    function ( $comments_template ) {
        $comments_template = str_replace(
            [ get_stylesheet_directory(), get_template_directory() ],
            '',
            $comments_template
        );

        return template_path( locate_template( [
            "views/{$comments_template}",
            $comments_template,
        ] ) ?: $comments_template );
    } );
//endregion

//region Kim Heyman Theme Filters
/**
 * Add ACF Options Page
 */
if ( function_exists( 'acf_add_options_page' ) ) {

    acf_add_options_page( [
        'position'   => '2.0',
        'icon_url'   => 'dashicons-admin-generic',
        'page_title' => 'Theme General Settings',
        'menu_title' => 'Theme Settings',
        'menu_slug'  => 'theme-general-settings',
        'capability' => 'edit_posts',
        'redirect'   => false,
    ] );

}

/**
 * WooCommerce: Add Subscription Policy Button + Modal
 */
add_filter( 'woocommerce_short_description',
    function ( $content ) {
        $content .= '<div class="contact-button"><a href="/contact" class="btn btn-outline-success btn-lg">Get more details</a></div>';

        return $content;
    },
    10,
    2 );

// Change number or products per row to 3
add_filter('loop_shop_columns', function () {
    return 3; // 3 products per row
});
//endregion
