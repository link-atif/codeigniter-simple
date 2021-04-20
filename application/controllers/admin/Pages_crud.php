<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages_crud extends CI_Controller
{
	function __construct() {

        parent::__construct();
        $this->load->model('Pages_crud_model');
        
        $this->load->model('Common_model');
        $this->load->library('image_lib');
        $this->load->model('Preferences_model');
        global $activity_log_types;
		if($this->session->userdata('admin_id')=='') {
			redirect('admin/login');
		}
    }
    
	public function index() {
		$data['pages_crud']  = $this->Pages_crud_model->getAllPages_crud();
		$data['page_title']    = 'Practice With Me';
		$data['page_heading']  = 'Practice With Me';
		$data['msg'] 		   = $this->input->get('msg') ? $this->input->get('msg') : '';
		$this->load->view('admin/pages_crud',$data);
	}

	public function addPages_crud() {
		
		$data['page_title']   = 'Add Practice With Me';
		$data['page_heading'] = 'Add Practice With Me';

		
		
		if($this->input->post()) {
			$rules = array(
				array(
                     'field'   => 'title',
                     'label'   => 'title',
                     'rules'   => 'trim|required'
                ),
                array(
                     'field'   => 'link',
                     'label'   => 'link',
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
					"title" => $this->input->post('title'),
					"link" => $this->input->post('link'),
					"date_modified" => date("Y-m-d"),
					"date_created" => date("Y-m-d"),
					"picture" => $this->input->post('picture'),
					
				);

				$slider_id = $this->Pages_crud_model->save($slider);
				
				if($slider_id) {
					$this->session->unset_userdata(array('picture_name'));
					redirect('admin/pages_crud?msg=Added Successfully');
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
		$this->load->view('admin/add_pages_crud',$data);
	}

	public function edit($id) {
		
		$data['page_title']   = 'Edit Practice With Me';
		$data['page_heading'] = 'Edit Practice With Me';

		if($id=='') {
			redirect(base_url()."admin/Pages_crud?msg=Invalid image");
		}else{
			$data['sliderDetail'] = $this->Pages_crud_model->getRow($id);
		}
		
		if($this->input->post()) {
			$rules = array(
				array(
                     'field'   => 'title',
                     'label'   => 'title',
                     'rules'   => 'trim|required'
                ),
                array(
                     'field'   => 'link',
                     'label'   => 'link',
                     'rules'   => 'trim|required'
                )
			   
            );

			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run()) {
				//print_r($this->input->post());die('asdf');
				if($this->input->post('picture')!=''){
					$this->Pages_crud_model->deleteSliderFile($id);
					$picture_name = $this->input->post('picture');
				}else{
					$picture_name = $this->input->post('old_picture');
				}
				
				$slider = array(
					"title" => $this->input->post('title'),
					"link" => $this->input->post('link'),
					"date_modified" => date("Y-m-d"),
					"picture"        		=> $picture_name,
				);

				$slider_id	=	$this->Pages_crud_model->update($slider,$id);
				
				if($slider_id) {
					$this->session->unset_userdata(array('picture_name'));
					redirect('admin/pages_crud?msg=Added Successfully');
				}else {
					$data['error']	    = 'Some Error try later';
					$data['sliderDetail'] = $_REQUEST;
				}
			}else{
				$data['sliderDetail'] = $_REQUEST;
				}
		}
		$data['language'] = $this->Common_model->get_all_languages();
		$this->load->view('admin/edit_pages_crud',$data);
	}

	public function deleteImage(){

		$id = $this->input->get('id');
		$this->Pages_crud_model->deletePictureAndRow($id);
		redirect('admin/pages_crud/edit/'.$id.'&msg=Image Deleted Successfully');
	}

	public function deleteSliderImage(){
		$id = $this->input->get('id');
		$this->Pages_crud_model->deleteSliderFile($id);
		redirect('admin/pages_crud/edit/'.$id.'?msg=Image Deleted Successfully');
	}
	public function delete($id){
		$this->Pages_crud_model->deletePictureAndRow($id);
		redirect('admin/pages_crud?msg=Deleted Successfully');
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
}