<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller
{
	function __construct() {

        parent::__construct();
		$this->load->model('Product_model');
		$this->load->model('Common_model');
		$this->load->library("pagination");
		$this->load->model('Media_model');
		$this->load->model('Modifiergroup_model');
		$this->load->model('Sliderimages_model');
		$this->load->model("Location_model");

		if(!$this->session->userdata('admin_id')) {
			redirect(base_url().'admin/login');
		}
    }
    
	public function index() {
		$arr 		           = array();
        $arr['name']           = $this->input->get('name') ? $this->input->get('name') : '';
		$config 			   = array();
        $config["base_url"]    = base_url() . "admin/products/index";
        $config["total_rows"]  = $this->Product_model->countProductsTotal($arr);
		
		if($this->input->get('per_page')){
			$config["per_page"]    = $this->input->get('per_page');
		}else{
        	$config["per_page"]    = 6;
		}
        $config["uri_segment"] = 4;
		$config['reuse_query_string']   = true;

		$config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';//this is active tab
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$data['products']         = $this->Product_model->getAllProducts($arr,$page,$config["per_page"] );
		$data["links"]         = $this->pagination->create_links();
		$data['page_title']    = 'Products';
		$data['page_heading']  = 'Products';
		$data['branches'] = $this->Location_model->getAllLocation();
 		$data['msg'] = $this->input->get('msg') ? $this->input->get('msg') : '';
		$this->load->view('admin/products',$data);
	}
	
	public function addProduct() {

		$data['page_title']   = 'Add Product';
		$data['page_heading'] = 'Add Product';
		$data['categories'] = $this->Media_model->getAllCategory();		
		if($this->input->post()) {
			$rules = array(
			    array(
                	'field'   => 'product_name_english',
                 	'label'   => 'Name English',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'category',
                 	'label'   => 'Category',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'product_name_arabic',
                 	'label'   => 'Name Arabic',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'picture_main',
                 	'label'   => 'Picture Main',
                 	'rules'   => 'trim|required'
              	),
                array(
                  'field'   => 'picture_add1',
                  'label'   => 'Picture Additional 1',
                  'rules'   => 'trim|required'
                ),
                array(
                  'field'   => 'picture_add2',
                  'label'   => 'Picture Additional 2',
                  'rules'   => 'trim|required'
                ),
                array(
                  'field'   => 'picture_add3',
                  'label'   => 'Picture Additional 3',
                  'rules'   => 'trim|required'
                ),
              	array(
                	'field'   => 'picture_s1',
                 	'label'   => 'picture s1',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'picture_s2',
                 	'label'   => 'picture s2',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'picture_s3',
                 	'label'   => 'picture s3',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'status',
                 	'label'   => 'Status',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'description_arabic',
                 	'label'   => 'Description',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'description_english',
                 	'label'   => 'Description',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'description_sec_arabic',
                 	'label'   => 'Description Second Arabic',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'description_sec_english',
                 	'label'   => 'Description Second English',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'detail_arabic',
                 	'label'   => 'Detail Arabic',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'detail_english',
                 	'label'   => 'Detail English',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'price',
                 	'label'   => 'Price',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'book_an_experience_price',
                 	'label'   => 'Book An Experience',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'quantity',
                 	'label'   => 'Quantity',
                 	'rules'   => 'trim|required'
              	)
            );
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$merchandise = array(
					"sort_order" => $this->input->post('sort_order') ? $this->input->post('sort_order') : 0,
					"picture_main" => $this->input->post('picture_main'),
          "picture_add1" => $this->input->post('picture_add1'),
          "picture_add2" => $this->input->post('picture_add2'),
          "picture_add3" => $this->input->post('picture_add3'),
					"category" => $this->input->post('category'),
					"picture_s1" => $this->input->post('picture_s1'),
					"picture_s2" => $this->input->post('picture_s2'),
					"picture_s3" => $this->input->post('picture_s3'),
					"product_name_english" => $this->input->post('product_name_english'),
					"product_name_english" => $this->input->post('product_name_english'),
					"product_name_arabic" => $this->input->post('product_name_arabic'),
					"book_an_experience_price" => $this->input->post('book_an_experience_price'),
					/*"category_id" => $this->input->post('category_id'),
					"branch_id" => $this->input->post('branch_id'),*/
					/*"modifiergroup_id" => $this->input->post('modifiergroup_id'),*/
					"status" => $this->input->post('status'),
					"description_english" => $this->input->post('description_english'),
					"description_arabic" => $this->input->post('description_arabic'),
					"description_sec_english" => $this->input->post('description_sec_english'),
					"description_sec_arabic" => $this->input->post('description_sec_arabic'),
					"detail_english" => $this->input->post('detail_english'),
					"detail_arabic" => $this->input->post('detail_arabic'),
					"price" => $this->input->post('price'),
					"quantity" => $this->input->post('quantity'),
					"date_modified" => date("Y-m-d"),
					"date_created" => date("Y-m-d")
				);

				/*$new_array = array(
                    "name"          => $this->input->post('name'),
                    "price"         => $this->input->post('price'),
                    "sku"           => $this->input->post('quantity')
                );
				$inventory_data   = $this->curl->postRequest(ADD_INVENTORY_URL,$new_array);
                if(!isset($inventory_data->id)){
                    $this->data['error'] = $inventory_data->message;
                    $this->data['productDetail'] = $_REQUEST;
                }else{
                    $merchandise['clover_id']  = $inventory_data->id;*/
                    $slug = url_title($this->input->post('product_name_english'), 'dash', true);
				$merchandise['slug'] = $slug;
                    $merchandise_id = $this->Product_model->save_product($merchandise);

					if($merchandise_id){
						$this->session->unset_userdata(array('picture_name'));
						redirect('admin/products?msg=Added Successfully');
					}else {
						$data['error']	    = 'Some Error try later';
						$data['productDetail'] = $_REQUEST;
					}
                //}
			}else{
				$data['productDetail'] = $_REQUEST;
			}
		}else {
			$data['productDetail'] = array();
		}
       /* $data['branches'] = $this->Location_model->getAllLocation();
		$data['categories'] = $this->Media_model->getCategories();
		$data['modifiergroups'] = $this->Modifiergroup_model->getAllForDropdown();*/
		$this->load->view('admin/add_product',$data);
	}

	public function editProduct($id) {
		$data['page_title']   = 'Edit Product';
		$data['page_heading'] = 'Edit Product';
		$data['categories'] = $this->Media_model->getAllCategory();
		if($id=='') {
			redirect(base_url()."admin/products?msg=Invalid Request");
		}else{
			$data['productDetail'] = $this->Product_model->get_product_detail_by_id($id);
		}
		if($this->input->post()) {
			$rules = array(
			    array(
                	'field'   => 'product_name_english',
                 	'label'   => 'Name',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'category',
                 	'label'   => 'Category',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'product_name_arabic',
                 	'label'   => 'Name',
                 	'rules'   => 'trim|required'
              	),
              	 array(
                	'field'   => 'description_english',
                 	'label'   => 'Description',
                 	'rules'   => 'trim|required'
              	),
              	 array(
                	'field'   => 'description_english',
                 	'label'   => 'Description',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'description_sec_arabic',
                 	'label'   => 'Description Second Arabic',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'status',
                 	'label'   => 'Status',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'description_sec_english',
                 	'label'   => 'Description Second English',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'detail_arabic',
                 	'label'   => 'Detail Arabic',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'detail_english',
                 	'label'   => 'Detail English',
                 	'rules'   => 'trim|required'
              	),
              	 array(
                	'field'   => 'price',
                 	'label'   => 'Price',
                 	'rules'   => 'trim|required'
              	),
              	array(
                	'field'   => 'book_an_experience_price',
                 	'label'   => 'Book An Experience',
                 	'rules'   => 'trim|required'
              	),
              	 array(
                	'field'   => 'quantity',
                 	'label'   => 'Quantity',
                 	'rules'   => 'trim|required'
              	)
            );
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				if($this->input->post('picture_main')!=''){
					$this->Product_model->deleteimageMain($id);
					$picture_1 = $this->input->post('picture_main');
				}else{
					$picture_1 = $this->input->post('old_main_picture');
				}
        if($this->input->post('picture_add1')!=''){
          $this->Product_model->deleteimageMain($id);
          $picture_add_1 = $this->input->post('picture_add1');
        }else{
          $picture_add_1 = $this->input->post('old_add1_picture');
        }if($this->input->post('picture_add2')!=''){
          $this->Product_model->deleteimageMain($id);
          $picture_add_2 = $this->input->post('picture_add2');
        }else{
          $picture_add_2 = $this->input->post('old_add2_picture');
        }if($this->input->post('picture_add3')!=''){
          $this->Product_model->deleteimageMain($id);
          $picture_add_3 = $this->input->post('picture_add3');
        }else{
          $picture_add_3 = $this->input->post('old_add3_picture');
        }
				if($this->input->post('picture_s1')!=''){
					$this->Product_model->deleteimageS1($id, 'picture_s1');
					$picture_2 = $this->input->post('picture_s1');
				}else{
					$picture_2 = $this->input->post('old_s1_picture');
				}
				if($this->input->post('picture_s2')!=''){
					$this->Product_model->deleteimageS2($id, 'picture_s2');
					$picture_3 = $this->input->post('picture_s2');
				}else{
					$picture_3 = $this->input->post('old_s2_picture');
				}
				if($this->input->post('picture_s3')!=''){
					$this->Product_model->deleteimageS3($id, 'picture_s3');
					$picture_4 = $this->input->post('picture_s3');
				}else{
					$picture_4 = $this->input->post('old_s3_picture');
				}
				$merchandise_id = $this->input->post('merchandise_id');
				$merchandise = array(
					"sort_order" => $this->input->post('sort_order') ? $this->input->post('sort_order') : 0,
					"picture_add1" => $picture_add_1,
          "picture_add2" => $picture_add_2,
          "picture_add3" => $picture_add_3,

          "picture_main" => $picture_1,
					"picture_s1" => $picture_2,
					"picture_s2" => $picture_3,
					"picture_s3" => $picture_4,
					"product_name_english" => $this->input->post('product_name_english'),
					"category" => $this->input->post('category'),
					"product_name_arabic" => $this->input->post('product_name_arabic'),
					"book_an_experience_price" => $this->input->post('book_an_experience_price'),
					/*"category_id" => $this->input->post('category_id'),
					"branch_id" => $this->input->post('branch_id'),*/
					/*"modifiergroup_id" => $this->input->post('modifiergroup_id'),*/
					"status" => $this->input->post('status'),
					"description_english" => $this->input->post('description_english'),
					"description_arabic" => $this->input->post('description_arabic'),
					"description_sec_english" => $this->input->post('description_sec_english'),
					"description_sec_arabic" => $this->input->post('description_sec_arabic'),
					"detail_english" => $this->input->post('detail_english'),
					"detail_arabic" => $this->input->post('detail_arabic'),
					"price" => $this->input->post('price'),
					"quantity" => $this->input->post('quantity'),
					"date_modified" => date("Y-m-d")
				);
				$slug = url_title($this->input->post('product_name_english'), 'dash', true);
				$merchandise['slug'] = $slug;
				/*$new_array = array(
                    "name"          => $this->input->post('product_name'),
                    "price"         => $this->input->post('price'),
                    "sku"           => $this->input->post('quantity')
                );*/

				/*$edit_product_url = str_replace('itemId', $this->input->post('clover_id'), EDIT_INVENTORY_URL);
				$product_data   = $this->curl->postRequest($edit_product_url,$new_array);
				if(!isset($product_data->id)){
                    $this->data['error'] = $product_data->message;
                    $this->data['productDetail'] = $_REQUEST;
                }else{*/

                	$m = $this->Product_model->update_product($merchandise, $id);
                    if($m){
						$this->session->unset_userdata(array('picture_name'));
						redirect('admin/products?msg=Added Successfully');
					}else {
						$data['error']	= 'Some Error try later';
						$data['productDetail'] = $_REQUEST;
					}
				//}
			}else{
				$data['productDetail'] = $_REQUEST;
			}
		}
		$data['modifiergroups'] = $this->Modifiergroup_model->getAllForDropdown();
        $data['branches'] = $this->Location_model->getAllLocation();
		$data['categories'] = $this->Media_model->getCategories();
		$this->load->view('admin/edit_product',$data);
	}
	
	public function deleteProduct() {
		$id = $this->input->get('id');
		//$edit_product_url = str_replace('itemId', $id, DELETE_INVENTORY_URL);
        //$product_data      = $this->curl->deleteRequest($edit_product_url);
		$data['user'] = $this->Product_model->deleteProduct($id);
		redirect(base_url().'admin/products?msg=Deleted Successfully');
	}
