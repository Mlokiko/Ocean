<?php
//require_once(realpath(dirname(__FILE__).'/../../..').'\views\header.php');
error_reporting(E_ALL & ~E_NOTICE); // co z oczu to z serca :)
session_start();
require_once(realpath(dirname(__FILE__).'/../../..').'\views\header.php');
require_once "./../../../controllers/AdminController.php";
$adminController = new AdminController;
$adminController->create_with_role();
?> 
<link rel="stylesheet" href="/ocean/app/css/universal.css">
<body>
<div class="login-container">
    <h1>Dziennik</h1><br><br>
    <h2>Zarejestruj użytkownika</h2>
    <form action="" method="post">
        <div class="input-group">
            <label for="username">Nazwa użytkownika</label>
            <input type="text" name="username" id="username" autofocus>
            <label for="firstname">Imię</label>
            <input type="text" name="firstname" id="firstname" >
            <label for="lastname">Nazwisko</label>
            <input type="text" name="lastname" id="lastname" >
            <label for="password">Hasło</label>
            <input type="password" name="password" id="password">
            <label for="email">Email</label>
            <input type="email" name="email" id="email">
            <label for="dateofbirth">Data urodzenia</label>
            <input type="date" name="dateofbirth" id="dateofbirth">
            <label for="role">Rola</label>
            <select name="role" id="role">
              <option value="admin">Admin</option>
              <option value="teacher">Nauczyciel</option>
              <option value="student">Uczeń</option>
              <option value="user">User</option>
            </select><br>
        </div>
        <button type="submit">Stwórz użytkownika</button>
    </form>
</div>
</body>
</html>