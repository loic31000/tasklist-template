<?php
session_start();
require_once "bdd-crud.php";
// TODO Connection Utilisateur via la 

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"] ?? "";
    $password = $_POST["password"] ?? "";
    if ($email && $password) {
        // Récupérer l'utilisateur par email
        $user = get_user_by_email($email);
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            header("Location: index.php");
            exit();
        } else {
            $message = "Email ou mot de passe incorrect.";
        }
    } else {
        $message = "Veuillez remplir tous les champs.";
    }
}

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<header>
    <img src="logo-section.jpg" alt="">
</header>

<body>
    <section class="user_section">
        <h1>Connexion</h1>
        <?php if ($message): ?>
            <p><?= $message ?></p>
        <?php endif; ?>
        <form method="post">
            <div class="form-container">
                <label for="mail">Email :</label>
                <input type="email" name="email" required></label><br>

                <label for="password">Mots de passe :</label>
                <input type="password" name="password" required></label><br>
                
                <button type="submit">Se connecter</button>
            </div>
        </form>
        <a href="inscription.php">Pas de compte ? S'inscrire</a>
    </section>

</body>

</html>