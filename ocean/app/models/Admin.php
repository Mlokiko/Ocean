<?php
  class Admin
  {
    private $db;

    public function __construct($dbConfig){
      try {
        $this->db = new mysqli($dbConfig['host'], $dbConfig['username'], $dbConfig['password'], $dbConfig['db_name']);
      } catch(Exception $e) {
        die("Błędne połączenie z bazą danych: " . $e->getMessage());
      }
    }

    // Działa, potrzebne do wyświetlania tabeli wszystkich userów
    public function getUsers(){
      $stmt = $this->db->prepare("SELECT u.username, u.role, u.firstname, u.lastname, u.dateOfBirth, u.created_at, u.updated_at FROM users u;");
      $stmt->execute();
      $result = $stmt->get_result();
      return $result;
    }

    // Działa, potrzebne do wyświetlania tabeli userów o zadanej roli
    public function getUsersWithRole($role){
      $stmt = $this->db->prepare("SELECT u.username, u.role, u.firstname, u.lastname, u.dateOfBirth, u.created_at, u.updated_at FROM users u WHERE u.role = ? ;");
      $stmt->bind_param("s", $role);
      $stmt->execute();
      $result = $stmt->get_result();
      return $result;
    }
    // Wciąż robie
    public function getAllStudentsFromClass($class){
      $stmt = $this->db->prepare("SELECT u.username, u.firstname, u.lastname, classes.name, u.dateOfBirth, u.created_at, u.updated_at 
      FROM users u 
      JOIN students ON u.id = students.user_id 
      JOIN classes ON students.class_id = classes.id
      WHERE classes.id = ? ;");
      $stmt->bind_param("i", $class);
      $stmt->execute();
      $result = $stmt->get_result();
      return $result;
    }
    
    //nie wiadomo czy działa, nie używane nigdzie
    //zwraca imiona, nazwiska i przedmioty wszystkich nauczycieli
    // public function getTeachers(){
    //   $stmt = $this->db->prepare("SELECT u.firstname, u.lastname, s.name FROM teachers t JOIN users u ON t.user_id=u.id JOIN subjects s ON s.id=t.subject_id ;");
    //   $stmt->execute();
    //   $result = $stmt->get_result();
    //   $table = $result->fetch_assoc();
    //   return $table;
    // }

    //nie wiadomo czy działa, nie używanie nigdzie
    //zwraca imiona, nazwiska i klasę wszystkich uczniów
    // public function getStudents(){
    //   $stmt = $this->db->prepare("SELECT u.firstname, u.lastname, c.name FROM students s JOIN users u ON s.user_id=u.id JOIN classes c ON c.id=s.class_id ;");
    //   $stmt->execute();
    //   $result = $stmt->get_result();
    //   $table = $result->fetch_assoc();
    //   return $table;
    // }

    //nie wiadomo czy działa, nie używane nigdzie
    //zwraca imię, nazwisko, date urodzenia, nazwę, 
    public function getUser($username){
      $stmt = $this->db->prepare("SELECT u.username, u.role, u.firstname, u.lastname, u.dateOfBirth, u.created_at, u.updated_at FROM users u WHERE u.username=?;");
      $stmt->bind_param("s", $username);
      $stmt->execute();
      return $stmt->get_result();
      // $table = $result->fetch_assoc();
      // if(empty($table)){
      //   echo 
      //   '<script>
      //     alert("Brak takiego użytkownika w bazie");
      //   </script>';
      //   die();
      // }
      // else {
      //   return $;
      // }
      
    }

    //działa
    public function findUserIdByUsername($username){
      $stmt = $this->db->prepare("SELECT id from users where username=?");
      $stmt->bind_param("s", $username);
      $stmt->execute();
      $result=$stmt->get_result();
      return $result->fetch_assoc();
    }

    //działa
    //jeśli przedmioty są pobierane przy pomocy getSubjects to nie jest potrzebne
    public function findSubjectIdByName($name){
      $stmt = $this->db->prepare("SELECT id FROM subjects WHERE name=?");
      $stmt->bind_param("s", $name);
      $stmt->execute();
      $result=$stmt->get_result();
      return $result->fetch_assoc();
    }

    //działa
    public function addRole($username, $role){
      $id = array_values($this->findUserIdByUsername($username))[0];
      $stmt = $this->db->prepare("UPDATE users SET role=? WHERE users.id=?;");
      $stmt->bind_param("si", $role, $id);
      $stmt->execute();
      echo "<script>alert('Nadano użytkownikowi rolę');</script>";
      return $stmt->get_result();
    }

    //działa
    public function addTeacherRole($username, $subject){
      $user_id = array_values($this->findUserIdByUsername($username))[0];
      $stmt = $this->db->prepare("INSERT INTO teachers (user_id, subject_id) VALUES (?, ?);");
      $stmt->bind_param("ii", $user_id, $subject);
      $stmt->execute();
      echo "<script>alert('Nadano nauczycielowi przedmiot');</script>";
      return $stmt->get_result();
    }
    // Nie wykorzystywane, a trzeba by zacząć
    public function addAdminRole($username){
      try{
        $user_id = array_values($this->findUserIdByUsername($username))[0];
        $stmt = $this->db->prepare("INSERT INTO admins (user_id) VALUES (?);");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        return $stmt->get_result();
      }catch(Exception $e) {
        die("Błąd: " . $e->getMessage());
      }
    }

    //działa
    public function addStudentRole($username, $class){
      try{
        $user_id = array_values($this->findUserIdByUsername($username))[0];
        $stmt = $this->db->prepare("INSERT INTO students (user_id, class_id) VALUES (?, ?);");
        $stmt->bind_param("ii", $user_id, $class);
        $stmt->execute();
        echo "<script>alert('Nadano Uczniowi klasę');</script>";
        return $stmt->get_result();
      }catch(Exception $e) {
        die("Błąd: " . $e->getMessage());
      }
    }
  
    // Nigdzie nie wykorzystywane???
    public function changeClass($username, $new_class){
      $user_id = array_values($this->findUserIdByUsername($username))[0];
      $stmt = $this->db->prepare("UPDATE students SET class_id=? WHERE users.id=?;");
      $stmt->bind_param("ii", $new_class, $user_id);
      $stmt->execute();
      return $stmt->get_result();
    }

    // Działa
    public function remove($username){
      $id = array_values($this->findUserIdByUsername($username))[0];
      $stmt = $this->db->prepare("DELETE FROM users WHERE users.id=?;");
      $stmt->bind_param("i", $id);
      $stmt->execute();
      echo "<script>alert('Usunięto użytkownika');</script>";
      return $stmt->get_result();
    }

    // Działa
    public function create_with_role($username, $password, $email, $firstname, $lastname, $dateofbirth, $role){
      try{
        $hashedPassword = password_hash($password, PASSWORD_ARGON2ID);
      $stmt = $this->db->prepare("INSERT INTO users (username, email, password, firstname, lastname, dateofbirth, role) VALUES (?, ?, ?, ?, ?, ?, ?)");
      $stmt->bind_param("sssssss", $username, $email, $hashedPassword, $firstname, $lastname, $dateofbirth, $role);
      $result = $stmt->execute();
      $stmt->close();
      return $result;
      }catch(Exception $e) {
        die("Błąd: " . $e->getMessage());
      }
    }
    // Działa
    public function showGrades($username){
      try{
        $user_id = array_values($this->findUserIdByUsername($username))[0];
        $stmt = $this->db->prepare("SELECT users.username AS username, users.firstname AS Imię, users.lastname AS Nazwisko, classes.name AS Klasa, subjects.name AS Przedmiot, grades.grade AS Ocena, grades.created_at AS Wystawiono, grades.updated_at AS Zmodyfikowano 
          FROM grades 
          JOIN students ON grades.student_id = students.id
          JOIN classes ON classes.id = students.class_id 
          JOIN users ON students.user_id = users.id
          JOIN subjects ON grades.subject_id = subjects.id 
          WHERE users.id=(?);");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        return $stmt->get_result();
      }catch(Exception $e) {
        die("Błąd: " . $e->getMessage());
      }
    }
  }
?>