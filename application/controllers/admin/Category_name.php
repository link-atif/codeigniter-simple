<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');
class Category_name extends CI_Controller{
	function __construct() {
        parent::__construct();
        $this->load->model('Media_model');
        $this->load->model('Common_model');
        $this->load->model('Location_model');
        $this->load->library('image_lib');
		$this->load->library("pagination");
		if(!$this->session->userdata('admin_id')) {
			redirect(base_url().'admin/login');
		}
    }
	public function index() {
		$data['media']         = $this->Media_model->getAll();
		$data['page_title']    = 'Category Names';
		$data['page_heading']  = 'Category Names';
		$data['branches'] = $this->Location_model->getAllLocation();
		$data['msg'] = $this->input->get('msg') ? $this->input->get('msg') : '';
		$this->load->view('admin/category_name',$data);
	}
	public function add() {
		$data['page_title']   = 'Add Category Name';
		$data['page_heading'] = 'Add Category Name';
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
                	$media_id = $this->Media_model->save_media($media);
                    if($media_id) {
						$this->session->unset_userdata(array('picture_name'));
						redirect('admin/category_name?msg=Added Successfully');
					}else {
						$data['error']	    = 'DB Error';
						$data['mediaDetail'] = $_REQUEST;
					}
			}else{
				$data['mediaDetail'] = $_REQUEST;
			}
		}else {
			$data['mediaDetail'] = array();
		}
		$data['locations'] = $this->Location_model->getAllLocation();
		$this->load->view('admin/add_category_name',$data);
	}
	public function edit($id) {
		$data['page_title']   = 'Edit Category Name';
		$data['page_heading'] = 'Edit Category Name';
		if($id=='') {
			redirect(base_url()."admin/category_name?msg=Invalid Request");
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
				$media = array(
					"tittle" => $this->input->post('tittle'),
					"date_modified" => date("Y-m-d")
				);
                    $media_id = $this->Media_model->update_media($media,$this->input->post('media_id'));
					if($media_id) {
						$this->session->unset_userdata(array('picture_name'));
						redirect('admin/category_name?msg=Updated Successfully');
					}else {
						$data['error']	    = 'Some Error try later';
						$data['mediaDetail'] = $_REQUEST;
					}
			}else{
				$data['mediaDetail'] = $_REQUEST;
			}
		}
		$data['locations'] = $this->Location_model->getAllLocation();
		$this->load->view('admin/edit_category_name',$data);
	}

	

	
	
	public function delete(){
		$catId = $this->input->get('id');
		$this->Media_model->delete($catId);
		redirect('admin/category_name?msg=Deleted Successfully');
	}

	
	
}