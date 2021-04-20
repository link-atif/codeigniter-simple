<?php

class Pages_crud_model extends CI_Model
{

  	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->pages_crud = 'pages_crud';
    	$this->pages_crud_description = 'pages_crud_description';
    	$this->news = 'news';
    }
	
	public function save($data)
	{
		$this->db->insert($this->pages_crud,$data);
		return true;
	}
	public function saveNews($data)
	{
		$this->db->insert($this->news,$data);
		return true;
	}
	public function savespecials($data)
	{
		$this->db->insert('special',$data);
		return true;
	}
	public function save_slider_description($data)
	{
		$this->db->insert_batch($this->pages_crud_description,$data);
		return true;
	}

	public function getAllPages_crud(){
		$this->db->select('m.*');
		//$this->db->join($this->pages_crud_description.' md','md.slider_id = m.id');
		//$this->db->where('md.language_id',getLangId());
		$this->db->from($this->pages_crud.' m');
		$query = $this->db->get();
		if($query->num_rows())
		{
			return $query->result();
		}
		return array();
	}
	public function getAllNews(){
		$this->db->select('*');
		//$this->db->join($this->pages_crud_description.' md','md.slider_id = m.id');
		//$this->db->where('md.language_id',getLangId());
		$this->db->from('news');
		$query = $this->db->get();
		if($query->num_rows())
		{
			return $query->result();
		}
		return array();
	}
	public function getAllspecials(){
		$this->db->select('*');
		//$this->db->join($this->pages_crud_description.' md','md.slider_id = m.id');
		//$this->db->where('md.language_id',getLangId());
		$this->db->from('special');
		$query = $this->db->get();
		if($query->num_rows())
		{
			return $query->result();
		}
		return array();
	}
	public function getInsta(){
		$this->db->select('*');
		$this->db->from('pages_crud');
		$query = $this->db->get();
		if($query->num_rows())
		{
			return $query->result();
		}
		return array();
	}

	public function getHomePagePages_crud(){
		$this->db->select('m.*,md.*');
		$this->db->join($this->pages_crud_description.' md','md.slider_id = m.id');
		$this->db->where('md.language_id',getLangId());
		$this->db->limit(3,0);
		$this->db->from($this->pages_crud.' m');
		$query = $this->db->get();
		if($query->num_rows())
		{
			return $query->result_array();
		}
		return array();
	}

	public function getRow($id){
		$this->db->select('m.*');
		//$this->db->join($this->pages_crud_description.' md','md.slider_id = m.id');
		$this->db->where('m.id',$id);
		$this->db->from($this->pages_crud.' m');
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$result = $query->result_array();
			return $result[0];
		}
		return array();
	}
	public function getnewsimage($id){
		$this->db->select('*');
		//$this->db->join($this->pages_crud_description.' md','md.slider_id = m.id');
		$this->db->where('id',$id);
		$this->db->from('news');
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$result = $query->result_array();
			return $result[0];
		}
		return array();
	}
	public function getRowNews($id){
		$this->db->select('m.*');
		//$this->db->join($this->pages_crud_description.' md','md.slider_id = m.id');
		$this->db->where('m.id',$id);
		$this->db->from($this->news.' m');
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$result = $query->result_array();
			return $result[0];
		}
		return array();
	}
	public function getRowProducts($id){
		$this->db->select('*');
		//$this->db->join($this->pages_crud_description.' md','md.slider_id = m.id');
		$this->db->where('id',$id);
		$this->db->from('merchandise');
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$result = $query->result_array();
			return $result[0];
		}
		return array();
	}
	public function getRowspecials($id){
		$this->db->select('*');
		//$this->db->join($this->pages_crud_description.' md','md.slider_id = m.id');
		$this->db->where('id',$id);
		$this->db->from('special');
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
		$this->db->update($this->pages_crud,$data);
		return true;
	}
	public function updateNews($data,$id)
	{
		$this->db->where('id',$id);
		$this->db->update($this->news,$data);
		return true;
	}
	public function updateSpeical($data,$id)
	{
		$this->db->where('id',$id);
		$this->db->update('special',$data);
		return true;
	}
	 public function update_pages_crud_description($data,$id){
		$this->db->where('slider_id',$id);
		$this->db->update_batch($this->pages_crud_description,$data,'language_id');
		return true;
	}
	
	public function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('pages_crud');
	}
	public function deleteNews($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('news');
	}
	public function deleteSpecial($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('special');
	}

	public function deletePictureAndRow($id){
		$row = $this->getRow($id);
		if($row['picture']!=''){
			@unlink('uploads/data/'.$row['picture']);
		}
		$this->delete($id);
	}
	
	public function deleteProductsPicture($id){
		$row = $this->getRowProducts($id);
		if($row['picture']!=''){
			@unlink('uploads/data/'.$row['picture']);
			$data = array("picture" => "");
			$this->db->where('id',$id);
			$this->db->update('merchandise',$data);
		}
	}
	public function deleteNewsPicture($id){
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
			$this->db->update('pages_crud',$data);
		}
	}
	public function deleteNewsFile($id){
		$row = $this->getnewsimage($id);
		if($row['picture']!=''){
			@unlink('uploads/data/'.$row['picture']);
			$data = array("picture" => "");
			$this->db->where('id',$id);
			$this->db->update('news',$data);
		}
	}
	public function deleteSliderspecials($id){
		$row = $this->getRow($id);
		if($row['picture']!=''){
			@unlink('uploads/data/'.$row['picture']);
			$data = array("picture" => "");
			$this->db->where('id',$id);
			$this->db->update('special',$data);
		}
	}
	
	public function deleteArabicSliderFile($id){
		$row = $this->getRow($id);
		if($row['picture']!=''){
			@unlink('uploads/data/'.$row['picture_arabic']);
			$data = array("picture_arabic" => "");
			$this->db->where('id',$id);
			$this->db->update('pages_crud',$data);
		}
	}

}
?>
