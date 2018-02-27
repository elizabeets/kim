<?php

/**
 * Do not edit anything in this file unless you know what you're doing
 */

use Roots\Sage\Config;
use Roots\Sage\Container;

//region Sage Theme Functions
/**
 * Helper function for prettying up errors
 *
 * @param string $message
 * @param string $subtitle
 * @param string $title
 */
$sage_error = function ( $message, $subtitle = '', $title = '' ) {
    $title  = $title ?: __( 'Sage &rsaquo; Error', 'sage' );
    $footer = '<a href="https://roots.io/sage/docs/">roots.io/sage/docs/</a>';
    $message
            = "<h1>{$title}<br><small>{$subtitle}</small></h1><p>{$message}</p><p>{$footer}</p>";
    wp_die( $message, $title );
};

/**
 * Ensure compatible version of PHP is used
 */
if ( version_compare( '7', phpversion(), '>=' ) ) {
    $sage_error( __( 'You must be using PHP 7 or greater.', 'sage' ),
        __( 'Invalid PHP version', 'sage' ) );
}

/**
 * Ensure compatible version of WordPress is used
 */
if ( version_compare( '4.7.0', get_bloginfo( 'version' ), '>=' ) ) {
    $sage_error( __( 'You must be using WordPress 4.7.0 or greater.', 'sage' ),
        __( 'Invalid WordPress version', 'sage' ) );
}

/**
 * Ensure dependencies are loaded
 */
if ( ! class_exists( 'Roots\\Sage\\Container' ) ) {
    if ( ! file_exists( $composer = __DIR__ . '/../vendor/autoload.php' ) ) {
        $sage_error(
            __( 'You must run <code>composer install</code> from the Sage directory.',
                'sage' ),
            __( 'Autoloader not found.', 'sage' )
        );
    }
    require_once $composer;
}

/**
 * Sage required files
 *
 * The mapped array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 */
array_map( function ( $file ) use ( $sage_error ) {
    $file = "../app/{$file}.php";
    if ( ! locate_template( $file, true, true ) ) {
        $sage_error( sprintf( __( 'Error locating <code>%s</code> for inclusion.',
            'sage' ),
            $file ),
            'File not found' );
    }
},
    [ 'helpers', 'setup', 'filters', 'admin', 'woocommerce' ] );

/**
 * Here's what's happening with these hooks:
 * 1. WordPress initially detects theme in themes/sage/resources
 * 2. Upon activation, we tell WordPress that the theme is actually in themes/sage/resources/views
 * 3. When we call get_template_directory() or get_template_directory_uri(), we point it back to themes/sage/resources
 *
 * We do this so that the Template Hierarchy will look in themes/sage/resources/views for core WordPress themes
 * But functions.php, style.css, and index.php are all still located in themes/sage/resources
 *
 * This is not compatible with the WordPress Customizer theme preview prior to theme activation
 *
 * get_template_directory()   -> /srv/www/example.com/current/web/app/themes/sage/resources
 * get_stylesheet_directory() -> /srv/www/example.com/current/web/app/themes/sage/resources
 * locate_template()
 * ├── STYLESHEETPATH         -> /srv/www/example.com/current/web/app/themes/sage/resources/views
 * └── TEMPLATEPATH           -> /srv/www/example.com/current/web/app/themes/sage/resources
 */
array_map(
    'add_filter',
    [
        'theme_file_path',
        'theme_file_uri',
        'parent_theme_file_path',
        'parent_theme_file_uri',
    ],
    array_fill( 0, 4, 'dirname' )
);
Container::getInstance()
         ->bindIf( 'config',
             function () {
                 return new Config( [
                     'assets' => require dirname( __DIR__ )
                                         . '/config/assets.php',
                     'theme'  => require dirname( __DIR__ )
                                         . '/config/theme.php',
                     'view'   => require dirname( __DIR__ )
                                         . '/config/view.php',
                 ] );
             },
             true );
//endregion

//region WILCO Web Modifications
/**
 * Add SVG support to WordPress media
 */
add_filter( 'upload_mimes', 'add_custom_upload_mimes' );
function add_custom_upload_mimes( $existing_mimes ) {
    $existing_mimes['otf']  = 'application/x-font-otf';
    $existing_mimes['woff'] = 'application/x-font-woff';
    $existing_mimes['ttf']  = 'application/x-font-ttf';
    $existing_mimes['svg']  = 'image/svg+xml';
    $existing_mimes['eot']  = 'application/vnd.ms-fontobject';

    return $existing_mimes;
}

/**
 * Bootstrap Nav Walker
 * */
$wp_bootstrap_walker_filename = '/wp-bootstrap-navwalker.php';
if ( ! file_exists( get_template_directory()
                    . $wp_bootstrap_walker_filename )
) {
    // file does not exist... return an error.
    return new WP_Error( 'wp-bootstrap-navwalker-missing',
        __( 'It appears the ' . $wp_bootstrap_walker_filename
            . ' file may be missing.',
            'wp-bootstrap-navwalker' ) );
} else {
    // file exists... require it.
    require_once get_template_directory() . $wp_bootstrap_walker_filename;
}

/**
 * Fix menu class for current active CPT item
 *
 * @param array $classes
 * @param bool  $menu_item
 *
 * @return array
 */
