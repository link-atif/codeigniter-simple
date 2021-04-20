<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends Common_Controller {


	function __construct() {

        parent::__construct();
		$this->load->model('Pages_model');
		$this->load->model('Sliderimages_model');
		$this->load->model('Product_model');
		$this->load->model('Categories_model');
		$this->load->model('Gallery_model');
		$this->data['header_pages']  = $this->Pages_model->getPagesByType('header','both');
		$this->data['footer_pages']  = $this->Pages_model->getPagesByType('footer','both');
		$this->load->helper('cookie');
    }

	public function index(){
		$this->data['sliderImages']  = $this->Sliderimages_model->getAllSliderImages();
		$this->data['page_title']    = "Gallery";
		$this->data['page_heading']  = "Gallery";
		
		$this->data['gallery_rows'] = $this->Gallery_model->get_all_gallery();
		
		$language = $this->Common_model->get_language_name();
		$this->load->view($language.'/gallery',$this->data);
	}
	
	
}
