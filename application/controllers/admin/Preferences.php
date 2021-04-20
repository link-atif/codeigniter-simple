<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');
class Preferences extends CI_Controller
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

		$data['page_title'] = 'Preferences';

		$data['page_heading'] = 'Preferences';

		$data['language'] = $this->Common_model->get_all_languages();



		$data['success'] = $this->input->get('msg') ? $this->input->get('msg') : '';



		if($this->input->post()){

			//print_r($this->input->post());

			$this->Preferences_model->update('email',$this->input->post('email'));

			$this->Preferences_model->update('email2',$this->input->post('email2'));

			$this->Preferences_model->update('telephone',$this->input->post('telephone'));

			$this->Preferences_model->update('address',$this->input->post('address'));

			$this->Preferences_model->update('description',$this->input->post('description'));

			$this->Preferences_model->update('facebook_link',$this->input->post('facebook_link'));/*

			$this->Preferences_model->update('alert',$this->input->post('alert'));

            $this->Preferences_model->update('services_page',$this->input->post('services_page'));

            $this->Preferences_model->update('des_services_page_2',$this->input->post('des_services_page_2'));

            $this->Preferences_model->update('des_services_page',$this->input->post('des_services_page'));

            $this->Preferences_model->update('services_page_2',$this->input->post('services_page_2'));

            */$this->Preferences_model->update('map',$this->input->post('map'));/*

			$this->Preferences_model->update('services_solution',$this->input->post('services_solution'));

			$this->Preferences_model->update('public_sector',$this->input->post('public_sector'));

			$this->Preferences_model->update('industry_detail',$this->input->post('industry_detail'));

			$this->Preferences_model->update('industry',$this->input->post('industry'));

			$this->Preferences_model->update('pic1',$this->input->post('pic1'));

			$this->Preferences_model->update('sic_naice_detail',$this->input->post('sic_naice_detail'));

			$this->Preferences_model->update('sic_naice',$this->input->post('sic_naice'));

			$this->Preferences_model->update('service_sol_para',$this->input->post('service_sol_para'));

			$this->Preferences_model->update('alert_detail',$this->input->post('alert_detail'));*/

			$this->Preferences_model->update('home_page_heading',$this->input->post('home_page_heading'));
			$this->Preferences_model->update('menue_title',$this->input->post('menue_title'));
			$this->Preferences_model->update('menue_link',$this->input->post('menue_link'));

			$this->Preferences_model->update('home_page_desc',$this->input->post('home_page_desc'));

			$this->Preferences_model->update('about_section_heading',$this->input->post('about_section_heading'));

			$this->Preferences_model->update('about_section_desc',$this->input->post('about_section_desc'));

			$this->Preferences_model->update('classes_section_heading',$this->input->post('classes_section_heading'));

			$this->Preferences_model->update('classes_section_desc',$this->input->post('classes_section_desc'));

			$this->Preferences_model->update('membership_section_heading',$this->input->post('membership_section_heading'));

			$this->Preferences_model->update('membership_section_desc',$this->input->post('membership_section_desc'));

			$this->Preferences_model->update('retreats_section_heading',$this->input->post('retreats_section_heading'));

			$this->Preferences_model->update('retreats_section_desc',$this->input->post('retreats_section_desc'));

			$this->Preferences_model->update('mentorship_section_heading',$this->input->post('mentorship_section_heading'));

			$this->Preferences_model->update('mentorship_section_desc',$this->input->post('mentorship_section_desc'));

			$this->Preferences_model->update('newsletter_title',$this->input->post('newsletter_title'));

			$this->Preferences_model->update('newsletter_desc',$this->input->post('newsletter_desc'));

			$this->Preferences_model->update('plans_heading',$this->input->post('plans_heading'));

			$this->Preferences_model->update('plans_desc',$this->input->post('plans_desc'));

			$this->Preferences_model->update('home_title',$this->input->post('home_title'));

			$this->Preferences_model->update('ondemand_heading',$this->input->post('ondemand_heading'));

			$this->Preferences_model->update('ondemand_desc',$this->input->post('ondemand_desc'));

			$this->Preferences_model->update('retreats_title',$this->input->post('retreats_title'));

			$this->Preferences_model->update('retreats_desc',$this->input->post('retreats_desc'));

			$this->Preferences_model->update('retreats_title_2',$this->input->post('retreats_title_2'));

			$this->Preferences_model->update('retreats_desc_2',$this->input->post('retreats_desc_2'));

			$this->Preferences_model->update('live_title',$this->input->post('live_title'));

			$this->Preferences_model->update('live_desc',$this->input->post('live_desc'));

			$this->Preferences_model->update('live_classes_heading',$this->input->post('live_classes_heading'));

			$this->Preferences_model->update('live_classes_title',$this->input->post('live_classes_title'));

			$this->Preferences_model->update('live_classes_desc',$this->input->post('live_classes_desc'));

			$this->Preferences_model->update('live_classes_title_2',$this->input->post('live_classes_title_2'));

			$this->Preferences_model->update('live_classes_desc_2',$this->input->post('live_classes_desc_2'));

			$this->Preferences_model->update('live_classes_title_3',$this->input->post('live_classes_title_3'));

			$this->Preferences_model->update('live_classes_desc_3',$this->input->post('live_classes_desc_3'));

			$this->Preferences_model->update('live_title_2',$this->input->post('live_title_2'));

			$this->Preferences_model->update('live_desc_2',$this->input->post('live_desc_2'));

			$this->Preferences_model->update('journal_title',$this->input->post('journal_title'));

			$this->Preferences_model->update('journal_desc',$this->input->post('journal_desc'));

			$this->Preferences_model->update('yoga_rituals_title',$this->input->post('yoga_rituals_title'));

			$this->Preferences_model->update('yoga_rituals_desc',$this->input->post('yoga_rituals_desc'));

			$this->Preferences_model->update('dubai_studio_title',$this->input->post('dubai_studio_title'));

			$this->Preferences_model->update('dubai_studio_desc',$this->input->post('dubai_studio_desc'));

			$this->Preferences_model->update('about_title',$this->input->post('about_title'));

			$this->Preferences_model->update('about_desc',$this->input->post('about_desc'));

			$this->Preferences_model->update('about_details',$this->input->post('about_details'));

			$this->Preferences_model->update('about_practice_title',$this->input->post('about_practice_title'));

			$this->Preferences_model->update('about_title_2',$this->input->post('about_title_2'));

			$this->Preferences_model->update('about_desc_2',$this->input->post('about_desc_2'));

			$this->Preferences_model->update('privacy_terms_desc',$this->input->post('privacy_terms_desc'));

			$this->Preferences_model->update('connect_title',$this->input->post('connect_title'));

			$this->Preferences_model->update('private_title',$this->input->post('private_title'));

			$this->Preferences_model->update('private_desc',$this->input->post('private_desc'));

			$this->Preferences_model->update('private_title_2',$this->input->post('private_title_2'));

			$this->Preferences_model->update('private_desc_2',$this->input->post('private_desc_2'));

			$this->Preferences_model->update('private_title_3',$this->input->post('private_title_3'));

			$this->Preferences_model->update('private_desc_3',$this->input->post('private_desc_3'));

			$this->Preferences_model->update('membership_heading',$this->input->post('membership_heading'));

			$this->Preferences_model->update('membership_desc',$this->input->post('membership_desc'));

			$this->Preferences_model->update('membership_heading_2',$this->input->post('membership_heading_2'));

			$this->Preferences_model->update('membership_desc_2',$this->input->post('membership_desc_2'));

			$this->Preferences_model->update('membership_heading_3',$this->input->post('membership_heading_3'));

			$this->Preferences_model->update('membership_desc_3',$this->input->post('membership_desc_3'));

			$this->Preferences_model->update('membership_heading_4',$this->input->post('membership_heading_4'));

			$this->Preferences_model->update('membership_desc_4',$this->input->post('membership_desc_4'));







			$this->Preferences_model->update('dubai_studio_title_2',$this->input->post('dubai_studio_title_2'));

			$this->Preferences_model->update('dubai_studio_title_3',$this->input->post('dubai_studio_title_3'));

			$this->Preferences_model->update('dubai_studio_table_title_1',$this->input->post('dubai_studio_table_title_1'));

			$this->Preferences_model->update('dubai_studio_table_desc_1',$this->input->post('dubai_studio_table_desc_1'));

			$this->Preferences_model->update('dubai_studio_table_title_2',$this->input->post('dubai_studio_table_title_2'));

			$this->Preferences_model->update('dubai_studio_table_desc_2',$this->input->post('dubai_studio_table_desc_2'));

			$this->Preferences_model->update('dubai_studio_table_title_3',$this->input->post('dubai_studio_table_title_3'));

			$this->Preferences_model->update('dubai_studio_table_desc_3',$this->input->post('dubai_studio_table_desc_3'));

			$this->Preferences_model->update('post_detail_heading',$this->input->post('post_detail_heading'));

			$this->Preferences_model->update('post_detail_desc',$this->input->post('post_detail_desc'));

			$this->Preferences_model->update('user_account_heading',$this->input->post('user_account_heading'));

			$this->Preferences_model->update('user_account_desc',$this->input->post('user_account_desc'));

			$this->Preferences_model->update('thank_you_heading',$this->input->post('thank_you_heading'));

			$this->Preferences_model->update('thank_you_desc',$this->input->post('thank_you_desc'));

			$this->Preferences_model->update('retreats_thanks_heading',$this->input->post('retreats_thanks_heading'));

			$this->Preferences_model->update('retreats_thanks_desc',$this->input->post('retreats_thanks_desc'));

			$this->Preferences_model->update('posts_title',$this->input->post('posts_title'));

			$this->Preferences_model->update('posts_desc',$this->input->post('posts_desc'));

			$this->Preferences_model->update('posts_title_2',$this->input->post('posts_title_2'));

			$this->Preferences_model->update('trial_heading',$this->input->post('trial_heading'));



			/*

			$this->Preferences_model->update('des_services_solution',$this->input->post('des_services_solution'));

			$this->Preferences_model->update('product_section',$this->input->post('product_section'));

			$this->Preferences_model->update('des_product_section',$this->input->post('des_product_section'));

			$this->Preferences_model->update('success_stories',$this->input->post('success_stories'));

			$this->Preferences_model->update('des_success_stories',$this->input->post('des_success_stories'));

			$this->Preferences_model->update('product_page',$this->input->post('product_page'));

			$this->Preferences_model->update('des_product_page',$this->input->post('des_product_page'));

			$this->Preferences_model->update('story_tittle',$this->input->post('story_tittle'));

			$this->Preferences_model->update('story_hed',$this->input->post('story_hed'));

			$this->Preferences_model->update('story_des',$this->input->post('story_des'));

			$this->Preferences_model->update('home_hed_1',$this->input->post('home_hed_1'));

			$this->Preferences_model->update('home_hed_2',$this->input->post('home_hed_2'));

			$this->Preferences_model->update('home_hed_3',$this->input->post('home_hed_3'));

			$this->Preferences_model->update('home_hed_4',$this->input->post('home_hed_4'));

			$this->Preferences_model->update('home_1',$this->input->post('home_1'));

			$this->Preferences_model->update('home_2',$this->input->post('home_2'));

			$this->Preferences_model->update('home_3',$this->input->post('home_3'));

			$this->Preferences_model->update('home_4',$this->input->post('home_4'));

			$this->Preferences_model->update('home_1_link',$this->input->post('home_1_link'));

			$this->Preferences_model->update('home_2_link',$this->input->post('home_2_link'));

			$this->Preferences_model->update('home_3_link',$this->input->post('home_3_link'));

			$this->Preferences_model->update('home_4_link',$this->input->post('home_4_link'));*/

			$this->Preferences_model->update('home_page_video_link',$this->input->post('home_page_video_link'));

			$this->Preferences_model->update('twitter_link',$this->input->post('twitter_link'));

			$this->Preferences_model->update('linkedin_link',$this->input->post('linkedin_link'));

			$this->Preferences_model->update('insta_link',$this->input->post('insta_link'));

			$this->Preferences_model->update('youtube_link',$this->input->post('youtube_link'));

			$this->Preferences_model->update('spotify_link',$this->input->post('spotify_link'));

			$this->Preferences_model->update('play_store',$this->input->post('play_store'));

			$this->Preferences_model->update('app_store',$this->input->post('app_store'));

			$this->Preferences_model->update('num',$this->input->post('num'));

			$this->Preferences_model->update('footer_copyright',$this->input->post('footer_copyright'));

			$this->Preferences_model->update('footer_text',$this->input->post('footer_text'));

			$this->Preferences_model->update('site_by_link',$this->input->post('site_by_link'));

			$this->Preferences_model->update('site_by',$this->input->post('site_by'));

			$this->Preferences_model->update('header_content',$this->input->post('header_content'));

			
			if(isset($_FILES['main_banner_picture']) and $_FILES['main_banner_picture']['name']!=''){

				$heading1_picture= time()."home1".$_FILES['main_banner_picture']['name'];

				$returnValue = $this->Common_model->uploadFile2($heading1_picture,'main_banner_picture','uploads/slider/');

				if($returnValue) {

					$this->Preferences_model->update('main_banner_picture',$returnValue);

				}

			}


			if(isset($_FILES['home_back_pic']) and $_FILES['home_back_pic']['name']!=''){

				$heading1_picture= time()."home1".$_FILES['home_back_pic']['name'];

				$returnValue = $this->Common_model->uploadFile2($heading1_picture,'home_back_pic','uploads/slider/');

				if($returnValue) {

					$this->Preferences_model->update('home_back_pic',$returnValue);

				}

			}

			if(isset($_FILES['logo_picture']) and $_FILES['logo_picture']['name']!=''){

				$heading1_picture= time()."home1".$_FILES['logo_picture']['name'];

				$returnValue = $this->Common_model->uploadFile2($heading1_picture,'logo_picture','uploads/slider/');

				if($returnValue) {

					$this->Preferences_model->update('logo_picture',$returnValue);

				}

			}

			if(isset($_FILES['picture_2']) and $_FILES['picture_2']['name']!=''){

				$heading1_picture= time()."home1".$_FILES['picture_2']['name'];

				$returnValue = $this->Common_model->uploadFile2($heading1_picture,'picture_2','uploads/slider/');

				if($returnValue) {

					$this->Preferences_model->update('picture_2',$returnValue);

				}

			}



			if(isset($_FILES['picture_1']) and $_FILES['picture_1']['name']!=''){

				$heading1_picture= time()."home1".$_FILES['picture_1']['name'];

				$returnValue = $this->Common_model->uploadFile2($heading1_picture,'picture_1','uploads/slider/');

				if($returnValue) {

					$this->Preferences_model->update('picture_1',$returnValue);

				}

			}

			if(isset($_FILES['picture_2']) and $_FILES['picture_2']['name']!=''){

				$heading1_picture= time()."home1".$_FILES['picture_2']['name'];

				$returnValue = $this->Common_model->uploadFile2($heading1_picture,'picture_2','uploads/slider/');

				if($returnValue) {

					$this->Preferences_model->update('picture_2',$returnValue);

				}

			}





			if(isset($_FILES['picture_about']) and $_FILES['picture_about']['name']!=''){

				$heading1_picture= time()."home1".$_FILES['picture_about']['name'];

				$returnValue = $this->Common_model->uploadFile2($heading1_picture,'picture_about','uploads/slider/');

				if($returnValue) {

					$this->Preferences_model->update('picture_about',$returnValue);

				}

			}

			if(isset($_FILES['picture_about_2']) and $_FILES['picture_about_2']['name']!=''){

				$heading1_picture= time()."home1".$_FILES['picture_about_2']['name'];

				$returnValue = $this->Common_model->uploadFile2($heading1_picture,'picture_about_2','uploads/slider/');

				if($returnValue) {

					$this->Preferences_model->update('picture_about_2',$returnValue);

				}

			}

			if(isset($_FILES['picture_private']) and $_FILES['picture_private']['name']!=''){

				$heading1_picture= time()."home1".$_FILES['picture_private']['name'];

				$returnValue = $this->Common_model->uploadFile2($heading1_picture,'picture_private','uploads/slider/');

				if($returnValue) {

					$this->Preferences_model->update('picture_private',$returnValue);

				}

			}

			if(isset($_FILES['picture_private_2']) and $_FILES['picture_private_2']['name']!=''){

				$heading1_picture= time()."home1".$_FILES['picture_private_2']['name'];

				$returnValue = $this->Common_model->uploadFile2($heading1_picture,'picture_private_2','uploads/slider/');

				if($returnValue) {

					$this->Preferences_model->update('picture_private_2',$returnValue);

				}

			}

			if(isset($_FILES['picture_membership']) and $_FILES['picture_membership']['name']!=''){

				$heading1_picture= time()."home1".$_FILES['picture_membership']['name'];

				$returnValue = $this->Common_model->uploadFile2($heading1_picture,'picture_membership','uploads/slider/');

				if($returnValue) {

					$this->Preferences_model->update('picture_membership',$returnValue);

				}

			}

			if(isset($_FILES['picture_membership_1']) and $_FILES['picture_membership_1']['name']!=''){

				$heading1_picture= time()."home1".$_FILES['picture_membership_1']['name'];

				$returnValue = $this->Common_model->uploadFile2($heading1_picture,'picture_membership_1','uploads/slider/');

				if($returnValue) {

					$this->Preferences_model->update('picture_membership_1',$returnValue);

				}

			}

			if(isset($_FILES['picture_classes']) and $_FILES['picture_classes']['name']!=''){

				$heading1_picture= time()."home1".$_FILES['picture_classes']['name'];

				$returnValue = $this->Common_model->uploadFile2($heading1_picture,'picture_classes','uploads/slider/');

				if($returnValue) {

					$this->Preferences_model->update('picture_classes',$returnValue);

				}

			}

			if(isset($_FILES['picture_classes_2']) and $_FILES['picture_classes_2']['name']!=''){

				$heading1_picture= time()."home1".$_FILES['picture_classes_2']['name'];

				$returnValue = $this->Common_model->uploadFile2($heading1_picture,'picture_classes_2','uploads/slider/');

				if($returnValue) {

					$this->Preferences_model->update('picture_classes_2',$returnValue);

				}

			}

			if(isset($_FILES['picture_table']) and $_FILES['picture_table']['name']!=''){

				$heading1_picture= time()."home1".$_FILES['picture_table']['name'];

				$returnValue = $this->Common_model->uploadFile2($heading1_picture,'picture_table','uploads/slider/');

				if($returnValue) {

					$this->Preferences_model->update('picture_table',$returnValue);

				}

			}

			if(isset($_FILES['header_picture']) and $_FILES['header_picture']['name']!=''){

				$heading1_picture= time()."home1".$_FILES['header_picture']['name'];

				$returnValue = $this->Common_model->uploadFile2($heading1_picture,'header_picture','uploads/slider/');

				if($returnValue) {

					$this->Preferences_model->update('header_picture',$returnValue);

				}

			}

			if(isset($_FILES['picture_posts']) and $_FILES['picture_posts']['name']!=''){

				$heading1_picture= time()."home1".$_FILES['picture_posts']['name'];

				$returnValue = $this->Common_model->uploadFile2($heading1_picture,'picture_posts','uploads/slider/');

				if($returnValue) {

					$this->Preferences_model->update('picture_posts',$returnValue);

				}

			}









			if(isset($_FILES['about_hover_picture']) and $_FILES['about_hover_picture']['name']!=''){

				$heading1_picture= time()."home1".$_FILES['about_hover_picture']['name'];

				$returnValue = $this->Common_model->uploadFile2($heading1_picture,'about_hover_picture','uploads/slider/');

				if($returnValue) {

					$this->Preferences_model->update('about_hover_picture',$returnValue);

				}

			}

			if(isset($_FILES['classes_hover_picture']) and $_FILES['classes_hover_picture']['name']!=''){

				$heading1_picture= time()."home1".$_FILES['classes_hover_picture']['name'];

				$returnValue = $this->Common_model->uploadFile2($heading1_picture,'classes_hover_picture','uploads/slider/');

				if($returnValue) {

					$this->Preferences_model->update('classes_hover_picture',$returnValue);

				}

			}

			if(isset($_FILES['membership_hover_picture']) and $_FILES['membership_hover_picture']['name']!=''){

				$heading1_picture= time()."home1".$_FILES['membership_hover_picture']['name'];

				$returnValue = $this->Common_model->uploadFile2($heading1_picture,'membership_hover_picture','uploads/slider/');

				if($returnValue) {

					$this->Preferences_model->update('membership_hover_picture',$returnValue);

				}

			}

			if(isset($_FILES['retreats_hover_picture']) and $_FILES['retreats_hover_picture']['name']!=''){

				$heading1_picture= time()."home1".$_FILES['retreats_hover_picture']['name'];

				$returnValue = $this->Common_model->uploadFile2($heading1_picture,'retreats_hover_picture','uploads/slider/');

				if($returnValue) {

					$this->Preferences_model->update('retreats_hover_picture',$returnValue);

				}

			}

			if(isset($_FILES['mentorship_hover_picture']) and $_FILES['mentorship_hover_picture']['name']!=''){

				$heading1_picture= time()."home1".$_FILES['mentorship_hover_picture']['name'];

				$returnValue = $this->Common_model->uploadFile2($heading1_picture,'mentorship_hover_picture','uploads/slider/');

				if($returnValue) {

					$this->Preferences_model->update('mentorship_hover_picture',$returnValue);

				}

			}


			if(isset($_FILES['picture_contact']) and $_FILES['picture_contact']['name']!=''){

				$heading1_picture= time()."home1".$_FILES['picture_contact']['name'];

				$returnValue = $this->Common_model->uploadFile2($heading1_picture,'picture_contact','uploads/slider/');

				if($returnValue) {

					$this->Preferences_model->update('picture_contact',$returnValue);

				}

			}

			

		

			

			$language = $this->Common_model->get_all_languages();



			/*foreach ($language as $key => $v) {

				$this->Preferences_model->update('menu_item_1_'.$v->name,$this->input->post('menu_item_1_'.$v->name));

				$this->Preferences_model->update('terms_'.$v->name,$this->input->post('terms_'.$v->name));

				$this->Preferences_model->update('menu_item_2_'.$v->name,$this->input->post('menu_item_2_'.$v->name));

				$this->Preferences_model->update('menu_item_3_'.$v->name,$this->input->post('menu_item_3_'.$v->name));

				$this->Preferences_model->update('menu_item_4_'.$v->name,$this->input->post('menu_item_4_'.$v->name));

				$this->Preferences_model->update('menu_item_5_'.$v->name,$this->input->post('menu_item_5_'.$v->name));

				$this->Preferences_model->update('menu_item_6_'.$v->name,$this->input->post('menu_item_6_'.$v->name));

				

				$this->Preferences_model->update('heading_1_'.$v->name,$this->input->post('heading_1_'.$v->name));

				$this->Preferences_model->update('about_1_'.$v->name,$this->input->post('about_1_'.$v->name));

				$this->Preferences_model->update('junk_link_'.$v->name,$this->input->post('junk_link_'.$v->name));

				$this->Preferences_model->update('franchize_link_'.$v->name,$this->input->post('franchize_link_'.$v->name));

				$this->Preferences_model->update('about_2_'.$v->name,$this->input->post('about_2_'.$v->name));

				$this->Preferences_model->update('heading_2_'.$v->name,$this->input->post('heading_2_'.$v->name));

				$this->Preferences_model->update('heading_3_'.$v->name,$this->input->post('heading_3_'.$v->name));

				$this->Preferences_model->update('junk_tittle_'.$v->name,$this->input->post('junk_tittle_'.$v->name));

				$this->Preferences_model->update('franchize_tittle_'.$v->name,$this->input->post('franchize_tittle_'.$v->name));

				$this->Preferences_model->update('junk_heading_1_'.$v->name,$this->input->post('junk_heading_1_'.$v->name));

				$this->Preferences_model->update('group_heading_1_'.$v->name,$this->input->post('group_heading_1_'.$v->name));

				$this->Preferences_model->update('group_heading_2_'.$v->name,$this->input->post('group_heading_2_'.$v->name));

				$this->Preferences_model->update('group_heading_3_'.$v->name,$this->input->post('group_heading_3_'.$v->name));

				$this->Preferences_model->update('group_heading_4_'.$v->name,$this->input->post('group_heading_4_'.$v->name));

				$this->Preferences_model->update('group_heading_5_'.$v->name,$this->input->post('group_heading_5_'.$v->name));

				$this->Preferences_model->update('group_heading_6_'.$v->name,$this->input->post('group_heading_6_'.$v->name));

				$this->Preferences_model->update('group_heading_7_'.$v->name,$this->input->post('group_heading_7_'.$v->name));

				$this->Preferences_model->update('group_heading_8_'.$v->name,$this->input->post('group_heading_8_'.$v->name));

				$this->Preferences_model->update('group_heading_9_'.$v->name,$this->input->post('group_heading_9_'.$v->name));

				$this->Preferences_model->update('group_heading_10_'.$v->name,$this->input->post('group_heading_10_'.$v->name));

				$this->Preferences_model->update('group_heading_11_'.$v->name,$this->input->post('group_heading_11_'.$v->name));

				$this->Preferences_model->update('group_heading_13_'.$v->name,$this->input->post('group_heading_13_'.$v->name));

				$this->Preferences_model->update('group_heading_12_'.$v->name,$this->input->post('group_heading_12_'.$v->name));

				$this->Preferences_model->update('franchize_heading_1_'.$v->name,$this->input->post('franchize_heading_1_'.$v->name));

				$this->Preferences_model->update('junk_heading_2_'.$v->name,$this->input->post('junk_heading_2_'.$v->name));

				$this->Preferences_model->update('franchize_heading_2_'.$v->name,$this->input->post('franchize_heading_2_'.$v->name));

				$this->Preferences_model->update('about_video'.$v->name,$this->input->post('about_video'.$v->name));

				$this->Preferences_model->update('heading_2_description_'.$v->name,$this->input->post('heading_2_description_'.$v->name));

				$this->Preferences_model->update('junk_heading_1_description_'.$v->name,$this->input->post('junk_heading_1_description_'.$v->name));

				$this->Preferences_model->update('group_heading_1_description_'.$v->name,$this->input->post('group_heading_1_description_'.$v->name));

				$this->Preferences_model->update('group_heading_2_description_'.$v->name,$this->input->post('group_heading_2_description_'.$v->name));

				$this->Preferences_model->update('franchize_heading_1_description_'.$v->name,$this->input->post('franchize_heading_1_description_'.$v->name));

				$this->Preferences_model->update('junk_heading_2_description_'.$v->name,$this->input->post('junk_heading_2_description_'.$v->name));

				$this->Preferences_model->update('franchize_heading_2_description_'.$v->name,$this->input->post('franchize_heading_2_description_'.$v->name));

				$this->Preferences_model->update('about_1_description_'.$v->name,$this->input->post('about_1_description_'.$v->name));

				$this->Preferences_model->update('junk_1_description_'.$v->name,$this->input->post('junk_1_description_'.$v->name));

				$this->Preferences_model->update('about_2_description_'.$v->name,$this->input->post('about_2_description_'.$v->name));

				$this->Preferences_model->update('heading_1_button_'.$v->name,$this->input->post('heading_1_button_'.$v->name));

				$this->Preferences_model->update('heading_2_button_'.$v->name,$this->input->post('heading_2_button_'.$v->name));

				$this->Preferences_model->update('heading_3_button_'.$v->name,$this->input->post('heading_3_button_'.$v->name));

				$this->Preferences_model->update('heading_1_link_'.$v->name,$this->input->post('heading_1_link_'.$v->name));

				$this->Preferences_model->update('heading_2_link_'.$v->name,$this->input->post('heading_2_link_'.$v->name));

				$this->Preferences_model->update('heading_3_link_'.$v->name,$this->input->post('heading_3_link_'.$v->name));

				$this->Preferences_model->update('contactus_title_'.$v->name,$this->input->post('contactus_title_'.$v->name));

				$this->Preferences_model->update('contactus_description_'.$v->name,$this->input->post('contactus_description_'.$v->name));

				$this->Preferences_model->update('signup_login_button_'.$v->name,$this->input->post('signup_login_button_'.$v->name));

				$this->Preferences_model->update('register_page_title_'.$v->name,$this->input->post('register_page_title_'.$v->name));

				$this->Preferences_model->update('register_page_note_'.$v->name,$this->input->post('register_page_note_'.$v->name));

				$this->Preferences_model->update('login_page_title_'.$v->name,$this->input->post('login_page_title_'.$v->name));

				$this->Preferences_model->update('forgot_password_title_'.$v->name,$this->input->post('forgot_password_title_'.$v->name));

				$this->Preferences_model->update('login_page_note_'.$v->name,$this->input->post('login_page_note_'.$v->name));

				$this->Preferences_model->update('register_here_title_'.$v->name,$this->input->post('register_here_title_'.$v->name));

				

			}*/			

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



			redirect('admin/Preferences?msg=Added Successfully');

		}

        $data['picture']     	    		=  $this->Preferences_model->getValue('picture');

        $data['picture_1']     	    		=  $this->Preferences_model->getValue('picture_1');

        $data['picture_2']     	    		=  $this->Preferences_model->getValue('picture_2');

        $data['picture_about']     	    	=  $this->Preferences_model->getValue('picture_about');

        $data['picture_about_2']     	    =  $this->Preferences_model->getValue('picture_about_2');

        $data['picture_private']     	    =  $this->Preferences_model->getValue('picture_private');

        $data['picture_membership']     	=  $this->Preferences_model->getValue('picture_membership');

        $data['picture_membership_1']     	=  $this->Preferences_model->getValue('picture_membership_1');

        $data['picture_classes']     	    =  $this->Preferences_model->getValue('picture_classes');

        $data['picture_classes_2']     	    =  $this->Preferences_model->getValue('picture_classes_2');

        $data['picture_table']     	    	=  $this->Preferences_model->getValue('picture_table');

        $data['header_picture']     	    =  $this->Preferences_model->getValue('header_picture');

        $data['picture_posts']     	    	=  $this->Preferences_model->getValue('picture_posts');

        $data['home_back_pic']     	    	=  $this->Preferences_model->getValue('home_back_pic');
        
        $data['main_banner_picture']     	    	=  $this->Preferences_model->getValue('main_banner_picture');





        $data['about_hover_picture']     	    	=  $this->Preferences_model->getValue('about_hover_picture');

        $data['classes_hover_picture']     	    	=  $this->Preferences_model->getValue('classes_hover_picture');

        $data['membership_hover_picture']     	    	=  $this->Preferences_model->getValue('membership_hover_picture');

        $data['retreats_hover_picture']     	    	=  $this->Preferences_model->getValue('retreats_hover_picture');

        $data['mentorship_hover_picture']     	    	=  $this->Preferences_model->getValue('mentorship_hover_picture');

        $data['picture_contact']     	    	=  $this->Preferences_model->getValue('picture_contact');



