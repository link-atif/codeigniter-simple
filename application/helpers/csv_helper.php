<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// ------------------------------------------------------------------------
if ( ! function_exists('exportExcel')){
	function exportExcel(){
		$CI =& get_instance();
		//load our new PHPExcel library
		$CI->load->library('excel');

		//$CI->load->model('Client_model');


		//activate worksheet number 1
		$CI->excel->setActiveSheetIndex(0);
		//name the worksheet
		$CI->excel->getActiveSheet()->setTitle('Clients');
		//set cell A1 content with some text
		$CI->excel->setActiveSheetIndex(0)
					->setCellValue('A1', 'Name')
					->setCellValue('B1', 'Email')
					->setCellValue('C1', 'Username')
					->setCellValue('D1', 'Password')
					->setCellValue('E1', 'Mac Address')
					->setCellValue('F1', 'Subscription Start Date')
					->setCellValue('G1', 'Subscription End date')
					->setCellValue('H1', 'Subscription Period')
					->setCellValue('I1', 'Amount')
					->setCellValue('J1', 'Note')
					->setCellValue('K1', 'Status')
					->setCellValue('L1', 'Address')
					->setCellValue('M1', 'Number')
					->setCellValue('N1', 'System')
					->setCellValue('O1', 'Agent')
					->setCellValue('P1', 'Referer');
		$i=2;
		/*foreach($clientRows as $row){
		$CI->excel->setActiveSheetIndex(0)
					->setCellValue('A'.$i, $row->name)
					->setCellValue('B'.$i, $row->email)
					->setCellValue('C'.$i, $row->username)
					->setCellValue('D'.$i, $row->password)
					->setCellValue('E'.$i, $row->mac_address)
					->setCellValue('F'.$i, $row->subscription_start_date)
					->setCellValue('G'.$i, $row->subscription_end_date)
					->setCellValue('H'.$i, $row->subscription_period)
					->setCellValue('I'.$i, $row->amount)
					->setCellValue('J'.$i, $row->note)
					->setCellValue('K'.$i, $row->status)
					->setCellValue('L'.$i, $row->address)
					->setCellValue('M'.$i, $row->number)
					->setCellValue('N'.$i, $row->system)
					->setCellValue('O'.$i, $row->agent)
					->setCellValue('P'.$i, $row->referer);
					$i++;
		}*/
		// Clone worksheet
		$donationSheet = $CI->excel->createSheet();
		
		


		$filename='_clients.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
		            
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($CI->excel, 'Excel5');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save(base_url()."assets"."/".$filename);
		exit();
	}
}

if ( ! function_exists('array_to_csv'))
{
	function array_to_csv($array, $download = "")
	{
		if ($download != "")
		{	
			header('Content-Type: application/csv');
			header('Content-Disposition: attachement; filename="' . $download . '"');
		}		

		ob_start();
		$f = fopen('php://output', 'w') or show_error("Can't open php://output");
		$n = 0;		
		foreach ($array as $line)
		{
			$n++;
			if ( ! fputcsv($f, $line))
			{
				show_error("Can't write line $n: $line");
			}
		}
		fclose($f) or show_error("Can't close php://output");
		$str = ob_get_contents();
		ob_end_clean();

		if ($download == "")
		{
			return $str;	
		}
		else
		{	
			echo $str;
		}		
	}
}

// ------------------------------------------------------------------------

/**
 * Query to CSV
 *
 * download == "" -> return CSV string
 * download == "toto.csv" -> download file toto.csv
 */
if ( ! function_exists('query_to_csv'))
{
	function query_to_csv($query, $headers = TRUE, $download = "")
	{
		if ( ! is_object($query) OR ! method_exists($query, 'list_fields'))
		{
			show_error('invalid query');
		}
		
		$array = array();
		
		if ($headers)
		{
			$line = array();
			foreach ($query->list_fields() as $name)
			{
				$line[] = $name;
			}
			$array[] = $line;
		}
		
		foreach ($query->result_array() as $row)
		{
			$line = array();
			foreach ($row as $item)
			{
				$line[] = $item;
			}
			$array[] = $line;
		}

		echo array_to_csv($array, $download);
	}
}

