<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');
class Retreats extends CI_Controller{
	function __construct() {
        parent::__construct();
        $this->load->model('Retreats_model');
        $this->load->model('Common_model');
        $this->load->library('image_lib');
		$this->load->library("pagination");
		if(!$this->session->userdata('admin_id')) {
			redirect(base_url().'admin/login');
		}
    }
	public function index() {
		$data['retreats']         = $this->Retreats_model->getAllRetreats();
		$data['page_title']    = 'Retreats';
		$data['page_heading']  = 'Retreats';
		$data['msg'] = $this->input->get('msg') ? $this->input->get('msg') : '';
		$this->load->view('admin/retreats',$data);
	}
	public function add() {
		$data['page_title']   = 'Add Retreats';
		$data['page_heading'] = 'Add Retreats';
		if($this->input->post()) {
			$rules = array(
				array(
				    'field'   => 'title',
                 	'label'   => 'Title',
                 	'rules'   => 'trim|required'
                 ),
				array(
				    'field'   => 'heading',
                 	'label'   => 'Heading',
                 	'rules'   => 'trim|required'
                 ),
				array(
				    'field'   => 'details',
                 	'label'   => 'Details',
                 	'rules'   => 'trim|required'
                 ),
				array(
				    'field'   => 'picture_main',
                 	'label'   => 'picture',
                 	'rules'   => 'trim|required'
                 )
            );
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$array = array(
							"title"          	=> $this->input->post('title'),
							"heading"          	=> $this->input->post('heading'),
							"details"          	=> $this->input->post('details'),
							"picture_main"      		=> $this->input->post('picture_main'),
							"date_modified"         	=> date("Y-m-d"),
					        "date_created"          	=> date("Y-m-d")
						 );
				$slug = url_title($this->input->post('title'), 'dash', true);
				$array['slug'] = $slug;
				$user_record				 =	$this->Retreats_model->save($array);
				if($user_record) {
					$this->session->unset_userdata(array('picture_name'));
					redirect('admin/retreats?msg=Added Successfully');
				}else {
					$data['error']	    = 'Some Error try later';
					$data['sliderDetail'] = $_REQUEST;
				}
			}else{
				$data['sliderDetail'] = $_REQUEST;
			}
		}else {
			$data['sliderDetail'] = array();
		}
		$this->load->view('admin/add_retreats',$data);
	}
	public function edit($id) {
		$data['page_title']   = 'Edit Retreats';
		$data['page_heading'] = 'Edit Retreats';
		if($id=='') {
			redirect(base_url()."admin/retreats?msg=Invalid Request");
		}else{
			$data['sliderDetail'] = $this->Retreats_model->getRowEdit($id);
		}
		if($this->input->post()) {
			$rules = array(
				array(
				    'field'   => 'title',
                 	'label'   => 'Title',
                 	'rules'   => 'trim|required'
                 ),
				array(
				    'field'   => 'heading',
                 	'label'   => 'Heading',
                 	'rules'   => 'trim|required'
                 ),
				array(
				    'field'   => 'details',
                 	'label'   => 'Details',
                 	'rules'   => 'trim|required'
                 )
            );
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				if($this->input->post('picture_main')!=''){
					$this->Retreats_model->deleteimageMain($id);
					$picture_1 = $this->input->post('picture_main');
				}else{
					$picture_1 = $this->input->post('old_main_picture');
				}
				$array = array(
							"title"          		=> $this->input->post('title'),
							"heading"          		=> $this->input->post('heading'),
							"details"          		=> $this->input->post('details'),
							"picture_main" 					=> $picture_1,
							"date_modified"         		=> date("Y-m-d"),
					        "date_created"          		=> date("Y-m-d")
						 );
				$slug = url_title($this->input->post('title'), 'dash', true);
				$array['slug'] = $slug;
				$user_record				 =	$this->Retreats_model->update($array,$this->input->post('id'));
				if($user_record) {
					$this->session->unset_userdata(array('picture_name'));
					redirect('admin/retreats?msg=Update Successfully');
				}else {
					$data['error']	    = 'Some Error try later';
					$data['sliderDetail'] = $_REQUEST;
				}
			}else{
				$data['sliderDetail'] = $_REQUEST;
			}
		}
		$this->load->view('admin/edit_retreats',$data);
	}
	public function deleteimageFirst(){
		$id = $this->input->get('id');
		$this->Retreats_model->deleteimageMain($id);
		redirect('admin/retreats/edit/'.$id.'?msg=Image Deleted Successfully');
	}
	public function deleteimageSecond(){
		$id = $this->input->get('id');
		$this->Retreats_model->deleteimageS1($id);
		redirect('admin/retreats/edit/'.$id.'?msg=Image Deleted Successfully');
	}
	public function delete(){
		$this->Retreats_model->deletePictureAndRow($this->input->get('id'));
		redirect('admin/retreats?msg=Deleted Successfully');
	}
	public function uploadAddImage(){
		if($this->session->userdata('picture_name')!=''){
			@unlink('uploads/data/'.$this->session->userdata('picture_name'));
		}
		$picture_name = 'product_' . time();
		$path         = 'uploads/slider/';
		$picture_name = $this->Common_model->uploadImage($picture_name,$path);
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
	
}