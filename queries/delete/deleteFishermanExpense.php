<?php
require("../../connection.php");
$id  = $_POST['fisherman_expense_id'];

if(!$id){
  $result = 2;
}else{
    //Insert Item
    try{
        $sql    = "UPDATE `fisherman_expense` 
        SET `isDeleted` = 1
        WHERE `fisherman_expense_id` = ?";
        
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