add_filter( 'nav_menu_css_class', 'custom_active_item_classes', 10, 2 );
function custom_active_item_classes( $classes = array(), $menu_item = false ) {
    global $post;

    // Get post ID, if nothing found set to NULL
    $id = ( isset( $post->ID ) ? get_the_ID() : null );

    // Checking if post ID exist...
    if ( isset( $id ) ) {
        $classes[] = ( $menu_item->url
                       == get_post_type_archive_link( $post->post_type ) )
            ? 'current-menu-item active' : '';
    }

    return $classes;
}

//endregion

//region WooCommerce Modifications
/**
 * WooCommerce: Add Extra Fields to Shop Registration
 */
add_action( 'woocommerce_register_form_start', 'wooc_extra_register_fields' );
function wooc_extra_register_fields() { ?>

    <p class="form-row form-row-first">
        <label for="reg_billing_first_name">
            <?php _e( 'First name', 'woocommerce' ); ?>
            <span class="required">*</span>
        </label>
        <input type="text" class="input-text" name="first_name"
               id="reg_billing_first_name"
               value="<?php if ( ! empty( $_POST['first_name'] ) ) {
                   esc_attr_e( $_POST['first_name'] );
               } ?>"/>
    </p>
    <p class="form-row form-row-last">
        <label for="reg_billing_last_name">
            <?php _e( 'Last name', 'woocommerce' ); ?>
            <span class="required">*</span>
        </label>
        <input type="text" class="input-text" name="last_name"
               id="reg_billing_last_name"
               value="<?php if ( ! empty( $_POST['last_name'] ) ) {
                   esc_attr_e( $_POST['last_name'] );
               } ?>"/>
    </p>
    <div class="clear"></div>
    <?php
}

/**
 * WooCommerce: Force reset Anti-Spam trap (Safari Auto-fill fix)
 */
add_action( 'woocommerce_register_post', 'reset_anti_spam_trap', 10, 3 );
function reset_anti_spam_trap() {
    if ( ! empty( $_POST['email_2'] ) ) {
        unset( $_POST['email_2'] );
    }
}

/**
 * WooCommerce: register fields Validating.
 */
add_action( 'woocommerce_register_post',
    'wooc_validate_extra_register_fields',
    10,
    4 );
function wooc_validate_extra_register_fields(
    $username,
    $email,
    $validation_errors
) {
    if ( isset( $POST['first_name'] ) && empty( $_POST['first_name'] ) ) {
        $validation_errors->add( 'billing_first_name_error',
            _( '<strong>Error</strong>: First name is required!',
                'woocommerce' ) );
    }
    if ( isset( $POST['last_name'] ) && empty( $_POST['last_name'] ) ) {
        $validation_errors->add( 'billing_last_name_error',
            _( '<strong>Error</strong>: Last name is required!.',
                'woocommerce' ) );
    }

    return $validation_errors;
}

/**
 * WooCommerce: Below code save extra fields.
 */
add_action( 'woocommerce_created_customer', 'wooc_save_extra_register_fields' );
function wooc_save_extra_register_fields( $customer_id ) {
    if ( isset( $_POST['first_name'] ) ) {
        //First name field which is by default
        update_user_meta( $customer_id,
            'first_name',
            sanitize_text_field( $_POST['first_name'] ) );
        // First name field which is used in WooCommerce
        update_user_meta( $customer_id,
            'first_name',
            sanitize_text_field( $_POST['first_name'] ) );
    }
    if ( isset( $_POST['last_name'] ) ) {
        // Last name field which is by default
        update_user_meta( $customer_id,
            'last_name',
            sanitize_text_field( $_POST['last_name'] ) );
        // Last name field which is used in WooCommerce
        update_user_meta( $customer_id,
            'last_name',
            sanitize_text_field( $_POST['last_name'] ) );
    }
}

add_action( 'woocommerce_before_variations_form',
    'wc_shop_enquiry_button',
    15 );
function wc_shop_enquiry_button() {
    echo '<a class="btn btn-outline-primary contact-button" href="/contact">Contact Me</a>';
}

/**
 * WooCommerce: Reduce the password strength requirement
 *
 * Strength Settings:
 * 3 = Strong (default)
 * 2 = Medium
 * 1 = Weak
 * 0 = Very Weak / Anything
 */
add_filter( 'woocommerce_min_password_strength',
    'reduce_woocommerce_min_strength_requirement' );
function reduce_woocommerce_min_strength_requirement( $strength ) {
    return 1;
}

/**
 * WooCommerce: Disable 'Ship to Different Address' by default
 */
add_filter( 'woocommerce_ship_to_different_address_checked', '__return_false' );

/**
 * WooCommerce: Override menu that appear in My Account Page
 */
add_filter( 'woocommerce_account_menu_items', 'wc_change_myaccount_menu' );
function wc_change_myaccount_menu() {
    $myorder = array(
//        'my-custom-endpoint' => __( 'My Stuff', 'woocommerce' ),
'dashboard'       => __( 'Dashboard', 'woocommerce' ),
'orders'          => __( 'My Orders', 'woocommerce' ),
'subscriptions'   => __( 'My Subscriptions', 'woocommerce' ),
'edit-address'    => __( 'My Addresses', 'woocommerce' ),
'payment-methods' => __( 'My Payment Methods', 'woocommerce' ),
'edit-account'    => __( 'My User Details', 'woocommerce' ),
'customer-logout' => __( 'Logout', 'woocommerce' ),
    );

    return $myorder;
}
//endregion
