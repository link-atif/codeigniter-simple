<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Secondslider extends CI_Controller
{
	function __construct() {

        parent::__construct();
        $this->load->model('Secondslider_model');
        
        $this->load->model('Common_model');
        $this->load->library('image_lib');
        $this->load->model('Preferences_model');
        global $activity_log_types;
		if($this->session->userdata('admin_id')=='') {
			redirect('admin/login');
		}
    }
    
	public function index() {
		$data['secondslider']  = $this->Secondslider_model->getAllSecondslider();
		$data['page_title']    = 'Slider Images';
		$data['page_heading']  = 'Slider Images';
		$data['msg'] 		   = $this->input->get('msg') ? $this->input->get('msg') : '';
		$this->load->view('admin/secondslider',$data);
	}

	public function addSliderImage() {
		
		$data['page_title']   = 'Add Slider Image';
		$data['page_heading'] = 'Add Slider Image';

		
		
		if($this->input->post()) {
			$rules = array(
			    array(
                	'field'   => 'tittle_english',
                 	'label'   => 'Tittle English',
                 	'rules'   => 'trim|required'
              	),
              	array(
                     'field'   => 'description_english',
                     'label'   => 'Description English',
                     'rules'   => 'trim|required'
                ),
                array(
                	'field'   => 'tittle_arabic',
                 	'label'   => 'Tittle Arabic',
                 	'rules'   => 'trim|required'
              	),
              	array(
                     'field'   => 'description_arabic',
                     'label'   => 'Description Arabic',
                     'rules'   => 'trim|required'
                ),
                array(
                     'field'   => 'picture',
                     'label'   => 'picture',
                     'rules'   => 'trim|required'
                ),
                array(
                     'field'   => 'button_text_english',
                     'label'   => 'Button Text English',
                     'rules'   => 'trim|required'
                ),
                array(
                     'field'   => 'button_text_arabic',
                     'label'   => 'Button Text Arabic',
                     'rules'   => 'trim|required'
                )
            );

			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run()) {
				$slider = array(
					"status" 				=> 1,
					"link" 				 	=> $this->input->post('link'),
					"tittle_english" 	  	=> $this->input->post('tittle_english'),
					"description_english" 	=> $this->input->post('description_english'),
					"button_text_english" 	=> $this->input->post('button_text_english'),
					"tittle_arabic" 	  	=> $this->input->post('tittle_arabic'),
					"description_arabic"  	=> $this->input->post('description_arabic'),
					"button_text_arabic"  	=> $this->input->post('button_text_arabic'),
					"date_modified" 		=> date("Y-m-d"),
					"date_created" 			=> date("Y-m-d"),
					"sort_order"			=> $this->input->post('sort_order'),
					"picture" 				=> $this->input->post('picture')
				);

				$slider_id = $this->Secondslider_model->save($slider);
				
				if($slider_id) {
					$this->session->unset_userdata(array('picture_name'));
					redirect('admin/secondslider?msg=Added Successfully');
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
			redirect(base_url()."admin/Secondslider?msg=Invalid image");
		}else{
			$data['sliderDetail'] = $this->Secondslider_model->getRow($id);
		}
		
		if($this->input->post()) {
			$rules = array(
			    array(
                	'field'   => 'tittle_english',
                 	'label'   => 'Tittle English',
                 	'rules'   => 'trim|required'
              	),
              	array(
                     'field'   => 'description_english',
                     'label'   => 'Description English',
                     'rules'   => 'trim|required'
                ),
                array(
                	'field'   => 'tittle_arabic',
                 	'label'   => 'Tittle Arabic',
                 	'rules'   => 'trim|required'
              	),
              	array(
                     'field'   => 'description_arabic',
                     'label'   => 'Description Arabic',
                     'rules'   => 'trim|required'
                ),	
                array(
                     'field'   => 'button_text_english',
                     'label'   => 'Button Text English',
                     'rules'   => 'trim|required'
                ),
                array(
                     'field'   => 'button_text_arabic',
                     'label'   => 'Button Text Arabic',
                     'rules'   => 'trim|required'
                )
            );

			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run()) {
				//print_r($this->input->post());die('asdf');
				if($this->input->post('picture')!=''){
					$this->Secondslider_model->deleteSliderFile($id);
					$picture_name = $this->input->post('picture');
				}else{
					$picture_name = $this->input->post('old_picture');
				}
				
				$slider = array(
					"link"          		=> $this->input->post('link'),
					"tittle_english" 	  	=> $this->input->post('tittle_english'),
					"description_english" 	=> $this->input->post('description_english'),
					"button_text_english" 	=> $this->input->post('button_text_english'),
					"tittle_arabic" 	  	=> $this->input->post('tittle_arabic'),
					"description_arabic"  	=> $this->input->post('description_arabic'),
					"button_text_arabic"  	=> $this->input->post('button_text_arabic'),
					"sort_order" 			=> $this->input->post('sort_order'),
					"status"    			=> 1,
					"date_modified" 		=> date("Y-m-d"),
					"picture"        		=> $picture_name,
				);

				$slider_id	=	$this->Secondslider_model->update($slider,$id);
				
				if($slider_id) {
					$this->session->unset_userdata(array('picture_name'));
					redirect('admin/secondslider?msg=Added Successfully');
				}else {
					$data['error']	    = 'Some Error try later';
					$data['sliderDetail'] = $_REQUEST;
				}
			}else{
				$data['sliderDetail'] = $_REQUEST;
				}
		}
		$data['language'] = $this->Common_model->get_all_languages();
		$this->load->view('admin/edit_secondslider',$data);
	}

	public function deleteImage(){

		$id = $this->input->get('id');
		$this->Secondslider_model->deletePictureAndRow($id);
		redirect('admin/secondslider/edit/'.$id.'&msg=Image Deleted Successfully');
	}

	public function deleteSliderImage(){
		$id = $this->input->get('id');
		$this->Secondslider_model->deleteSliderFile($id);
		redirect('admin/secondslider/edit/'.$id.'?msg=Image Deleted Successfully');
	}
	
	public function deleteArabicSliderImage(){
		$id = $this->input->get('id');
		$this->Secondslider_model->deleteArabicSliderFile($id);
		redirect('admin/secondslider/edit/'.$id.'?msg=Image Deleted Successfully');
	}

	public function delete($id){
		$this->Secondslider_model->deletePictureAndRow($id);
		redirect('admin/secondslider?msg=Deleted Successfully');
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