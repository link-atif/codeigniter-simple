<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Sliderimages extends CI_Controller
{
	function __construct() {

        parent::__construct();
        $this->load->model('Sliderimages_model');
        
        $this->load->model('Common_model');
        $this->load->library('image_lib');
        $this->load->model('Preferences_model');
        global $activity_log_types;
		if($this->session->userdata('admin_id')=='') {
			redirect('admin/login');
		}
    }
    
	public function index() {
		$data['sliderImages']  = $this->Sliderimages_model->getAllSliderImages();
		$data['page_title']    = 'Slider Images';
		$data['page_heading']  = 'Slider Images';
		$data['msg'] 		   = $this->input->get('msg') ? $this->input->get('msg') : '';
		$this->load->view('admin/sliderimages',$data);
	}

	public function addSliderImage() {
		
		$data['page_title']   = 'Add Slider Image';
		$data['page_heading'] = 'Add Slider Image';

		
		
		if($this->input->post()) {
			$rules = array(
                array(
                	'field'   => 'type',
                 	'label'   => 'Slider For',
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
				$slider = array(
					
					"type" => $this->input->post('type'),
					"date_modified" => date("Y-m-d"),
					"date_created" => date("Y-m-d"),
					"picture" => $this->input->post('picture'),
				);

				$slider_id = $this->Sliderimages_model->save($slider);
				
				if($slider_id) {
					$this->session->unset_userdata(array('picture_name'));
					redirect('admin/sliderimages?msg=Added Successfully');
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
		$this->load->view('admin/add_sliderimage',$data);
	}

	public function edit($id) {
		
		$data['page_title']   = 'Edit Slider Image';
		$data['page_heading'] = 'Edit Slider Image';

		if($id=='') {
			redirect(base_url()."admin/Sliderimages?msg=Invalid image");
		}else{
			$data['sliderDetail'] = $this->Sliderimages_model->getRow($id);
		}
		
		if($this->input->post()) {
			$rules = array(
			    
                array(
                	'field'   => 'type',
                 	'label'   => 'Slider For',
                 	'rules'   => 'trim|required'
              	)
            );

			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run()) {
				//print_r($this->input->post());die('asdf');
				if($this->input->post('picture')!=''){
					$this->Sliderimages_model->deleteSliderFile($id);
					$picture_name = $this->input->post('picture');
				}else{
					$picture_name = $this->input->post('old_picture');
				}
				
				$slider = array(
					"type" => $this->input->post('type'),
					"date_modified" => date("Y-m-d"),
					"picture"        		=> $picture_name
				);
				$slider_id	=	$this->Sliderimages_model->update($slider,$id);
				if($slider_id) {
					$this->session->unset_userdata(array('picture_name'));
					redirect('admin/sliderimages?msg=Updated Successfully');
				}else {
					$data['error']	    = 'Some Error try later';
					$data['sliderDetail'] = $_REQUEST;
				}
			}else{
				$data['sliderDetail'] = $_REQUEST;
				}
		}
		$data['language'] = $this->Common_model->get_all_languages();
		$this->load->view('admin/edit_sliderimage',$data);
	}

	public function deleteImage(){

		$id = $this->input->get('id');
		$this->Sliderimages_model->deletePictureAndRow($id);
		redirect('admin/sliderimages/edit/'.$id.'&msg=Image Deleted Successfully');
	}

	public function deleteSliderImage(){
		$id = $this->input->get('id');
		$this->Sliderimages_model->deleteSliderFile($id);
		redirect('admin/sliderimages/edit/'.$id.'?msg=Image Deleted Successfully');
	}
	
	public function deleteArabicSliderImage(){
		$id = $this->input->get('id');
		$this->Sliderimages_model->deleteArabicSliderFile($id);
		redirect('admin/sliderimages/edit/'.$id.'?msg=Image Deleted Successfully');
	}

	public function delete($id){
		$this->Sliderimages_model->deletePictureAndRow($id);
		redirect('admin/sliderimages?msg=Deleted Successfully');
	}

	public function uploadAddImage(){
		
		if($this->session->userdata('picture_name')!=''){
			@unlink('uploads/data/'.$this->session->userdata('picture_name'));
		}

		$picture_name = 'sliderimage_' . time();
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