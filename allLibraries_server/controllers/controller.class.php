<?php

class Controller {
    
    private $_ctrlLibrary;
    private $_ctrlBook;
    private $_ctrlAppointment;
    private $_ctrlUser;
    
    
    public function __construct(){
        $this->_ctrlLibrary = new ControllerLibrary();
        $this->_ctrlBook = new ControllerBook();
        $this->_ctrlAppointment = new ControllerAppointment();
        $this->_ctrlUser = new ControllerUser();

    }
    
    public function router(){
        try{

        	if (isset($_SERVER['REQUEST_METHOD'])) {
				$method=$_SERVER['REQUEST_METHOD'];
			}else{
				$method = "";
			}

			if (isset($_GET['class'])) {
				$class=$_GET['class'];
			}else{
				$class = "";
			}

			if (isset($_GET['action'])) {
				$action=$_GET['action'];
			}else{
				$action = "";
			}


			switch ($method) {

				case 'GET':
					switch ($class) {
						case 'book':
							switch ($action) {
								case 'select':
									//SELECT BOOK BY LIBRARY ID OR SELECT BOOK BY BOOK ID
									if (isset($_GET["id"]) && isset($_GET["table"])) {
										$this->_ctrlBook->getBooksByLibrary($_GET["id"]);
									}elseif (isset($_GET["id"])) {
										$this->_ctrlBook->getBook($_GET["id"]);
									}
									break;
								case 'list':
									$this->_ctrlBook->list();
									break;

								default:
									die("ERROR 404!!");
									break;
							}
							break;

						case 'library':
							switch ($action) {
								case 'list':
									$this->_ctrlLibrary->list();
									break;
								case 'select':
									if (isset($_GET["id"])) {
										$this->_ctrlLibrary->getLibraries($_GET["id"]);
									}
									break;
								default:
									die("ERROR 404!!");
									break;
							}
							break;

						case 'library-book':
							switch ($action) {
								case 'list':
									$this->_ctrlBook->libraryBookList();
									break;
								default:
									die("ERROR 404!!");
									break;
							}
							break;

						case 'appointment':
							switch ($action) {
								case 'list':
									if (isset($_GET["id"])) {
										$this->_ctrlAppointment->list($_GET["id"]);
									}
									break;
								case 'select':
									if (isset($_GET["id"])) {
										$this->_ctrlAppointment->getAppointment($_GET["id"]);
									}
									break;
								default:
									die("ERROR 404!!");
									break;
							}
							break;

						default:
							die("ERROR 404!!");
							break;
					}
					
					break;
				case 'POST':
					switch ($class) {
						case 'appointment':
							switch ($action) {
								case 'insert':
									$validate = $this->_ctrlUser->token_validate($_POST);
									if($validate){
										$this->_ctrlAppointment->create($_POST);
									}else{
										echo "Token is Not Valid";
									}		
									break;
								case 'modify':	
									$validate = $this->_ctrlUser->token_validate($_POST);

									if($validate){
										if (isset($_POST)) {
											$this->_ctrlAppointment->edit($_POST);
										}
									}else{
										echo "Token is Not Valid";
									}	
									break;
								case 'remove':
									$validate = $this->_ctrlUser->token_validate($_POST);
									if($validate){
										if (isset($_GET["id"])) {
											$result = $this->_ctrlAppointment->remove($_GET["id"]);
										}
									}else{
										echo "Token is Not Valid";
									}				
									break;
								default:
									die("ERROR 404!!");
									break;
							}
							break;
						case 'user':
							switch ($action) {
								case 'login':
								
									if (isset($_POST)) {
										$this->_ctrlUser->login($_POST);
									}
									break;
								case 'signout':
								
									$validate = $this->_ctrlUser->token_validate($_POST);

									if($validate){
										if (isset($_POST)) {
											$this->_ctrlUser->signout($_POST);
										}
									}else{
										echo "Token is Not Valid";
									}
									break;

								default:
									die("ERROR 404!!");
									break;
							}
							break;

						default:
							die("ERROR 404!!");
						break;
					}
					break;
				default:
					die("ERROR 404!!");
					break;
			}

            

        }catch(Exception $e){
            echo "Error";
        }   
    }
    
} 