<?php
require("../../connection.php");
$name  = $_POST['name'];
$price  = $_POST['price'];
$qty  = $_POST['qty'];

if(!$id){
  $result = 2;
}else{
    //Insert Item
    $sql    = "UPDATE `item` 
    SET `name` = $name,
    `price` = $price,
    `qty` = $qty
    WHERE `item_id` = ?";

    $stmt   = $conn->prepare($sql);
    $stmt->bind_param('s', $id);
    
    if($stmt->execute()){
        $result = 1;
    }
}

echo $result;

$conn->close();
?>
