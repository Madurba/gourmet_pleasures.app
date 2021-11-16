<?php 

session_start();
include_once('../config/mySQL.php');

$postData = $_POST;

if ( !isset($postData['newTitle']) || !isset($postData['newRecipe']) )
{
	echo('Il faut un titre et une recette pour soumettre le formulaire.');
    return;
}


$newTitle = $postData['newTitle'];
$newRecipe = $postData['newRecipe'];

//faire l'insertion en base de donnée
$insertRecipe = $db->prepare('INSERT INTO recipes(title, recipe, author, is_enabled) VALUES (:title, :recipe, :author, :is_enabled)');
$insertRecipe->execute([
    'title' => $postData['newTitle'],
    'recipe' => $postData['newRecipe'],
    'author' => $_SESSION['LOGGED_USER'],
    'is_enabled' => 1,
])

?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Site de Recettes - Page d'accueil</title>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
            rel="stylesheet"
        >
    </head>
    <body>
        <div class="container">

            <?php include_once('header.php'); ?>
            <div class="alert alert-success" role="alert">
                <?php echo $_SESSION['LOGGED_USER']; ?> votre recette a bien été publiée !
            </div>
            
            <div class="card" style="margin-bottom:100px;">
                <div class="card-body" >
                    <h5 class="card-title" style="margin-bottom:30px;" >Rappel de vos informations</h5>
                    <p class="card-text"><b>Titre</b> : <?php echo($newTitle); ?></p>
                    <p class="card-text"><b>Recette</b> : <?php echo strip_tags($newRecipe); ?></p>
                </div>
            </div>
            <?php include_once('footer.php'); ?>
        </div>
    </body>
</html>