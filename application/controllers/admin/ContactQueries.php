<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class ContactQueries extends CI_Controller
{
	function __construct() {

        parent::__construct();
		$this->load->model('ContactQueries_model');
		$this->load->model('Preferences_model');
		$this->load->library("pagination");
		if(!$this->session->userdata('admin_id')) {
			redirect(base_url().'admin/login');
		}
    }
    
	public function index() {

		$arr 		           = array();
        $arr['name']           = $this->input->get('name') ? $this->input->get('name') : '';
		$config 			   = array();
        $config["base_url"]    = base_url() . "admin/contactQueries";
        $config["total_rows"]  = $this->ContactQueries_model->countQueriesTotal($arr);
        $config["per_page"]    = 10;
        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);

        $page 		           = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$data['users']         = $this->ContactQueries_model->getAllQueries($arr,$page,$config["per_page"] );
		$data["links"]         = $this->pagination->create_links();
		$data['page_title']    = 'Contact Queries';
		$data['page_heading']  = 'Contact Queries';
		
		$data['msg'] = $this->input->get('msg') ? $this->input->get('msg') : '';
		$this->load->view('admin/contact_queries',$data);
	}

	public function delete($id) {
		$data['user'] = $this->ContactQueries_model->delete($id);
		redirect(base_url().'admin/ContactQueries?msg=Deleted Successfully');
	}
	public function viewDetail($id){
		$data['page_title']    = 'Contact Query Detai';
		$data['page_heading']  = 'Contact Query Detai';
		$data['queryDetail'] = $this->ContactQueries_model->getRow($id);
		$this->load->view('admin/contactQuery_detail',$data);
	}
	
	public function deleteData(){
		$ids 	= $this->input->post('ids');
		$result = $this->ContactQueries_model->deleteAll($ids);
		echo "ok";
		exit();
	}
}
