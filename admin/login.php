<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $userEmail = $_POST['email'];
    $userPassword = $_POST['password'];

    require_once 'database.php';
    $db = new database();
    $pdo = $db->getBdd();

    $stmt = $pdo->prepare("SELECT password FROM users WHERE email = ?");
    $stmt->execute([$userEmail]);
    $user = $stmt->fetch();

    if ($user && password_verify($userPassword, $user['password'])) {
        $_SESSION['user_email'] = $userEmail;  // Enregistrement de l'email dans la session
        header('Location: index.php');  // Redirection vers l'interface de gestion
        exit;
    } else {
        // Échec de la connexion, afficher un message d'erreur
        $errorMessage = "Identifiants incorrects, veuillez réessayer.";
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
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
    <title>Login</title>
</head>
<body>

<h1 class="text-logo"><span class="bi-shop"></span> Veggie Burger <span class="bi-shop"></span></h1>

<div class="container admin">
    <div class="row">
        <h1><strong>Login</strong></h1>

<?php if (!empty($errorMessage)) echo "<p>$errorMessage</p>"; ?>
<form action="login.php" class="" role="form" method="POST">

<label for="email">E-mail :</label><br>
<input type="email" class="form-control" id="email" name="email" placeholder="email" value=""><br><br>
<label for="password">Mot de passe :</label>
<br>
<input type="password" class="form-control" id="password" name="password" placeholder="mot de passe" value="">
    </div>  
   
        <button type="submit" class="btn btn-primary" name="login">Se connecter</button>
    
</form>
    </div>
    
</body>
</html>