public function deleteImage(){


		$id = $this->input->get('id');
		$this->Sliderimages_model->deleteProductsPicture($id);
		redirect(base_url().'admin/products/editProduct/'.$id.'?msg=Deleted Successfully');
		//redirect('admin/products/editProduct/'.$id.'&msg=Image Deleted Successfully');
	}

	public function deleteimageFirst(){
		$id = $this->input->get('id');
		$this->Product_model->deleteimageMain($id);
		redirect('admin/Product/editProduct/'.$id.'?msg=Image Deleted Successfully');
	}


  public function deleteimageAdd1(){
    $id = $this->input->get('id');
    $this->Product_model->deleteimageAddi1($id);
    redirect('admin/Product/editProduct/'.$id.'?msg=Image Deleted Successfully');
  }public function deleteimageAdd2(){
    $id = $this->input->get('id');
    $this->Product_model->deleteimageAddi2($id);
    redirect('admin/Product/editProduct/'.$id.'?msg=Image Deleted Successfully');
  }public function deleteimageAdd3(){
    $id = $this->input->get('id');
    $this->Product_model->deleteimageAddi3($id);
    redirect('admin/Product/editProduct/'.$id.'?msg=Image Deleted Successfully');
  }




	public function deleteimageSecond(){
		$id = $this->input->get('id');
		$this->Product_model->deleteimageS1($id);
		redirect('admin/Product/editProduct/'.$id.'?msg=Image Deleted Successfully');
	}
	public function deleteimageThird(){
		$id = $this->input->get('id');
		$this->Product_model->deleteimageS2($id);
		redirect('admin/Product/editProduct/'.$id.'?msg=Image Deleted Successfully');
	}
	public function deleteimageForth(){
		$id = $this->input->get('id');
		$this->Product_model->deleteimageS3($id);
		redirect('admin/Product/editProduct/'.$id.'?msg=Image Deleted Successfully');
	}
	//old function
	public function uploadAddImage(){
		
		if($this->session->userdata('picture_name')!=''){
			@unlink('uploads/data/'.$this->session->userdata('picture_name'));
		}

		$picture_name = 'product_' . time();
		$path         = 'uploads/slider/';
		$picture_name = $this->Common_model->uploadImageAndResize1($picture_name,$path,1245,699);
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
		$picture_name = $this->Common_model->uploadImageAndResize2($picture_name,$path,251,143);
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

	public function import_products(){
		$branch_id = $this->input->post('branch_id');
		$location = $this->Location_model->getById($branch_id);
        $url = API_URL.$location->merchant_id."/items?expand=modifierGroups,categories&access_token=".$location->api_token; //GET_INVENTORY_URL
        $data = $this->curl->getRequest($url,array());
        if($data != "" && $branch_id > 0){
            foreach($data->elements as $key => $value){
                $categories_array = array("");
                $new_array = array(
                    "branch_id" => $branch_id, 
                    "clover_id" => $value->id,
                    "product_name" => $value->name ? $value->name : "",
                    "category_id" => $value->categories->elements ? $value->categories->elements[0]->id : 0,
                    "modifiergroup_id" => $value->modifierGroups->elements ? $value->modifierGroups->elements[0]->id : 0,
                    "price"  => $value->price ? $value->price : "",
                );

                $this->Product_model->save_products($new_array);
            }
        }
        redirect(base_url('admin/products'));
    }
	
}
