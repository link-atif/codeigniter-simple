<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');
class Posts extends CI_Controller{
	function __construct() {
        parent::__construct();
        $this->load->model('Posts_model');
        $this->load->model('Common_model');
        $this->load->library('image_lib');
		$this->load->library("pagination");
		if(!$this->session->userdata('admin_id')) {
			redirect(base_url().'admin/login');
		}
    }
	public function index() {
		$data['posts']         = $this->Posts_model->getAllPosts();
		$data['page_title']    = 'Posts';
		$data['page_heading']  = 'Posts';
		$data['msg'] = $this->input->get('msg') ? $this->input->get('msg') : '';
		$this->load->view('admin/posts',$data);
	}
	public function add() {
		$data['page_title']   = 'Add Posts';
		$data['page_heading'] = 'Add Posts';
		if($this->input->post()) {
			
            $rules = array(
				array(
				    'field'   => 'title',
                 	'label'   => 'Title',
                 	'rules'   => 'trim|required'
                 ),
				array(
				    'field'   => 'description',
                 	'label'   => 'Description',
                 	'rules'   => 'trim|required'
                 ),
				array(
				    'field'   => 'picture_main',
                 	'label'   => 'Main Picture',
                 	'rules'   => 'trim|required'
                 ),
				array(
				    'field'   => 'retreat_id',
                 	'label'   => 'Retreats',
                 	'rules'   => 'trim|required'
                 ),
				array(
				    'field'   => 'picture_main',
                 	'label'   => 'picture Main',
                 	'rules'   => 'trim|required'
                 )
            );
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$array = array(
							"title"          	=> $this->input->post('title'),
							"description"          	=> $this->input->post('description'),
							"retreat_id" => $this->input->post('retreat_id'),
							"picture_main"      		=> $this->input->post('picture_main'),
							"date_modified"         	=> date("Y-m-d"),
					        "date_created"          	=> date("Y-m-d")
						 );
				$slug = url_title($this->input->post('title'), 'dash', true);
				$array['slug'] = $slug;
				$user_record				 =	$this->Posts_model->save($array);
				if($user_record) {
					$this->session->unset_userdata(array('picture_name'));
					redirect('admin/posts?msg=Added Successfully');
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
		$data['posts'] = $this->Posts_model->getAllpostsForDropdown();
		$this->load->view('admin/add_posts',$data);
	}
	public function edit($id) {
		$data['page_title']   = 'Edit Posts';
		$data['page_heading'] = 'Edit Posts';
		if($id=='') {
			redirect(base_url()."admin/posts?msg=Invalid Request");
		}else{
			$data['sliderDetail'] = $this->Posts_model->getRowEdit($id);
		}
		if($this->input->post()) {
			$rules = array(
				array(
				    'field'   => 'title',
                 	'label'   => 'Title',
                 	'rules'   => 'trim|required'
                 ),
				array(
				    'field'   => 'description',
                 	'label'   => 'Description',
                 	'rules'   => 'trim|required'
                 ),
				array(
				    'field'   => 'retreat_id',
                 	'label'   => 'Retreats',
                 	'rules'   => 'trim|required'
                 )
            );
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				if($this->input->post('picture_main')!=''){
					$this->Posts_model->deleteimageMain($id);
					$picture_1 = $this->input->post('picture_main');
				}else{
					$picture_1 = $this->input->post('old_main_picture');
				}
				
				$array = array(
							"title"          		=> $this->input->post('title'),
							"description"          		=> $this->input->post('description'),
							"retreat_id" => $this->input->post('retreat_id'),
							"picture_main" 					=> $picture_1,
							"date_modified"         		=> date("Y-m-d"),
					        "date_created"          		=> date("Y-m-d")
						 );
				$slug = url_title($this->input->post('title'), 'dash', true);
				$array['slug'] = $slug;
				$user_record				 =	$this->Posts_model->update($array,$this->input->post('id'));
				if($user_record) {
					$this->session->unset_userdata(array('picture_name'));
					redirect('admin/posts?msg=Update Successfully');
				}else {
					$data['error']	    = 'Some Error try later';
					$data['sliderDetail'] = $_REQUEST;
				}
			}else{
				$data['sliderDetail'] = $_REQUEST;
			}
		}
		$data['posts'] = $this->Posts_model->getAllpostsForDropdown();
		$this->load->view('admin/edit_posts',$data);
	}
	public function deleteimageFirst(){
		$id = $this->input->get('id');
		$this->Posts_model->deleteimageMain($id);
		redirect('admin/posts/edit/'.$id.'?msg=Image Deleted Successfully');
	}
	public function delete(){
		$this->Posts_model->deletePictureAndRow($this->input->get('id'));
		redirect('admin/posts?msg=Deleted Successfully');
	}
	public function uploadAddImage(){
		if($this->session->userdata('picture_name')!=''){
			@unlink('uploads/data/'.$this->session->userdata('picture_name'));
		}
		$picture_name = 'product_' . time();
		$path         = 'uploads/slider/';
		$picture_name = $this->Posts_model->uploadImageAndResize($picture_name,$path,688,463);
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