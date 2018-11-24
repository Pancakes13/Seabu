<?php
require("../../connection.php");

$stock_type = "Sold";
$emp_id = 1; //Session value//
$id = ((int)$_POST['stock_transaction_id']) ? $_POST['stock_transaction_id'] : null;
$item  = $_POST['item']; 
$price = $_POST['price'];
$qty = $_POST['qty'];
$type = $_POST['type'];

if(!$stock_type || !$emp_id || !$id || !$item || $id < 0){
    $result = 2;
}else{
  try{
    $conn->autocommit(false);
    for($x=0; $x<count($item); $x++){
      if($qty[$x]>0){
        $sql2    = "INSERT into `item_line` (`price`, `qty`, `item_line_type`, `stock_transaction_id`, `item_id`) values (?, ?, ?, ?, ?)  ";
        
        $stmt2   = $conn->prepare($sql2);
        
        $stmt2->bind_param('sssss', $price[$x], $qty[$x], $type[$x], $id, $item[$x]);
        $stmt2->execute();
              
        $sql3 = "UPDATE `item` 
        SET `qty` = (`qty` - ?)
        WHERE `item_id` = ?";
            
        $stmt3 = $conn->prepare($sql3);
        $stmt3->bind_param('ss', $qty[$x], $item[$x]);
            
        $stmt3->execute();
        $result = 1;
      }
    }
    $conn->commit();
    $conn->autocommit(true);
  }
  catch(Exception $ex){
    echo "Error on item_line insert: " . $ex->getMessage();
  }
}

echo $result;

$conn->close();
?>
