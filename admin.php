<?php
session_start();
$login='pikotipikotin';
$password='Venelles84';
if (empty($_SESSION)){
    echo '<p> Accès refusé !</p>';
}
else {
    
?>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Administration</title>

    <!-- Bootstrap core CSS -->
    <link href="Bootstrap/CSS/bootstrap.css" rel="stylesheet">
    <link href="Bootstrap/CSS/style.css" rel="stylesheet">

</head>
<body>
    <div class="container">
        <?php include 'headers.php' ?>
        <h1 id="admin">Ajouter un véhicule</h1>
        <form id="admin" name="newvehicule" method="post" action="newvehicule.php"  enctype="multipart/form-data">
            <div class="form-group row justify-content-md-center">
              <label class=" col-sm-2 col-form-label">Marque :</label>
              <div class="col-sm-2">
                  <input type="text" name="marque" class="form-control" placeholder="Marque" value="Citroen">
              </div>
              <label type="text" class=" col-sm-2 col-form-label">Modèle :</label>
              <div class="col-sm-2">
                <input name="modele" class="form-control" placeholder="Modèle" value="C4">
              </div>
            </div>
            
            <div class="form-group row justify-content-md-center">
              <label class=" col-sm-2 col-form-label">Complément modèle :</label>
              <div class="col-sm-6">
                  <input type="text" name="complement" class="form-control" placeholder="GT line 1.6">
              </div>
            </div>
            
            <div class="form-group row justify-content-md-center">
                <label class=" col-sm-2 col-form-label">Mise en ciculation :</label>
                <div class="col-sm-2">
                <select name="jour" class="custom-select col-sm-2" id="inlineFormCustomSelect">
                    <option value="01" selected="selected">01</option>
                    <?php
                          for($i=2; $i<32; $i++ ){
                              if ($i<10)
                              {?>
                              <option value="0<?php echo $i ?>" >0<?php echo $i ?> </option>;
                              <?php
                              }
                              else
                              {?>
                              <option value=<?php echo $i ?> > <?php echo $i ?> </option>;
                              <?php
                              }
                          }
                          ?>
                </select>
                </div>
                <div class="col-sm-2">
                    <select name="mois" class="custom-select col-sm-2" id="inlineFormCustomSelect">
                    <option value="01" selected="selected">01</option>
                    <?php
                            for($i=2; $i<13; $i++ ){
                                if ($i<10)
                                {?>
                                    <option value="0<?php echo $i ?>">0<?php echo $i?></option>;
                                <?php
                                }
                                else
                                {?>
                                <option value=<?php echo $i?> ><?php echo $i?></option>;
                                <?php
                                }
                            }
                            ?>
                </select>
                </div>
                <div class="col-sm-2">
                    <select name="annee" class="custom-select col-sm-2" id="inlineFormCustomSelect">
                    <option value="2018" selected="selected">2018</option>
                    <?php
                            for($i=2017; $i>1979; $i-- ){
                                ?>
                                <option value=<?php echo $i?>><?php echo $i?></option>;
                            <?php
                            }
                            ?>
                </select>
                </div>
            </div>
            <div class="form-group row justify-content-md-center">
              <label class=" col-sm-2 col-form-label">Couleur :</label>
              <div class="col-sm-2">
                <input type="text" name="couleur" class="form-control" placeholder="Couleur" value="grise">
              </div>
              <label class=" col-sm-2 col-form-label">Kilométrage :</label>
              <div class="col-sm-2">
                <input type="text" name="km" class="form-control" placeholder="Kilométrage" value="123456">
              </div>
            </div>
            
            
            <div class="form-group row justify-content-md-center">
              <label class=" col-sm-2 col-form-label">Énergie :</label>
              <div class="col-sm-2">
                <select name="energie" class="custom-select col-sm-6" id="inlineFormCustomSelect">
                    <option value="diesel" selected="selected">Diesel</option>
                    <option value="essence">Éssence</option>
                    <option value="electrique">Électrique</option>
                    <option value="hybride">Hybride</option>
                </select>
              </div>
              <label class=" col-sm-2 col-form-label">Nombre de portes :</label>
              <div class="col-sm-2">
                <input type="text" name="porte" class="form-control" placeholder="porte" value="123456">
              </div>
            </div>
            <div class="form-group row justify-content-md-center">
              <label class=" col-sm-2 col-form-label">Cheveaux fiscaux :</label>
              <div class="col-sm-2">
                <input type="text" name="fiscaux" class="form-control" placeholder="Ficaux" value="grise">
              </div>
              <label class=" col-sm-2 col-form-label">Cheveaux Din :</label>
              <div class="col-sm-2">
                <input type="text" name="din" class="form-control" placeholder="Din" value="123456">
              </div>
            </div>
            
            
            <div class="form-group row justify-content-md-center">
                <label class=" col-sm-2 col-form-label">Procédure :</label>
                <div class="col-sm-2">
                <select name="procedure" class="custom-select col-sm-6" id="inlineFormCustomSelect">
                    <option value="CG" selected="selected">CG (Carte grise)</option>
                  <option value="VE">VE (Véhicule endommagé)</option>
                </select>
                </div>
                <label class=" col-sm-2 col-form-label">Numéro VO :</label>
              <div class="col-sm-2">
                  <input tupe="text" name="numVO" class="form-control" placeholder="N° VO" value="12">
              </div>
            </div>
            <div class="form-group row justify-content-md-center">
              <label class=" col-sm-2 col-form-label">Numéro dossier :</label>
              <div class="col-sm-2">
                  <input type="text" name="numDossier" class="form-control" placeholder="N° dossier" value="124">
              </div>
              <label class=" col-sm-2 col-form-label">Prix de vente :</label>
              <div class="col-sm-2">
                  <input type="text" name="prix" class="form-control" placeholder="Prix " value="6500">
              </div>
            </div>
            <div class="form-group row justify-content-md-center">
              <label class=" col-sm-2 col-form-label">Photo principale :</label>
              <div class="col-sm-6">
                  <input class="form-control" type="file" name="photoPrincipal" accept="image/jpeg"/>
              </div>
              
            </div>
            <div class="form-group row justify-content-md-center">
            <label class=" col-sm-2 col-form-label">Photo :</label>
              <div class="col-sm-6">
                  <input class="form-control" type="file" name="photo[]" accept="image/jpeg" multiple/>
              </div>
            </div>
            <div class="form-group row justify-content-md-center">
              <label class=" col-sm-2 col-form-label">Description :</label>
              <div class="col-sm-6">
                  <textarea class="form-control" name="description" rows="10" spellcheck="true" placeholder="Description ...."></textarea>
              </div>
            </div>
            <div class="form-group row justify-content-md-center">
            <button class="btn btn-danger" type="submit">Ajouter la voiture</button>
            </div>
            
            
            
            
        </form>
    </div>
</body>
</html>
<?php
}