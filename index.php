<?php

require 'vendor/autoload.php';
require 'models/truck.php';
require 'models/user.php';
require 'models/mission.php';
require 'models/place.php';
require 'models/company.php';
require 'models/category.php';
$app = new \Slim\Slim(array(
    'view' => '\Slim\LayoutView', // I activate slim layout component
    'layout' => 'layouts/main.php' // I define my main layout
    ));
/*------------------EXEMPLE--------------------------
$app->get('/getSeeting/:userId', function ($userId) {
    //renvoi les seetings de l'utilisateur
    $seeting = User::getSeeting($userId);
});
-----------------------------------------------------*/

$app->hook('slim.before.router', function () use ($app){
    $app->view()->setData('app',$app);
});

$view = $app->view();
$view->setTemplatesDirectory('views');


$app->get('/', function () use ($app){
    $nbAffectedTruck = Truck::getAffectedTruck();
    $nbNotAffectedTruck = Truck::getNotAffectedTruck();
    $nbTruck = sizeof(Truck::getAllTruck());
    $nbUser = sizeof(User::getAllUser())-1;
    $userTruck = $nbUser / $nbTruck;
    $nbMissionActive = Mission::nbMissionActive();
    $nbMissionNotActive = Mission::nbMissionNotActive();
    $app->render('index.php', array('nbAffectedTruck'=>$nbAffectedTruck,
        'nbNotAffectedTruck'=>$nbNotAffectedTruck,
        'nbUser'=>$nbUser,
        'userTruck'=>$userTruck,
        'nbMissionActive'=>$nbMissionActive,
        'nbMissionNotActive'=>$nbMissionNotActive
        ));
});
$app->get('/index', function () use ($app){
    $nbAffectedTruck = Truck::getAffectedTruck();
    $nbNotAffectedTruck = Truck::getNotAffectedTruck();
    $nbTruck = sizeof(Truck::getAllTruck());
    $nbUser = sizeof(User::getAllUser())-1;
    $userTruck = $nbUser / $nbTruck;
    $nbMissionActive = Mission::nbMissionActive();
    $nbMissionNotActive = Mission::nbMissionNotActive();
    $app->render('index.php', array('nbAffectedTruck'=>$nbAffectedTruck,
        'nbNotAffectedTruck'=>$nbNotAffectedTruck,
        'nbUser'=>$nbUser,
        'userTruck'=>$userTruck,
        'nbMissionActive'=>$nbMissionActive,
        'nbMissionNotActive'=>$nbMissionNotActive
    ));
});
$app->get('/truckManagement', function () use ($app){
    $trucks = Truck::getAllTruck();
    $companys = Company::getAllCompany();
    $categorys = Category::getAllCategory();
    $users = User::getAllUser();
    $truck = Truck::getAllTruck();
   $app->render('truckManagement.php', array('trucks'=> $trucks,
       'companys'=>$companys,
       'categorys'=>$categorys,
       'users'=>$users,
       'trucks'=>$trucks
       ));
});
$app->get('/userManagement', function () use($app){
    $users = User::getAllUser();
    $roles = Role::getAllRole();
   $app->render('userManagement.php', array(
       'users'=>$users,
       'roles'=>$roles
   ));
});
$app->get('/foundTruck/:id', function ($id) use ($app){
    $truck = new truck($id);
    $truckLocation = $truck->getLocation();
    $app->render('truckLocation.php', array('truckLocation'=> $truckLocation,'uri'=>"../"));
});

$app->get('/foundTrucks', function () use ($app){
   $trucks = Truck::getAllTruck();
   $app->render('trucksLocation.php', array('trucks'=>$trucks));
});
$app->get('/getTruck/:id', function($id) use ($app){
    $truck = new truck($id);
});
$app->get('/deleteTruck/:id', function($id) use ($app){
    Truck::deleteTruck($id);
    $app->redirect('../truckManagement');
});
$app->get('/addTruck', function() use($app){
    Truck::addTruck();
    $app->redirect("truckManagement");
});
$app->get('/affectTruck', function ()use($app){
   Truck::affectTruck();
   $app->redirect("truckManagement");
});
$app->get('/updateTruck', function () use($app){
    Truck::updateTruck();
    $app->redirect("truckManagement");
});
$app->get('/updateUser', function () use($app){
   User::updateUser();
   $app->redirect("userManagement");
});
$app->get('/addUser', function () use($app){
    User::addUser();
    $app->redirect("userManagement");
});
$app->get('/deleteUser/:id', function ($id) use($app){
   User::deleteUser($id);
   $app->redirect("../userManagement");
});
$app->get('/missionManagement', function() use($app){
    $missions = Mission::getAllMission();
    $users = User::getAllUser();
    $app->render('missionManagement.php', array('users'=>$users, 'missions'=>$missions));
});
$app->get('/addMission', function() use($app){
    Mission::addMission();
    $app->redirect("missionManagement");
});
$app->get('/endMission/:id', function($id) use($app){
    Mission::endMission($id);
    $app->redirect("../missionManagement");
});
$app->get('/affectMission', function() use($app){
    Mission::affectMission();
    $app->redirect("missionManagement");
});
$app->get('/entrepriseManagement', function() use($app){
    $companys = Company::getAllCompany();
    $app->render('companyManagement.php', array('companys'=>$companys));
});
$app->get('/addCompany', function() use($app){
    Company::addCompany();
    $app->redirect('entrepriseManagement');
});
$app->get('/deleteCompany/:id', function($id) use($app){
    Company::deleteCompany($id);
    $app->redirect('../entrepriseManagement');
});
$app->get('/updateCompany', function() use($app){
   Company::updateCompany();
   $app->redirect('entrepriseManagement');
});
    $app->run();

?>