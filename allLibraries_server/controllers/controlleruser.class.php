<?php 
/**
 * 
 */
class ControllerUser 
{
	private $_user;

	public function __construct(){
        $this->_user = new User();
    }

    public function login($array){
    
    	$resultcheckUser = $this->_user->checkUser($array);
    	
		if ($resultcheckUser["status"]) {
			$resultLogin = $this->_user->updateToken($resultcheckUser["user"]);
			
		}else{
			$resultLogin = $resultcheckUser ;
		}

		$jsonLogin = json_encode($resultLogin);

		echo $jsonLogin;
		die;

		// return $jsonLogin;
	}

	public function signout($array){
    
    	$result = $this->_user->deleteToken($array);
		$jsonLogin = json_encode($result);

		echo $jsonLogin;
		die;

		// return $jsonLogin;
	}

	public function token_validate($array){
    
    	$result = $this->_user->checkToken($array);

		return $result;
	}



} 