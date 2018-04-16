<?php
include('cfg.php');
include('Vehicule.php');
include('Photo.php');

session_start();
$login='pikotipikotin';
$password='Venelles84';
if (empty($_SESSION)){
    echo '<p> Accès refusé !</p>';
}
elseif ($_SESSION['login']== $login AND $_SESSION['password']== $password) {
    $vehicule = new Vehicule(1);
    $tabVehicule = $vehicule->charger_vehicule();
    ?>
<html>
    <head lang="en">
        <meta charset="UTF-8">
        <title>Gestion</title>
        <link rel="stylesheet" href="Bootstrap/CSS/bootstrap.css">
        <link href="Bootstrap/CSS/style.css" rel="stylesheet">
    </head>
    <body>
   <div class="container">
       
      <?php include 'headers.php' ?>


    <!-- SQUELETTE DU TABLEAU DE GESTION -->
        <div class ="row">
            <div class="col-lg-12">      
                <table class="table table-bordered table-striped table-dark">
                    <thead>
                        <tr>
                            <td>N° Dossier</td>
                            <td>Photo</td>
                            <td>Véhicule</td>
                            <td>Mise en circulation</td>
                            <td>Prix</td>
                            <td>Modifier</td>
                            <td>Effacer</td>
                        </tr>
                    </thead>
                    <tbody>
                         <?php
                        foreach ($tabVehicule as $vehicule) {
                            $idvehicule = $vehicule->id_vehicule;
                            $photo = new Photo($idvehicule);
                            $photo->charger_principal();
                            ?>
                        <tr>
                            <td><?php echo "{$vehicule->num_dossier}" ?></td>
                            <td><img class="img-responsive vehicule" src="<?php echo "{$photo->photo}"?>"
                             onclick="window.open(this.src,'_blank','toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=1200px, height=800px');"/></td>
                            <td><?php echo "{$vehicule->marque} {$vehicule->modele}"?></td>
                            <td><?php echo "{$vehicule->mise_en_circulation}"?></td>
                            <td><?php echo "{$vehicule->prix}"?> €</td>
                            <td><a href="modifier.php?id=<?php echo $idvehicule ?>"><img class="img-responsive modifier" src="image/modifier.png"/> </td>
                            <td><a href="supvehicule.php?id=<?php echo $idvehicule ?>"><img class=" img-responsive effacer" src="image/effacer.png" alt="Supprimer"/></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </body>
</html>
<?php
}
else {
    echo '<p> Login ou mot de passe incorrect  ! </p>'; ?>
<br><input type="button" value="Retour" onclick='document.location="touftouf.php"'>
<?php
}