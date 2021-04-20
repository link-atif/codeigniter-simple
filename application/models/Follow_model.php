<?php

class Follow_model extends CI_Model
{

  	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->follow = 'follow';
    	$this->follow_description = 'follow_discription';
    }
	
	public function save($data)
	{
		$this->db->insert($this->follow,$data);
		return true;
	}
	public function save_slider_description($data)
	{
		$this->db->insert_batch($this->follow_description,$data);
		return true;
	}

	public function getPartners($type='1'){
		$this->db->select('*');
		//$this->db->join($this->sliderimages_description.' md','md.slider_id = m.id');
		//$this->db->where('md.language_id',getLangId());
		$this->db->where("home_page",$type);
		$this->db->from('follow');
		$query = $this->db->get();
		if($query->num_rows())
		{
			return $query->result();
		}
		return array();
	}
	public function getAll(){
		$this->db->select('m.*');
		//$this->db->join($this->follow_description.' md','md.follow_id = m.id');
		//$this->db->where('md.language_id',getLangId());
		$this->db->from($this->follow.' m');
		$query = $this->db->get();
		if($query->num_rows())
		{
			return $query->result();
		}
		return array();
	}

	public function getRow($id){
		$this->db->select('m.*');
		///$this->db->join($this->follow_description.' md','md.follow_id = m.id');
		$this->db->where('m.id',$id);
		$this->db->from($this->follow.' m');
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$result = $query->result_array();
			return $result[0];
		}
		return array();
	}

	public function update($data,$id)
	{
		$this->db->where('id',$id);
		$this->db->update($this->follow,$data);
		return true;
	}
	 public function update_sliderimages_description($data,$id){
		$this->db->where('follow_id',$id);
		$this->db->update_batch($this->follow_description,$data,'language_id');
		return true;
	}
	
	public function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('follow');
	}

	public function deletePictureAndRow($id){
		$row = $this->getRow($id);
		if($row['picture']!=''){
			@unlink('uploads/data/'.$row['picture']);
		}
		$this->delete($id);
	}

	public function deleteSliderFile($id){
		$row = $this->getRow($id);
		if($row['picture']!=''){
			@unlink('uploads/data/'.$row['picture']);
			$data = array("picture" => "");
			$this->db->where('id',$id);
			$this->db->update('follow',$data);
		}
	}
	
	public function deleteArabicSliderFile($id){
		$row = $this->getRow($id);
		if($row['picture']!=''){
			@unlink('uploads/data/'.$row['picture_arabic']);
			$data = array("picture_arabic" => "");
			$this->db->where('id',$id);
			$this->db->update('follow',$data);
		}
	}
	public function getHomeFollow(){
		$this->db->select('m.*,md.*');
		$this->db->join($this->follow_description.' md','md.follow_id = m.id');
		$this->db->where('md.language_id',getLangId());
		$this->db->limit(4,0);
		$this->db->from($this->follow.' m');
		$query = $this->db->get();
		if($query->num_rows())
		{
			return $query->result_array();
		}
		return array();
	}

}
?>
