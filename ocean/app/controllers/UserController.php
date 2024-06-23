<?php
  session_start();
  define('BASE_PATH2', realpath(dirname(__FILE__).'/../..'));
  require_once BASE_PATH2 . '/app/models/User.php';

  class UserController {
    private $userModel;

    public function __construct() {
      $this->userModel = new User(require BASE_PATH2 . '/app/config/database.php');
    }

    // Obsługuje rejestrację - przekierowuje do strony rejestracji i sprawdza podane dane, po czym wywołuje funkcję z modelu
    public function register() {
      $errors = [];
      $data = [];
      require_once BASE_PATH2 . '/app/views/register.php';
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $data['username'] = htmlspecialchars(trim($_POST['username']));
        $data['password'] = htmlspecialchars(trim($_POST['password']));
        $data['email'] = htmlspecialchars(trim($_POST['email']));
        $data['firstname'] = htmlspecialchars(trim($_POST['firstname']));
        $data['lastname'] = htmlspecialchars(trim($_POST['lastname']));
        $data['dateofbirth'] = htmlspecialchars(trim($_POST['dateofbirth']));

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

        if (empty($data['dateofbirth']) || !$this->validateDateOfBirth($data['dateofbirth'])) {
          $errors['dateofbirth'] = "Data urodzenia jest nieprawidłowa lub przyszła";
          echo "<script>alert('Data urodzenia jest nieprawidłowa lub przyszła');</script>";
      }


        if ($this->userModel->userExistUsername($data['username'])) {
          $errors['userexists'] = "Użytkownik o podanej nazwie lub emailu już istnieje";
          echo "<script>alert('Użytkownik o podanej nazwie użytkownika lub emailu już istnieje');</script>";
      }

      if ($this->userModel->userEmailExist($data['email'])) {
        $errors['userexists'] = "Użytkownik o podanej nazwie lub emailu już istnieje";
        echo "<script>alert('Użytkownik o podanej nazwie użytkownika lub emailu już istnieje');</script>";
    }

        if (empty($errors)) {
          $this->userModel->create($data['username'], $data['password'], $data['email'], $data['firstname'], $data['lastname'], $data['dateofbirth']);
          echo "<script>          
          alert('Rejestracja przebiegła pomyślnie. Zostaniesz przekierowany do strony logowania');          
          window.location.href = './login';  
          </script>";
          //header('location: ./login');
        }
      }
    }

    // Obsługuje logowanie - przekierowuje do strony logowania i sprawdza podane dane, po czym wywołuje funkcję z modelu
    public function login() {
      $errors = [];
      $data = [];
      require_once BASE_PATH2 . '/app/views/login.php';
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data['email'] = htmlspecialchars(trim($_POST['email']));
        $data['password'] = htmlspecialchars(trim($_POST['password']));

        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
          $errors['email'] = "Email jest nieprawidłowy";
        }                
        if (empty($data['password'])) {
          $errors['password'] = "Hasło nie spełnia wymagań";
        }
        if (empty($errors)) {
          $this->userModel->login($data['email'], $data['password']);
        } else {
        echo "<script>history.back();</script>";
        }
      }
    }

    // Działa, potrzebne w index.php do przekierowań
    public function homepage() {
      if (isset($_POST['login'])) {
        header('location: ./login');
      } else if (isset($_POST['register'])) {
        header('location: ./register');
      }
      require_once BASE_PATH2 . '/app/views/homepage.php';
    }

    // Działa, potrzebne do header.php do przycisku powrotu do strony głównej
    public function home(){
      if(isset($_POST['btn_mainPage'])){
        // sztywny adres, można poprawić
        header('location: /ocean/app/views/home.php');
      }
    }

    // Jak nazwa wskazuje, wykorzystywane w header.php
    public function logOut(){
      $_SESSION = [];
      session_destroy();
      header('location: /ocean/');
    }
    // Sprawdza czy user istnieje, przyjmuje jego username. Wykorzystuje userExist z modelu user
    public function userExist($userToCheck){
      if($this->userModel->userExist($userToCheck)){
        return true;
      }else{
        return false;
      };
    }

    // Sprawdza czy user istnieje, przyjmuje jego username. Wykorzystuje userExist z modelu user
    public function userEmailExist($userToCheck){
      if($this->userModel->userEmailExist($userToCheck)){
        return true;
      }else{
        return false;
      };
    }

    private function validateDateOfBirth($date) {
      $dateOfBirth = DateTime::createFromFormat('Y-m-d', $date);
      $currentDate = new DateTime();
  
      // Sprawdź, czy data jest poprawna i nie jest datą przyszłą
      return $dateOfBirth && $dateOfBirth <= $currentDate;
  }

  }
?>