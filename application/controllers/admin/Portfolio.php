<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Portfolio extends CI_Controller{
	function __construct() {
        parent::__construct();
        $this->load->model('Portfolio_model');
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
        $config["base_url"]    = base_url() . "admin/portfolio";
        $config["total_rows"]  = $this->Portfolio_model->countTotal($arr);
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
		$data['portfolio']         = $this->Portfolio_model->getAll($arr,$page,$config["per_page"] );
		$data["links"]         = $this->pagination->create_links();
		$data['page_title']    = 'Portfolio';
		$data['page_heading']  = 'Portfolio';
		
		$data['msg'] = $this->input->get('msg') ? $this->input->get('msg') : '';
		$this->load->view('admin/portfolio',$data);
	}

	public function add() {
		$data['page_title']   = 'Add Portfolio';
		$data['page_heading'] = 'Add Portfolio';
		
		if($this->input->post()) {
			$rules = array(
				array(
				    'field'   => 'title',
                 	'label'   => 'Title',
                 	'rules'   => 'trim|required'
                 ),
			    array(
                	'field'   => 'link',
                 	'label'   => 'Link',
                 	'rules'   => 'trim|required'
              	)
            );

			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run()) {
				
				$array = array(
							"title"          		=> $this->input->post('title'),
							"service_name"          		=> $this->input->post('service_name'),
							"link"          		=> $this->input->post('link'),
							"picture"        		=> $this->input->post('picture_name'),
							"date"        			=> date("Y-m-d"),
						 );

				$user_record				 =	$this->Portfolio_model->save($array);
				if($user_record) {
					$this->session->unset_userdata(array('picture_name'));
					redirect('admin/Portfolio?msg=Added Successfully');
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
		$this->load->view('admin/add_portfolio',$data);
	}

	public function edit($id) {
		$data['page_title']   = 'Edit Portfolio';
		$data['page_heading'] = 'Edit Portfolio';

		if($id=='') {
			redirect(base_url()."admin/portfolio?msg=Invalid Request");
		}else{
			$data['sliderDetail'] = $this->Portfolio_model->getRow($id);
		}
		
		if($this->input->post()) {
			$rules = array(
				array(
					'field'   => 'title',
                 	'label'   => 'Title',
                 	'rules'   => 'trim|required'
				),
			    array(
                	'field'   => 'link',
                 	'label'   => 'Link',
                 	'rules'   => 'trim|required'
              	)
            );

			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				if($this->input->post('picture_name')!=''){
					$this->Portfolio_model->deleteSliderFile($this->input->post('id'));
					$picture_name = $this->input->post('picture_name');
				}else{
					$picture_name = $this->input->post('old_picture');
				}
				
				$array = array(
							"title"          		=> $this->input->post('title'),
							"link"          		=> $this->input->post('link'),
							"service_name"          => $this->input->post('service_name'),
							"picture"        		=> $picture_name,
							"date"        			=> date("Y-m-d"),
						 );

				$user_record				 =	$this->Portfolio_model->update($array,$this->input->post('id'));
				if($user_record) {
					$this->session->unset_userdata(array('picture_name'));
					redirect('admin/portfolio?msg=Update Successfully');
				}else {
					$data['error']	    = 'Some Error try later';
					$data['sliderDetail'] = $_REQUEST;
				}
			}else{
				$data['sliderDetail'] = $_REQUEST;
			}
		}
		$this->load->view('admin/edit_portfolio',$data);
	}

	

	public function deleteImage(){
		$id = $this->input->get('id');
		$this->Portfolio_model->deleteSliderFile($id);
		redirect('admin/Portfolio/edit/'.$id.'?msg=Image Deleted Successfully');
	}
	
	public function delete(){
		$this->Portfolio_model->deletePictureAndRow($this->input->get('id'));
		redirect('admin/portfolio?msg=Deleted Successfully');
	}

	public function uploadAddImage(){
		
		if($this->session->userdata('picture_name')!=''){
			@unlink('uploads/data/'.$this->session->userdata('picture_name'));
		}

		$picture_name = 'news_' . time();
		$path         = 'uploads/data/';
		$picture_name = $this->Common_model->uploadImageAndResize($picture_name,$path,960,600);
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