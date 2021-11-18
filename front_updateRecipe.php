<?php 

session_start();

include_once('config/mySQL.php');

$getData = $_GET;

//test si varibles existent et non nulles
if ( !isset($getData['id']) && is_numeric($getData['id']) )
    {
        echo ('Il faut un identifiant de recette pour la modifier.');
        return;
    }

//affichage du contenu de la bdd
$getRetriveStatement = $db->prepare('SELECT * FROM recipes WHERE recipe_id = :id');
$getRetriveStatement->execute([
    'id' => $getData['id'],
]);

$recipe = $getRetriveStatement->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Modifier une recette</title>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
            rel="stylesheet"
        >
    </head>

    <body>
    <?php if( isset($_SESSION['LOGGED_USER']) ): ?>

        <div class="d-flex flex-column min-vh-100">
            <div class="container">
                <?php include_once('templates/header.php') ?>
                <h1 style="margin-top:50px;">Modifier la recette ⏩ <?php echo htmlspecialchars($recipe['title']) ?></h1>
                
                <form action="recipes/updateRecipes.php" method="POST">
                    <div class="mb-3 visually-hidden">
                        <label for="id" class="form-label">Identifiant de la recette</label>
                        <input type="hidden" class="form-control" id="id" name="id" value="<?php echo htmlspecialchars($getData['id']);?>">
                    </div>

                    <div class="mb-3">
                        <label for="updateTitle" class="form-label">Titre de la recette</label>
                        <input type="text" class="form-control" id="updateTitle" name="updateTitle" aria-describedby="newTitle-help" value="<?php echo ($recipe['title']);?>"/>
                        <div id="updateTitle-help" class="form-text">modifier le titre de votre recette.</div>
                    </div>
                    <div class="mb-3">
                        <label for="updateRecipe" class="form-label">Votre recette</label>
                        <textarea class="form-control" name="updateRecipe" id="updateRecipe" rows="10px" aria-describedby="updateRecipe-help"><?php echo strip_tags($recipe['recipe']);?></textarea>
                        <div id="updateRecipe-help" class="form-text">modifier le texte de votre recette.</div>
                    </div>
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </form>
                <div style="margin-top: 25vh;" ><?php include_once('templates/footer.php'); ?></div>
            </div>
        </div>

        <?php else: {
            echo 'Vous devez vous connecter pour modifier des recettes !';
        } ?>

    <?php endif; ?>
    </body>
</html>