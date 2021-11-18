<?php 
session_start();

include_once('../config/mySQL.php');
include_once('../functions.php');

$getData = $_GET;

//sql recipes

$recipeStatement = $db->prepare('SELECT * FROM recipes WHERE recipe_id = :recipe_id');
$recipeStatement->execute([
    'recipe_id' => $getData['recipe_id'],
]);

$recipe = $recipeStatement->fetch(PDO::FETCH_ASSOC);


//sql users

$usersStatement = $db->prepare('SELECT * FROM users WHERE user_id = :id');
$usersStatement->execute([
    'id' => $_SESSION['LOGGED_USER'],
]);

$users = $usersStatement->fetch(PDO::FETCH_ASSOC);

//sql comments

$commentStatement = $db->prepare('SELECT * FROM comments WHERE post_id = :post_id');
$commentStatement->execute([
    'post_id' => $getData['recipe_id'],
]);

$comments = $commentStatement->fetchAll();


?>



<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo htmlspecialchars($recipe['title']) ?></title>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
            rel="stylesheet"
        >
    </head>

    <body>
    <?php if( isset($_SESSION['LOGGED_USER']) ): ?>

        <div class="d-flex flex-column min-vh-100">
            <div class="container">
                <div class="row">
                <?php include_once('../templates/header.php') ?>
                    <h1 style="margin:50px 0 20px 0;">Recette ⏩ <?php echo htmlspecialchars($recipe['title']) ?></h1>
                    
                    <div class="card" style="flex-direction:row!important" >
                        <img class="card-img-top" src="../images/imgCuisine.png" alt="Card image cap">
                        <div class="card-body">
                            <h3 class="card-title" ><?php echo $recipe['title']; ?></h3>
                            <i>par <?php echo ($recipe['author']); ?></i><br /><br />
                            <p class="card-text"><?php echo $recipe['recipe']; ?></p>

                            <?php if(isset($_SESSION['LOGGED_USER']) && $recipe['author'] === $_SESSION['LOGGED_USER']): ;?>
                            <ul class="list-group list-group-horizontal" style="margin-top:70px;" >
                                <li class="list-group-item"><a class="link-warning" href="../front_updateRecipe.php?id=<?php echo($recipe['recipe_id']); ?>">Editer l'article</a></li>
                                <li class="list-group-item"><a class="link-danger" href="../front_deleteRecipe.php?id=<?php echo($recipe['recipe_id']); ?>">Supprimer l'article</a></li>
                            </ul>
                            <?php endif ;?>
                        </div>
                    </div>

                    <!--comments view-->
                    <div style="margin-top:30px;">

                    <?php foreach($comments as $comment) : ?>
                        <div class="#">
                            <div class="row">
                                <div class="card">
                                    <div class="card-body" >
                                        <h5 class="card-title" style="margin-bottom:30px;" >Derniers commentaires</h5>
                                        <p class="card-text"><b>Sujet</b> : <?php echo $comment['subjects']; ?></p>
                                        <p class="card-text"><b>Commentaire</b> : <?php echo $comment['comment']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach ?>


                    <!--comments form-->
                <div class="container d-flex flex-column">
                    <h3 style="margin:70px 0 20px 0;">Rédiger un commentaire</h3>
                    <div class="row">
                        <form action="commentsRecipes.php" method="POST">
                            <div class="mb-3 visually-hidden">
                                <label for="id">Identifiant du commentaire</label>
                                <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $_GET['id']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="subjects" class="form-label">Sujet du commentaire</label>
                                <input type="text" class="form-control" id="subjects" name="subjects" aria-describedby="subjects-help" />
                                <div id="subjects-help" class="form-text">Le titre de ton sujet !</div>
                            </div>

                            <div class="mb-3">
                                <label for="comment" class="form-label">Ton commentaire</label>
                                <textarea class="form-control" name="comment" id="comment" rows="10px" aria-describedby="comment-help"></textarea>
                                <div id="comment-help" class="form-text">Ajoute tes améliorations de recette ou simplement ton expérience !</div>
                            </div>
                            <button type="submit" class="btn btn-primary">Poster</button>
                        </form>
                    </div>
                </div>
             

                    <div style="margin-top: 25vh;" ><?php include_once('../templates/footer.php'); ?></div>
                </div>
            </div>
        </div>
        <?php else: 
        {
            echo 'Vous devez vous connecter pour modifier des recettes !';
        } 
        ?>

    <?php endif; ?>
    </body>
</html>
