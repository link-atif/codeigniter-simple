<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Location extends CI_Controller
{
	function __construct() {

        parent::__construct();
		$this->load->model('Location_model');
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
		
		$data['pages']         = $this->Location_model->getAllLocation();
		$data['page_title']    = 'Locations';
		$data['page_heading']  = 'Locations';
		
		$data['msg'] = $this->input->get('msg') ? $this->input->get('msg') : '';
		$this->load->view('admin/location',$data);
	}

	public function add() {
		
		$data['page_title']       = 'Add Location';
		$data['page_heading']     = 'Add Location';
		//$data['parent_pages']     = $this->Pages_model->getParentPages();
		
		if($this->input->post()) {
			$rules =array(
			       array(
                	'field'   => 'name',
                 	'label'   => 'Name',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'adress',
                 	'label'   => 'Adress',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'email',
                 	'label'   => 'Email',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'phone',
                 	'label'   => 'Phone',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'longitude',
                 	'label'   => 'Longitude',
                 	'rules'   => 'trim|required'
              	),
              	array(
                     'field'   => 'latitue',
                     'label'   => 'Latitue',
                     'rules'   => 'trim|required'
                 )
            );
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$location = array(
					"date_modified" => date("Y-m-d"),
					"date_created" => date("Y-m-d"),
					"time_starts" => date("H:i:s", strtotime($this->input->post("time_starts"), TRUE)),
					"name" => $this->input->post('name'),
					"adress" => $this->input->post('adress'),
					"phone" => $this->input->post('phone'),
					"email" => $this->input->post('email'),
					"latitue" => $this->input->post('latitue'),
					"longitude" => $this->input->post('longitude'),
					"time_end" => date("H:i:s", strtotime($this->input->post("time_end"), TRUE)),
					/*"merchant_id" => $this->input->post('merchant_id'),
					"api_token" => $this->input->post('api_token'),*/
				);
	
				$location_id = $this->Location_model->save($location);
				
				if($location_id) {
					redirect('admin/Location?msg=Added Successfully');
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
		$this->load->view('admin/addlocation',$data);
	}

	public function edit() {

		$pageRow                 = $this->Location_model->get_location_by_id($this->input->get('id'));
		if($pageRow) {
			$data['pageDetail']  = $pageRow;
		}else {
			redirect(base_url()."admin/Location?msg=Invalid Page");
		}
		$data['page_title']       = 'Edit Location';
		$data['page_heading']     = 'Edit Location';

		if($this->input->post()) {
			$rules = array(
			    array(
                	'field'   => 'name',
                 	'label'   => 'name',
                 	'rules'   => 'trim|required'
              	),
              	array(
                     'field'   => 'adress',
                     'label'   => 'adress',
                     'rules'   => 'trim|required'
                )
            );

			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run()) {
				//$packageRow = $this->Packages_model->getRow($this->input->post('package_id'));
				echo $location_id = $this->input->get('id');
				$page = array(
					"date_modified" => date("Y-m-d"),
					"time_starts" => date("H:i:s", strtotime($this->input->post("time_starts"), TRUE)),
					"name" => $this->input->post('name'),
					"adress" => $this->input->post('adress'),
					"phone" => $this->input->post('phone'),
					"email" => $this->input->post('email'),
					"latitue" => $this->input->post('latitue'),
					"longitude" => $this->input->post('longitude'),
					"time_end" => date("H:i:s", strtotime($this->input->post("time_end"), TRUE)),
					/*"merchant_id" => $this->input->post('merchant_id'),
					"api_token" => $this->input->post('api_token'),*/
				);
				$m = $this->Location_model->update($page, $location_id);
				if($m) {
					redirect('admin/Location?msg=Updated Successfully');
				}else {
					$data['error']	    = 'Some Error try later';
					$data['pageDetail'] = $_REQUEST;
				}
				
			}else{
				$data['pageDetail'] = $_REQUEST;
			}
		}
		//$data['language'] = $this->Common_model->get_all_languages();

		$this->load->view('admin/edit_location',$data);
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
		$data['user'] = $this->Location_model->delete($id);
		redirect('admin/location?msg=Deleted Successfully');
	}

}