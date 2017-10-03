<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Name:  FPDF
* 
* Author: Jd Fiscus
* 	 	  jdfiscus@gmail.com
*         @iamfiscus
*          
*
* Origin API Class: http://www.fpdf.org/
* 
* Location: http://github.com/iamfiscus/Codeigniter-FPDF/
*          
* Created:  06.22.2010 
* 
* Description:  This is a Codeigniter library which allows you to generate a PDF with the FPDF library
* 
*/

class Fpdf_gen {
		
	public function __construct() {
		
		require_once APPPATH.'third_party/fpdf/fpdf-1.8.php';
		
		$pdf = new FPDF();
		
		$CI =& get_instance();
		$CI->fpdf = $pdf;
		
	}
	
}