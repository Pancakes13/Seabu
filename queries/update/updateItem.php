<?php
require("../../connection.php");
session_start();
$id = $_POST['id'];
$name  = $_POST['name'];
$price  = $_POST['price'];

if(!$id || !$name || is_null($price)){
  $result = 2;
}else{
    //Update Item
    $sql    = "UPDATE `item` 
    SET `name` = ?,
    `price` = ?
    WHERE `item_id` = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $name, $price, $id);

    if($stmt->execute()){
        //Insert Item Log
        $sql2    = "INSERT into `item_log` (`log_action`, `log_description`, `employee_id`, `item_id`) values (?, ?, ?, ?)  ";
  
        $stmt2   = $conn->prepare($sql2);
  
        $action = 'Update';
        $employee_id = $_SESSION["user_id"];
        $desc = 'Item was manually updated';

        $stmt2->bind_param('ssss', $action, $desc, $employee_id, $id);
        if($stmt2->execute()){
            $result = 1;
        }
      }
}

echo $result;

$conn->close();
?>
