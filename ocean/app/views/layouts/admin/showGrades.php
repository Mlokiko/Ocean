<?php
  error_reporting(E_ALL & ~E_NOTICE); // co z oczu to z serca :)
  session_start();
  require_once(realpath(dirname(__FILE__).'/../../..').'\views\header.php');
  ?>
<body>
<div id="container">
<div class="input-container">
  <form action="" method="post">
    <input type="text" placeholder="Nazwa użytkownika" name="username" autofocus><br><br>
    <button>Pokaż oceny</button>
  </form>
</div>
</div>

  <?php
  require_once (realpath(dirname(__FILE__).'/../../..').'\controllers\AdminController.php'); 
  $adminController = new AdminController;
  $adminController->displayGrades();
  ?>
</body>