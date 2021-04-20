<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Gifts extends CI_Controller{
	function __construct() {
        parent::__construct();
        $this->load->model('Gifts_model','parent_model');
        $this->load->model('Common_model');
        $this->load->library('image_lib');
        $this->load->model('Modifiergroup_model');
		$this->load->library("pagination");
		if(!$this->session->userdata('admin_id')) {
			redirect(base_url().'admin/login');
		}

		$this->prefix = 'admin';
		$this->controller = 'gifts';
		$this->add_view= 'add_gift';
		$this->edit_view = 'edit_gift';
		$this->foreign_key = 'gift_id';
    	$this->data['msg'] = $this->input->get('msg') ? $this->input->get('msg') : '';
    }
    
	public function index() {
		$arr 		           = array();
        $arr['title']           = $this->input->get('name') ? $this->input->get('name') : '';
		$config 			   = array();
        $config["base_url"]    = base_url() . $this->prefix."/".$this->controller;
        $config["total_rows"]  = $this->parent_model->countTotal($arr);		
		if($this->input->get('per_page')){
			$config["per_page"]    = $this->input->get('per_page');
		}else{
        	$config["per_page"]    = 20;
		}
        $config["uri_segment"] = 3;
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

        $page 		           = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		if($this->input->get('sort_by')){
			$arr['sort_by'] = $this->input->get('sort_by');
			$arr['order'] = $this->input->get('order');
		}
		$this->data['details']         = $this->parent_model->getAll($arr,$page,$config["per_page"] );
		$this->data["links"]         = $this->pagination->create_links();
		$this->data['page_title']    = 'Services & Solutions';
		$this->data['page_heading']  = 'Services & Solutions';
		$this->load->view($this->prefix.'/'.$this->controller,$this->data);
	}

	public function add() {
		$this->data['page_title']   = 'Add Services & Solutions';
		$this->data['page_heading'] = 'Add Services & Solutions';
		
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
					"name" => $this->input->post('name'),
					"category_id" => $this->input->post('category_id'),
					"description" => $this->input->post('description'),
					"sort_order" => $this->input->post('sort_order') ? $this->input->post('sort_order') : 0,
					"picture" => $this->input->post('picture_name'),
					"date_created"	=> date("Y-m-d")
				);
				$id = $this->parent_model->save($array);
				if($id) {
					$this->session->unset_userdata(array('picture_name'));
					redirect($this->prefix.'/'.$this->controller.'?msg=Added Successfully');
				}else {
					$this->data['error'] = 'Some Error try later';
					$this->data['detail'] = $_REQUEST;
				}
			}else{
				$this->data['detail'] = $_REQUEST;
			}
		}else {
			$this->data['detail'] = array();
		}
		$this->data['modifiergroups'] = $this->Modifiergroup_model->getAllForDropdown();
		
		$this->load->view($this->prefix.'/'.$this->add_view,$this->data);
	}

	public function edit($id) {
		$this->data['page_title']   = 'Edit Services & Solutions';
		$this->data['page_heading'] = 'Edit Services & Solutions';

		if($id=='') {
			redirect(base_url().$this->prefix."/".$this->controller."?msg=Invalid Request");
		}else{
			$this->data['detail'] = $this->parent_model->getById($id);

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
					$this->parent_model->deleteSliderFile($this->input->post('id'));
					$picture_name = $this->input->post('picture_name');
				}else{
					$picture_name = $this->input->post('old_picture');
				}
				
				$array = array(
					"name" => $this->input->post('name'),
					"category_id" => $this->input->post('category_id'),
					"description" => $this->input->post('description'),
					"sort_order" => $this->input->post('sort_order') ? $this->input->post('sort_order') : 0,
					"picture" => $picture_name
				);
				$detail = $this->parent_model->update($array,$this->input->post('id'));
				if($detail) {
					$this->session->unset_userdata(array('picture_name'));
					redirect($this->prefix.'/'.$this->controller.'?msg=Updated Successfully');
				}else {
					$this->data['error']	    = 'Some Error try later';
					$this->data['detail'] = $_REQUEST;
				}
			}else{
				$this->data['detail'] = $_REQUEST;
			}
		}

        $this->data['modifiergroups'] = $this->Modifiergroup_model->getAllForDropdown();
		$this->load->view($this->prefix.'/'.$this->edit_view,$this->data);
	}

	

	public function deleteImage(){
		$id = $this->input->get('id');
		$this->parent_model->deleteSliderFile($id);
		redirect($this->prefix.'/'.$this->controller.'/edit/'.$id.'?msg=Image Deleted Successfully');
	}
	
	public function delete(){
		$this->parent_model->delete($this->input->get('id'));
		redirect($this->prefix.'/'.$this->controller.'?msg=Deleted Successfully');
	}

	public function giftCards($id){

        $this->data['page_title'] = "Icon Images";
        $this->data['page_heading'] = "Icon Images";
        $this->data['gift_id'] = $id;
        $this->data['name'] = $this->parent_model->getGiftName($id);
        $this->data['giftCards'] = $this->parent_model->getAllGiftCards($id);

        $this->load->view($this->prefix.'/giftcards', $this->data);
    }

    public function deleteGiftCard($id,$c_id){
	    $this->parent_model->deleteGiftCardItem($id);
	    redirect($this->prefix."/Gifts/giftCards/".$c_id."?success=Services & Solutions deleted successfully!");
  	}

    public function multipleImageStore(){
      $countfiles = count($_FILES['files']['name']);
      for($i=0;$i<$countfiles;$i++){
        if(!empty($_FILES['files']['name'][$i])){
          // Define new $_FILES array - $_FILES['file']
          $_FILES['file']['name'] = $_FILES['files']['name'][$i];
          $_FILES['file']['type'] = $_FILES['files']['type'][$i];
          $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
          $_FILES['file']['error'] = $_FILES['files']['error'][$i];
          $_FILES['file']['size'] = $_FILES['files']['size'][$i];
 
          // Set preference
          $config['upload_path'] = './uploads/giftCards/'; 
          $config['allowed_types'] = 'jpg|jpeg|png|gif';
          $config['max_size'] = '5000'; // max_size in kb
          $config['file_name'] = $_FILES['files']['name'][$i];
  
          //Load upload library
          $this->load->library('upload',$config); 
          $arr = array('msg' => 'something went wrong', 'success' => false);
          // File upload
          if($this->upload->do_upload('file')){
           
           $data = $this->upload->data(); 
           $insert['card_picture'] = $data['file_name'];
           $insert['gift_id'] = $this->input->post('gift_id');
           $this->db->insert('gift_cards',$insert);
           $get = $this->db->insert_id();
          }
        }
  
      }
      $id = $this->input->post('gift_id');
      redirect(base_url()."admin/gifts/giftCards/".$id."?success=Image has been uploaded successfully!");
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