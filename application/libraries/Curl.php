<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Curl
{
	function __construct(){
		$CI = & get_instance();
		$CI->load->library('session');
		$this->CI = $CI;
	}
	
	function getFileContent($url){
		$result = file_get_contents($url);
		return $result;
	}
	
	function getAuthenticationToken(){
		$url = "https://qissamiddleware.azurewebsites.net/api/auth";
		$username = 'Qissa';
		//HTTP password.
		$password = 'kT%S3G2AES';
		$headers = array(
			'Authorization: Basic '.base64_encode($username.":".$password)
		);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$output = curl_exec($ch);
		return $output;
	}
	
	function testAuthorization(){
		$url = "https://qissamiddleware.azurewebsites.net/api/test";
		$headers = array(
			"Authorization: Bearer ".$this->CI->session->userdata("auth_token")
		);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$output = curl_exec($ch);
		return $output;
	}
	
	function searchVideo($url){
		$curl_handle = curl_init();
		curl_setopt($curl_handle, CURLOPT_URL, $url);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl_handle,CURLOPT_SSL_VERIFYPEER ,false);
		curl_setopt($curl_handle, CURLOPT_HTTPGET , 1);
		curl_setopt($curl_handle, CURLOPT_HTTPHEADER, array('api-key:44F7B79D277CC160108CF603A6A99936'));
		$buffer = curl_exec($curl_handle);
		if($buffer === false){
			echo curl_error($curl_handle);
			die('error');
		}
		
		curl_close($curl_handle);
		$result = json_decode($buffer);
		return $result;
	}

	
	function getRequest($url){
		$curl_handle = curl_init();
		curl_setopt($curl_handle, CURLOPT_URL, $url);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl_handle,CURLOPT_SSL_VERIFYPEER ,false);
		curl_setopt($curl_handle, CURLOPT_HTTPGET , 1);
		$buffer = curl_exec($curl_handle);
		if($buffer === false){
			echo curl_error($curl_handle);
			die('error');
		}
		curl_close($curl_handle);
		$result = json_decode($buffer);
		return $result;
	}
	

	function getAccessToken($api){
		$url = "https://api-gateway.sandbox.ngenius-payments.com/identity/auth/access-token";
		$headers = array(
			'Content-Type: application/vnd.ni-identity.v1+json',
			"Authorization: Basic ".$api
		);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

		curl_setopt($ch, CURLOPT_POSTFIELDS,  "{\"realmName\":\"ni\"}");

		$buffer = curl_exec($ch);
		if($buffer === false){
			echo curl_error($ch);
			die('error');
		}
		curl_close($ch);
		$result = json_decode($buffer);

		return $result->access_token;
	}

	function postRequest($url,$data,$access_token){
		$curl_handle = curl_init();
		$headers = array(
			"merchant_key: ".$access_token,
			"Content-Type: application/json"
		);
		curl_setopt($curl_handle, CURLOPT_URL, $url);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl_handle, CURLOPT_POST, 1);
		curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER ,false);
		curl_setopt($curl_handle, CURLOPT_POSTFIELDS, json_encode($data));
		curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
		$buffer = curl_exec($curl_handle);
		if($buffer === false){
			echo curl_error($curl_handle);
			die('error');
		}
		curl_close($curl_handle);
		$result = json_decode($buffer);
		return $result;
	}
	
	function putRequest($url,$data,$token){
		$curl_handle = curl_init();
		$headers = array(
			"Authorization: Bearer ".$token, 
			"Content-Type: application/vnd.ni-payment.v2+json", "Accept:application/vnd.ni-payment.v2+json"
		);
		curl_setopt($curl_handle, CURLOPT_URL, $url);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "PUT");
		curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER ,false);
		//curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
		if($data!=''){
			curl_setopt($curl_handle, CURLOPT_POSTFIELDS, json_encode($data));
		}else{
			curl_setopt($curl_handle, CURLOPT_POSTFIELDS, json_encode(array()));
		}
		$buffer = curl_exec($curl_handle);
		
		if($buffer === false){
			echo curl_error($curl_handle);
			die('error');
		}
		curl_close($curl_handle);
		$result = json_decode($buffer);
		return $result;

	}
	
	
	function deleteRequest($url,$data=''){
		$curl_handle = curl_init();
		$headers = array(
			"Content-Type: application/json"
		);
		curl_setopt($curl_handle, CURLOPT_URL, $url);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "DELETE");
		curl_setopt($curl_handle,CURLOPT_SSL_VERIFYPEER ,false);
		curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
		if($data!=''){
			curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $data);
		}
		$buffer = curl_exec($curl_handle);
		if($buffer === false){
			die('af');
			echo curl_error($curl_handle);
			die('error');
		}
		curl_close($curl_handle);
		$result = json_decode($buffer);
		return $result;
	}
}
