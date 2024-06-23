<?php

class Student{
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

public function showGrades($username){
    try{
      $user_id = array_values($this->findUserIdByUsername($username))[0];
      $stmt = $this->db->prepare("SELECT users.firstname AS Imię, subjects.name AS Przedmiot, grades.grade AS Ocena, grades.created_at AS Wystawiono, grades.updated_at AS Zmodyfikowano FROM grades JOIN students ON grades.student_id = students.id
        JOIN users ON students.user_id = users.id
        JOIN subjects ON grades.subject_id = subjects.id WHERE users.id=(?);");
      $stmt->bind_param("i", $user_id);
      $stmt->execute();
      return $stmt->get_result();
    }catch(Exception $e) {
      die("Błąd: " . $e->getMessage());
    }
  }

}
?>