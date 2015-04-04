<?php
/**
 * Add Page
 *
 * @param $address
 * @param $function
 * @return bool
 */
function add_page ( $address, $function ) {

	global $pagemaster;

	return $pagemaster->add ( $address, $function );

}
