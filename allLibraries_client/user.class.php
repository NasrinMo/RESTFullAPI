<?php
class User{

	public function __construct(){
		
	}

	public function checkUser($postData){ 

		    // setup curl options
	    $options = array(
	        CURLOPT_URL => 'http://127.0.0.1/php/allLibraries_server/user/login',
	        CURLOPT_HEADER => false,
	        CURLOPT_FOLLOWLOCATION => true,
	        CURLOPT_POST => true,
	        CURLOPT_POSTFIELDS => array('postData'=>json_encode($postData)) ,
	        CURLOPT_RETURNTRANSFER => true
	    );

	    // perform request
	    $cUrl = curl_init();
	    curl_setopt_array( $cUrl, $options );
	    $response = curl_exec( $cUrl );
	    curl_close( $cUrl );

	    // decode the response into an array
	    $decoded = json_decode( $response, true );
	    
		return $decoded;
	}

	public function setSession($array){
		
		$_SESSION["token"] = $array["token"];
		$_SESSION["id"] = $array["id"];
		$_SESSION["firstName"] = $array["firstName"];
		$_SESSION["lastName"] = $array["lastName"];
		
		return true;
	}

		public function destroyToken($token){ 

		$postData = ["token" => $token ];

		    // setup curl options
	    $options = array(
	        CURLOPT_URL => 'http://127.0.0.1/php/allLibraries_server/user/signout',
	        CURLOPT_HEADER => false,
	        CURLOPT_FOLLOWLOCATION => true,
	        CURLOPT_POST => true,
	        CURLOPT_POSTFIELDS => array('postData'=>json_encode($postData)) ,
	        CURLOPT_RETURNTRANSFER => true
	    );

	    // perform request
	    $cUrl = curl_init();
	    curl_setopt_array( $cUrl, $options );
	    $response = curl_exec( $cUrl );
	    curl_close( $cUrl );

	    // decode the response into an array
	    $decoded = json_decode( $response, true );
	    
		return $decoded;
	}

}