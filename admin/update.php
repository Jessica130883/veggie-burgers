<?php
require 'database.php';

if (!empty($_GET['id'])) {
    $id = checkInput($_GET['id']);
}

$nameError = $descriptionError = $priceError = $categoryError = $imageError = "";
$name = $description = $price = $category = $image = "";

if (!empty($_POST)) {
    $name = checkInput($_POST['name']);
    $description = checkInput($_POST['description']);
    $price = checkInput($_POST['price']);
    $category = checkInput($_POST['category']);
    $isImageUpdated = !empty($_FILES["image"]["name"]);
    $isSuccess = true;
    $isUploadSuccess = false;

    
    if (empty($name)) {
        $nameError = 'Ce champ ne peut pas être vide';
        $isSuccess = false;
    }
    if (empty($description)) {
        $descriptionError = 'Ce champ ne peut pas être vide';
        $isSuccess = false;
    }
    if (empty($price)) {
        $priceError = 'Ce champ ne peut pas être vide';
        $isSuccess = false;
    }
    if (empty($category)) {
        $categoryError = 'Ce champ ne peut pas être vide';
        $isSuccess = false;
    }

    
    if ($isImageUpdated) {
        $image = $_FILES["image"]["name"];
        $imagePath = '../images/' . basename($image);
        $imageExtension = strtolower(pathinfo($imagePath, PATHINFO_EXTENSION)); 
        $isUploadSuccess = true;

        
        if (!in_array($imageExtension, ["jpg", "jpeg", "png", "gif"])) {
            $imageError = "Les fichiers autorisés sont: .jpg, .jpeg, .png, .gif";
            $isUploadSuccess = false;
        }

        
        if (file_exists($imagePath)) {
            $imageError = "Le fichier existe déjà";
            $isUploadSuccess = false;
        }

        
        if ($_FILES["image"]["size"] > 500000) {
            $imageError = "Le fichier ne doit pas dépasser les 500KB";
            $isUploadSuccess = false;
        }

        
        if ($isUploadSuccess) {
            if (!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) {
                $imageError = "Il y a eu une erreur lors de l'upload";
                $isUploadSuccess = false;
            }
        }
    }

   
    if ($isSuccess && ($isUploadSuccess || !$isImageUpdated)) {
        $dbInstance = new Database();
        $pdo = $dbInstance->getBdd();
        if ($isImageUpdated && $isUploadSuccess) {
            $statement = $pdo->prepare("UPDATE items SET name = ?, description = ?, price = ?, category = ?, image = ? WHERE id=?");
            $statement->execute(array($name, $description, $price, $category, $image, $id));
        } else {
            $statement = $pdo->prepare("UPDATE items SET name = ?, description = ?, price = ?, category = ? WHERE id=?");
            $statement->execute(array($name, $description, $price, $category, $id));
        }

        header("Location: index.php");
    } else {
        if ($isImageUpdated && !$isUploadSuccess) {
            
            $dbInstance = new Database();
            $pdo = $dbInstance->getBdd();
            $statement = $pdo->prepare("SELECT image FROM items WHERE id = ?");
            $statement->execute(array($id));
            $item = $statement->fetch();
            $image = $item['image'];
        }
    }
} else {
    $dbInstance = new Database();
    $pdo = $dbInstance->getBdd();
    $statement = $pdo->prepare("SELECT * FROM items WHERE id = ?");
    $statement->execute(array($id));
    $item = $statement->fetch();
    $name = $item['name'];
    $description = $item['description'];
    $price = $item['price'];
    $category = $item['category'];
    $image = $item["image"];
}

function checkInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>





<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
          crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="Stylesheet" href="../Stylesheet.css">
    <title>Modifier un article</title>
</head>

<body>
<h1 class="text-logo"><span class="bi-shop"></span> Veggie Burger <span class="bi-shop"></span></h1>
<div class="container admin">
    <div class="row">
        <div class="col-sm-6">
            <h1><strong>Modifier un item</strong></h1>
            <br>
            <form class="form" action="<?php echo 'update.php?id=' . $id; ?>" role="form" method="post" enctype="multipart/form-data">
                <br>
                <div>
                    <label class="form-label" for="name">Nom:</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nom" value="<?php echo $name; ?>">
                    <span class="help-inline"><?php echo $nameError; ?></span>
                </div>
                <br>
                <div>
                    <label class="form-label" for="description">Description:</label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="<?php echo $description; ?>">
                    <span class="help-inline"><?php echo $descriptionError; ?></span>
                </div>
                <br>
                <div>
                    <label class="form-label" for="price">Prix: (en €)</label>
                    <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="Prix" value="<?php echo $price; ?>">
                    <span class="help-inline"><?php echo $priceError; ?></span>
                </div>
                <br>
                <div>
                    <label class="form-label" for="category">Catégorie:</label>
                    <select class="form-control" id="category" name="category">
                        <?php
                        $dbInstance = new Database();
                        $pdo = $dbInstance->getBdd();
                        foreach ($pdo->query('SELECT * FROM categories') as $row) {
                            if ($row['id'] == $category)
                                echo '<option selected="selected" value="' . $row['id'] . '">' . $row['name'] . '</option>';
                            else {
                                echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                    <span class="help-inline"><?php echo $categoryError; ?></span>
                </div>
                <br>
                <div class="form-group">
                    <label>Image :</label>
                    <p><?php echo $image; ?></p>
                    <label class="form-label" for="image">Sélectionner une image:</label>
                    <input type="file" id="image" name="image">
                    <span class="help-inline"><?php echo $imageError; ?></span>
                </div>
                <br>
                <div class="form-actions">
                    <button type="submit" class="btn btn-success"><span class="bi-pencil"></span> Modifier </button>
                   
                    <a class="btn btn-primary" href="index.php"><span class="bi-arrow-left"></span> Retour</a>
                </div>
            </form>
        </div> 
        <div class="col-md-6 site">
            <div class="img-thumbnail">
              <img src="<?php echo '../images/' . $image ; ?>" alt="...">
              <div class="price"><?php echo number_format((float)$price, 2, '.', ''). ' €';?></div>
              <div class="caption">
                <h4><?php echo $name;?></h4>
                <p><?php echo $description;?></p>
                <a href="#" class="btn btn-order" role="button"><span class="bi-cart-fill"></span> Commander</a>
              </div>
            </div>
          </div>   
    </div>
</div>   
</body>
</html>
