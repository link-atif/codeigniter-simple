<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Reviews extends CI_Controller{
	function __construct() {
        parent::__construct();
        $this->load->model('Reviews_model');
        $this->load->model('Common_model');
        $this->load->library('image_lib');
		$this->load->library("pagination");
		if(!$this->session->userdata('admin_id')) {
			redirect(base_url().'admin/login');
		}
    }
    
	public function index() {
		$arr 		           = array();
        $arr['name']           = $this->input->get('name') ? $this->input->get('name') : '';
		$config 			   = array();
        $config["base_url"]    = base_url() . "admin/reviews";
        $config["total_rows"]  = $this->Reviews_model->countTotal($arr);
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
		$data['reviews']         = $this->Reviews_model->getAll($arr,$page,$config["per_page"] );
		$data["links"]         = $this->pagination->create_links();
		$data['page_title']    = 'Reviews';
		$data['page_heading']  = 'Reviews';
		
		$data['msg'] = $this->input->get('msg') ? $this->input->get('msg') : '';
		$this->load->view('admin/reviews',$data);
	}

	public function add() {
		$data['page_title']   = 'Add Reviews';
		$data['page_heading'] = 'Add Reviews';
		
		if($this->input->post()) {
			$rules = array(
				array(
				    'field'   => 'name',
                 	'label'   => 'Name',
                 	'rules'   => 'trim|required'
                 )
            );

			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run()) {
				
				$array = array(
							"name"          		=> $this->input->post('name'),
							"details"				=> $this->input->post('details'),
							"picture"        		=> $this->input->post('picture_name'),
							"date"        			=> date("Y-m-d"),
						 );

				$user_record				 =	$this->Reviews_model->save($array);
				if($user_record) {
					$this->session->unset_userdata(array('picture_name'));
					redirect('admin/reviews?msg=Added Successfully');
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
		$this->load->view('admin/add_reviews',$data);
	}

	public function edit($id) {
		$data['page_title']   = 'Edit Reviews';
		$data['page_heading'] = 'Edit Reviews';

		if($id=='') {
			redirect(base_url()."admin/reviews?msg=Invalid Request");
		}else{
			$data['sliderDetail'] = $this->Reviews_model->getRow($id);
		}
		
		if($this->input->post()) {
			$rules = array(
				array(
					'field'   => 'name',
                 	'label'   => 'Name',
                 	'rules'   => 'trim|required'
				)
            );

			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				if($this->input->post('picture_name')!=''){
					$this->Reviews_model->deleteSliderFile($this->input->post('id'));
					$picture_name = $this->input->post('picture_name');
				}else{
					$picture_name = $this->input->post('old_picture');
				}
				
				$array = array(
							"name"          		=> $this->input->post('name'),
							"details"          		=> $this->input->post('details'),
							"picture"        		=> $picture_name,
							"date"        			=> date("Y-m-d"),
						 );

				$user_record				 =	$this->Reviews_model->update($array,$this->input->post('id'));
				if($user_record) {
					$this->session->unset_userdata(array('picture_name'));
					redirect('admin/reviews?msg=Update Successfully');
				}else {
					$data['error']	    = 'Some Error try later';
					$data['sliderDetail'] = $_REQUEST;
				}
			}else{
				$data['sliderDetail'] = $_REQUEST;
			}
		}
		$this->load->view('admin/edit_reviews',$data);
	}

	

	public function deleteImage(){
		$id = $this->input->get('id');
		$this->Reviews_model->deleteSliderFile($id);
		redirect('admin/Reviews/edit/'.$id.'?msg=Image Deleted Successfully');
	}
	
	public function delete(){
		$this->Reviews_model->deletePictureAndRow($this->input->get('id'));
		redirect('admin/reviews?msg=Deleted Successfully');
	}

	public function uploadAddImage(){
		
		if($this->session->userdata('picture_name')!=''){
			@unlink('uploads/data/'.$this->session->userdata('picture_name'));
		}

		$picture_name = 'news_' . time();
		$path         = 'uploads/data/';
		$picture_name = $this->Common_model->uploadImageAndResize($picture_name,$path,150,150);
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