<?php
error_reporting(E_ALL & ~E_NOTICE); // co z oczu to z serca :)
session_start();
require_once(realpath(dirname(__FILE__).'/../../..').'\views\header.php');
require_once "./../../../controllers/AdminController.php";
    $classes = (new AdminController)->getClasses();
?>
<body>
  <div id="container">
    <div class="input-container">
      <form method="post">
        <label for="username">Nazwa użytkownika</label>
        <input type="text" placeholder="Wpisz nazwę użytkownika" name="username" id="username" autofocus><br><br>
        <label for="class">Klasa</label>
        <select name="class" id="class">
        <?php
          foreach ($classes as $class){
            echo "<option value=\"$class[id]\">$class[name]</option>";
          }
        ?>
        </select><br><br>
        <button type="submit" name="add-sub">Przypisz klasę</button>
      </form>
    </div>
  </div>
<?php
  if(isset($_POST['add-sub'])){
    $adminController = new AdminController();
    $adminController->addStudent();
  }
?>
</body>