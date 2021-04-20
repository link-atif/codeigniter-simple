<?php

ob_start();

defined('BASEPATH') OR exit('No direct script access allowed');



class Subscription extends Common_Controller {



	function __construct() {



        parent::__construct();

		$this->load->model('Pages_model');

		$this->load->model('Contactqueries_model');

		$this->load->model('Product_model');

		$this->load->model('Awards_model');

		$this->load->model('Partners_model');

		$this->load->model('Careers_model');

		$this->load->model('Categories_model');

		$this->load->model('Emailtemplates_model');

		$this->load->model('Registration_model');

		$this->load->model('Subscription_model');

		$this->load->model('Preferences_model');

		$this->load->model('Users_model');

		

		$this->data['header_pages']  = $this->Pages_model->getPagesByType('header','both');

		$this->data['footer_pages']  = $this->Pages_model->getPagesByType('footer','both');

		$this->load->helper('cookie');

    }



    public function player(){

    	$language = $this->Common_model->get_language_name();

		$data['page_heading']	= "Player Subscription";

		$data['page_title']    	= 'Player';



		$data['success'] = $this->input->get('msg') ? $this->input->get('msg') : '';



		if($this->input->post()) {

			$this->Subscription_model->update('player_title',$this->input->post('player_title'));

			$this->Subscription_model->update('player_description',$this->input->post('player_description'));

			$this->Subscription_model->update('player_subscription_fee',$this->input->post('player_subscription_fee'));

			$this->Subscription_model->update('player_heading',$this->input->post('player_heading'));

			$this->Subscription_model->update('player_heading_description',$this->input->post('player_heading_description'));

			$this->Subscription_model->update('player_free_subscription',$this->input->post('player_free_subscription'));

			$this->Subscription_model->update('player_premium_subscription',$this->input->post('player_premium_subscription'));



			if(isset($_FILES['player_image']) and $_FILES['player_image']['name']!=''){

				$file_name= time().$_FILES['player_image']['name'];

				$data['name'] = $file_name;

				$returnValue = $this->Subscription_model->uploadImage($file_name, 'player_image', 'uploads/data/');

				if($returnValue) {				

					$this->Subscription_model->update('player_image',$returnValue);

				}

			}

			redirect('admin/Subscription/player?msg=Updated Successfully');

		}



		$data['player_title']         			=  $this->Subscription_model->getValue('player_title');

		$data['player_description']    			=  $this->Subscription_model->getValue('player_description');

		$data['player_subscription_fee']    	=  $this->Subscription_model->getValue('player_subscription_fee');

		$data['player_image']    				=  $this->Subscription_model->getValue('player_image');

		$data['player_heading']    				=  $this->Subscription_model->getValue('player_heading');

		$data['player_heading_description']    	=  $this->Subscription_model->getValue('player_heading_description');

		$data['player_free_subscription']  		=  $this->Subscription_model->getValue('player_free_subscription');

		$data['player_premium_subscription'] 	=  $this->Subscription_model->getValue('player_premium_subscription');



		$this->load->view('admin/player',$data);

	}



	public function coach(){

    	$language = $this->Common_model->get_language_name();

		$data['page_heading']	= "Coach Subscription";

		$data['page_title']    	= 'Coach';

		//$this->data['action']		=  base_url().'admin/subscription/coach';

		$data['success'] = $this->input->get('msg') ? $this->input->get('msg') : '';



		if($this->input->post()) {

			$this->Subscription_model->update('coach_title',$this->input->post('coach_title'));

			$this->Subscription_model->update('coach_description',$this->input->post('coach_description'));

			$this->Subscription_model->update('coach_subscription_fee',$this->input->post('coach_subscription_fee'));

			$this->Subscription_model->update('coach_heading',$this->input->post('coach_heading'));

			$this->Subscription_model->update('coach_heading_description',$this->input->post('coach_heading_description'));

			$this->Subscription_model->update('coach_free_subscription',$this->input->post('coach_free_subscription'));

			$this->Subscription_model->update('coach_premium_subscription',$this->input->post('coach_premium_subscription'));



			if(isset($_FILES['coach_image']) and $_FILES['coach_image']['name']!=''){

				$file_name= time().$_FILES['coach_image']['name'];

				$data['name'] = $file_name;

				$returnValue = $this->Subscription_model->uploadImage($file_name, 'coach_image', 'uploads/data/');

				if($returnValue) {				

					$this->Subscription_model->update('coach_image',$returnValue);

				}

			}

			redirect('admin/Subscription/coach?msg=Updated Successfully');

		}



		$data['coach_title']         			=  $this->Subscription_model->getValue('coach_title');

		$data['coach_description']    			=  $this->Subscription_model->getValue('coach_description');

		$data['coach_subscription_fee']    		=  $this->Subscription_model->getValue('coach_subscription_fee');

		$data['coach_image']    				=  $this->Subscription_model->getValue('coach_image');

		$data['coach_free_subscription']  		=  $this->Subscription_model->getValue('coach_free_subscription');

		$data['coach_premium_subscription'] 	=  $this->Subscription_model->getValue('coach_premium_subscription');

		$data['coach_heading']    				=  $this->Subscription_model->getValue('coach_heading');

		$data['coach_heading_description']    	=  $this->Subscription_model->getValue('coach_heading_description');



		$this->load->view('admin/coach',$data);

	}



