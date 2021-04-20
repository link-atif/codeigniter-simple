<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');/*
require_once APPPATH."libraries/recaptchalib.php";*/
class Connect extends CI_Controller {
	function __construct() {
        parent::__construct();
		$this->load->model('Pages_model');
		$this->load->model("Media_model");
		$this->load->model('Location_model');
    	$this->load->model('Instagram_model');
		$this->load->model('Contactqueries_model');
		$this->load->model('Product_model');
		$this->load->model('Emailtemplates_model');
		$this->load->model('Common_model');
		$this->load->model('Preferences_model');
		$this->load->model('Users_model');
		$this->data['header_pages']  = $this->Pages_model->getPagesByType('header','both');
		$this->data['footer_pages']  = $this->Pages_model->getPagesByType('footer','both');
		$this->load->model('Preferences_model');
    	$this->load->model('Common_model');
    	$this->load->model('Testimonials_model');
    	$language = $this->Common_model->get_language_name();
    	$this->data['language'] = $language;
    	$this->load->language("access",$language);
    }

	public function index(){
		$this->data['tab_title'] 	=  TAB_TITLE.' | Contact';
		$this->data['page_title'] 	=  'Get in touch';
		
		if ($this->input->post()) {
			$rules = array(
               array(
                     'field'   => 'name',
                     'label'   => 'Name',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'subject',
                     'label'   => 'Subject',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'email',
                     'label'   => 'Email',
                     'rules'   => 'required|valid_email'
                  ),
               array(
                     'field'   => 'message',
                     'label'   => 'Message',
                     'rules'   => 'required'
                  )
            );

			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				// your secret key
				$secret = "6LeYXIAaAAAAAHchXWMgdqgfoUeRlATj3oRuX80Y";
				
				// empty response
				$response = null;
				
				
				// check secret key
				$reCaptcha = new ReCaptcha($secret);
				if ($_POST["g-recaptcha-response"]) {
					$response = $reCaptcha->verifyResponse(
						$_SERVER["REMOTE_ADDR"],
						$_POST["g-recaptcha-response"]
					);

					
					if ($response != null && $response->success) {
						$array = array(
							"full_name"		  	 	=> $this->input->post('name'),
							"subject"  		 		=> $this->input->post('subject'),
							//"contact"  		 		=> $this->input->post('contact'),
							"email"  	 			=> $this->input->post('email'),
							"message"	  		 	=> $this->input->post('message'),
							"date_created"  		=> date('Y-m-d H:i:s',time())
							
						);
						$contact_id = $this->Users_model->insertContactUsFormData($array);
						redirect(base_url().'connect?msg=Message sent successfully');
						/*if($contact_id) {
							$to = $this->Preferences_model->getValue('email');
							$subject	= $this->input->post('subject');
							$message	= $this->input->post('message');
							$email_array = array(
												"name"			=> $this->input->post('full_name'),
												"user_email"	=> $this->input->post('email'),
												"reason"		=> $this->input->post('reason'),
												"phone"			=> $this->input->post('phone'),
												"message"		=> $this->input->post('message'),
												"subject"		=> "Contact Us query"
											);
							if($this->input->post('reason')=='Al Quoz Branch'){
								$email_array['email'] = 'hello@thesmashroom.com';
								$email_array['cc'] = '';
							}else if($this->input->post('reason')=='Last Exit Mad X Branch'){
								$email_array['email'] = 'action@thesmashroom.com';
								$email_array['cc'] = '';
							}else if($this->input->post('reason')=='Franchising'){
								$email_array['email'] = 'admin@thesmashroom.com';
								$email_array['cc'] = 'ibrahim@thesmashroom.com';
							}
							$this->Emailtemplates_model->sendMail('contactus',$email_array);
							$arr = "";
							redirect(base_url().'Contactus?msg=Message sent successfully');
							//redirect(base_url().'contactus?msg=1');
						}else {
							$data['error']	    = 'Some Error try later';
							$data['contactDetail'] = $_REQUEST;
						}*/
					}else{
						$this->data['error']	    = 'Google recaptch error!';
						$this->data['contactDetail'] = $_REQUEST;
					}
				}else{
					$this->data['error']	    = 'Google recaptch error!';
					$this->data['contactDetail'] = $_REQUEST;
				}
			}else{
				$this->data['contactDetail'] = $_REQUEST;
				$this->data['error'] = validation_errors();
			}
		}
		$this->data['msg'] = ($this->input->get("msg")!='') ? $this->input->get("msg"): "";
        $this->data['instagram']    = $this->Instagram_model->getAllInstagram();
		$this->load->view('contact',$this->data);
	}
}