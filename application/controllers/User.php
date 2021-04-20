<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct() {

        parent::__construct();
        $this->load->model('Media_model');
		$this->load->model('Contactqueries_model');
		$this->load->model('Plans_model');
		$this->load->model('Common_model');
		$this->load->model('Favourites_model');
		$this->load->model('Emailtemplates_model');
		$this->load->model('Registration_model');
		$this->load->model('Users_model');
		$this->load->model('Order_model');
		$this->load->model('Product_model');
		$this->load->library('session');
		$this->load->helper('cookie');
		$language = $this->Common_model->get_language_name();
    	$this->data['language'] = $language;
    	$this->load->language("access",$language);

    	initialized_stripe();

    	$this->tab_title = "Yoga with Emilia";
    }

    public function login_page(){
    	$this->data['page_title'] = 'Login';
    	if($this->session->userdata('user_id')!='') {

			redirect(base_url().'home/favourites');

		}
		//s$language = $this->Common_model->get_language_name();
		//$id=$this->session->userdata('user_id');
		//$data['order_row'] = $this->Users_model->getOrders_($id);
		$this->load->view('login_page',$this->data);

    }
    	public function add_to_wishlist(){
			
		
			/*$pas = generatePassword();
			$password=$this->Common_model->encryptIt($pas,TRUE);*/
			$array = array(
			
			"user_id"		=> $this->input->post('type'),
			"product_id"		=> $this->input->post('product_id')
				

			);
			$user_row = $this->Users_model->checkwhislistexist($this->input->post('product_id'),$this->session->userdata('user_id'));
			
			
				
				

				if($user_row){

					//$password = $this->Common_model->decryptIt($user_record,TRUE);
					//$email_arr = array("password"=>$password,"email"=>$array['email'],"name"=>$array['first_name']);
					//$result = $this->Emailtemplates_model->sendEmail('verification',$email_arr);
					$arr['success'] = false;
					$arr['message']	= 'Already Exists In Favourites.';
				}else{
					$contact_id = $this->Users_model->insertproductwhishlist($array);
					//$password = $this->Common_model->decryptIt($user_record,TRUE);
					//$email_arr = array("password"=>$password,"email"=>$array['email'],"name"=>$array['first_name']);
					//$result = $this->Emailtemplates_model->sendEmail('verification',$email_arr);
					$arr['success'] = true;
					$arr['message']	= 'Register successfully.';
				}
			
		echo json_encode($arr);

	}

    public function register_page(){
    	$this->data['page_title'] = 'Register';
    	if($this->session->userdata('user_id')!='') {

			redirect(base_url().'myorders');

		}
		//s$language = $this->Common_model->get_language_name();
		//$id=$this->session->userdata('user_id');
		//$data['order_row'] = $this->Users_model->getOrders_($id);
		$this->load->view('register_page',$this->data);

    }


    public function forgotpassword(){
    	$this->data['page_title'] = 'Forgot Password';
    	
		//s$language = $this->Common_model->get_language_name();
		//$id=$this->session->userdata('user_id');
		//$data['order_row'] = $this->Users_model->getOrders_($id);
		$this->load->view('common/forgot_page',$this->data);

    }
     public function newsletters_subscription()
	{
		$data	=	array();
		if($this->input->post())
		{
			$rules = array(
               array(
                     'field'   => 'email',
                     'label'   => 'Email',
                     'rules'   => 'required|valid_email'
                  )
            );

			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run())
			{
				$array = array(
				"email"		=> $this->input->post('email'),
				"name"		=> $this->input->post('name')

			); 
				$contact_id = $this->Users_model->insertnewsletteremailFormData($array);
				$arr['success'] = true;
				$arr['message']	= 'Thank you for subscribing!';
				
			}else{
				$arr['success'] = false;
				$arr['message']	= "Invalid Email Address!";
			}
		}else{
			$arr['success'] = false;
			$arr['message']	= "Invalid Email Address!";
		}
		echo json_encode($arr);
		
	}
    public function forgetPasswordmail()
	{
		$data	=	array();
		if($this->input->post())
		{
			$rules = array(
               array(
                     'field'   => 'email',
                     'label'   => 'Email',
                     'rules'   => 'required|valid_email'
                  )
            );

			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run())
			{
				$email 		= $this->input->post('email');

                
				$user_row = $this->Users_model->checkUserexist($email);
				

				if ($user_row) {
					$user_record	=	$this->Users_model->getUserPassword($email);
					
					if($user_record){
						//$password=$this->Common_model->decryptIt($user_record,TRUE);
						
						$message = 'Your Password is '. $user_record->password;
						//mail($email,'Forget Password',$message);
						$email_arr = array("password"=>$user_record->password,"email"=>$email);
						$result = $this->Emailtemplates_model->sendEmail('forgotpassword',$email_arr);
						$arr['success'] = true;
						$arr['message']	= 'Password Successfully sent to your Email.';
					}else{
						$arr['success'] = false;
						$arr['message']	= 'Email is wrong.';
					}
				}else{
					$arr['success'] = false;
					$arr['message']	= 'We didnot Find your Email! Please register First!!';
				}
			}else{
				$arr['success'] = false;
				$arr['message']	= validation_errors();
			}
		}else{
			$arr['success'] = false;
			$arr['message']	= "Invalid Request";
		}
		echo json_encode($arr);
		
	}







	public function updateAccountdata(){
		$rules = array(
           array(
                 'field'   => 'f_name',
                 'label'   => 'f name',
                 'rules'   => 'required'
              ),
           	array(
                 'field'   => 'l_name',
                 'label'   => 'l name',
                 'rules'   => 'required'
              ),
           	array(
                 'field'   => 'email',
                 'label'   => 'email',
                 'rules'   => 'required|valid_email'
              ),
           array(
                 'field'   => 'plan_heading',
                 'label'   => 'plan heading'
              ),
           array(
                 'field'   => 'plan_price',
                 'label'   => 'plan price'
              ),
           array(
                 'field'   => 'plan_duration',
                 'label'   => 'plan duration'
              ),
           array(
                 'field'   => 'password',
                 'label'   => 'password',
                 'rules'   => 'required'
              ),
           array(
                 'field'   => 'card_number',
                 'label'   => 'card number',
                 'rules'   => 'required'
              ),
           array(
                 'field'   => 'expiry_date',
                 'label'   => 'expiry date',
                 'rules'   => 'required'
              ),
           array(
                 'field'   => 'cvc',
                 'label'   => 'cvc',
                 'rules'   => 'required'
              )
           
        );
		$this->form_validation->set_rules($rules);
		$arr = array();
		if ($this->form_validation->run()) {
			/*$pas = generatePassword();
			$password=$this->Common_model->encryptIt($pas,TRUE);*/
			$array = array(
				"f_name"			=> $this->input->post('f_name'),
				"l_name"  			=> $this->input->post('l_name'),
				"email"  	 		=> $this->input->post('email'),
				"plan_heading"		=> $this->input->post('plan_heading'),
				"plan_price"  		=> $this->input->post('plan_price'),
				"plan_duration"  	=> $this->input->post('plan_duration'),
				"password"			=> $this->input->post('password'),
				"card_number"  		=> $this->input->post('card_number'),
				"expiry_date"  	 	=> $this->input->post('expiry_date'),
				"type"  	 	=> $this->input->post('type'),
				"cvc"  	 			=> $this->input->post('cvc'),
				"date_created"  	=> date('Y-m-d H:i:s',time())

			);
			//if($this->Users_model->checkUserexist($array['email'])){
    			//$arr['success'] = false;
				//$arr['error'] = "Email already exists";
  			//}else{
			$contact_id = $this->Users_model->updateUserDetail($this->session->userdata("user_id"),$array);
				
				if($contact_id){
					$this->session->unset_userdata('user_id');
					//$password = $this->Common_model->decryptIt($user_record,TRUE);
					//$email_arr = array("password"=>$password,"email"=>$array['email'],"name"=>$array['first_name']);
					//$result = $this->Emailtemplates_model->sendEmail('verification',$email_arr);
					$arr['success'] = true;
					$arr['message']	= 'Updated Successfully!.';
				}else{
					$arr['success'] = false;
					$arr['message']	= 'Email is wrong.';
				}
			//}
		}else{
			$arr['success'] = false;
			$arr['error'] = validation_errors();
		}

		echo json_encode($arr);
	}

	public function register(){
		$rules = array(
           array(
                 'field'   => 'f_name',
                 'label'   => 'f name',
                 'rules'   => 'required'
              ),
           	array(
                 'field'   => 'l_name',
                 'label'   => 'l name',
                 'rules'   => 'required'
              ),
           	array(
                 'field'   => 'email',
                 'label'   => 'email',
                 'rules'   => 'required|valid_email'
              ),
           array(
                 'field'   => 'plan_heading',
                 'label'   => 'plan heading'
              ),
           array(
                 'field'   => 'plan_price',
                 'label'   => 'plan price'
              ),
           array(
                 'field'   => 'plan_duration',
                 'label'   => 'plan duration'
              ),
           array(
                 'field'   => 'password',
                 'label'   => 'password',
                 'rules'   => 'required'
              ),
           /*array(
                 'field'   => 'card_number',
                 'label'   => 'card number',
                 'rules'   => 'required'
              ),
           array(
                 'field'   => 'expiry_date',
                 'label'   => 'expiry date',
                 'rules'   => 'required'
              ),
           array(
                 'field'   => 'cvc',
                 'label'   => 'cvc',
                 'rules'   => 'required'
              ),*/
           /*array(
                 'field'   => 'type',
                 'label'   => 'type',
                 'rules'   => 'required'
              )*/
           
        );
		$this->form_validation->set_rules($rules);
		$arr = array();
		if ($this->form_validation->run()) {
			/*$pas = generatePassword();
			$password=$this->Common_model->encryptIt($pas,TRUE);*/
			$array = array(
				"f_name"			=> $this->input->post('f_name'),
				"l_name"  			=> $this->input->post('l_name'),
				"email"  	 		=> $this->input->post('email'),
				"plan_heading"		=> $this->input->post('plan_heading'),
				"plan_price"  		=> $this->input->post('plan_price'),
				"plan_duration"  	=> $this->input->post('plan_duration'),
				"password"			=> $this->input->post('password'),
				"plan_id"			=> $this->input->post('stripe_plan_id'),
				/*"card_number"  		=> $this->input->post('card_number'),
				"expiry_date"  	 	=> $this->input->post('expiry_date'),
				"type"  	 		=> $this->input->post('type'),
				"cvc"  	 			=> $this->input->post('cvc'),*/
				"date_created"  	=> date('Y-m-d H:i:s',time())

			);
			if($this->Users_model->checkUserexist($array['email'])){
    			$arr['success'] = false;
				$arr['error'] = "Email already exists";
  			}else{
  				$user_id = $this->Users_model->insertRegisterUsFormData($array);

  				$customer = \Stripe\Customer::create(array(
                    'email' => $this->input->post('email'),
                ));

                $customer_array = array("user_id"=>$user_id,"stripe_customer_id"=>$customer->id);
                $this->Users_model->addUserStripCustomer($customer_array);
				
				$user_record	=	$this->Users_model->getUserPassword($array['email']);
				if($user_record){
					//$password = $this->Common_model->decryptIt($user_record,TRUE);
					//$email_arr = array("password"=>$password,"email"=>$array['email'],"name"=>$array['first_name']);
					//$result = $this->Emailtemplates_model->sendEmail('verification',$email_arr);
					$arr['success'] = true;
					$arr['message']	= 'Registerd successfully.';
				}else{
					$arr['success'] = false;
					$arr['message']	= 'Email is wrong.';
				}
			}
		}else{
			$arr['success'] = false;
			$arr['error'] = validation_errors();
		}
		echo json_encode($arr);
	}
	public function bookregister(){
		$rules = array(
           array(
                 'field'   => 'f_name',
                 'label'   => 'f name',
                 'rules'   => 'required'
              ),
           	array(
                 'field'   => 'l_name',
                 'label'   => 'l name',
                 'rules'   => 'required'
              ),
           	array(
                 'field'   => 'email',
                 'label'   => 'email',
                 'rules'   => 'required|valid_email'
              ),
           array(
                 'field'   => 'plan_heading',
                 'label'   => 'plan heading'
              ),
           array(
                 'field'   => 'plan_price',
                 'label'   => 'plan price'
              ),
           array(
                 'field'   => 'plan_duration',
                 'label'   => 'plan duration'
              ),
           array(
                 'field'   => 'password',
                 'label'   => 'password',
                 'rules'   => 'required'
              ),
           array(
                 'field'   => 'card_number',
                 'label'   => 'card number',
                 'rules'   => 'required'
              ),
           array(
                 'field'   => 'expiry_date',
                 'label'   => 'expiry date',
                 'rules'   => 'required'
              ),
           array(
                 'field'   => 'cvc',
                 'label'   => 'cvc',
                 'rules'   => 'required'
              ),
           array(
                 'field'   => 'type',
                 'label'   => 'type',
              )
        );
		$this->form_validation->set_rules($rules);
		$arr = array();
		if ($this->form_validation->run()) {
			/*$pas = generatePassword();
			$password=$this->Common_model->encryptIt($pas,TRUE);*/
			$array = array(
				"f_name"			=> $this->input->post('f_name'),
				"l_name"  			=> $this->input->post('l_name'),
				"email"  	 		=> $this->input->post('email'),
				"plan_heading"		=> $this->input->post('plan_heading'),
				"plan_price"  		=> $this->input->post('plan_price'),
				"plan_duration"  	=> $this->input->post('plan_duration'),
				"password"			=> $this->input->post('password'),
				"card_number"  		=> $this->input->post('card_number'),
				"expiry_date"  	 	=> $this->input->post('expiry_date'),
				"type"  	 		=> $this->input->post('type'),
				"cvc"  	 			=> $this->input->post('cvc'),
				"date_created"  	=> date('Y-m-d H:i:s',time())
			);
			if($this->Users_model->checkUserexist($array['email'])){
    			$arr['success'] = false;
				$arr['error'] = "Email already exists";
  			}else{
				$contact_id = $this->Users_model->insertRegisterUsFormData($array);
				$user_record	=	$this->Users_model->getUserPassword($array['email']);
				if($user_record){
					//$password = $this->Common_model->decryptIt($user_record,TRUE);
					//$email_arr = array("password"=>$password,"email"=>$array['email'],"name"=>$array['first_name']);
					//$result = $this->Emailtemplates_model->sendEmail('verification',$email_arr);
					$arr['success'] = true;
					$arr['message']	= 'Registerd successfully.';
				}else{
					$arr['success'] = false;
					$arr['message']	= 'Email is wrong.';
				}
			}
		}else{
			$arr['success'] = false;
			$arr['error'] = validation_errors();
		}

		echo json_encode($arr);
	}


	public function bookretreats(){
		$rules = array(
           array(
                 'field'   => 'f_name',
                 'label'   => 'f name',
                 'rules'   => 'required'
              ),
           	array(
                 'field'   => 'l_name',
                 'label'   => 'l name',
                 'rules'   => 'required'
              ),
           	array(
                 'field'   => 'email',
                 'label'   => 'email',
                 'rules'   => 'required|valid_email'
              ),
           array(
                 'field'   => 'plan_heading',
                 'label'   => 'plan heading'
              ),
           array(
                 'field'   => 'plan_price',
                 'label'   => 'plan price'
              ),
           array(
                 'field'   => 'plan_duration',
                 'label'   => 'plan duration'
              ),
           array(
                 'field'   => 'type',
                 'label'   => 'type',
              )
        );
		$this->form_validation->set_rules($rules);
		$arr = array();
		if ($this->form_validation->run()) {
			$array = array(
				"f_name"			=> $this->input->post('f_name'),
				"l_name"  			=> $this->input->post('l_name'),
				"email"  	 		=> $this->input->post('email'),
				"plan_heading"		=> $this->input->post('plan_heading'),
				"plan_price"  		=> $this->input->post('plan_price'),
				"plan_duration"  	=> $this->input->post('plan_duration'),
				"user_id"			=> $this->session->userdata('user_id'),
				"type"  	 		=> $this->input->post('type'),
				"retreat_id"  	 		=> $this->input->post('retreat_id'),
				"date_created"  	=> date('Y-m-d H:i:s',time()),
				"start_date"		=> date('Y-m-d'),
				"end_date"			=> endDate($this->input->post('plan_duration')),
				"transaction_id" 	=> $this->input->post('transaction_id'),
			);
			$contact_id = $this->Users_model->inserRetreatsbookingFormData($array);
			if($contact_id){
				$arr['success'] = true;
				$arr['message']	= 'Registerd successfully.';
			}else{
				$arr['success'] = false;
				$arr['message']	= 'Email is wrong.';
			}
		}else{
			$arr['success'] = false;
			$arr['error'] = validation_errors();
		}
		echo json_encode($arr);
	}

	public function Bookinstudio(){
		$rules = array(
           array(
                 'field'   => 'f_name',
                 'label'   => 'f name',
                 'rules'   => 'required'
              ),
           	array(
                 'field'   => 'l_name',
                 'label'   => 'l name',
                 'rules'   => 'required'
              ),
           	array(
                 'field'   => 'email',
                 'label'   => 'email',
                 'rules'   => 'required|valid_email'
              ),
           array(
                 'field'   => 'plan_heading',
                 'label'   => 'plan heading'
              ),
           array(
                 'field'   => 'plan_price',
                 'label'   => 'plan price'
              ),
           array(
                 'field'   => 'plan_duration',
                 'label'   => 'plan duration'
              ),
           array(
                 'field'   => 'password',
                 'label'   => 'password',
                 'rules'   => 'required'
              ),
           array(
                 'field'   => 'card_number',
                 'label'   => 'card number',
                 'rules'   => 'required'
              ),
           array(
                 'field'   => 'expiry_date',
                 'label'   => 'expiry date',
                 'rules'   => 'required'
              ),
           array(
                 'field'   => 'cvc',
                 'label'   => 'cvc',
                 'rules'   => 'required'
              ),
           array(
                 'field'   => 'type',
                 'label'   => 'type',
              )
        );
		$this->form_validation->set_rules($rules);
		$arr = array();
		if ($this->form_validation->run()) {
			/*$pas = generatePassword();
			$password=$this->Common_model->encryptIt($pas,TRUE);*/
			$array = array(
				"f_name"			=> $this->input->post('f_name'),
				"l_name"  			=> $this->input->post('l_name'),
				"email"  	 		=> $this->input->post('email'),
				"plan_heading"		=> $this->input->post('plan_heading'),
				"plan_price"  		=> $this->input->post('plan_price'),
				"plan_duration"  	=> $this->input->post('plan_duration'),
				"password"			=> $this->input->post('password'),
				"card_number"  		=> $this->input->post('card_number'),
				"expiry_date"  	 	=> $this->input->post('expiry_date'),
				"type"  	 		=> $this->input->post('type'),
				"studio_id"  	 		=> $this->input->post('dubaistudio_id'),
				"cvc"  	 			=> $this->input->post('cvc'),
				"date_created"  	=> date('Y-m-d H:i:s',time())
			);
			//if($this->Users_model->checkUserexist($array['email'])){
    			//$arr['success'] = false;
				//$arr['error'] = "Email already exists";
  			//}else{
				$contact_id = $this->Users_model->insertIndubaistudioFormData($array);
				//$user_record	=	$this->Users_model->getUserPassword($array['email']);
				if($contact_id){
					//$password = $this->Common_model->decryptIt($user_record,TRUE);
					//$email_arr = array("password"=>$password,"email"=>$array['email'],"name"=>$array['first_name']);
					//$result = $this->Emailtemplates_model->sendEmail('verification',$email_arr);
					$arr['success'] = true;
					$arr['message']	= 'Registerd successfully.';
				}else{
					$arr['success'] = false;
					$arr['message']	= 'Email is wrong.';
				}
			//}
		}else{
			$arr['success'] = false;
			$arr['error'] = validation_errors();
		}

		echo json_encode($arr);
	}
	public function login(){
		$rules = array(
           array(
                 'field'   => 'email',
                 'label'   => 'Email',
                 'rules'   => 'required|valid_email'
              )
        );
		$this->form_validation->set_rules($rules);
		$output = array();
		if ($this->form_validation->run()) {
			$output = array();
			$email = $_POST['email'];
			$password = $_POST['password'];
	 		//$password = $this->Common_model->encryptIt($pas,TRUE);
			$data = $this->Users_model->login($email, $password);

			if($data){
				$fav 						= $this->Favourites_model->getAllFavourites($data['id']);
				$this->session->set_userdata(array("user_id"=>$data['id'],'type'=>$data['plan_duration'],'fav'=>count($fav), 'is_premium' => $data['is_premium']));
				$output['success'] = true;
				$output['is_premium'] = $data['is_premium'];	
				$output['message'] = 'Logging in. Please wait...';
			}
			else{
				$output['success'] = false;
				$output['message'] = 'Incorrect Email or Password.';
			}
		}else{
			$output['success'] = false;
			$output['message'] = validation_errors();
		}
	 
		echo json_encode($output); 
	}

	public function payment(){
		if($this->session->userdata('user_id')=='') {
			redirect(base_url().'home');
		}
		$user = $this->Users_model->getRow($this->session->userdata('user_id'));
		$this->data['customer_id'] = $this->Users_model->getUserStripCustomerID($this->session->userdata('user_id'));
		$this->data['user'] 		=  $user;
		$this->data['tab_title'] 		=  $this->tab_title.' | Payment ';
		$this->data['plansChechout']    = $this->Plans_model->getAllplansByPlanId($user['plan_id']);
		$this->data['plans']    = $this->Plans_model->getAllplansByPlanId($user['plan_id']);
		$this->data['page_title'] 		=  'Payment';
		$this->data['msg'] = $this->session->flashdata('message');

 		$this->load->view('payment',$this->data);
	}
	//Array ( [customerId] => cus_J3QQScO4y3xbaP [paymentMethodId] => pm_1IRdRIBs2CQ90tyBaQZytIJH [priceId] => PLAN_J3KHD9XECFOEQ5 )

	public function stripePayment(){
		$post =  json_decode(file_get_contents('php://input'), true);
		$id = $this->session->userdata('user_id');
		$user = $this->Users_model->getRow($id);
		$plans    = $this->Plans_model->getAllplansByPlanId($post['priceId']);
		try {
		    $payment_method = \Stripe\PaymentMethod::retrieve(
		      $post['paymentMethodId']
		    );
		    $payment_method->attach([
		      'customer' => $post['customerId'],
		    ]);
		  } catch (Exception $e) {
		    //$array = $e->getJsonBody();
		    //return $response->withJson($e->jsonBody);
		  	 echo json_encode($e->jsonBody);
		  	 //$this->data['error'] = $result['message'];
            //	redirect('user/payment');
		  }


		  // Set the default payment method on the customer
		  \Stripe\Customer::update($post['customerId'], [
		    'invoice_settings' => [
		      'default_payment_method' => $post['paymentMethodId']
		    ]
		  ]);

		try {
		  // Create the subscription
		  $result = \Stripe\Subscription::create([
		    'customer' => $post['customerId'],
		    'items' => [
		      [
		        'price' => $post['priceId'],
		      ],
		    ],
		    'trial_period_days' => $plans['trial_period'],
		    'expand' => ['latest_invoice.payment_intent'],
		  ]);

		  if(is_object($result)) {
		  	if($plans['trial_period'] > 0){
		  		$days = '+'.$plans['trial_period'].' days';
		  		$next_recharge_date = date('Y-m-d', strtotime($days));	
		  	}else{
		  		$next_recharge_date = next_recharge_date($plans['heading']);
		  	}

             //next_recharge_date($user['plan_duration']);
            $array_payment_log = array(
                "user_id"                       => $id,
                "plan_id"                       => $user['plan_id'],
                "merchant_response"             => json_encode($result),
                "charge_date"                   => date("Y-m-d"),
                'subscription_id'               => $result->id,
                'amount'                        => $user['plan_price']
            );

            $insert = array(
                'user_id'                       => $id,
                'plan_name'                     => $user['plan_heading'],
                'date'                          => date('Y-m-d'),
                'next_recharge_date'            => $next_recharge_date,
                'plan_id'                       => $user['plan_id'],
                'subscription_id'               => $result->id,
                'amount'                        => $user['plan_price']
            );
            $this->session->set_userdata('is_premium', 1);
            $this->Users_model->insertpaymentLogs($array_payment_log);
            $this->Users_model->insertChannelSubscriptionDetail($insert);
            $this->Users_model->updateUserDetail($id,array('is_premium'=>1));
        	echo json_encode($result);
        	//redirect('home/thankyou');
        }
		}catch(Exception $e){
			echo json_encode($e->jsonBody);	
		}

		/*if($this->input->post()) {
			$id = $this->session->userdata('user_id');
            $result = $this->_subscribe_customer($id);
            if($result['success']==true){
                $this->data['success'] = $result['message'];
                redirect('home/thankyou');
            }else{
                $this->data['error'] = $result['message'];
                redirect('user/payment');
            }
        }*/
	}

	public function upgradePlan(){
		$post =  json_decode(file_get_contents('php://input'), true);
		$id = $this->session->userdata('user_id');
		$user = $this->Users_model->getRow($id);
		$plans    = $this->Plans_model->getAllplansByPlanId($post['priceId']);
		$subscription_id =  $this->Users_model->getSubscriptionDetailByUserId($id);
		try {
		    $payment_method = \Stripe\PaymentMethod::retrieve(
		      $post['paymentMethodId']
		    );
		    $payment_method->attach([
		      'customer' => $post['customerId'],
		    ]);
		  } catch (Exception $e) {
		  	 echo json_encode($e->jsonBody);
		  }


		  // Set the default payment method on the customer
		  \Stripe\Customer::update($post['customerId'], [
		    'invoice_settings' => [
		      'default_payment_method' => $post['paymentMethodId']
		    ]
		  ]);

		  	$sub = \Stripe\Subscription::retrieve($subscription_id);
            $sub->cancel();

		try {
		  // Create the subscription
			$result = \Stripe\Subscription::create([
		    'customer' => $post['customerId'],
		    'items' => [
		      [
		        'price' => $post['priceId'],
		      ],
		    ],
		    'expand' => ['latest_invoice.payment_intent'],
		  ]);

			if(is_object($result)) {
	            $next_recharge_date = next_recharge_date($plans['heading']);
	            $array_payment_log = array(
	                "user_id"                       => $id,
	                "plan_id"                       => $post['priceId'],
	                "merchant_response"             => json_encode($result),
	                "charge_date"                   => date("Y-m-d"),
	                'subscription_id'               => $result->id,
	                'amount'                        => $plans['price']
	            );

	            $insert = array(
	                'user_id'                       => $id,
	                'plan_name'                     => $plans['title'],
	                'date'                          => date('Y-m-d'),
	                'next_recharge_date'            => $next_recharge_date,
	                'plan_id'                       => $post['priceId'],
	                'subscription_id'               => $result->id,
	                'amount'                        => $plans['price']
	            );

	            $userDetails = array(
	            	'plan_id'                    => $post['priceId'],
	                'plan_heading'               => $plans['title'],
	                'plan_price'                 => $plans['price'],
	                'plan_duration'            	 => $plans['heading'],
	                'is_premium'                 => 1
	            );

	            $this->Users_model->insertpaymentLogs($array_payment_log);
	            $this->Users_model->insertChannelSubscriptionDetail($insert);
	            $this->Users_model->updateUserDetail($id,$userDetails);
	        	echo json_encode($result);
	        	//redirect('home/thankyou');
	        }
		}catch(Exception $e){
			echo json_encode($e->jsonBody);	
		}
	}

	public function cancelSubscription(){
		$id = $this->session->userdata('user_id');
		$user = $this->Users_model->getRow($id);
		$subscription_id =  $this->Users_model->getSubscriptionDetailByUserId($id);
		  // Set the default payment method on the customer
	  	$sub = \Stripe\Subscription::retrieve($subscription_id);
        $sub->cancel();
        $userDetails = array(
            'is_premium'                 => 0
        );

	    $this->Users_model->updateUserDetail($id,$userDetails);
	    
	    $arr['success'] = true;
		$arr['message']	= 'Subscription cancelled successfully!';
	    
	    echo json_encode($arr);
	}


	public function renewSubscription(){
        // Retrieve the request's body and parse it as JSON
        $payload = \file_get_contents("php://input");
        $payload = json_decode($payload);
    
        //$this->db->insert("data_logs",array("data"=>json_encode($payload)));
        $sig_header = $_SERVER["HTTP_STRIPE_SIGNATURE"];

        $event = null;
        
       $endpoint_secret = "whsec_fTUGlyFGWCksjdBMBSRarWFGmCNSdqBb";
        
        try {
            //$event = \Stripe\Webhook::constructEvent($payload, $sig_header, $endpoint_secret); 
            //$event = $stripe->events()->find(str_replace("&#039;", "", $payload->id));
            //print_r($event);
            //die();
            //if (isset($event) && $event->type == "invoice.payment_failed") {
            if(isset($payload) && $payload->type== "invoice.payment_failed"){
                $subscription_id = $payload->data->object->subscription;
                $id = $this->Users_model->getUserIdBySubsctiptionId($subscription_id);
                $user = $this->Users_model->getRow($id);
				$this->Users_model->updateUserDetail($id,array('is_premium'=>0));

				if($user['plan_duration'] == "weekly"){
	            	$this->Users_model->deleteSelectedvideos($id);
	            }
                /*$order = $this->order->where('id_sale', $subscription_id)->first();
                User::where('id', $order->user_id)->update([
                    'is_premium' => 0,
                ]);

                $subscription = $this->subscription->where('user_id', $order->user_id)->first();
                $status = $stripe->subscriptions()->cancel($subscription->customer_id, $subscription->subscription_id);
                $cancelCard = CreditCards::where('user_id', $order->user_id)->delete();
                
                $subscription->update([
                    'is_cancelled' => 1,
                    "is_premium"  => 0
                ]);*/
                    
            }else if(isset($payload) && $payload->type == "invoice.payment_succeeded"){
                $subscription_id = $payload->data->object->subscription;
                $id = $this->Users_model->getUserIdBySubsctiptionId($subscription_id);
                $user = $this->Users_model->getRow($id);
                $next_recharge_date = next_recharge_date($user['plan_duration']);
            	$array_payment_log = array(
	                "user_id"                       => $id,
	                "plan_id"                       => $user['plan_id'],
	                "merchant_response"             => json_encode($payload),
	                "charge_date"                   => date("Y-m-d"),
	                'subscription_id'               => $subscription_id,
	                'amount'                        => $user['plan_price']
	            );

	            $insert = array(
	                'user_id'                       => $id,
	                'plan_name'                     => $user['plan_heading'],
	                'date'                          => date('Y-m-d'),
	                'next_recharge_date'            => $next_recharge_date,
	                'plan_id'                       => $user['plan_id'],
	                'subscription_id'               => $subscription_id,
	                'amount'                        => $user['plan_price']
	            );
	            if($user['plan_duration'] == "weekly"){
	            	$this->Users_model->deleteSelectedvideos($id);
	            }	
	            $this->Users_model->insertpaymentLogs($array_payment_log);
	            $this->Users_model->insertChannelSubscriptionDetail($insert);
	            $this->Users_model->updateUserDetail($id,array('is_premium'=>1));

                //$subscription_duration = $this->config->getByName('subscription_duration');
                /*$order = $this->order->where('id_sale', $subscription_id)->first();
                User::where('id', $order->user_id)->update([
                        'is_premium' => 1,
                        'premium_start_date' => Carbon::now(),
                        'premium_end_date' => Carbon::now()->addDays($subscription_duration->value)
                    ]);
                
                    $order->update(['status' => 'success', 'expiry_date' => Carbon::now()->addDays($subscription_duration->value)]);

                $subscription = $this->subscription->where('user_id', $order->user_id)->first();
                
                $subscription->update([
                    'is_cancelled' => 0,
                    'start_date' => Carbon::now(),
                    'end_date' => Carbon::now()->addDays($subscription_duration->value),
                    'plan_name' => 'Your next billing date at 
                    '.Carbon::now()->addDays($subscription_duration->value)->toDateString()
                ]);*/   
            }
        }catch(\Cartalyst\Stripe\Exception\UnexpectedValueException $e) {
            // Invalid payload
            print_r($e);
            http_response_code(400); // PHP 5.4 or greater
            exit();
        }

                
    }

	private function _subscribe_customer($id){
		$user = $this->Users_model->getRow($id);
        $stripe_token  = $this->input->post('stripeToken');
        $customer_id = "";
        $stripe_plan_id = $user['plan_id'];
        $result = "";
        $arr = "";
		$customer_id = $this->Users_model->getUserStripCustomerID($id);
        if($customer_id==''){
            try {
                $customer = \Stripe\Customer::create(array(
                    'email' => $this->input->post('stripeEmail'),
                    'source'  => $stripe_token
                ));
                $customer_id = $customer->id;
                $customer_array = array("user_id"=>$id,"stripe_customer_id"=>$customer_id);
                $this->Users_model->addUserStripCustomer($customer_array);
            }catch (Exception $e) {
                $array = $e->getJsonBody();
                $arr = array("success"=>false,"message"=>$array['error']['message']);
				return $arr;
            }
        }   
        try {
            $result = \Stripe\Subscription::create(array(
              	"customer"    => $customer_id,
              	'items' => [
				    ['price' => $user['plan_id']],
				],
				'trial_period_days' => 2				
            ));

            
        }catch (Exception $e) {
            $array = $e->getJsonBody();
            $arr = array("success"=>false,"message"=>$array['error']['message']);
			return $arr;
        }

        if (is_object($result)) {
            $next_recharge_date = next_recharge_date($user['plan_duration']);
            $array_payment_log = array(
                "user_id"                       => $id,
                "plan_id"                       => $user['plan_id'],
                "merchant_response"             => json_encode($result),
                "charge_date"                   => date("Y-m-d"),
                'subscription_id'               => $result->id,
                'amount'                        => $user['plan_price']
            );

            $insert = array(
                'user_id'                       => $id,
                'plan_name'                     => $user['plan_heading'],
                'date'                          => date('Y-m-d'),
                'next_recharge_date'            => $next_recharge_date,
                'plan_id'                       => $user['plan_id'],
                'subscription_id'               => $result->id,
                'amount'                        => $user['plan_price']
            );
            $this->Users_model->insertpaymentLogs($array_payment_log);
            $this->Users_model->insertChannelSubscriptionDetail($insert);
            $this->Users_model->updateUserDetail($id,array('is_premium'=>1));
        
            $arr = array("success"=>true,"message"=>"Subscribed Successfully");
        }else{
            $arr = array("success"=>false,"message"=>$result->message);
        }
        return $arr;
    }

	public function myOrders(){
		$this->data['page_title'] = 'Booking';
		$language = $this->Common_model->get_language_name();
		$id=$this->session->userdata('user_id');
		$data['users'] = $this->Users_model->getRoworders($this->session->userdata("user_id"));
    
        if ($this->session->userdata("user_id")!=0) {
        	$this->data['order_row'] = $this->Users_model->getOrders_byemail($data['users']['email']);
        }else{
        	$this->data['order_row'] = array();
        }
		$this->load->view('myorders',$this->data);
	}
	public function myWhislist(){
		$this->data['page_title'] = 'Whislist';
		$this->data['msg'] = ($this->input->get("msg")!='') ? $this->input->get("msg"): "";
		$language = $this->Common_model->get_language_name();
		$id=$this->session->userdata('user_id');
		/*$data['users'] = $this->Users_model->getRow($this->session->userdata("user_id"));*/

		$this->data['order_row'] = $this->Users_model->getmywhislists($id);


		$this->load->view('whislists',$this->data);
	}
	public function delete($id){
		$this->Users_model->deletewhislist($id);
		redirect('User/myWhislist/?msg=Deleted Successfully');
	}

	public function myAccount($slug){
		$this->data['tab_title'] = $this->tab_title.' | Update';
		$this->data['page_title'] = 'Update';
		$this->data['customer_id'] = $this->Users_model->getUserStripCustomerID($this->session->userdata('user_id'));

		$this->data['msg'] = ($this->input->get("msg")!='') ? $this->input->get("msg"): "";
		if ($this->input->post()) {
			$rules = array(
               array(
                     'field'   => 'f_name',
                     'label'   => 'Fisrt name',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'l_name',
                     'label'   => 'Last Name',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'email',
                     'label'   => 'Email',
                     'rules'   => 'required|valid_email'
                  ),
                array(
                     'field'   => 'password',
                     'label'   => 'Password',
                     'rules'   => 'required'
                  ),
                array(
                     'field'   => 'card_number',
                     'label'   => 'Card Number',
                     'rules'   => 'required'
                  ),
                array(
                     'field'   => 'expiry_date',
                     'label'   => 'Expiry Date',
                     'rules'   => 'required'
                  ),
                array(
                     'field'   => 'debit_securityCode',
                     'label'   => 'CVC',
                     'rules'   => 'required'
                  )
            );  
			
         
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {

				$array = array(
					"first_name"		  	 	=> $this->input->post('first_name'),
					"last_name"  		 		=> $this->input->post('last_name'),
					"contact_num"  		 		=> $this->input->post('contact'),
					"country"	  		 	=> $this->input->post('country'),
					"city"	  		 	=> $this->input->post('city'),
					"date_created"  		=> date('Y-m-d H:i:s',time())
				);

				if($this->input->post('new_password') !=""){
					$password=$this->Common_model->encryptIt($this->input->post('new_password'),TRUE);
               		$array['raw_password'] = $this->input->post('new_password');
               		$array['password'] = $password;
				} 
				$contact_id = $this->Users_model->updateUserDetail($this->session->userdata("user_id"),$array);
				$data['msg'] = "Updated successfully";
			}else{
				$this->data['contactDetail'] = $_REQUEST;
				$this->data['error'] = validation_errors();
				$this->data['user_row'] = $_POST;
			}
		}
		$this->data['users']= $this->Users_model->getRow($this->session->userdata("user_id"));
		$this->data['type'] = $slug;
		$this->data['plansChechout']    = $this->Plans_model->getAllplansChechout($slug);
		
		$this->load->view('myaccount',$this->data);

	}

	public function address(){
		$this->data['page_title'] = 'Address';
		$language = $this->Common_model->get_language_name();
		$this->data['msg'] = ($this->input->get("msg")!='') ? $this->input->get("msg"): "";
		if ($this->input->post()) {
			$rules = array(
               array(
                     'field'   => 'address',
                     'label'   => 'Address',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'city',
                     'label'   => 'City',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'state',
                     'label'   => 'State',
                     'rules'   => 'required'
                  ), array(
                     'field'   => 'country',
                     'label'   => 'Country',
                     'rules'   => 'required'
                  ),
            );  
         
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$array = array(
					"address"		  	 	=> $this->input->post('address'),
					"city"  		 		=> $this->input->post('city'),
					"state"  		 		=> $this->input->post('state'),
					"country"	  		 	=> $this->input->post('country')
				);

				$contact_id = $this->Users_model->updateUserDetail($this->session->userdata("user_id"),$array);
				$this->data['msg'] = "Updated successfully";
			}else{
				$this->data['contactDetail'] = $_REQUEST;
				$this->data['error'] = validation_errors();
				$this->data['user_row'] = $_POST;
			}
		}
		$this->data['user'] = $this->Users_model->getRow($this->session->userdata("user_id"));
		
		$this->load->view('address',$this->data);

	}

	public function logout(){
		
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('type');
		$this->session->unset_userdata('is_premium');
		redirect(base_url());
	}
    public function forgetPassword(){
	
		$data	=	array();
		if($this->input->post())
		{
			$rules = array(
               array(
                     'field'   => 'email',
                     'label'   => 'Email',
                     'rules'   => 'required|valid_email'
                  )
            );

			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run())
			{
				$email 		= $this->input->post('email');

				$user_row = $this->Users_model->checkEmailExist($this->input->post('email'));
				if ($user_row) {
					$user_record	=	$this->Users_model->getUserPassword($email);
					

					if($user_record){
						$password=$user_record->password;
						$message = 'Your Password is '. $password;
						//mail($email,'Forget Password',$message);
						$email_arr = array("password"=>$password,"email"=>$email);
						$result = $this->Emailtemplates_model->sendEmail('forgotpassword',$email_arr);
						$data['success'] = true;
						$data['msg']	= 'Password Successfully sent to your Email.';
					}else{
						$data['success'] = false;
						$data['error']	= 'Email is wrong.';
					}
				}else{
					$data['success'] = false;
					$data['error']	= 'We didnot Find your Email! Please register First!!';
				}
			}else{
				$data['success'] = false;
				$data['error']	= validation_errors();
			}
		}else{
			$data['success'] = false;
			//$data['msg']	= "Invalid Request";
		}
		echo json_encode($data);
		//$data['page_title'] = 'Forget Password';
        //$this->load->view('forget_password',$data);
		
	}

	public function dashboard(){
		$this->data['page_title'] = "My Account";
		$this->data['user']= $this->Users_model->getUserDataById($this->session->userdata("user_id"));
		$this->data['orders']= $this->Order_model->getOrderDetailsById($this->session->userdata("user_id"));
		
		if (!empty($this->session->flashdata('form_data'))) {
        	$data['form_data'] = $this->session->flashdata('form_data');
      	}
      	if(!empty($this->session->flashdata('error'))) {
        	$data['error'] = $this->session->flashdata('error');
      	}
      	if(!empty($this->session->flashdata('msg'))) {
        	$data['msg'] = $this->session->flashdata('msg');
      	}
		$this->load->view('dashboard',$data);
	}

	public function personal_details(){
		if ($this->input->post()) {
			$rules = array(
               array(
                     'field'   => 'first_name',
                     'label'   => 'Fisrt name',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'last_name',
                     'label'   => 'Last Name',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'contact_num',
                     'label'   => 'Contact Num',
                     'rules'   => 'required'
                ),
               array(
                     'field'   => 'email',
                     'label'   => 'Email',
                     'rules'   => 'required|valid_email'
                )

            );
         
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$array = array(
					"first_name"		  	 	=> $this->input->post('first_name'),
					"last_name"  		 		=> $this->input->post('last_name'),
					"contact_num"  		 		=> $this->input->post('contact_num'),
					"email"  		 		=> $this->input->post('email'),
					"city"	  		 	=> $this->input->post('city'),
					"address" => $this->input->post('address'),
					"house_num"  => $this->input->post('house_num'),
					"post_code"  => $this->input->post('post_code')
				);
				$contact_id = $this->Users_model->updateUserDetail( $this->session->userdata("user_id"),$array);
				$this->session->set_flashdata('msg', "Updated successfully");
				redirect('User/dashboard');
			}else{
				$this->session->set_flashdata('error', validation_errors());
				$this->session->set_flashdata('form_data', $_REQUEST);
				redirect('User/dashboard');
			}
		}
		$this->session->set_flashdata('error', "Invalid Request!");
		redirect('User/dashboard');
	}
	public function change_passwordview(){
		
		$this->data['page_title'] = 'Change Password';
		
		$this->data['msg'] = ($this->input->get("msg")!='') ? $this->input->get("msg"): "";
		if ($this->input->post()) {
			$rules = array(
               array(
                     'field'   => 'address',
                     'label'   => 'Address',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'city',
                     'label'   => 'City',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'state',
                     'label'   => 'State',
                     'rules'   => 'required'
                  ), array(
                     'field'   => 'country',
                     'label'   => 'Country',
                     'rules'   => 'required'
                  ),
            );  
         
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$array = array(
					"address"		  	 	=> $this->input->post('address'),
					"city"  		 		=> $this->input->post('city'),
					"state"  		 		=> $this->input->post('state'),
					"country"	  		 	=> $this->input->post('country')
				);

				$contact_id = $this->Users_model->updateUserDetail($this->session->userdata("user_id"),$array);
				$this->data['msg'] = "Updated successfully";
			}else{
				$this->data['contactDetail'] = $_REQUEST;
				$this->data['error'] = validation_errors();
				$this->data['user_row'] = $_POST;
			}
		}
		$this->data['user'] = $this->Users_model->getRow($this->session->userdata("user_id"));
		
		$this->load->view('change_password',$this->data);
	}

	public function change_password(){
		$this->data['tab_title'] 	=  $this->tab_title.' | Change Password';
		$this->data['page_title'] 	=  'Change Password';
		if ($this->input->post()) {

			$rules = array(

               	array(

                     'field'   => 'new_password',

                     'label'   => 'New Password',

                     'rules'   => 'required'

                ),

               	array(

                     'field'   => 'confirm_password',

                     'label'   => 'Confirm Password',

                     'rules'   => 'required|matches[new_password]'

                )

            );

         

			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run()) {

				$password = $this->input->post('new_password');

           		$array = array(


           			"password" => $password

           		);

				

				$contact_id = $this->Users_model->updateUserDetail($this->session->userdata("user_id"),$array);

				$this->session->set_flashdata('msg', "Password Changed successfully!");

				redirect(base_url().'user/change_password?msg=Updated Successfully!');

			}else{

				$this->session->set_flashdata('error', validation_errors());

				$this->session->set_flashdata('form_data', $_REQUEST);

				$this->data['contactDetail'] = $_REQUEST;
				$this->data['error'] = validation_errors();
				

			}

		}


		
$this->data['msg'] = ($this->input->get("msg")!='') ? $this->input->get("msg"): "";
		$this->load->view('change_password',$this->data);
	}
	public function showDetail($user_id){

		$data['orders'] = $this->Contactqueries_model->getAllOrdersdetail($user_id);
		$data['order'] = $this->Contactqueries_model->getAllDetail($user_id);

         
		$data['page_title'] = 'Orders';
		$data['page_heading'] = 'Products Detail';
		$this->load->view('detail_order',$data);
	}
     
}
