<?php
/**
 * Ce fichier contient les fonctions de CRUD pour les utilisateurs et les tâches.
 * Il est utilisé pour interagir avec la base de données.
 * Presque toutes les pages de l'application utilisent ce fichier.
 * 
 * A vous de remplir ces fonction pour qu'elles fonctionnent correctement.
 * 
 * Vous pourrez ainsi facilment les utiliser dans les autres fichiers et construire votre site sans plus vous soucis du SQL.
 */


function connect_database(): PDO
{
    $database = new PDO("mysql:host=127.0.0.1;dbname=app-database", "root", "root");
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $database;
}
// CRUD User
// Create (signin)
function create_user(string $email, string $password): int|null
{
    $database = connect_database();
    $stmt = $database->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    if ($stmt->execute([$email, $hashed_password])) {
        return (int) $database->lastInsertId();
    }
    return null;
}

// Read (login)
function get_user(int $id): array|null
{
    $database = connect_database();
    $stmt = $database->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user ?: null;
}
function get_user_by_email(string $email): array|null
{
    $database = connect_database();
    $stmt = $database->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user ?: null;
}


// CRUD Task
// Create
function add_task(string $name, string $description): int|null
{
    session_start(); // Assurez-vous que la session est démarrée pour accéder à $_SESSION
    $database = connect_database();
    $stmt = $database->prepare("INSERT INTO tasks (name, description, user_id) VALUES (?, ?,?)");
    if ($stmt->execute([$name, $description, $_SESSION["user_id"]])) {
        return (int) $database->lastInsertId();
    }
    return null;
}


//Read
function get_task(int $id): array|null
{
    $database = connect_database();
    $stmt = $database->prepare("SELECT * FROM tasks WHERE id = ?");
    $stmt->execute([$id]);
    $task = $stmt->fetch(PDO::FETCH_ASSOC);
    return $task ?: null;
}

function get_all_task(): array|null
{
    $database = connect_database();
    $stmt = $database-> prepare("SELECT * FROM tasks WHERE user_id = ?");
    $stmt->execute([$_SESSION["user_id"]]);
    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    return $tasks ?: null;
}

// Delete (BONUS)
function delete_task(int $id): bool
{
    $database = connect_database();
    $stmt = $database->prepare("DELETE FROM tasks WHERE id = ?");
    return $stmt->execute([$id]);
}

function validate_task(int $id): bool
{
    $database = connect_database();
    $stmt = $database->prepare("UPDATE tasks SET is_done = 1 WHERE id = ?");
    return $stmt->execute([$id]);
}