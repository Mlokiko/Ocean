<?php
//session_start();
?>
<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/ocean/app/css/universal.css">
    <title>0ł$zyN</title>
</head>
<header>
    <div id="przywitanie">
        <div id="logo">0ł$zyN</div> Witaj <?php echo $_SESSION['email'] ?>
    </div>
    <div id="nav">
        <form method="post">
            <button type="submit" name="btn_logOut">Wyloguj się</button>
            <!-- <button onclick="history.back()" type="submit" name="btn_getBack">Poprzednia strona</button> -->
            <button type="submit" name="btn_mainPage">Strona główna</button>
        </form>
    </div>
</header>
<br>
<?php
require_once (realpath(dirname(__FILE__).'/..').'\controllers\UserController.php');
if(isset($_POST['btn_mainPage'])){
    //define('BASE_PATH10', realpath(dirname(__FILE__).'/..'));
    // define('BASE_PATH10', dirname(__FILE__).'/..');
    //require_once BASE_PATH10 . '/app/views/home.php'; 
    // header("Location: git/app/views/home.php");
    $userController = new UserController;
    $userController->home();
}
if(isset($_POST['btn_logOut'])){
    $userController = new UserController;
    $userController->logOut();
}
?>