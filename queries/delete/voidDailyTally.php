<?php
require("../../connection.php");
session_start();

$id  = $_POST['stock_transaction_id'];
$emp_id = $_SESSION["user_id"];

if(!$id || !$emp_id){
  $result = 2;
}else{
    //Insert Item
    try{
        $sql    = "UPDATE `stock_transaction` 
        SET `isVoid` = 1
        WHERE `stock_transaction_id` = ?";
        
        $stmt   = $conn->prepare($sql);
        $stmt->bind_param('s', $id);
        
        $stmt->execute();

        $result = $conn->query("SELECT `il`.`item_line_id`, `il`.`old_stock`,
            `i`.`item_id`, `bi`.`branch_item_id`
            FROM `stock_transaction` `s` 
            INNER JOIN `item_line` `il`
            ON  `s`.`stock_transaction_id` = `il`.`stock_transaction_id`
            INNER JOIN `branch_item` `bi`
            ON `il`.`branch_item_id` = `bi`.`branch_item_id`
            INNER JOIN `item` `i`
            ON `bi`.`item_id` = `i`.`item_id`
            AND `s`.`type` = 'Sold'
            AND `s`.`stock_transaction_id` = $id");

        $result_array = array();
        while($rs = $result->fetch_assoc()) {
            if($stmt->execute()){
              $sql2 = "UPDATE `branch_item` 
              SET `qty` = ?
              WHERE `branch_item_id` = ?";

              $stmt2 = $conn->prepare($sql2);
              $stmt2->bind_param('ss', $rs['old_stock'], $rs['branch_item_id']);
              $stmt2->execute();
            }
        }

        $sql3 = "INSERT into `void_transaction`
        (`employee_id`, `stock_transaction_id`)
        values (?, ?) ";
        
        $stmt3 = $conn->prepare($sql3);

        $stmt3->bind_param('ss', $emp_id, $id);
        $stmt3->execute();

        $result = 1;
    }
    catch(Exception $ex){
        echo "Error on voiding stock transaction: " . $ex->getMessage();
    }
}

echo $result;

$conn->close();
?>
