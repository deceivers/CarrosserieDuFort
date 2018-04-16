<?php
include('cfg.php');
include('Vehicule.php');
include('Photo.php');
$vehicule= new Vehicule(1);
    $tabVehicule = $vehicule->charger_vehicule();
?>
<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Starter Template for Bootstrap</title>

        <!-- Bootstrap core CSS -->
        <link href="Bootstrap/CSS/bootstrap.css" rel="stylesheet">
        <link href="Bootstrap/CSS/style.css" rel="stylesheet">

    </head>

    <body>
        <div id="background_opacity">
        <div class="header">
        <div class="container">
            <div class="row">
                <div id="logoIndex" class="col-md-3 text-center">
                    <img alt="" class="logoIndex" src="image/test1.png">
                </div>
                <div id="logoIndex" class="col-md-3 text-center">
                    <img alt="" class="logoIndex" src="image/nom.png">
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-4 text-center contact">
                    <p class="contactText">Contact</p>
                </div>
            </div>
        </div>
        <div class="underligne"></div>
        </div>
        <div class="body">
        <div class="container">
        <h1 class="titreVente"> Nos véhicules en vente</h1>
            <div class="vehiculeVente">
            <?php foreach ($tabVehicule as $vehicule) {
                        $idvehicule = $vehicule->id_vehicule;
                        $photo = new Photo($idvehicule);
                        $photo->charger_principal();
                        ?>
                <div class="row item">
                    <div class="col-md-3 divVente">
                        <img class="imgVente" alt="img" src="<?php echo "{$photo->photo}" ?>">
                    </div>
                    <div class="col-md-9">
                        <div class="marque tabVente"><?php echo strtoupper($vehicule->marque)." &nbsp &nbsp &nbsp"."{$vehicule->modele}" ?></div>
                        <div class="complement tabVente"><?php echo "{$vehicule->complement}"?></div>
                        <div class="row info tabVente">
                            <div class=" col-md-2 energie"><?php $energie = ucfirst($vehicule->energie); echo "$energie"?></div>
                            <div class="col-md-2 porte"><?php echo "{$vehicule->porte}"." "."portes"?></div>
                             <div></div>
                        </div>
                        <div class="row info tabVente">
                            <div class="col-md-2 fiscale"><?php echo "$vehicule->fiscaux"." "."CV"?></div>
                            <div class="col-md-2 din"><?php echo "{$vehicule->din}"." "."Ch"?></div>
                            <div></div>
                        </div>
                        <div class="info3 tabVente">
                            <div class="annee"><?php echo substr($vehicule->mise_en_circulation,6,4)?></div>
                            <div>|</div>
                            <div class="kilometre"><?php echo number_format($vehicule->km,0," "," ")." "."km"?></div>
                            <div>|</div>
                            <div class="prix"><?php echo number_format($vehicule->prix,0," ", " ")." €"?></div>
                        </div>
                    </div>
                </div>
            <?php } ?>    
                
            </div>
        </div>
            
            </div>
            
            
            
            
            
            
            
            </div>
    </body>
</html>