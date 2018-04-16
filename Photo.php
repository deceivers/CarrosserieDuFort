<?php
class Photo
{

    public $id_photo;
    public $id_vehicule = 0;
    public $photo = '';
    public $principal=0;


    public function __construct($id_vehicule = 0)
    {
        $this->id_vehicule = $id_vehicule;

    }

    public function ajouter_photo()
    {
        global $connexion;
        $connexion->req = "INSERT INTO photo (id_vehicule, photo, principal)
        VALUES ('$this->id_vehicule','$this->photo', '$this->principal')";
        $connexion->xeq();
    }
    
    /**public function modifier_photo($id){
        global $connexion;
        $connexion->req="UPDATE `photo` SET `id_vehicule`='$this->id_vehicule',`photo`='$this->photo1',WHERE `id_vehicule`='$id'";
        $connexion->xeq();
        
    }**/

    public function charger_principal()
    {
        // Charge $this depuis la DB en se fiant à son id.
        global $connexion;
        $connexion->req = "SELECT * FROM photo WHERE id_vehicule={$this->id_vehicule} AND principal = 1";
        return $connexion->query()->ins($this);
    }
    
    public function charger_une()
    {
        // Charge $this depuis la DB en se fiant à son id.
        global $connexion;
        $connexion->req = "SELECT * FROM photo WHERE id_photo={$this->id_photo}";
        return $connexion->query()->ins($this);
    }
    
    public function charger_tout(){
        global $connexion;
        $connexion->req="SELECT * FROM photo WHERE id_vehicule = $this->id_vehicule";
        return $connexion->query()->tab('Photo');
    }
    
    public function charger_autre(){
        global $connexion;
        $connexion->req="SELECT * FROM photo WHERE id_vehicule = $this->id_vehicule AND principal= 0";
        return $connexion->query()->tab('Photo');
    }
    
    public function supprimer_photo(){
        if(file_exists($this->photo)){
        unlink($this->photo);
        }
        global $connexion;
        $connexion->req="DELETE FROM photo WHERE id_photo={$this->id_photo}";
        $connexion->xeq();
    }
}

