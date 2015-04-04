<?php
/**
 * Do Hook
 *
 * @param 	string		$hook_name	The name of the Hook
 * @param 	array		$params		a list of params that override the values of the function array
 * @return	boolean		success
 */
function do_hook($hook_name, $params = []){

	global $hooks;

	return $hooks->do_hook ( $hook_name, $params);

}