<?php
class Marque
{
    public $id_marque = 0;
    public $nom = '';


    public function __construct($id_marque = 0)
    {
        $this->id_marque = $id_marque;

    }

    public function ajouter_marque()
    {
        global $connexion;
        $connexion->req = "INSERT INTO marque VALUES ('$this->id_marque','$this->$nom')";
        $connexion->xeq();
    }

    public function charger_marque()
    {
        global $connexion;
        $connexion->req = "SELECT nom FROM marque";
        return $connexion->query()->tab('Marque');
    }

    public function supprimer_marque(){
        global $connexion;
        $connexion->req="DELETE FROM marque WHERE id_marque={$this->id_marque}";
        $connexion->xeq();
    }
}

