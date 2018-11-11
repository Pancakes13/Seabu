<?php
require("../../connection.php");
$item_id = $_POST['item_id'];
$stock = $_POST['current_stock'];
$qty  = $_POST['qty'];
$type = $_POST['type'];

if(!$item_id || !$qty || !$type){
  $result = 2;
}else{
    //Insert Item
    $sql    = "UPDATE `item` 
    SET `qty` = `qty`+ ?
    WHERE `item_id` = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $qty, $item_id);
    
    if($stmt->execute()){
        
        $sql2    = "INSERT into `stock_transaction` (`type`, `employee_id`) values (?, ?)";
  
        $stmt2   = $conn->prepare($sql2);
  
        $employee_id = 1; //Session value//
        $stmt2->bind_param('ss', $type, $employee_id);
        if($stmt2->execute()){
            $id = $conn->insert_id;
            $price = 0;
            $sql3    = "INSERT into `item_line` (`price`, `old_stock`, `qty`, `item_line_type`, `stock_transaction_id`, `item_id`) values (?, ?, ?, ?, ?, ?)  ";
  
            $stmt3   = $conn->prepare($sql3);
    
            $employee_id = 1; //Session value//
            $desc = 'Item was restocked';
            $stmt3->bind_param('ssssss', $price, $stock, $qty, $type, $id, $item_id);
            if($stmt3->execute()){
                $result = 1;
            }
        }
    }
}

echo $result;

$conn->close();
?>
