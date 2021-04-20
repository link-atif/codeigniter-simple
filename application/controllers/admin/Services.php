<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Services extends CI_Controller
{
	function __construct() {
    parent::__construct();
    $this->load->model('Services_model');
   	$this->load->model('Preferences_model');
    $this->load->model('Common_model');
		$this->load->library("pagination");
		if(!$this->session->userdata('admin_id')) {
			redirect(base_url().'admin/login');
		}
  }
    
	public function index() {
		$arr 		         = array();
    $arr['name']     = $this->input->get('name') ? $this->input->get('name') : '';
		$config 			   = array();
    $config["base_url"]    = base_url() . "admin/services";
    $config["total_rows"]  = $this->Services_model->countTotal($arr);
		if($this->input->get('per_page')){
			$config["per_page"]    = $this->input->get('per_page');
		}else{
      $config["per_page"]    = 10;
		}
    $config["uri_segment"] = 3;
		$config['reuse_query_string']   = true;
    $this->pagination->initialize($config);
    $page 		           = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		if($this->input->get('sort_by')){
			$arr['sort_by'] = $this->input->get('sort_by');
			$arr['order'] = $this->input->get('order');
		}
		$data['services']      = $this->Services_model->getAll($arr,$page,$config["per_page"] );
		$data["links"]         = $this->pagination->create_links();
		$data['page_title']    = 'Services';
		$data['page_heading']  = 'Services';
		
		$data['msg'] = $this->input->get('msg') ? $this->input->get('msg') : '';
		$this->load->view('admin/services',$data);
	}

	public function add() {
		$data['page_title']   = 'Add Services';
		$data['page_heading'] = 'Add Services';
		
		if($this->input->post()) {
			$rules = array(
				array(
				    'field'   => 'name',
                 	'label'   => 'Icon Name',
                 	'rules'   => 'trim|required'
                 ),
			    array(
                	'field'   => 'title',
                 	'label'   => 'Title',
                 	'rules'   => 'trim|required'
              	),
              		array(
                     'field'   => 'link',
                     'label'   => 'Link'
                ),
              	array(
                     'field'   => 'detail',
                     'label'   => 'detail',
                     'rules'   => 'trim|required'
                )
            );

			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$array = array(
					"name"   => $this->input->post('name'),
					"title"  => $this->input->post('title'),
					"detail" => $this->input->post('detail'),
					"link"   => $this->input->post('link'),
					"date"   => date("Y-m-d")
				);
				$user_record				 =	$this->Services_model->save($array);
        if($user_record){
          redirect('admin/services?msg=Added Successfully');
        }
			}else{
				$data['sliderDetail'] = $_REQUEST;
			}
		}else {
			$data['sliderDetail'] = array();
		}
		$this->load->view('admin/add_services',$data);
	}

	public function edit($id) {
		$data['page_title']   = 'Edit Service';
		$data['page_heading'] = 'Edit Service';

		if($id=='') {
			redirect(base_url()."admin/services?msg=Invalid Request");
		}else{
			$data['sliderDetail'] = $this->Services_model->getRow($id);
		}
		
		if($this->input->post()) {
			$rules = array(
  			array(
          'field'   => 'name',
         	'label'   => 'Icon Name',
         	'rules'   => 'trim|required'
        ),
  	    array(
        	'field'   => 'title',
         	'label'   => 'Title',
         	'rules'   => 'trim|required'
      	),
    		array(
           'field'   => 'link',
           'label'   => 'Link'
        ),
      	array(
           'field'   => 'detail',
           'label'   => 'detail',
           'rules'   => 'trim|required'
        )
      );

			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$array = array(
					"name"          		=> $this->input->post('name'),
					"title"          		=> $this->input->post('title'),
					"detail"    			=> $this->input->post('detail'),
					"link"    			    => $this->input->post('link'),
					"date"        			=> date("Y-m-d")
				);

				$user_record				 =	$this->Services_model->update($array,$this->input->post('id'));
				if($user_record) {
					redirect('admin/services?msg=Update Successfully');
				}else {
					$data['error']	    = 'Some Error try later';
					$data['sliderDetail'] = $_REQUEST;
				}
			}else{
				$data['sliderDetail'] = $_REQUEST;
			}
		}
		$this->load->view('admin/edit_services',$data);
	}

  public function delete(){
    $this->Services_model->delete($this->input->get('id'));
    redirect('admin/services?msg=Deleted Successfully');
  }
	
}
?>