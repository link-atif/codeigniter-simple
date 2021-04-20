<?php

class Contactqueries_model extends CI_Model
{

  	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	public function save($data){
		$this->db->insert('contact_queries',$data);
		return $this->db->insert_id();
	}
    public function save_status($data,$id){
    	$this->db->where('id',$id);
		$this->db->update('orders',$data);
		return true;
	}
     public function get_email($id){
    	$this->db->where('id',$id);
    	$this->db->select('email');
    	$this->db->select('full_name');
    	$this->db->select('status');
		$query = $this->db->get('orders');
		if($query->num_rows())
		{
			return $query->row();
		}
		return array();
	}

	public function getAllQueries(){
		
		$query = $this->db->get('contactus');
		if($query->num_rows())
		{
			return $query->result();
		}
		return array();
	}


	public function getAllusers(){
		
		$query = $this->db->get('users');
		if($query->num_rows())
		{
			return $query->result();
		}
		return array();
	}
    public function getAllOrders($data){
    	//$this->db->limit($limit, $start);
		$this->db->order_by('id','desc');
		if($data['reference']!=''){
			$this->db->like('full_name', $data['reference']);
		}
		$this->db->select('*');
		$query = $this->db->get('orders');
		//$this->db->limit($limit, $start);
		/*$query = $this->db->get('orders');*/
		if($query->num_rows())
		{
			return $query->result();
		}
		return array();
	}
	public function getAllDetail($user_id){
	    $this->db->where('id', $user_id);
		$query = $this->db->get('orders');
		if($query->num_rows())
		{
			return $query->row();
		}
		return array();
	}
	 public function getAllOrdersdetail($user_id){
		$this->db->where('order_id', $user_id);

		$query = $this->db->get('order_detail');
		if($query->num_rows())
		{
			return $query->result();
		}
		return array();
	}

	public function countQueriesTotal($data){
		$this->db->from('contact_queries');
		$query  =   $this->db->get();
		return $query->num_rows();
	}

	public function getRow($id){
		$sSQL   =   $this->db->where("id",$id);
		$query  =   $this->db->get('contact_queries');
		
		if($query->num_rows())
		{
			$row = $query->result();
			return $row[0];
		}
		return array();
	}

	
	
	public function update($data,$id){
		$this->db->where('id',$id);
		$this->db->update('contact_queries',$data);
		return true;
	}
	
	public function delete($id){
		$this->db->where('id', $id);
		$this->db->delete('contactus');
	}
	public function deleteUsers($id){
		$this->db->where('id', $id);
		$this->db->delete('users');
	}
	public function delete_Order($id){
		$this->db->where('id', $id);
		$this->db->delete('orders');
	}
	
	public function deleteAll($ids){
		$this->db->where_in('id', $ids);
		$this->db->delete('contact_queries');
		echo $this->db->last_query();
	}

}
?>
