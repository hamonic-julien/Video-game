<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">

    <title>Jeux vidéo</title>
</head>
<body>
    <main class="container-fluid">
        <div class="jumbotron">
            <h1 class="display-4">Mes jeux vidéo</h1>
            <?php if(\App\Utils\UserSession::isConnected()) : ?>
                <h3>Connecté en tant que <?= \App\Utils\UserSession::getUser()->email;?></h3>
            <?php endif;?>
            <p class="lead">Voici une petite interface toute simple (grâce à bootstrap) permettant de visualiser les
                jeux vidéo de ma base de données, mais aussi de les ajouter !
            </p>
            <nav>
                <ul class="list-unstyled">
                    <a href="<?= route('home');?>" class="btn btn-success"><li>HOME</li></a>
                    <a href="<?= route('admin');?>" class="btn btn-dark"><li>ADMIN</li></a>
                    <?php if(\App\Utils\UserSession::isConnected()) : ?>
                        <a href="<?= route('logout');?>" class="btn btn-primary"><li>LOG-OUT</li></a>
                    <?php endif;?>
                </ul>
            </nav>
        </div>
