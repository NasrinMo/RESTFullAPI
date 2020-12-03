<?php

class User {


    public function __construct(){
        
    }

    function checkUser($inputs){

    	$arrayInputs = json_decode($inputs["postData"], true);

	    $db = SingletonPDO::getInstance();

	    $oPDOStatement = $db->prepare(
	        'SELECT * from users where email=:email
	         AND password = :password '
	    );

	    $oPDOStatement->bindParam(':email', $arrayInputs["email"], PDO::PARAM_STR);
	    $oPDOStatement->bindParam(':password', $arrayInputs["password"], PDO::PARAM_STR);

	    $oPDOStatement->execute();
	    $user = $oPDOStatement->fetch(PDO::FETCH_ASSOC);
	    
	    if ($user != "") {
	    	$array = array("status"  => true ,
	    					"user" => $user  );
	    }else{
	    	$array = array("status"  => false ,
                                "message" => "Username or Password is Incorrect");
	    }

	    return $array;
	}

    function updateToken($array){
    	
    	$token = md5($array["email"].$array["create_at"].date("h:mi:s"));
    	$db = SingletonPDO::getInstance();

	    $oPDOStatement = $db->prepare(
	        'Update users set tokenAccess = :token where email=:email
	         AND password = :password '
	    );

	    $oPDOStatement->bindParam(':email', $array["email"], PDO::PARAM_STR);
	    $oPDOStatement->bindParam(':password', $array["password"], PDO::PARAM_STR);
	    $oPDOStatement->bindParam(':token', $token, PDO::PARAM_STR);

	    if ($oPDOStatement->execute()) {
             $array = array(  "status"  => true ,
                              "message" => "Successfully",
                        	    "token" => $token,
                        	       "id" => $array["id"],
                        	"firstName" => $array["firstName"],
                        	 "lastName" => $array["lastName"]);
        }else{
             $array = array("status"  => false ,
                            "message" => "Adding Token is Failed");
        }

        return $array;
	}

	function checkToken($inputs){
		
    	$array = json_decode($inputs["postData"], true);
	    $db = SingletonPDO::getInstance();

	    $oPDOStatement = $db->prepare(
	        'SELECT * from users where tokenAccess = :token '
	    );
	 
	    $oPDOStatement->bindParam(':token', $array["token"], PDO::PARAM_STR);

	    $oPDOStatement->execute();
	    $user = $oPDOStatement->fetch(PDO::FETCH_ASSOC);
	    
	    if ($user != "") {
	    	return true;
	    }else{
	    	return false;
	    }

	}

	function deleteToken($inputs){

		$db = SingletonPDO::getInstance();

    	$postData = json_decode($inputs["postData"], true);

	    $oPDOStatement = $db->prepare(
	        'Update users set tokenAccess = NULL where tokenAccess = :token '
	    );

	    $oPDOStatement->bindParam(':token', $postData["token"], PDO::PARAM_STR);

	    if ($oPDOStatement->execute()) {
             $array = array("status"  => true ,
                            "message" => "Successfully",);
        }else{
             $array = array("status"  => false ,
                            "message" => "Deleting Token is Failed");
        }

        return $array;
	}

    
}