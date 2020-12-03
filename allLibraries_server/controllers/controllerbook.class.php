<?php 
/**
 * 
 */
class ControllerBook
{
	private $_book;

	public function __construct(){
        $this->_book = new Book();
    }

     public function list(){

		$books = $this->_book->getAllBooks();
		$jsonBooks = json_encode($books);
		echo $jsonBooks;
	}

    public function getBooksByLibrary($id_library){

		$books = $this->_book->getBooksbyLibraryID($id_library);
		$jsonBooks = json_encode($books);
		echo $jsonBooks;
	}

	public function getBook($id_book){

		$book = $this->_book->getBookById($id_book);
		$jsonBook = json_encode($book);
		echo $jsonBook;
	}

	public function libraryBookList(){

		$librariesBooks = $this->_book->getAllLibrariesBooks();
		$jsonLibrariesBooks = json_encode($librariesBooks);
		echo $jsonLibrariesBooks;
	}

	

} 