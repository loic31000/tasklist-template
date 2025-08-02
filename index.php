<?php
session_start();
require_once "bdd-crud.php";
// Redirection vers la page de connexion si l'utilisateur n'est pas connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
// Afficher la liste des tâches de l'utilisateur connecté
$tasks = get_all_task();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Chela+One&family=Permanent+Marker&family=Rampart+One&family=Rubik+Dirt&family=Slackey&display=swap');
    </style>
    <title>Voir les taches</title>
</head>

<body>
    <header>
        <img src="logo-section.jpg" alt="">
    </header>

    <section class="user-action">
        <a href="add-task.php">Ajouter une tâche</a>
        <a href="logout.php">Logout</a>
    </section>
    <h2>Liste des tâches</h2>


    <div class="tasks">

        <?php if ($tasks): ?>
            <ul>
                <?php foreach ($tasks as $task): ?>
                    <li>
                        <strong><?= htmlspecialchars($task['name']) ?></strong> :
                        <?= htmlspecialchars($task['description']) ?>
                        <a href="delete-task.php?id=<?= $task['id'] ?>" onclick="return confirm('Supprimer cette tâche ?');">Supprimer</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Aucune tâche trouvée.</p>
        <?php endif; ?>

    </div>
</body>

</html>