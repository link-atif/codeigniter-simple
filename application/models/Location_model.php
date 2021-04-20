<?php

class Location_model extends CI_Model
{

  	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->pages = 'location';
    	$this->pages_description = 'location_description';
    }
	
	public function save($data)
	{
		$this->db->insert($this->pages,$data);
		return true;
	}

	public function save_location($data)
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

	public function getAllLocation(){
		$this->db->select('m.*');
		//$this->db->join($this->pages_description.' md','md.location_id = m.id');
		//$this->db->where('md.language_id',getLangId());
		$this->db->from($this->pages.' m');
		$query = $this->db->get();
		if($query->num_rows())
		{
			return $query->result();
		}
		return array();
	}
	public function getAllImage(){
		$this->db->select('*');
		//$this->db->join($this->pages_description.' md','md.location_id = m.id');
		//$this->db->where('md.language_id',getLangId());
		$this->db->order_by('sort_order','ASC');
		$this->db->from('sliderimages');
		$query = $this->db->get();
		if($query->num_rows())
		{
			return $query->result_array();
		}
		return array();
	}
    public function countTotalNews(){
    	$this->db->select('*');
		$this->db->from('news');
		$query  =   $this->db->get();
		return $query->num_rows();
    }
	public function getAllNews($limit,$start){
		
		$this->db->limit($limit, $start);
		$this->db->order_by('id','desc');
		$this->db->select('*');
		$query = $this->db->get('news');
		if($query->num_rows())
		{
			return $query->result_array();
		}
		return array();
	}
	public function getAllNewsforslider(){
		
		
		$this->db->order_by('id','desc');
		$this->db->select('*');
		$query = $this->db->get('news');
		if($query->num_rows())
		{
			return $query->result_array();
		}
		return array();
	}
	public function getAllmediacenter($start,$limit){
		
		$this->db->limit($limit, $start);
		$this->db->order_by('id','desc');
		
		$this->db->select('*');
		$query = $this->db->get('news');
		if($query->num_rows())
		{
			return $query->result_array();
		}
		return array();
	}
	public function getRecentNews(){
		$this->db->select('*');
		//$this->db->join($this->merchandise_description.' md','md.merchandise_id = m.id');
		$this->db->order_by('id','desc');
		$this->db->limit(5);
		$this->db->from('news');
		$query = $this->db->get();
		if($query->num_rows())
		{
			return $query->result_array();
		}
		return array();
	}
	public function getSpecials(){
		$this->db->select('*');
		//$this->db->join($this->merchandise_description.' md','md.merchandise_id = m.id');
		$this->db->order_by('id','desc');
		//$this->db->limit(5);
		$this->db->from('special');
		$query = $this->db->get();
		if($query->num_rows())
		{
			return $query->result_array();
		}
		return array();
	}
	public function getNews_by_id($id){
		$this->db->select('*');
		//$this->db->join($this->merchandise_description.' md','md.merchandise_id = m.id');
		$this->db->like('id',$id);
		$this->db->from('news');
		//$this->db->limit(6,0);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->row();
		}
		return array();
	}
	public function getSpecials_by_id($id){
		$this->db->select('*');
		//$this->db->join($this->merchandise_description.' md','md.merchandise_id = m.id');
		$this->db->like('id',$id);
		$this->db->from('special');
		//$this->db->limit(6,0);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->row();
		}
		return array();
	}
	public function getNews_by_special(){
		$this->db->select('*');
		//$this->db->join($this->merchandise_description.' md','md.merchandise_id = m.id');
		//$this->db->like('id',$id);
		$this->db->from('special');
		//$this->db->limit(6,0);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->row();
		}
		return $query->row();
	}
	public function getAllGallery(){
		$this->db->select('*');
		//$this->db->join($this->pages_description.' md','md.location_id = m.id');
		$this->db->where('home_page',1);
		$this->db->order_by("sort_order","ASC");
		//$this->db->limit(5,0);
		$this->db->from('follow');
		$query = $this->db->get();
		if($query->num_rows())
		{
			return $query->result_array();
		}
		return array();
	}
	public function getGalleryAll(){
		$this->db->select('*');
		//$this->db->join($this->pages_description.' md','md.location_id = m.id');
		$this->db->where('type','Customers');
		$this->db->from('follow');
		$query = $this->db->get();
		if($query->num_rows())
		{
			return $query->result_array();
		}
		return array();
	}
	public function getGalleryAll_patner(){
		$this->db->select('*');
		//$this->db->join($this->pages_description.' md','md.location_id = m.id');
		$this->db->where('type','Partners');
		$this->db->from('follow');
		$query = $this->db->get();
		if($query->num_rows())
		{
			return $query->result_array();
		}
		return array();
	}
	public function getCateringAll(){
		$this->db->select('*');
		//$this->db->join($this->pages_description.' md','md.location_id = m.id');
		//$this->db->where('md.language_id',getLangId());
		$this->db->from('catering');
		$query = $this->db->get();
		if($query->num_rows())
		{
			return $query->result_array();
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
	public function Timeslot(){
		$this->db->select('m.*,md.*');
		$this->db->join($this->pages_description.' md','md.location_id = m.id');
		$this->db->where('md.language_id',getLangId());
		$this->db->from($this->pages.' m');
		$query = $this->db->get();
		if($query->num_rows())
		{
			return $query->result_array();
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

	public function get_location_by_id($id){
		$this->db->select('p.*');
		//$this->db->join($this->pages_description.' pd','pd.location_id = p.id');
		$this->db->where('p.id', $id);
		$this->db->from($this->pages.' p');
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$result = $query->result_array();
			return $result[0];
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
		$this->db->update('location',$data);
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
		$this->db->delete('location');
	}

	public function deleteDetail($id)
	{
		$this->db->where('location_id', $id);
		$this->db->delete('location_description');
	}	
	public function getHomeLocation(){
		$this->db->select('m.*,md.*');
		$this->db->join($this->pages_description.' md','md.location_id = m.id');
		$this->db->where('md.language_id',getLangId());
		$this->db->limit(2,0);
		$this->db->from($this->pages.' m');
		$query = $this->db->get();
		if($query->num_rows())
		{
			return $query->result_array();
		}
		return array();
	}
	public function getOurLocations(){
		$this->db->select('m.*');
		//$this->db->join($this->pages_description.' md','md.location_id = m.id');
		//$this->db->where('md.language_id',getLangId());
		//$this->db->limit(2,0);
		$this->db->from($this->pages.' m');
		$query = $this->db->get();
		if($query->num_rows())
		{
			return $query->result_array();
		}
		return array();
	}
	public function getLocation(){
		$this->db->select('m.*,md.*');
		$this->db->join($this->pages_description.' md','md.location_id = m.id');
		$this->db->where('md.language_id',getLangId());
		$this->db->order_by("id","desc");
		$this->db->from($this->pages.' m');
		$query = $this->db->get();
		if($query->num_rows())
		{
			return $query->row();
		}
		return array();
	}
    
    public function check_time_available($date,$time,$location_id,$total_rooms){
		$this->db->where("location_id",$location_id);
		$this->db->where("booking_date",$date);
		$this->db->where("booking_time",$time);
		$this->db->where("status","approve");
		$query  =   $this->db->get(' orders');
		if($query->num_rows()>=$total_rooms)
		{
			return false;
		}
		return true;
	}
	public function get_package_by_id($package_id){
       $this->db->select('p.*,pd.*');
		$this->db->join('package_description'.' pd','pd.package_id = p.id');
		$this->db->where('p.id', $package_id);
		$this->db->where('pd.language_id',getLangId());
		$this->db->from('package'.' p');
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->row();
		}
		return array();
	}

	public function getLocationById($id){
		$this->db->select('name');
		$this->db->where('id',$id);
		$q = $this->db->get('location');
		if($q->num_rows() > 0){
			return $q->row()->name;
		}
		return "";
	}

	public function getById($id){
		$this->db->select('*');
		$this->db->where('id',$id);
		$q = $this->db->get('location');
		if($q->num_rows() > 0){
			return $q->row();
		}
		return array();	
	}
}
?>
