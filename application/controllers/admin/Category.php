<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');
class Category extends CI_Controller{
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
		$arr 		           = array();
        $arr['title']           = $this->input->get('title') ? $this->input->get('title') : '';
		$config 			   = array();
        $config["base_url"]    = base_url() . "admin/Category/index";
        
        $config["total_rows"]  = $this->Media_model->countTotal($arr);

        
		if($this->input->get('per_page')){
			$config["per_page"]    = $this->input->get('per_page');
		}else{
        	$config["per_page"]    = 10;
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

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$data['media']         = $this->Media_model->getAll($arr,$page,$config["per_page"] );
		$data["links"]         = $this->pagination->create_links();
		$data['page_title']    = 'Categories';
		$data['page_heading']  = 'Category';
		$data['branches'] = $this->Location_model->getAllLocation();
		$data['msg'] = $this->input->get('msg') ? $this->input->get('msg') : '';
		$this->load->view('admin/category',$data);
	}

	public function add() {
		$data['page_title']   = 'Add Category';
		$data['page_heading'] = 'Add Category';
		
		if($this->input->post()) {
			$rules = array(
				array(
				    'field'   => 'title_english',
                 	'label'   => 'Title',
                 	'rules'   => 'trim|required'
                 ),
				array(
				    'field'   => 'title_arabic',
                 	'label'   => 'Title',
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
				$media = array(
					"title_english" => $this->input->post('title_english'),
					"title_arabic" => $this->input->post('title_arabic'),
					"sort_order" => $this->input->post('sort_order'),					
					"date_modified" => date("Y-m-d"),
					"date_created"	=> date("Y-m-d")
				);
				$slug = url_title($this->input->post('title_english'), 'dash', true);
				$media['slug'] = $slug;
				$new_array = array(
                    "name"             => $this->input->post('title_english')
                );

                /*$category_data   = $this->curl->postRequest(ADD_CATEGORIES_URL,$new_array);
				if(!isset($category_data->id)){
                    $data['error'] = isset($category_data->message) ? $category_data->message : "Clover Connection Error!";
                    $data['mediaDetail'] = $_REQUEST;
                }else{
                    $media['sort_order'] = $category_data->sortOrder;
                    $media['clover_id']  = $category_data->id;*/
                	
                	$media_id = $this->Media_model->save_media($media);
                    if($media_id) {
						$this->session->unset_userdata(array('picture_name'));
						redirect('admin/Category?msg=Added Successfully');
					}else {
						$data['error']	    = 'DB Error';
						$data['mediaDetail'] = $_REQUEST;
					}
               // }
			}else{
				$data['mediaDetail'] = $_REQUEST;
			}
		}else {
			$data['mediaDetail'] = array();
		}
		//$data['language'] = $this->Common_model->get_all_languages();
		$data['locations'] = $this->Location_model->getAllLocation();
		$this->load->view('admin/add_category',$data);
	}

	public function edit($id) {
		$data['page_title']   = 'Edit Category';
		$data['page_heading'] = 'Edit Category';

		if($id=='') {
			redirect(base_url()."admin/Category?msg=Invalid Request");
		}else{
			$data['mediaDetail'] = $this->Media_model->get_media_detail_by_id($id);

		}
		if($this->input->post()) {
			$rules = array(
				array(
				    'field'   => 'title_english',
                 	'label'   => 'Title',
                 	'rules'   => 'trim|required'
                 ),
				array(
				    'field'   => 'title_arabic',
                 	'label'   => 'Title',
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
				$media = array(
					"title_english" => $this->input->post('title_english'),
					"title_arabic" => $this->input->post('title_arabic'),
					"sort_order" => $this->input->post('sort_order'),
					"date_modified" => date("Y-m-d")
				);
				$slug = url_title($this->input->post('title_english'), 'dash', true);
				$media['slug'] = $slug;
                    $media_id = $this->Media_model->update_media($media,$this->input->post('media_id'));
					if($media_id) {
						$this->session->unset_userdata(array('picture_name'));
						redirect('admin/Category?msg=Updated Successfully');
					}else {
						$data['error']	    = 'Some Error try later';
						$data['mediaDetail'] = $_REQUEST;
					}
                //}
			}else{
				$data['mediaDetail'] = $_REQUEST;
			}
		}
		//$data['language'] = $this->Common_model->get_all_languages();
		$data['locations'] = $this->Location_model->getAllLocation();
		$this->load->view('admin/edit_category',$data);
	}
	
	public function delete(){

		$catId = $this->input->get('id');
		
		//$edit_category_url = str_replace('catId', $catId, EDIT_CATEGORIES_URL);
        //$category_data      = $this->curl->deleteRequest($edit_category_url);
		$this->Media_model->delete($catId);
		redirect('admin/Category?msg=Deleted Successfully');
	}
	
}