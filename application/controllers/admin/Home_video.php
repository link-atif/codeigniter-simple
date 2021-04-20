<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');
class Home_video extends CI_Controller{
	function __construct() {
        parent::__construct();
        $this->load->model('Home_video_model');
        $this->load->model('Common_model');
        $this->load->library('image_lib');
		$this->load->library("pagination");
		if(!$this->session->userdata('admin_id')) {
			redirect(base_url().'admin/login');
		}
    }
	public function index() {
		$data['home_video']         = $this->Home_video_model->getAllHomeVideo();
		$data['page_title']    = 'Home Video';
		$data['page_heading']  = 'Home Video';
		$data['msg'] = $this->input->get('msg') ? $this->input->get('msg') : '';
		$this->load->view('admin/home_video',$data);
	}
	public function add() {
		$data['page_title']   = 'Add Home Video';
		$data['page_heading'] = 'Add Home Video';
		if($this->input->post()) {
			$rules = array(
				array(
				    'field'   => 'title',
                 	'label'   => 'Title',
                 	'rules'   => 'trim|required'
                 ),
				array(
				    'field'   => 'description',
                 	'label'   => 'Description',
                 	'rules'   => 'trim|required'
                 ),
				/*array(
				    'field'   => 'video_link',
                 	'label'   => 'Video Link',
                 	'rules'   => 'trim|required'
                 ),*/
				array(
				    'field'   => 'spotify_link',
                 	'label'   => 'Spotify Link',
                 	'rules'   => 'trim|required'
                 ),
				array(
				    'field'   => 'picture_main',
                 	'label'   => 'picture',
                 	'rules'   => 'trim|required'
                 )
            );
			$this->form_validation->set_rules($rules);
			$time_duration = $this->timeInMinutes($this->input->post('video_duaration'));
			if ($this->form_validation->run()) {
				$array = array(
					"title"          	=> $this->input->post('title'),
					//"video_link"          	=> $this->input->post('video_link'),
					"spotify_link"          	=> $this->input->post('spotify_link'),
					"description"          	=> $this->input->post('description'),
					"video_duaration"          		=> $this->input->post('video_duaration'),
					"video_style"          		=> $this->input->post('video_style'),
					"video_difficulity"          		=> $this->input->post('video_difficulity'),
					"duration_in_minutes" => $time_duration,
					"picture_main"      		=> $this->input->post('picture_main'),
					"date_modified"         	=> date("Y-m-d"),
			        "date_created"          	=> date("Y-m-d")
				);

				if($this->input->post('videoType') != ""){
					$array['videoType'] = $this->input->post('videoType');
					if($this->input->post('videoType') == "youtubeLink")
						$array['video_link'] = $this->input->post('video_link');
					else
						$array['file_name'] = $this->input->post('file_name');
				}
				$slug = url_title($this->input->post('title'), 'dash', true);
				$array['slug'] = $slug;
				$user_record				 =	$this->Home_video_model->save($array);
				if($user_record) {
					$this->session->unset_userdata(array('picture_name'));
					$this->session->unset_userdata(array('file_name'));
					redirect('admin/home_video?msg=Added Successfully');
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
		$this->load->view('admin/add_home_video',$data);
	}

	private function timeInMinutes($time){
		$time = explode(':', $time); 
		if(count($time) == 2){
			$time_duration = ((int)$time[0]) + (floor((int)$time[1]/60));
			return 	(int)$time_duration;
		}else{
			$time_duration = ((int)$time[0]*60) + ((int)$time[1]) + ((int)$time[2]/60);
			return 	(int)$time_duration;
		}
		
	}

	public function edit($id) {
		$data['page_title']   = 'Edit Home Video';
		$data['page_heading'] = 'Edit Home Video';
		if($id=='') {
			redirect(base_url()."admin/home_video?msg=Invalid Request");
		}else{
			$data['sliderDetail'] = $this->Home_video_model->getRowEdit($id);
		}
		if($this->input->post()) {
			$rules = array(
				array(
				    'field'   => 'title',
                 	'label'   => 'Title',
                 	'rules'   => 'trim|required'
                 ),
				/*array(
				    'field'   => 'video_link',
                 	'label'   => 'Video Link',
                 	'rules'   => 'trim|required'
                 ),*/
				array(
				    'field'   => 'spotify_link',
                 	'label'   => 'Spotify Link',
                 	'rules'   => 'trim|required'
                 ),
				array(
				    'field'   => 'description',
                 	'label'   => 'Description',
                 	'rules'   => 'trim|required'
                 )
            );
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$time_duration = $this->timeInMinutes($this->input->post('video_duaration'));
				if($this->input->post('picture_main')!=''){
					$this->Home_video_model->deleteimageMain($id);
					$picture_1 = $this->input->post('picture_main');
				}else{
					$picture_1 = $this->input->post('old_main_picture');
				}

				$array = array(
					"title"          		=> $this->input->post('title'),
					//"video_link"          	=> $this->input->post('video_link'),
					"spotify_link"          	=> $this->input->post('spotify_link'),
					"description"          		=> $this->input->post('description'),
					"video_duaration"          		=> $this->input->post('video_duaration'),
					"duration_in_minutes" => $time_duration,
					"video_style"          		=> $this->input->post('video_style'),
					"video_difficulity"          		=> $this->input->post('video_difficulity'),
					"picture_main" 					=> $picture_1,
					"date_modified"         		=> date("Y-m-d"),
			        "date_created"          		=> date("Y-m-d")
				);

				if($this->input->post('videoType') != ""){
					$array['videoType'] = $this->input->post('videoType');
					if($this->input->post('videoType') == "youtubeLink"){
						$array['video_link'] = $this->input->post('video_link');
						$this->Home_video_model->deleteVideoFile($id);
					}else{
						if($this->input->post('file_name')!=''){
							$this->Home_video_model->deleteVideoFile($id);
							$file_name = $this->input->post('file_name');
						}else{
							$file_name = $this->input->post('old_file_name');
						}
						$array['video_link'] = "";
						$array['file_name'] = $file_name;
					}
				}

				$slug = url_title($this->input->post('title'), 'dash', true);
				$array['slug'] = $slug;
				$user_record				 =	$this->Home_video_model->update($array,$this->input->post('id'));
				if($user_record) {
					$this->session->unset_userdata(array('picture_name'));
					$this->session->unset_userdata(array('file_name'));
					redirect('admin/home_video?msg=Update Successfully');
				}else {
					$data['error']	    = 'Some Error try later';
					$data['sliderDetail'] = $_REQUEST;
				}
			}else{
				$data['sliderDetail'] = $_REQUEST;
			}
		}
		$this->load->view('admin/edit_home_video',$data);
	}
	public function deleteimageFirst(){
		$id = $this->input->get('id');
		$this->Home_video_model->deleteimageMain($id);
		redirect('admin/home_video/edit/'.$id.'?msg=Image Deleted Successfully');
	}

	public function deleteVideoFile(){
		$id = $this->input->get('id');
		$this->Home_video_model->deleteVideoFile($id);
		redirect('admin/home_video/edit/'.$id.'?msg=Image Deleted Successfully');
	}

	public function delete(){
		$this->Home_video_model->deletePictureAndRow($this->input->get('id'));
		redirect('admin/home_video?msg=Deleted Successfully');
	}

	public function uploadAddImage(){
		if($this->session->userdata('picture_name')!=''){
			@unlink('uploads/data/'.$this->session->userdata('picture_name'));
		}
		$picture_name = 'product_' . time();
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

	public function uploadVideo(){
		if($this->session->userdata('file_name')!=''){
			@unlink('uploads/videos/'.$this->session->userdata('file_name'));
		}
		$file_name = time();
		$path         = 'uploads/videos/';

		$file_name = $this->Common_model->uploadFile($file_name,$path);
		if ($file_name){
			$arr            = array('file_name' =>  $file_name);
			$this->session->set_userdata($arr);
			$array = array('error'=>'','file_name' => $file_name);
			echo json_encode($array);
		}else{
			$error = array('error' => strip_tags($this->upload->display_errors()).$this->image_lib->display_errors());
			echo json_encode($error);
		}
	}
}