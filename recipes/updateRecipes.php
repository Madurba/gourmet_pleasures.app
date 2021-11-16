<?php 
session_start();

include_once('../config/mySQL.php');


$postData = $_POST;

if ( !isset($postData['updateTitle']) || !isset($postData['updateRecipe']) || !isset($postData['id']) )
{
	echo('Il manque des informations pour permettre l\'édition du formulaire.');
    return;
}

$id = $postData['id'];
$updateTitle = $postData['updateTitle'];
$updateRecipe = $postData['updateRecipe'];

//faire l'insertion en bdd
$insertRecipeStatement = $db->prepare('UPDATE recipes SET title = :title, recipe = :recipe WHERE recipe_id = :id');
$insertRecipeStatement->execute([
    'title' => $updateTitle,
    'recipe' => $updateRecipe,
    'id' => $id,
]);

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Modifier la recette</title>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
            rel="stylesheet"
        >
    </head>
    <body>
        <div class="container">

            <?php include_once('header.php'); ?>
            <div class="alert alert-success" role="alert" style="margin-top:50px;">
                <?php echo $_SESSION['LOGGED_USER']; ?> votre recette a bien été modifiée !
            </div>
            
            <div class="card" style="margin-bottom:100px;">
                <div class="card-body" >
                    <h5 class="card-title" style="margin-bottom:30px;" >Rappel de vos informations</h5>
                    <!-- post id-->
                    <p class="card-text"><b>Titre</b> : <?php echo($updateTitle); ?></p>
                    <p class="card-text"><b>Recette</b> : <?php echo strip_tags($updateRecipe); ?></p>
                </div>
            </div>
            <?php include_once('footer.php'); ?>
        </div>
    </body>
</html>