<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends CI_Controller
{
	function __construct() {

        parent::__construct();
		$this->load->model('Pages_model');
		$this->load->model('Common_model');
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
		$this->load->model('Users_model');
		$this->load->model('Preferences_model');
		$this->load->model('Faq_model');
		if(!$this->session->userdata('admin_id')) {
			redirect(base_url().'admin/login');
		}
		
    }
    
	public function index() {
		
		$data['Faqs']         = $this->Faq_model->getAllFAQ();
		$data['page_title']    = 'FAQs';
		$data['page_heading']  = 'FAQs';
		
		$data['msg'] = $this->input->get('msg') ? $this->input->get('msg') : '';
		$this->load->view('admin/Faqs',$data);
	}

	public function addFaq() {
		
		$data['page_title']       = 'Add FAQ';
		$data['page_heading']     = 'Add FAQ';
		//$data['parent_pages']     = $this->Pages_model->getParentPages();
		
		if($this->input->post()) {
			$rules = array(
			    array(
                	'field'   => 'question',
                 	'label'   => 'Question',
                 	'rules'   => 'trim|required'
              	),
              	array(
                     'field'   => 'answer',
                     'label'   => 'Answer',
                     'rules'   => 'trim|required'
                )
            );

			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run()) {
				$array = array(
							"question" 		=> $this->input->post('question'),
							"answer"  		=> $this->input->post('answer'),
						 );
				
				$faq_record			=	$this->Faq_model->save($array);
				if($faq_record) {
					redirect('admin/Faq?msg=Added Successfully');
				}else {
					$data['error']	    = 'Some Error try later';
					$data['FAQDetail'] = $_REQUEST;
				}
				
			}else{
				$data['FAQDetail'] = $_REQUEST;
			}
		}else {
			$data['FAQDetail'] = array();
		}
		$this->load->view('admin/addFAQ',$data);
	}

	public function editFaq() {

		$FAQRow                 = $this->Faq_model->getRow($this->input->get('id'));
		if($FAQRow) {
			$data['FAQDetail']  = $FAQRow;
		}else {
			redirect(base_url()."admin/Faq?msg=Invalid FAQ");
		}
		$data['page_title']       = 'Edit FAQ';
		$data['page_heading']     = 'Edit FAQ';

		if($this->input->post()) {
			$rules = array(
			    array(
                	'field'   => 'question',
                 	'label'   => 'Question',
                 	'rules'   => 'trim|required'
              	),
              	array(
                     'field'   => 'answer',
                     'label'   => 'Answer',
                     'rules'   => 'trim|required'
                )
            );

			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run()) {
				//$packageRow = $this->Packages_model->getRow($this->input->post('package_id'));
				$array = array(
							"question"  	=> $this->input->post('question'),
							"answer"  		=> $this->input->post('answer'),
						 );
				$faq_record	=	$this->Faq_model->update($array,$this->input->post('id'));
				if($faq_record) {
					redirect('admin/Faq?msg=Updated Successfully');
				}else {
					$data['error']	    = 'Some Error try later';
					$data['FAQDetail'] = $_REQUEST;
				}
				
			}else{
				$data['FAQDetail'] = $_REQUEST;
			}
		}

		$this->load->view('admin/edit_FAQ',$data);
	}
	
	public function delete($id) {
		$data['faq'] = $this->Faq_model->delete($id);
		redirect('admin/Faq?msg=Deleted Successfully');
	}
}
