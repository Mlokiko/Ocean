<?php
  error_reporting(E_ALL & ~E_NOTICE); // co z oczu to z serca :)
  session_start();
  require_once(realpath(dirname(__FILE__).'/../../..').'\views\header.php');
?>
<body>
<div id="container">
<div class="input-container">
  <form action="" method="post">
    <label>Nazwa użytkownika ucznia</label>
    <input type="text" placeholder="Nazwa użytkownika" name="username" autofocus><br><br>
    <button>Pokaż oceny</button><br>
    <label>Data wystawienia oceny</label>
    <input type="text" placeholder="Data" name="date" autofocus><br>
    <label>Nowa Ocena</label>
    <input type="text" placeholder="Ocena" name="grade" autofocus><br>
    <button>Zmień ocenę</button>
  </form><br>
  W celu zmiany oceny, proszę podać datę wystawienia oceny którą chcesz zmodyfikować
</div>
</div>

  <?php
    require_once (realpath(dirname(__FILE__).'/../../..').'\controllers\TeacherController.php'); 
    $teacherController = new TeacherController;
    $teacherController->ModifyGrade();

  require_once (realpath(dirname(__FILE__).'/../../..').'\controllers\AdminController.php'); 
  $adminController = new AdminController;
  $adminController->displayGrades();


  ?>
</body>