<?php

class Order_model extends CI_Model
{

  	function __construct()
    {
        parent::__construct();
        
    }
    public function insertAddonFormData($data){
		  $this->db->insert('orders',$data);
		  return $this->db->insert_id();
	  }

	  public function get_discount_value($discount_code){
  	 $this->db->select('*');
  	 $this->db->where('code',$discount_code);
  	 $query = $this->db->get('coupons');
    		if ($query->num_rows() > 0) {
      		return $query->row();
    		}
    		return false;
    }

    public function getOrderDataById($id){
      $this->db->select("*");
      $this->db->where('id',$id);
      $query =  $this->db->get('orders');
      if($query->num_rows() > 0){
        return $query->row();
      }
      return "";
    }
     public function getDataOfId($id){
      $this->db->select("*");
      $this->db->where('id',$id);
      $query =  $this->db->get('users');
      if($query->num_rows() > 0){
        return $query->row();
      }
      return "";
    }

    public function updateOrderDetails($data, $id){
      $this->db->where('id',$id);
      $this->db->update('orders',$data);
      return true;
    } 


    public function getOrderDetailsById($id){
      $this->db->select("*");
      $this->db->where('customer_id',$id);
      $query =  $this->db->get('orders');
      if($query->num_rows() > 0){
        return $query->result();
      }
      return array();
    }

}
?>