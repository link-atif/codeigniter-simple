<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends Common_Controller {
	
	function __construct() {
        parent::__construct();
		$this->load->model('Pages_model');
		$this->load->model('Sliderimages_model');
		$this->load->model('Product_model');
		$this->load->model('Categories_model');
		$this->load->model('Awards_model');
		$this->load->model('Partners_model');
		$this->load->model('Subscription_model');
		$this->load->model('News_model');
		$this->load->model('Faq_model');
		$this->data['header_pages']  = $this->Pages_model->getPagesByType('header','both');
		$this->data['footer_pages']  = $this->Pages_model->getPagesByType('footer','both');
		$this->load->helper('cookie');
    }

	public function index(){
		$data['faqTotal']	  = $this->Faq_model->getFaqTotal();
		$data['faqs']         = $this->Faq_model->getAllFAQ();
		$language = $this->Common_model->get_language_name();
		
		$data['page_title']    		= $this->Preferences_model->getValue('faq_meta_title');
		
		$this->load->view($language.'/Faq',$data);
	}
	
	public function set_language($val){
		$cookie= array(
      		'name'   => 'language',
      		'value'  => $val,
       		'expire' => time()+'86400'*365,
  		);
  		$this->input->set_cookie($cookie);
		redirect(base_url());
	}
}
