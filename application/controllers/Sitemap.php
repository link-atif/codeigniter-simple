<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sitemap extends CI_Controller {
	public $home_url;
	public function __construct() {
		parent::__construct();
		
		$this->load->model('Product_model');
		$this->load->model('Blogs_model');
		$this->load->model('Media_model');
	}
	function index(){
		//$all_res = $this->restaurants_model->get_all_reslist();
		//$all_cuisines =$this->admin_model->cuisines_list();
		//$all_deal_restaurants = $this->restaurants_model->get_deal_resturants();
		//$all_postcode_res = $this->restaurants_model->get_unique_postcode_resturants();
		//$all_cities_data =$this->superadmin_model->cities_list();
		$site_url=base_url();
		$posts = $this->Blogs_model->getAll(array("title"=>""));
		$products = $this->Product_model->getAllProducts(array("name"=>""));
		$media_post = $this->Media_model->getAllMediaForSiteMap(array("name"=>""));
		$xml='<?xml version="1.0" encoding="UTF-8"?>';
		$xml.='<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
		$xml.="
		<url>
			<loc>".base_url()."/</loc>
		</url>
		<url>
			<loc>".base_url()."pages/login</loc>
		</url>
		<url>
			<loc>".base_url()."pages/register</loc>	
		</url>
		<url>
			<loc>".base_url()."pages/connect</loc>
		</url>
		<url>
			<loc>".base_url()."pages/about</loc>
		</url>
		<url>
			<loc>".base_url()."pages/search-gift</loc>
		</url>
		<url>
			<loc>".base_url()."pages/book-an-experience</loc>
		</url>
		<url>
			<loc>".base_url()."pages/buy-a-gift</loc>
		</url>
		<url>
			<loc>".base_url()."pages/products</loc>
		</url>
		<url>
			<loc>".base_url()."pages/free-tester</loc>
		</url>
		";
		
		
		foreach($products as $res){
			$xml.="
			<url>
				<loc>".base_url()."products/detail/".$res->slug."?type=booking</loc>
			</url>";
			$xml.="
			<url>
				<loc>".base_url()."products/detail/".$res->slug."?type=</loc>
			</url>";
		}
		
		
		foreach($posts as $res){
			$xml.="
			<url>
				<loc>".base_url()."blog/detail/".$res->slug."</loc>
			</url>";
		}

		foreach($media_post as $res){
			$xml.="
			<url>
				<loc>".base_url()."media/detail/".$res['slug']."</loc>
			</url>";
		}
		
		/*foreach($all_cuisines as $cuisine){
			$xml.="
			<url>
				<loc>".base_url()."restaurants/search?cuisines=".$cuisine['name']."</loc>
			</url>";
		}
		foreach($all_deal_restaurants as $res){
			$xml.="
			<url>
				<loc>".base_url()."restaurant/detail/".$res['seo_url']."</loc>
			</url>";				
		}
		foreach($all_postcode_res as $res){
			$xml.="
			<url>
				<loc>".base_url()."restaurants/search?filter=".$res['postcode']."</loc>
			</url>";				
		}
		
		foreach($all_cities_data as $res){
			$xml.="
			<url>
				<loc>".base_url()."restaurants/search_city/".$res['name']."</loc>
			</url>";				
		}*/
		
		$xml.="
		<url>
			<loc>".base_url()."client/client_login</loc>
		</url>";
		
		$xml.='</urlset>';	
		header("Content-type:text/xml");
		echo $xml;
		
	}
	
	function index2(){
		$data['all_res'] = $this->restaurants_model->get_all_reslist();
		$data['all_cuisines'] =$this->admin_model->cuisines_list();
		$data['all_deal_restaurants'] = $this->restaurants_model->get_deal_resturants();
		$data['all_postcode_res'] = $this->restaurants_model->get_unique_postcode_resturants();
		$data['all_cities_data'] =$this->superadmin_model->cities_list();
		$data['page_title'] = "Site Mape";		
		$data['home_url'] = $this->home_url;
	
		$this->template->load('sitemap',$data);
	}

}