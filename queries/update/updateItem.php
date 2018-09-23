<?php
require("../../connection.php");
$id = $_POST['id'];
$name  = $_POST['name'];
$price  = $_POST['price'];
$qty  = $_POST['qty'];

if(!$id){
  $result = 2;
}else{
    //Insert Item
    $sql    = "UPDATE `item` 
    SET `name` = ?,
    `price` = ?,
    `qty` = ?
    WHERE `item_id` = ?";
    
    $stmt   = $conn->prepare($sql);
    $stmt->bind_param('ssss', $name, $price, $qty, $id);

    if($stmt->execute()){
        //Insert Item Log
        $sql2    = "INSERT into `item_log` (`log_action`, `log_description`, `item_id`, `employee_id`) values (?, ?, ?, ?)  ";
  
        $stmt2   = $conn->prepare($sql2);
  
        $action = 'Update';
        $employee_id = 1; //Session value//
        $desc = 'Item was manually updated';

        $stmt2->bind_param('ssss', $action, $desc, $id, $employee_id);
        if($stmt2->execute()){
            $result = 1;
        }
      }
}

echo $result;

$conn->close();
?>
