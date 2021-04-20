<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Modifiers extends CI_Controller{
	function __construct(){
        parent::__construct();
        $this->load->model('Modifiergroup_model');
        $this->load->model('Users_model');
        $this->load->library("pagination");
        $this->load->model("Product_model");
        $this->load->model("Location_model");
        if ($this->input->get('error')) {
            $this->data['error'] = $this->input->get('error');
        }
        if ($this->input->get('success')) {
            $this->data['success'] = $this->input->get('success');
        }

    }
    
	public function index(){
        $arr                   = array();
        $arr['search']           = $this->input->get('search') ? $this->input->get('search') : '';
        $config                = array();
        $config["base_url"]    = base_url() . "admin/modifiers/index";
        $config["total_rows"]  = $this->Modifiergroup_model->count_all_modifiers($arr);

        if($this->input->get('per_page')){
            $config["per_page"]    = $this->input->get('per_page');
        }else{
            $config["per_page"]    = 20;
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

        $page                  = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $data['detail']         = $this->Modifiergroup_model->get_all_modifiers($arr, $page, $config["per_page"]);
        $data["links"]         = $this->pagination->create_links();
        $data['msg'] = $this->input->get('msg') ? $this->input->get('msg') : '';
        $data['page_title']    = 'Modifiers';
        $data['page_heading']  = 'Modifiers';
        $data['branches'] = $this->Location_model->getAllLocation();
        $this->load->view('admin/modifiers', $data);
	}

    public function import_modifiers(){
        $branch_id = $this->input->post('branch_id');
        $location = $this->Location_model->getById($branch_id);
        $url = API_URL.$location->merchant_id."/modifiers?access_token=".$location->api_token; //GET_MODIFIER_URL
        $data = $this->curl->getRequest($url,array());
        if($data != "" && $branch_id > 0){
            foreach($data->elements as $key => $value){
                $new_array = array(
                    "clover_id"   => $value->id,
                    "branch_id" => $branch_id,
                    "name"  => $value->name ? $value->name : "",
                    "price"  => $value->price ? $value->price : 0,
                    "modifiergroup_id" => $value->modifierGroup ? $value->modifierGroup->id : 0
                );
                $this->Modifiergroup_model->save_modifiers($new_array);
            }
        }
        redirect(base_url('admin/modifiers'));
    }
    public function edit_modifier($id){
        $data['page_title']   = 'Edit Modifier';
        $data['page_heading'] = 'Edit Modifier';

        if($id=='') {
            redirect(base_url()."admin/modifiers?msg=Invalid Request");
        }else{
            $data['productDetail'] = $this->Modifiergroup_model->get_modifiergroup_detail($id);
        }

        if($this->input->post()) {
            $rules = array(
                array(
                    'field'   => 'name',
                    'label'   => 'Name',
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
                
                $merchandise = array(
                    "branch_id" => $this->input->post('branch_id'),
                    "modifiergroup_id" => $this->input->post('modifiergroup_id'),
                    "name" => $this->input->post('name'),
                    "price" => $this->input->post('price'),
                    "date_updated" => date("Y-m-d")
                );
                $m = $this->Product_model->update_modifiers($merchandise, $id);
                if($m){
                    //$this->session->unset_userdata(array('picture_name'));
                    redirect('admin/modifiers?msg=Updated Successfully');
                }else {
                    $data['error']      = 'Some Error try later';
                    $data['productDetail'] = $_REQUEST;
                }
            }else{
                $data['productDetail'] = $_REQUEST;
            }
        }
        
      $data['modifiergroups'] = $this->Modifiergroup_model->getAllForDropdown();
      $data['branches'] = $this->Location_model->getAllLocation();
        $this->load->view('admin/edi_modifiers', $data);
    }
     public function add_modifier(){
        $data['page_title']   = 'Add Modifiers';
        $data['page_heading'] = 'Add Modifiers';

       

        if($this->input->post()) {
            $rules = array(
                array(
                    'field'   => 'name',
                    'label'   => 'Name',
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
                
                $merchandise = array(
                    "branch_id" => $this->input->post('branch_id'),
                    "modifiergroup_id" => $this->input->post('modifiergroup_id'),
                    "name" => $this->input->post('name'),
                    "price" => $this->input->post('price'),
                    "date_updated" => date("Y-m-d")
                );
                $m = $this->Modifiergroup_model->add_modifiernew($merchandise);
                if($m){
                    //$this->session->unset_userdata(array('picture_name'));
                    redirect('admin/modifiers?msg=Added Successfully');
                }else {
                    $data['error']      = 'Some Error try later';
                    $data['productDetail'] = $_REQUEST;
                }
            }else{
                $data['productDetail'] = $_REQUEST;
            }
        }
        
      $data['modifiergroups'] = $this->Modifiergroup_model->getAllForDropdown();
      $data['branches'] = $this->Location_model->getAllLocation();
        $this->load->view('admin/add_modifiers', $data);
    }
     public function delete_modifier($id){
       // $edit_mg_url = str_replace('modGroupId', $mId, EDIT_MG_URL);
        //$tags_data      = $this->curl->deleteRequest($edit_mg_url);
        $result = $this->Modifiergroup_model->delete_modifieragains_id($id);
        redirect(base_url('admin/modifiers?success=Modifier  deleted successfully!'));
    }
	
}
