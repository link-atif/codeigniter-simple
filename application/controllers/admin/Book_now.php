<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');
class Book_now extends CI_Controller{
	function __construct() {
        parent::__construct();
        $this->load->model('Book_now_model');
        $this->load->model('Posts_model');
        $this->load->model('Common_model');
        $this->load->library('image_lib');
		$this->load->library("pagination");
		if(!$this->session->userdata('admin_id')) {
			redirect(base_url().'admin/login');
		}
    }
	public function index() {
		$data['book_now']         = $this->Book_now_model->getAllBook_now();
		$data['page_title']    = 'Posts Purchase Page';
		$data['page_heading']  = 'Posts Purchase Page';
		$data['msg'] = $this->input->get('msg') ? $this->input->get('msg') : '';
		$this->load->view('admin/book_now',$data);
	}
	public function add() {
		$data['page_title']   = 'Add Posts';
		$data['page_heading'] = 'Add Posts';
		if($this->input->post()) {
			$rules = array(
				array(
				    'field'   => 'title',
                 	'label'   => 'Title',
                 	'rules'   => 'trim|required'
                 ),
				array(
				    'field'   => 'heading',
                 	'label'   => 'Heading',
                 	'rules'   => 'trim|required'
                 ),
				array(
				    'field'   => 'plan_heading',
                 	'label'   => 'plan heading',
                 	'rules'   => 'trim|required'
                 ),
				array(
				    'field'   => 'plan_price',
                 	'label'   => 'plan price',
                 	'rules'   => 'trim|required'
                 ),
				array(
				    'field'   => 'plan_duration',
                 	'label'   => 'plan duration',
                 	'rules'   => 'trim|required'
                 ),
				array(
				    'field'   => 'button_text',
                 	'label'   => 'Button Text',
                 	'rules'   => 'trim|required'
                 ),
				array(
				    'field'   => 'button_link',
                 	'label'   => 'Button Link',
                 	'rules'   => 'trim|required'
                 )
            );
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$array = array(
							"title"          		=> $this->input->post('title'),
							"heading"          	=> $this->input->post('heading'),
							"plan_heading"          	=> $this->input->post('plan_heading'),
							"plan_price"          	=> $this->input->post('plan_price'),
							"plan_duration"          	=> $this->input->post('plan_duration'),
							"button_text"          	=> $this->input->post('button_text'),
							"button_link"          	=> $this->input->post('button_link'),
							"retreat_id"          	=> $this->input->post('retreat_id'),
							"date_modified"         => date("Y-m-d"),
					        "date_created"          => date("Y-m-d")
						 );
				$slug = url_title($this->input->post('title'), 'dash', true);
				$array['slug'] = $slug;
				$user_record				 =	$this->Book_now_model->save($array);
				if($user_record) {
					$this->session->unset_userdata(array('picture_name'));
					redirect('admin/book_now?msg=Added Successfully');
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
		$data['posts'] = $this->Posts_model->getAllpostsForDropdown();
		$this->load->view('admin/add_book_now',$data);
	}
	public function edit($id) {
		$data['page_title']   = 'Edit Posts';
		$data['page_heading'] = 'Edit Posts';
		if($id=='') {
			redirect(base_url()."admin/book_now?msg=Invalid Request");
		}else{
			$data['sliderDetail'] = $this->Book_now_model->getRowEdit($id);
		}
		if($this->input->post()) {
			$rules = array(
				array(
				    'field'   => 'title',
                 	'label'   => 'Title',
                 	'rules'   => 'trim|required'
                 ),
				array(
				    'field'   => 'heading',
                 	'label'   => 'Heading',
                 	'rules'   => 'trim|required'
                 ),
				array(
				    'field'   => 'plan_heading',
                 	'label'   => 'plan heading',
                 	'rules'   => 'trim|required'
                 ),
				array(
				    'field'   => 'plan_price',
                 	'label'   => 'plan price',
                 	'rules'   => 'trim|required'
                 ),
				array(
				    'field'   => 'plan_duration',
                 	'label'   => 'plan duration',
                 	'rules'   => 'trim|required'
                 ),
				array(
				    'field'   => 'button_text',
                 	'label'   => 'Button Text',
                 	'rules'   => 'trim|required'
                 ),
				array(
				    'field'   => 'button_link',
                 	'label'   => 'Button Link',
                 	'rules'   => 'trim|required'
                 )
            );
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$array = array(
							"title"          		=> $this->input->post('title'),
							"heading"          	=> $this->input->post('heading'),
							"plan_heading"          	=> $this->input->post('plan_heading'),
							"plan_price"          	=> $this->input->post('plan_price'),
							"plan_duration"          	=> $this->input->post('plan_duration'),
							"button_text"          	=> $this->input->post('button_text'),
							"button_link"          	=> $this->input->post('button_link'),
							"retreat_id"          	=> $this->input->post('retreat_id'),
							"date_modified"         => date("Y-m-d"),
					        "date_created"          => date("Y-m-d")
						 );
				$slug = url_title($this->input->post('title'), 'dash', true);
				$array['slug'] = $slug;
				$user_record				 =	$this->Book_now_model->update($array,$this->input->post('id'));
				if($user_record) {
					$this->session->unset_userdata(array('picture_name'));
					redirect('admin/book_now?msg=Update Successfully');
				}else {
					$data['error']	    = 'Some Error try later';
					$data['sliderDetail'] = $_REQUEST;
				}
			}else{
				$data['sliderDetail'] = $_REQUEST;
			}
		}
		$data['posts'] = $this->Book_now_model->getAllpostsForDropdown();
		$this->load->view('admin/edit_book_now',$data);
	}
	public function delete(){
		$this->Book_now_model->deletePictureAndRow($this->input->get('id'));
		redirect('admin/book_now?msg=Deleted Successfully');
	}
}