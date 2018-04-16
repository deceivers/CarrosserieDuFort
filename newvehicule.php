<?php
session_start();
include ('cfg.php');
include ('Vehicule.php');
include('Photo.php');

//--------------------------------------------------------GESTION DE LA TABLE VEHICULE------------------------------------------------

//Création du vehicule
$vehicule=new Vehicule();
$vehicule->marque=(filter_input(INPUT_POST, 'marque'));
$vehicule->modele=(filter_input(INPUT_POST, 'modele'));
$vehicule->complement=(filter_input(INPUT_POST, 'complement'));
$vehicule->mise_en_circulaion=(filter_input(INPUT_POST, 'jour'))."-".(filter_input(INPUT_POST, 'mois'))."-".(filter_input(INPUT_POST, 'annee'));
$vehicule->couleur=(filter_input(INPUT_POST, 'couleur'));
$vehicule->km=(filter_input(INPUT_POST, 'km'));
$vehicule->energie=(filter_input(INPUT_POST, 'energie'));
$vehicule->porte=(filter_input(INPUT_POST, 'porte'));
$vehicule->fiscaux=(filter_input(INPUT_POST, 'fiscaux'));
$vehicule->din=(filter_input(INPUT_POST, 'din'));
$vehicule->procedures=(filter_input(INPUT_POST, 'procedure'));
$vehicule->description=(filter_input(INPUT_POST, 'description'));
$vehicule->num_vo=(filter_input(INPUT_POST, 'numVO'));
$vehicule->num_dossier=(filter_input(INPUT_POST, 'numDossier'));
$vehicule->prix=(filter_input(INPUT_POST, 'prix'));

// AJOUT DE LA VOITURE DANS LA BDD
$vehicule->ajouter_vehicule();
$vehicule->charger_id();
//-------------------------------------------------------GESTION DE LA TABLE PHOTO-------------------------------------------------------

$id_véhicule=$vehicule->id_vehicule;

//Creation de la photo principal
if(isset($_FILES['photoPrincipal'])){
    $name = $_FILES['photoPrincipal']['name'];
    $type = $_FILES['photoPrincipal']['type'];
    $tmp_name = $_FILES['photoPrincipal']['tmp_name'];
    
    $photo=new Photo();
    $photo->id_vehicule=$id_véhicule;
    $photo->principal=1;
    $photo->photo='image/'.$name;
    $photo->ajouter_photo();
    move_uploaded_file($tmp_name, 'image/'.$name);
}

//Creation des autre photo 
if(isset($_FILES['photo'])){
    $nb = 0;
    foreach($_FILES['photo']['name'] as $element) {
        $tmp_name = $_FILES['photo']['tmp_name'][$nb];
        $name = $_FILES['photo']['name'][$nb];
        $size = $_FILES['photo']['size'][$nb];
        $type = $_FILES['photo']['type'][$nb];
        
        $photo=new Photo();
        $photo->id_vehicule=$id_véhicule;
        $photo->photo='image/'.$name;
        $photo->ajouter_photo();
        move_uploaded_file($tmp_name, 'image/'.$name);
        $nb++;
    }
}

header('Location: gestion.php');
