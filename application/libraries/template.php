<?php

class Template{
	protected $_ci;

	function __construct(){
		$this->_ci =&get_instance(); 
	}

	function display($template,$data=NULL){
		$data['_content']=$this->_ci->load->view($template,$data,TRUE);
		$this->_ci->load->view('/template.php',$data);
	}
}
