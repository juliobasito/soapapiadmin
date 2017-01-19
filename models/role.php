<?php

/**
 * Created by PhpStorm.
 * User: Louis
 * Date: 13/01/2017
 * Time: 13:34
 */
class role
{
    private $id;
    private $title;

    public function __construct($id)
    {
        if($id != null)
            $this->getRole($id);
    }

    private function getRole($id){
        $db = null;
        include('bdd.php');
        $req = $db->prepare('SELECT * FROM role WHERE Id ='.$id);
        $req->execute();
        $donnee = $req->fetch();
        $this->id = $id;
        $this->title = $donnee["Title"];
    }
    public function getId(){
        return $this->id;
    }
    public function getTitle(){
        return $this->title;
    }
    public static function getAllRole(){
        $db = null;
        include('bdd.php');
        $req = $db->prepare('SELECT * FROM role');
        $req->execute();
        $tab = [];
        while($donnee = $req->fetch()){
            $tab[] = new role($donnee["Id"]);
        }
        return $tab;
    }
}