<?php

class Admin_model extends CI_Model
{

  	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	public function save($data)
	{
		$this->db->insert('admin',$data);
		return $this->db->insert_id();
	}
	public function getAllAdminUsers(){
		$query  =   $this->db->get('admin');
		
		if($query->num_rows())
		{
			return $query->result();
		}
		return array();
	}

	public function getRow($id){
		$sSQL   =   $this->db->where("id",$id);
		$sSQL	=	"select * from admin";
		$query  =   $this->db->get('admin');
		
		if($query->num_rows())
		{
			$row = $query->result_array();
			return $row[0];
		}
		return array();
	}

	public function getRowByEmail($email){
		$this->db->where("email",$email);
		$query  =   $this->db->get('admin');
		if($query->num_rows())
		{
			$row = $query->result_array();
			return $row[0];
		}
		return array();
	}

	
	public function update($data,$id)
	{
		$this->db->where('id',$id);
		$this->db->update('admin',$data);
		return true;
	}

	function authenticate($username,$password)
	{
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$query = $this->db->get('admin');
		if( $query->num_rows() > 0)
		{
			$record	=	$query->result();
			return $record[0];
		}
		else
		{
			return FALSE;
		}
	}
	
	function delete_admin($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('admin');
	}

	function checkEmail($email,$id = null) {
		if($id) {
			$this->db->where('id !=', $id);	
		}
		$this->db->where('email', $email);
		$query = $this->db->get('admin');
		if( $query->num_rows() > 0) {
			$record	=	$query->result();
			return true;
		}else {
			return false;
		}
	}

	function checkUsername($email,$id = null){
		if($id){
			$this->db->where('id !=', $id);	
		}
		$this->db->where('username', $email);
		$query = $this->db->get('admin');
		if( $query->num_rows() > 0) {
			$record	=	$query->result();
			return true;
		}else {
			return false;
		}
	}
	
	function checkAdminUserISAdmin(){
		if($this->session->userdata('type')=='customer'){
			header("location:".base_url()."admin/items");
			exit();
		}
	}
}
?>
