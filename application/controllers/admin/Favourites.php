<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');
class Favourites extends CI_Controller{
	function __construct() {
        parent::__construct();
        $this->load->model('Favourites_model');
        $this->load->model('Common_model');
        $this->load->library('image_lib');
		$this->load->library("pagination");
		if(!$this->session->userdata('admin_id')) {
			redirect(base_url().'admin/login');
		}
    }
	public function index() {
		$data['favourites']         = $this->Favourites_model->getAllFavourites();
		$data['page_title']    = 'Yoga Rituals';
		$data['page_heading']  = 'Yoga Rituals';
		$data['msg'] = $this->input->get('msg') ? $this->input->get('msg') : '';
		$this->load->view('admin/favourites',$data);
	}
	public function add() {
		$data['page_title']   = 'Add Yoga Rituals';
		$data['page_heading'] = 'Add Yoga Rituals';
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
				    'field'   => 'video_link',
                 	'label'   => 'Video Link',
                 	'rules'   => 'trim|required'
                 ),
				array(
				    'field'   => 'picture_main',
                 	'label'   => 'picture',
                 	'rules'   => 'trim|required'
                 ),
				array(
				    'field'   => 'picture_s1',
                 	'label'   => 'picture Detail Page',
                 	'rules'   => 'trim|required'
                 )
            );
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$array = array(
							"title"          	=> $this->input->post('title'),
							"heading"          	=> $this->input->post('heading'),
							"video_link"          	=> $this->input->post('video_link'),
							"details"          	=> $this->input->post('details'),
							"picture_main"      		=> $this->input->post('picture_main'),
							"picture_s1"      		=> $this->input->post('picture_s1'),
							"date_modified"         	=> date("Y-m-d"),
					        "date_created"          	=> date("Y-m-d")
						 );
				$slug = url_title($this->input->post('title'), 'dash', true);
				$array['slug'] = $slug;
				$user_record				 =	$this->Favourites_model->save($array);
				if($user_record) {
					$this->session->unset_userdata(array('picture_name'));
					redirect('admin/favourites?msg=Added Successfully');
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
		$this->load->view('admin/add_favourites',$data);
	}
	public function edit($id) {
		$data['page_title']   = 'Edit Yoga Rituals';
		$data['page_heading'] = 'Edit Yoga Rituals';
		if($id=='') {
			redirect(base_url()."admin/favourites?msg=Invalid Request");
		}else{
			$data['sliderDetail'] = $this->Favourites_model->getRowEdit($id);
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
				    'field'   => 'video_link',
                 	'label'   => 'Video Link',
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
					$this->Favourites_model->deleteimageMain($id);
					$picture_1 = $this->input->post('picture_main');
				}else{
					$picture_1 = $this->input->post('old_main_picture');
				}
				if($this->input->post('picture_s1')!=''){
					$this->Favourites_model->deleteimageS1($id, 'picture_s1');
					$picture_2 = $this->input->post('picture_s1');
				}else{
					$picture_2 = $this->input->post('old_s1_picture');
				}
				$array = array(
							"title"          		=> $this->input->post('title'),
							"heading"          		=> $this->input->post('heading'),
							"video_link"          	=> $this->input->post('video_link'),
							"details"          		=> $this->input->post('details'),
							"picture_main" 					=> $picture_1,
							"picture_s1" 					=> $picture_2,
							"date_modified"         		=> date("Y-m-d"),
					        "date_created"          		=> date("Y-m-d")
						 );
				$slug = url_title($this->input->post('title'), 'dash', true);
				$array['slug'] = $slug;
				$user_record				 =	$this->Favourites_model->update($array,$this->input->post('id'));
				if($user_record) {
					$this->session->unset_userdata(array('picture_name'));
					redirect('admin/favourites?msg=Update Successfully');
				}else {
					$data['error']	    = 'Some Error try later';
					$data['sliderDetail'] = $_REQUEST;
				}
			}else{
				$data['sliderDetail'] = $_REQUEST;
			}
		}
		$this->load->view('admin/edit_favourites',$data);
	}
	public function deleteimageFirst(){
		$id = $this->input->get('id');
		$this->Favourites_model->deleteimageMain($id);
		redirect('admin/favourites/edit/'.$id.'?msg=Image Deleted Successfully');
	}
	public function deleteimageSecond(){
		$id = $this->input->get('id');
		$this->Favourites_model->deleteimageS1($id);
		redirect('admin/favourites/edit/'.$id.'?msg=Image Deleted Successfully');
	}
	public function delete(){
		$this->Favourites_model->deletePictureAndRow($this->input->get('id'));
		redirect('admin/favourites?msg=Deleted Successfully');
	}
	public function uploadAddImage(){
		if($this->session->userdata('picture_name')!=''){
			@unlink('uploads/data/'.$this->session->userdata('picture_name'));
		}
		$picture_name = 'product_' . time();
		$path         = 'uploads/slider/';
		$picture_name = $this->Favourites_model->uploadImageAndResize($picture_name,$path,355,178);
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
	public function uploadAddImage1(){
		if($this->session->userdata('picture_name')!=''){
			@unlink('uploads/data/'.$this->session->userdata('picture_name'));
		}
		$picture_name = 'product_' . time();
		$path         = 'uploads/slider/';
		$picture_name = $this->Favourites_model->uploadImageAndResize1($picture_name,$path,383,787);
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