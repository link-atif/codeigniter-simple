<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Loginusers extends CI_Controller
{
	function __construct()
    {
        parent::__construct();
		$this->load->model('Admin_model');
		$this->load->model('Users_model');
		$this->load->model('Contactqueries_model');
		$this->load->model('Blogs_model');
		$this->load->model('Services_model');
		$this->load->model('Portfolio_model');
		$this->load->model('Preferences_model');
		$this->lang->load('access','english');
		if(!$this->session->userdata('admin_id')) {
			redirect(base_url().'admin/login');		
		}
    }
    
	public function index()
	{
        //$data['oneMonth']		= 0;//$this->Users_model->getOneMonthAmounts();

		$data['contactqueries'] = $this->Contactqueries_model->getAllusers(array(),0,5);

		$data['page_title'] = 'Customers';
		$data['page_heading'] = 'Customers';
		$this->load->view('admin/loginusers',$data);
	}

	public function delete($id) {

		$data['user'] = $this->Contactqueries_model->deleteUsers($id);
		redirect(base_url().'admin/Loginusers?msg=Deleted Successfully');
	}
	
	
}
?>