<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Retreatsphotos extends CI_Controller
{
	function __construct() {

        parent::__construct();
        $this->load->model('Retreatsphotos_model');     
        $this->load->model('Common_model');
        $this->load->library('image_lib');
        $this->load->model('Preferences_model');
        global $activity_log_types;
		if($this->session->userdata('admin_id')=='') {
			redirect('admin/login');
		}
    }
    
	public function index() {
		$data['posts']  = $this->Retreatsphotos_model->getAllPosts();
		$data['page_title']    = 'Retreats Photos';
		$data['page_heading']  = 'Retreats Photos';
		$data['msg'] 		   = $this->input->get('msg') ? $this->input->get('msg') : '';
		$this->load->view('admin/retreatsphotos',$data);
	}

	public function add() {
		
		$data['page_title']   = 'Add Retreats Photos';
		$data['page_heading'] = 'Add Retreats Photos';

		
		if($this->input->post()) {
			$rules = array(
				array(
                     'field'   => 'title',
                     'label'   => 'title',
                     'rules'   => 'trim|required'
                ),
                array(
                     'field'   => 'picture',
                     'label'   => 'picture',
                     'rules'   => 'trim|required'
                ),
                array(
                     'field'   => 'sort_order',
                     'label'   => 'Sort Order',
                     'rules'   => 'trim|required'
                )
            );

			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run()) {
				$post = array(
					"title" => $this->input->post('title'),
					"sort_order" => $this->input->post('sort_order'),
					"picture" => $this->input->post('picture'),
					"status" => $this->input->post('status')
				);

				$id = $this->Retreatsphotos_model->save($post);
				
				if($id) {
					$this->session->unset_userdata(array('picture_name'));
					redirect('admin/Retreatsphotos?msg=Added Successfully');
				}else {
					$data['error']	    = 'Some Error try later';
					$data['posts'] = $_REQUEST;
				}
			}else{
				$data['posts'] = $_REQUEST;
			}
		}else {
			$data['posts'] = array();
		}
		$data['language'] = $this->Common_model->get_all_languages();
		$this->load->view('admin/add_retreats_photos',$data);
	}

	public function edit($id) {
		
		$data['page_title']   = 'Edit Retreats Photos';
		$data['page_heading'] = 'Edit Retreats Photos';

		if($id=='') {
			redirect(base_url()."admin/Retreatsphotos?msg=Invalid post");
		}else{
			$data['posts'] = $this->Retreatsphotos_model->getRow($id);
		}
		
		if($this->input->post()) {
			$rules = array(
				array(
                     'field'   => 'title',
                     'label'   => 'title',
                     'rules'   => 'trim|required'
                ),
                array(
                     'field'   => 'sort_order',
                     'label'   => 'Sort Order',
                     'rules'   => 'trim|required'
                )
            );

			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				if($this->input->post('picture')!=''){
					$this->Retreatsphotos_model->deletePicture($this->input->post('id'));
					$picture_name = $this->input->post('picture');
				}else{
					$picture_name = $this->input->post('old_picture');
				}
				
				$posts = array(
					"title"          	=> $this->input->post('title'),
					"picture"        	=> $picture_name,
					"sort_order" 		=> $this->input->post('sort_order'),
					"status" 			=> $this->input->post('status')
				 );

				$id	=	$this->Retreatsphotos_model->update($posts,$id);
				if($id) {
					redirect('admin/Retreatsphotos?msg=Updated Successfully');
				}else {
					$data['error']	    = 'Some Error try later';
					$data['posts'] = $_REQUEST;
				}
			}else{
				$data['posts'] = $_REQUEST;
			}
		}
		$data['language'] = $this->Common_model->get_all_languages();
		$this->load->view('admin/edit_retreats_photos',$data);
	}

	public function delete($id){
		$this->Retreatsphotos_model->delete($id);
		redirect('admin/Retreatsphotos?msg=Deleted Successfully');
	}

	public function uploadAddImage(){
		if($this->session->userdata('picture_name')!=''){
			@unlink('uploads/data/'.$this->session->userdata('picture_name'));
		}

		$picture_name = 'retreats_photos_' . time();
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