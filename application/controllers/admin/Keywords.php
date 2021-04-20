<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');
class Keywords extends CI_Controller
{
	function __construct() {

        parent::__construct();
		$this->load->model('Preferences_model');
		$this->load->model('Common_model');
		if(!$this->session->userdata('admin_id')) {
			redirect(base_url().'admin/login');
		}
    }
    
	public function index() {
		//$data['pages']         = $this->Pages_model->getAllPages();
		$data['page_title'] = 'Keywords';
		$data['page_heading'] = 'Keywords';
		$data['language'] = $this->Common_model->get_all_languages();

		$data['success'] = $this->input->get('msg') ? $this->input->get('msg') : '';

		if($this->input->post()){
			//print_r($this->input->post());
			
			$language = $this->Common_model->get_all_languages();

			foreach ($language as $key => $v) {
				$this->Preferences_model->update('heading_mer'.$v->name,$this->input->post('heading_mer'.$v->name));
				$this->Preferences_model->update('mer_des'.$v->name,$this->input->post('mer_des'.$v->name));
				$this->Preferences_model->update('mer_key'.$v->name,$this->input->post('mer_key'.$v->name));
				$this->Preferences_model->update('heading_fra'.$v->name,$this->input->post('heading_fra'.$v->name));
				$this->Preferences_model->update('fra_des'.$v->name,$this->input->post('fra_des'.$v->name));
				$this->Preferences_model->update('fra_key'.$v->name,$this->input->post('fra_key'.$v->name));
				
				$this->Preferences_model->update('heading_junk'.$v->name,$this->input->post('heading_junk'.$v->name));
				$this->Preferences_model->update('junk_des'.$v->name,$this->input->post('junk_des'.$v->name));
				$this->Preferences_model->update('junk_key'.$v->name,$this->input->post('junk_key'.$v->name));
				$this->Preferences_model->update('heading_media'.$v->name,$this->input->post('heading_media'.$v->name));
				$this->Preferences_model->update('media_des'.$v->name,$this->input->post('media_des'.$v->name));
				$this->Preferences_model->update('media_key'.$v->name,$this->input->post('media_key'.$v->name));
				$this->Preferences_model->update('heading_about'.$v->name,$this->input->post('heading_about'.$v->name));
				$this->Preferences_model->update('about_des'.$v->name,$this->input->post('about_des'.$v->name));
				$this->Preferences_model->update('about_key'.$v->name,$this->input->post('about_key'.$v->name));
				
			}			
			/*
			$this->Preferences_model->update('home_meta_title',$this->input->post('home_meta_title'));
			$this->Preferences_model->update('home_meta_description',$this->input->post('home_meta_description'));
			
			$this->Preferences_model->update('news_meta_title',$this->input->post('news_meta_title'));			
			$this->Preferences_model->update('news_meta_description',$this->input->post('news_meta_description'));
			$this->Preferences_model->update('contactus_title',$this->input->post('contactus_title'));
			$this->Preferences_model->update('contactus_description',$this->input->post('contactus_description'));

			$this->Preferences_model->update('services',$this->input->post('services'));
			$this->Preferences_model->update('services_description',$this->input->post('services_description'));

			$this->Preferences_model->update('portfolio',$this->input->post('portfolio'));
			$this->Preferences_model->update('portfolio_description',$this->input->post('portfolio_description'));

			$this->Preferences_model->update('blogs',$this->input->post('blogs'));
			$this->Preferences_model->update('blogs_description',$this->input->post('blogs_description'));

			$this->Preferences_model->update('about_me',$this->input->post('about_me'));
			$this->Preferences_model->update('aboutus_text',$this->input->post('aboutus_text'));
			$this->Preferences_model->update('profile',$this->input->post('profile'));
			$this->Preferences_model->update('profile_name',$this->input->post('profile_name'));
			$this->Preferences_model->update('profile_email',$this->input->post('profile_email'));
			$this->Preferences_model->update('profile_phone',$this->input->post('profile_phone'));
			$this->Preferences_model->update('skill_1',$this->input->post('skill_1'));
			$this->Preferences_model->update('rate_1',$this->input->post('rate_1'));
			$this->Preferences_model->update('skill_2',$this->input->post('skill_2'));
			$this->Preferences_model->update('rate_2',$this->input->post('rate_2'));
			$this->Preferences_model->update('skill_3',$this->input->post('skill_3'));
			$this->Preferences_model->update('rate_3',$this->input->post('rate_3'));
			$this->Preferences_model->update('skill_4',$this->input->post('skill_4'));
			$this->Preferences_model->update('rate_4',$this->input->post('rate_4'));*/

			/*if(isset($_FILES['header_ads']) and $_FILES['header_ads']['name']!=''){
				$header_ads= time()."home1".$_FILES['header_ads']['name'];
				$returnValue = $this->Common_model->uploadFile2($header_ads,'header_ads','uploads/data/');
				if($returnValue) {
					$this->Preferences_model->update('header_ads',$returnValue);
				}
			}

			if(isset($_FILES['heading1_picture']) and $_FILES['heading1_picture']['name']!=''){
				$heading1_picture= time()."home1".$_FILES['heading1_picture']['name'];
				$returnValue = $this->Common_model->uploadFile2($heading1_picture,'heading1_picture','uploads/data/');
				if($returnValue) {
					$this->Preferences_model->update('heading1_picture',$returnValue);
				}
			}
*/			

			/*if(isset($_FILES['heading1_picture2']) and $_FILES['heading1_picture2']['name']!=''){
				$heading1_picture= time()."home1".$_FILES['heading1_picture2']['name'];
				$returnValue = $this->Common_model->uploadFile2($heading1_picture,'heading1_picture2','uploads/data/');
				if($returnValue) {
					$this->Preferences_model->update('heading1_picture2',$returnValue);
				}
			}

			if(isset($_FILES['profile_picture']) and $_FILES['profile_picture']['name']!=''){
				$profile_picture = time()."home1".$_FILES['profile_picture']['name'];
				$returnValue = $this->Common_model->uploadFile2($profile_picture,'profile_picture','uploads/data/');
				if($returnValue) {
					$this->Preferences_model->update('profile_picture',$returnValue);
				}
			}

			if(isset($_FILES['sub_heading2_picture']) and $_FILES['sub_heading2_picture']['name']!=''){
				$sub_heading2_picture= time()."home1".$_FILES['sub_heading2_picture']['name'];
				$returnValue = $this->Common_model->uploadFile2($sub_heading2_picture,'sub_heading2_picture','uploads/data/');
				if($returnValue) {
					$this->Preferences_model->update('sub_heading2_picture',$returnValue);
				}
			}

			if(isset($_FILES['sub_heading3_picture']) and $_FILES['sub_heading3_picture']['name']!=''){
				$sub_heading3_picture= time()."home1".$_FILES['sub_heading3_picture']['name'];
				$returnValue = $this->Common_model->uploadFile2($sub_heading3_picture,'sub_heading3_picture','uploads/data/');
				if($returnValue) {
					$this->Preferences_model->update('sub_heading3_picture',$returnValue);
				}
			}

			if(isset($_FILES['sub_heading4_picture']) and $_FILES['sub_heading4_picture']['name']!=''){
				$sub_heading4_picture= time()."home1".$_FILES['sub_heading4_picture']['name'];
				$returnValue = $this->Common_model->uploadFile2($sub_heading4_picture,'sub_heading4_picture','uploads/data/');
				if($returnValue) {
					$this->Preferences_model->update('sub_heading4_picture',$returnValue);
				}
			}

			if(isset($_FILES['sub_heading5_picture']) and $_FILES['sub_heading5_picture']['name']!=''){
				$sub_heading5_picture= time()."home1".$_FILES['sub_heading5_picture']['name'];
				$returnValue = $this->Common_model->uploadFile2($sub_heading5_picture,'sub_heading5_picture','uploads/data/');
				if($returnValue) {
					$this->Preferences_model->update('sub_heading5_picture',$returnValue);
				}
			}*/

			redirect('admin/Keywords?msg=Added Successfully');
		}
       
		
		$language = $this->Common_model->get_all_languages();
		foreach ($language as $key => $v) {
			$data['heading_mer'][$key] =  $this->Preferences_model->getValue('heading_mer'.$v->name);
			$data['mer_des'][$key] =  $this->Preferences_model->getValue('mer_des'.$v->name);
			$data['mer_key'][$key] =  $this->Preferences_model->getValue('mer_key'.$v->name);
			$data['heading_fra'][$key] =  $this->Preferences_model->getValue('heading_fra'.$v->name);
			$data['fra_des'][$key]=  $this->Preferences_model->getValue('fra_des'.$v->name);
			$data['fra_key'][$key] =  $this->Preferences_model->getValue('fra_key'.$v->name);
			
			$data['heading_junk'][$key] =  $this->Preferences_model->getValue('heading_junk'.$v->name);
			$data['junk_des'][$key] =  $this->Preferences_model->getValue('junk_des'.$v->name);
			$data['junk_key'][$key] =  $this->Preferences_model->getValue('junk_key'.$v->name);
			$data['heading_media'][$key] =  $this->Preferences_model->getValue('heading_media'.$v->name);
			$data['media_des'][$key] =  $this->Preferences_model->getValue('media_des'.$v->name);
			$data['media_key'][$key] =  $this->Preferences_model->getValue('media_key'.$v->name);
			$data['heading_about'][$key] =  $this->Preferences_model->getValue('heading_about'.$v->name);
			$data['about_des'][$key] =  $this->Preferences_model->getValue('about_des'.$v->name);
			$data['about_key'][$key] =  $this->Preferences_model->getValue('about_key'.$v->name);
			
		}

		/*
		$data['footer_contactus']      	=  $this->Preferences_model->getValue('footer_contactus');
		$data['footer_aboutus']      	=  $this->Preferences_model->getValue('footer_aboutus');
		$data['fax']         			=  $this->Preferences_model->getValue('fax');
		$data['paypal_email']         	=  $this->Preferences_model->getValue('paypal_email');
		$data['subscription_price']    	=  $this->Preferences_model->getValue('subscription_price');
		$data['currency_code']         	=  $this->Preferences_model->getValue('currency_code');
		$data['heading1_english']       =  $this->Preferences_model->getValue('heading1_english');
		$data['heading1_english_text']  =  $this->Preferences_model->getValue('heading1_english_text');
		$data['footer_copyright']     	=  $this->Preferences_model->getValue('footer_copyright');
		$data['contact_us_text']     	=  $this->Preferences_model->getValue('contact_us_text');
		$data['contactus_map_code']     =  $this->Preferences_model->getValue('contactus_map_code');

		$data['membership_heading']     =  $this->Preferences_model->getValue('membership_heading');
		$data['membership_description'] =  $this->Preferences_model->getValue('membership_description');

		$data['services']  			    =  $this->Preferences_model->getValue('services');
		$data['services_description']   =  $this->Preferences_model->getValue('services_description');
		
		$data['portfolio']  			    =  $this->Preferences_model->getValue('portfolio');
		$data['portfolio_description']   =  $this->Preferences_model->getValue('portfolio_description');

		$data['blogs']  			    =  $this->Preferences_model->getValue('blogs');
		$data['blogs_description']   =  $this->Preferences_model->getValue('blogs_description');

		$data['about_me'] 				= $this->Preferences_model->getValue('about_me');
		$data['profile_picture']        = $this->Preferences_model->getValue('profile_picture');
		$data['aboutus_text']  		    =  $this->Preferences_model->getValue('aboutus_text');
		$data['profile']  		    =  $this->Preferences_model->getValue('profile');
		$data['profile_name']  		    =  $this->Preferences_model->getValue('profile_name');
		$data['profile_email']  		    =  $this->Preferences_model->getValue('profile_email');
		$data['profile_phone']  		    =  $this->Preferences_model->getValue('profile_phone');
		$data['skill_1']  		    =  $this->Preferences_model->getValue('skill_1');
		$data['rate_1']  		    =  $this->Preferences_model->getValue('rate_1');
		$data['skill_2']  		    =  $this->Preferences_model->getValue('skill_2');
		$data['rate_2']  		    =  $this->Preferences_model->getValue('rate_2');
		$data['skill_3']  		    =  $this->Preferences_model->getValue('skill_3');
		$data['rate_3']  		    =  $this->Preferences_model->getValue('rate_3');
		$data['skill_4']  		    =  $this->Preferences_model->getValue('skill_4');
		$data['rate_4']  		    =  $this->Preferences_model->getValue('rate_4');

		$data['heading1_picture']       = $this->Preferences_model->getValue('heading1_picture');
		$data['heading1_picture2']      = $this->Preferences_model->getValue('heading1_picture2');

		$data['sub_heading1']  			    =  $this->Preferences_model->getValue('sub_heading1');
		$data['sub_heading1_picture']       =  $this->Preferences_model->getValue('sub_heading1_picture');

		$data['sub_heading2']  			    =  $this->Preferences_model->getValue('sub_heading2');
		$data['sub_heading2_picture']       =  $this->Preferences_model->getValue('sub_heading2_picture');*/
/*
		$data['sub_heading3']  			    =  $this->Preferences_model->getValue('sub_heading3');
		$data['sub_heading3_picture']       =  $this->Preferences_model->getValue('sub_heading3_picture');

		$data['sub_heading4']  			    =  $this->Preferences_model->getValue('sub_heading4');
		$data['sub_heading4_picture']       =  $this->Preferences_model->getValue('sub_heading4_picture');

		$data['sub_heading5']  			    =  $this->Preferences_model->getValue('sub_heading5');
		$data['sub_heading5_picture']       =  $this->Preferences_model->getValue('sub_heading5_picture');
		*/
		/*$data['heading2']     		  =  $this->Preferences_model->getValue('heading2');
		$data['heading2_description'] =  $this->Preferences_model->getValue('heading2_description');


		$data['home_meta_title']     		=  $this->Preferences_model->getValue('home_meta_title');
		$data['home_meta_description']     	=  $this->Preferences_model->getValue('home_meta_description');*/
		//$data['home_meta_keywords']    		=  $this->Preferences_model->getValue('home_meta_keywords');
		
		//$data['news_meta_title']     		=  $this->Preferences_model->getValue('news_meta_title');
		//$data['news_meta_description']     	=  $this->Preferences_model->getValue('news_meta_description');
		//$data['news_meta_keywords']  	    =  $this->Preferences_model->getValue('news_meta_keywords');
		
		//$data['contactus_title']     		=  $this->Preferences_model->getValue('contactus_title');
		//$data['contactus_description']     =  $this->Preferences_model->getValue('contactus_description');
		//$data['contactus_meta_keywords']   		=  $this->Preferences_model->getValue('contactus_meta_keywords');
		
		/*$data['aboutus_heading']     	=  $this->Preferences_model->getValue('aboutus_heading');
		$data['about_us_pic1']     		=  $this->Preferences_model->getValue('about_us_pic1');*/
		//$data['header_ads']     		=  $this->Preferences_model->getValue('header_ads');
		
		$this->load->view('admin/keywords',$data);
	}

