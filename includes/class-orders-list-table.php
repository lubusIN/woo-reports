<?php
/**
 * Orders List Table
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
class Orders_List_Table extends \WP_List_Table {
	/**
	 * Add extra markup in the toolbars before or after the list
	 *
	 * @param string $which helps you decide if you add the markup after (bottom) or before (top) the list.
	 */
	public function extra_tablenav( $which ) {
		if ( 'top' === $which ) {
			require_once 'views/orders-list-table/filters.php';
		}
	}

	/**
	 * Text displayed when no record data is available
	 */
	public function no_items() {
		require_once 'views/orders-list-table/empty.php';
	}

	/**
	 * Returns the data from the database.
	 *
	 * @return object|array
	 */
	public function get_records() {
		// Query orders with WP_Query.
		$query = new \WC_Order_Query(
			[
				'limit'    => $this->get_items_per_page( 'wooreports_orders_per_page', 20 ),
				'paged'    => $this->get_pagenum(),
				'paginate' => true,
				'orderby'  => 'date',
				'order'    => 'DESC',
				'status'   => 'completed',
			]
		);

		$orders = $query->get_orders();

		return $orders;
	}

	/**
	 * Returns the count of records in the database.
	 *
	 * @return null|string
	 */
	public function get_record_count() {
		$orders = $this->get_records();

		return $orders->total;
	}

	/**
	 * Override the parent columns method. Defines the columns to use in your listing table
	 *
	 * @return Array
	 */
	public function get_columns() {
		$columns = [
			'id'           => 'Id',
			'date'         => 'Date',
			'customer'     => 'Customer',
			'address'      => 'Address',
			'email'        => 'Email',
			'phone'        => 'Phone',
			'items'        => 'Items',
			'currency'     => 'Currency',
			'value'        => 'Value',
			'shipping'     => 'Shipping',
			'amount'       => 'Amount',
			'gateway'      => 'Gateway',
			'reference_no' => 'Reference No',
			'status'       => 'status',
		];

		return $columns;
	}

	/**
	 * Define what data to show on each column of the tab
	 *
	 * @param  Array  $order        Data.
	 * @param  String $column_name Current column name.
	 *
	 * @return Mixed
	 */
	public function column_default( $order, $column_name ) {
		switch ( $column_name ) {
			case 'id':
				return $order->get_id();
			case 'date':
				return $order->get_date_created()->format( 'd-m-Y' );
			case 'customer':
				return $order->get_formatted_billing_full_name();
			case 'address':
				return $order->get_formatted_shipping_address();
			case 'email':
				return $order->get_billing_email();
			case 'phone':
				return $order->get_billing_phone();
			case 'items':
				$order_items = $order->get_items();

				$list = '<ul>';
				foreach ( $order_items as $order_item ) {
					$list .= '<li>' . $order_item->get_name() . '</li>';
				}
				$list .= '</ul>';

				return $list;
			case 'currency':
				return $order->get_currency();
			case 'value':
				return $order->get_subtotal();
			case 'shipping':
				return $order->get_shipping_total();
			case 'amount':
				return $order->get_total();
			case 'gateway':
				return $order->get_payment_method();
			case 'reference_no':
				return $order->get_transaction_id();
			case 'status':
				return $order->get_status();
			default:
				return 'N/A';
		}
	}

	/**
	 * Prepare the table with different parameters, pagination, columns and table elements
	 */
	public function prepare_items() {
		$columns = $this->get_columns();

		$this->_column_headers = array(
			$columns,
		);

		$per_page     = $this->get_items_per_page( 'wooreports_orders_per_page', 20 );
		$current_page = $this->get_pagenum();
		$total_items  = $this->get_record_count();

		$data = $this->get_records( $per_page, $current_page );

		$this->set_pagination_args(
			[
				'total_items' => $total_items,
				'per_page'    => $per_page,
			]
		);

		$this->items = $data->orders;
	}
}