	public function business(){

    	$language = $this->Common_model->get_language_name();

		$data['page_heading']	= "Business Subscription";

		$data['page_title']		= "Business";

		//$this->data['action']		=  base_url().'admin/subscription/business';



		$data['success'] = $this->input->get('msg') ? $this->input->get('msg') : '';



		if($this->input->post()) {

			$this->Subscription_model->update('business_title',$this->input->post('business_title'));

			$this->Subscription_model->update('business_description',$this->input->post('business_description'));

			$this->Subscription_model->update('business_subscription_fee',$this->input->post('business_subscription_fee'));

			$this->Subscription_model->update('business_free_subscription',$this->input->post('business_free_subscription'));

			$this->Subscription_model->update('business_premium_subscription',$this->input->post('business_premium_subscription'));

			$this->Subscription_model->update('business_heading',$this->input->post('business_heading'));

			$this->Subscription_model->update('business_heading_description',$this->input->post('business_heading_description'));



			if(isset($_FILES['business_image']) and $_FILES['business_image']['name']!=''){

				$file_name= time().$_FILES['business_image']['name'];

				$data['name'] = $file_name;

				$returnValue = $this->Subscription_model->uploadImage($file_name, 'business_image', 'uploads/data/');

				if($returnValue) {				

					$this->Subscription_model->update('business_image',$returnValue);

				}

			}

			redirect('admin/Subscription/business?msg=Updated Successfully');

		}



		$data['business_title']         			=  $this->Subscription_model->getValue('business_title');

		$data['business_description']    			=  $this->Subscription_model->getValue('business_description');

		$data['business_subscription_fee']    		=  $this->Subscription_model->getValue('business_subscription_fee');

		$data['business_image']    					=  $this->Subscription_model->getValue('business_image');

		$data['business_free_subscription']  		=  $this->Subscription_model->getValue('business_free_subscription');

		$data['business_premium_subscription'] 		=  $this->Subscription_model->getValue('business_premium_subscription');

		$data['business_heading']    				=  $this->Subscription_model->getValue('business_heading');

		$data['business_heading_description']    	=  $this->Subscription_model->getValue('business_heading_description');



		$this->load->view('admin/business',$data);

	}



	public function resource(){

    	$language = $this->Common_model->get_language_name();

		$data['page_heading']	= "Resource Subscription";

		$data['page_title']		= "Resource";



		//$this->data['action']		=  base_url().'admin/subscription/resource';



		$data['success'] = $this->input->get('msg') ? $this->input->get('msg') : '';



		if($this->input->post()) {

			$this->Subscription_model->update('resource_title',$this->input->post('resource_title'));

			$this->Subscription_model->update('resource_description',$this->input->post('resource_description'));

			$this->Subscription_model->update('resource_subscription_fee',$this->input->post('resource_subscription_fee'));

			$this->Subscription_model->update('resource_free_subscription',$this->input->post('resource_free_subscription'));

			$this->Subscription_model->update('resource_premium_subscription',$this->input->post('resource_premium_subscription'));

			$this->Subscription_model->update('resource_heading',$this->input->post('resource_heading'));

			$this->Subscription_model->update('resource_heading_description',$this->input->post('resource_heading_description'));



			if(isset($_FILES['resource_image']) and $_FILES['resource_image']['name']!=''){

				$file_name= time().$_FILES['resource_image']['name'];

				$data['name'] = $file_name;

				$returnValue = $this->Subscription_model->uploadImage($file_name, 'resource_image', 'uploads/data/');

				if($returnValue) {				

					$this->Subscription_model->update('resource_image',$returnValue);

				}

			}

			redirect('admin/Subscription/resource?msg=Updated Successfully');

		}



		$data['resource_title']         		=  $this->Subscription_model->getValue('resource_title');

		$data['resource_description']    		=  $this->Subscription_model->getValue('resource_description');

		$data['resource_subscription_fee']    	=  $this->Subscription_model->getValue('resource_subscription_fee');

		$data['resource_image']    				=  $this->Subscription_model->getValue('resource_image');

		$data['resource_free_subscription']  	=  $this->Subscription_model->getValue('resource_free_subscription');

		$data['resource_premium_subscription'] 	=  $this->Subscription_model->getValue('resource_premium_subscription');

		$data['resource_heading']    			=  $this->Subscription_model->getValue('resource_heading');

		$data['resource_heading_description']   =  $this->Subscription_model->getValue('resource_heading_description');



		$this->load->view('admin/resource',$data);

	}



