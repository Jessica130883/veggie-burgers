<?php
 
 class Database {
    private $bdd;  

    public function __construct() {  
        try {
            $this->bdd = new PDO('mysql:host=127.0.0.1;dbname=veggie_burger;charset=utf8', 'admin_veggie', 'veggiemdp');
            $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Erreur de connexion : ' . $e->getMessage());
        }
    }

    
    public function getBdd() {
        return $this->bdd;  
    }
}





?>