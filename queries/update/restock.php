<?php
require("../../connection.php");
session_start();
$item_id = $_POST['item_id'];
$stock = $_POST['current_stock'];
$qty  = $_POST['qty'];
$type = $_POST['type'];
$branch_item = $_POST['branch_item'];
$branch = $_POST['branch'];

if(!$item_id || !$qty || !$type){
  $result = 2;
}else{
    //Insert Item
    $sql    = "UPDATE `branch_item` 
    SET `qty` = `qty`+ ?
    WHERE `item_id` = ?
    AND `branch_id` = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $qty, $item_id, $branch);
    
    if($stmt->execute()){
        
        $sql2    = "INSERT into `stock_transaction` (`type`, `employee_id`) values (?, ?)";
  
        $stmt2   = $conn->prepare($sql2);
  
        $employee_id = $_SESSION["user_id"];
        $stmt2->bind_param('ss', $type, $employee_id);
        if($stmt2->execute()){
            $id = $conn->insert_id;
            $price = 0;
            $sql3    = "INSERT into `item_line` (`price`, `old_stock`, `qty`, `stock_transaction_id`, `branch_item_id`) values (?, ?, ?, ?, ?)  ";
  
            $stmt3   = $conn->prepare($sql3);
    
            $employee_id = $_SESSION["user_id"];
            if ($qty >= 0) {
                $desc = 'Item was restocked';
            } else {
                $desc = 'Damaged item was removed';
            }
            $stmt3->bind_param('sssss', $price, $stock, $qty, $id, $branch_item);
            if($stmt3->execute()){
                $result = 1;
            }
        }
    }
}

echo $result;

$conn->close();
?>
