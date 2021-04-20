<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Package extends CI_Controller
{
	function __construct() {

        parent::__construct();
		$this->load->model('Package_model');
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
		
		$data['pages']         = $this->Package_model->getAllLocation();
		$data['page_title']    = 'Packages';
		$data['page_heading']  = 'Packages';
		
		$data['msg'] = $this->input->get('msg') ? $this->input->get('msg') : '';
		$this->load->view('admin/package',$data);
	}

	public function add () {
		
		$data['page_title']       = 'Add Package';
		$data['page_heading']     = 'Add Package';
		//$data['parent_pages']     = $this->Pages_model->getParentPages();
		
		if($this->input->post()) {
			$rules =array(
			       array(
                	'field'   => 'tittle',
                 	'label'   => 'Tittle',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'glass_item',
                 	'label'   => 'Glass Item',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'electronics',
                 	'label'   => 'Electronics',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'price',
                 	'label'   => 'Price',
                 	'rules'   => 'trim|required'
              	),
              
              	array(
                	'field'   => 'picture',
                 	'label'   => 'picture',
                 	'rules'   => 'trim|required'
              	)
              	
            );
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$location = array(
					"picture" => $this->input->post('picture'),
					"tittle" => $this->input->post('tittle'),
					"glass_item" => $this->input->post('glass_item'),
					"electronics" => $this->input->post('electronics'),
					"price" => $this->input->post('price'),
					"date_modified" => date("Y-m-d"),
					"date_created" => date("Y-m-d")
				);
				$location_id = $this->Package_model->save($location);
				if($location_id){
					$this->session->unset_userdata(array('picture_name'));
					redirect('admin/Package?msg=Added Successfully');
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
				/*if($user_record) {
					redirect('admin/Package?msg=Added Successfully');
				}else {
					$data['error']	    = 'Some Error try later';
					$data['pageDetail'] = $_REQUEST;
				}
				
			}else{
				$data['pageDetail'] = $_REQUEST;
			}
		}else {
			$data['pageDetail'] = array();
		}*/
		$data['language'] = $this->Common_model->get_all_languages();
		$this->load->view('admin/addPackage',$data);
	}

	public function edit() {

		$pageRow                 = $this->Package_model->get_Package_by_id($this->input->get('id'));
		if($pageRow) {
			$data['pageDetail']  = $pageRow;
		}else {
			redirect(base_url()."admin/Package?msg=Invalid Page");
		}
		$data['page_title']       = 'Edit Package';
		$data['page_heading']     = 'Edit Paackage';

		if($this->input->post()) {
			$rules = array(
			    array(
                	'field'   => 'tittle',
                 	'label'   => 'Tittle',
                 	'rules'   => 'trim|required'
              	),
              	array(
                     'field'   => 'glass_item',
                     'label'   => 'Glass Item',
                     'rules'   => 'trim|required'
                )
            );

			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run()) {
				if($this->input->post('picture_name')!=''){
					$this->Package_model->deleteSliderFile($this->input->post('id'));
					$picture_name = $this->input->post('picture_name');
				}else{
					$picture_name = $this->input->post('old_picture');
				}
				//$packageRow = $this->Packages_model->getRow($this->input->post('package_id'));
				echo $location_id = $this->input->get('id');
				$page = array(
					"picture" => $picture_name,
					"tittle" => $this->input->post('tittle'),
					"glass_item" => $this->input->post('glass_item'),
					"electronics" => $this->input->post('electronics'),
					"price" => $this->input->post('price'),
					
					"date_modified" => date("Y-m-d")
				);
				$m = $this->Package_model->update($page, $location_id);
				if($m){
					$this->session->unset_userdata(array('picture_name'));
					redirect('admin/package?msg=Added Successfully');
				}else {
					$data['error']	    = 'Some Error try later';
					$data['pageDetail'] = $_REQUEST;
				}
			}else{
				$data['pageDetail'] = $_REQUEST;
			}
		}
				/*if($user_record) {
					redirect('admin/Package?msg=Updated Successfully');
				}else {
					$data['error']	    = 'Some Error try later';
					$data['pageDetail'] = $_REQUEST;
				}
				
			}else{
				$data['pageDetail'] = $_REQUEST;
			}
		}*/
		$data['language'] = $this->Common_model->get_all_languages();

		$this->load->view('admin/edit_Package',$data);
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
	public function uploadAddImage(){
		
		if($this->session->userdata('picture_name')!=''){
			@unlink('uploads/data/'.$this->session->userdata('picture_name'));
		}

		$picture_name = 'news_' . time();
		$path         = 'uploads/data/';
		$picture_name = $this->Common_model->uploadImageAndResize($picture_name,$path,500,500);
		if ($picture_name){
			$arr            = array('picture_name' =>  $picture_name);
			$this->session->set_userdata($arr);
			$array = array('error'=>'','picture_name' => $picture_name);
			echo json_encode($array);
		}else{
			$error = array('error' => strip_tags($this->upload->display_errors()).$this->image_lib->display_errors());
			echo json_encode($error);
		}
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
		$data['user'] = $this->Package_model->delete($id);
		redirect('admin/Package?msg=Deleted Successfully');
	}

}
