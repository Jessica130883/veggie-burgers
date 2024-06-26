<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $userEmail = $_POST['email'];
    $userPassword = $_POST['password'];
    $hashedPassword = password_hash($userPassword, PASSWORD_DEFAULT);

    require_once 'database.php';
    $db = new database();
    $pdo = $db->getBdd();

    
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
    $stmt->execute([$userEmail]);
    if ($stmt->fetchColumn() > 0) {
        $errorMessage = "Cet email est déjà utilisé.";
    } else {
        
        $stmt = $pdo->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
        if ($stmt->execute([$userEmail, $hashedPassword])) {
            $_SESSION['success_message'] = "Utilisateur enregistré avec succès. Veuillez vous connecter.";
            header('Location: login.php');
            exit;
        } else {
            $errorRegister = "Erreur lors de l'enregistrement.";
        }
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
    <title>Register</title>
</head>
<body>
<h1 class="text-logo"><span class="bi-shop"></span> Veggie Burger <span class="bi-shop"></span></h1>
<div class="container admin">
    <div class="row">
        <h1><strong>Register</strong></h1>
        <?php if (!empty($errorMessage)) echo "<p>$errorMessage</p>"; ?>
        <?php if (!empty($errorRegister)) echo "<p>$errorRegister</p>"; ?>
        <form action="register.php" method="post">
            <label for="email">E-mail :</label><br>
            <input type="email" class="form-control" id="email" name="email" required><br>
            <label for="password">Mot de passe :</label><br>
            <input type="password" class="form-control" id="password" name="password" required><br>
            <button type="submit" class="btn btn-primary" name="register">S'enregistrer</button>
        </form>
    </div>
</body>
</html>
