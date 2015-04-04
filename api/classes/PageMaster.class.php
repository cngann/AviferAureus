<?php
/**
 * PageMaster
 *
 * Adds a Page system to a PHP Program
 *
 * @author Michael Flynn <mflynn@cngann.com>
 * @version 1.0
 */

/**
 * Class PageMaster
 */
class PageMaster {

	/**
	 * List of Addresses and Callbacks
	 *
	 * @var array
	 */
	private $list = [];

	/**
	 * Add Address
	 *
	 * @param string 	$address
	 * @param mixed		$callback
	 * @return bool
	 */
	public function add ( $address, $callback ) {

		if ( ! empty ( $this->list[$address] ) ) return false;

		$this->list[$address] = $callback;

		return true;

	}

	/**
	 * Run Page
	 *
	 * @param string $address
	 * @return bool
	 */
	public function run ( $address ) {

		// Not Found
		if ( empty ( $this->list[$address] ) ) return 404;

		// Error
		if ( ! is_callable ( $this->list[$address] ) ) return 500;

		if ( is_int( gate_lord ( $address ) ) ) return gate_lord ( $address );

		do_hook ( 'page_' . $address . '_before' );

		$return =  is_string  ( $this->list[$address] ) ? call_user_func ( $this->list[$address] ) : $this->list[$address]( );

		$return = is_int($return) ? $return : do_filter ( 'page_' . $address , $return);

		do_hook ( 'page_' . $address . '_after' );

		return $return;

	}

}