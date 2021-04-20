<?php

ob_start();

defined('BASEPATH') OR exit('No direct script access allowed');



class News extends CI_Controller

{

	function __construct() {



        parent::__construct();

        $this->load->model('Sliderimages_model');

        

        $this->load->model('Common_model');

        $this->load->library('image_lib');

        $this->load->model('Preferences_model');

        global $activity_log_types;

		if($this->session->userdata('admin_id')=='') {

			redirect('admin/login');

		}

    }

    

	public function index() {

		$data['sliderImages']  = $this->Sliderimages_model->getAllNews();

		$data['page_title']    = 'Media';

		$data['page_heading']  = 'Media';

		$data['msg'] 		   = $this->input->get('msg') ? $this->input->get('msg') : '';

		$this->load->view('admin/news',$data);

	}



	public function addNews() {

		

		$data['page_title']   = 'Add Media';

		$data['page_heading'] = 'Add Media';



		

		

		if($this->input->post()) {

			$rules = array(

			    array(

                	'field'   => 'tittle_english',

                 	'label'   => 'Tittle',

                 	'rules'   => 'trim|required'

              	),

              	array(

                     'field'   => 'description_english',

                     'label'   => 'Description',

                     'rules'   => 'trim|required'

                ),

				array(

				    'field'   => 'picture_main',

                 	'label'   => 'picture',

                 	'rules'   => 'trim|required'

                 ),

				array(

				    'field'   => 'picture_s1',

                 	'label'   => 'picture Detail Page',

                 	'rules'   => 'trim|required'

                 ),

                array(

                     'field'   => 'link',

                     'label'   => 'Link'

                ),

                array(

                     'field'   => 'button_text_english',

                     'label'   => 'Button Text'

                ),

                array(

                	'field'   => 'tittle_arabic',

                 	'label'   => 'Tittle',

                 	'rules'   => 'trim|required'

              	),

              	array(

                     'field'   => 'description_arabic',

                     'label'   => 'Description',

                     'rules'   => 'trim|required'

                ),

                array(

                     'field'   => 'button_text_arabic',

                     'label'   => 'Button Text'

                )

            );



			$this->form_validation->set_rules($rules);



			if ($this->form_validation->run()) {

				$slider = array(

					"tittle_english" => $this->input->post('tittle_english'),

					"description_english" => $this->input->post('description_english'),

					"tittle_arabic" => $this->input->post('tittle_arabic'),

					"description_arabic" => $this->input->post('description_arabic'),

					"date_modified" => date("Y-m-d"),

					"date_created" => date("Y-m-d"),

					"picture_main"      		=> $this->input->post('picture_main'),

					"picture_s1"      		=> $this->input->post('picture_s1')

				);

				$slug = url_title($this->input->post('tittle_english'), 'dash', true);

				$slider['slug'] = $slug;

				$slider_id = $this->Sliderimages_model->saveNews($slider);

				

				if($slider_id) {

					$this->session->unset_userdata(array('picture_name'));

					redirect('admin/News?msg=Added Successfully');

				}else {

					$data['error']	    = 'Some Error try later';

					$data['sliderDetail'] = $_REQUEST;

				}

			}else{

				$data['sliderDetail'] = $_REQUEST;

			}

		}else {

			$data['sliderDetail'] = array();

		}

		$data['language'] = $this->Common_model->get_all_languages();

		$this->load->view('admin/add_news',$data);

	}



