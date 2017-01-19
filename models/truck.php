<?php

/**
 * Created by PhpStorm.
 * User: Louis
 * Date: 13/01/2017
 * Time: 11:36
 */
require 'location.php';
//require 'user.php';
class truck
{
    private $id;
    private $brand;
    private $model;
    private $company;
    private $category;
    private $location;
    private $user;
    private $state;
    private $ct;

    function __construct($id){
        $this->getTruck($id);
    }
    private function getTruck($id){
        $db = null;
        include('bdd.php');
        $req = $db->prepare('SELECT * FROM truck WHERE Id ='.$id);
        $req->execute();
        $tab = [];
        while($donnee = $req->fetch()){
            $tab[] = $donnee;
        }
        for($i = 0;$i<sizeof($tab);$i++){
            $this->id = $tab[$i]["Id"];
            $this->brand = $tab[$i]["Brand"];
            $this->model = $tab[$i]["Model"];
            $this->state = $tab[$i]["State"];
            $this->location = new location($tab[$i]["LocalisationX"], $tab[$i]["LocalisationY"]);
            $this->user = new user($tab[$i]["Id_User"]);
            $this->company = new company($tab[$i]["Id_Company"]);
            $this->category = new category($tab[$i]["Id_Category"]);
            $this->ct = $tab[$i]["ct"];
        }
    }
    public function getId(){
        return $this->id;
    }
    public function getBrand(){
        return $this->brand;
    }
    public function getModel(){
        return $this->model;
    }
    public function getCompany(){
        return $this->company;
    }
    public function getUser(){
        return $this->user;
    }
    public function getCategory(){
        return $this->category;
    }
    public function getState(){
        return $this->state;
    }
    public function getLocation(){
        return $this->location;
    }
    public function getCt(){
        return $this->ct;
    }
    public static function getAllTruck(){
        $db = null;
        include('bdd.php');
        $req = $db->prepare('SELECT * FROM truck');
        $req->execute();
        $tab = [];
        while($donnee = $req->fetch()){
            $tab[] = new truck($donnee["Id"]);
        }
        return $tab;
    }
    public static function deleteTruck($id){
        $db = null;
        include('bdd.php');
        $req = $db->prepare('DELETE FROM truck WHERE Id = '.$id);
        $req->execute();
    }
    public static function getAffectedTruck(){
        $db = null;
        include('bdd.php');
        $req = $db->prepare('SELECT * FROM user WHERE FirstName = "Libre"');
        $req->execute();
        $donnee = $req->fetch();
        $req2 = $db->prepare('SELECT count(Id) AS "nb" FROM truck WHERE Id_User != '.$donnee["Id"]);
        $req2->execute();
        $nb = $req2->fetch();
        return $nb["nb"];
    }
    public static function getNotAffectedTruck(){
        $db = null;
        include('bdd.php');
        $req = $db->prepare('SELECT * FROM user WHERE FirstName = "Libre"');
        $req->execute();
        $donnee = $req->fetch();
        $req2 = $db->prepare('SELECT count(Id) AS "nb" FROM truck WHERE Id_User = '.$donnee["Id"]);
        $req2->execute();
        $nb = $req2->fetch();
        return $nb["nb"];
    }
    public static function addTruck(){
        $db = null;
        include('bdd.php');
        $req = $db->prepare('INSERT INTO truck (Brand, Model, Id_Company, Id_Category, LocalisationX, LocalisationY, Id_User) VALUES ("'.$_GET["brand"].'", "'.$_GET["model"].'", '.$_GET["company"].', '.$_GET["category"].', 0, 0, 2)');
        $req->execute();
    }
    public static function affectTruck(){
        $db = null;
        include('bdd.php');
        $req = $db->prepare('UPDATE truck SET Id_User = '.$_GET["user"].' WHERE Id = '.$_GET["truck"]);
        $req->execute();
    }
    public static function updateTruck(){
        $db = null;
        include('bdd.php');
        $company = new company($_GET['localisation']);
        $sector = $company->getSector();
        $location = $sector->getLocation();
        $x = $location->getX();
        $y = $location->getY();
        $req = $db->prepare('UPDATE truck SET Id_Company = '.$_GET["company"].', LocalisationX = "'.$x.'", LocalisationY ="'.$y.'", State ="'.$_GET["state"].'", ct = "'.$_GET["ct"].'" WHERE Id ='.$_GET["truck"]);
        $req->execute();
    }
}