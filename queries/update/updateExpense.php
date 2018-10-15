<?php
require("../../connection.php");
$id = $_POST['id'];
$name  = $_POST['name'];
$price  = $_POST['price'];
$desc  = $_POST['desc'];

if(!$id){
  $result = 2;
}else{
    //Insert Item
    $sql = "UPDATE `expense` 
    SET `name` = ?,
    `price` = ?,
    `description` = ?
    WHERE `expense_id` = ?";
    
    $stmt   = $conn->prepare($sql);
    $stmt->bind_param('ssss', $name, $price, $desc, $id);

    if($stmt->execute()){
        $result = 1;
    }
}

echo $result;

$conn->close();
?>
