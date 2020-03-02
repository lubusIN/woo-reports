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
		// Frontend.

		// Admin.
		if ( is_admin() ) {
			// TODO.
		}
	}
}
