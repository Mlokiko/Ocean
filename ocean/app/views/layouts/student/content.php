<?php
  //session_start();
  require_once(realpath(dirname(__FILE__).'/../../..').'\views\header.php');
?>
<body>
<div id="container">
<div class="input-container">
<form method="post">
    <button type="submit" name="showGrades">Sprawdż swoje oceny</button><br>
</form>
</div>
</div>
<?php
require_once (realpath(dirname(__FILE__).'/../../..').'\controllers\StudentController.php'); 
$studentController = new StudentController;
$studentController->displayGrades();
?>
</body>