	public function edit($id) {

		

		$data['page_title']   = 'Edit Media';

		$data['page_heading'] = 'Edit Media';



		if($id=='') {

			redirect(base_url()."admin/News?msg=Invalid image");

		}else{

			$data['sliderDetail'] = $this->Sliderimages_model->getRowNews($id);

		}

		

		if($this->input->post()) {

			$rules = array(

			    array(

                	'field'   => 'tittle_english',

                 	'label'   => 'Tittle',

                 	'rules'   => 'trim|required'

              	),

              	array(

                     'field'   => 'description_english',

                     'label'   => 'Description',

                     'rules'   => 'trim|required'

                ),

                array(

                     'field'   => 'link',

                     'label'   => 'Link'

                ),

                array(

                     'field'   => 'button_text_english',

                     'label'   => 'Button Text'

                ),

                array(

                	'field'   => 'tittle_arabic',

                 	'label'   => 'Tittle',

                 	'rules'   => 'trim|required'

              	),

              	array(

                     'field'   => 'description_arabic',

                     'label'   => 'Description',

                     'rules'   => 'trim|required'

                ),

                array(

                     'field'   => 'button_text_arabic',

                     'label'   => 'Button Text'

                )

            );



			$this->form_validation->set_rules($rules);



			if ($this->form_validation->run()) {

				if($this->input->post('picture_main')!=''){

					$this->Sliderimages_model->deleteimageMain($id);

					$picture_1 = $this->input->post('picture_main');

				}else{

					$picture_1 = $this->input->post('old_main_picture');

				}

				if($this->input->post('picture_s1')!=''){

					$this->Sliderimages_model->deleteimageS1($id, 'picture_s1');

					$picture_2 = $this->input->post('picture_s1');

				}else{

					$picture_2 = $this->input->post('old_s1_picture');

				}

				$slider = array(

					"tittle_english" 		=> $this->input->post('tittle_english'),

					"description_english" 	=> $this->input->post('description_english'),

					"tittle_arabic" 		=> $this->input->post('tittle_arabic'),

					"description_arabic" 	=> $this->input->post('description_arabic'),

					"date_modified" 		=> date("Y-m-d"),

					"picture_main" 			=> $picture_1,

					"picture_s1" 			=> $picture_2

				);

				$slug = url_title($this->input->post('tittle_english'), 'dash', true);

				$slider['slug'] = $slug;

				$slider_id	=	$this->Sliderimages_model->updateNews($slider,$id);

				if($slider_id) {

					$this->session->unset_userdata(array('picture_name'));

					redirect('admin/News?msg=Updated Successfully');

				}else {

					$data['error']	    = 'Some Error try later';

					$data['sliderDetail'] = $_REQUEST;

				}

			}else{

				$data['sliderDetail'] = $_REQUEST;

				}

		}

		$data['language'] = $this->Common_model->get_all_languages();

		$this->load->view('admin/edit_news',$data);

	}

	public function deleteimageFirst(){

		$id = $this->input->get('id');

		$this->Sliderimages_model->deleteimageMain($id);

		redirect('admin/news/edit/'.$id.'?msg=Image Deleted Successfully');

	}

	public function deleteimageSecond(){

		$id = $this->input->get('id');

		$this->Sliderimages_model->deleteimageS1($id);

		redirect('admin/news/edit/'.$id.'?msg=Image Deleted Successfully');

	}



	public function deleteSliderImage(){

		$id = $this->input->get('id');

		$this->Sliderimages_model->deleteNewsFile($id);

		redirect('admin/news/edit/'.$id.'?msg=Image Deleted Successfully');

	}

	

	public function deleteArabicSliderImage(){

		$id = $this->input->get('id');

		$this->Sliderimages_model->deleteArabicSliderFile($id);

		redirect('admin/News/edit/'.$id.'?msg=Image Deleted Successfully');

	}



	public function delete($id){

		

		$this->Sliderimages_model->deleteNews($id);

		redirect('admin/News?msg=Deleted Successfully');

	}



	public function uploadAddImage(){
		if($this->session->userdata('picture_name')!=''){
			@unlink('uploads/data/'.$this->session->userdata('picture_name'));
		}
		$picture_name = 'product_' . time();
		$path         = 'uploads/slider/';
		$picture_name = $this->Sliderimages_model->uploadImageAndResizeMedia($picture_name,$path,355,178);
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
	public function uploadAddImage1(){
		if($this->session->userdata('picture_name')!=''){
			@unlink('uploads/data/'.$this->session->userdata('picture_name'));
		}
		$picture_name = 'product_' . time();
		$path         = 'uploads/slider/';
		$picture_name = $this->Sliderimages_model->uploadImageAndResizeMedia1($picture_name,$path,383,787);
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
	/*public function uploadAddImageArabic(){
		if($this->session->userdata('arabic_picture_name')!=''){
			@unlink('uploads/data/'.$this->session->userdata('arabic_picture_name'));

		}



		$picture_name = 'sliderimage_' . time();

		$path         = 'uploads/data/';

		$picture_name = $this->Common_model->uploadImageAndResize($picture_name,$path,1920,960);

		if ($picture_name){

			$arr            = array('arabic_picture_name' =>  $picture_name);

			$this->session->set_userdata($arr);

			$array = array('error'=>'','arabic_picture_name' => $picture_name);

			echo json_encode($array);

		}else{

			$error = array('error' => strip_tags($this->upload->display_errors()).$this->image_lib->display_errors());

			echo json_encode($error);

		}

	}*/

}