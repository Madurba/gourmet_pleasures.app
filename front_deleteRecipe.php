<?php 

session_start();

include_once('config/mySQL.php');

$getData = $_GET;

if ( !isset($getData['id']) && is_numeric($getData['id']) ) 
{
    echo ('Il faut un identifiant de recette pour la supprimer.');
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
        <title>Supprimer une recette</title>
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
                <h1 style="margin-top:50px;">Supprimer la recette ⏩ <?php echo ($recipe['title']) ?></h1>
                <form action="recipes/deleteRecipes.php" methode="GET">
                    <div class="mb-3 visually-hidden">
                        <label for="id">Identifiant de la recette</label>
                        <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $_GET['id']; ?>">
                    </div>
                    <div class="mb-3">
                        <p>Attention vous allez supprimer définitivement la recette ?</p>
                        <button type="submit" class="btn btn-danger" style="margin-top:30px;">supprimer</button>
                    </div>
                </form>
                
                <div style="margin-top: 25vh;" ><?php include_once('footer.php'); ?></div>
            </div>
        </div>

        <?php else: {
            echo 'Vous devez vous connecter pour modifier des recettes !';
        } ?>

    <?php endif; ?>
    </body>
</html>