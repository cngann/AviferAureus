<?php
/**
 * Run Page
 *
 * @param $address
 * @return bool
 */
function do_page ( $address ) {

	global $pagemaster;

	$return = $pagemaster->run ( $address );

	if ( is_int ($return) ){
		http_response_code($return);
		exit;
	}
	else {
		if ( empty ( $return ) ) http_response_code ( 204 );
		echo json_encode ( $return );
		http_response_code ( 200 );
		exit;
	}

}