<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');
class Plans extends CI_Controller{
	function __construct() {
        parent::__construct();
        $this->load->model('Plans_model');
        $this->load->model('Common_model');
        $this->load->library('image_lib');
		$this->load->library("pagination");
		if(!$this->session->userdata('admin_id')) {
			redirect(base_url().'admin/login');
		}

		initialized_stripe();
    }
	public function index() {
		$data['plans']         = $this->Plans_model->getPlans();
		$data['page_title']    = 'Plans';
		$data['page_heading']  = 'Plans';
		$data['msg'] = $this->input->get('msg') ? $this->input->get('msg') : '';
		$this->load->view('admin/plans',$data);
	}
	public function add() {
		$data['page_title']   = 'Add Plans';
		$data['page_heading'] = 'Add Plans';
		if($this->input->post()) {
			$rules = array(
				array(
				    'field'   => 'title',
                 	'label'   => 'Title',
                 	'rules'   => 'trim|required'
                 ),
				array(
				    'field'   => 'heading',
                 	'label'   => 'Time Period',
                 	'rules'   => 'trim|required'
                 ),
				array(
				    'field'   => 'price',
                 	'label'   => 'Price',
                 	'rules'   => 'trim|required'
                 ),
				array(
				    'field'   => 'details',
                 	'label'   => 'Details',
                 	'rules'   => 'trim|required'
                 ),
				array(
				    'field'   => 'picture_main',
                 	'label'   => 'picture',
                 	'rules'   => 'trim|required'
                 )
            );
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$array = array(
					"title"          	=> $this->input->post('title'),
					"heading"          	=> $this->input->post('heading'),
					"price"          	=> $this->input->post('price'),
					"details"          	=> $this->input->post('details'),
					"trial_period"          	=> $this->input->post('trial_period'),
					"picture_main"      		=> $this->input->post('picture_main'),
					"date_modified"         	=> date("Y-m-d"),
			        "date_created"          	=> date("Y-m-d")
				 );
				$slug = url_title($this->input->post('title'), 'dash', true);
				$array['slug'] = $slug;
				$user_record				 =	$this->Plans_model->save($array);
				if($user_record) {
					$result = $this->_addStripePlan($array['title'], $array['price'], $array['heading'], $user_record);
					$this->session->unset_userdata(array('picture_name'));
					if($result['success']==true){
						redirect('admin/plans?msg=Added Successfully');
					}else{
						$data['error']	    = $result['message'];
						$data['sliderDetail'] = $_REQUEST;	
					}
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
		$this->load->view('admin/add_plans',$data);
	}

	public function add_plan($id=''){
        if($this->input->post()){
	       	$result = $this->_validate_form();
			if($result['success']==true){
				$data = $result['data'];
				if($id){
					$this->subscription_model->update($data,$id);
					$this->_update_stripe_plan($id,$data['name']);
					redirect(base_url()."subscription?success=Updated successfully");
				}else{
					$id = $this->subscription_model->addStripePackage($data);
					$result = $this->_addStripePlan($data['name'],$data['amount'],$data['type'],$id);
					if($result['success']==true){
						redirect(base_url()."subscription?success=Added successfully");
					}else{
						redirect(base_url()."subscription?error=".$result['message']);
					}
				}
			}else{
				$this->data['error'] = $data['message'];
			}
        }
        if($id){
        	$this->data['res'] = $this->subscription_model->get_row($id);
        }

        $this->data['view'] = "subscription/add_plan";
        $this->load->view('layouts/layout', $this->data);
    }

    private function _addStripePlan($name,$amount,$type,$id){
        $arr = array();
		try {
			\Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);
            $plan_array = array(
                "name"            => $name,
            );
			$plan = \Stripe\Product::create($plan_array);

            $plan_array_1 = array(
                "interval"        => get_interval($type),
                "interval_count"  => get_interval_count($type),
                "currency"        => STRIPE_CURRENCY,
                "amount"          => $amount*100,
                "product"         => $plan->id,
            );
            $prices = \Stripe\Plan::create($plan_array_1);
			$this->Plans_model->update(array("stripe_plan_id"=>$prices->id, 'stripe_product_id' => $plan->id),$id);
			$arr = array("success" => true, "message"=>"created successfully");
		}catch (Exception $e) {
			$array = $e->getJsonBody();
			$arr = array("success" => false, "message"=>$array['error']['message']);
		}
		return $arr;
    }

	private function _update_stripe_plan($id,$name){
		try {
			$result = \Stripe\Product::update($id,["name" => $name]);
			$arr = array("success" => true, "message" => "Plan Updated successfully!");
		}catch (Exception $e) {
			$array = $e->getJsonBody();
			$arr = array("success" => false, "message" => $array['error']['message']);
		}
		return $arr;
	}

	public function edit($id) {
		$data['page_title']   = 'Edit Plans';
		$data['page_heading'] = 'Edit Plans';
		if($id=='') {
			redirect(base_url()."admin/plans?msg=Invalid Request");
		}else{
			$data['sliderDetail'] = $this->Plans_model->getRowEdit($id);
		}
		if($this->input->post()) {
			$rules = array(
				array(
				    'field'   => 'title',
                 	'label'   => 'Title',
                 	'rules'   => 'trim|required'
                 ),
				array(
				    'field'   => 'heading',
                 	'label'   => 'Time Period',
                 	'rules'   => 'trim|required'
                 ),
				array(
				    'field'   => 'price',
                 	'label'   => 'Price',
                 	'rules'   => 'trim|required'
                 ),
				array(
				    'field'   => 'details',
                 	'label'   => 'Details',
                 	'rules'   => 'trim|required'
                 )
            );
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				if($this->input->post('picture_main')!=''){
					$this->Plans_model->deleteimageMain($id);
					$picture_1 = $this->input->post('picture_main');
				}else{
					$picture_1 = $this->input->post('old_main_picture');
				}
				$array = array(
					"title"          		=> $this->input->post('title'),
					"heading"          		=> $this->input->post('heading'),
					"price"          		=> $this->input->post('price'),
					"details"          		=> $this->input->post('details'),
					"trial_period"          	=> $this->input->post('trial_period'),
					"picture_main" 			=> $picture_1,
					"date_modified"         => date("Y-m-d"),
			        "date_created"          => date("Y-m-d")
				 );
				$slug = url_title($this->input->post('title'), 'dash', true);
				$array['slug'] = $slug;
				$old_data =  $this->Plans_model->getRowEdit($this->input->post('id'));
				$user_record =	$this->Plans_model->update($array,$this->input->post('id'));
				if($user_record) {
					$this->session->unset_userdata(array('picture_name'));
					if($old_data['price'] == $array['price'] && $old_data['heading'] == $array['heading'] && $array['title'] != $old_data['heading']){
						$result = $this->_update_stripe_plan($old_data['stripe_product_id'], $array['heading']);
						if($result['success']==true){
							redirect('admin/plans?msg=Updated Successfully!');
						}else{
							$data['error']	    = $result['message'];
							$data['sliderDetail'] = $_REQUEST;	
						}
					}
					if($old_data['price'] != $array['price'] || $old_data['heading'] != $array['heading']){
						$result = $this->_addStripePlan($array['title'], $array['price'], $array['heading'], $old_data['id']);
						if($result['success']==true){
							redirect('admin/plans?msg=Added Successfully');
						}else{
							$data['error']	    = $result['message'];
							$data['sliderDetail'] = $_REQUEST;	
						}
					}
					redirect('admin/plans?msg=Update Successfully');
				}else {
					$data['error']	    = 'Some Error try later';
					$data['sliderDetail'] = $_REQUEST;
				}
			}else{
				$data['sliderDetail'] = $_REQUEST;
			}
		}
		$this->load->view('admin/edit_plans',$data);
	}
	public function deleteimageFirst(){
		$id = $this->input->get('id');
		$this->Plans_model->deleteimageMain($id);
		redirect('admin/plans/edit/'.$id.'?msg=Image Deleted Successfully');
	}
	public function deleteimageSecond(){
		$id = $this->input->get('id');
		$this->Plans_model->deleteimageS1($id);
		redirect('admin/plans/edit/'.$id.'?msg=Image Deleted Successfully');
	}
	public function delete(){
		$this->Plans_model->deletePictureAndRow($this->input->get('id'));
		redirect('admin/plans?msg=Deleted Successfully');
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
	
}