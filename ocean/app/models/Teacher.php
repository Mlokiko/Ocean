<?php
 //session_start();
  class Teacher
  {
    private $db;
    public function __construct($dbConfig){
      try {
        $this->db = new mysqli($dbConfig['host'], $dbConfig['username'], $dbConfig['password'], $dbConfig['db_name']);
      } catch(Exception $e) {
        die("Błędne połączenie z bazą danych: " . $e->getMessage());
      }
    }
    //działa
    public function findUserIdByUsername($username){
      $stmt = $this->db->prepare("SELECT id from users where username=?");
      $stmt->bind_param("s", $username);
      $stmt->execute();
      $result=$stmt->get_result();
      return $result->fetch_assoc();
    }

    public function writeGrade($username, $grade, $subject){
      try{

        $stmt = $this->db->prepare("SELECT id FROM subjects WHERE name=?;");
        $stmt->bind_param("s", $subject);
        $stmt->execute();
        $result = $stmt->get_result();
        $subject_id = $result->fetch_assoc()['id'];

        if(!$subject_id){
          throw new Exception("Nie znaleziono podanego przedmiotu");
        }

        $teacher_user_id = array_values($this->findUserIdByUsername($_SESSION['username']))[0];

        $stmt2 = $this->db->prepare("SELECT id FROM teachers WHERE user_id=? AND subject_id=?;");
        $stmt2->bind_param("ii", $teacher_user_id, $subject_id);
        $stmt2->execute();
        $result2 = $stmt2->get_result();
        $teacher_id = $result2->fetch_assoc()['id'];

        if(!$subject_id){
          throw new Exception("Nie znaleziono nauczyciela");
        }

        $student_user_id = array_values($this->findUserIdByUsername($username))[0];

        $stmt = $this->db->prepare("SELECT id FROM students WHERE user_id=?;");
        $stmt->bind_param("s", $student_user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $student_id = $result->fetch_assoc()['id'];

        $stmt4 = $this->db->prepare("INSERT INTO grades (grade, subject_id, student_id, teacher_id) VALUES(?,?,?,?);");
        $stmt4->bind_param("iiii", $grade, $subject_id, $student_id, $teacher_id );
        $stmt4->execute();
        echo "<script>alert('Wystawiono ocenę');</script>";
        return $stmt4->get_result();
      } catch(Exception $e) {
          die("Błąd: " . $e->getMessage());
        }
    }

    public function modifyGrade($username, $grade, $date){
      $student_user_id = array_values($this->findUserIdByUsername($username))[0];

      $stmt = $this->db->prepare("SELECT id FROM students WHERE user_id=?;");
      $stmt->bind_param("i", $student_user_id);
      $stmt->execute(); 
      $result = $stmt->get_result();
      $student_id = $result->fetch_assoc()['id'];

      $stmt2 = $this->db->prepare("UPDATE grades SET grade = ? WHERE student_id = ? AND created_at = ?;");
      $stmt2->bind_param("iis", $grade, $student_id, $date);
      $stmt2->execute(); 
      echo "<script>alert('Zmodyfikowano ocenę');</script>";
    }

    public function getTeacherSubjects() {

      $teacher_user_id = array_values($this->findUserIdByUsername($_SESSION['username']))[0];

      $stmt = $this->db->prepare("SELECT user_id FROM teachers WHERE user_id=?;");
      $stmt->bind_param("i", $teacher_user_id);
      $stmt->execute();
      $result = $stmt->get_result();
      $teacher_id = $result->fetch_assoc()['user_id'];

      $stmt2 = $this->db->prepare("SELECT subjects.name FROM teachers JOIN subjects ON teachers.subject_id = subjects.id WHERE teachers.user_id = ?;");
      $stmt2->bind_param("i", $teacher_id);
      $stmt2->execute();
      // return $stmt2->get_result();
      return $stmt2->get_result();
  }
}
?>