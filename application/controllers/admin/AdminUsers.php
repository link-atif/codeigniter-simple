<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminUsers extends CI_Controller
{
	function __construct() {

        parent::__construct();
		$this->load->model('Admin_model');
		$this->load->model('Common_model');
		$this->load->model('Preferences_model');
		if(!$this->session->userdata('admin_id')) {
			redirect(base_url().'admin/login');
		}
		$this->Admin_model->checkAdminUserISAdmin();
    }
    
	public function index() {
		$data['admin_users']  = $this->Admin_model->getAllAdminUsers();
		$data['page_title']   = 'Admin Users';
		$data['page_heading'] = 'Admin Users';
		
		$data['msg'] = $this->input->get('msg') ? $this->input->get('msg') : '';
		
		$this->load->view('admin/admin_users',$data);
	}

	public function addAdmin() {
		
		$data['page_title'] = 'Add Admin User';
		$data['page_heading'] = 'Add Admin User';
		
		if($this->input->post()) {
			$rules = array(
			    array(
                	'field'   => 'full_name',
                 	'label'   => 'Full Name',
                 	'rules'   => 'trim|required'
              	),
              	array(
                     'field'   => 'email',
                     'label'   => 'Email',
                     'rules'   => 'trim|required|valid_email'
                ),
               	array(
                     'field'   => 'username',
                     'label'   => 'Username',
                     'rules'   => 'trim|required'
                ),
               	array(
                     'field'   => 'password',
                     'label'   => 'Password',
                     'rules'   => 'trim|required'
                )
            );

			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run()) {
				$array = array(
							"full_name"  => $this->input->post('full_name'),
							"email"      => $this->input->post('email'),
							"username"   => $this->input->post('username'),
							"password"   => $this->input->post('password'),
							"created_on" => date("Y-m-d H:i:s")
						 );
				if($this->Admin_model->checkEmail($this->input->post('email'))) {
					$data['error'] 			= "Email allready exists";
					$data['userDetail'] = $_REQUEST;
				}else if($this->Admin_model->checkUsername($this->input->post('username'))){
					$data['error'] 			= "Username allready exists";
					$data['userDetail'] = $_REQUEST;
				}else {

					$user_record			=	$this->Admin_model->save($array);
					if($user_record) {
						redirect(base_url().'admin/adminUsers?msg=Added Successfully');
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
		$this->load->view('admin/add_admin',$data);
	}

	public function editAdmin() {
		if($this->input->get('id')) {
			$id 				  = $this->input->get('id');
			$data['page_title']   = 'Edit Admin User';
			$data['page_heading'] = 'Edit Admin User';
		}else {
			redirect(base_url()."admin/adminUsers?msg=Invalid user");
		}
		$userRow                 = $this->Admin_model->getRow($this->input->get('id'));
		if($userRow) {
			//$userRow['password'] //= $this->Common_model->decryptIt($userRow['password']);
			$data['userDetail']  = $userRow['password'];
		}else {
			redirect(base_url()."admin/adminUsers?msg=Invalid user");
		}

		if($this->input->post()) {
			$rules = array(
			    array(
                	'field'   => 'full_name',
                 	'label'   => 'Full Name',
                 	'rules'   => 'trim|required'
              	),
              	array(
                     'field'   => 'email',
                     'label'   => 'Email',
                     'rules'   => 'trim|required|valid_email'
                ),
               	array(
                     'field'   => 'username',
                     'label'   => 'Username',
                     'rules'   => 'trim|required'
                ),
               	array(
                     'field'   => 'password',
                     'label'   => 'Password',
                     'rules'   => 'trim|required'
                )
            );

			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run()) {
				$array = array(
							"full_name"  => $this->input->post('full_name'),
							"email"      => $this->input->post('email'),
							"username"   => $this->input->post('username'),
							"password"   => $this->Common_model->encryptIt($this->input->post('password')),
						 );
				if($this->Admin_model->checkEmail($this->input->post('email'),$this->input->post('id'))) {
					$data['error'] 			= "Email allready exists";
					$data['userDetail'] = $_REQUEST;
				}else if($this->Admin_model->checkUsername($this->input->post('username'),$this->input->post('id'))){
					$data['error'] 			= "Username allready exists";
					$data['userDetail'] = $_REQUEST;
				}else {
					$user_record	=	$this->Admin_model->update($array,$this->input->post('id'));
					if($user_record) {
						redirect(base_url().'admin/adminUsers?msg=Updated Successfully');
					}else {
						$data['error']	    = 'Some Error try later';
						$data['userDetail'] = $_REQUEST;
					}
				}
			}else{
				$data['userDetail'] = $_REQUEST;
			}
		}

		$this->load->view('admin/edit_admin',$data);
	}


	public function editProfile() {
		
		$id 				  = $this->session->userdata('admin_id');
		$data['page_title']   = 'Edit Profile';
		$data['page_heading'] = 'Edit Profile';
		
		$userRow              = $this->Admin_model->getRow($this->session->userdata('admin_id'));
		$data['userDetail']   = $userRow;  
		if($this->input->post()) {
			$rules = array(
			    array(
                	'field'   => 'full_name',
                 	'label'   => 'Full Name',
                 	'rules'   => 'trim|required'
              	),
              	array(
                     'field'   => 'email',
                     'label'   => 'Email',
                     'rules'   => 'trim|required|valid_email'
                ),
               	array(
                     'field'   => 'username',
                     'label'   => 'Username',
                     'rules'   => 'trim|required'
                )
            );

			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$array = array(
							"full_name"  => $this->input->post('full_name'),
							"email"      => $this->input->post('email'),
							"username"   => $this->input->post('username'),
						 );
				if($this->Admin_model->checkEmail($this->input->post('email'),$this->session->userdata('admin_id'))) {
					$data['error'] 			= "Email allready exists";
					$data['userDetail'] = $_REQUEST;
				}else if($this->Admin_model->checkUsername($this->input->post('username'),$this->session->userdata('admin_id'))){
					$data['error'] 			= "Username allready exists";
					$data['userDetail'] = $_REQUEST;
				}else {
					$user_record	=	$this->Admin_model->update($array,$this->session->userdata('admin_id'));
					if($user_record) {
						$login_data['email']		=	$this->input->post('email');
						$login_data['full_name']	=	$this->input->post('full_name');
						$this->session->set_userdata($login_data);
						redirect(base_url().'admin/adminUsers/Profile?msg=Updated Successfully');
					}else{
						$data['error']	    = 'Some Error try later';
						$data['userDetail'] = $_REQUEST;
					}
				}
			}else{
				$data['userDetail'] = $_REQUEST;
			}
		}

		$this->load->view('admin/edit_my_profile',$data);
	}

	public function changePassword() {

		if($this->input->post()) {
			$rules = array(
			  array(
                     'field'   => 'old_password', 
                     'label'   => 'Old Password', 
                     'rules'   => 'trim|required'
                  ),
              array(
                     'field'   => 'password', 
                     'label'   => 'Password', 
                     'rules'   => 'trim|required|matches[confirm_password]'
                  ),
               array(
                     'field'   => 'confirm_password', 
                     'label'   => 'Confirm password', 
                     'rules'   => 'trim|required'
                  )
            );

			$this->form_validation->set_rules($rules);
		
			if ($this->form_validation->run()) {
				$user_record    =   $this->Admin_model->getRow($this->session->userdata('admin_id'));

				if($this->Common_model->decryptIt($user_record['password']) == $this->input->post('old_password')) {
					$update_data['password'] =	$this->Common_model->encryptIt($this->input->post('password',TRUE));
					$this->Admin_model->update($update_data,$this->session->userdata('admin_id'));
					$data['success']	     =	 'Password changed successfully.';
				}
				else {
					$data['error']	         =	'Old password is wrong.';
				}
			}else{
				$data['userDetail'] = $_REQUEST;
			}
		}

		$data['page_title'] = 'Change Password';
		$data['page_heading'] = 'Change Password';
		$this->load->view('admin/change_password',$data);
	}

	public function Profile() {
		$userRow              = $this->Admin_model->getRow($this->session->userdata('admin_id'));
		//$userRow['password']  = $this->Common_model->decryptIt($userRow['password']);
		$data['userDetail']   = $userRow;
		$data['page_title']   = 'My Profile';
		$data['page_heading'] = 'My Profile';
		$this->load->view('admin/my_profile',$data);
	}
	public function delete($id) {
		$data['admin_users'] = $this->Admin_model->delete_admin($id);
		redirect(base_url().'admin/adminUsers?msg=Admin Deleted Successfully');
	}
	
}
