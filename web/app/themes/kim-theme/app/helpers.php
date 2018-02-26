<?php

namespace App;

use Roots\Sage\Container;

//region Sage Theme Helpers
/**
 * Get the sage container.
 *
 * @param string $abstract
 * @param array  $parameters
 * @param Container $container
 * @return Container|mixed
 */
function sage($abstract = null, $parameters = [], Container $container = null)
{
    $container = $container ?: Container::getInstance();
    if (!$abstract) {
        return $container;
    }
    return $container->bound($abstract)
        ? $container->makeWith($abstract, $parameters)
        : $container->makeWith("sage.{$abstract}", $parameters);
}

/**
 * Get / set the specified configuration value.
 *
 * If an array is passed as the key, we will assume you want to set an array of values.
 *
 * @param array|string $key
 * @param mixed $default
 * @return mixed|\Roots\Sage\Config
 * @copyright Taylor Otwell
 * @link https://github.com/laravel/framework/blob/c0970285/src/Illuminate/Foundation/helpers.php#L254-L265
 */
function config($key = null, $default = null)
{
    if (is_null($key)) {
        return sage('config');
    }
    if (is_array($key)) {
        return sage('config')->set($key);
    }
    return sage('config')->get($key, $default);
}

/**
 * @param string $file
 * @param array $data
 * @return string
 */
function template($file, $data = [])
{
    if (remove_action('wp_head', 'wp_enqueue_scripts', 1)) {
        wp_enqueue_scripts();
    }

    return sage('blade')->render($file, $data);
}

/**
 * Retrieve path to a compiled blade view
 * @param $file
 * @param array $data
 * @return string
 */
function template_path($file, $data = [])
{
    return sage('blade')->compiledPath($file, $data);
}

/**
 * @param $asset
 * @return string
 */
function asset_path($asset)
{
    return sage('assets')->getUri($asset);
}

/**
 * @param string|string[] $templates Possible template files
 * @return array
 */
function filter_templates($templates)
{
    $paths = apply_filters('sage/filter_templates/paths', [
        'views',
        'resources/views'
    ]);
    $paths_pattern = "#^(" . implode('|', $paths) . ")/#";

    return collect($templates)
        ->map(function ($template) use ($paths_pattern) {
            /** Remove .blade.php/.blade/.php from template names */
            $template = preg_replace('#\.(blade\.?)?(php)?$#', '', ltrim($template));

            /** Remove partial $paths from the beginning of template names */
            if (strpos($template, '/')) {
                $template = preg_replace($paths_pattern, '', $template);
            }

            return $template;
        })
        ->flatMap(function ($template) use ($paths) {
            return collect($paths)
                ->flatMap(function ($path) use ($template) {
                    return [
                        "{$path}/{$template}.blade.php",
                        "{$path}/{$template}.php",
                        "{$template}.blade.php",
                        "{$template}.php",
                    ];
                });
        })
        ->filter()
        ->unique()
        ->all();
}

/**
 * @param string|string[] $templates Relative path to possible template files
 * @return string Location of the template
 */
function locate_template($templates)
{
    return \locate_template(filter_templates($templates));
}

/**
 * Determine whether to show the sidebar
 * @return bool
 */
function display_sidebar()
{
    static $display;
    isset($display) || $display = apply_filters('sage/display_sidebar', false);
    return $display;
}
//endregion

//region WILCO Web Helpers
/**
 * Return the width for a post in the main feed
 *
 * @param $index
 *
 * @return string
 */
function get_post_width( $index ) {
    switch ( $index ) {
        case 1:
            $result = 'col-12';
            break;
        case 2:
        case 3:
            $result = 'col-12 col-sm-6 col-lg-6 flex-column align-self-end';
            break;
        default:
            $result = 'col-12 col-sm-6';
            break;
    }

    return $result;
}

/* Convert hexdec color string to rgb(a) string */
function hex2rgba( $color, $opacity = false ) {

    $default = 'rgb(0,0,0)';

    //Return default if no color provided
    if ( empty( $color ) ) {
        return $default;
    }

    //Sanitize $color if "#" is provided
    if ( $color[0] == '#' ) {
        $color = substr( $color, 1 );
    }

    //Check if color has 6 or 3 characters and get values
    if ( strlen( $color ) == 6 ) {
        $hex = array(
            $color[0] . $color[1],
            $color[2] . $color[3],
            $color[4] . $color[5],
        );
    } elseif ( strlen( $color ) == 3 ) {
        $hex = array(
            $color[0] . $color[0],
            $color[1] . $color[1],
            $color[2] . $color[2],
        );
    } else {
        return $default;
    }

    //Convert hexadec to rgb
    $rgb = array_map( 'hexdec', $hex );

    //Check if opacity is set(rgba or rgb)
    if ( $opacity ) {
        if ( abs( $opacity ) > 1 ) {
            $opacity = 1.0;
        }
        $output = 'rgba(' . implode( ",", $rgb ) . ',' . $opacity . ')';
    } else {
        $output = 'rgb(' . implode( ",", $rgb ) . ')';
    }

    //Return rgb(a) color string
    return $output;
}

/**
 * Get Site Logo (Options Page)
 *
 * @param string $mode
 *
 * @return mixed|null|void
 */
function get_site_logo( $mode = '' ) {

    if ( $mode == 'alternative' ) {
        $site_logo = get_field( 'site_logo_alternative', 'option' );
    } else {
        $site_logo = get_field( 'site_logo', 'option' );
    }

    $result = empty( $site_logo ) ? null : wp_get_attachment_url( $site_logo );

    return $result;
}

/**
 * is_really_woocommerce_page - Returns true if on a page which uses WooCommerce templates (cart and checkout are standard pages with shortcodes and which are also included)
 *
 * @access public
 * @return bool
 */
//fixme: not really working, should figure how to fix this
function is_really_wc_page() {
    if ( function_exists( "is_woocommerce" ) && is_woocommerce() ) {
        return true;
    }
    $woocommerce_keys = array(
        "woocommerce_shop_page_id",
        "woocommerce_terms_page_id",
        "woocommerce_cart_page_id",
        "woocommerce_checkout_page_id",
        "woocommerce_pay_page_id",
        "woocommerce_thanks_page_id",
        "woocommerce_myaccount_page_id",
        "woocommerce_edit_address_page_id",
        "woocommerce_view_order_page_id",
        "woocommerce_change_password_page_id",
        "woocommerce_logout_page_id",
        "woocommerce_lost_password_page_id"
    );
    foreach ( $woocommerce_keys as $wc_page_id ) {
        if ( get_the_ID() == get_option( $wc_page_id, 0 ) ) {
            return true;
        }
    }

    return false;
}

/**
 * WooCommerce: Cart Total Getter
 * @return string
 */
function get_wc_cart_total() {
    return WC()->cart->get_cart_total();
}
//endregion

