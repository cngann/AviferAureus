<?php
/**
 * Filters
 *
 * Adds a filters system to a PHP Program
 *
 * @author Michael Flynn <mflynn@cngann.com>
 * @version 1.1
 */

/**
 * Change Log
 *
 * * 1.1
 * - Adding Anonymous Function Support
 *
 */

/**
 * Class Filters
 */
class Filters {

	/**
	 * Filters Array
	 *
	 * @access private
	 * @var array
	 */
	private $filters = [];

	/**
	 * Add New Filter to Array
	 *
	 * @access private
	 * @param string $name
	 */
	private function new_filter ( $name ) {
		for($i = FILTER_PRIORITY_MIN; $i <= FILTER_PRIORITY_MAX; $i++) $this->filters[$name][$i] = [];
	}

	/**
	 * Add Filter
	 *
	 * @access public
	 * @param string $filter
	 * @param mixed $callback
	 * @param int $priority
	 * @param array $args_arr
	 * @return bool
	 */
	public function add_func ( $filter, $callback, $priority = 5, $args_arr = [] ) {
		if ( empty ( $filter ) || ! is_string ( $filter ) ) return false;
		if ( empty ( $callback ) || ! ( is_string ( $callback ) || ( is_array ( $callback ) && count ( $callback ) == 2 ) ) ) return false;
		if ( empty ( $this->filters[$filter] ) ) $this->new_filter ( $filter );
		$priority = is_int ( $priority ) ? ( $priority > FILTER_PRIORITY_MAX ? FILTER_PRIORITY_MAX : ( $priority < FILTER_PRIORITY_MIN ? FILTER_PRIORITY_MIN : $priority ) ) : 5;  
		$this->filters[$filter][$priority][] = [ 'callback' => $callback, 'args' => $args_arr ];
		return true;
	}

	/**
	 * Run the Filter
	 *
	 * @access public
	 * @param string $name
	 * @param string $str
	 * @param array $params
	 * @return bool|mixed|string
	 */
	public function do_filter ( $name, $str = "", $params = [] ) {

		if ( ! array_key_exists($name, $this->filters) ) return $str;

		foreach ( $this->filters[$name] as $priority ) {

			foreach ( $priority as $filter ) {

				if( ! empty($params) ) foreach ( $filter['args'] as $k => $v ) $filter[$k] = empty ( $params[$k] ) ? $v : $params[$k];

				$args = [];
				$args[] = $str;

				foreach( $filter['args'] as $arg ) $args[] = $arg;

				if 		( is_string  ( $filter['callback'] ) ) $str = call_user_func_array($filter['callback'], $args);
				else if ( is_callable( $filter['callback'] ) ) $str = $filter['callback']( $args );
				else 	return $str;

			}

		}

		return $str;
	}
}