<?php

/**
 * 
 */
class Func
{
	
	static function dd($data , $data2 = "" , $data3 = ""){

		if($data != "" && $data2 != "" && $data3 != "" ){
			echo "<pre>";var_dump($data ,$data2 , $data3 );
		}elseif($data != "" && $data2 != ""){
			echo "<pre>";var_dump($data ,$data2  );
		}else{
			echo "<pre>";var_dump($data  );
		}
		
		die;
	}

	//convertArrayToJson
	static function sampleWeekPattrn(){

	 	$array = array("Monday"  => "08:00-16:00",
	                   "Tuesday" => "08:00-16:00",
	                 "Wednesday" => "08:00-16:00",
	                 "Thursday"  => "08:00-16:00",
	                    "Friday" => "08:00-13:00",
	                  "Saturday" => "close",
	                    "Sunday" => "close"
		);

		$json = json_encode($array);
		die($json);

	}
}
