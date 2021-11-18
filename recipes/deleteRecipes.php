<?php 
session_start();

include_once('../config/mySQL.php');


$postData = $_GET;

if (!isset($postData['id']))
{
	echo 'Il faut un identifiant valide pour supprimer une recette.';
    return;
}

$id = $postData['id'];

//supprimer par l'id de la BDD
$deleteRecipeStatement = $db->prepare('DELETE FROM recipes WHERE recipe_id = :id');
$deleteRecipeStatement->execute([
    'id' => $id,
])

?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Supprimer la recette</title>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
            rel="stylesheet"
        >
    </head>
    <body>
        <div class="container">

            <?php include_once('../templates/header.php'); ?>
            <div class="alert alert-success" role="alert" style="margin-top:50px;">
                <?php echo $_SESSION['LOGGED_USER']; ?> votre recette a bien été supprimée !
            </div>
            

            <?php include_once('../templates/footer.php'); ?>
        </div>
    </body>
</html>