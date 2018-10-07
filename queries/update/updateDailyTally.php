<?php
require("../../connection.php");

$id = $_POST['stock_transaction_id'];
$item_line  = $_POST['item_line_id'];
$qty = $_POST['qty'];
$type = $_POST['type'];

if(!$id){
  $result = 2;
}else{
    //Update items to tally//
    for($x=0; $x<count($item_line); $x++){
        if($qty[$x]>0){
            $sql    = "UPDATE `item_line` 
                SET `qty` = ?,
                `item_line_type` = ?
                WHERE `item_line_id` = ?";
                
            $stmt   = $conn->prepare($sql);
            $stmt->bind_param('sss', $qty[$x], $type[$x], $item_line[$x]);
            if($stmt->execute()){
                $result = 1;
            }
        }
    }
    //INSERT NEW ITEMS TO TALLY//
}

echo $result;

$conn->close();
?>
