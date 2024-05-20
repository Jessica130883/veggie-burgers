<?php
require 'database.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    $dbInstance = new Database();
    $pdo = $dbInstance->getBdd(); 

    $statement = $pdo->prepare('SELECT items.id, items.name, items.description, items.price, items.image, categories.name AS category FROM items LEFT JOIN categories ON items.category = categories.id WHERE items.id = ?');
    $statement->execute([$id]);

    $item = $statement->fetch();

    if (!$item) {
        $error = "Article non trouvé.";
    }
} else {
    $error = "Identifiant invalide.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="Stylesheet" href="../Stylesheet.css">
    <title>Voir un article</title>
</head>
    
    <body>
      <h1 class="text-logo"><span class="bi-shop"></span> Veggie Burger <span class="bi-shop"></span></h1>
      <div class="container admin">
        <div class="row">
          <div class="col-md-6">
            <h1><strong>Voir un item</strong></h1>
            <br>
            <form>
              <div>
                <label>Nom :</label><?php echo '  '.$item['name'];?>
              </div>
              <br>
              <div>
                <label>Description :</label><?php echo '  '.$item['description'];?>
              </div>
              <br>
              <div>
                <label>Prix:</label><?php echo '  '.number_format((float)$item['price'], 2, '.', ''). ' €';?>
              </div>
              <br>
              <div>
                <label>Catégorie:</label><?php echo '  '.$item['category'];?>
              </div>
              <br>
              <div>
                <label>Image:</label><?php echo '  '.$item['image'];?>
              </div>
            </form>
            <br>
            <div class="form-actions">
              <a class="btn btn-primary" href="index.php"><span class="bi-arrow-left"></span> Retour</a>
            </div>
          </div>
          <div class="col-md-6 site">
            <div class="img-thumbnail">
              <img src="<?php echo '../images/' . $item['image'] ; ?>" alt="...">
              <div class="price"><?php echo number_format((float)$item['price'], 2, '.', ''). ' €';?></div>
              <div class="caption">
                <h4><?php echo $item['name'];?></h4>
                <p><?php echo $item['description'];?></p>
                <a href="#" class="btn btn-order" role="button"><span class="bi-cart-fill"></span> Commander</a>
              </div>
            </div>
          </div>
        </div>
      </div>   
    </body>
</html>
