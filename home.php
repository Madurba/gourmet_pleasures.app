<?php session_start(); ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Nos plaisirs gourmets ! | Accueil</title>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
            rel="stylesheet"
        >
    </head>

    <body class="d-flex flex-column min-vh-100">
        <div class="container" >
            <?php include_once('templates/header.php'); ?>
            <h1 class="text-center" style="margin:50px;">Nos plaisirs gourmets !</h1>

            <!-- inclusion des variables et fonctions -->
            <?php
                include_once('config/mySQL.php');
                include_once('config/tables.php');
                include_once('functions.php');
            ?>

            <!-- inclusion de l'entête du site -->
            <?php include_once('templates/header.php'); ?>

            <?php  include_once('login.php'); ?>


            <?php foreach(getRecipes($recipes) as $recipe) : ?>

                <div class="container card mb-3" style="flex-direction:row!important" >
                    <img class="card-img-top" src="images/imgCuisine.png" alt="Card image cap">
                    <div class="card-body">
                        <h3 class="card-title" ><?php echo $recipe['title']; ?></h3>
                        <i><?php echo displayAuthor($recipe['author'], $users); ?></i><br /><br />
                        <p class="card-text"><?php echo $recipe['recipe']; ?></p>
                        <a href="recipes/recipe-view.php?recipe_id=<?php echo($recipe['recipe_id']); ?>" class="btn btn-success" style="margin-top:50px;">Lire la recette</a>
                    </div>
                </div>
            <?php endforeach ;?>
        </div>

        
        <!-- inclusion du bas de page du site -->
        <?php include_once('templates/footer.php'); ?>
    </body>
</html>