<?php

class Library {


    public function __construct(){
        
    }

    function getAllLibraries(){

	    $db = SingletonPDO::getInstance();
	    $oPDOStatement = $db->prepare(
	        'SELECT * FROM libraries'
	    );

	    $oPDOStatement->execute();
	    $arrondissements = $oPDOStatement->fetchAll(PDO::FETCH_ASSOC);
	    return $arrondissements;
	}

	function getLibrariesbyBookID($id_book){

	    $db = SingletonPDO::getInstance();
	    $oPDOStatement = $db->prepare(
			'SELECT lb.* ,l.name
				FROM library_book lb,books b,libraries l
				where b.id = lb.id_book
                and l.id = lb.id_library
				and lb.id_book = :id_book'
	    );

	    $oPDOStatement->bindParam(':id_book', $id_book, PDO::PARAM_INT);

	    $oPDOStatement->execute();
	    $arrondissements = $oPDOStatement->fetchAll(PDO::FETCH_ASSOC);
	    return $arrondissements;
	}

    
}