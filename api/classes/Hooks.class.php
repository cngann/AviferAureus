<?php
/**
 * Hooks
 *
 * Adds a hooks system to a PHP Program
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
 * Class Hooks
 */
class Hooks {

	/**
	 * Array of Hooks
	 *
	 * @var array
	 */
	private $hooks = [];

	/**
	 * Add new hook to Array
	 *
	 * @access private
	 * @param string $name
	 * @return bool
	 */
	private function new_hook($name){
		for($i = HOOK_PRIORITY_MIN; $i <= HOOK_PRIORITY_MAX; $i++) $this->hooks[$name][$i] = [];
		return true;
	}

	/**
	 * Add New Hook
	 *
	 * @access public
	 * @param string $hook
	 * @param mixed $callback
	 * @param int $priority
	 * @param array $args_arr
	 * @return bool
	 */
	public function add_func($hook, $callback, $priority = 5, $args_arr = []){
		if ( empty ( $hook ) || ! is_string ( $hook ) ) return false;
		if ( empty ( $callback ) || ! ( is_string ( $callback ) || ( is_array ( $callback ) && count ( $callback ) == 2 ) ) ) return false;
		if ( empty ( $this->hooks[$hook] ) ) $this->new_hook ( $hook );

		$priority = is_int ( $priority ) ? ( $priority > HOOK_PRIORITY_MAX ? HOOK_PRIORITY_MAX : ( $priority < HOOK_PRIORITY_MIN ? HOOK_PRIORITY_MIN : $priority ) ) : 5;

		$this->hooks[$hook][$priority][] = [ 'callback' => $callback, 'args' => $args_arr ];

		return true;
	}

	/**
	 * Run Hook
	 *
	 * @param string $name
	 * @param array $params
	 * @return bool
	 */
	function do_hook ( $name, $params = [] ) {

		if ( empty($this->hooks[$name] ) ) return false;

		foreach ( $this->hooks[$name] as $priority ) {

			foreach ( $priority as $hook ) {

				if ( ! empty ( $params ) ) foreach ( $hook['args'] as $k => $v ) $hook[$k] = empty ( $params[$k] ) ? $v : $params[$k];
				$args = [];
				foreach ( $hook['args'] as $arg ) $args[] = $arg;

				if 		( is_string  ( $hook['callback'] ) ) call_user_func_array($hook['callback'], $args);
				else if ( is_callable( $hook['callback'] ) ) $hook['callback']( $args );
				else 	return false;

			}

		}

		return true;

	}

}