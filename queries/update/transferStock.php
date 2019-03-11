<?php
require("../../connection.php");
session_start();
$item_id = $_POST['item_id'];
$stock = $_POST['stock'];
$branch  = $_POST['branch_id'];
$type = 'Transfer';

if(!$item_id || !$stock || !$branch){
  $result = 2;
}else{
    //Insert Item
    for($x=0; $x<count($item_id); $x++){

    $sql    = "UPDATE `branch_item` 
    SET `branch_stock` = `branch_stock`+ ?
    WHERE `item_id` = ?
    AND `branch_id` = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $stock[$x], $item_id[$x], $branch[$x]);
    
    if($stmt->execute()){
        
        $sql2    = "INSERT into `stock_transaction` (`type`, `employee_id`) values (?, ?)";
  
        $stmt2   = $conn->prepare($sql2);
  
        $employee_id = $_SESSION["user_id"];
        $stmt2->bind_param('ss', $type, $employee_id);
        if($stmt2->execute()){
            $id = $conn->insert_id;
            $price = 0;
            $sql3    = "INSERT into `item_line` (`price`, `old_stock`, `qty`, `stock_transaction_id`, `item_id`) values (?, ?, ?, ?, ?)  ";
  
            $stmt3   = $conn->prepare($sql3);
    
            $employee_id = $_SESSION["user_id"];
            $desc = 'Item was restocked';
            $stmt3->bind_param('sssss', $price, $stock, $qty, $id, $item_id);
            if($stmt3->execute()){
                $result = 1;
            }
        }
    }
}

echo $result;

$conn->close();
?>
