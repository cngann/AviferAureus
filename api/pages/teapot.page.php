<?php
/**
 * I'm a teapot
 *
 * @return int
 */
function page_teapot ( ) {

	return ['string' => "I'm a teapot"]; //418;
	
}

add_perm('teapot', PERM_PUBLIC);
