<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller
{
	function __construct() {

        parent::__construct();
		$this->load->model('Pages_model');
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
		
		$data['pages']         = $this->Pages_model->getAllPages();
		$data['page_title']    = 'Pages';
		$data['page_heading']  = 'Pages';
		
		$data['msg'] = $this->input->get('msg') ? $this->input->get('msg') : '';
		$this->load->view('admin/pages',$data);
	}

	public function addPage() {
		
		$data['page_title']       = 'Add Page';
		$data['page_heading']     = 'Add Page';
		//$data['parent_pages']     = $this->Pages_model->getParentPages();
		
		if($this->input->post()) {
			$rules = array(
			    array(
                	'field'   => 'title',
                 	'label'   => 'Title',
                 	'rules'   => 'trim|required'
              	),
              	array(
                     'field'   => 'body',
                     'label'   => 'description',
                     'rules'   => 'trim|required'
                )
            );

			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$pages = array(
					"status" => 1,
					"slug" => $this->input->post('slug'),
					"title" => $this->input->post('title'),
					"body" => $this->input->post('body'),
					"date_modified" => date("Y-m-d"),
					"date_created" => date("Y-m-d"),
					"type"=>$this->input->post('type')
				);

				$page_id = $this->Pages_model->save_page($pages);
				
				if($page_id) {
					redirect('admin/pages?msg=Added Successfully');
				}else {
					$data['error']	    = 'Some Error try later';
					$data['pageDetail'] = $_REQUEST;
				}
				
			}else{
				$data['pageDetail'] = $_REQUEST;
			}
		}else {
			$data['pageDetail'] = array();
		}
		//$data['language'] = $this->Common_model->get_all_languages();
		$this->load->view('admin/add_page',$data);
	}

	public function editPage($id) {


		$pageRow                 = $this->Pages_model->get_page_detail_by_id($id);
		if($pageRow) {
			$data['pageDetail']  = $pageRow;
		}else {
			redirect(base_url()."admin/pages?msg=Invalid Page");
		}
		$data['page_title']       = 'Edit Page';
		$data['page_heading']     = 'Edit Page';

		if($this->input->post()) {
			$rules = array(
			    array(
                	'field'   => 'title',
                 	'label'   => 'Title',
                 	'rules'   => 'trim|required'
              	),
              	array(
                     'field'   => 'body',
                     'label'   => 'Detail',
                     'rules'   => 'trim|required'
                )

            );

			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run()) {
				//$packageRow = $this->Packages_model->getRow($this->input->post('package_id'));
				$page_id = $this->input->post('page_id');
				$page = array(
					"status" => 1,
					"slug" => $this->input->post('slug'),
					"title" => $this->input->post('title'),
					"body" => $this->input->post('body'),
					"date_modified" => date("Y-m-d"),
					"type"=>$this->input->post('type')
				);
				
				$m = $this->Pages_model->update_page($page, $this->input->post('page_id'));

				if($m) {
					redirect('admin/Pages?msg=Updated Successfully');
				}else {
					$data['error']	    = 'Some Error try later';
					$data['pageDetail'] = $_REQUEST;
				}
				
			}else{
				$data['pageDetail'] = $_REQUEST;
			}
		}
		$data['language'] = $this->Common_model->get_all_languages();

		$this->load->view('admin/edit_page',$data);
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
