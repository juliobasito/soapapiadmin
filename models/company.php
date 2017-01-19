<?php

/**
 * Created by PhpStorm.
 * User: Louis
 * Date: 13/01/2017
 * Time: 13:41
 */
require 'sector.php';
class company
{
    private $id;
    private $name;
    private $address;
    private $sector;

    public function __construct($id)
    {
        $this->getCompany($id);
    }

    public function getCompany($id){
        $db = null;
        include('bdd.php');
        $req = $db->prepare('SELECT * FROM company WHERE Id ='.$id);
        $req->execute();
        $donnee = $req->fetch();
        $this->id = $id;
        $this->name = $donnee["Name"];
        $this->address = $donnee["Address"];
        $this->sector = new sector($donnee["Id_Sector"]);
    }
    public function getName(){
        return $this->name;
    }
    public function getId(){
        return $this->id;
    }
    public function getSector(){
        return $this->sector;
    }
    public function getAdress(){
        return $this->address;
    }
    public static function getAllCompany(){
        $db = null;
        include('bdd.php');
        $req = $db->prepare('SELECT * FROM company');
        $req->execute();
        $tab = [];
        while($donnee = $req->fetch()){
            $tab[] = new company($donnee["Id"]);
        }
        return $tab;
    }
    public static function addCompany(){
        $db = null;
        include ('bdd.php');
        $req = $db->prepare('INSERT INTO sector (Name, PositionX, PositionY) VALUES ("'.$_GET["name"].'", "'.$_GET["positionX"].'", "'.$_GET["positionY"].'")');
        $req->execute();
        $idSector = $db->lastInsertId();
        $req = $db->prepare('INSERT INTO company (Name, Address, Id_Sector) VALUES ("'.$_GET["name"].'","'.$_GET["address"].'",'.$idSector.')');
        $req->execute();
    }
    public static function deleteCompany($id){
        $db = null;
        include ('bdd.php');
        $req = $db->prepare("DELETE FROM company WHERE Id = ".$id);
        $req->execute();
    }
    public static function updateCompany(){
        $db = null;
        include ('bdd.php');
        $sql = "UPDATE company SET";
        $bool = false;
        if($bool && isset($_GET["name"]))
            $sql = $sql.', Name = "'.$_GET["name"].'"';
        if(!$bool && isset($_GET["name"])){
            $sql = $sql.' Name = "'.$_GET["name"].'"';
            $bool = true;
        }
        if($bool && isset($_GET["address"]))
            $sql = $sql.', Address = "'.$_GET["address"].'"';
        if(!$bool && isset($_GET["address"])){
            $sql = $sql.' Adress = "'.$_GET["address"].'"';
            $bool = true;
        }
        if($bool && isset($_GET["positionX"]))
            $sql = $sql.', PositionX = "'.$_GET["positionX"].'"';
        if(!$bool && isset($_GET["positionX"])){
            $sql = $sql.' PositionX = "'.$_GET["positionX"].'"';
            $bool = true;
        }
        if($bool && isset($_GET["positionY"]))
            $sql = $sql.', PositionY = "'.$_GET["positionY"].'"';
        if(!$bool && isset($_GET["positionY"])){
            $sql = $sql.' PositionY = "'.$_GET["positionY"].'"';
            $bool = true;
        }
        $sql = $sql.' WHERE Id = '.$_GET["id"];
        $req = $db->prepare($sql);
        $req->execute();

    }
}