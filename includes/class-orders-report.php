<?php
/**
 * Orders Report
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
 * Orders Report
 */
class Orders_Report {
	/**
	 * Bootstrap Orders Report
	 *
	 * @return void
	 */
	public static function init() {
		add_action( 'admin_menu', [ __CLASS__, 'add_menu' ] );
		add_action( 'admin_enqueue_scripts', [ __CLASS__, 'enqueue_assets' ] );
		add_filter( 'set-screen-option', [ __CLASS__, 'save_screen_options' ], 10, 3 );
	}

	/**
	 * Plugin plugin submenu under woocommerce
	 *
	 * @return void
	 */
	public static function add_menu() {
		$hook_suffix = add_submenu_page(
			'woocommerce',
			'Orders Report',
			'Orders Report',
			'manage_options',
			'wc-orders-report',
			[ __CLASS__, 'render_page' ]
		);

		add_action( 'load-' . $hook_suffix, [ __CLASS__, 'add_screen_options' ] );
	}

	/**
	 * Register Scripts
	 *
	 * @return void
	 */
	public static function enqueue_assets() {
		// Scripts.
		wp_enqueue_script( 'wooreports-script' );

		// Styles.
		wp_enqueue_style( 'wooreports-style' );

	}

	/**
	 * Render plugin subpage
	 *
	 * @return void
	 */
	public static function render_page() {
		// Create admin list table.
		$orders_table = new Orders_List_Table();
		$orders_table->prepare_items();

		// Display admin list tables.
		include_once 'views/orders-list-table/page.php';
	}

	/**
	 * Sales screen options
	 */
	public static function add_screen_options() {
		$arguments = array(
			'label'   => 'Records Per Page',
			'default' => 20,
			'option'  => 'wooreports_orders_per_page',
		);
		add_screen_option( 'per_page', $arguments );
	}

	/**
	 * Save screen Options
	 *
	 * @param bool   $keep   Whether to save or skip saving the screen option value.
	 * @param string $option The option name.
	 * @param int    $value  The number of rows to use.
	 *
	 * @return int|bool
	 */
	public static function save_screen_options( $keep, $option, $value ) {
		if ( 'wooreports_orders_per_page' === $option ) {
			return $value;
		}

		return $keep;
	}
}
