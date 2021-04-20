<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Doopcon extends CI_Controller
{
	
    
    
	public function index()
	{
		$this->load->view('admin/dashboard')
	}
	

	
	
	
}
?>