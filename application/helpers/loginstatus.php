<?php

class LoginStatus{
	protected $_ci;

	public function __construct(){
		$this->_ci =&get_instance();
	}

	public function check_login(){
		if($this->_ci->session->userdata('logged_in')==true){
			return true;
		}else{
			return false;
		}
	}
}