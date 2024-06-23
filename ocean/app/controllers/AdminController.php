<?php
  define('BASE_PATH1', realpath(dirname(__FILE__).'/../..'));
  require_once BASE_PATH1 . '/app/models/Admin.php';
  require_once BASE_PATH1 . '/app/models/Subject.php';
  require_once BASE_PATH1 . '/app/models/Class1.php';

  class AdminController{
    private $adminModel;

    public function __construct() {
      $this->adminModel = new Admin(require BASE_PATH1 . '/app/config/database.php');
    }

    public function findUserIdByUsername($username){
      $id=$this->adminModel->findUserIdByUsername($username);
      print_r($this->adminModel->findUserIdByUsername($username));
    }

    // Działa
    public function addRole(){
      if($_SERVER['REQUEST_METHOD']==='POST'){
        $role = htmlspecialchars(trim($_POST['role']));
        $username = htmlspecialchars(trim($_POST['username']));

        require_once BASE_PATH1 . '/app/controllers/UserController.php';
        $userController = new UserController();
        if(($userController->userExist($username)) == true){
          $this->adminModel->addRole($username, $role);
        }
      }
    }
  
    // Działa, potrzebne do wyświetlania tabeli wszystkich userów 
    public function getAllUsers(){
      $data=$this->adminModel->getUsers();
      $this->displayTableOfUsers($data);
    }

    // Działa, potrzebne do wyświetlania tabeli userów o określonej roli
    public function getAllUsersWithRole($role){
      $data=$this->adminModel->getUsersWithRole($role);
      $this->displayTableOfUsers($data);
    }



    // Działa, łączy się z powyższymi
    public function displayTableOfUsers($data) {
      if($data->num_rows === 0){
        echo "<script>alert('Brak użytkowników o danej roli');</script>";
      } else{
        $result = $data;
        echo "<br><hr><table class=\"styled-table\">";
        echo "<tr><th>Nazwa użytkownika</th><th>Rola</th><th>Imię</th><th>Nazwisko</th><th>Data urodzenia</th><th>Data utworzenia</th><th>Data aktualizacji</th></tr>";
        // Wyświetlanie wyników w tabeli
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["username"] . "</td><td>" . $row["role"] . "</td><td>" . $row["firstname"] . "</td><td>" . $row["lastname"] . "</td><td>" . $row["dateOfBirth"] . "</td><td>" . $row["created_at"] . "</td><td>" . $row["updated_at"] . "</td></tr>";
        } echo "</table><hr>";
      }
    }

    // Wciąż robie
    public function getAllStudentsFromClass(){
      if($_SERVER['REQUEST_METHOD']=='POST'){
        $class = htmlspecialchars(trim($_POST['class']));
        $data=$this->adminModel->getAllStudentsFromClass($class);
        $this->displayTableOfStudents($data);
      }
    }

    // Wciąż robie
    public function displayTableOfStudents($data) {
      if($data->num_rows === 0){
        echo "<script>alert('Brak uczniów w podanej klasie');</script>";
      } else{
        $result = $data;
        echo "<br><hr><table class=\"styled-table\">";
        echo "<tr><th>Nazwa użytkownika</th><th>Imię</th><th>Nazwisko</th><th>Klasa</th><th>Data urodzenia</th></tr>";
        // Wyświetlanie wyników w tabeli
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["username"] . "</td><td>" . $row["firstname"] . "</td><td>" . $row["lastname"] . "</td><td>" . $row["name"] . "</td><td>" . $row["dateOfBirth"] . "</td></tr>";
        } echo "</table><hr>";
      }
    }

    // Działa, nadaje wskazanemu userowi role teacher (jeżeli takiej jeszcze nie miał - zamienia poprzednią rolę) po czym tworzy wpis w tabeli teachers z jego id i wskazanym przedmiotem
    public function addTeacher(){
      if($_SERVER['REQUEST_METHOD']=='POST'){
        $role = 'teacher';
        $username = htmlspecialchars(trim($_POST['username']));
        $subject = htmlspecialchars(trim($_POST['subject']));
        require_once BASE_PATH1 . '/app/controllers/UserController.php';
        $userController = new UserController();
        if(($userController->userExist($username)) == true){
          $this->adminModel->addRole($username, $role);
          $this->adminModel->addTeacherRole($username, $subject);
        }
      }
    }

    // Działa, podobnie jak wyżej, nadaje role i tworzy wpis w tabeli students
    public function addStudent(){
      if($_SERVER['REQUEST_METHOD']==='POST'){
        $role = 'student';
        $username = htmlspecialchars(trim($_POST['username']));
        $class = htmlspecialchars(trim($_POST['class']));
        require_once BASE_PATH1 . '/app/controllers/UserController.php';
        $userController = new UserController();
        if(($userController->userExist($username)) == true){
          $this->adminModel->addRole($username, $role);
          $this->adminModel->addStudentRole($username, $class);
        }
      }
    }

    // Działa, usuwa użytkownika z bazy danych
    public function remove(){
      if($_SERVER['REQUEST_METHOD']==='POST'){
        $username= htmlspecialchars(trim($_POST['username']));

        require_once BASE_PATH1 . '/app/controllers/UserController.php';
        $userController = new UserController();
        if(($userController->userExist($username)) == true){
          $this->adminModel->remove($username);
        }
      }
    }


    // Działa, ekran tworzenia usera z poziomu panelu admina
    public function create_with_role(){
      $errors = [];
      $data = [];

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $data['username'] = htmlspecialchars(trim($_POST['username']));
        $data['password'] = htmlspecialchars(trim($_POST['password']));
        $data['email'] = htmlspecialchars(trim($_POST['email']));
        $data['firstname'] = htmlspecialchars(trim($_POST['firstname']));
        $data['lastname'] = htmlspecialchars(trim($_POST['lastname']));
        $data['dateofbirth'] = htmlspecialchars(trim($_POST['dateofbirth']));
        $data['role'] = htmlspecialchars(trim($_POST['role']));

        if (empty($data['username']) || !preg_match('/^[a-zA-Z0-9_]{5,}$/', $data['username'])) {
          $errors['username'] = "Nazwa użytkownika jest nieprawidłowa";
          echo "<script>          
          alert('Nazwa użytkownika jest nieprawidłowa');        
          </script>";
        }

        if (empty($data['password']) || strlen($data['password']) < 8) {
          $errors['password'] = "Hasło nie spełnia wymagań";
          echo "<script>          
          alert('Hasło nie spełnia wymagań'); 
          </script>";
        }

        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
          $errors['email'] = "Email jest nieprawidłowy";
          echo "<script>          
          alert('Email jest nieprawidłowy');            
          </script>";
        }

        if (empty($data['firstname']) || !preg_match('/^[a-zA-Z]{3,}$/', $data['firstname'])) {
          $errors['firstname'] = "Imię nie spełnia wymagań";
          echo "<script>          
          alert('Imię nie spełnia wymagań');          
          </script>";
        }

        if (empty($data['lastname']) || !preg_match('/^[a-zA-Z]{2,}$/', $data['lastname'])) {
          $errors['lastname'] = "Nazwisko nie spełnia wymagań";
          echo "<script>          
          alert('Nazwisko nie spełnia wymagań');           
          </script>";
        }

        if (empty($errors)) {
          
          echo "<script>          
          alert('Pomyślnie utworzono użytkownika');            
          </script>";
          $this->adminModel->create_with_role($data['username'], $data['password'], $data['email'], $data['firstname'], $data['lastname'], $data['dateofbirth'], $data['role']);
        } 
      }
    }

    // Działa, potrzebne do panelu nadawania przedmiotu nauczycielowi
    public function getSubjects(){
      $subjectModel = new Subject(require BASE_PATH1 . '/app/config/database.php');
      $subjects = [];
      $result = $subjectModel->getSubjects();
      if($result){
        while($row = $result->fetch_assoc()){
          $subjects[]=$row;
        }
      }
      return $subjects;
    }

    // Działa (dzialać zaraz będzie), potrzebne do panelu ShowClassMembers
    public function getClasses(){
      $classModel = new Class_1(require BASE_PATH1 . '/app/config/database.php');
      $classes = [];
      $result = $classModel->getClasses();
      if($result){
        while($row = $result->fetch_assoc()){
          $classes[]=$row;
        }
      }
      return $classes;
    }

    // Wyświetla oceny wskazanego ucznia
    public function displayGrades() {
      if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($_POST['grade'])) {
        $username = htmlspecialchars(trim($_POST['username']));

        require_once BASE_PATH1 . '/app/controllers/UserController.php';
        $userController = new UserController();
        if(($userController->userExist($username)) == true){
          $result = $this->adminModel->showGrades($username);
      
          echo "<br><hr><table class=\"styled-table\">";
          echo "<tr><th>Nazwa Użytkownika</th><th>Imię</th><th>Nazwisko</th><th>Klasa</th><th>Przedmiot</th><th>Ocena</th><th>Wystawiono</th><th>Zmodyfikowano</th></tr>";
          // Wyświetlanie wyników w tabeli
          while($row = $result->fetch_assoc()) {
              echo "<tr><td>" . $row["username"] . "</td><td>" . $row["Imię"] . "</td><td>" . $row["Nazwisko"] . "</td><td>" . $row["Klasa"] . "</td><td>" . $row["Przedmiot"] . "</td><td>" . $row["Ocena"] . "</td><td>" . $row["Wystawiono"] . "</td><td>" . $row["Zmodyfikowano"] . "</td></tr>";
          } echo "</table><hr>";
        }
      }
    }
  }
?>