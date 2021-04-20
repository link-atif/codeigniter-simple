<?php

class Coupons_model extends CI_Model
{

  	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->pages = 'pages';
    	$this->pages_description = 'pages_description';
    }
	
	public function save_coupons($data)
	{
		$this->db->insert('coupons',$data);
		return true;
	}

	public function save_page_description($data)
	{
		$this->db->insert_batch($this->pages_description,$data);
		return true;
	}

	public function updateUserPackages($package_id,$amount){

		$arr = array(
					'package_amount' => $amount
				);
		$this->db->where('package_id',$package_id);
 		return $this->db->update('pages', $arr); 
    }

	public function getAllCoupons(){

		$this->db->select('*');
		$this->db->from('coupons');
		$query = $this->db->get();
		if($query->num_rows())
		{
			return $query->result();
		}
		return array();
	}

	public function getPagesByType($type,$both=null){
		$this->db->where('type',$type);
		if($both!=''){
			$this->db->or_where('type',$both);
		}
		$query = $this->db->get('pages');
		if($query->num_rows())
		{
			return $query->result();
		}
		return array();

	}

	public function getParentPages(){
		$this->db->where('parent_id','0');
		$query = $this->db->get('pages');
		if($query->num_rows())
		{
			return $query->result();
		}
		return array();
	}

	public function get_coupons_by_id($id){
		$this->db->select('*');
		$this->db->from('coupons');
		$this->db->where('id',$id);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$row = $query->result_array();
			return $row[0];
		}
		return array();
	}

	public function getRow($id){
		$sSQL   =   $this->db->where("id",$id);
		$query  =   $this->db->get('pages');
		$this->db->last_query();	
		if($query->num_rows())
		{
			$row = $query->result_array();
			return $row[0];
		}
		return array();
	}

	public function getRowBySeoUrl($seourl){
		$sSQL   =   $this->db->where("seo_url",$seourl);
		$query  =   $this->db->get('pages');
		
		if($query->num_rows())
		{
			$row = $query->result_array();
			return $row[0];
		}
		return array("title"=>"","body"=>"");
	}

	
	
	public function update_coupons($data,$id)
	{
		$this->db->where('id',$id);
		$this->db->update('coupons',$data);
		return true;
	}
     public function update_page_description($data,$id){
		$this->db->where('page_id',$id);
		$this->db->update_batch($this->pages_description,$data,'language_id');
		return true;
	}

	
	
	public function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('pages');
	}

	
}
?>
