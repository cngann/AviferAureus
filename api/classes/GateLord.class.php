<?php
class GateLord{

	private $perms = [];

	public function add_perm ( $address, $level = PERM_PUBLIC ) {

		$this->perms[$address] = $level;

		return true;

	}

	private function check_login_status ( ) {

		// TODO: Check Login Status

		return true;

	}

	private function check_admin_status ( ) {

		// TODO: Check Admin Status

		return true;

	}

	public function can_access($address){
		if ( ! array_key_exists ( $address, $this->perms ) ) return true;
		if ( $this->perms[$address]  == PERM_PUBLIC ) return true;
		if ( ! $this->check_login_status ( ) ) return 401;
		if ( $this->perms[$address]  == PERM_LOGGED_IN ) return true;
		if ( ! $this->check_admin_status ( ) ) return 403;
		if ( $this->perms[$address]  == PERM_ADMIN ) return true;

		return true;

	}

}