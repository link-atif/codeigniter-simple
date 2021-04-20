<?php
class Journal_model extends CI_Model

{



  	function __construct()

    {

        // Call the Model constructor

        parent::__construct();

    }

	

	public function save($data)

	{

		$this->db->insert('journal',$data);

		return $this->db->insert_id();

	}

	

	public function countTotal($data){

		if(isset($data['title']) && $data['title']!=''){

			$this->db->like('title', $data['title']);

		}

		$this->db->select('*');

		$this->db->from('journal');

		$query  =   $this->db->get();

		return $query->num_rows();

	}

	public function countTotalreference($data){

		if(isset($data['reference']) && $data['reference']!=''){

			$this->db->like('order_reference', $data['reference']);

		}

		$this->db->select('*');

		$this->db->from('orders');

		$query  =   $this->db->get();

		return $query->num_rows();

	}

	public function getAll($data,$limit='',$start=''){

		
			$this->db->limit($limit, $start);
		

		$this->db->order_by('id','desc');

		if($data['title']!=''){

			$this->db->like('title', $data['title']);

		}

		$this->db->select('*');

		$query = $this->db->get('journal');

		if($query->num_rows())

		{

			return $query->result();

		}

		return array();

	}

	

	function getPreviousRow($id){

		$this->db->order_by('id','desc');

		$this->db->where("id<",$id);

		$this->db->select('*');

		$query = $this->db->get('journal');

		if($query->num_rows())

		{

			return $query->row();

		}

		return '';

	}

	

	function getNextRow($id){

		$this->db->order_by('id','asc');

		$this->db->where("id>",$id);

		$this->db->select('*');

		$query = $this->db->get('journal');

		if($query->num_rows())

		{

			return $query->row();

		}

		return '';

	}

	

	public function getAllJournalDetail($url){
		$this->db->where('slug',$url);

		$query  =   $this->db->get('journal');
		if($query->num_rows())
		{
			$row = $query->result_array();
			return $row[0];
		}
		return array();
	}	

	public function getAllnews(){

		$query  =   $this->db->get('journal');

		

		if($query->num_rows())

		{

			return $query->result();

		}

		return array();

	}

	

	function getForHomePage($start,$limit){

		$this->db->limit($limit, $start);

		$this->db->order_by('id','desc');

		$this->db->select('*');

		$query = $this->db->get('journal');

		if($query->num_rows())

		{
			return $query->result();
		}
		return array();
	}
	public function getRow($slug){
		$this->db->where("slug",$slug);
		$query  =   $this->db->get('journal');
		if($query->num_rows())
		{
			$row = $query->result_array();
			return $row[0];
		}
		return array();
	}
	public function getRowEdit($id){
		$this->db->where("id",$id);
		$query  =   $this->db->get('journal');
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
		$this->db->update('journal',$data);
		return true;
	}
	public function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('journal');
	}
	public function deletePictureAndRow($id){
		$row = $this->getRow($id);
		if($row['picture']!=''){
			@unlink('uploads/data/'.$row['picture']);
		}
		$this->delete($id);
	}
	public function deleteimageMain($id){
		$row = $this->getRow($id);
		if($row['picture_main']!=''){
			@unlink('uploads/data/'.$row['picture_main']);
			$data = array("picture_main" => "");
			$this->db->where('id',$id);
			$this->db->update('journal',$data);
		}
	}
	public function deleteimageS1($id){
		$row = $this->getRow($id);
		if($row['picture_s1']!=''){
			@unlink('uploads/data/'.$row['picture_s1']);
			$data = array("picture_s1" => "");
			$this->db->where('id',$id);
			$this->db->update('journal',$data);
		}
	}
	function uploadImageAndResize($picname,$path,$new_width,$new_height){
    	$config['upload_path']   = $path; //'uploads/data/';
		$config['allowed_types'] = 'jpeg|jpg|png|JPG|JPEG|PNG|svg';
		$config['max_size'] 	 = '1000000';
		$config['file_name']     = $picname;  // 'sliderimage_' . time() 
		$this->load->library('upload', $config);
		if ($this->upload->do_upload('file')){
			$image_details  = $this->upload->data();
			$picture_name 	= $image_details['file_name'];
			$filename = $picture_name;
		    $config = array(
			    'source_image'      => $image_details['full_path'], //path to the uploaded image
			    'new_image'         => 'uploads/slider/', //path to
			    'maintain_ratio'    => false,
			    'width'             => $new_width,
			    'height'            => $new_height
		    );
		    $this->image_lib->initialize($config);
		    $error="";
    		if ( ! $this->image_lib->resize()){
    			$error = $this->image_lib->display_errors();
    			return false;
			}else{
				$this->image_lib->clear();
				return $picture_name;	
			}
		    // clear //
		}else{
			return false;
		}
    }
    function uploadImageAndResize1($picname,$path,$new_width,$new_height){
    	$config['upload_path']   = $path; //'uploads/data/';
		$config['allowed_types'] = 'jpeg|jpg|png|JPG|JPEG|PNG|svg';
		$config['max_size'] 	 = '1000000';
		$config['file_name']     = $picname;  // 'sliderimage_' . time() 
		$this->load->library('upload', $config);
		if ($this->upload->do_upload('file')){
			$image_details  = $this->upload->data();
			$picture_name 	= $image_details['file_name'];
			$filename = $picture_name;
		    $config = array(
			    'source_image'      => $image_details['full_path'], //path to the uploaded image
			    'new_image'         => 'uploads/slider/', //path to
			    'maintain_ratio'    => false,
			    'width'             => $new_width,
			    'height'            => $new_height
		    );
		    $this->image_lib->initialize($config);
		    $error="";
    		if ( ! $this->image_lib->resize()){
    			$error = $this->image_lib->display_errors();
    			return false;
			}else{
				$this->image_lib->clear();
				return $picture_name;	
			}	    // clear //
		}else{
			return false;
		}
    }
	public function getAllJournal(){
		$this->db->select("*");
		$query = $this->db->get('journal');
		if($query->num_rows() > 0){
			return $query->result();
		}
		return array();
	}



}

?>