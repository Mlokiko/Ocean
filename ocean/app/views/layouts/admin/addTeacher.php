<?php
  error_reporting(E_ALL & ~E_NOTICE); // co z oczu to z serca :)
  session_start();
  require_once(realpath(dirname(__FILE__).'/../../..').'\views\header.php');
  require_once __DIR__."/../../../controllers/AdminController.php";
?>
 <div id="container">
  <div class="input-container">
    <form method="post">
      <label for="username">Nazwa użytkownika</label>
      <input type="text" placeholder="Wpisz nazwę użytkownika" name="username" id="username" autofocus><br><br>
      <label for="subject">Przedmiot</label>
      <select name="subject" id="subject">
        <?php
            $subjects = (new AdminController) ->getSubjects();
            foreach ($subjects as $subject){
              echo "<option value=\"$subject[id]\">$subject[name]</option>";
            }
        ?>
      </select><br><br>
      <button type="submit" name="add-sub">Nadaj przedmiot</button>
    </form>
 </div>
</div>
<?php
  if(isset($_POST['add-sub'])){
    $adminController = new AdminController();
    $adminController->addTeacher();
  }
?>