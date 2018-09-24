<?php
require("../../connection.php");
$username  = $_POST['username'];
$fn = $_POST['first_name'];
$mn  = $_POST['middle_name'];
$ln  = $_POST['last_name'];
$email  = $_POST['email'];
$num  = $_POST['contact_num'];
$bday  = $_POST['bday'];
$pass = "123";

/* validate whether user has entered all values. */

if(!$username || !$fn || !$mn || !$ln || !$email || !$num || !$bday){

  $result = 2;

}else{
    //Insert Item
    $sql    = "INSERT into `employee` (`username`, `first_name`, `middle_name`, `last_name`, `pass`, `email`, `contact_no`, `birthdate`) values (?, ?, ?, ?, ?, ?, ?, ?)  ";

    $stmt   = $conn->prepare($sql);
    $stmt->bind_param('ssssssss', $username, $fn, $mn, $ln, $pass, $email, $num, $bday);
    
    if($stmt->execute()){
      //Insert Item Log
      $empId = 1; //Last inserted emp
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

echo $result;

$conn->close();
?>
