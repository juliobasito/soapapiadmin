<!DOCTYPE html>
<html>
<head>
  <!--Import Google Icon Font-->
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="<?php if(isset($uri)){echo $uri;}?>css/materialize.min.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="<?php if(isset($uri)){echo $uri;}?>css/css.css"  media="screen,projection"/>

  <!--Let browser know website is optimized for mobile-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
  <nav>
    <div class="nav-wrapper blue lighten-1">
        <a href="index" class="brand-logo">DASHBOARD</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="<?php if(isset($uri)){echo $uri;}?>truckManagement">Gestion Camions</a></li>
            <li><a href="<?php if(isset($uri)){echo $uri;}?>userManagement">Gestion Utilisateurs</a></li>
            <li><a href="<?php if(isset($uri)){echo $uri;}?>missionManagement">Gestion Missions</a></li>
            <li><a href="<?php if(isset($uri)){echo $uri;}?>entrepriseManagement">Gestion Entreprises</a></li>
        </ul>
    </div>
  </nav>
<?php
/**
 * Created by PhpStorm.
 * User: julesbasse
 * Date: 16/12/2016
 * Time: 10:44
 */

echo $yield;

?>
  <!--Import jQuery before materialize.js-->
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script type="text/javascript" src="<?php if(isset($uri)){echo $uri;}?>js/materialize.min.js"></script>
</body>
</html>