<?php
require_once "bdd-crud.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"] ?? "";
    $password = $_POST["password"] ?? "";

    if ($email && $password) {
        $user_id = create_user($email, $password);
        if ($user_id) {
            header("Location: index.php");
        } else {
            $message = "Erreur : cet email existe déjà ou problème technique.";
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
    <title>Inscription</title>
</head>

<body>
    <section class="logo-section">
        <div class="logo-section"></div>
        <header>
            <img src="logo-section.jpg" alt="">
        </header>
        </div>
    </section>


    <section class="user_section">
        <div class="user_section">
            <h1>Inscription</h1>
            <?php if ($message): ?>
                <p><?= $message ?></p>
            <?php endif; ?>
            <form method="post">
                <label>Email : <input type="email" name="email" required></label><br>
                <label>Mot de passe : <input type="password" name="password" required></label><br>
                <button type="submit">S'inscrire</button>
            </form>
        </div>
    </section>
</body>

</html>