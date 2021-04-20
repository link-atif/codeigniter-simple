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

		$data['registerd'] = $this->Register_model->getAllUsers();
		$data['page_title'] = 'Registerd Users';
		$data['page_heading'] = 'Registerd Users';
		$this->load->view('admin/registerd_users',$data);
	}

	public function delete($id) {

		$data['user'] = $this->Register_model->delete($id);
		redirect(base_url().'admin/register?msg=Deleted Successfully');
	}

	public function export()
	{
		$users = $this->Register_model->getAllUsers();
		exportUsers($users);		
	}

	public function download(){
        $filepath = base_url()."uploads/exports/" . $_GET['filename'];
        header("Content-Type: text/csv");
        header("Content-Disposition: attachment; filename=" . $_GET['filename']);
        echo file_get_contents($filepath);
    }
	
	
}
?>