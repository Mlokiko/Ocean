<?php
  error_reporting(E_ALL & ~E_NOTICE); // co z oczu to z serca :)
  session_start();
  require_once(realpath(dirname(__FILE__).'/../../..').'\views\header.php');
  require_once(realpath(dirname(__FILE__).'/../../..').'\views\header.php');
  require_once "./../../../controllers/AdminController.php";
  $adminController = new AdminController;
  $adminController->remove();
?>
<body>
<div id="container">
<div class="input-container">
<form method="post">
  <label>Usuwanie użytkownika</label><br><br>
  <input type="text" placeholder="Nazwa użytkownika" name="username" autofocus><br><br>
  <button type="submit" name="removeUser">Usuń użytkownika</button>
</form>  
</div>
</div>
</body>