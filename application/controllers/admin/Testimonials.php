<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');
class Testimonials extends CI_Controller
{
	function __construct() {
        parent::__construct();
		$this->load->model('Common_model');
		$this->load->model('Pages_model');
		$this->load->model('Registration_model');
		$this->load->model('Subscription_model');
		$this->load->model('Preferences_model');
		$this->load->model('Testimonials_model');
		$this->load->model('Product_model');
		if(!$this->session->userdata('admin_id')) {
			redirect(base_url().'admin/login');
		}
    }
	public function index() {
		$data['testimonials']  = $this->Testimonials_model->getAllTestimonialsAdmin();
		$data['page_title']    = 'Testimonials';
		$data['page_heading']  = 'Testimonials';
		$data['msg'] = $this->input->get('msg') ? $this->input->get('msg') : '';
		$this->load->view('admin/testimonials',$data);
	}
	public function viewTestimonial() {
		$data['testimonials']  = $this->Testimonials_model->getAllTestimonials();
		$data['page_title']    = 'Testimonials';
		$data['page_heading']  = 'Testimonials';
		$data['msg'] = $this->input->get('msg') ? $this->input->get('msg') : '';
		$this->load->view('admin/view_testimonials',$data);
	}
	public function addTestimonials() {
		$data['page_title']       = 'Add Testimonial';
		$data['page_heading']     = 'Add Testimonial';
		$data['products'] = $this->Product_model->getAllProductsTest();
		//$data['parent_pages']     = $this->Pages_model->getParentPages();
		if($this->input->post()) {
			$rules = array(
              	array(
                	'field'   => 'testimonial_page',
                 	'label'   => 'Testimonial Page',
                 	'rules'   => 'trim|required'
              	),
              	array(
                     'field'   => 'testimonial_message',
                     'label'   => 'Testimonial Message',
                     'rules'   => 'trim|required'
                ),
              	array(
                     'field'   => 'name',
                     'label'   => 'Name',
                     'rules'   => 'trim|required'
                )
            );
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$array = array(
						"testimonial_page" 				=> $this->input->post('testimonial_page'),
						"name" 	=> $this->input->post('name'),
						"testimonial_message" 	=> $this->input->post('testimonial_message'),
						 );
				$slug = url_title($this->input->post('product_name_english'), 'dash', true);
				$array['slug'] = $slug;
				$testimonial_record			=	$this->Testimonials_model->save($array);
				if($testimonial_record) {
					redirect('admin/testimonials?msg=Added Successfully');
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
		$this->load->view('admin/add_testimonials',$data);
	}
	public function editTestimonial() {
		$testimonialRow                 = $this->Testimonials_model->getRow($this->input->get('id'));
		$data['products'] = $this->Product_model->getAllProductsTest();
		if($testimonialRow) {
			$data['testimonialDetail']  = $testimonialRow;
		}else {
			redirect(base_url()."admin/testimonials?msg=Invalid Page");
		}
		$data['page_title']       = 'Edit Testimonials';
		$data['page_heading']     = 'Edit Testimonials';
		if($this->input->post()) {
			$rules = array(
              	array(
                	'field'   => 'testimonial_page',
                 	'label'   => 'Testimonial Page',
                 	'rules'   => 'trim|required'
              	),
              	array(
                     'field'   => 'testimonial_message',
                     'label'   => 'Testimonial Message',
                     'rules'   => 'trim|required'
                ),
              	array(
                     'field'   => 'name',
                     'label'   => 'Name',
                     'rules'   => 'trim|required'
                )
            );
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {

				//$packageRow = $this->Packages_model->getRow($this->input->post('package_id'));

				$array = array(
						"testimonial_page" 				=> $this->input->post('testimonial_page'),
						"name" 	=> $this->input->post('name'),
						"testimonial_message" 	=> $this->input->post('testimonial_message'),
				);
				$slug = url_title($this->input->post('product_name_english'), 'dash', true);
				$array['slug'] = $slug;

				$testimonial_record	=	$this->Testimonials_model->update($array,$this->input->post('id'));

				if($testimonial_record) {

					redirect('admin/testimonials?msg=Updated Successfully');

				}else {

					$data['error']	    = 'Some Error try later';

					$data['pageDetail'] = $_REQUEST;

				}

				

			}else{

				$data['pageDetail'] = $_REQUEST;

			}

		}



		$this->load->view('admin/edit_testimonials',$data);

	}



	public function delete($id) {

		$data['testimonials'] = $this->Testimonials_model->delete($id);

		redirect('admin/testimonials?msg=Deleted Successfully');

	}



}

