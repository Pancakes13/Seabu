<?php
require("../../connection.php");

$item = $_POST['item'];
$id = $_POST['stock_transaction_id'];
$item_line  = $_POST['item_line_id'];
$qty = $_POST['qty'];
$type = $_POST['type'];
$moneyId = $_POST['moneyId'];
$moneyQty = $_POST['moneyQty'];

if(!$item || !$id || !$item_line || !$qty || !$type){
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
              $sql2 = "UPDATE `item` 
              SET `qty` = (`qty` - ?)
              WHERE `item_id` = ?";
              
              $stmt2 = $conn->prepare($sql2);
              $stmt2->bind_param('ss', $qty[$x], $item[$x]);
              if($stmt2->execute()){
                $result = 1;
              }
            }
            //DELETE OLD MONEY DENOMINATION//

            for($x=0; $x<count($moneyId); $x++){
                if ($moneyQty[$x] > 0) {
                    $sql4 = "INSERT into `money_denomination`
                    (`money_bill_id`, `stock_transaction_id`, `money_denomination_qty`)
                    values (?, ?, ?) ";
        
                    $stmt4 = $conn->prepare($sql4);
        
                    $stmt4->bind_param('sss', $moneyId[$x], $id, $moneyQty[$x]);
                    $stmt4->execute();
                }
            }
        }
    }
    //INSERT NEW ITEMS TO TALLY//
}

echo $result;

$conn->close();
?>
