<?php
    error_reporting(E_ALL & ~E_NOTICE); // co z oczu to z serca :)
    session_start();
    require_once(realpath(dirname(__FILE__).'/..').'\views\header.php');
?> 
<?php 
require_once "./layouts/$_SESSION[role]/content.php";

if ($_SESSION['role'] === 'admin') {
    require_once (realpath(dirname(__FILE__).'/..').'\controllers\AdminController.php'); 
    if(isset($_POST['addRoleTeacher'])){
        header('location: ./layouts/admin/addTeacher.php');
    }
    else if(isset($_POST['getAllUsers'])){
        header('location: ./layouts/admin/getAllUsers.php');
    }
    else if(isset($_POST['addRoleStudent'])){
        header('location: ./layouts/admin/addStudent.php');
    }
    else if(isset($_POST['remove'])){
        header('location: ./layouts/admin/removeUser.php');
    }
    else if(isset($_POST['create'])){
        header('location: ./layouts/admin/createUser.php');
    }
    else if(isset($_POST['showGrades'])){
        header('location: ./layouts/admin/showGrades.php');
    }
    else if(isset($_POST['addRole'])){
        header('location: ./layouts/admin/addRole.php');
    }
    else if(isset($_POST['showOnlyUsers'])){
        header('location: ./layouts/admin/showOnlyUsers.php');
    }
    else if(isset($_POST['showAllTeachers'])){
        header('location: ./layouts/admin/showAllTeachers.php');
    }
    else if(isset($_POST['showAllStudents'])){
        header('location: ./layouts/admin/showAllStudents.php');
    }
    else if(isset($_POST['showClassMembers'])){
        header('location: ./layouts/admin/showClassMembers.php');
    }
}
if ($_SESSION['role'] === 'student') {
    require_once (realpath(dirname(__FILE__).'/..').'\controllers\StudentController.php');
}
if ($_SESSION['role'] === 'teacher') {
    require_once (realpath(dirname(__FILE__).'/..').'\controllers\TeacherController.php');

    if(isset($_POST['showGrades'])){
        header('location: ./layouts/teacher/showGrades.php');
    }
    else if(isset($_POST['writeGrade'])){
        header('location: ./layouts/teacher/writeGrade.php');
    }
    else if(isset($_POST['modifyGrade'])){
        header('location: ./layouts/teacher/modifyGrade.php');
    }
    else if(isset($_POST['showClassMembers'])){
        header('location: ./layouts/teacher/showClassMembers.php');
    }
}
?>
</html>