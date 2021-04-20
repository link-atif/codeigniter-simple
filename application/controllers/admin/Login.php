<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
	function __construct()
    {
        parent::__construct();
		$this->load->model('Admin_model');
		$this->load->model('Common_model');
		$this->load->model('Emailtemplates_model');
		$this->load->model('Preferences_model');
    }
   
	public function index()
	{
		if($this->session->userdata('admin_id')!='') {
			redirect('admin/dashboard');
		}
		if($this->session->userdata('admin_id') && $this->session->userdata('temp_password_change_id') == '')
		{
			redirect('admin/dashboard');
		}
		$data	=	array();
		if($this->input->post())
		{
			$rules = array(
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

			if ($this->form_validation->run())
			{
				$password       =   ($this->input->post('password',TRUE));
				$user_record	=	$this->Admin_model->authenticate($this->input->post('username',TRUE),$password);
				if($user_record)
				{
					$login_data['admin_id']		=	$user_record->id;
					$login_data['email']		=	$user_record->email;
					$login_data['full_name']	=	$user_record->full_name;
					
					$this->session->set_userdata($login_data);
					$this->Admin_model->update(array('last_login' => date("Y-m-d H:i:s")),$user_record->id);
					redirect('admin/dashboard');
				}
				else
				{
					$data['error']	=	 'Username or password is wrong.';
				}
			}
		}
        
		$data['page_title'] = 'Login';
		$data['page_heading'] = 'Login';
		$this->load->view('admin/login',$data);
		
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('admin');
	}

	public function forgotPassword(){

		if($this->input->post())
		{
			$rules = array(
               array(
                     'field'   => 'email',
                     'label'   => 'Email',
                     'rules'   => 'trim|required|valid_email'
                )
            );

			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run())
			{

				
				$user_record	=	$this->Admin_model->getRowByEmail($this->input->post('email',TRUE));
				if($user_record)
				{
					$arr = array(
							"full_name" => $user_record['full_name'],
							"username"  => $user_record['username'],
							"password"  => $this->Common_model->decryptIt($user_record['password']),
							"email"     => $user_record['email']
						   );
					$result = $this->Emailtemplates_model->sendMail('forgot_password',$arr);
					if($result){
						$data['success']      = 'Email Send to '.$user_record['email'];
					}
				}
				else
				{
					$data['error']	=	 'Email not found.';
				}
			}
		}

		$data['page_title'] = 'Forgot Password';
		$data['page_heading'] = 'Forgot Password';
		$this->load->view('admin/forgot_password',$data);
	}

}
