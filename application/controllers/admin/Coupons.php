<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Coupons extends CI_Controller
{
	function __construct() {

        parent::__construct();
		$this->load->model('Coupons_model');
		$this->load->model('Common_model');
		$this->load->model('Contactqueries_model');
		$this->load->model('Emailtemplates_model');
		$this->load->model('Registration_model');
		$this->load->model('Users_model');
		$this->load->model('Preferences_model');
		if(!$this->session->userdata('admin_id')) {
			redirect(base_url().'admin/login');
		}
		
    }
    
	public function index() {
		
		$data['pages']         = $this->Coupons_model->getAllCoupons();
		$data['page_title']    = 'Coupons';
		$data['page_heading']  = 'Coupons';
		
		$data['msg'] = $this->input->get('msg') ? $this->input->get('msg') : '';
		$this->load->view('admin/coupons',$data);
	}

	public function addCoupon() {
		
		$data['page_title']       = 'Add Coupons';
		$data['page_heading']     = 'Add Coupons';
		//$data['parent_pages']     = $this->Pages_model->getParentPages();
		
		if($this->input->post()) {
			$rules = array(
			    array(
                	'field'   => 'code',
                 	'label'   => 'Code',
                 	'rules'   => 'trim|required'
              	),
              	array(
                     'field'   => 'value',
                     'label'   => 'Value',
                     'rules'   => 'trim|required'
                )
            );

			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$pages = array(
					
					"value" => $this->input->post('value'),
					"code" => $this->input->post('code'),
					"type" => $this->input->post('type')
				);

				$page_id = $this->Coupons_model->save_coupons($pages);
				redirect('admin/coupons?msg=Added Successfully');
				
			}else{
				$data['pageDetail'] = $_REQUEST;
			}
		}else {
			$data['pageDetail'] = array();
		}
		$this->load->view('admin/add_coupons',$data);
	}

	public function editcoupons() {

		$pageRow                 = $this->Coupons_model->get_coupons_by_id($this->input->get('id'));
		if($pageRow) {
			$data['pageDetail']  = $pageRow;
		}else {
			redirect(base_url()."admin/coupons?msg=Invalid Page");
		}
		$data['page_title']       = 'Edit Coupons';
		$data['page_heading']     = 'Edit Coupons';

		if($this->input->post()) {
			$rules = array(
			    array(
                	'field'   => 'code',
                 	'label'   => 'Code',
                 	'rules'   => 'trim|required'
              	),
              	array(
                     'field'   => 'value',
                     'label'   => 'Value',
                     'rules'   => 'trim|required'
                )
            );

			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run()) {
				//$packageRow = $this->Packages_model->getRow($this->input->post('package_id'));
				$page_id = $this->input->post('page_id');
				$page = array(
					"code" => $this->input->post('code'),
					"code" => $this->input->post('code'),
					"type"=>$this->input->post('type')
				);
				$m = $this->Coupons_model->update_coupons($page, $this->input->post('page_id'));
                redirect('admin/coupons?msg=Updated Successfully');
				
				
			}else{
				$data['pageDetail'] = $_REQUEST;
			}
		}
		//$data['language'] = $this->Common_model->get_all_languages();
		$this->load->view('admin/edit_coupons',$data);
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
		redirect('admin/pages?msg=Deleted Successfully');
	}

}
