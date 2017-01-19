<?php

/**
 * Created by PhpStorm.
 * User: Louis
 * Date: 13/01/2017
 * Time: 13:26
 */
require 'role.php';
class user
{
    private $id;
    private $firstName;
    private $lastName;
    private $mail;
    private $phone;
    private $role;
    private $formation;

    function __construct($id){
    $this->getUser($id);
    }

    private function getUser($id){
        $db = null;
        include('bdd.php');
        $req = $db->prepare('SELECT * FROM user WHERE Id ='.$id);
        $req->execute();
        $donnee = $req->fetch();
        $this->id = $id;
        $this->firstName = $donnee["FirstName"];
        $this->lastName = $donnee["LastName"];
        $this->mail = $donnee["Mail"];
        $this->phone = $donnee["Phone"];
        $this->formation = $donnee["Formation"];
        $this->role = new role($donnee["Id_Role"]);
    }
    public function getFirstName(){
        return $this->firstName;
    }
    public function getLastName(){
        return $this->lastName;
    }
    public function getId(){
        return $this->id;
    }
    public function getMail(){
        return $this->mail;
    }
    public function getPhone(){
        return $this->phone;
    }
    public function getRole(){
        return $this->role;
    }
    public function getFormation(){
        return $this->formation;
    }
    public static function getAllUser(){
        $db = null;
        include('bdd.php');
        $req = $db->prepare('SELECT * FROM user');
        $req->execute();
        $tab = [];
        while($donnee = $req->fetch()){
            $tab[] = new user($donnee["Id"]);
        }
        return $tab;
    }
    public static function updateUser(){
        $db = null;
        include('bdd.php');
        $req="UPDATE user SET ";
        $req2 = "";
        if(isset($_GET["firstName"]) || isset($_GET["lastName"]) || isset($_GET["mail"]) || isset($_GET["password"]) || isset($_GET["role"]) || isset($_GET["phone"]) || isset($_GET["formation"])){
           if(isset($_GET["firstName"])){
               if($req2 == "")
                   $req2 = $req2.'FirstName = "'.$_GET["firstName"].'"';
               else
                   $req2 = $req2. ', FirstName = "'.$_GET["firstName"].'"';
           }
            if(isset($_GET["lastName"])){
                if($req2 == "")
                    $req2 = $req2. 'LastName = "'.$_GET["lastName"].'"';
                else
                    $req2 = $req2. ', LastName = "'.$_GET["lastName"].'"';
            }
            if(isset($_GET["mail"])){
                if($req2 == "")
                    $req2 = $req2. 'Mail = "'.$_GET["mail"].'"';
                else
                    $req2 = $req2. ', Mail = "'.$_GET["mail"].'"';
            }
            if(isset($_GET["phone"])){
                if($req2 == "")
                    $req2 = $req2. 'Phone = "'.$_GET["phone"].'"';
                else
                    $req2 = $req2. ', Phone = "'.$_GET["phone"].'"';
            }
            if(isset($_GET["password"])){
                if($req2 == "")
                    $req2 = $req2. 'Password = "'.$_GET["password"].'"';
                else
                    $req2 = $req2. ', Password = "'.$_GET["password"].'"';
            }
            if(isset($_GET["role"])){
                if($req2 == "")
                    $req2 = $req2. 'Role = "'.$_GET["role"].'"';
                else
                    $req2 = $req2. ', Role = "'.$_GET["role"].'"';
            }
            if(isset($_GET["formation"])){
                if($req2 == "")
                    $req2 = $req2. 'Formation = "'.$_GET["formation"].'"';
                else
                    $req2 = $req2. ', Formation = "'.$_GET["formation"].'"';
            }
            $req = $req ."". $req2;
            $req = $req. " WHERE Id = ".$_GET["id"];
            $sql = $db->prepare($req);
            $sql->execute();
        }
    }
    public static function addUser(){
        $db = null;
        include ('bdd.php');
        $req = $db->prepare('INSERT INTO user (FirstName, LastName, Mail, Phone, Password, Id_Role, Formation) VALUES ("'.$_GET["firstName"].'", "'.$_GET["lastName"].'", "'.$_GET["mail"].'", "'.$_GET["phone"].'", "'.$_GET["password"].'", '.$_GET["role"].', "'.$_GET["formation"].'")');
        $req->execute();
    }
    public static function deleteUser($id){
        $db = null;
        include('bdd.php');
        $req = $db->prepare('DELETE FROM user WHERE Id = '.$id);
        $req->execute();
    }
}