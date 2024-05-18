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
                    <?php
                    require 'database.php';
                    $dbInstance = new Database();
                    $db = $dbInstance->getBdd();
                    $statement = $db->query('SELECT items.id, items.name, items.description, items.price, categories.name AS category FROM items LEFT JOIN categories ON items.category = categories.id ORDER BY items.id DESC');

                    while($item = $statement->fetch()) {

            
                    
                        echo '<tr>';
                        echo '<td>'. htmlspecialchars($item['name']) . '</td>';
                        echo '<td>'. htmlspecialchars($item['description']) . '</td>';
                        echo '<td>'. number_format($item['price'], 2, '.', '') . '</td>';
                        echo '<td>'. htmlspecialchars($item['category']) . '</td>';
                        echo '<td width=340>';
                        echo '<a class="btn btn-secondary" href="view.php?id='.htmlspecialchars($item['id']).'"><span class="bi-eye"></span> Voir</a>';
                        echo ' ';
                        echo '<a class="btn btn-primary" href="update.php?id='.htmlspecialchars($item['id']).'"><span class="bi-pencil"></span> Modifier</a>';
                        echo ' ';
                        echo '<a class="btn btn-danger" href="delete.php?id='.htmlspecialchars($item['id']).'"><span class="bi-x"></span> Supprimer</a>';
                        echo '</td>';
                        echo '</tr>';
                    }
                    echo '<tr><td>Test</td><td>Description</td><td>10.00</td><td>Catégorie</td><td>Actions</td></tr>';

                    require 'database.php';
$dbInstance = new Database();
$db = $dbInstance->getBdd();



                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