function export_csv(){ 
		// file name 
	$filename = 'users_'.date('Ymd').'.csv'; 
	header("Content-Description: File Transfer"); 
	header("Content-Disposition: attachment; filename=$filename"); 
	header("Content-Type: application/csv; ");
   // get data 
	//$usersData = $this->Crud_model->getUserDetails();
	// file creation 
	$file = fopen('php://output','w');
	$header = array("Username","Name","Gender","Email"); 
	fputcsv($file, $header);
	/*foreach ($usersData as $key=>$line){ 
		fputcsv($file,$line); 
	}*/
	fclose($file); 
	exit; 
}

function exportProducts($products)
{	
	$filename = 'uploads/exports/'.date('YmdHi').'.csv';
    $f = fopen($filename,'w');
	fputcsv($f, array('id','Name', 'Email'));
	foreach ($products as $key => $entry)
	{   
		fputcsv($f,array($entry->id, $entry->name, $entry->email));
	}
    //fseek($f, 0);
    //header('Content-Type: application/csv');
    //header('Content-Disposition: attachement; filename="' . $output_file_name . '";');
    //fpassthru($f);
    fclose($f);
	header('Content-Type: application/json');
	echo json_encode(
	    [
	        "filename" => basename($filename),
	    ]
	);
}

function convert_to_csv($orders)
{	
	$CI =& get_instance();
	$CI->load->model('Products_model');

	$filename = 'attachments/csv/'.'summary_'.date('YmdHi').'.csv';
    $f = fopen($filename,'w');
   
	fputcsv($f, array('Order Id', 'Product Title', 'Payment Type', 'Status', 'Name', 'Email', 'Phone', 'Address', 'Discount Code', 'Diccount Amount', 'Final Amount', 'Date'));
	foreach ($orders as $key=>$entry)
	{
		$p_title = array();
		$products = unserialize($entry['products']);
		foreach ($products as $key => $value) {
			$p_id =  $value['product_info']['id'];
			$p_title[] = $CI->Products_model->getProductName($p_id);
		}
		$product_title = implode(',', $p_title);
		$arr['0'] = 'No processed';
		$arr['1'] = 'Processed';
		$arr['2'] = 'Rejected';
		$arr['3'] = 'Returned';
		$status = $arr[$entry['processed']];
        
		fputcsv($f,array($entry['order_id'], $product_title, $entry['payment_type'], $status, ($entry['first_name']." ".$entry['last_name']), $entry['email'], $entry['phone'], $entry['address'], $entry['discount_code'], $entry['discount_amount'], $entry['final_amount'], date('d.M.Y / H:i:s', $entry['date'])));

	}
    //fseek($f, 0);
    //header('Content-Type: application/csv');
    //header('Content-Disposition: attachement; filename="' . $output_file_name . '";');
    //fpassthru($f);
    fclose($f);
	header('Content-Type: application/json');
	echo json_encode(
	    [
	        "filename" => basename($filename),
	    ]
	);
}

function exportUsers($users){
	$filename = 'uploads/exports/users_'.date('YmdHi').'.csv';
    $f = fopen($filename,'w');
	fputcsv($f, array('id','Name', 'Email', 'Plan', 'Price', 'Duration', 'Status', 'Joining Date'));
	foreach ($users as $key => $entry){   
		fputcsv($f,array($entry->id, ($entry->f_name." ".$entry->l_name), $entry->email, $entry->plan_heading, $entry->plan_price, $entry->plan_duration, $entry->type, ($entry->is_premium ? "Active" : "Inactive"), date("F d Y", strtotime($entry->date_created))));
	}
    fclose($f);
	header('Content-Type: application/json');
	echo json_encode(["filename" => basename($filename),]);
}


/* End of file csv_helper.php */
/* Location: ./system/helpers/csv_helper.php */