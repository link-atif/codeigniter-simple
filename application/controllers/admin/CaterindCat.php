<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class CaterindCat extends CI_Controller
{
	function __construct() {

        parent::__construct();
		$this->load->model('Product_model');
		$this->load->model('Common_model');
		$this->load->library("pagination");
		
		if(!$this->session->userdata('admin_id')) {
			redirect(base_url().'admin/login');
		}
    }
    
	public function index() {
		
		$arr 		           = array();
        $arr['name']           = $this->input->get('name') ? $this->input->get('name') : '';

		$config 			   = array();
        $config["base_url"]    = base_url() . "admin/caterindCat/index";
        $config["total_rows"]  = $this->Product_model->countItemsTotal($arr);
		if($this->input->get('per_page')){
			$config["per_page"]    = $this->input->get('per_page');
		}else{
        	$config["per_page"]    = 4;
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

        $this->pagination->initialize($config);

        $page 		           = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        
		if($this->input->get('sort_by')){
			$arr['sort_by'] = $this->input->get('sort_by');
			$arr['order'] = $this->input->get('order');
		}
		$data['products']         = $this->Product_model->getAllTems($arr,$page,$config["per_page"] );
		$data["links"]         = $this->pagination->create_links();
		$data['page_title']    = 'Catering';
		$data['page_heading']  = 'Catering';
		
		$data['msg'] = $this->input->get('msg') ? $this->input->get('msg') : '';
		$this->load->view('admin/catering_cat',$data);
	}
	
	public function add() {

		$data['page_title']   = 'Add Catering';
		$data['page_heading'] = 'Add Catering';		
		if($this->input->post()) {
			$rules = array(
			    array(
                	'field'   => 'name',
                 	'label'   => 'Name',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'category_name',
                 	'label'   => 'Category Name',
                 	'rules'   => 'trim|required'
              	)
            );
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$merchandise = array(
					"product_name" => $this->input->post('name'),
					"category_name" => $this->input->post('category_name'),
					"date_modified" => date("Y-m-d"),
					"date_created" => date("Y-m-d")
				);

				$merchandise_id = $this->Product_model->save_items($merchandise);
				
				if($merchandise_id){
					
					redirect('admin/caterindCat?msg=Added Successfully');
				}else {
					$data['error']	    = 'Some Error try later';
					$data['productDetail'] = $_REQUEST;
				}
			}else{
				$data['productDetail'] = $_REQUEST;
			}
		}else {
			$data['productDetail'] = array();
		}
		$data['language'] = $this->Common_model->get_all_languages();
		$this->load->view('admin/add_catering_cat',$data);
	}

	public function editProduct($id) {
		$data['page_title']   = 'Edit Catering';
		$data['page_heading'] = 'Edit Catering';

		if($id=='') {
			redirect(base_url()."admin/caterindCat?msg=Invalid Request");
		}else{
			$data['productDetail'] = $this->Product_model->get_items_detail_by_id($id);
		}

		if($this->input->post()) {
			$rules = array(
			    array(
                	'field'   => 'product_name',
                 	'label'   => 'Name',
                 	'rules'   => 'trim|required'
              	),
              	 array(
                	'field'   => 'category_name',
                 	'label'   => 'Name',
                 	'rules'   => 'trim|required'
              	)
            );
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				
				$merchandise_id = $this->input->post('merchandise_id');
				$merchandise = array(
					"product_name" => $this->input->post('product_name'),
					"category_name" => $this->input->post('category_name'),
					"date_modified" => date("Y-m-d")
				);
				$m = $this->Product_model->update_items($merchandise, $merchandise_id);
				if($m){
					$this->session->unset_userdata(array('picture_name'));
					redirect('admin/caterindCat?msg=Added Successfully');
				}else {
					$data['error']	    = 'Some Error try later';
					$data['productDetail'] = $_REQUEST;
				}
			}else{
				$data['productDetail'] = $_REQUEST;
			}
		}
		$data['language'] = $this->Common_model->get_all_languages();
		$this->load->view('admin/edit_catering_cat',$data);
	}
	
	public function deleteProduct() {
		$id = $this->input->get('id');
		$data['user'] = $this->Product_model->deleteItems($id);
		redirect(base_url().'admin/caterindCat?msg=Deleted Successfully');
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
