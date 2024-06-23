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
    <input type="text" placeholder="Ocena" name="grade"><br><br>
    <select name="subject" id="subject">
    <?php
      require_once __DIR__."/../../../controllers/TeacherController.php";
      $subjects = (new TeacherController) ->getTeacherSubjects();
        foreach ($subjects as $subject){
          echo "<option value=\"$subject[name]\">$subject[name]</option>";
        }
      ?>
      </select><br><br>
    <button>Wpisz ocenę</button>
  </form>
</div>
</div>

<?php
  require_once (realpath(dirname(__FILE__).'/../../..').'\controllers\TeacherController.php'); 
  $teacherController = new teacherController;
  $teacherController->writeGrade();
?>
</body>