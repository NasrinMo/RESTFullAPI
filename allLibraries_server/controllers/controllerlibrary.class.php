<?php 
/**
 * 
 */
class ControllerLibrary
{
	private $_library;

	public function __construct(){
        $this->_library = new Library();
    }

    public function list(){

		$libraries = $this->_library->getAllLibraries();
		$jsonLibraries = json_encode($libraries);
		echo $jsonLibraries;
	}

	public function getLibraries($id_book){

		$libraries = $this->_library->getLibrariesbyBookID($id_book);
		$jsonLibraries = json_encode($libraries);
		echo $jsonLibraries;
	}

	
}