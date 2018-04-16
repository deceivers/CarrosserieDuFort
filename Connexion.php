<?php

class Connexion {
    public $con=NULL; // Objet connexion encapsulé(PDO)
    public $req=''; // Requête à exécuter
    public $jeu=NULL; // Jeu d'enregistrement retourné par query() (PDOStatement).

    public function __construct()
    {
        try {
            $this->con = new PDO("mysql:host=localhost;dbname=carrosserie", "root", "");
            $this->req="SET NAMES utf8";
            $this->xeq();
        } catch (PDOException $connexion) {
            echo "<p> Erreur : connexion impossible ! </p>";
            echo "<p>{$connexion->getMessage()}</p>";
            exit;
        }
    }
    public function xeq(){
        //Exécute la requête $this->req hors SELECT
        // Retourne le nombre d'enregistrement affectés
        $nb=$this->con->exec($this->req);
        if ($nb===false){
        echo "<p>Erreur : requête incorrete  XEQ! </p>";
        exit;
        }
    $this-> req='';
    return $nb;
    }

    public function query(){
    //Exécute la requête $this->req de type SELECT.
    //Retourne $this pour chaîner avec tab() ou first().
    $this->jeu=$this->con->query($this->req);
    if($this->jeu===false){
        echo"<p>Erreur : requete incorrecte QUERY !</p>";
        exit;
    }
    $this->req='';
    return $this;
    }

    public function tab($class='stdClass'){
        // Exploite le jeu d'enregistrement (PDOStatement) contenu dans $this->jeu
        //après l'exécution d'un requête SELECT.
        // Retourne le jeu sous forme d'un tableau
       $this->jeu->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,$class); //setFetchMode detail la maniere dont on veut récupéré le jeu
       return $this->jeu->fetchAll();
    }

    public function ins($instance=null){
        // Charge l'instance $instance.
        //
        //Retourne true si succès, false sinon.
        $this->jeu->setFetchMode(PDO::FETCH_INTO, $instance);
        return(bool)($this->jeu->fetch());
    }
}

