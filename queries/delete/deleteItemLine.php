<?php
require("../../connection.php");
$id  = $_POST['item_line_id'];

if(!$id){
  $result = 2;
}else{
    //Insert Item
    $sql    = "DELETE
    FROM `item_line`
    WHERE `item_line_id` = ?";
    
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
