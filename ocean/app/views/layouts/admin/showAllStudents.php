<?php
error_reporting(E_ALL & ~E_NOTICE); // co z oczu to z serca :)
session_start();
require_once(realpath(dirname(__FILE__).'/../../..').'\views\header.php');
?>
<body>
<?php
    require_once "./../../../controllers/AdminController.php";
    $adminController = new AdminController;
    $adminController->getAllUsersWithRole("student");
?>
</body>