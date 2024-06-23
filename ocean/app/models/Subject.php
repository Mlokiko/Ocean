<?php
    class Subject {
        private $db;

        public function __construct($dbConfig){
            try {
                $this->db = new mysqli($dbConfig['host'], $dbConfig['username'], $dbConfig['password'], $dbConfig['db_name']);
            } catch(Exception $e) {
                die("Błędne połączenie z bazą danych: " . $e->getMessage());
            }
        }

        public function getSubjects() {
            $stmt = $this->db->prepare("SELECT DISTINCT id, name FROM subjects ORDER BY name ASC");
            $stmt->execute();
            return $stmt->get_result();
        }
    }
?>