<?php
require("../../connection.php");
$id  = $_POST['stock_transaction_id'];

if(!$id){
  $result = 2;
}else{
    //Insert Item
    try{
        $sql    = "UPDATE `stock_transaction` 
        SET `isVoid` = 1
        WHERE `stock_transaction_id` = ?";
        
        $stmt   = $conn->prepare($sql);
        $stmt->bind_param('s', $id);
        
        $stmt->execute();
        $result = 1;
    }
    catch(Exception $ex){
        echo "Error on deleting expense: " . $ex->getMessage();
    }
}

echo $result;

$conn->close();
?>
