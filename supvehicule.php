<?php
include('cfg.php');
include('Vehicule.php');
include('Photo.php');
session_start();

$tonid = filter_input(INPUT_GET, 'id');
$vehicule= new Vehicule($tonid);
$vehicule->supprimer_vehicule();

$photo=new Photo($tonid);
$tabphoto= $photo->charger_tout();
foreach ($tabphoto as $photo) {
            $photo->supprimer_photo();
        }

header('Location: gestion.php');
