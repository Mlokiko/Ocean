<?php
  define('BASE_PATH3', realpath(dirname(__FILE__).'/../..'));
  require_once BASE_PATH3 . '/app/models/Teacher.php';

  class TeacherController{
    private $teacherModel;

    public function __construct() {
      $this->teacherModel = new Teacher(require BASE_PATH3 . '/app/config/database.php');
    }

    public function writeGrade() {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = htmlspecialchars(trim($_POST['username']));
        $grade = htmlspecialchars(trim($_POST['grade']));
        $subject = htmlspecialchars(trim($_POST['subject']));

        if($grade >= 0 && $grade <= 6){
          require_once BASE_PATH3 . '/app/controllers/UserController.php';
          $userController = new UserController();
          if(($userController->userExist($username)) == true){
            $result = $this->teacherModel->writeGrade($username, $grade, $subject);
          }
        } else echo "<script>alert('Podana ocena nie mieści się w zakresie 0-6');</script>";
      }
    }

    // Modyfikacja oceny, pracuje nad tym
    public function ModifyGrade(){
      if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['grade'])) {
        $username = htmlspecialchars(trim($_POST['username']));
        $grade = htmlspecialchars(trim($_POST['grade']));
        $date = htmlspecialchars(trim($_POST['date']));

        if($grade >= 0 && $grade <= 6){
          require_once BASE_PATH3 . '/app/controllers/UserController.php';
          $userController = new UserController();
          if(($userController->userExist($username)) == true){
            $result = $this->teacherModel->modifyGrade($username, $grade, $date);
          }
        } else echo "<script>alert('Podana ocena nie mieści się w zakresie 0-6');</script>";
      }
    }

    public function getTeacherSubjects(){
      $subjects = [];
      // $this->teacherModel = new Teacher(require BASE_PATH3 . '/app/config/database.php');
      $result = $this->teacherModel->getTeacherSubjects();
      if($result){
        while($row = $result->fetch_assoc()){
          $subjects[]=$row;
        }
      } else{
        echo "<script>          
          alert('Nie jesteś nauczycielem żadnego przedmiotu');        
          </script>";
      }
      return $subjects;
    }
  }
?>