<?php

// On récupère tout le contenu de la table recipes
$sqlQuery = 'SELECT * FROM recipes';
//préparation
$recipesStatement = $db->prepare($sqlQuery);
//exécution
$recipesStatement->execute();

$recipes = $recipesStatement->fetchAll();

// On récupère tout le contenu de la table users
$sqlQuery = 'SELECT * FROM users';
$usersStatement = $db->prepare($sqlQuery);
$usersStatement->execute();

$users = $usersStatement->fetchAll();

?>