/*icons*/



		$data['logo_picture']     	    	=  $this->Preferences_model->getValue('logo_picture');

		$data['email']         				=  $this->Preferences_model->getValue('email');

		$data['email2']         			=  $this->Preferences_model->getValue('email2');

		$data['telephone']         			=  $this->Preferences_model->getValue('telephone');

		$data['address']       				=  $this->Preferences_model->getValue('address');

		$data['facebook_link']      		=  $this->Preferences_model->getValue('facebook_link');

        $data['map']      					=  $this->Preferences_model->getValue('map');/*



        $data['des_services_page_2']      	=  $this->Preferences_model->getValue('des_services_page_2');

        $data['des_services_page']      	=  $this->Preferences_model->getValue('des_services_page');

        $data['services_page_2']      	=  $this->Preferences_model->getValue('services_page_2');

        $data['services_page']      	=  $this->Preferences_model->getValue('services_page_2');

		$data['services_solution']      	=  $this->Preferences_model->getValue('services_solution');

		$data['public_sector']      	=  $this->Preferences_model->getValue('public_sector');

		$data['industry_detail']      	=  $this->Preferences_model->getValue('industry_detail');

		$data['industry']      	=  $this->Preferences_model->getValue('industry');

		$data['pic1']      	=  $this->Preferences_model->getValue('pic1');

		$data['sic_naice']      	=  $this->Preferences_model->getValue('sic_naice');

		$data['sic_naice_detail']      	=  $this->Preferences_model->getValue('sic_naice_detail');

		$data['service_sol_para']      	=  $this->Preferences_model->getValue('service_sol_para');

		$data['alert_detail']      	=  $this->Preferences_model->getValue('alert_detail');

		$data['alert']      	=  $this->Preferences_model->getValue('alert');*/

		$data['newsletter_title']      		=  $this->Preferences_model->getValue('newsletter_title');

		$data['newsletter_desc']      		=  $this->Preferences_model->getValue('newsletter_desc');

		$data['video_link']      			=  $this->Preferences_model->getValue('video_link');

		$data['video_link_1']      			=  $this->Preferences_model->getValue('video_link_1');

		$data['video_link_2']      			=  $this->Preferences_model->getValue('video_link_2');

		$data['title_home_english']      	=  $this->Preferences_model->getValue('title_home_english');

		$data['description_home_english']   =  $this->Preferences_model->getValue('description_home_english');

		$data['heading_second_english']     =  $this->Preferences_model->getValue('heading_second_english');

		$data['description_second_english'] =  $this->Preferences_model->getValue('description_second_english');

		$data['second_heading_english']     =  $this->Preferences_model->getValue('second_heading_english');

		$data['paragraph_english']      	=  $this->Preferences_model->getValue('paragraph_english');

		$data['about_title']      			=  $this->Preferences_model->getValue('about_title');

		$data['about_desc']      			=  $this->Preferences_model->getValue('about_desc');

		$data['about_details']      		=  $this->Preferences_model->getValue('about_details');

		$data['about_practice_title']      	=  $this->Preferences_model->getValue('about_practice_title');

		$data['about_title_2']      		=  $this->Preferences_model->getValue('about_title_2');

		$data['about_desc_2']      			=  $this->Preferences_model->getValue('about_desc_2');

		$data['privacy_terms_desc']      	=  $this->Preferences_model->getValue('privacy_terms_desc');

		$data['connect_title']      		=  $this->Preferences_model->getValue('connect_title');

		$data['private_title']      		=  $this->Preferences_model->getValue('private_title');

		$data['private_desc']      			=  $this->Preferences_model->getValue('private_desc');

		$data['private_title_2']      		=  $this->Preferences_model->getValue('private_title_2');

		$data['private_desc_2']      		=  $this->Preferences_model->getValue('private_desc_2');

		$data['membership_heading']      	=  $this->Preferences_model->getValue('membership_heading');

		$data['membership_desc']      		=  $this->Preferences_model->getValue('membership_desc');

		$data['membership_heading_2']      	=  $this->Preferences_model->getValue('membership_heading_2');

		$data['membership_desc_2']      	=  $this->Preferences_model->getValue('membership_desc_2');

		$data['membership_heading_3']      	=  $this->Preferences_model->getValue('membership_heading_3');

		$data['membership_desc_3']      	=  $this->Preferences_model->getValue('membership_desc_3');

		$data['membership_heading_4']      	=  $this->Preferences_model->getValue('membership_heading_4');

		$data['membership_desc_4']      	=  $this->Preferences_model->getValue('membership_desc_4');





		$data['dubai_studio_title_2']      	=  $this->Preferences_model->getValue('dubai_studio_title_2');

		$data['dubai_studio_title_3']      	=  $this->Preferences_model->getValue('dubai_studio_title_3');

		$data['dubai_studio_table_title_1'] =  $this->Preferences_model->getValue('dubai_studio_table_title_1');

		$data['dubai_studio_table_desc_1']  =  $this->Preferences_model->getValue('dubai_studio_table_desc_1');

		$data['dubai_studio_table_title_2'] =  $this->Preferences_model->getValue('dubai_studio_table_title_2');

		$data['dubai_studio_table_desc_2']  =  $this->Preferences_model->getValue('dubai_studio_table_desc_2');

		$data['dubai_studio_table_title_3'] =  $this->Preferences_model->getValue('dubai_studio_table_title_3');

		$data['dubai_studio_table_desc_3']  =  $this->Preferences_model->getValue('dubai_studio_table_desc_3');

		$data['post_detail_heading']      	=  $this->Preferences_model->getValue('post_detail_heading');

		$data['post_detail_desc']      		=  $this->Preferences_model->getValue('post_detail_desc');

		$data['user_account_heading']      	=  $this->Preferences_model->getValue('user_account_heading');

		$data['user_account_desc']      	=  $this->Preferences_model->getValue('user_account_desc');

		$data['thank_you_heading']      	=  $this->Preferences_model->getValue('thank_you_heading');

		$data['thank_you_desc']      		=  $this->Preferences_model->getValue('thank_you_desc');

		$data['retreats_thanks_heading']    =  $this->Preferences_model->getValue('retreats_thanks_heading');

		$data['retreats_thanks_desc']      	=  $this->Preferences_model->getValue('retreats_thanks_desc');

		$data['posts_title']      			=  $this->Preferences_model->getValue('posts_title');

		$data['posts_desc']      			=  $this->Preferences_model->getValue('posts_desc');

		$data['posts_title_2']      		=  $this->Preferences_model->getValue('posts_title_2');

		$data['trial_heading']      		=  $this->Preferences_model->getValue('trial_heading');

		$data['home_page_video_link']      		=  $this->Preferences_model->getValue('home_page_video_link');

		$data['private_title_3']      		=  $this->Preferences_model->getValue('private_title_3');

		$data['private_desc_3']      		=  $this->Preferences_model->getValue('private_desc_3');

