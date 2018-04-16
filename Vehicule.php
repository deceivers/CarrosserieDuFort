<?php
class Vehicule {
    public $id_vehicule;
    public $marque='';
    public $modele='';
    public $complement;
    public $mise_en_circulation='';
    public $couleur='';
    public $km=0;
    public $energie;
    public $porte;
    public $fiscaux;
    public $din;
    public $procedure='';
    public $num_vo=0;
    public $num_dossier=0;
    public $prix=0;
    public $photo='';
    public $description='';

    public function __construct($id_vehicule=0){
        $this->id_vehicule=$id_vehicule;

    }
    public  function charger(){
        // Charge $this depuis la DB en se fiant à son id.
        global $connexion;
        $connexion->req="SELECT * FROM vehicule WHERE id_vehicule={$this->id_vehicule}";
        return $connexion->query()->ins($this);
    }

    public function charger_vehicule(){
        global $connexion;
        $connexion->req="SELECT * FROM vehicule";
        return $connexion->query()->tab('Vehicule');
    }

    public function supprimer_vehicule(){
        global $connexion;
        $connexion->req="DELETE FROM vehicule WHERE id_vehicule={$this->id_vehicule}";
        $connexion->xeq();
    }
    public function modifier_vehicule($id){
        global $connexion;
        $connexion->req="UPDATE `vehicule` SET `marque`='$this->marque',`modele`='$this->modele',`mise_en_circulation`='$this->mise_en_circulaion',`couleur`='$this->couleur',`km`='$this->km',`procedure`='$this->procedures',`num_vo`='$this->num_vo',`num_dossier`='$this->num_dossier',`prix`='$this->prix',`photo`='$this->photo',`description`='$this->description' WHERE `id_vehicule`='$id'";
        $connexion->xeq();
        
    }

    public function ajouter_vehicule(){
        global $connexion;
        $connexion->req = "INSERT INTO vehicule(marque, modele, complement, mise_en_circulation, couleur, km, energie, porte, fiscaux, din, `procedure`, num_vo, num_dossier, prix, photo, description)  
        VALUES ('$this->marque','$this->modele','$this->complement','$this->mise_en_circulaion','$this->couleur','$this->km','$this->energie','$this->porte','$this->fiscaux','$this->din','$this->procedures','$this->num_vo','$this->num_dossier','$this->prix','$this->photo','$this->description')";
        $connexion->xeq();
    }

    public function charger_id(){
        global $connexion;
        $connexion->req="SELECT * FROM vehicule WHERE id_vehicule=LAST_INSERT_ID()";
        return $connexion->query()->ins($this);
    }
}
/**
 * Created by PhpStorm.
 * User: Florian
 * Date: 17/07/2015
 * Time: 15:43
 */