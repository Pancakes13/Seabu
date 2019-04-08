<?php
require("../../connection.php");
session_start();
$item = $_POST['item'];
$branch  = $_POST['branch'];
$qty = $_POST['qty'];
$type = "Transfer";
$house = 1;
$transferQty = $_POST['transferQty'];

if(!$item || !$qty || !$branch){
  $result = 2;
}else{

    $sql = "INSERT into `stock_transaction` (`type`, `employee_id`) values (?, ?)";
    
    $stmt = $conn->prepare($sql);
    $employee_id = $_SESSION["user_id"];
    $stmt->bind_param('ss', $type, $employee_id);
    
    if($stmt->execute()){
        $id = $conn->insert_id;
        $sqlHouse = "UPDATE `branch_item` 
                SET `qty` = `qty` - ?
                WHERE `item_id` = ?
                AND `branch_id` = ?";
        $stmtHouse = $conn->prepare($sqlHouse);
        $stmtHouse->bind_param('sss', $transferQty, $item, $house);
        if($stmtHouse->execute()){
            for($x=0; $x<count($branch); $x++){
                $sql2 = "UPDATE `branch_item` 
                    SET `qty` = `qty`+ ?
                    WHERE `item_id` = ?
                    AND `branch_id` = ?";
                $stmt2 = $conn->prepare($sql2);
                $stmt2->bind_param('sss', $qty[$x], $item, $branch[$x]);
                if($stmt2->execute()){
                    $price = 0;
                    $old = 0;
                    $branch_item = 57 + $x;
                    $sql3    = "INSERT into `item_line` (`price`, `old_stock`, `qty`, `stock_transaction_id`, `branch_item_id`) values (?, ?, ?, ?, ?)";
        
                    $stmt3   = $conn->prepare($sql3);
                    $stmt3->bind_param('sssss', $price, $old, $qty[$x], $id, $branch_item);
                    if($stmt3->execute()){
                        $result = 1;
                    }
                }
            }
        }
    }
}

echo $result;

$conn->close();
?>
