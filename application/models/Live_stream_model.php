<?php

class Live_stream_model extends CI_Model
{

  	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->live_stream = 'live_stream';
    	$this->live_stream_description = 'live_stream_description';
    	$this->news = 'news';
    }
	
	public function save($data)
	{
		$this->db->insert($this->live_stream,$data);
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
		$this->db->insert_batch($this->live_stream_description,$data);
		return true;
	}
	//search and pagination start here
	public function countProductsTotal($data){
		if(isset($data['name']) && $data['name']!=''){
			$this->db->like('tittle', $data['name']);
			$this->db->or_like('description', $data['name']);
		}
		$this->db->select('*');
		$this->db->from('live_stream');
		$query  =   $this->db->get();
		return $query->num_rows();
	}
	public function getLink($id){
		$this->db->where('id',$id);
		$this->db->select('link');
		$query = $this->db->get('live_stream');
		if ($query->num_rows() > 0) {
			return $query->row()->link;
		}
		return "";
	}
	public function getAlllive_stream($data,$start, $limit){
		$this->db->limit($limit, $start);
		$this->db->order_by('sort_order','asc');
		if($data['name']!=''){
			$this->db->like('tittle', $data['name']);
			$this->db->or_like('description', $data['name']);
		}
		$this->db->select('*');
		$query = $this->db->get('live_stream');
		if($query->num_rows())
		{
			return $query->result();
		}
		return array();
	}

	public function getlive_stream(){
		$this->db->order_by('sort_order','asc');
		$this->db->select('*');
		$query = $this->db->get('live_stream');
		if($query->num_rows())
		{
			return $query->result();
		}
		return array();
	}
	public function getAllNews(){
		$this->db->select('*');
		//$this->db->join($this->sliderimages_description.' md','md.slider_id = m.id');
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
		//$this->db->join($this->sliderimages_description.' md','md.slider_id = m.id');
		//$this->db->where('md.language_id',getLangId());
		$this->db->from('special');
		$query = $this->db->get();
		if($query->num_rows())
		{
			return $query->result();
		}
		return array();
	}
	public function getAll(){
		$this->db->select('*');
		//$this->db->join($this->sliderimages_description.' md','md.slider_id = m.id');
		//$this->db->where('md.language_id',getLangId());
		$this->db->from('live_stream');
		$query = $this->db->get();
		if($query->num_rows())
		{
			return $query->result();
		}
		return array();
	}

	public function getHomePageLive_stream(){
		$this->db->select('m.*,md.*');
		$this->db->join($this->live_stream_description.' md','md.slider_id = m.id');
		$this->db->where('md.language_id',getLangId());
		$this->db->limit(3,0);
		$this->db->from($this->live_stream.' m');
		$query = $this->db->get();
		if($query->num_rows())
		{
			return $query->result_array();
		}
		return array();
	}

	public function getRow($id){
		$this->db->select('m.*');
		//$this->db->join($this->sliderimages_description.' md','md.slider_id = m.id');
		$this->db->where('m.id',$id);
		$this->db->from($this->live_stream.' m');
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$result = $query->result_array();
			return $result[0];
		}
		return array();
	}
	public function getnewsimage($id){
		$this->db->select('*');
		//$this->db->join($this->sliderimages_description.' md','md.slider_id = m.id');
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
		//$this->db->join($this->sliderimages_description.' md','md.slider_id = m.id');
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
		//$this->db->join($this->sliderimages_description.' md','md.slider_id = m.id');
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
		//$this->db->join($this->sliderimages_description.' md','md.slider_id = m.id');
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
		$this->db->update($this->live_stream,$data);
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
	 public function update_live_stream_description($data,$id){
		$this->db->where('slider_id',$id);
		$this->db->update_batch($this->live_stream_description,$data,'language_id');
		return true;
	}
	
	public function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('live_stream');
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
			$this->db->update('live_stream',$data);
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
			$this->db->update('live_stream',$data);
		}
	}

}
?>
