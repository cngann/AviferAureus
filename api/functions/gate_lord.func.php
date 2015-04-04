<?php
function gate_lord($address){
	global $gatelord;
	return $gatelord->can_access($address);
}