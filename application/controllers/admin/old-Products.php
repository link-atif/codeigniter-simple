<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller
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
        $config["base_url"]    = base_url() . "admin/products/index";
        $config["total_rows"]  = $this->Product_model->countProductsTotal($arr);
		if($this->input->get('per_page')){
			$config["per_page"]    = $this->input->get('per_page');
		}else{
        	$config["per_page"]    = 4;
		}
        $config["uri_segment"] = 3;
		$config['reuse_query_string']   = true;

        $this->pagination->initialize($config);

        $page 		           = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		/*if($this->input->get('sort_by')){
			$arr['sort_by'] = $this->input->get('sort_by');
			$arr['order'] = $this->input->get('order');
		}*/
		$data['products']         = $this->Product_model->getAllProducts($arr,$page,$config["per_page"] );
		$data["links"]         = $this->pagination->create_links();
		$data['page_title']    = 'Products';
		$data['page_heading']  = 'Products';
		
		$data['msg'] = $this->input->get('msg') ? $this->input->get('msg') : '';
		$this->load->view('admin/products',$data);
	}
	
	public function addProduct() {

		$data['page_title']   = 'Add Product';
		$data['page_heading'] = 'Add Product';		
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
					"sort_order" => $this->input->post('sort_order') ? $this->input->post('sort_order') : 0,
					"picture" => $this->input->post('picture_name'),
					"product_name" => $this->input->post('name'),
					"category_name" => $this->input->post('category_name'),
					"description" => $this->input->post('description'),
					"price" => $this->input->post('price'),
					"quantity" => $this->input->post('quantity'),
					"date_modified" => date("Y-m-d"),
					"date_created" => date("Y-m-d")
				);
				$merchandise_id = $this->Product_model->save_product($merchandise);
				

				
				if($merchandise_id){
					$this->session->unset_userdata(array('picture_name'));
					redirect('admin/products?msg=Added Successfully');
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
		$this->load->view('admin/add_product',$data);
	}

	public function editProduct($id) {
		$data['page_title']   = 'Edit Product';
		$data['page_heading'] = 'Edit Product';

		if($id=='') {
			redirect(base_url()."admin/products?msg=Invalid Request");
		}else{
			$data['productDetail'] = $this->Product_model->get_product_detail_by_id($id);
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
				if($this->input->post('picture_name')!=''){
					$this->Product_model->deleteSliderFile($this->input->post('merchandise_id'));
					$picture_name = $this->input->post('picture_name');
				}else{
					$picture_name = $this->input->post('old_picture');
				}
				$merchandise_id = $this->input->post('merchandise_id');
				$merchandise = array(
					"sort_order" => $this->input->post('sort_order') ? $this->input->post('sort_order') : 0,
					"picture" => $picture_name,
					"product_name" => $this->input->post('product_name'),
					"category_name" => $this->input->post('category_name'),
					"description" => $this->input->post('description'),
					"price" => $this->input->post('price'),
					"quantity" => $this->input->post('quantity'),
					"date_modified" => date("Y-m-d")
				);
				$m = $this->Product_model->update_product($merchandise, $merchandise_id);
				if($m){
					$this->session->unset_userdata(array('picture_name'));
					redirect('admin/products?msg=Added Successfully');
				}else {
					$data['error']	    = 'Some Error try later';
					$data['productDetail'] = $_REQUEST;
				}
			}else{
				$data['productDetail'] = $_REQUEST;
			}
		}
		$data['language'] = $this->Common_model->get_all_languages();
		$this->load->view('admin/edit_product',$data);
	}
	
	public function deleteProduct() {
		$id = $this->input->get('id');
		$data['user'] = $this->Product_model->deleteProduct($id);
		redirect(base_url().'admin/products?msg=Deleted Successfully');
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
