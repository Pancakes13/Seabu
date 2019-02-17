<?php
require("../../connection.php");
$id = $_POST['id'];
$name  = $_POST['name'];
$price  = $_POST['price'];
$desc  = $_POST['desc'];
$type = $_POST['type'];

if(!$id || !$name || !$price || !$desc || !$type){
  $result = 2;
}else{
    //Insert Item
    $sql = "UPDATE `expense` 
    SET `name` = ?,
    `price` = ?,
    `description` = ?,
    `expense_type` = ?
    WHERE `expense_id` = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssss', $name, $price, $desc, $type, $id);

    if($stmt->execute()){
        $result = 1;
    }
}

echo $result;

$conn->close();
?>
