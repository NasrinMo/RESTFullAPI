<?php

class Book {


    public function __construct(){
        
    }

    function getAllBooks(){

	    $db = SingletonPDO::getInstance();
	    $oPDOStatement = $db->prepare(
	        'SELECT * FROM books'
	    );

	    $oPDOStatement->execute();
	    $arrondissements = $oPDOStatement->fetchAll(PDO::FETCH_ASSOC);
	    return $arrondissements;
	}

    function getBooksbyLibraryID($id_library){

	    $db = SingletonPDO::getInstance();
	    $oPDOStatement = $db->prepare(
			'SELECT b.*,lb.id_library ,l.name
				FROM library_book lb,books b,libraries l
				where b.id = lb.id_book
                and l.id = lb.id_library
				and lb.id_library = :id_library'
	    );

	    $oPDOStatement->bindParam(':id_library', $id_library, PDO::PARAM_INT);

	    $oPDOStatement->execute();
	    $arrondissements = $oPDOStatement->fetchAll(PDO::FETCH_ASSOC);
	    return $arrondissements;
	}

	 function getBookById($id_book){

	    $db = SingletonPDO::getInstance();
	    $oPDOStatement = $db->prepare(
			'SELECT * from books where id =:id'
	    );

	    $oPDOStatement->bindParam(':id', $id_book, PDO::PARAM_INT);

	    $oPDOStatement->execute();
	    $arrondissement = $oPDOStatement->fetch(PDO::FETCH_ASSOC);
	    return $arrondissement;
	}

	function getAllLibrariesBooks(){

	    $db = SingletonPDO::getInstance();
	    $oPDOStatement = $db->prepare(
	        'SELECT b.title ,b.writer,l.name
			from books b,libraries l,library_book lb
			where b.id = lb.id_book
			and l.id = lb.id_library
			ORDER by b.id'
	    );

	    $oPDOStatement->execute();
	    $arrondissements = $oPDOStatement->fetchAll(PDO::FETCH_ASSOC);
	    return $arrondissements;
	}

    
}

