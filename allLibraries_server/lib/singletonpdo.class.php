<?php

class SingletonPDO {

    private $PDOInstance = null;
        
    private static $instance = null;
    
    const DB_SERVEUR = 'localhost';
    // Login
    const DB_LOGIN = 'root';
    // Mot de passe
    const DB_PASSWORD= '';
    // Nom de la base de données
    const DB_NOM = 'all_libraries';
    // Driver correspondant à la BDD utilisée
    //const DB_DSN = 'mysql:host='. DB_SERVEUR .';dbname='. DB_NOM;
    
    
    private function __construct(){
        $this->PDOInstance = new PDO('mysql:host='. self::DB_SERVEUR .';dbname='. self::DB_NOM, self::DB_LOGIN, self::DB_PASSWORD);
    }
    
    static function getInstance(){
        if(is_null(self::$instance)){
            //echo 'Je vais creer une instance de PDO<br/>';
            self::$instance = new SingletonPDO();
        }
        //echo 'Je renvoie l\'instance<br/>';
        return self::$instance;
    }
    
    private function __clone(){}
    
    function __call($name, $arguments){
        
       // var_dump($name);
        //var_dump($arguments);
        
        return $this->PDOInstance->{$name}(implode(',', $arguments));
    }

}
