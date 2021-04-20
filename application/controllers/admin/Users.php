<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller
{
	function __construct() {

        parent::__construct();
		
		$this->load->model('Common_model');
		$this->load->model('Pages_model');
		$this->load->model('Admin_model');
		$this->load->model('Preferences_model');
		$this->load->model('Users_model');
		$this->load->model('Emailtemplates_model');
		$this->load->library("pagination");
		if(!$this->session->userdata('admin_id')) {
			redirect('admin/login');
		}
		$this->Admin_model->checkAdminUserISAdmin();
    }
    
	public function index() {
		/*
		$arr 		           = array();
        $arr['name']           = $this->input->get('name') ? $this->input->get('name') : '';
		$arr['portalUsers']	   = $this->input->get('portalUsers') ? $this->input->get('portalUsers') : 'no';*/
		$config 			   = array();
        $config["base_url"]    = base_url() . "admin/Users";
        $config["total_rows"]  = $this->Users_model->countUserTotal();
        $config["per_page"]    = 10;
        $config["uri_segment"] = 3;
		$config['reuse_query_string'] = TRUE;

        $this->pagination->initialize($config);

        $page 		           = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$data['users']         = $this->Users_model->getAllUsers($page,$config["per_page"]);
		$data["links"]         = $this->pagination->create_links();
		$data['page_title']    = 'Users';
		$data['page_heading']  = 'Users';
		
		$data['msg'] = $this->input->get('msg') ? $this->input->get('msg') : '';
		$this->load->view('admin/users',$data);
	}

	public function detail(){

		$data['userRow']       = $this->Users_model->getUserDetail($this->input->get('id'));
		
		//$data['userPackageRow']= $this->Packages_model->getRow($data['userRow']['package_id']);
		//$totalPayment 		   = $this->Users_model->countPaymentsByUserID($id);
		//$data['payments']      = $this->Users_model->getAllPaymentsByUserID($id,0,$totalPayment);
		$data['page_title']    = 'User Detail';
		$data['page_heading']  = 'User Detail';
		
		$data['msg'] = $this->input->get('msg') ? $this->input->get('msg') : '';
		$this->load->view('admin/user_detail',$data);
	}

	/*public function addUser() {
		$data['page_title']   = 'Add Application User';
		$data['page_heading'] = 'Add Application User';
		
		if($this->input->post()) {
			$rules = array(
			    array(
                	'field'   => 'firstname',
                 	'label'   => 'First Name',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'lastname',
                 	'label'   => 'Last Name',
                 	'rules'   => 'trim|required'
              	),
              	array(
                     'field'   => 'email',
                     'label'   => 'Email',
                     'rules'   => 'trim|required|valid_email'
                ),
               	array(
                     'field'   => 'password',
                     'label'   => 'Password',
                     'rules'   => 'trim|required'
                ),
                array(
                     'field'   => 'password',
                     'label'   => 'Password',
                     'rules'   => 'trim|required'
                ),
            );

			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run()) {

				$state = $this->input->post('country')=='US' ? $this->input->post('state') : $this->input->post('state2');
				
				$array = array(
							"firstname"  	 	=> $this->input->post('firstname'),
							"lastname"  	 	=> $this->input->post('lastname'),
							"email"      	 	=> $this->input->post('email'),
							"password"       	=> $this->Common_model->encryptIt($this->input->post('password')),
							"address"   	 	=> $this->input->post('address'),
							"country"   	 	=> $this->input->post('country'),
							"city"   	 	 	=> $this->input->post('city'),
							"state"   		 	=> $state,
							"zipcode"   	 	=> $this->input->post('zipcode'),
							"phone"   	 	 	=> $this->input->post('phone'),
							"fax"   	 	 	=> $this->input->post('fax'),
							"created_date" 	 	=> date("Y-m-d H:i:s"),

						 );
				if($this->Users_model->checkEmail($this->input->post('email'))) {
					$data['error'] 			= "Email allready exists";
					$data['userDetail'] 	= $_REQUEST;
				}else {
					$user_record			=	$this->Users_model->save($array);
					if($user_record) {
						
						if($this->input->post('portal_user')=='yes'){
							$code = md5(time());
							$this->Users_model->update(array("code"=>$code),$user_record);
							$email_array	= array(
												"full_name" => $this->input->post('firstname')." ".$this->input->post('lastname'),
												"uemail"  	=> $this->input->post('email'),
												"password"  => $this->input->post('password'),
												"email"  	=> $this->input->post('email'),
												"link"	    => STOPSHOPSTORELINK."/User/verification/?code=".$code
											);
						
							$this->Emailtemplates_model->sendMail('register_portal_user_admin',$email_array);
						}
						redirect('admin/users?msg=Added Successfully');
					}else {
						$data['error']	    = 'Some Error try later';
						$data['userDetail'] = $_REQUEST;
					}
				}
			}else{
				$data['userDetail'] = $_REQUEST;
			}
		}else {
			$data['userDetail'] = array();
		}
		$this->load->view('admin/add_user',$data);
	}*/
	
	/*public function addPortalUser() {
		$data['page_title']   = 'Add Portal User';
		$data['page_heading'] = 'Add Portal User';
		
		if($this->input->post()) {
			$rules = array(
			    array(
                	'field'   => 'username',
                 	'label'   => 'Username',
                 	'rules'   => 'trim|required'
              	),
              	array(
                     'field'   => 'email',
                     'label'   => 'Email',
                     'rules'   => 'trim|required|valid_email'
                ),
               	array(
                     'field'   => 'password',
                     'label'   => 'Password',
                     'rules'   => 'trim|required'
                )
            );

			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run()) {

				$state = $this->input->post('country')=='US' ? $this->input->post('state') : $this->input->post('state2');
				
				$array = array(
							"username_tv"  	 	=> $this->input->post('username'),
							"password_tv"  	 	=> $this->input->post('password'),
							"email"      	 	=> $this->input->post('email'),
							"portal_user"		=> "yes",
							"status"			=> "active",
							"created_date" 	 	=> date("Y-m-d H:i:s"),

						 );
				if($this->Users_model->checkEmail($this->input->post('email'))) {
					$data['error'] 			= "Email allready exists";
					$data['userDetail'] 	= $_REQUEST;
				}else {
					$user_record			=	$this->Users_model->save($array);
					if($user_record) {						
						$code = md5(time());
						$this->Users_model->update(array("code"=>$code),$user_record);
						$email_array	= array(
											"username" => $this->input->post('username'),
											"password"  => $this->input->post('password'),
											"email"  	=> $this->input->post('email'),
											"click_here"	    => PORTALLINK."/User/verification/?code=".$code
										);
					
						$this->Emailtemplates_model->sendMail('portal_user',$email_array);
						redirect('admin/users?msg=Added Successfully');
					}else {
						$data['error']	    = 'Some Error try later';
						$data['userDetail'] = $_REQUEST;
					}
				}
			}else{
				$data['userDetail'] = $_REQUEST;
			}
		}else {
			$data['userDetail'] = array();
		}
		$this->load->view('admin/add_portal_user',$data);
	}*/

	/*public function editUser() {
		if($this->input->get('id')) {
			$id 				  = $this->input->get('id');
			$data['page_title']   = 'Edit User';
			$data['page_heading'] = 'Edit User';
		}else {
			redirect(base_url()."admin/users?msg=Invalid user");
		}
		
		$userRow                 = $this->Users_model->getRow($this->input->get('id'));
		if($userRow) {
			$userRow['password'] = $this->Common_model->decryptIt($userRow['password']);
			$data['userDetail']  = $userRow;
		}else {
			redirect(base_url()."admin/users?msg=Invalid user");
		}

		if($this->input->post()) {
			$rules = array(
			    array(
                	'field'   => 'firstname',
                 	'label'   => 'First Name',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'lastname',
                 	'label'   => 'Last Name',
                 	'rules'   => 'trim|required'
              	),
              	array(
                     'field'   => 'email',
                     'label'   => 'Email',
                     'rules'   => 'trim|required|valid_email'
                ),
               	array(
                     'field'   => 'password',
                     'label'   => 'Password',
                     'rules'   => 'trim|required'
                ),
                array(
                     'field'   => 'password',
                     'label'   => 'Password',
                     'rules'   => 'trim|required'
                ),
            );

			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run()) {
				
				$state = $this->input->post('country')=='US' ? $this->input->post('state') : $this->input->post('state2');
				
				$array = array(
							"firstname"  	 => $this->input->post('firstname'),
							"lastname"  	 => $this->input->post('lastname'),
							"email"      	 => $this->input->post('email'),
							"username"       => $this->input->post('username'),
							"password"       => $this->Common_model->encryptIt($this->input->post('password')),
							"address"   	 => $this->input->post('address'),
							"country"   	 => $this->input->post('country'),
							"city"   	 	 => $this->input->post('city'),
							"state"   		 => $state,
							"zipcode"   	 => $this->input->post('zipcode'),
							"company_name"   => $this->input->post('company_name'),
							"phone"   	 	 => $this->input->post('phone'),
							"fax"   	 	 => $this->input->post('fax'),
							"portal_user"    => $this->input->post('portal_user')
						 );
				if($this->Users_model->checkEmail($this->input->post('email'),$this->input->post('id'))) {
					$data['error'] 			= "Email allready exists";
					$data['userDetail'] = $_REQUEST;
				}else {
					$user_record	=	$this->Users_model->update($array,$this->input->post('id'));
					if($user_record) {
						redirect('admin/users?msg=Updated Successfully');
					}else {
						$data['error']	    = 'Some Error try later';
						$data['userDetail'] = $_REQUEST;
					}
				}
			}else{
				$data['userDetail'] = $_REQUEST;
			}
		}

		$this->load->view('admin/edit_user',$data);
	}*/

	public function delete($id) {
		$data['user'] = $this->Users_model->delete_user($id);
		redirect('admin/users?msg=Deleted Successfully');
	}
}
