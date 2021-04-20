<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {


	function __construct() {

        parent::__construct();
    	$this->load->model('Preferences_model');
        $this->load->model('Retreats_model');
        $this->load->model('Live_stream_model');
        $this->load->model('Home_video_model');
    	$this->load->model('Common_model');
    	$this->load->model('Instagram_model');
        $this->load->model('Pages_crud_model');
    	$this->load->model('Testimonials_model');
    	$this->load->model('Sliderimages_model');
    	$this->load->model('Secondslider_model');
    	$this->load->model('Follow_model');
    	$this->load->model('Free_testers_model');
    	$language = $this->Common_model->get_language_name();
    	$this->data['language'] = $language;
    	$this->load->language("access",$language);
    }

	public function index(){
		$this->data['tab_title'] = TAB_TITLE." | About";
        $this->data['page_title'] = "About";
        $this->data['instagram']    = $this->Instagram_model->getInsta();
        $this->data['pages_crud']    = $this->Pages_crud_model->getAllPages_crud();
		$this->load->view('about',$this->data);
	}
}
