<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'/third_party/stripe-php/init.php');

class Gifts extends CI_Controller{
	function __construct() {
        parent::__construct();
        $this->load->model('Gifts_model','parent_model');
        $this->load->model('Common_model');
        $this->load->model("Sliderimages_model");
        $this->load->model('Location_model');
        $this->load->model("Media_model");
        $this->load->model("Follow_model");
    	$this->load->model("Pages_model");
    	$this->load->model('Services_model');
    	$this->load->model('Portfolio_model');
    	$this->load->model('Reviews_model');
    	$this->load->model('Blogs_model');
    	$this->load->model('Preferences_model');
    	$this->load->model('Users_model');
    	$this->load->model('Package_model');

		$this->controller = 'gifts';
		$this->foreign_key = 'gift_id';
    	$this->data['msg'] = $this->input->get('msg') ? $this->input->get('msg') : '';
    }
    
	public function index() {
		$this->data['page_title']    = "Gifts";
		$this->data['page_heading']  = "Gifts";
		$this->data['giftCards'] = $this->parent_model->getAllGifts();
		$this->load->view('gift_cards',$this->data);
	}

	public function send_card($c_id){

		$this->data['cards'] = $this->parent_model->getGiftCardDetailsById($c_id);
		if (!empty($this->session->flashdata('form_data'))) {
        	$this->data['form_data'] = $this->session->flashdata('form_data');
      	}
      	if(!empty($this->session->flashdata('error'))) {
        	$this->data['error'] = $this->session->flashdata('error');
      	}
		$this->load->view('send_card',$this->data);
	}

	public function send_gift(){
		if ($this->input->post()) {
			$rules = array(
               array(
                     'field'   => 'gift_to_name',
                     'label'   => 'To Name',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'gift_to_email',
                     'label'   => 'To Email',
                     'rules'   => 'required|valid_email'
                  ),
               array(
                     'field'   => 'gift_from_name',
                     'label'   => 'From Name',
                     'rules'   => 'required'
                ),
               array(
                     'field'   => 'gift_from_email',
                     'label'   => 'From Email',
                     'rules'   => 'required|valid_email'
                ),
               array(
                     'field'   => 'payment_method',
                     'label'   => 'Payment Method',
                     'rules'   => 'required'
                ),
               array(
                     'field'   => 'gift_amount',
                     'label'   => 'Gift Amount',
                     'rules'   => 'required'
                )

            );
         
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$array = array(
					"sender_id" => $this->session->userdata("user_id"),
 					"toName" => $this->input->post('gift_to_name'),
					"toEmail" => $this->input->post('gift_to_email'),
					"fromName"  => $this->input->post('gift_from_name'),
					"fromEmail" => $this->input->post('gift_from_email'),
					//"payment_method" => $this->input->post('payment_method'),
					"amount" => $this->input->post('gift_amount'),
					"message" => $this->input->post('message'),
					"gift_id"  => $this->input->post('gift_id'),
					"card_id"  => $this->input->post('card_id'),					
					"created_on" => date("Y-m-d"),
				);
				if($this->session->userdata('user_id')!='') {
					
				$result = $this->parent_model->sendGiftCard($array);
                if($result){
                    //$customer_update = $this->Customers_model->updateCustomerBalance($receiverData->customer_id,$this->input->post('amount'));
                    //$email_arr = array("from_email" => $new_array['from_email'], "from_name" => $new_array['from_name'], "email" => $new_array['to_email'], "amount" => $new_array['amount']);
                    //$mail = $this->Emailtemplates_model->sendEmail('giftcard',$email_arr);
                	//$this->session->set_flashdata('msg', "Sended successfully");
					$this->session->set_userdata('gift_id',$result);
					//redirect('Gifts/proceed_to_payment');
                	echo json_encode(['status' => 'true']); die;
                }
            }else{
            	
				//$this->session->set_flashdata('error', validation_errors());
				//$this->session->set_flashdata('form_data', $_REQUEST);
				echo json_encode(['status' => 'login']); die;
				//redirect('Gifts/send_card/'.$this->input->post('gift_id').'/'.$this->input->post('card_id'));
			}
			}else{
				$this->session->set_flashdata('error', validation_errors());
				$this->session->set_flashdata('form_data', $_REQUEST);
				echo json_encode(['status' => 'false']); die;
				//redirect('Gifts/send_card/'.$this->input->post('gift_id').'/'.$this->input->post('card_id'));
			}
		}
		$this->session->set_flashdata('error', "Invalid Request!");
		redirect('Gifts');
	}

	public function proceed_to_payment(){
		//$data['msg'] = $this->session->flashdata('msg');
		$gift_id = $this->session->userdata('gift_id');
      	$gift_details = $this->parent_model->getGiftDataById($gift_id);		
		$data['amount'] = $gift_details->amount;
		if($this->input->post()) {
            $result = $this->_subscribe_customer($this->session->userdata('gift_id'), $gift_details->amount);
            if($result['success'] == true){
                $this->session->set_flashdata('msg','Gift Sended Successfully!');
				redirect("Gifts/checkout");
            }else{
                $data['error'] = $result['message'];
            }
        }
		$this->load->view('payment-view',$data);
	}

	public function checkout(){
		$data['msg'] = $this->session->flashdata('msg');
      	$this->cart->destroy();
     	$this->load->view('checkout',$data);
	}

	private function _subscribe_customer($id, $amount){
        $stripe_token = $this->input->post('stripeToken');
        $arr = "";
        try {
            \Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);
            $charge = \Stripe\Charge::create(array(
                "amount"        => $amount*100,
                "description"   => "One Time bill payment",
                "currency"      => STRIPE_CURRENCY,
                "source"        => $stripe_token
            ));
         
            $data['merchant_response'] = mysql_real_escape_string($charge);
            /* if remember card yes in customer then token will be save */
            $countinue_process = true;
            $data['payment_status'] = 'completed';
            $this->parent_model->updateGiftDetails($data,$id);
            $arr = array("success"=>true,"message"=>"Payment Charged Successfully");
        }catch (Exception $e) {
        // The card has been declined
            $countinue_process = false;
            $array = $e->getJsonBody();
            $arr = $array['error']['message'];
        }
        return $arr;
    }

	public function add() {
		$this->data['page_title']   = 'Add '.ucfirst($this->controller);
		$this->data['page_heading'] = 'Add '.ucfirst($this->controller);
		
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
		$this->load->view($this->prefix.'/'.$this->add_view,$this->data);
	}

	public function edit($id) {
		$this->data['page_title']   = 'Edit '.ucfirst($this->controller);
		$this->data['page_heading'] = 'Edit '.ucfirst($this->controller);

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
        $this->data['page_title'] = "Gift Cards";
        $this->data['page_heading'] = "Gift Cards";
        $this->data['gift_id'] = $id;
        $this->data['name'] = $this->parent_model->getGiftName($id);
        $this->data['giftCards'] = $this->parent_model->getAllGiftCards($id);        
        $this->load->view($this->prefix.'/giftcards', $this->data);
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