<?php
require 'database.php';


$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    $db = new Database();
    $pdo = $db->getBdd();

   
    $statement = $pdo->prepare('SELECT items.id, items.name, items.description, items.price, categories.name AS category FROM items LEFT JOIN categories ON items.category = categories.id WHERE items.id = ?');
    $statement->execute([$id]);

    
    $item = $statement->fetch();

    if ($item) {
       
        echo '<h1>' . htmlspecialchars($item['name']) . '</h1>';
        echo '<p>' . htmlspecialchars($item['description']) . '</p>';
        echo '<p>' . number_format($item['price'], 2) . '</p>';
        echo '<p>' . htmlspecialchars($item['category']) . '</p>';
    } else {
        echo 'Article non trouvé.';
    }

   
    $db->disconnect();
} else {
    echo 'Identifiant invalide.';
}

?>

