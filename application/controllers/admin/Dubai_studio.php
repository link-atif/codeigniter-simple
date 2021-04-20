<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');
class Dubai_studio extends CI_Controller{
	function __construct() {
        parent::__construct();
        $this->load->model('Dubai_studio_model');
        $this->load->model('Common_model');
        $this->load->library('image_lib');
		$this->load->library("pagination");
		if(!$this->session->userdata('admin_id')) {
			redirect(base_url().'admin/login');
		}
    }
	public function index() {
		$data['dubai_studio']         = $this->Dubai_studio_model->getAllDubai_studio();
		$data['page_title']    = 'In Studio Purchase Page';
		$data['page_heading']  = 'In Studio Purchase Page';
		$data['msg'] = $this->input->get('msg') ? $this->input->get('msg') : '';
		$this->load->view('admin/dubai_studio',$data);
	}
	public function add() {
		$data['page_title']   = 'Add In Studio';
		$data['page_heading'] = 'Add In Studio';
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
							"date_modified"         => date("Y-m-d"),
					        "date_created"          => date("Y-m-d")
						 );
				$slug = url_title($this->input->post('title'), 'dash', true);
				$array['slug'] = $slug;
				$user_record				 =	$this->Dubai_studio_model->save($array);
				if($user_record) {
					$this->session->unset_userdata(array('picture_name'));
					redirect('admin/dubai_studio?msg=Added Successfully');
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
		$this->load->view('admin/add_dubai_studio',$data);
	}
	public function edit($id) {
		$data['page_title']   = 'Edit In Studio';
		$data['page_heading'] = 'Edit In Studio';
		if($id=='') {
			redirect(base_url()."admin/dubai_studio?msg=Invalid Request");
		}else{
			$data['sliderDetail'] = $this->Dubai_studio_model->getRowEdit($id);
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
							"date_modified"         => date("Y-m-d"),
					        "date_created"          => date("Y-m-d")
						 );
				$slug = url_title($this->input->post('title'), 'dash', true);
				$array['slug'] = $slug;
				$user_record				 =	$this->Dubai_studio_model->update($array,$this->input->post('id'));
				if($user_record) {
					$this->session->unset_userdata(array('picture_name'));
					redirect('admin/dubai_studio?msg=Update Successfully');
				}else {
					$data['error']	    = 'Some Error try later';
					$data['sliderDetail'] = $_REQUEST;
				}
			}else{
				$data['sliderDetail'] = $_REQUEST;
			}
		}
		$this->load->view('admin/edit_dubai_studio',$data);
	}
	public function delete(){
		$this->Dubai_studio_model->deletePictureAndRow($this->input->get('id'));
		redirect('admin/dubai_studio?msg=Deleted Successfully');
	}
}