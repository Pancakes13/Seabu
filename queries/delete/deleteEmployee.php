<?php
require("../../connection.php");
$id  = $_POST['employee_id'];

if(!$id){
  $result = 2;
}else{
    //Insert Item
    try{
        $conn->autocommit(false);

        $sql    = "UPDATE `employee` 
        SET `isDeleted` = 1
        WHERE `employee_id` = ?";
        
        $stmt   = $conn->prepare($sql);
        $stmt->bind_param('s', $id);
        echo $id;
        $stmt->execute();

        $sql2    = "INSERT into `employee_log` (`action`, `log_description`, `employee_id`, `performed_by`) values (?, ?, ?, ?)  ";

        $stmt2   = $conn->prepare($sql2);
        $desc = 'Employee was deleted';
        $action = 'Delete';
        $employee_id = 1; //Session value//

        $stmt2->bind_param('ssss', $action, $desc, $id, $employee_id);
        $stmt2->execute();

        $result = 1;
        $conn->commit();
        $conn->autocommit(true);
    }
    catch(Exception $ex){
        echo "Error on deleting employee:" . $ex->getMessage();
    }
}

echo $result;

$conn->close();
?>
