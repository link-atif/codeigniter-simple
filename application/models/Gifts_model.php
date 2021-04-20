<?php

class Gifts_model extends CI_Model
{
  	function __construct(){
        parent::__construct();
    	$this->_table = "gifts";
    	$this->_table_cards = "gift_cards"; 
    	$this->foreign_key = 'gift_id';
    }
	
    public function countTotal($data){
		if(isset($data['title']) && $data['title']!=''){
			$this->db->like('t.name', $data['title']);
		}
		$this->db->select('t.*');
		$this->db->from($this->_table.' t');
		$query  =   $this->db->get();
		return $query->num_rows();
	}

	public function getAll($data,$start,$limit){
		$this->db->limit($limit, $start);
		$this->db->order_by('t.id','desc');
		if($data['title']!=''){
			$this->db->like('t.name', $data['title']);
		}
		$this->db->select('t.*');
		$this->db->from($this->_table.' t');
		$query = $this->db->get();
		if($query->num_rows())
		{
			return $query->result();
		}
		return array();
	}

	public function save($data){
		$this->db->insert($this->_table,$data);
		return $this->db->insert_id();
	}

	public function getById($id){
		$this->db->select('t.*');
		$this->db->where('t.id', $id);
		$this->db->from($this->_table.' t');
		$query = $this->db->get();
		if($query->num_rows()){
			$result =  $query->result_array();
			return $result[0];
		}
		return array();
	}

	public function update($data,$id)
	{
		$this->db->where('id',$id);
		$this->db->update($this->_table,$data);
		return true;
	}

	public function delete($id){
		$this->db->where('id', $id);
		$this->db->delete($this->_table);
	}

	public function deleteSliderFile($id){
		$row = $this->getRow($id);
		if($row['picture']!=''){
			@unlink('uploads/data/'.$row['picture']);
			$data = array("picture" => "");
			$this->db->where('id',$id);
			$this->db->update($this->_table,$data);
		}
	}

	public function getRow($id){
		$this->db->where("id",$id);
		$query  =   $this->db->get($this->_table);
		if($query->num_rows()){
			$row = $query->result_array();
			return $row[0];
		}
		return array();
	}

	public function getGiftName($id){
		$this->db->select("tittle");
		$this->db->where('id',$id);
		$q = $this->db->get('media');
		if($q->num_rows()>0){
			return $q->row()->tittle;
		}
		return "";
	}

	public function getAllGiftCards($id){
		$this->db->select("*");
		$this->db->where($this->foreign_key,$id);
		$q = $this->db->get($this->_table_cards);
		if($q->num_rows() >0){
			return $q->result();
		}
		return array();
	}


	public function getAllGiftcardsItems(){
		$this->db->select("*");
		$q = $this->db->get($this->_table_cards);
		if($q->num_rows() > 0){
			return $q->result();
		}
		return array();
	}	

	public function deleteGiftCardItem($id){
		$this->db->where('id',$id);
		$this->db->delete($this->_table_cards);
		return true;
	}

	public function getAllGifts(){
		$this->db->select('*');
		//$this->db->order_by('sort_order');
		$this->db->from('media');
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result();
		}
		return array();
	}

	public function getGiftDetailsById($id){
		$this->db->select('t.*');
		$this->db->from($this->_table.' t');
		$this->db->where('id',$id);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->row();
		}
		return "";
	}

	public function getGiftCardDetailsById($id){
		$this->db->select('t.*');
		$this->db->from($this->_table_cards.' t');
		$this->db->where('id',$id);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->row();
		}
		return "";
	}

	public function sendGiftCard($data){
		$this->db->insert('gift_vouchers',$data);
		return $this->db->insert_id();
	}

	public function getGiftDataById($id){
		$this->db->select('*');
		$this->db->from('gift_vouchers');
		$this->db->where('id',$id);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->row();
		}
		return "";
	}

	public function updateGiftDetails($data, $id){
		$this->db->where('id',$id);
		$this->db->update('gift_vouchers',$data);
		return true;
	}
}
?>

