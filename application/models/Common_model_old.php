<?php

class Common_model extends CI_Model
{

  	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->library('image_lib');
    }
	
	function toAscii($type,$str) {
		if($type=='arabic'){
			return $this->arabicSeo($str);
		}
		$str   = str_replace(" " ,"-",$str);
		$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $str);
		$clean = strtolower(trim($clean, '-'));
		$clean = preg_replace("/[\/_|+ -]+/", '-', $clean);
		return $clean;
	}
	
	function arabicSeo($str){
		$str   = str_replace(" " ,"-",$str);
		return trim($str,'-');
	}
	
	function get_language_name(){
		$language = $this->input->cookie('language');
		if($language==''){
			$cookie= array(
	      		'name'   => 'language',
	      		'value'  => 'english',
	       		'expire' => time()+'86400'*365,
	  		);
	  		$this->input->set_cookie($cookie);
			$language = 'english';
		}else if($language=='en'){
			$language = 'english';
		}
		return $language;
	}
	
	function generateThumb($imgPath, $dimentions,$destinationFile = '') {
		if($destinationFile != ''){
			$config['new_image']	= $destinationFile;
			$config['thumb_marker']	= '';
		}
		$config['image_library'] = 'gd2';
		$config['source_image']	= $imgPath;
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['width'] = $dimentions[0];
		$config['height'] = $dimentions[1];
		//$this->load->library('image_lib', $config);
		//print_r($config);
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
	}
	
	function uploadFile2($file_name, $field, $path) {
		if($_FILES[$field]['error']!= 0) {
			return $this->upload->display_errors();
		 }
		$config['upload_path'] = $path;//'D:/wamp/www/nexthrm-new/updoc/logo/';
		$config['allowed_types'] = '"gif|jpg|jpeg|png|iso|dmg|zip|rar|doc|docx|xls|xlsx|ppt|pptx|csv|ods|odt|odp|pdf|rtf|sxc|sxi|txt|exe|avi|mpeg|mp3|mp4|3gp';
		$config['max_size'] = '50000000';
		$config['file_name'] = $file_name;
	    $this->load->library('upload', $config);
		if( !$this->upload->do_upload($field) ) {
			return $this->upload->display_errors();
		} else {
			$fileInfo = $this->upload->data();
			$filePath = $path.$file_name;
			$this->generateThumb($filePath, array(400, 350),'thumb_400_'.$file_name);
			return $picture_name 	= $fileInfo['file_name'];
		}
		return true;
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
			    'new_image'         => 'uploads/data/', //path to
			    'maintain_ratio'    => true,
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
			}
		    // clear //
		}else{
			return false;
		}
    }
     function uploadImageAndResize2($picname,$path,$new_width,$new_height){
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
	
	function uploadImage($picname,$path){
    	$config['upload_path']   = $path; //'uploads/data/';
		$config['allowed_types'] = 'jpeg|jpg|png|JPG|JPEG|PNG|svg';
		$config['max_size'] 	 = '1000000';
		$config['file_name']     = $picname;  // 'sliderimage_' . time() 
		$this->load->library('upload', $config);
		if ($this->upload->do_upload('file')){
			$image_details  = $this->upload->data();
			$picture_name 	= $image_details['file_name'];					
			return $picture_name;
		}else{
			return $this->upload->display_errors();

		}
    }
	
	

    function uploadImageAndThumbNail($picname,$path,$new_width,$new_height){
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
			    'new_image'         => 'uploads/data/thumb/', //path to
			    'maintain_ratio'    => true,
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

    public function uploadFile($name,$path){
    	$config['upload_path']   = $path; //'uploads/data/';
		$config['allowed_types'] = 'mkv|ogv|ogg|m4v|wmv|avi|mp3|flv|mp4|svg';
		$config['max_size'] 	 = '1000000';
		$config['file_name']     = $name;  // 'sliderimage_' . time()
		
		$this->load->library('upload', $config);
		if ($this->upload->do_upload('file')){
			$image_details  = $this->upload->data();
			$picture_name 	= $image_details['file_name'];
			return $picture_name;
		}else{
			return false;
		}
    }

    public function uploadDocomentFile($name,$path){
    	$config['upload_path']   = $path; //'uploads/data/';
		$config['allowed_types'] = 'jpg|gif|jpeg|png|svg|pdf|doc|docx';
		$config['max_size'] 	 = '1000000';
		$config['file_name']     = $name;  // 'sliderimage_' . time()
		
		$this->load->library('upload', $config);
		if ($this->upload->do_upload('file')){
			$image_details  = $this->upload->data();
			$picture_name 	= $image_details['file_name'];
			return $picture_name;
		}else{
			return false;
		}
    }

	public function decryptIt( $q ) {
	    $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
	    $qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
	    return( $qDecoded );
	}

	public function encryptIt( $q ) {
	    $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
	    $qEncoded  = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
	    return( $qEncoded );
	}

	public function convertJqueryDateToSqlDate($date){
		$time_array = array(
						'00:00'=> 'AM 0:00',
						'00:10'=> 'AM 0:10',
						'00:20'=> 'AM 0:20',
						'00:30'=> 'AM 0:30',
						'00:40'=> 'AM 0:40',
						'00:50'=> 'AM 0:50',
						'01:00'=> 'AM 1:00',
						'01:10'=> 'AM 1:10',
						'01:20'=> 'AM 1:20',
						'01:30'=> 'AM 1:30',
						'01:40'=> 'AM 1:40',
						'01:50'=> 'AM 1:50',
						'02:00'=> 'AM 2:00',
						'02:10'=> 'AM 2:10',
						'02:20'=> 'AM 2:20',
						'02:30'=> 'AM 2:30',
						'02:40'=> 'AM 2:40',
						'02:50'=> 'AM 2:50',
						'03:00'=> 'AM 3:00',
						'03:10'=> 'AM 3:10',
						'03:20'=> 'AM 3:20',
						'03:30'=> 'AM 3:30',
						'03:40'=> 'AM 3:40',
						'03:50'=> 'AM 3:50',
						'04:00'=> 'AM 4:00',
						'04:10'=> 'AM 4:10',
						'04:20'=> 'AM 4:20',
						'04:30'=> 'AM 4:30',
						'04:40'=> 'AM 4:40',
						'04:50'=> 'AM 4:50',
						'05:00'=> 'AM 5:00',
						'05:10'=> 'AM 5:10',
						'05:20'=> 'AM 5:20',
						'05:30'=> 'AM 5:30',
						'05:40'=> 'AM 5:40',
						'05:50'=> 'AM 5:50',
						'06:00'=> 'AM 6:00',
						'06:10'=> 'AM 6:10',
						'06:20'=> 'AM 6:20',
						'06:30'=> 'AM 6:30',
						'06:40'=> 'AM 6:40',
						'06:50'=> 'AM 6:50',
						'07:00'=> 'AM 7:00',
						'07:10'=> 'AM 7:10',
						'07:20'=> 'AM 7:20',
						'07:30'=> 'AM 7:30',
						'07:40'=> 'AM 7:40',
						'07:50'=> 'AM 7:50',
						'08:00'=> 'AM 8:00',
						'08:10'=> 'AM 8:10',
						'08:20'=> 'AM 8:20',
						'08:30'=> 'AM 8:30',
						'08:40'=> 'AM 8:40',
						'08:50'=> 'AM 8:50',
						'09:00'=> 'AM 9:00',
						'09:10'=> 'AM 9:10',
						'09:20'=> 'AM 9:20',
						'09:30'=> 'AM 9:30',
						'09:40'=> 'AM 9:40',
						'09:50'=> 'AM 9:50',
						'10:00'=> 'AM 10:00',
						'10:10'=> 'AM 10:10',
						'10:20'=> 'AM 10:20',
						'10:30'=> 'AM 10:30',
						'10:40'=> 'AM 10:40',
						'10:50'=> 'AM 10:50',
						'11:00'=> 'AM 11:00',
						'11:10'=> 'AM 11:10',
						'11:20'=> 'AM 11:20',
						'11:30'=> 'AM 11:30',
						'11:40'=> 'AM 11:40',
						'11:50'=> 'AM 11:50',
						'12:00'=> 'PM 12:00',
						'12:10'=> 'PM 12:10',
						'12:20'=> 'PM 12:20',
						'12:30'=> 'PM 12:30',
						'12:40'=> 'PM 12:40',
						'12:50'=> 'PM 12:50',
						'13:00'=> 'PM 1:00',
						'13:10'=> 'PM 1:10',
						'13:20'=> 'PM 1:20',
						'13:30'=> 'PM 1:30',
						'13:40'=> 'PM 1:40',
						'13:50'=> 'PM 1:50',
						'14:00'=> 'PM 2:00',
						'14:10'=> 'PM 2:10',
						'14:20'=> 'PM 2:20',
						'14:30'=> 'PM 2:30',
						'14:40'=> 'PM 2:40',
						'14:50'=> 'PM 2:50',
						'15:00'=> 'PM 3:00',
						'15:10'=> 'PM 3:10',
						'15:20'=> 'PM 3:20',
						'15:30'=> 'PM 3:30',
						'15:40'=> 'PM 3:40',
						'15:50'=> 'PM 3:50',
						'16:00'=> 'PM 4:00',
						'16:10'=> 'PM 4:10',
						'16:20'=> 'PM 4:20',
						'16:30'=> 'PM 4:30',
						'16:40'=> 'PM 4:40',
						'16:50'=> 'PM 4:50',
						'17:00'=> 'PM 5:00',
						'17:10'=> 'PM 5:10',
						'17:20'=> 'PM 5:20',
						'17:30'=> 'PM 5:30',
						'17:40'=> 'PM 5:40',
						'17:50'=> 'PM 5:50',
						'18:00'=> 'PM 6:00',
						'18:10'=> 'PM 6:10',
						'18:20'=> 'PM 6:20',
						'18:30'=> 'PM 6:30',
						'18:40'=> 'PM 6:40',
						'18:50'=> 'PM 6:50',
						'19:00'=> 'PM 7:00',
						'19:10'=> 'PM 7:10',
						'19:20'=> 'PM 7:20',
						'19:30'=> 'PM 7:30',
						'19:40'=> 'PM 7:40',
						'19:50'=> 'PM 7:50',
						'20:00'=> 'PM 8:00',
						'20:10'=> 'PM 8:10',
						'20:20'=> 'PM 8:20',
						'20:30'=> 'PM 8:30',
						'20:40'=> 'PM 8:40',
						'20:50'=> 'PM 8:50',
						'21:00'=> 'PM 9:00',
						'21:10'=> 'PM 9:10',
						'21:20'=> 'PM 9:20',
						'21:30'=> 'PM 9:30',
						'21:40'=> 'PM 9:40',
						'21:50'=> 'PM 9:50',
						'22:00'=> 'PM 10:00',
						'22:10'=> 'PM 10:10',
						'22:20'=> 'PM 10:20',
						'22:30'=> 'PM 10:30',
						'22:40'=> 'PM 10:40',
						'22:50'=> 'PM 10:50',
						'23:00'=> 'PM 11:00',
						'23:10'=> 'PM 11:10',
						'23:20'=> 'PM 11:20',
						'23:30'=> 'PM 11:30',
						'23:40'=> 'PM 11:40',
						'23:50'=> 'PM 11:50',
					);
		$date_array = explode(" ",$date);
		$key = array_search($date_array[1]." ".$date_array[2],$time_array);
		return $date_array[0]." ".$key;
	}

	function getStatesArray(){
		$states=array(
			'AL'=>'Alabama',
			'AK'=>'Alaska',
			'AZ'=>'Arizona',
			'AR'=>'Arkansas',
			'CA'=>'California',
			'CO'=>'Colorado',
			'CT'=>'Connecticut',
			'DE'=>'Delaware',
			'DC'=>'District of Columbia',
			'FL'=>'Florida',
			'GA'=>'Georgia',
			'HI'=>'Hawaii',
			'ID'=>'Idaho',
			'IL'=>'Illinois',
			'IN'=>'Indiana',
			'IA'=>'Iowa',
			'KS'=>'Kansas',
			'KY'=>'Kentucky',
			'LA'=>'Louisiana',
			'ME'=>'Maine',
			'MD'=>'Maryland',
			'MA'=>'Massachusetts',
			'MI'=>'Michigan',
			'MN'=>'Minnesota',
			'MS'=>'Mississippi',
			'MO'=>'Missouri',
			'MT'=>'Montana',
			'NE'=>'Nebraska',
			'NV'=>'Nevada',
			'NH'=>'New Hampshire',
			'NJ'=>'New Jersey',
			'NM'=>'New Mexico',
			'NY'=>'New York',
			'NC'=>'North Carolina',
			'ND'=>'North Dakota',
			'OH'=>'Ohio',
			'OK'=>'Oklahoma',
			'OR'=>'Oregon',
			'PA'=>'Pennsylvania',
			'RI'=>'Rhode Island',
			'SC'=>'South Carolina',
			'SD'=>'South Dakota',
			'TN'=>'Tennessee',
			'TX'=>'Texas',
			'UT'=>'Utah',
			'VT'=>'Vermont',
			'VA'=>'Virginia',
			'WA'=>'Washington',
			'WV'=>'West Virginia',
			'WI'=>'Wisconsin',
			'WY'=>'Wyoming'
		);
		return $states;
	}
	
	function getCountriesArray(){
		
		return $countries;
	}

	public function get_all_languages(){
		$this->db->select("*");
		$this->db->where('status',1);
		$this->db->from('language');
		$query = $this->db->get();
		if($query->num_rows()){
			return $query->result();
		}
		return array();
	}		
}

?>
