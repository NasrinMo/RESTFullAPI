<?php
class ControllerUser{
	
	private $_user;

	public function __construct(){
        $this->_user = new User();
    }

	public function login($array){

		$result = $this->_user->checkUser($array);
	
		if($result["status"]){


			return $this->_user->setSession($result);

		}
		
		 return false;	
	}

	public function signout($token){

		$result = $this->_user->destroyToken($token);
	
		if($result["status"]){
			
			return session_destroy();
		}
		
		 return false;	
	}

	public function validate ($array){
		return true;
	}
}