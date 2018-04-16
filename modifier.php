<?php
session_start();
include('cfg.php');
include('Vehicule.php');
include('Photo.php');

$login='pikotipikotin';
$password='Venelles84';
if (empty($_SESSION)){
    echo '<p> Accès refusé !</p>';
}
elseif(!empty(filter_input(INPUT_POST, 'marque'))){
    $vehicule= new Vehicule(filter_input(INPUT_POST, 'id'));
    $id=$vehicule->id_vehicule;
    $vehicule->marque=(filter_input(INPUT_POST, 'marque'));
    $vehicule->modele=(filter_input(INPUT_POST, 'modele'));
    $vehicule->mise_en_circulaion=(filter_input(INPUT_POST, 'jour'))."-".(filter_input(INPUT_POST, 'mois'))."-".(filter_input(INPUT_POST, 'annee'));
    $vehicule->couleur=(filter_input(INPUT_POST, 'couleur'));
    $vehicule->km=(filter_input(INPUT_POST, 'km'));
    $vehicule->procedures=(filter_input(INPUT_POST, 'procedure'));
    $vehicule->description=(filter_input(INPUT_POST, 'description'));
    $vehicule->num_vo=(filter_input(INPUT_POST, 'numVO'));
    $vehicule->num_dossier=(filter_input(INPUT_POST, 'numDossier'));
    $vehicule->prix=(filter_input(INPUT_POST, 'prix'));
    $vehicule->modifier_vehicule($id);
    if(!empty($_FILES['photoPrincipal']['name'])){
        $name = $_FILES['photoPrincipal']['name'];
        $type = $_FILES['photoPrincipal']['type'];
        $tmp_name = $_FILES['photoPrincipal']['tmp_name'];

        $photo=new Photo();
        $photo->id_vehicule=$id;
        $photo->principal=1;
        $photo->photo='image/'.$name;
        $photo->ajouter_photo();
        move_uploaded_file($tmp_name, 'image/'.$name);
    }
    if(!empty($_FILES['photo']['name'][0])){
    $nb = 0;
        foreach($_FILES['photo']['name'] as $element) {
            $tmp_name = $_FILES['photo']['tmp_name'][$nb];
            $name = $_FILES['photo']['name'][$nb];
            $size = $_FILES['photo']['size'][$nb];
            $type = $_FILES['photo']['type'][$nb];

            $photo=new Photo();
            $photo->id_vehicule=$id;
            $photo->photo='image/'.$name;
            $photo->ajouter_photo();
            move_uploaded_file($tmp_name, 'image/'.$name);
            $nb++;
        }
    }
    header('Location: gestion.php');
}

