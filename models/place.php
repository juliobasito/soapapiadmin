<?php

/**
 * Created by PhpStorm.
 * User: Louis
 * Date: 15/01/2017
 * Time: 11:58
 */
class place
{
    private $id;
    private $localisation;
    private $quality;
    private $receptionNumber;

    public function __construct($id, $type)
    {
        $this->getPlace($id, $type);
    }

    private function getPlace($id, $type){
        $db = null;
        include('bdd.php');
        if($type == 'start'){
            $req = $db->prepare('SELECT * FROM start WHERE Id ='.$id);
            $req->execute();
            $donnee = $req->fetch();
        }
        elseif ($type =='end'){
            $req = $db->prepare('SELECT * FROM end WHERE Id ='.$id);
            $req->execute();
            $donnee = $req->fetch();
        }
        $this->id = $id;
        $this->localisation = $donnee['Localisation'];
        $this->quality = $donnee['Quality'];
        $this->receptionNumber = $donnee['ReceptionNumber'];
    }
    public function getLocalisation(){
        return $this->localisation;
    }

}