<?php
require_once "bdd-crud.php";
session_start();

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"] ?? "";
    $description = $_POST["description"] ?? "";


    if ($name && $description) {
        $task_id = add_task($name, $description);
        if ($task_id) {
            $message = "Tâche ajoutée avec succès !";
        } else {
            $message = "Erreur lors de l'ajout de la tâche.";
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Ajouter une tâche</title>
</head>

<body>
    <h3>Ajouter une tâche</h3>
    <?php if ($message): ?>
        <p><?= $message ?></p>
    <?php endif; ?>
    <section class="tasks">
    <form method="post">
        <label for="add-task">Nom de la tâche :</label>
        <input type="text" name="name" required></label><br>

        <label for="descript">Description :</label>
        <textarea name="description" required></textarea></label><br>

        <button type="submit">Ajouter</button>
    </form>
    </section>
    <a href="index.php">Retour à la liste</a>
</body>

</html>