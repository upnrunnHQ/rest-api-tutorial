<?php
/**
 * Plugin Name: Rest Api Tutorial
 * Description: How to extent WP RSET api from your custom plugin.
 * Version: 1.0.0
 * Author: upnrunn
 * Author URI: https://upnrunn.com/
 * License: GPL2+
 *
 * @package Rest_Api_Tutorial
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Define constants.
define( 'REST_API_TUTORIAL_PLUGIN_VERSION', '1.0.0' );
define( 'REST_API_TUTORIAL_PLUGIN_DIR', untrailingslashit( plugin_dir_path( __FILE__ ) ) );

// Include the main class.
require plugin_dir_path( __FILE__ ) . 'includes/class-rest-api-tutorial.php';

// Main instance of plugin.
function rest_tutorial() {
    return rest_tutorial::get_instance();
}

// Global for backwards compatibility.
$GLOBALS['rest_tutorial'] = rest_tutorial();;
