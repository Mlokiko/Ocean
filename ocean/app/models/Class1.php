<?php
    class Class_1 {
        private $db;

        public function __construct($dbConfig){
            try {
                $this->db = new mysqli($dbConfig['host'], $dbConfig['username'], $dbConfig['password'], $dbConfig['db_name']);
            } catch(Exception $e) {
                die("Błędne połączenie z bazą danych: " . $e->getMessage());
            }
        }

        public function getClasses() {
            $stmt = $this->db->prepare("SELECT DISTINCT id, name FROM classes ORDER BY name ASC");
            $stmt->execute();
            return $stmt->get_result();
        }
        // Wciąż robie - ALE CZY TO POTRZEBNE, ADMIN MA CHYBA IDENTYCZNA FUNKCJE
        public function getStudentsFromClass(){
            $stmt = $this->db->prepare("SELECT users.username, users.firstname, users.lastname, classes.name, users.dateofbirth 
            FROM users 
            NATURAL JOIN students ON users.id = students.user_id 
            NATURAL JOIN classes ON students.class_id = classes.id 
            WHERE classes.id = 1;");
            $stmt->execute();
            return $stmt->get_result();
        }
    }
?>