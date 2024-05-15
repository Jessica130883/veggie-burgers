<?php 
try{
$bdd = new PDO('mysql:host=127.0.0.1;dbname=veggie_burger;charset=utf8', 'admin_veggie', 'veggiemdp');
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
echo "Connexion réussie";
} catch (PDOException $e) {
die('Erreur de connexion : ' . $e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="Stylesheet" href="../Stylesheet.css">
    <title>Veggie burger</title>
</head>

<body>
<h1 class="text-logo"><span class="bi-shop"></span> Veggie Burger <span class="bi-shop"></span></h1>

<div class="container admin">
<div class="row">
                <h1><strong>Liste des items </strong><a href="insert.php" class="btn btn-success btn-lg"><span class="bi-plus"></span> Ajouter</a></h1>
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Nom</th>
                      <th>Description</th>
                      <th>Prix</th>
                      <th>Catégorie</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Item 1</td>
                      <td>Description 1</td>
                      <td>Prix 1</td>
                      <td>Catégorie 1</td>
                      <td width=340>
                        <a class="btn btn-secondary" href="view.php?id=1"><span class="bi-eye"></span> Voir</a>
                        <a class="btn btn-primary" href="update.php?id=1"><span class="bi-pencil"></span> Modifier</a>
                        <a class="btn btn-danger" href="delete.php?id=1"><span class="bi-x"></span> Supprimer</a>
                      </td>
                    </tr>
                    <tr>
                      <td>Item 2</td>
                      <td>Description 2</td>
                      <td>Prix 2</td>
                      <td>Catégorie 2</td>
                      <td width=340>
                        <a class="btn btn-secondary" href="view.php?id=2"><span class="bi-eye"></span> Voir</a>
                        <a class="btn btn-primary" href="update.php?id=2"><span class="bi-pencil"></span> Modifier</a>
                        <a class="btn btn-danger" href="delete.php?id=2"><span class="bi-x"></span> Supprimer</a>
                      </td>
                    </tr>
                    <tr>
                      <td>Item 3</td>
                      <td>Description 3</td>
                      <td>Prix 3</td>
                      <td>Catégorie 3</td>
                      <td width=340>
                        <a class="btn btn-secondary" href="view.php?id=3"><span class="bi-eye"></span> Voir</a>
                        <a class="btn btn-primary" href="update.php?id=3"><span class="bi-pencil"></span> Modifier</a>
                        <a class="btn btn-danger" href="delete.php?id=3"><span class="bi-x"></span> Supprimer</a>
                      </td>
                    </tr>
                    <tr>
                      <td>Item 4</td>
                      <td>Description 4</td>
                      <td>Prix 4</td>
                      <td>Catégorie 4</td>
                      <td width=340>
                        <a class="btn btn-secondary" href="view.php?id=4"><span class="bi-eye"></span> Voir</a>
                        <a class="btn btn-primary" href="update.php?id=4"><span class="bi-pencil"></span> Modifier</a>
                        <a class="btn btn-danger" href="delete.php?id=4"><span class="bi-x"></span> Supprimer</a>
                      </td>
                    </tr>
                  </tbody>
                </table>
            </div>
      </div>

  </body>

</html>