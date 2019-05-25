<?php
require("../../connection.php");

$email = $_POST["email"];
$password = $_POST["password"];

if(!$email || !$password){
    $result = 2;
}else{
    $sql = $conn->query("SELECT * FROM `employee` `e` WHERE e.email = '$email' ");

    if($sql->num_rows > 0){
        $employee = $sql->fetch_assoc();

        if(password_verify($password, $employee['pass'])){
            $result = 1;
            session_start();
            $_SESSION["user_id"] = $employee['employee_id'];
            $_SESSION["user_fn"] = $employee['first_name'];
            $_SESSION["user_mn"] = $employee['middle_name'];
            $_SESSION["user_ln"] = $employee['last_name'];
            $_SESSION["email"] = $employee['email'];
            $_SESSION["isAdmin"] = $employee['isAdmin'];
        }else{
            $result = "password incorrect";
        }
    }else{
        $result = "user does not exist";
    }
}

echo $result;
?>
