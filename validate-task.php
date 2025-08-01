<?php
require_once "bdd-crud.php";
// BONUS Valider une tache dans la BDD et redirection vers la page d'accueil

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    validate_task($id); // Cette fonction doit exister dans bdd-crud.php
}
header("Location: index.php");
exit();
?>
