<?php
require("../../connection.php");
$username  = (strlen($_POST['username']) <= 50) ? $_POST['username'] : null ;
$fn = (strlen($_POST['first_name']) <= 50) ? $_POST['first_name'] : null;
$mn  = (strlen($_POST['middle_name']) <= 50) ? $_POST['middle_name'] : null;
$ln  = (strlen($_POST['last_name']) <= 50) ? $_POST['last_name'] : null;
$branch  = intval($_POST['branchName']);
$email  = (strlen($_POST['email']) <= 50) ? $_POST['email'] : null;
$num  = (strlen($_POST['contact_num']) <= 11) ? $_POST['contact_num'] : null;
$bday  = $_POST['bday'];
$pass = "123";

if(isset($_POST['password'])){
    $pass = $_POST['password'];
}

/* validate whether user has entered all values. */

if(!$username || !$fn || !$mn || !$ln || !$email || !$num || !$bday || !$branch || !$pass || $branch < 0){

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
