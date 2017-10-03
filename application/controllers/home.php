<?php
class Home extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->loginstatus->check_login();
		$this->load->library('template');
	}

	public function index(){
		$this->template->display('dashboard');
	}
}