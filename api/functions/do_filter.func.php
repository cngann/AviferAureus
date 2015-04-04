<?php
/**
 * Do Filter
 *
 * @param 	string		$filter_name	The name of the Filter
 * @param	string		$str			String to filter
 * @param 	array		$params			a list of params that override the values of the function array
 * @return	boolean		success
 */
function do_filter ( $filter_name, $str, $params = [] ) {

	global $filters;

	return $filters->do_filter($filter_name, $str, $params);

}
