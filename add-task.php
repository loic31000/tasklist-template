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
    <title>Ajouter une tâche</title>
</head>

<body>
    <h1>Ajouter une tâche</h1>
    <?php if ($message): ?>
        <p><?= $message ?></p>
    <?php endif; ?>
    <form method="post">
        <label>Nom de la tâche : <input type="text" name="name" required></label><br>
        <label>Description : <textarea name="description" required></textarea></label><br>
        <button type="submit">Ajouter</button>
    </form>
    <a href="index.php">Retour à la liste</a>
</body>

</html>