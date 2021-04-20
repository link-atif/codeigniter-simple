<?php

class Free_testers_model extends CI_Model
{

  	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	public function getAllQueries(){
		
		$query = $this->db->get('free_testers');
		if($query->num_rows())
		{
			return $query->result();
		}
		return array();
	}

	public function save($data)
	{
		$this->db->insert('free_testers',$data);
		return true;
	}

	public function delete($id){
		$this->db->where('id', $id);
		$this->db->delete('free_testers');
	}

}
?>
