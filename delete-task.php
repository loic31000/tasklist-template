<?php
require_once "bdd-crud.php";

// Suppréssion d'une tâche en fonction de son ID passé en $_GET
$message = "";

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    if (delete_task($id)) {
        $message = "Tâche supprimée avec succès.";
    } else {
        $message = "Erreur lors de la suppression de la tâche.";
    }
    // Redirection vers la liste après suppression (optionnel)
    header("Location: index.php");
    exit();
} else {
    $message = "Aucun identifiant de tâche fourni.";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer une tache</title>
</head>
<body>
    
</body>
</html>