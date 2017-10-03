<?php

class LoginStatus{
	protected $_ci;

	public function __construct(){
		$this->_ci =&get_instance();
	}

	public function check_login(){
		if($this->_ci->session->userdata('logged_in')==false){
			/*echo 'You don\'t permit to access this page.<br/>';
			echo '<a href="'.base_url().'user/login">Click here to login.</a>';
			die;*/
			redirect('user/login');
		}
	}
}