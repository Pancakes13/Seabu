<?php
require("../../connection.php");
$id = $_POST['id'];
$name  = $_POST['name'];
$price  = $_POST['price'];
$qty = $_POST['qty'];

if(!$id || !$name || !$price || !$qty){
  $result = 2;
}else{
    //Insert Item
    $sql = "UPDATE `fisherman_expense` 
    SET `item_name` = ?,
    `price` = ?,
    `item_qty` = ?
    WHERE `fisherman_expense_id` = ?";
    
    $stmt   = $conn->prepare($sql);
    $stmt->bind_param('ssss', $name, $price, $qty, $id);

    if($stmt->execute()){
        $result = 1;
    }
}

echo $result;

$conn->close();
?>
