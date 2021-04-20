<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller
{
	function __construct()
    {
        parent::__construct();
		$this->load->model('Admin_model');
		$this->load->model('Users_model');
		$this->load->model('Register_model');
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

		$data['registerd'] = $this->Register_model->getAllUsers();
		$data['page_title'] = 'Registerd Users';
		$data['page_heading'] = 'Registerd Users';
		$this->load->view('admin/order',$data);
	}

	public function delete($id) {

		$data['user'] = $this->Register_model->delete($id);
		redirect(base_url().'admin/order?msg=Deleted Successfully');
	}
	
	
}
?>