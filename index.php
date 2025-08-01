<?php
session_start();
require_once "bdd-crud.php";
// TODO Redirection vers la page de connexion si l'utilisateur n'est pas connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
// TODO Afficher la liste des tâches de l'utilisateur connecté
$tasks = get_all_task();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voir les taches</title>
</head>

<body>
    <header>
        <img src="logo-section.jpg" alt="">
        <a href="login.php">Login</a>
        <a href="logout.php">Logout</a>
        <a href="inscription.php">Se créer un compte</a>
        <a href="add-task.php">Ajouter une tâche</a>
    </header>
    <h1>Liste des tâches</h1>
    <div class="tasks">

        <?php if ($tasks): ?>
            <ul>
                <?php foreach ($tasks as $task): ?>
                    <li>
                        <strong><?= htmlspecialchars($task['name']) ?></strong> :
                        <?= htmlspecialchars($task['description']) ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Aucune tâche trouvée.</p>
        <?php endif; ?>

    </div>
</body>

</html>