/*		$data['des_services_solution']      	=  $this->Preferences_model->getValue('des_services_solution');

		$data['product_section']      	=  $this->Preferences_model->getValue('product_section');

		$data['des_product_section']      	=  $this->Preferences_model->getValue('des_product_section');

		$data['success_stories']      	=  $this->Preferences_model->getValue('success_stories');

		$data['des_success_stories']      	=  $this->Preferences_model->getValue('des_success_stories');

		$data['product_page']      	=  $this->Preferences_model->getValue('product_page');

		$data['des_product_page']      	=  $this->Preferences_model->getValue('des_product_page');



		$data['story_tittle']      	=  $this->Preferences_model->getValue('story_tittle');

		$data['home_hed_1']      	=  $this->Preferences_model->getValue('home_hed_1');

		$data['home_hed_2']      	=  $this->Preferences_model->getValue('home_hed_2');

		$data['home_hed_3']      	=  $this->Preferences_model->getValue('home_hed_3');

		$data['home_hed_4']      	=  $this->Preferences_model->getValue('home_hed_4');

		$data['home_1']      	=  $this->Preferences_model->getValue('home_1');

		$data['home_2']      	=  $this->Preferences_model->getValue('home_2');

		$data['home_3']      	=  $this->Preferences_model->getValue('home_3');

		$data['home_4']      	=  $this->Preferences_model->getValue('home_4');

		$data['description']      	=  $this->Preferences_model->getValue('description');



		$data['home_1_link']      	=  $this->Preferences_model->getValue('home_1_link');

		$data['home_2_link']      	=  $this->Preferences_model->getValue('home_2_link');

		$data['home_3_link']      	=  $this->Preferences_model->getValue('home_3_link');

		$data['home_4_link']      	=  $this->Preferences_model->getValue('home_4_link');

		$data['story_hed']      	=  $this->Preferences_model->getValue('story_hed');

		$data['story_des']      	=  $this->Preferences_model->getValue('story_des');*/

		$data['home_page_heading']   		=  $this->Preferences_model->getValue('home_page_heading');
		$data['menue_title']   		=  $this->Preferences_model->getValue('menue_title');
		$data['menue_link']   		=  $this->Preferences_model->getValue('menue_link');

		$data['home_page_desc']   			=  $this->Preferences_model->getValue('home_page_desc');





		$data['about_section_heading']   		=  $this->Preferences_model->getValue('about_section_heading');

		$data['about_section_desc']   			=  $this->Preferences_model->getValue('about_section_desc');

		$data['classes_section_heading']   		=  $this->Preferences_model->getValue('classes_section_heading');

		$data['classes_section_desc']   			=  $this->Preferences_model->getValue('classes_section_desc');

		$data['membership_section_heading']   		=  $this->Preferences_model->getValue('membership_section_heading');

		$data['membership_section_desc']   			=  $this->Preferences_model->getValue('membership_section_desc');

		$data['retreats_section_heading']   		=  $this->Preferences_model->getValue('retreats_section_heading');

		$data['retreats_section_desc']   			=  $this->Preferences_model->getValue('retreats_section_desc');

		$data['mentorship_section_heading']   		=  $this->Preferences_model->getValue('mentorship_section_heading');

		$data['mentorship_section_desc']   			=  $this->Preferences_model->getValue('mentorship_section_desc');



		$data['plans_heading']   		=  $this->Preferences_model->getValue('plans_heading');

		$data['plans_desc']   			=  $this->Preferences_model->getValue('plans_desc');

		$data['home_title']   			=  $this->Preferences_model->getValue('home_title');

		$data['ondemand_heading']   		=  $this->Preferences_model->getValue('ondemand_heading');

		$data['ondemand_desc']   			=  $this->Preferences_model->getValue('ondemand_desc');

		$data['retreats_title']   		=  $this->Preferences_model->getValue('retreats_title');

		$data['retreats_desc']   		=  $this->Preferences_model->getValue('retreats_desc');

		$data['retreats_title_2']   	=  $this->Preferences_model->getValue('retreats_title_2');

		$data['retreats_desc_2']   		=  $this->Preferences_model->getValue('retreats_desc_2');

		$data['live_title']   			=  $this->Preferences_model->getValue('live_title');

		$data['live_desc']   			=  $this->Preferences_model->getValue('live_desc');

		$data['live_classes_title']   	=  $this->Preferences_model->getValue('live_classes_title');

		$data['live_classes_heading']   =  $this->Preferences_model->getValue('live_classes_heading');

		$data['live_classes_desc']   	=  $this->Preferences_model->getValue('live_classes_desc');

		$data['live_classes_title_2']   =  $this->Preferences_model->getValue('live_classes_title_2');

		$data['live_classes_desc_2']   	=  $this->Preferences_model->getValue('live_classes_desc_2');

		$data['live_classes_title_3']   =  $this->Preferences_model->getValue('live_classes_title_3');

		$data['live_classes_desc_3']   	=  $this->Preferences_model->getValue('live_classes_desc_3');

		$data['live_title_2']   		=  $this->Preferences_model->getValue('live_title_2');

		$data['live_desc_2']   			=  $this->Preferences_model->getValue('live_desc_2');

		$data['journal_title']   		=  $this->Preferences_model->getValue('journal_title');

		$data['journal_desc']   		=  $this->Preferences_model->getValue('journal_desc');

		$data['yoga_rituals_title']   	=  $this->Preferences_model->getValue('yoga_rituals_title');

		$data['yoga_rituals_desc']   	=  $this->Preferences_model->getValue('yoga_rituals_desc');

		$data['dubai_studio_title']   	=  $this->Preferences_model->getValue('dubai_studio_title');

		$data['dubai_studio_desc']   	=  $this->Preferences_model->getValue('dubai_studio_desc');

		$data['twitter_link']  			=  $this->Preferences_model->getValue('twitter_link');

		$data['linkedin_link']     	   	=  $this->Preferences_model->getValue('linkedin_link');

		$data['youtube_link']     	   	=  $this->Preferences_model->getValue('youtube_link');

		$data['spotify_link']     	   	=  $this->Preferences_model->getValue('spotify_link');

		$data['insta_link']     	   	=  $this->Preferences_model->getValue('insta_link');

		$data['play_store']     	   	=  $this->Preferences_model->getValue('play_store');

		$data['app_store']     	   		=  $this->Preferences_model->getValue('app_store');

		$data['num']     	   			=  $this->Preferences_model->getValue('num');

		$data['footer_copyright']      	=  $this->Preferences_model->getValue('footer_copyright');

		$data['footer_text']      		=  $this->Preferences_model->getValue('footer_text');

		$data['site_by_link']      		=  $this->Preferences_model->getValue('site_by_link');

		$data['site_by']      			=  $this->Preferences_model->getValue('site_by');

		$data['header_content']     	=  $this->Preferences_model->getValue('header_content');		

		$language = $this->Common_model->get_all_languages();

		/*foreach ($language as $key => $v) {

			$data['menu_item_1_'][$key] =  $this->Preferences_model->getValue('menu_item_1_'.$v->name);

			$data['terms_'][$key] =  $this->Preferences_model->getValue('terms_'.$v->name);

			$data['menu_item_2_'][$key] =  $this->Preferences_model->getValue('menu_item_2_'.$v->name);

			$data['menu_item_3_'][$key] =  $this->Preferences_model->getValue('menu_item_3_'.$v->name);

			$data['menu_item_4_'][$key] =  $this->Preferences_model->getValue('menu_item_4_'.$v->name);

			$data['menu_item_5_'][$key]=  $this->Preferences_model->getValue('menu_item_5_'.$v->name);

			$data['menu_item_6_'][$key] =  $this->Preferences_model->getValue('menu_item_6_'.$v->name);

			

			$data['heading_1_'][$key] =  $this->Preferences_model->getValue('heading_1_'.$v->name);

			$data['about_video'][$key] =  $this->Preferences_model->getValue('about_video'.$v->name);

			$data['about_1_'][$key] =  $this->Preferences_model->getValue('about_1_'.$v->name);

			$data['junk_link_'][$key] =  $this->Preferences_model->getValue('junk_link_'.$v->name);

			$data['franchize_link_'][$key] =  $this->Preferences_model->getValue('franchize_link_'.$v->name);

			$data['about_2_'][$key] =  $this->Preferences_model->getValue('about_2_'.$v->name);

			$data['heading_3_'][$key] =  $this->Preferences_model->getValue('heading_3_'.$v->name);

			$data['junk_tittle_'][$key] =  $this->Preferences_model->getValue('junk_tittle_'.$v->name);

			$data['franchize_tittle_'][$key] =  $this->Preferences_model->getValue('franchize_tittle_'.$v->name);

			$data['junk_heading_1_'][$key] =  $this->Preferences_model->getValue('junk_heading_1_'.$v->name);

			$data['group_heading_1_'][$key] =  $this->Preferences_model->getValue('group_heading_1_'.$v->name);

			$data['group_heading_2_'][$key] =  $this->Preferences_model->getValue('group_heading_2_'.$v->name);

			$data['group_heading_3_'][$key] =  $this->Preferences_model->getValue('group_heading_3_'.$v->name);

			$data['group_heading_4_'][$key] =  $this->Preferences_model->getValue('group_heading_4_'.$v->name);

			$data['group_heading_5_'][$key] =  $this->Preferences_model->getValue('group_heading_5_'.$v->name);

			$data['group_heading_6_'][$key] =  $this->Preferences_model->getValue('group_heading_6_'.$v->name);

			$data['group_heading_7_'][$key] =  $this->Preferences_model->getValue('group_heading_7_'.$v->name);

			$data['group_heading_8_'][$key] =  $this->Preferences_model->getValue('group_heading_8_'.$v->name);

			$data['group_heading_9_'][$key] =  $this->Preferences_model->getValue('group_heading_9_'.$v->name);

			$data['group_heading_10_'][$key] =  $this->Preferences_model->getValue('group_heading_10_'.$v->name);

			$data['group_heading_11_'][$key] =  $this->Preferences_model->getValue('group_heading_11_'.$v->name);

			$data['group_heading_13_'][$key] =  $this->Preferences_model->getValue('group_heading_13_'.$v->name);

			$data['group_heading_12_'][$key] =  $this->Preferences_model->getValue('group_heading_12_'.$v->name);

			$data['franchize_heading_1_'][$key] =  $this->Preferences_model->getValue('franchize_heading_1_'.$v->name);

			$data['junk_heading_2_'][$key] =  $this->Preferences_model->getValue('junk_heading_2_'.$v->name);

			$data['franchize_heading_2_'][$key] =  $this->Preferences_model->getValue('franchize_heading_2_'.$v->name);

			$data['heading_2_description_'][$key] =  $this->Preferences_model->getValue('heading_2_description_'.$v->name);

			$data['junk_heading_1_description_'][$key] =  $this->Preferences_model->getValue('junk_heading_1_description_'.$v->name);

			$data['group_heading_1_description_'][$key] =  $this->Preferences_model->getValue('group_heading_1_description_'.$v->name);

			$data['group_heading_2_description_'][$key] =  $this->Preferences_model->getValue('group_heading_2_description_'.$v->name);

			$data['franchize_heading_1_description_'][$key] =  $this->Preferences_model->getValue('franchize_heading_1_description_'.$v->name);

			$data['junk_heading_2_description_'][$key] =  $this->Preferences_model->getValue('junk_heading_2_description_'.$v->name);

			$data['franchize_heading_2_description_'][$key] =  $this->Preferences_model->getValue('franchize_heading_2_description_'.$v->name);

			$data['about_1_description_'][$key] =  $this->Preferences_model->getValue('about_1_description_'.$v->name);

			$data['junk_1_description_'][$key] =  $this->Preferences_model->getValue('junk_1_description_'.$v->name);

			$data['about_2_description_'][$key] =  $this->Preferences_model->getValue('about_2_description_'.$v->name);

			$data['heading_1_button_'][$key] =  $this->Preferences_model->getValue('heading_1_button_'.$v->name);

			$data['heading_3_button_'][$key] =  $this->Preferences_model->getValue('heading_3_button_'.$v->name);

			$data['heading_1_link_'][$key] =  $this->Preferences_model->getValue('heading_1_link_'.$v->name);

			$data['heading_3_link_'][$key] =  $this->Preferences_model->getValue('heading_3_link_'.$v->name);

			$data['heading_2_'][$key] =  $this->Preferences_model->getValue('heading_2_'.$v->name);

			$data['heading_2_button_'][$key] =  $this->Preferences_model->getValue('heading_2_button_'.$v->name);

			$data['heading_2_link_'][$key] =  $this->Preferences_model->getValue('heading_2_link_'.$v->name);

			$data['contactus_title_'][$key]=  $this->Preferences_model->getValue('contactus_title_'.$v->name);

			$data['contactus_description_'][$key] =  $this->Preferences_model->getValue('contactus_description_'.$v->name);

			$data['signup_login_button_'][$key] =  $this->Preferences_model->getValue('signup_login_button_'.$v->name);

			$data['register_page_title_'][$key] =  $this->Preferences_model->getValue('register_page_title_'.$v->name);

			$data['register_page_note_'][$key] =  $this->Preferences_model->getValue('register_page_note_'.$v->name);	

			$data['login_page_title_'][$key] =  $this->Preferences_model->getValue('login_page_title_'.$v->name);

			$data['forgot_password_title_'][$key] =  $this->Preferences_model->getValue('forgot_password_title_'.$v->name);

			$data['login_page_note_'][$key] =  $this->Preferences_model->getValue('login_page_note_'.$v->name);

			$data['register_here_title_'][$key] =  $this->Preferences_model->getValue('register_here_title_'.$v->name);

		}*/



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

		

		$this->load->view('admin/preferences',$data);

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

?>