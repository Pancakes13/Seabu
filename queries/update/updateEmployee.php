<?php
require("../../connection.php");
session_start();
$id = $_POST['id'];
$fn  = $_POST['first_name'];
$mn  = $_POST['middle_name'];
$ln  = $_POST['last_name'];
$branch  = $_POST['branch'];
$email  = $_POST['email'];
$num  = $_POST['num'];
$birthdate  = $_POST['birthdate'];

if(!$id || !$fn || !$mn || !$ln || !$email || !$num || !$birthdate || !$branch){
  $result = 2;
}else{
    //Insert Item
    $sql    = "UPDATE `employee` 
    SET `first_name` = ?,
    `middle_name` = ?,
    `last_name` = ?,
    `branch_id` = ?,
    `email` = ?,
    `contact_no` = ?,
    `birthdate` = ?
    WHERE `employee_id` = ?";
    
    $stmt   = $conn->prepare($sql);
    $stmt->bind_param('ssssssss', $fn, $mn, $ln, $branch, $email, $num, $birthdate, $id);

    if($stmt->execute()){
        //Insert Item Log
        $sql2    = "INSERT into `employee_log` (`action`, `log_description`, `employee_id`, `performed_by`) values (?, ?, ?, ?)  ";
  
        $stmt2   = $conn->prepare($sql2);
  
        $action = 'Update';
        $employee_id = $_SESSION["user_id"];
        $desc = 'Employee was manually updated';

        $stmt2->bind_param('ssss', $action, $desc, $id, $employee_id);
        if($stmt2->execute()){
            $result = 1;
        }
      }
}

echo $result;

$conn->close();
?>
