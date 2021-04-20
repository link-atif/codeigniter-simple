<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Modifiergroup extends CI_Controller{
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
        $config["base_url"]    = base_url() . "admin/modifiergroup/index";
        $config["total_rows"]  = $this->Modifiergroup_model->count_all_modifiergroup($arr);

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

        $page                  = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data['detail']         = $this->Modifiergroup_model->get_all_modifiergroup($arr, $page, $config["per_page"]);
        $data["links"]         = $this->pagination->create_links();
        $data['msg'] = $this->input->get('msg') ? $this->input->get('msg') : '';
        $data['page_title']    = 'Modifier Group';
        $data['page_heading']  = 'Modifier Group';
        $data['branches'] = $this->Location_model->getAllLocation();
        $this->load->view('admin/modifiergroup', $data);
    }

    public function add_modifiergroup(){
        $this->data['page_title'] = "Add Mofifier Groups"; 
        if($this->input->post()){
            $rules = array(
                array(
                    'field'   => 'name',
                    'label'   => 'Name',
                    'rules'   => 'trim|required'
                )
            );
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run()){
                $new_array = array(
                    "name"          => $this->input->post('name'),
                    "alternateName"=> $this->input->post('alternate_name') ? $this->input->post('alternate_name') : ""
                );
                 
                $modifiergroup_data   = $this->curl->postRequest(GET_MG_URL,$new_array);
                if(!isset($modifiergroup_data->id)){
                    $this->data['error'] = $modifiergroup_data->message;
                    $this->data['modifiergroup_data'] = $_REQUEST;
                }else{
                    $new_array['mId']  = $modifiergroup_data->id;
                    $result = $this->Modifiergroup_model->add_modifiergroup($new_array);    
                    redirect(base_url('admin/modifiergroup?success=Modifier Group Added Successfully'));
                }
            }else{
                $error=validation_errors();
                $this->data['error'] = $error;
                $this->data['modifiergroup_data'] = $_REQUEST;
            }
        }
        $this->load->view('admin/add_modifiergroup', $this->data);
    }

    public function edit_modifiergroup(){
        if($this->input->get('id')){
            $this->data['detail']  = $this->Modifiergroup_model->get_modifiergroup_detail_by_id($this->input->get('id'));
            $this->data['page_title'] = "Edit Modifier Group";
            $this->data['page_heading']  = 'Edit Modifier Group'; 
        }
        if($this->input->post()){
            $rules = array(
                array(
                    'field'   => 'name',
                    'label'   => 'Name',
                    'rules'   => 'trim|required'
                )
            );
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run()){
                $new_array = array(
                    "name"          => $this->input->post('name'),
                    "alternateName" => $this->input->post('alternate_name') ? $this->input->post('alternate_name') : ""
                );
                /*$edit_mg_url = str_replace('modGroupId', $this->input->post('modGroupId'), EDIT_MG_URL);
                $modifiergroup_data   = $this->curl->postRequest($edit_mg_url,$new_array);

                if(!isset($modifiergroup_data->id)){
                    $this->data['error'] = $modifiergroup_data->message;
                    $this->data['modifiergroup_data'] = $_REQUEST;
                }else{*/
                   // $new_array['mId']  = $modifiergroup_data->id;
                    
                    $result = $this->Modifiergroup_model->update_modifiergroup_detail($this->input->post('id'),$new_array);    
                    redirect(base_url('admin/modifiergroup?success=Modifier Group Updated Successfully'));
                //}
            }else{
                $error=validation_errors();
                $this->data['error'] = $error;
                $this->data['$modifiergroup_data'] = $_REQUEST;
            }
        }
        $this->load->view('admin/edit_modifiergroup', $this->data);
    }

    public function delete_modifiergroup($id){
       // $edit_mg_url = str_replace('modGroupId', $mId, EDIT_MG_URL);
        //$tags_data      = $this->curl->deleteRequest($edit_mg_url);
        $result = $this->Modifiergroup_model->delete_modifiergroup($id);
        redirect(base_url('admin/modifiergroup?success=Modifier Group deleted successfully!'));
    }

    public function import_modifiergroup(){
        $branch_id = $this->input->post('branch_id');
        $location = $this->Location_model->getById($branch_id);
        $url = API_URL.$location->merchant_id."/modifier_groups?access_token=".$location->api_token; //GET_MG_URL
        $data = $this->curl->getRequest($url,array());
        if($data != "" && $branch_id > 0){
            if($data != ""){
                foreach($data->elements as $key => $value){
                    $new_array = array(
                        "mId"   => $value->id,
                        "branch_id" => $branch_id,
                        "name"  => $value->name ? $value->name : ""
                    );
                    $this->Modifiergroup_model->save_modifiergroup($new_array);
                }
            }
        }
        redirect(base_url('admin/modifiergroup'));
    }
    
}
