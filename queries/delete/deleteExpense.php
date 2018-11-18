<?php
require("../../connection.php");
$id  = $_POST['expense_id'];

if(!$id){
  $result = 2;
}else{
    //Insert Item
    $sql    = "UPDATE `expense` 
    SET `isDeleted` = 1
    WHERE `expense_id` = ?";
    
    $stmt   = $conn->prepare($sql);
    $stmt->bind_param('s', $id);
    echo $id;
    if($stmt->execute()){
        $result = 1;
    }
}

echo $result;

$conn->close();
?>
