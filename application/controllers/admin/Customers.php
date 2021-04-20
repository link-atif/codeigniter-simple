<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends CI_Controller
{
	function __construct() {

        parent::__construct();
		$this->load->model('Customer_model');
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
		
		$data['pages']         = $this->Customer_model->getAllCustomers();
		$data['page_title']    = 'Customers';
		$data['page_heading']  = 'Customers';
		
		$data['msg'] = $this->input->get('msg') ? $this->input->get('msg') : '';
		$this->load->view('admin/customers',$data);
	}

	public function add() {
		
		$data['page_title']       = 'Add Customers';
		$data['page_heading']     = 'Add Customers';
		//$data['parent_pages']     = $this->Pages_model->getParentPages();
		
		if($this->input->post()) {
			$rules =array(
			       array(
                	'field'   => 'first_name_english',
                 	'label'   => 'Name',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'adress_english',
                 	'label'   => 'Adress',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'email',
                 	'label'   => 'Email',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'phone_english',
                 	'label'   => 'Phone',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'last_name_english',
                 	'label'   => 'Last name',
                 	'rules'   => 'trim|required'
              	),
              	array(
                     'field'   => 'state_english',
                     'label'   => 'state',
                     'rules'   => 'trim|required'
                 ),
              	array(
                	'field'   => 'first_name_arabic',
                 	'label'   => 'Name',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'adress_arabic',
                 	'label'   => 'Adress',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'phone_arabic',
                 	'label'   => 'Phone',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'last_name_arabic',
                 	'label'   => 'Last name',
                 	'rules'   => 'trim|required'
              	),
              	array(
                     'field'   => 'state_arabic',
                     'label'   => 'state',
                     'rules'   => 'trim|required'
                 )
            );
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$location = array(
					"first_name_english" => $this->input->post('first_name_english'),
					"last_name_english" => $this->input->post('last_name_english'),
					"email"=>$this->input->post('email'),
					"adress_english" =>$this->input->post('adress_english'),
					"phone_english" => $this->input->post('phone_english'),
					"country_english"=>$this->input->post('country_english'),
					"state_english"=>$this->input->post('state_english'),
					"city_english"=>$this->input->post('city_english'),
					"zip_code"=>$this->input->post('zip_code'),
					"first_name_arabic" => $this->input->post('first_name_arabic'),
					"last_name_arabic" => $this->input->post('last_name_arabic'),
					"adress_arabic" =>$this->input->post('adress_arabic'),
					"phone_arabic" => $this->input->post('phone_arabic'),
					"country_arabic"=>$this->input->post('country_arabic'),
					"state_arabic"=>$this->input->post('state_arabic'),
					"city_arabic"=>$this->input->post('city_arabic')
				);
				$Users_record = $this->Customer_model->save($location);
				//$data = $this->input->post();
				/*$count_languages = count($this->input->post('language_id'));
				for($i=0; $i< $count_languages; $i++){
					$page_description[] = [
                        "location_id" => $location_id,
						"language_id" => $data['language_id'][$i],
						"name" => $data['name'][$i],
						"adress" => $data['adress'][$i],
						"phone" => $data['phone'][$i],
						"email" => $data['email'][$i],
						"latitue" => $data['latitue'][$i],
						"longitude" => $data['longitude'][$i]
                    ];
				}
	     		$user_record			=	$this->Customer_model->save_location($page_description);*/
				if($Users_record) {
					redirect('admin/Customers?msg=Added Successfully');
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
		$this->load->view('admin/addCustomer',$data);
	}

	public function edit() {

		$pageRow                 = $this->Customer_model->get_Customer_by_id($this->input->get('id'));
		if($pageRow) {
			$data['pageDetail']  = $pageRow;
		}else {
			redirect(base_url()."admin/Customers?msg=Invalid Page");
		}
		$data['page_title']       = 'Edit Customers';
		$data['page_heading']     = 'Edit Customers';

		if($this->input->post()) {
			$rules = array(
			    array(
                	'field'   => 'first_name_english',
                 	'label'   => 'Name',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'adress_english',
                 	'label'   => 'Adress',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'email',
                 	'label'   => 'Email',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'phone_english',
                 	'label'   => 'Phone',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'last_name_english',
                 	'label'   => 'Last name',
                 	'rules'   => 'trim|required'
              	),
              	array(
                     'field'   => 'state_english',
                     'label'   => 'state',
                     'rules'   => 'trim|required'
                 ),
              	array(
                	'field'   => 'first_name_arabic',
                 	'label'   => 'Name',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'adress_arabic',
                 	'label'   => 'Adress',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'phone_arabic',
                 	'label'   => 'Phone',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'last_name_arabic',
                 	'label'   => 'Last name',
                 	'rules'   => 'trim|required'
              	),
              	array(
                     'field'   => 'state_arabic',
                     'label'   => 'state',
                     'rules'   => 'trim|required'
                 )
            );

			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run()) {
				//$packageRow = $this->Packages_model->getRow($this->input->post('package_id'));
				 $location_id = $this->input->get('id');
				$page = array(
					"first_name_english" => $this->input->post('first_name_english'),
					"last_name_english" => $this->input->post('last_name_english'),
					"email"=>$this->input->post('email'),
					"adress_english" =>$this->input->post('adress_english'),
					"phone_english" => $this->input->post('phone_english'),
					"country_english"=>$this->input->post('country_english'),
					"state_english"=>$this->input->post('state_english'),
					"city_english"=>$this->input->post('city_english'),
					"zip_code"=>$this->input->post('zip_code'),
					"first_name_arabic" => $this->input->post('first_name_arabic'),
					"last_name_arabic" => $this->input->post('last_name_arabic'),
					"adress_arabic" =>$this->input->post('adress_arabic'),
					"phone_arabic" => $this->input->post('phone_arabic'),
					"country_arabic"=>$this->input->post('country_arabic'),
					"state_arabic"=>$this->input->post('state_arabic'),
					"city_arabic"=>$this->input->post('city_arabic')
				);


				$user_record = $this->Customer_model->update($page, $location_id);

				
				if($user_record) {
					redirect('admin/Customers?msg=Updated Successfully');
				}else {
					$data['error']	    = 'Some Error try later';
					$data['pageDetail'] = $_REQUEST;
				}
				
			}else{
				$data['pageDetail'] = $_REQUEST;
			}
		}

		//$data['language'] = $this->Common_model->get_all_languages();

		$this->load->view('admin/edit_Customer',$data);
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
		$data['pages'] = $this->Customer_model->delete($id);
		redirect('admin/Customers?msg=Deleted Successfully');
	}

}
