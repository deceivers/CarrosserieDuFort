<?php
session_start();
if (!empty(filter_input(INPUT_GET, 'flag'))){
    session_destroy();
    header('Location: touftouf.php');
}
elseif (empty(filter_input(INPUT_POST, 'pseudo'))) {
    ?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>connexion</title>

        <!-- Bootstrap core CSS -->
        <link href="Bootstrap/CSS/bootstrap.css" rel="stylesheet">
        <link href="Bootstrap/CSS/style.css" rel="stylesheet">

    </head>
    <body>
        <div class="container">
            <div id="logo2" class="col-md-12 text-center">
                <img class="logo2" src="image/logo2.png">
            </div>
            <form id="touftouf" method="post" action="touftouf.php">
                <div class="form-group row justify-content-md-center">
                    <label class=" col-sm-2 col-form-label">Login :</label>
                    <div class="col-sm-3">
                        <input type="text" name="pseudo" class="form-control" placeholder="Nom d'utilisateur">
                    </div>
                    <label class=" col-sm-2 col-form-label">Mot de passe :</label>
                    <div class="col-sm-3">
                        <input type="password" name="password" class="form-control" placeholder="Mot de passe">
                    </div>
                </div>
                <div id="touftouf" class="form-group row justify-content-md-center">
                    <button class="btn btn-danger" type="submit">Connexion</button>
                </div>
            </form>
        </div>
    </body>
</html>
<?php
}
else{
    $_SESSION['login']= filter_input(INPUT_POST, 'pseudo');
    $_SESSION['password']= filter_input(INPUT_POST, 'password');
    header('Location: gestion.php');
}