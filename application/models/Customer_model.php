<?php

class Customer_model extends CI_Model
{

  	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	public function save($data)
	{
		$this->db->insert('customers',$data);
		return $data;
	}

	/*public function save_location($data)
	{
		$this->db->insert_batch($this->pages_description,$data);
		return true;
	}*/

	public function updateUserPackages($package_id,$amount){

		$arr = array(
					'package_amount' => $amount
				);
		$this->db->where('package_id',$package_id);
 		return $this->db->update('pages', $arr); 
    }

	public function getAllCustomers(){
		//$this->db->select('customers.*');
		/*$this->db->join($this->pages_description.' md','md.location_id = m.id');
		$this->db->where('md.language_id',1);
		$this->db->from($this->pages.' m');*/
		$query = $this->db->get('customers');
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

	public function get_Customer_by_id($id){
		
		$this->db->where('id',$id);
		$query = $this->db->get('customers');
		if($query->num_rows() > 0){
			return $query->row_array();
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

	
	
	public function update($data,$id)
	{
		$this->db->where('id',$id);
		$this->db->update('customers',$data);
		return true;
	}
     public function update_description($data,$id){
		$this->db->where('id',$id);
		$this->db->update_batch($this->pages_description,$data,'language_id');
		return true;
	}

	
	
	public function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('customers');
	}

	public function deleteDetail($id)
	{
		$this->db->where('location_id', $id);
		$this->db->delete('location_description');
	}	

	
}
?>
