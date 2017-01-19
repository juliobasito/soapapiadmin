<?php

/**
 * Created by PhpStorm.
 * User: Louis
 * Date: 13/01/2017
 * Time: 13:53
 */
class category
{
    private $id;
    private $name;
    private $formation;

    public function __construct($id)
    {
    $this->getCategory($id);
    }

    public function getCategory($id){
        $db = null;
        include('bdd.php');
        $req = $db->prepare('SELECT * FROM category WHERE Id ='.$id);
        $req->execute();
        $donnee = $req->fetch();
        $this->id = $id;
        $this->name = $donnee["Name"];
        $this->formation = $donnee["Formation"];
    }
    public function getName(){
        return $this->name;
    }
    public function getFormation(){
        return$this->formation;
    }
    public function getId(){
        return $this->id;
    }
    public static function getAllCategory(){
        $db = null;
        include('bdd.php');
        $req = $db->prepare('SELECT * FROM category');
        $req->execute();
        $tab = [];
        while($donnee = $req->fetch()){
            $tab[] = new category($donnee["Id"]);
        }
        return $tab;
    }
}