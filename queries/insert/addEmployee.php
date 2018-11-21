<?php
require("../../connection.php");
$username  = $_POST['username'];
$fn = $_POST['first_name'];
$mn  = $_POST['middle_name'];
$ln  = $_POST['last_name'];
$branch  = $_POST['branchName'];
$email  = $_POST['email'];
$num  = $_POST['contact_num'];
$bday  = $_POST['bday'];
$pass = "123";

if(isset($_POST['password'])){
    $pass = $_POST['password'];
}else{
    $pass = '123';
}

/* validate whether user has entered all values. */

if(!$username || !$fn || !$mn || !$ln || !$email || !$num || !$bday || !$branch || !$pass){

  $result = 2;

}else{
    //check if employee exists, if true, then error: email already exists
    $checkIfUserExists = $conn->query("SELECT * FROM `employee` `e` WHERE e.email = '$email' ");

    if($checkIfUserExists->num_rows > 0){
        $result = "email already exists";
    }else{
        //hash password using password_hash()
        $passwordHash = password_hash($pass, PASSWORD_DEFAULT);

        if($passwordHash == false){
            echo "password hash failed";
        }

        //Insert Item
        $sql    = "INSERT into `employee` (`username`, `first_name`, `middle_name`, `last_name`, `branch_id`, `pass`, `email`, `contact_no`, `birthdate`) values (?, ?, ?, ?, ?, ?, ?, ?, ?)  ";

        $stmt   = $conn->prepare($sql);
        $stmt->bind_param('sssssssss', $username, $fn, $mn, $ln, $branch, $passwordHash, $email, $num, $bday);
        
        if($stmt->execute()){
                //Insert Item Log
            $empId = $conn->insert_id;
            $pId = 1; //SESSION
            $sql2    = "INSERT into `employee_log` (`action`, `log_description`, `employee_id`, `performed_by`) values (?, ?, ?, ?)  ";
        
            $stmt2   = $conn->prepare($sql2);

            $action = 'Create';
            $desc = 'Employee was Created';

            $stmt2->bind_param('ssss', $action, $desc, $empId, $pId);
            if($stmt2->execute()){
                $result = 1;
            }
        }
    }
}

echo $result;

$conn->close();
?>
