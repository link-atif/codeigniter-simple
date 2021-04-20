<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Live_stream extends CI_Controller
{
	function __construct() {

        parent::__construct();
        $this->load->model('Live_stream_model');
        $this->load->library("pagination");
        $this->load->model('Common_model');
        $this->load->library('image_lib');
        $this->load->model('Preferences_model');
        global $activity_log_types;
		if($this->session->userdata('admin_id')=='') {
			redirect('admin/login');
		}
    }
    
	public function index() {
		$arr 		           = array();
        $arr['name']           = $this->input->get('name') ? $this->input->get('name') : '';
		$config 			   = array();
        $config["base_url"]    = base_url() . "admin/live_stream/index";
        $config["total_rows"]  = $this->Live_stream_model->countProductsTotal($arr);
		if($this->input->get('per_page')){
			$config["per_page"]    = $this->input->get('per_page');
		}else{
        	$config["per_page"]    = 6;
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
        if($this->input->get('sort_by')){
			$arr['sort_by'] = $this->input->get('sort_by');
			$arr['order'] = $this->input->get('order');
		}
		$data['live_stream']  = $this->Live_stream_model->getAllLive_stream($arr,$page, $config["per_page"]);
		$data['page_title']    = 'Live Streams';
		$data['page_heading']  = 'Live Streams';
		$data['msg'] 		   = $this->input->get('msg') ? $this->input->get('msg') : '';
		$data["links"]         = $this->pagination->create_links();
		$this->load->view('admin/live_stream',$data);
	}

	public function addlive_stream() {
		
		$data['page_title']   = 'Add Live Stream';
		$data['page_heading'] = 'Add Live Stream';

		
		
		if($this->input->post()) {
			$rules = array(
			    array(
                	'field'   => 'tittle',
                 	'label'   => 'Tittle',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'link',
                 	'label'   => 'Zoom Link',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'time_pdt',
                 	'label'   => 'Time PDT',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'time_bst',
                 	'label'   => 'Time BST',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'days',
                 	'label'   => 'Days',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'price',
                 	'label'   => 'Price',
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
					"tittle" => $this->input->post('tittle'),
					"link" => $this->input->post('link'),
					"time_pdt" => $this->input->post('time_pdt'),
					"time_bst" => $this->input->post('time_bst'),
					"days" => $this->input->post('days'),
					"price" => $this->input->post('price'),
					"date_modified" => date("Y-m-d"),
					"date_created" => date("Y-m-d"),
					"picture" => $this->input->post('picture')
				);

				$slider_id = $this->Live_stream_model->save($slider);
				
				if($slider_id) {
					$this->session->unset_userdata(array('picture_name'));
					redirect('admin/live_stream?msg=Added Successfully');
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
		$this->load->view('admin/add_live_stream',$data);
	}

	public function edit($id) {
		
		$data['page_title']   = 'Edit Live Stream ';
		$data['page_heading'] = 'Edit Live Stream';

		if($id=='') {
			redirect(base_url()."admin/live_stream?msg=Invalid image");
		}else{
			$data['sliderDetail'] = $this->Live_stream_model->getRow($id);
		}
		
		if($this->input->post()) {
			$rules = array(
			    array(
                	'field'   => 'tittle',
                 	'label'   => 'Tittle',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'link',
                 	'label'   => 'Zoom Link',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'time_pdt',
                 	'label'   => 'Time PDT',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'time_bst',
                 	'label'   => 'Time BST',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'days',
                 	'label'   => 'Days',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'price',
                 	'label'   => 'Price',
                 	'rules'   => 'trim|required'
              	)
            );

			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run()) {
				if($this->input->post('picture')!=''){
					$this->Live_stream_model->deleteSliderFile($id);
					$picture_name = $this->input->post('picture');
				}else{
					$picture_name = $this->input->post('old_picture');
				}
				$slider = array(
							"tittle" 		=> $this->input->post('tittle'),
							"link" 		=> $this->input->post('link'),
							"time_pdt" 			=> $this->input->post('time_pdt'),
							"time_bst" 			=> $this->input->post('time_bst'),
							"days" 			=> $this->input->post('days'),
							"price" 			=> $this->input->post('price'),
							"date_modified" => date("Y-m-d"),
							"picture"       => $picture_name
						 );
				$slider_id	=	$this->Live_stream_model->update($slider,$id);
				if($slider_id) {
					$this->session->unset_userdata(array('picture_name'));
					redirect('admin/live_stream?msg=Updated Successfully');
				}else {
					$data['error']	    = 'Some Error try later';
					$data['sliderDetail'] = $_REQUEST;
				}
			}else{
				$data['sliderDetail'] = $_REQUEST;
				}
		}
		$data['language'] = $this->Common_model->get_all_languages();
		$this->load->view('admin/edit_live_stream',$data);
	}

	public function deleteImage(){

		$id = $this->input->get('id');
		$this->Live_stream_model->deletePictureAndRow($id);
		redirect('admin/live_stream/edit/'.$id.'&msg=Image Deleted Successfully');
	}

	public function deleteLive_stream(){
		$id = $this->input->get('id');
		$this->Live_stream_model->deleteSliderFile($id);
		redirect('admin/live_stream/edit/'.$id.'?msg=Image Deleted Successfully');
	}
	
	public function deleteArabicLive_stream(){
		$id = $this->input->get('id');
		$this->Live_stream_model->deleteArabicSliderFile($id);
		redirect('admin/live_stream/edit/'.$id.'?msg=Image Deleted Successfully');
	}

	public function delete($id){
		$this->Live_stream_model->deletePictureAndRow($id);
		redirect('admin/live_stream?msg=Deleted Successfully');
	}

	public function uploadAddImage(){
		
		if($this->session->userdata('picture_name')!=''){
			@unlink('uploads/data/'.$this->session->userdata('picture_name'));
		}

		$picture_name = 'Live_stream_' . time();
		$path         = 'uploads/data/';
		$picture_name = $this->Common_model->uploadImageAndResize($picture_name,$path,1920,960);
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
	
	public function uploadAddImageArabic(){
		
		if($this->session->userdata('arabic_picture_name')!=''){
			@unlink('uploads/data/'.$this->session->userdata('arabic_picture_name'));
		}

		$picture_name = 'sliderimage_' . time();
		$path         = 'uploads/data/';
		$picture_name = $this->Common_model->uploadImageAndResize($picture_name,$path,1920,960);
		if ($picture_name){
			$arr            = array('arabic_picture_name' =>  $picture_name);
			$this->session->set_userdata($arr);
			$array = array('error'=>'','arabic_picture_name' => $picture_name);
			echo json_encode($array);
		}else{
			$error = array('error' => strip_tags($this->upload->display_errors()).$this->image_lib->display_errors());
			echo json_encode($error);
		}
	}
}