	public function fifaAgent(){

    	$language = $this->Common_model->get_language_name();

		$data['page_heading']	= "FIFA Agent Subscription";

		$data['page_title']		= "FIFA Agent";



		//$this->data['action']		=  base_url().'admin/subscription/fifaAgent';



		$data['success'] = $this->input->get('msg') ? $this->input->get('msg') : '';



		if($this->input->post()) {

			$this->Subscription_model->update('fifaAgent_title',$this->input->post('fifaAgent_title'));

			$this->Subscription_model->update('fifaAgent_description',$this->input->post('fifaAgent_description'));

			$this->Subscription_model->update('fifaAgent_subscription_fee',$this->input->post('fifaAgent_subscription_fee'));

			$this->Subscription_model->update('fifaAgent_free_subscription',$this->input->post('fifaAgent_free_subscription'));

			$this->Subscription_model->update('fifaAgent_premium_subscription',$this->input->post('fifaAgent_premium_subscription'));

			$this->Subscription_model->update('fifaAgent_heading',$this->input->post('fifaAgent_heading'));

			$this->Subscription_model->update('fifaAgent_heading_description',$this->input->post('fifaAgent_heading_description'));



			if(isset($_FILES['fifaAgent_image']) and $_FILES['fifaAgent_image']['name']!=''){

				$file_name= time().$_FILES['fifaAgent_image']['name'];

				$data['name'] = $file_name;

				$returnValue = $this->Subscription_model->uploadImage($file_name, 'fifaAgent_image', 'uploads/data/');

				if($returnValue) {				

					$this->Subscription_model->update('fifaAgent_image',$returnValue);

				}

			}

			redirect('admin/Subscription/fifaAgent?msg=Updated Successfully');

		}



		$data['fifaAgent_title']         			=  $this->Subscription_model->getValue('fifaAgent_title');

		$data['fifaAgent_description']    			=  $this->Subscription_model->getValue('fifaAgent_description');

		$data['fifaAgent_subscription_fee']    		=  $this->Subscription_model->getValue('fifaAgent_subscription_fee');

		$data['fifaAgent_image']    				=  $this->Subscription_model->getValue('fifaAgent_image');

		$data['fifaAgent_free_subscription']  		=  $this->Subscription_model->getValue('fifaAgent_free_subscription');

		$data['fifaAgent_premium_subscription'] 	=  $this->Subscription_model->getValue('fifaAgent_premium_subscription');

		$data['fifaAgent_heading']    				=  $this->Subscription_model->getValue('fifaAgent_heading');

		$data['fifaAgent_heading_description']    	=  $this->Subscription_model->getValue('fifaAgent_heading_description');



		$this->load->view('admin/fifaAgent',$data);

	}



	public function event(){

    	$language = $this->Common_model->get_language_name();

		$data['page_heading']	= "Event Subscription";

		$data['page_title']		= "Event";



		//$this->data['action']		=  base_url().'admin/subscription/event';



		$data['success'] = $this->input->get('msg') ? $this->input->get('msg') : '';



		if($this->input->post()) {

			$this->Subscription_model->update('event_title',$this->input->post('event_title'));

			$this->Subscription_model->update('event_description',$this->input->post('event_description'));

			$this->Subscription_model->update('event_subscription_fee',$this->input->post('event_subscription_fee'));

			$this->Subscription_model->update('event_free_subscription',$this->input->post('event_free_subscription'));

			$this->Subscription_model->update('event_premium_subscription',$this->input->post('event_premium_subscription'));

			$this->Subscription_model->update('event_heading',$this->input->post('event_heading'));

			$this->Subscription_model->update('event_heading_description',$this->input->post('event_heading_description'));



			if(isset($_FILES['event_image']) and $_FILES['event_image']['name']!=''){

				$file_name= time().$_FILES['event_image']['name'];

				$data['name'] = $file_name;

				$returnValue = $this->Subscription_model->uploadImage($file_name, 'event_image', 'uploads/data/');

				if($returnValue) {				

					$this->Subscription_model->update('event_image',$returnValue);

				}

			}

			redirect('admin/Subscription/event?msg=Updated Successfully');

		}



		$data['event_title']         			=  $this->Subscription_model->getValue('event_title');

		$data['event_description']    			=  $this->Subscription_model->getValue('event_description');

		$data['event_subscription_fee']    		=  $this->Subscription_model->getValue('event_subscription_fee');

		$data['event_image']    				=  $this->Subscription_model->getValue('event_image');

		$data['event_free_subscription']  		=  $this->Subscription_model->getValue('event_free_subscription');

		$data['event_premium_subscription'] 	=  $this->Subscription_model->getValue('event_premium_subscription');

		$data['event_heading']    				=  $this->Subscription_model->getValue('event_heading');

		$data['event_heading_description']    	=  $this->Subscription_model->getValue('event_heading_description');



		$this->load->view('admin/event',$data);

	}



}



?>