<?php

/**
 * Created by PhpStorm.
 * User: Louis
 * Date: 13/01/2017
 * Time: 13:46
 */
class sector
{
    private $id;
    private $name;
    private $positionY;
    private $positionX;

    public function __construct($id)
    {
        $this->getSector($id);
    }

    private function getSector($id){
        $db = null;
        include('bdd.php');
        $req = $db->prepare('SELECT * FROM sector WHERE Id ='.$id);
        $req->execute();
        $donnee = $req->fetch();
        $this->id = $id;
        $this->name = $donnee["Name"];
        $this->positionX = $donnee["PositionX"];
        $this->positionY = $donnee["PositionY"];
    }
    public function getLocation(){
        return new location($this->positionX, $this->positionY);
    }
}