<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Catering extends CI_Controller{
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
        $config["base_url"]    = base_url() . "admin/Catering/index";
        $config["total_rows"]  = $this->Media_model->countTotal($arr);

		if($this->input->get('per_page')){
			$config["per_page"]    = $this->input->get('per_page');
		}else{
        	$config["per_page"]    = 10;
		}
        $config["uri_segment"] = 4;
		$config['reuse_query_string']   = true;
		$config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';//this is active tab
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);

        

        $page 		           = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        

        
		/*if($this->input->get('sort_by')){
			$arr['sort_by'] = $this->input->get('sort_by');
			$arr['order'] = $this->input->get('order');
		}*/
		$data['media']         = $this->Media_model->getAllCatering($arr,$page,$config["per_page"] );
		$data['links']         = $this->pagination->create_links();
		$data['page_title']    = 'Catering';
		$data['page_heading']  = 'Catering';
		
		$data['msg'] = $this->input->get('msg') ? $this->input->get('msg') : '';
		$this->load->view('admin/catering',$data);
	}

	public function add() {
		$data['page_title']   = 'Add Catering';
		$data['page_heading'] = 'Add Catering';
		
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
					"date_modified" => date("Y-m-d"),
					"date_created"	=> date("Y-m-d")
				);
				$media_id = $this->Media_model->save_catering($media);
				if($media_id) {
					$this->session->unset_userdata(array('picture_name'));
					redirect('admin/Catering?msg=Added Successfully');
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
		$this->load->view('admin/add_catering',$data);
	}

	public function edit($id) {
		$data['page_title']   = 'Edit Catering';
		$data['page_heading'] = 'Edit Catering';

		if($id=='') {
			redirect(base_url()."admin/Catering?msg=Invalid Request");
		}else{
			$data['mediaDetail'] = $this->Media_model->get_catering_detail_by_id($id);

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
				
				
				$media = array(
					"tittle" => $this->input->post('tittle'),
					"date_modified" => date("Y-m-d")
				);

				$media_id = $this->Media_model->update_catering($media,$this->input->post('media_id'));
				if($media_id) {
					$this->session->unset_userdata(array('picture_name'));
					redirect('admin/Catering?msg=Updated Successfully');
				}else {
					$data['error']	    = 'Some Error try later';
					$data['mediaDetail'] = $_REQUEST;
				}
			}else{
				$data['mediaDetail'] = $_REQUEST;
			}
		}
		//$data['language'] = $this->Common_model->get_all_languages();
		$this->load->view('admin/edit_catering',$data);
	}

	

	public function deleteImage(){
		$id = $this->input->get('id');
		$this->Media_model->deleteSliderFile($id);
		redirect('admin/Category/edit/'.$id.'?msg=Image Deleted Successfully');
	}
	
	public function delete(){
		$this->Media_model->delete_catering($this->input->get('id'));
		redirect('admin/Catering?msg=Deleted Successfully');
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