else {
    if(!empty (filter_input(INPUT_GET, 'photo'))){
        $photo=new photo();
        $photo->id_photo= filter_input(INPUT_GET, 'photo');
        $photo->charger_une();
        $photo->supprimer_photo();
    }
$vehicule= new Vehicule(filter_input(INPUT_GET, 'id'));
$vehicule->charger();

$photo=new Photo(filter_input(INPUT_GET, 'id'));
$photo->charger_principal();
$tabphoto = $photo->charger_autre();
$nb=0;
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
        <h1 id="admin">Modifier <?php echo $vehicule->marque;?> <?php echo $vehicule->modele; ?></h1>
        <form id="admin" name="modifvehicule" method="post" action="modifier.php"  enctype="multipart/form-data">
            <div class="form-group row justify-content-md-center">
              <label class=" col-sm-2 col-form-label">Marque :</label>
              <div class="col-sm-2">
                  <input type="text" name="marque" class="form-control" value="<?php echo $vehicule->marque ?>">
              </div>
              <label type="text" class=" col-sm-2 col-form-label">Modèle :</label>
              <div class="col-sm-2">
                <input name="modele" class="form-control" value="<?php echo $vehicule->modele ?>">
              </div>
            </div>
            <div class="form-group row justify-content-md-center">
                <label class=" col-sm-2 col-form-label">Mise en ciculation :</label>
                <div class="col-sm-2">
                <select name="jour" class="custom-select col-sm-2" id="inlineFormCustomSelect">
                    <option value="<?php echo substr($vehicule->mise_en_circulation,0,2) ?>" selected="selected"><?php echo substr($vehicule->mise_en_circulation,0,2) ?></option>
                    <?php
                          for($i=1; $i<32; $i++ ){
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
                    <option value="<?php echo substr($vehicule->mise_en_circulation,3,2) ?>" selected="selected"><?php echo substr($vehicule->mise_en_circulation,3,2) ?></option>
                    <?php
                            for($i=1; $i<13; $i++ ){
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
                     <option value="<?php echo substr($vehicule->mise_en_circulation,6,4) ?>" selected="selected"><?php echo substr($vehicule->mise_en_circulation,6,4) ?></option>
                    <?php
                            for($i=2018; $i>1979; $i-- ){
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
                <input type="text" name="couleur" class="form-control" value="<?php echo $vehicule->couleur ?>">
              </div>
              <label class=" col-sm-2 col-form-label">Kilométrage :</label>
              <div class="col-sm-2">
                <input type="text" name="km" class="form-control" value="<?php echo $vehicule->km ?>">
              </div>
            </div>
            <div class="form-group row justify-content-md-center">
                <label class=" col-sm-2 col-form-label">Procédure :</label>
                <div class="col-sm-2">
                <select name="procedure" class="custom-select col-sm-6" id="inlineFormCustomSelect">
                    <option value="<?php echo ($vehicule->procedure) ?>" selected="selected"><?php echo ($vehicule->procedure) ?></option>
                    <option value="CG">CG (Carte grise)</option>
                    <option value="VE">VE (Véhicule endommagé)</option>
                </select>
                </div>
                <label class=" col-sm-2 col-form-label">Numéro VO :</label>
              <div class="col-sm-2">
                <input tupe="text" name="numVO" class="form-control" value="<?php echo $vehicule->num_vo ?>">
              </div>
            </div>
            <div class="form-group row justify-content-md-center">
              <label class=" col-sm-2 col-form-label">Numéro dossier :</label>
              <div class="col-sm-2">
                <input type="text" name="numDossier" class="form-control" value="<?php echo $vehicule->num_dossier ?>">
              </div>
              <label class=" col-sm-2 col-form-label">Prix de vente :</label>
              <div class="col-sm-2">
                <input type="text" name="prix" class="form-control" value="<?php echo $vehicule->prix ?>">
              </div>
            </div>
            <div class="form-group row justify-content-md-center">
                <?php
                if(!empty($photo->photo)){ ?>
                <label class=" col-sm-2 col-form-label test">Photo Principale :</label>
                <div class="col-sm-2  containers">
                    <img  class = 'photoPrincipal' src="<?php echo $photo->photo ?> "/>
                    <div class='middle' onclick="window.location.href='modifier.php?photo=<?php echo $photo->id_photo ?>&id=<?php echo $vehicule->id_vehicule ?>';">
                        <div class='text'>Supprimer</div>
                    </div>
                </div>
                <div class="col-sm-4"></div>
                  <?php } 
                  else { ?>
                    <label class=" col-sm-2 col-form-label">Nouvelle photo principale :</label>
                    <div class="col-sm-6">
                        <input class="form-control" type="file" name="photoPrincipal" accept="image/jpeg" multiple/>
                    </div>
                  <?php }?>
            </div>
            <div class="form-group row justify-content-md-center">
                <label class="col-sm-8 col-form-label" style="text-align:center;"> Autres Photos : </label>
            </div>
            <div class="form-group row justify-content-md-center">
            
            <?php 
                            foreach ($tabphoto as $photo){
                                if($nb==4){
                                    ?>  
                                        </div>
                                        <div class="form-group row justify-content-md-center">
                                            <div class="col-sm-2 containers">
                                                <img  class = 'photoPrincipal' src="<?php echo $photo->photo ?> "/>
                                                <div class='middle' onclick="window.location.href='modifier.php?photo=<?php echo $photo->id_photo ?>&id=<?php echo $vehicule->id_vehicule ?>';">
                                                    <div class='text'>Supprimer</div>
                                                </div>
                                            </div>
                                        <?php
                                        $nb=1;
                                }
                                else{
                                ?>  <div class="col-sm-2 containers">
                                        <img  class = 'photoPrincipal' src="<?php echo $photo->photo ?> "/>
                                        <div class='middle' onclick="window.location.href='modifier.php?photo=<?php echo $photo->id_photo ?>&id=<?php echo $vehicule->id_vehicule ?>';">
                                            <div class='text'>Supprimer</div>
                                        </div>
                                    </div> <?php
                                    $nb++;
                                    }
                            }
            
            
            ?>
            
                
            </div>
            <div class="form-group row justify-content-md-center">
            <label class=" col-sm-2 col-form-label">Nouvelles photos :</label>
              <div class="col-sm-6">
                  <input class="form-control" type="file" name="photo[]" accept="image/jpeg" multiple/>
              </div>
            </div>
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            <div class="form-group row justify-content-md-center">
              <label class=" col-sm-2 col-form-label">Description :</label>
              <div class="col-sm-6">
                  <textarea class="form-control" name="description" rows="10" spellcheck="true"><?php echo $vehicule->description ?></textarea>
              </div>
            </div>
            <div class="form-group row justify-content-md-center">
            <button class="btn btn-danger" type="submit">Modifier les informations</button>
            </div>
            <div class="form-group row justify-content-md-center">
                <input hidden="hidden" type="text" name="id" value="<?php echo $vehicule->id_vehicule ?>">
            </div>
            
            
            
        </form>
    </div>
</body>
</html>
<?php
}