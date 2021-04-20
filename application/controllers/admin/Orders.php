<?php

ob_start();

defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller

{

	function __construct()

    {

        parent::__construct();

		$this->load->model('Admin_model');

		$this->load->model('Media_model');

		$this->load->model('Emailtemplates_model');

		$this->load->model('Users_model');

		$this->load->model('Contactqueries_model');

		$this->load->model('Blogs_model');

		$this->load->model('Services_model');

		$this->load->model('Portfolio_model');

		$this->load->model('Preferences_model');

		$this->lang->load('access','english');

		if(!$this->session->userdata('admin_id')) {

			redirect(base_url().'admin/login');		

		}

    }

	public function index(){

		$arr 		           = array();

        $arr['reference']           = $this->input->get('reference') ? $this->input->get('reference') : '';

		$config 			   = array();

        $config["base_url"]    = base_url() . "admin/Orders";

        $config["total_rows"]  = $this->Blogs_model->countTotalreference($arr);

		/*if($this->input->get('per_page')){

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

		}*/

		/*$data['media']         = $this->Media_model->getAll($arr,$page,$config["per_page"] );

		$data["links"]         = $this->pagination->create_links();

*/		/*$data['page_title']    = 'Media';

		$data['page_heading']  = 'Media';*/

		

		$data['msg'] = $this->input->get('msg') ? $this->input->get('msg') : '';

		$data['order'] = $this->Contactqueries_model->getAllOrders($arr);

		

		$data['page_title'] = 'Orders';

		$data['page_heading'] = 'Orders';

		$this->load->view('admin/order_detail',$data);

	}

    public function delete($id) {



		$data['user'] = $this->Contactqueries_model->delete_Order($id);

		



		redirect(base_url().'admin/Orders?msg=Deleted Successfully');

	}

	public function showDetail($user_id){



		$data['orders'] = $this->Contactqueries_model->getAllOrdersdetail($user_id);

		$data['order'] = $this->Contactqueries_model->getAllDetail($user_id);



		$data['page_title'] = 'Orders';

		$data['page_heading'] = 'Products Detail';

		$this->load->view('admin/detail',$data);

	}

	public function addstatus(){

		if($this->input->post()){

			$data=array(

             "status"=>$this->input->post('status')

			);

			$status=$this->Contactqueries_model->save_status($data,$this->input->post('order_id'));

			$user_row = $this->Contactqueries_model->get_email($this->input->post('order_id'));

			

				if ($user_row) {

					$user_record	=$user_row;

					if($user_record){

						//$message = 'Your Status is '. $user_record->status;

						//mail($email,'Forget Password',$message);

						$email_arr = array("email" => $user_record->email, "name" => $user_record->full_name, "order_id" => $this->input->post('order_id'), "status" =>$user_record->status);

						$result = $this->Emailtemplates_model->sendEmail('status',$email_arr);

						$arr['success'] = true;

						$arr['msg']	= 'Status succesfully sent through Email.';

					}else{

						$arr['success'] = false;

						$arr['msg']	= 'Something went Wrong.';

					}

				}

		}

		redirect(base_url().'admin/Orders?msg=Updated Successfully');

	}

}

?>