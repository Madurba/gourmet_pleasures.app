<!-- login.php -->
<?php

    $logData = $_POST;

    if ( isset($logData['fname']) && isset($logData['password']) ) {

        foreach ($users as $user) {
            if (
                $user['full_name'] === $logData['fname'] &&
                $user['password'] === $logData['password']
            ) {
                $_SESSION['LOGGED_USER'] = $logData['fname'];
            } else {
                $errorMessage = sprintf('Les informations envoyées ne permettent pas de vous identifier : (%s/%s)',
                    $logData['fname'],
                    $logData['password']
                );
            }
        }
    }

?>

<!-- if user logged, display recpies / else display login-->
<?php if(!isset($_SESSION['LOGGED_USER'])): ?>

<div class="d-flex flex-column min-vh-100">
    <div class="container">
        <h1>Connexion</h1>
        <form action="home.php" method="POST">

            <!-- if error message, display-->
            <?php if(isset($errorMessage)): ?>
                <div class="alert alert-danger" role="alert" >
                <?php echo $errorMessage; ?>
                </div>
            <?php endif; ?>

                <div class="mb-3">
                    <label for="fname" class="form-label">Identifiant</label>
                    <input type="text" class="form-control" id="fname" name="fname" aria-describedby="identifiant-help" />
                    <div id="email-help" class="form-text">Votre nom et prénom utilisé lors de la création de compte.</div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Votre mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" />
                </div>
                <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>

        <?php else: ?>
            <div class="alert alert-success" role="alert">
                Salut <?php echo $_SESSION['LOGGED_USER']; ?> ! Et bon appétit bien sûr !
                <a href="destroy_session.php"><button style="float:right;" type="button" class="btn btn-outline-danger btn-sm">Se déconnecter</button></a>
            </div>
        <?php endif; ?>
    </div>
</div>