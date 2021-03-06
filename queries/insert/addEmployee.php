<?php
require("../../connection.php");
session_start();
$fn = (strlen($_POST['first_name']) <= 50) ? $_POST['first_name'] : null;
$mn  = (strlen($_POST['middle_name']) <= 50) ? $_POST['middle_name'] : null;
$ln  = (strlen($_POST['last_name']) <= 50) ? $_POST['last_name'] : null;
$branch  = ((int)$_POST['branchName']) ? $_POST['branchName'] : null;
$email  = (strlen($_POST['email']) <= 50) ? $_POST['email'] : null;
$num  = (strlen($_POST['contact_num']) <= 11) ? $_POST['contact_num'] : null;
$bday  = $_POST['bday'];
$pass = "123";

if(isset($_POST['password'])){
    $pass = $_POST['password'];
}

/* validate whether user has entered all values. */

if(!$fn || !$ln || !$email || !$num || !$bday || !$branch || !$pass || $branch < 0){

  $result = 2;

}else{
    //check if employee exists, if true, then error: email already exists
    $checkIfUserExists = $conn->query("SELECT * FROM `employee` `e` WHERE e.email = '$email' AND e.isDeleted = 0 ");

    if($checkIfUserExists->num_rows > 0){
        $result = "email already exists";
    }else{
        //hash password using password_hash()
        $passwordHash = password_hash($pass, PASSWORD_DEFAULT);

        if($passwordHash == false){
            echo "password hash failed";
        }
        try{
            $conn->autocommit(false);
            //Insert Item
            $sql    = "INSERT into `employee` (`first_name`, `middle_name`, `last_name`, `branch_id`, `pass`, `email`, `contact_no`, `birthdate`) values (?, ?, ?, ?, ?, ?, ?, ?)  ";

            $stmt   = $conn->prepare($sql);
            $stmt->bind_param('ssssssss', $fn, $mn, $ln, $branch, $passwordHash, $email, $num, $bday);
            $stmt->execute();

                    //Insert Item Log
            $empId = $conn->insert_id;
            $pId = $_SESSION["user_id"];
            $sql2    = "INSERT into `employee_log` (`action`, `log_description`, `employee_id`, `performed_by`) values (?, ?, ?, ?)  ";
        
            $stmt2   = $conn->prepare($sql2);

            $action = 'Create';
            $desc = 'Employee was Created';

            $stmt2->bind_param('ssss', $action, $desc, $empId, $pId);
            $stmt2->execute();

            $result = 1;
            $conn->commit();
            $conn->autocommit(true);
        }
        catch(Exception $ex){
            echo "Error on inserting employee: " . $ex->getMessage(); 
        }
    }
}

echo $result;

$conn->close();
?>
