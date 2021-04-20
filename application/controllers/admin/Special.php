<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Special extends CI_Controller
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
		$data['sliderImages']  = $this->Sliderimages_model->getAllspecials();
		$data['page_title']    = 'Success Stories';
		$data['page_heading']  = 'Success Stories';
		$data['msg'] 		   = $this->input->get('msg') ? $this->input->get('msg') : '';
		$this->load->view('admin/specials',$data);
	}

	public function addspecials() {
		
		$data['page_title']   = 'Add Success Stories';
		$data['page_heading'] = 'Add Success Stories';

		
		
		if($this->input->post()) {
			$rules = array(
			    array(
                	'field'   => 'tittle',
                 	'label'   => 'Tittle',
                 	'rules'   => 'trim|required'
              	),
              	array(
                     'field'   => 'description',
                     'label'   => 'Description',
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
					"link" => $this->input->post('link'),
					"tittle" => $this->input->post('tittle'),
					"description" => $this->input->post('description'),
					"button_text" => $this->input->post('button_text'),
					"date_modified" => date("Y-m-d"),
					"date_created" => date("Y-m-d"),
					//"link"=> $this->input->post('link'),
					"picture" => $this->input->post('picture')
				);

				$slider_id = $this->Sliderimages_model->savespecials($slider);
				
				if($slider_id) {
					$this->session->unset_userdata(array('picture_name'));
					redirect('admin/Special?msg=Added Successfully');
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
		//$data['language'] = $this->Common_model->get_all_languages();
		$this->load->view('admin/add_special',$data);
	}

	public function edit($id) {
		
		$data['page_title']   = 'Edit Success Stories';
		$data['page_heading'] = 'Edit Success Stories';

		if($id=='') {
			redirect(base_url()."admin/Special?msg=Invalid image");
		}else{
			$data['sliderDetail'] = $this->Sliderimages_model->getRowspecials($id);
		}
		
		if($this->input->post()) {
			$rules = array(
			    array(
                	'field'   => 'tittle',
                 	'label'   => 'Title',
                 	'rules'   => 'trim|required'
              	),
              	array(
                     'field'   => 'description',
                     'label'   => 'Description',
                     'rules'   => 'trim|required'
                )
            );

			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run()) {
				//print_r($this->input->post());die('asdf');
				if($this->input->post('picture')!=''){
					$this->Sliderimages_model->deleteSliderspecials($id);
					$picture_name = $this->input->post('picture');
				}else{
					$picture_name = $this->input->post('old_picture');
				}
				
				$slider = array(
							"link"          		=> $this->input->post('link'),
							"tittle" => $this->input->post('tittle'),
					"description" => $this->input->post('description'),
					"button_text" => $this->input->post('button_text'),
							"date_modified" => date("Y-m-d"),
							"picture"        		=> $picture_name
						 );

				$slider_id	=	$this->Sliderimages_model->updateSpeical($slider,$id);
				
				if($slider_id) {
					$this->session->unset_userdata(array('picture_name'));
					redirect('admin/Special?msg=Updated Successfully');
				}else {
					$data['error']	    = 'Some Error try later';
					$data['sliderDetail'] = $_REQUEST;
				}
			}else{
				$data['sliderDetail'] = $_REQUEST;
				}
		}
		//$data['language'] = $this->Common_model->get_all_languages();
		$this->load->view('admin/edit_special',$data);
	}

	public function deleteImage(){

		$id = $this->input->get('id');
		$this->Sliderimages_model->deletePictureAndRow($id);
		redirect('admin/news/edit/'.$id.'&msg=Image Deleted Successfully');
	}

	public function deleteSliderImage(){
		$id = $this->input->get('id');
		$this->Sliderimages_model->deleteSliderFile($id);
		redirect('admin/news/edit/'.$id.'?msg=Image Deleted Successfully');
	}
	
	public function deleteArabicSliderImage(){
		$id = $this->input->get('id');
		$this->Sliderimages_model->deleteArabicSliderFile($id);
		redirect('admin/News/edit/'.$id.'?msg=Image Deleted Successfully');
	}

	public function delete($id){
		
		$this->Sliderimages_model->deleteSpecial($id);
		redirect('admin/Special?msg=Deleted Successfully');
	}

	public function uploadAddImage(){
		
		if($this->session->userdata('picture_name')!=''){
			@unlink('uploads/data/'.$this->session->userdata('picture_name'));
		}

		$picture_name = 'sliderimage_' . time();
		$path         = 'uploads/data/';
		$picture_name = $this->Common_model->uploadImageAndResize($picture_name,$path,1920,960);
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