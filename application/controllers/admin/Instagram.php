<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Instagram extends CI_Controller
{
	function __construct() {

        parent::__construct();
        $this->load->model('Instagram_model');
        
        $this->load->model('Common_model');
        $this->load->library('image_lib');
        $this->load->model('Preferences_model');
        global $activity_log_types;
		if($this->session->userdata('admin_id')=='') {
			redirect('admin/login');
		}
    }
    
	public function index() {
		$data['instagram']  = $this->Instagram_model->getAllInstagram();
		$data['page_title']    = 'Instagram Posts';
		$data['page_heading']  = 'Instagram Posts';
		$data['msg'] 		   = $this->input->get('msg') ? $this->input->get('msg') : '';
		$this->load->view('admin/instagram',$data);
	}

	public function addInstagram() {
		
		$data['page_title']   = 'Add Instagram Image';
		$data['page_heading'] = 'Add Instagram Image';

		
		
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
                )
            );

			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run()) {
				$slider = array(
					"title" => $this->input->post('title'),
					"like" => $this->input->post('like'),
					"comment" => $this->input->post('comment'),
					"link" => $this->input->post('link'),
					"sort_order" => $this->input->post('sort_order'),
					"picture" => $this->input->post('picture'),
					"status" => $this->input->post('status')
					
				);

				$slider_id = $this->Instagram_model->save($slider);
				
				if($slider_id) {
					$this->session->unset_userdata(array('picture_name'));
					redirect('admin/instagram?msg=Added Successfully');
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
		$this->load->view('admin/add_instagram',$data);
	}

	public function edit($id) {
		
		$data['page_title']   = 'Edit Instagram Image';
		$data['page_heading'] = 'Edit Instagram Image';

		if($id=='') {
			redirect(base_url()."admin/Instagram?msg=Invalid post");
		}else{
			$data['sliderDetail'] = $this->Instagram_model->getRow($id);
			
		}
		
		if($this->input->post()) {
			$rules = array(
				array(
                     'field'   => 'sort_order',
                     'label'   => 'Sort Order',
                     'rules'   => 'trim|required'
                )
            );

			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run()) {
				if($this->input->post('picture')!=''){
					//$this->Member_model->deleteSliderFile($id);
					$picture_name = $this->input->post('picture');
				}else{
					$picture_name = $this->input->post('old_picture');
				}
				
				$slider = array(
					"sort_order" => $this->input->post('sort_order'),
					"status" => $this->input->post('status')
				);

				$slider_id	=	$this->Instagram_model->update($slider,$id);
				
				if($slider_id) {
					redirect('admin/instagram?msg=Updated Successfully');
				}else {
					$data['error']	    = 'Some Error try later';
					$data['sliderDetail'] = $_REQUEST;
				}
			}else{
				$data['sliderDetail'] = $_REQUEST;
			}
		}
		$data['language'] = $this->Common_model->get_all_languages();
		$this->load->view('admin/edit_instagram',$data);
	}

	public function deleteImage(){

		$id = $this->input->get('id');
		$this->Instagram_model->deletePictureAndRow($id);
		redirect('admin/instagram/edit/'.$id.'&msg=Image Deleted Successfully');
	}

	public function deleteSliderImage(){
		$id = $this->input->get('id');
		$this->Instagram_model->deleteSliderFile($id);
		redirect('admin/instagram/edit/'.$id.'?msg=Image Deleted Successfully');
	}
	public function delete($id){
		$this->Instagram_model->deletePictureAndRow($id);
		redirect('admin/instagram?msg=Deleted Successfully');
	}

	public function uploadAddImage(){
		
		if($this->session->userdata('picture_name')!=''){
			@unlink('uploads/data/'.$this->session->userdata('picture_name'));
		}

		$picture_name = 'instagram_' . time();
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

	/*public function uploadAddImage(){
		
		if($this->session->userdata('picture_name')!=''){
			@unlink('uploads/data/'.$this->session->userdata('picture_name'));
		}

		$picture_name = 'sliderimage_' . time();
		$path         = 'uploads/slider/';
		$picture_name = $this->Common_model->uploadImageAndResize($picture_name,$path,378,270);
		if ($picture_name){
			$arr            = array('picture_name' =>  $picture_name);
			$this->session->set_userdata($arr);
			$array = array('error'=>'','picture_name' => $picture_name);
			echo json_encode($array);
		}else{
			$error = array('error' => strip_tags($this->upload->display_errors()).$this->image_lib->display_errors());
			echo json_encode($error);
		}
	}*/

	public function instagramPosts(){
		$url = "https://graph.instagram.com/".INSTA_USER_ID."/media?access_token=".INSTA_TOKEN;
		 $this->loadPosts($url);
	}

	public function loadPosts($url){
		$media = array();
        //$url = "https://graph.instagram.com/".INSTA_USER_ID."/media?access_token=".INSTA_TOKEN;
        $data = $this->curl->getRequest($url);

       	if(!empty($data)){
        	foreach ($data->data as $key => $value) {
        		echo "Id => " . $value->id . "<br>";
        		$check = $this->Instagram_model->checkInstaPost($value->id);
        		if($check){
	        		$url2 = "https://graph.instagram.com/".$value->id."?fields=media_type,media_url,thumbnail_url,permalink&access_token=".INSTA_TOKEN;
	        		$data1 = $this->curl->getRequest($url2);
	        		
	        		if($data1->media_type == "IMAGE"){
	        			echo "key=> " . $key."<br>";
		        		$postData = array(
		        			'post_id' => $value->id,
		        			'media_url' => $data1->media_url,
		        			'media_type' => $data1->media_type,
		        			'permalink' => $data1->permalink
		        		);
		        		

		        		$result = $this->Instagram_model->saveInstaPost($postData);
	        		}
	        	}
        	}
        }

        if(isset($data->paging->next) && $data->paging->next !=""){
        	$this->loadPosts($data->paging->next);
        }

        redirect('admin/instagram');
	}

	/*public function loadPosts(){
		$media = array();
        $url = "https://graph.instagram.com/".INSTA_USER_ID."/media?access_token=".INSTA_TOKEN;
        $data = $this->curl->getRequest($url);

        if(!empty($data)){
        	foreach ($data->data as $key => $value) {

        		echo "Id => " . $value->id . "<br>";
        		$check = $this->Instagram_model->checkInstaPost($value->id);
        		if($check){
	        		$url2 = "https://graph.instagram.com/".$value->id."?fields=caption,media_type,media_url,thumbnail_url,permalink&access_token=".INSTA_TOKEN;
	        		$data1 = $this->curl->getRequest($url2);
	        		
	        		if($data1->media_type == "IMAGE"){
	        			echo "key=> " . $key."<br>";
		        		$postData = array(
		        			'post_id' => $value->id,
		        			'media_url' => $data1->media_url,
		        			'media_type' => $data1->media_type,
		        			'media_caption' => $data1->caption, 
		        			'permalink' => $data1->permalink
		        		);
		        		

		        		$result = $this->Instagram_model->saveInstaPost($postData);
	        		}
	        	}
        	}
        }

        redirect('admin/instagram');
	}*/
}