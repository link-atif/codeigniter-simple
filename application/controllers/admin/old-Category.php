<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');
class Category extends CI_Controller{
	function __construct() {
        parent::__construct();
        $this->load->model('Media_model');
        $this->load->model('Common_model');
        $this->load->library('image_lib');
		$this->load->library("pagination");
		if(!$this->session->userdata('admin_id')) {
			redirect(base_url().'admin/login');
		}
    }
    
	public function index() {
		$arr 		           = array();
        $arr['title']           = $this->input->get('title') ? $this->input->get('title') : '';
		$config 			   = array();
        $config["base_url"]    = base_url() . "admin/Category/index";
        $config["total_rows"]  = $this->Media_model->countTotal($arr);
		if($this->input->get('per_page')){
			$config["per_page"]    = $this->input->get('per_page');
		}else{
        	$config["per_page"]    = 10;
		}
        $config["uri_segment"] = 3;
		$config['reuse_query_string']   = true;

        $this->pagination->initialize($config);

        $page 		           = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		if($this->input->get('sort_by')){
			$arr['sort_by'] = $this->input->get('sort_by');
			$arr['order'] = $this->input->get('order');
		}
		$data['media']         = $this->Media_model->getAll($arr,$page,$config["per_page"] );
		$data["links"]         = $this->pagination->create_links();
		$data['page_title']    = 'Categories';
		$data['page_heading']  = 'Category';
		
		$data['msg'] = $this->input->get('msg') ? $this->input->get('msg') : '';
		$this->load->view('admin/category',$data);
	}

	public function add() {
		$data['page_title']   = 'Add Category';
		$data['page_heading'] = 'Add Category';
		
		if($this->input->post()) {
			$rules = array(
				array(
				    'field'   => 'title',
                 	'label'   => 'Title',
                 	'rules'   => 'trim|required'
                 )
            );
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$media = array(
					"tittle" => $this->input->post('title'),
					"description" => $this->input->post('description'),
					"location"  	=> $this->input->post('location'),
					"picture" => $this->input->post('picture_name'),
					"date_modified" => date("Y-m-d"),
					"date_created"	=> date("Y-m-d")
				);
				$media_id = $this->Media_model->save_media($media);
				
				if($media_id) {
					$this->session->unset_userdata(array('picture_name'));
					redirect('admin/Category?msg=Added Successfully');
				}else {
					$data['error']	    = 'Some Error try later';
					$data['mediaDetail'] = $_REQUEST;
				}
			}else{
				$data['mediaDetail'] = $_REQUEST;
			}
		}else {
			$data['mediaDetail'] = array();
		}
		//$data['language'] = $this->Common_model->get_all_languages();
		$this->load->view('admin/add_category',$data);
	}

	public function edit($id) {
		$data['page_title']   = 'Edit Category';
		$data['page_heading'] = 'Edit Category';

		if($id=='') {
			redirect(base_url()."admin/Category?msg=Invalid Request");
		}else{
			$data['mediaDetail'] = $this->Media_model->get_media_detail_by_id($id);

		}
		if($this->input->post()) {
			$rules = array(
				array(
					'field'   => 'tittle',
                 	'label'   => 'Title',
                 	'rules'   => 'trim|required'
				)
            );

			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				if($this->input->post('picture_name')!=''){
					$this->Media_model->deleteSliderFile($this->input->post('media_id'));
					$picture_name = $this->input->post('picture_name');
				}else{
					$picture_name = $this->input->post('old_picture');
				}
				
				$media = array(
					"tittle" => $this->input->post('tittle'),
					"description" => $this->input->post('description'),
					"location"  	=> $this->input->post('location'),
					"picture" => $picture_name,
					"date_modified" => date("Y-m-d")
				);

				$media_id = $this->Media_model->update_media($media,$this->input->post('media_id'));
				if($media_id) {
					$this->session->unset_userdata(array('picture_name'));
					redirect('admin/Category?msg=Updated Successfully');
				}else {
					$data['error']	    = 'Some Error try later';
					$data['mediaDetail'] = $_REQUEST;
				}
			}else{
				$data['mediaDetail'] = $_REQUEST;
			}
		}
		//$data['language'] = $this->Common_model->get_all_languages();
		$this->load->view('admin/edit_category',$data);
	}

	

	public function deleteImage(){
		$id = $this->input->get('id');
		$this->Media_model->deleteSliderFile($id);
		redirect('admin/Category/edit/'.$id.'?msg=Image Deleted Successfully');
	}
	
	public function delete(){
		$this->Media_model->delete($this->input->get('id'));
		redirect('admin/Category?msg=Deleted Successfully');
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
	
}