	public function addPage() {
		
		$data['page_title']       = 'Add Page';
		$data['page_heading']     = 'Add Page';
		$data['parent_pages']     = $this->Pages_model->getParentPages();
		
		if($this->input->post()) {
			$rules = array(
			    array(
                	'field'   => 'title',
                 	'label'   => 'Title',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'slug',
                 	'label'   => 'Slug',
                 	'rules'   => 'trim|required'
              	),
              	array(
                     'field'   => 'body',
                     'label'   => 'Detail',
                     'rules'   => 'trim|required'
                )
            );

			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run()) {
				//$packageRow = $this->Packages_model->getRow($this->input->post('package_id'));
				$array = array(
							"title"  	 => $this->input->post('title'),
							"slug"  	 => $this->input->post('slug'),
							"type"  	 => $this->input->post('type'),
							"parent_id"  => $this->input->post('parent_id'),
							"body" 		 => $this->input->post('body'),
							"seo_url"    => $this->seoUrl($this->input->post('slug'))
						 );
				
				$user_record			=	$this->Pages_model->save($array);
				if($user_record) {
					redirect('admin/pages?msg=Added Successfully');
				}else {
					$data['error']	    = 'Some Error try later';
					$data['pageDetail'] = $_REQUEST;
				}
				
			}else{
				$data['pageDetail'] = $_REQUEST;
			}
		}else {
			$data['pageDetail'] = array();
		}
		$this->load->view('admin/add_page',$data);
	}


	public function deleteImage($pic){
		$pic_name = $this->Preferences_model->getValue($pic);
		$this->Preferences_model->update($pic,'');
		@unlink('uploads/data/'.$pic_name);
		redirect(base_url()."admin/Preferences?msg=Picture Deleted Successfully");
	}

	public function uploadAddImage(){
		
		/*$id = $this->input->get('id') ? $this->input->get('id') : '';
		if($id!=''){
			$this->Packages_model->deletePackageFile($id);
		}*/
		//$this->Packages_model->deletePackageFile($this->input->post('id'));
		$path                    = 'uploads/data/';

		if($this->session->userdata('home_pic')!=''){
			@unlink('uploads/data/'.$this->session->userdata('package_pic_name'));
		}

		$picture_name = 'home_' . time();
		$picture_name = $this->Common_model->uploadImageAndResize($picture_name,$path,550,440);
		if ($picture_name){
			$arr            = array('home_pic' =>  $picture_name);
			$this->session->set_userdata($arr);
			$array = array('error'=>'','picture_name' => $picture_name);
			echo json_encode($array);
		}else{
			$error = array('error' => strip_tags($this->upload->display_errors()));
			echo json_encode($error);
		}
	}
}
