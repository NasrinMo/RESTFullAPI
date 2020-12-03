<?php



//add appointment
//==============================================

$postData = [
	'id_user'=>2,
	'id_library_book'=>3,
	'appointmentDate'=>"2020-11-17 09:48:00",
	'token' => "99fc234894e6327f21fed24b0e9a89ac"
	];


$ch=curl_init('http://127.0.0.1/php/allLibraries_server/appointment/insert');   


curl_setopt($ch, CURLOPT_POST,true);     //POST
curl_setopt($ch, CURLOPT_POSTFIELDS, array('postData'=>json_encode($postData)));


$resultat_Json=curl_exec($ch);
$array_curl_info=curl_getinfo($ch);
curl_close($ch);

echo "<pre>";
$aResultat=json_decode($resultat_Json,true); //Convert to array - true
$oResultat=json_decode($resultat_Json,false); //Convert to object - false
var_dump($oResultat);
echo "</pre>";
die;



//Delete
//==============================================

// $ch=curl_init('http://127.0.0.1/php/allLibraries_server/appointment/remove/1');

// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
// curl_setopt($ch, CURLOPT_POSTFIELDS,true);

// $resultat_Json=curl_exec($ch);

// echo "<pre>";
// $oResultat=json_decode($resultat_Json,false); 
// var_dump($oResultat);
// echo "</pre>";

// die;


//modify appointment
//==============================================
// $postData = [
// 	'id'=>14,
// 	'id_user'=>2,
// 	'id_library_book'=>3,
// 	'appointmentDate'=>"2020-08-27 14:45:00",
//  'token' => "99fc234894e6327f21fed24b0e9a89ac"
// 	];


// $ch=curl_init('http://127.0.0.1/php/allLibraries_server/appointment/modify');   

// curl_setopt($ch, CURLOPT_POST,true);     //POST
// curl_setopt($ch, CURLOPT_POSTFIELDS, array('postData'=>json_encode($postData)));

// $resultat_Json=curl_exec($ch);
// $array_curl_info=curl_getinfo($ch);
// curl_close($ch);

// echo "<pre>";
// $aResultat=json_decode($resultat_Json,true); //Convert to array - true
// $oResultat=json_decode($resultat_Json,false); //Convert to object - false
// var_dump($oResultat);
// echo "</pre>";
// die;

//******************************************************************
// curl_setopt($ch, CURLOPT_PUT, 1);     
// curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
// curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query(array('postData'=>json_encode($postData))));	
// curl_setopt($ch, CURLOPT_USERPWD, '582P41:ABC123!');
// curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");	
// curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));

//Login
//================================================================
// $postData = [
// 	'email'=>'nasrin@yahoo.com',
// 	'password'=>'123'
// 	];


// $ch=curl_init('http://127.0.0.1/php/allLibraries_server/user/login');   


// curl_setopt($ch, CURLOPT_POST,true);     //POST
// curl_setopt($ch, CURLOPT_POSTFIELDS, array('postData'=>json_encode($postData)));

// $resultat_Json=curl_exec($ch);
// $array_curl_info=curl_getinfo($ch);
// curl_close($ch);

// echo "<pre>";
// $aResultat=json_decode($resultat_Json,true); //Convert to array - true
// $oResultat=json_decode($resultat_Json,false); //Convert to object - false
// var_dump($oResultat);
// echo "</pre>";
// die;



?>


