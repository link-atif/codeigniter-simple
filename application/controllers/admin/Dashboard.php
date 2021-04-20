<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	function __construct()
    {
        parent::__construct();
		$this->load->model('Admin_model');
		$this->load->model('Users_model');
		$this->load->model('Contactqueries_model');
		$this->load->model('Plans_model');
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

		$data['contactqueries'] = $this->Contactqueries_model->getAllQueries();
		$data['page_title'] = 'Dashboard';
		$data['page_heading'] = 'Dashboard';
		$this->load->view('admin/dashboard',$data);
	}
	public function cont()
	{
		$this->load->view('admin/cont');
	}

	public function delete($id) {

		$data['user'] = $this->Contactqueries_model->delete($id);
		redirect(base_url().'admin/Dashboard?msg=Deleted Successfully');
	}
	
	
}
?>