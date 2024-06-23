<?php
error_reporting(E_ALL & ~E_NOTICE); // co z oczu to z serca :)
session_start();
require_once(realpath(dirname(__FILE__).'/../../..').'\views\header.php');
?>
<div id="container">
  <div class="input-container">
    <form method="post">
      <label>Nadawanie roli</label><br><br>

      <input type="text" placeholder="Nazwa użytkownika" name="username" autofocus><br><br>

      <select name="role" id="role">
        <option value="admin">admin</option>
        <option value="teacher">teacher</option>
        <option value="student">student</option>
        <option value="user">user</option>
      </select><br><br>

      <button type="submit" name="addRole">Nadaj rolę użytkownikowi</button>
    </form>  
  </div>
</div>
<?php
  require_once (realpath(dirname(__FILE__).'/../../..').'\controllers\AdminController.php'); 
  $adminController = new AdminController;
  $adminController->addRole();
  //require_once(realpath(dirname(__FILE__).'/../../..').'\views\footer.php');
?>