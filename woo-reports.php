<?php
/**
 * Plugin Name: Woo Reports
 * Plugin URI: https://www.lubus.in
 * Description: Woo Reports.
 * Author: lubus
 * Author URI: https://www.lubus.in
 * Version: 1.0.0
 * Text Domain: wooreports
 * Domain Path: /languages
 * Tags: faq,
 * Requires at least: 3.0.1
 * Tested up to:  5.0.3
 * Stable tag: 1.0.0
 * License: GPL2
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @package Wooreports
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Setup Constants
 */
// Plugin version.
if ( ! defined( 'WOOREPORTS_VERSION' ) ) {
	define( 'WOOREPORTS_VERSION', '0.1.0' );
}
// Plugin Root File.
if ( ! defined( 'WOOREPORTS_PLUGIN_FILE' ) ) {
	define( 'WOOREPORTS_PLUGIN_FILE', __FILE__ );
}
// Plugin Folder Path.
if ( ! defined( 'WOOREPORTS_PLUGIN_DIR' ) ) {
	define( 'WOOREPORTS_PLUGIN_DIR', plugin_dir_path( WOOREPORTS_PLUGIN_FILE ) );
}
// Plugin Folder URL.
if ( ! defined( 'WOOREPORTS_PLUGIN_URL' ) ) {
	define( 'WOOREPORTS_PLUGIN_URL', plugin_dir_url( WOOREPORTS_PLUGIN_FILE ) );
}
// Plugin Basename aka: "wooreports/wooreports.php".
if ( ! defined( 'WOOREPORTS_PLUGIN_BASENAME' ) ) {
	define( 'WOOREPORTS_PLUGIN_BASENAME', plugin_basename( WOOREPORTS_PLUGIN_FILE ) );
}

// Autoloader.
require_once 'vendor/autoload.php';

// Bootstrap Wooreports.
use LubusIN\WooReports\Woo_Reports;

/**
 * Main instance of Wooreports.
 *
 * Returns the main instance of Wooreports to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return WooReports
 */
function wooreports() {
	return Woo_Reports::get_instance();
}

wooreports();
