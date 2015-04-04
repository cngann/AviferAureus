<?php
function add_perm ( $address, $level = PERM_PUBLIC ) {
	global $gatelord;
	return $gatelord->add_perm($address, $level);
}