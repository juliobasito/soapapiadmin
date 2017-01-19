<?php

/**
 * Created by PhpStorm.
 * User: Louis
 * Date: 15/01/2017
 * Time: 11:52
 */
class mission
{
    private $id;
    private $title;
    private $content;
    private $dateStart;
    private $dateEnd;
    private $start;
    private $end;
    private $shipmentCode;
    private $user;
    private $isFinish;

    public function __construct($id)
    {
        $this->getMission($id);
    }

    private function getMission($id){
        $db = null;
        include('bdd.php');
        $req = $db->prepare('SELECT * FROM mission WHERE Id ='.$id);
        $req->execute();
        $donnee = $req->fetch();
        $this->id = $id;
        $this->title = $donnee["Title"];
        $this->content = $donnee["Content"];
        $this->dateStart = $donnee["Start"];
        $this->dateEnd = $donnee["End"];
        $this->start = new place($donnee['Id_Start'], 'start');
        $this->end = new place($donnee['Id_End'], 'end');
        $this->shipmentCode = $donnee['ShipmentCode'];
        $this->user = new user($donnee['Id_User']);
        $this->isFinish = $donnee['isFinish'];
    }
    public function getId(){
        return $this->id;
    }
    public function getTitle(){
        return $this->title;
    }
    public function getTruck(){
        return $this->truck;
    }
    public function getDateStart(){
        return $this->dateStart;
    }
    public function getDateEnd(){
        return $this->dateEnd;
    }
    public function getStart(){
        return $this->start;
    }
    public function getEnd(){
        return $this->end;
    }
    public function getUser(){
        return $this->user;
    }
    public function getIsFinish(){
        return $this->isFinish;
    }
    public static function nbMissionActive(){
        $db = null;
        include('bdd.php');
        $req = $db->prepare('SELECT count(Id) AS "nb" FROM mission WHERE isFinish = 0');
        $req->execute();
        $donnee = $req->fetch();
        return $donnee['nb'];
    }
    public static function nbMissionNotActive(){
        $db = null;
        include('bdd.php');
        $req = $db->prepare('SELECT count(Id) AS "nb" FROM mission WHERE isFinish = 1');
        $req->execute();
        $donnee = $req->fetch();
        return $donnee['nb'];
    }
    public static function getAllMission(){
        $db=null;
        include('bdd.php');
        $req = $db->prepare('SELECT * FROM mission');
        $req->execute();
        $tab = [];
        while($donnee = $req->fetch()){
            $tab[] = new mission($donnee["Id"]);
        }
        return $tab;
    }
    public static function addMission()
    {
        $db=null;
        include ('bdd.php');
        $sql = $db->prepare('INSERT INTO start (Localisation)VALUES("'.$_GET["start"].'")');
        $sql->execute();
        $idStart = $db->lastInsertId();
        $sql2 = $db->prepare('INSERT INTO end (Localisation)VALUES("'.$_GET["end"].'")');
        $sql2->execute();
        $idEnd = $db->lastInsertId();
        $req = $db->prepare('INSERT INTO mission (Title, Content, Start, End, isFinish, Id_Start, Id_End)VALUES("'.$_GET["title"].'", "'.$_GET["content"].'", "'.$_GET["dateStart"].'", "'.$_GET["dateEnd"].'" ,false, '.$idStart.', '.$idEnd.')');
        $req->execute();
    }
    public static function endMission($id){
        $db = null;
        include ('bdd.php');
        $req = $db->prepare('UPDATE mission SET isFinish = true WHERE Id = '.$id);
        $req->execute();
    }
    public static function affectMission(){
        $db = null;
        include ('bdd.php');
        $req = $db->prepare('UPDATE mission SET Id_User = '.$_GET["user"].' WHERE Id = '.$_GET["mission"]);
        $req->execute();
    }
}