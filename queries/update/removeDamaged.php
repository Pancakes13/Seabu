<?php
require("../../connection.php");
session_start();
$qty  = $_POST['qty'];

if(!$qty){
  $result = 2;
}else{
    //Insert Item
    $sql    = "UPDATE `item` 
    SET `qty` = $qty
    WHERE `item_id` = ?";

    $stmt   = $conn->prepare($sql);
    $stmt->bind_param('s', $id);
    
    if($stmt->execute()){
        //Insert Item Log
        $sql2    = "INSERT into `item_log` (`log_action`, `log_description`, `item_id`, `employee_id`) values (?, ?, ?)  ";
  
        $stmt2   = $conn->prepare($sql2);
  
        $action = 'Update';
        $item_id = 1; //Latest inserted item id//
        $employee_id = $_SESSION["user_id"];
        $desc = 'Item was removed due to damages';
        $stmt2->bind_param('ssss', $action, $desc, $item_id, $employee_id);
        if($stmt2->execute()){
            $result = 1;
        }
      }
}

echo $result;

$conn->close();
?>
