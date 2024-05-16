<?php 
try{
$bdd = new PDO('mysql:host=127.0.0.1;dbname=veggie_burger;charset=utf8', 'admin_veggie', 'veggiemdp');
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
die('Erreur de connexion : ' . $e->getMessage());
}

?>