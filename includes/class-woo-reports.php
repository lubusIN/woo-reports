<?php
/**
 * WooReports
 *
 * @author  Ajit Bohra <ajit@lubus.in>
 * @license MIT
 *
 * @see   https://www.lubus.in
 *
 * @copyright 2019 LUBUS
 * @package   WooReports
 */

namespace LubusIN\WooReports;

/**
 * Bootstrap plugin
 */
final class Woo_Reports {

	/**
	 * Instance.
	 *
	 * @since
	 *
	 * @var WooReports
	 */
	private static $instance;

	/**
	 * Singleton pattern.
	 *
	 * @since
	 */
	private function __construct() {
		$this->init();
	}

	/**
	 * Get instance.
	 *
	 * @since
	 *
	 * @return WooReports
	 */
	public static function get_instance() {
		if ( null === static::$instance ) {
			self::$instance = new static();
		}

		return self::$instance;
	}

	/**
	 * Hook into actions and filters.
	 *
	 * @since  1.0.0
	 */
	private function init() {
		// Setup Hooks.
		add_action( 'admin_enqueue_scripts', [ __CLASS__, 'register_assets' ] );

		// Load Modules.
		// Admin.
		if ( is_admin() ) {
			Orders_Report::init();
		}
	}

	/**
	 * Register Scripts
	 *
	 * @return void
	 */
	public static function register_assets() {
		// Scripts.
		wp_register_script(
			'wooreports-script',
			WOOREPORTS_PLUGIN_URL . 'assets/script.js',
			[ 'jquery' ],
			filemtime( WOOREPORTS_PLUGIN_DIR . 'assets/script.js' ),
			true
		);

		// Styles.
		wp_register_style(
			'wooreports-style',
			WOOREPORTS_PLUGIN_URL . 'assets/style.css',
			[],
			filemtime( WOOREPORTS_PLUGIN_DIR . 'assets/style.css' )
		);
	}
}
