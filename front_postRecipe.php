<?php session_start(); ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Poster une recette</title>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
            rel="stylesheet"
        >
    </head>

    <body>
    <?php if(isset($_SESSION['LOGGED_USER'])): ?>

        <div class="d-flex flex-column min-vh-100">
            <div class="container">
                <?php include_once('header.php'); ?>
                <h1 style="margin-top:50px;">Ajouter une nouvelle recette...</h1>
                
                <form action="recipes/postRecipes.php" method="POST">
                    <div class="mb-3">
                        <label for="newTitle" class="form-label">Titre de la recette</label>
                        <input type="text" class="form-control" id="newTitle" name="newTitle" aria-describedby="newTitle-help" />
                        <div id="newTitle-help" class="form-text">Le titre de votre délicieuse nouvelle recette.</div>
                    </div>
                    <div class="mb-3">
                        <label for="newRecipe" class="form-label">La recette</label>
                        <textarea class="form-control" name="newRecipe" id="newRecipe" rows="10px" aria-describedby="newRecipe-help"></textarea>
                        <div id="newRecipe-help" class="form-text">Les secrets de votre nouvelle recette.</div>
                    </div>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </form>
                <div style="margin-top: 25vh;" ><?php include_once('footer.php'); ?></div>
            </div>
        </div>

        <?php else: {
            echo 'Vous devez vous connecter pour ajouter des recettes !';
        } ?>

    <?php endif; ?>
    </body>
</html>