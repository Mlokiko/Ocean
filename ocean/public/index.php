<?php
    //error_reporting(E_ALL & ~E_NOTICE); // co z oczu to z serca :)
    define('BASE_PATH', realpath(dirname(__FILE__).'/..'));
    require_once BASE_PATH . '/app/controllers/UserController.php';
    require_once BASE_PATH . '/app/controllers/AdminController.php';

    $userController = new UserController();
    $adminController = new AdminController();

    if ($_SERVER['REQUEST_URI'] == '/ocean/register') {
        $userController->register();
    }
    
    if ($_SERVER['REQUEST_URI'] == '/ocean/login') {
        $userController->login();
    }

    if ($_SERVER['REQUEST_URI'] == '/ocean/') {
        $userController->homepage();
    }

//header('location: ./login');
?>