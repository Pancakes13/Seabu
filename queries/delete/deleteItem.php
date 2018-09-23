<?php
require("../../connection.php");
$id  = $_POST['item_id'];

if(!$id){
  $result = 2;
}else{
    //Insert Item
    $sql    = "UPDATE `item` 
    SET `isDeleted` = 1
    WHERE `item_id` = ?";
    
    $stmt   = $conn->prepare($sql);
    $stmt->bind_param('s', $id);
    echo $id;
    if($stmt->execute()){
        $sql2    = "INSERT into `item_log` (`log_action`, `log_description`, `item_id`, `employee_id`) values (?, ?, ?, ?)  ";

        $stmt2   = $conn->prepare($sql2);
        $desc = 'Item was deleted';
        $action = 'Delete';
        $employee_id = 1; //Session value//
        $stmt2->bind_param('ssss', $action, $desc, $id, $employee_id);
        if($stmt2->execute()){
            $result = 1;
        }
    }
}

echo $result;

$conn->close();
?>
