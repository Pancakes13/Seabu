<?php
require("../../connection.php");
$id  = $_POST['item_line_id'];

if(!$id){
  $result = 2;
}else{
    //Insert Item
    try{
        $sql    = "DELETE
        FROM `item_line`
        WHERE `item_line_id` = ?";
        
        $stmt   = $conn->prepare($sql);
        $stmt->bind_param('s', $id);
        
        $stmt->execute();
        $result = 1;
    }
    catch(Exception $ex){
        echo "Error on deleting Item line: " . $ex->getMessage(); 
    }
}

echo $result;

$conn->close();
?>
