<?php
/**
 * Add Hook
 *
 * @param 	string 		$hook 		The name of the hook
 * @param 	callback 	$callback 	The function callback
 * @param 	array 		$args_arr 	The array of parameters, in order
 * @param 	int 		$priority 	The priority
 * @return 	boolean 	success
 */
function add_hook ( $hook, $callback, $priority = 5, $args_arr = [] ) {

	global $hooks;

	return $hooks->add_func ( $hook, $callback, $priority, $args_arr );

}
