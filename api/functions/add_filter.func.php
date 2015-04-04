<?php
/**
* Add Filter
*
* @param 	string 		$filter 	The name of the filter
* @param 	callback 	$callback 	The function callback
* @param 	array 		$args_arr 	The array of parameters, in order
* @param 	int 		$priority 	The priority
* @return 	boolean 	success
*/
function add_filter ( $filter, $callback, $priority = 5, $args_arr = [] ) {

	global $filters;

	return $filters->add_func ( $filter, $callback, $priority, $args_arr );

}