<?php
  error_reporting(E_ALL & ~E_NOTICE); // co z oczu to z serca :)
  session_start();
  require_once(realpath(dirname(__FILE__).'/../../..').'\views\header.php');
  require_once __DIR__."/../../../controllers/AdminController.php";
?>
 <div id="container">
  <div class="input-container">
    <form method="post">
      <label for="username">Wybierz klasę</label>
      <select name="class" id="class">
        <?php
            $classes = (new AdminController) ->getClasses();
            foreach ($classes as $classes){
              echo "<option value=\"$classes[id]\">$classes[name]</option>";
            }
        ?>
      </select><br><br>
      <button type="submit" name="checkStudents">Sprawdż uczniów</button>
    </form>
 </div>
</div>
<?php
$adminController = new AdminController;
$adminController->getAllStudentsFromClass();
?>