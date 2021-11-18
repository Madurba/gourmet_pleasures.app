<?php
session_start();

include_once('../config/mySQL.php');

$comment = $_POST['comment'];
$subject = $_POST['subjects'];


$commentsStatement = $db->prepare('INSERT INTO comments(post_id, author, subjects, comment) VALUES (:post_id, :author, :subjects, :comment)');
$commentsStatement->execute([
    'post_id' => $_POST['id'],
    'author' => $_SESSION['LOGGED_USER'],
    'subjects' => $_POST['subjects'],
    'comment' => $_POST['comment'],
])


?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Nos plaisirs gourmets ! | Commentaire</title>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
            rel="stylesheet"
        >
    </head>
    <body>
        <div class="container">

            <?php include_once('../templates/header.php'); ?>
            <div class="alert alert-success" role="alert">
                <?php echo $_SESSION['LOGGED_USER']; ?> votre commentaire a bien été publié !
            </div>
            
            <div class="card" style="margin-bottom:100px;">
                <div class="card-body" >
                    <h5 class="card-title" style="margin-bottom:30px;" >Rappel de vos informations</h5>
                    <p class="card-text"><b>Sujet</b> : <?php echo ($subject); ?></p>
                    <p class="card-text"><b>Commentaire</b> : <?php echo strip_tags($comment); ?></p>
                </div>
            </div>
            <?php include_once('../templates/footer.php'); ?>
        </div>
    </body>
</html>