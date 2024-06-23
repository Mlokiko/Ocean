<?php
//session_start();
    class User {
        private $db;

        public function __construct($dbConfig){
            try {
                $this->db = new mysqli($dbConfig['host'], $dbConfig['username'], $dbConfig['password'], $dbConfig['db_name']);
            } catch(Exception $e) {
                die("Błędne połączenie z bazą danych: " . $e->getMessage());
            }
        }
        // Tworzy użytkownika w bazie danych, wykorzystywane przez UserController.Register();
        public function create($username, $password, $email, $firstname, $lastname, $dateofbirth){
            $hashedPassword = password_hash($password, PASSWORD_ARGON2ID);
            $stmt = $this->db->prepare("INSERT INTO users (username, email, password, firstname, lastname, dateofbirth) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $username, $email, $hashedPassword, $firstname, $lastname, $dateofbirth);
            $result = $stmt->execute();
            $stmt->close();
            return $result;
        }
        // Loguje użytkownika, wykorzystywane przez UserController.login();
        public function login($email, $password){
            $stmt = $this->db->prepare("SELECT * FROM users WHERE email=?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            
            if($user && password_verify($password, $user['password'])) {
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['username'] = $user['username'];
                header('location: ./app/views/home.php');
            }
            else {
                echo "<script>          
                alert('Błędny Email lub hasło');        
                </script>";
            }
        }
        // Sprawdza czy podany użytkownik istnieje w bazie danych, przyjmuje jego username, gdy nie istnieje taki rekord, wyświetla błąd - TYLKO JAK TO DOBRZE ZROBIĆ
        public function userExist($userToCheck){
            $stmt = $this->db->prepare("SELECT * FROM users WHERE username=?");
            $stmt->bind_param("s", $userToCheck);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();

            if(empty($user)){
                echo "<script>          
                alert('Podany użytkownik nie istnieje');        
                </script>";
                return false;
            }
            else return true;
        }

        // Sprawdza czy podany użytkownik istnieje w bazie danych, przyjmuje jego username, gdy nie istnieje taki rekord, wyświetla błąd - TYLKO JAK TO DOBRZE ZROBIĆ
        public function userExistUsername($userToCheck){
            $stmt = $this->db->prepare("SELECT * FROM users WHERE username=?");
            $stmt->bind_param("s", $userToCheck);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();

            if(empty($user)){
                return false;
            }
            else return true;
        }

        // Sprawdza czy podany użytkownik istnieje w bazie danych, przyjmuje jego username, gdy nie istnieje taki rekord, wyświetla błąd - TYLKO JAK TO DOBRZE ZROBIĆ
        public function userEmailExist($userToCheck){
            $stmt = $this->db->prepare("SELECT * FROM users WHERE email=?");
            $stmt->bind_param("s", $userToCheck);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            
            if(empty($user)){
                echo "<script>          
                alert('User o podanym emailu już istnieje');        
                </script>";
                return false;
            }
            else return true;
        }

    }
?>
