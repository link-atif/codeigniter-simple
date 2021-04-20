<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Newsletter extends CI_Controller
{
	function __construct()
    {
        parent::__construct();
		$this->load->model('Admin_model');
		$this->load->model('Newsletter_model');
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

		$data['news'] = $this->Newsletter_model->getAllNews();
		$data['page_title'] = 'Newsletter Subscribers';
		$data['page_heading'] = 'Dashboard';
		$this->load->view('admin/newsletter',$data);
	}

	public function delete($id) {

		$data['user'] = $this->Newsletter_model->deleteNews($id);
		redirect(base_url().'admin/Newsletter?msg=Deleted Successfully');
	}
	
	public function export()
	{
		$newsLetter = $this->Newsletter_model->getAllNewsLetters();
		exportProducts($newsLetter);		
	}

	public function download(){
        $filepath = base_url()."uploads/exports/" . $_GET['filename'];
        header("Content-Type: text/csv");
        header("Content-Disposition: attachment; filename=" . $_GET['filename']);
        echo file_get_contents($filepath);
    }
}
?>