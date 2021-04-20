<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Emailtemplates extends CI_Controller
{
	function __construct() {

        parent::__construct();
		$this->load->model('Emailtemplates_model');
		$this->load->model('Common_model');
		$this->load->model('Admin_model');
		$this->load->model('Preferences_model');
		if(!$this->session->userdata('admin_id')) {
			redirect(base_url().'admin/login');
		}
		$this->Admin_model->checkAdminUserISAdmin();
    }
    
	public function index() {
		
		$data['pages']         = $this->Emailtemplates_model->getAllRows();
		$data['page_title']    = 'Email Templates';
		$data['page_heading']  = 'Email Templates';
		
		$data['msg'] = $this->input->get('msg') ? $this->input->get('msg') : '';
		$this->load->view('admin/emailtemplates',$data);
	}

	public function edit() {

		if($this->input->get('id')) {
			$id 				  = $this->input->get('id');
			$data['page_title']   = 'Edit Email Template';
			$data['page_heading'] = 'Edit Email Template';
		}else {
			redirect(base_url()."admin/emailtemplates?msg=Invalid page");
		}
		$emailTemplateRow        = $this->Emailtemplates_model->getSingleRowDetails($this->input->get('id'));
		if($emailTemplateRow) {
			$data['emailTemplateRow']  = $emailTemplateRow;
		}else {
			redirect(base_url()."admin/emailtemplates?msg=Invalid user");
		}

		if($this->input->post()) {
			$rules = array(
			    array(
                	'field'   => 'from_name',
                 	'label'   => 'From Name',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'from_email',
                 	'label'   => 'From Email',
                 	'rules'   => 'trim|required'
              	),
              	array(
                     'field'   => 'message',
                     'label'   => 'Detail',
                     'rules'   => 'trim|required'
                )
            );

			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run()) {
				//$packageRow = $this->Packages_model->getRow($this->input->post('package_id'));
				$array = array(
							"from_name"  => $this->input->post('from_name'),
							"from_email" => $this->input->post('from_email'),
							"subject"  	 => $this->input->post('subject'),
							"message"  	 => $this->input->post('message'),
						 );
				$user_record	=	$this->Emailtemplates_model->updateRow($array,$this->input->post('id'));
				if($user_record) {
					redirect(base_url().'admin/emailtemplates?msg=Updated Successfully');
				}else {
					$data['error']	    = 'Some Error try later';
					$data['pageDetail'] = $_REQUEST;
				}
				
			}else{
				$data['pageDetail'] = $_REQUEST;
			}
		}

		$this->load->view('admin/edit_emailtemplate',$data);
	}
	function seoUrl($string) {
	    //Unwanted:  {UPPERCASE} ; / ? : @ & = + $ , . ! ~ * ' ( )
	    $string = strtolower($string);
	    //Strip any unwanted characters
	    $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
	    //Clean multiple dashes or whitespaces
	    $string = preg_replace("/[\s-]+/", " ", $string);
	    //Convert whitespaces and underscore to dash
	    $string = preg_replace("/[\s_]/", "-", $string);
	    return $string;
	}

	/*public function updatePackage(){
		if($this->input->get('id')) {
			$id 				  = $this->input->get('id');
			$data['page_title']   = 'Update User Package';
			$data['page_heading'] = 'Update User Package';
		}else {
			redirect(base_url()."admin/users?msg=Invalid user");
		}
		$userRow                 = $this->Pages_model->getRow($this->input->get('id'));
		
		if($userRow) {
			$userRow['password'] = $this->Common_model->decryptIt($userRow['password']);
			$data['pageDetail']  = $userRow;
		}else {
			redirect(base_url()."admin/adminUsers?msg=Invalid user");
		}

		$this->load->view('admin/update_user_package',$data);
	}*/

	public function delete($id) {
		$data['user'] = $this->Pages_model->delete($id);
		redirect(base_url().'admin/pages?msg=Deleted Successfully');
	}
}