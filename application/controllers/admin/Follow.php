<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Follow extends CI_Controller
{
	function __construct() {

        parent::__construct();
        $this->load->model('Follow_model');
        
        $this->load->model('Common_model');
        $this->load->library('image_lib');
        $this->load->model('Preferences_model');
        global $activity_log_types;
		if($this->session->userdata('admin_id')=='') {
			redirect('admin/login');
		}
    }
    
	public function index() {

		$data['sliderImages']  = $this->Follow_model->getAll();
		$data['page_title']    = 'Partners';
		$data['page_heading']  = 'Partners';
		$data['msg'] 		   = $this->input->get('msg') ? $this->input->get('msg') : '';
		$this->load->view('admin/follow',$data);
	}

	public function add() {
		
		$data['page_title']   = 'Add Partners';
		$data['page_heading'] = 'Add Partners';

		
		
		if($this->input->post()) {
			$rules = array(
			   
                array(
                     'field'   => 'picture_link',
                     'label'   => 'Picture link',
                     'rules'   => 'trim|required'
                ),
                array(
                     'field'   => 'sort_order',
                     'label'   => 'Sort Order',
                     'rules'   => 'trim|required'
                ),
                array(
                     'field'   => 'home_page',
                     'label'   => 'Home Page',
                     'rules'   => 'trim|required'
                ),
                array(
                     'field'   => 'picture',
                     'label'   => 'Picture',
                     'rules'   => 'trim|required'
                )
            );

			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run()) {
				$slider = array(
					"date_modified" => date("Y-m-d"),
					"date_created" => date("Y-m-d"),
					"picture_link" => $this->input->post('picture_link'),
					"sort_order" => $this->input->post('sort_order'),
					"home_page" => $this->input->post('home_page'),
					"picture" => $this->input->post('picture')
				);
		

				$slider_id = $this->Follow_model->save($slider);
				if($slider_id) {
					$this->session->unset_userdata(array('picture_name'));
					redirect('admin/follow?msg=Added Successfully');
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
		$data['language'] = $this->Common_model->get_all_languages();
		$this->load->view('admin/add_follow',$data);
	}

	public function edit($id) {
		
		$data['page_title']   = 'Edit Partners';
		$data['page_heading'] = 'Edit Partners';

		if($id=='') {
			redirect(base_url()."admin/Follow?msg=Invalid image");
		}else{
			$data['sliderDetail'] = $this->Follow_model->getRow($id);
		}
		
		if($this->input->post()) {
			$rules = array(
			    array(
                	'field'   => 'picture_link',
                 	'label'   => 'Picture Link',
                 	'rules'   => 'trim|required'
              	),
                array(
                     'field'   => 'sort_order',
                     'label'   => 'Sort Order',
                     'rules'   => 'trim|required'
                ),
                array(
                     'field'   => 'home_page',
                     'label'   => 'Home Page',
                     'rules'   => 'trim|required'
                )
              	
            );

			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run()) {
				//print_r($this->input->post());die('asdf');
				if($this->input->post('picture')!=''){
					$this->Follow_model->deleteSliderFile($id);
					$picture_name = $this->input->post('picture');
				}else{
					$picture_name = $this->input->post('old_picture');
				}
				
				$slider = array(
							"date_modified" => date("Y-m-d"),
							"picture_link" => $this->input->post('picture_link'),
							"sort_order" => $this->input->post('sort_order'),
					        "home_page" => $this->input->post('home_page'),
							"picture"        		=> $picture_name
						 );

				$slider_id	=	$this->Follow_model->update($slider,$id);
				if($slider_id) {
					$this->session->unset_userdata(array('picture_name'));
					redirect('admin/Follow?msg=Updated Successfully');
				}else {
					$data['error']	    = 'Some Error try later';
					$data['sliderDetail'] = $_REQUEST;
				}
			}else{
				$data['sliderDetail'] = $_REQUEST;
				}
		}
		$data['language'] = $this->Common_model->get_all_languages();
		$this->load->view('admin/edit_follow',$data);
	}

	public function deleteImage(){

		$id = $this->input->get('id');
		$this->Follow_model->deletePictureAndRow($id);
		redirect('admin/Follow/edit/'.$id.'&msg=Image Deleted Successfully');
	}

	public function deleteSliderImage(){
		$id = $this->input->get('id');
		$this->Follow_model->deleteSliderFile($id);
		redirect('admin/Follow/edit/'.$id.'?msg=Image Deleted Successfully');
	}
	
	public function deleteArabicSliderImage(){
		$id = $this->input->get('id');
		$this->Follow_model->deleteArabicSliderFile($id);
		redirect('admin/Follow/edit/'.$id.'?msg=Image Deleted Successfully');
	}

	public function delete($id){
		$this->Follow_model->deletePictureAndRow($id);
		redirect('admin/Follow?msg=Deleted Successfully');
	}

	public function uploadAddImage(){
		
		if($this->session->userdata('picture_name')!=''){
			@unlink('uploads/data/'.$this->session->userdata('picture_name'));
		}

		$picture_name = 'sliderimage_' . time();
		$path         = 'uploads/data/';
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
	
	public function uploadAddImageArabic(){
		
		if($this->session->userdata('arabic_picture_name')!=''){
			@unlink('uploads/data/'.$this->session->userdata('arabic_picture_name'));
		}

		$picture_name = 'sliderimage_' . time();
		$path         = 'uploads/data/';
		$picture_name = $this->Common_model->uploadImageAndResize($picture_name,$path,1920,960);
		if ($picture_name){
			$arr            = array('arabic_picture_name' =>  $picture_name);
			$this->session->set_userdata($arr);
			$array = array('error'=>'','arabic_picture_name' => $picture_name);
			echo json_encode($array);
		}else{
			$error = array('error' => strip_tags($this->upload->display_errors()).$this->image_lib->display_errors());
			echo json_encode($error);
		}
	}
}