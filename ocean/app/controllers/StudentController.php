<?php

define('BASE_PATH1', realpath(dirname(__FILE__).'/../..'));
require_once BASE_PATH1 . '/app/models/Student.php';

class StudentController{
    private $studentModel;

    public function __construct() {
        $this->studentModel = new Student(require BASE_PATH1 . '/app/config/database.php');
    }

    // Wyświetla oceny wskazanego ucznia
    public function displayGrades() {
        //require_once BASE_PATH1 . '/app/views/layouts/admin/showGrades.php';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          $username = htmlspecialchars(trim($_SESSION['username']));
  
            $result = $this->studentModel->showGrades($username);
        
            echo "<br><hr><table class=\"styled-table\">";
            echo "<tr><th>Imię</th><th>Przedmiot</th><th>Ocena</th><th>Wystawiono</th><th>Zmodyfikowano</th></tr>";
        
            // Wyświetlanie wyników w tabeli
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["Imię"] . "</td><td>" . $row["Przedmiot"] . "</td><td>" . $row["Ocena"] . "</td><td>" . $row["Wystawiono"] . "</td><td>" . $row["Zmodyfikowano"] . "</td></tr>";
            } echo "</table><hr>";
        }
    }

}

?>

