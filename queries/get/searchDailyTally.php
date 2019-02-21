<?php
require("../../connection.php");
$date  = $_POST['date'];
$id  = $_POST['branch_id'];

$result = $conn->query("SELECT `i`.`item_id`, `i`.`name`, `il`.`item_line_id`, `il`.`price`, `il`.`qty`, `il`.`item_line_type`, `il`.`old_stock`,
                `s`.`stock_transaction_id`, `s`.`transaction_timestamp`, `s`.`type`, `i`.`qty` AS 'stock_qty'
                FROM `stock_transaction` `s` 
                INNER JOIN `item_line` `il`
                ON  `s`.`stock_transaction_id` = `il`.`stock_transaction_id`
                INNER JOIN `item` `i`
                ON `il`.`item_id` = `i`.`item_id`
                INNER JOIN `branch` `b`
                ON `i`.`branch_id` = `b`.`branch_id`
                AND DATE(`s`.`transaction_timestamp`) ='$date'
                AND `s`.`type` = 'Sold'
                AND `b`.`branch_id` = $id
                AND `b`.`branch_id` != 10
                AND `s`.`isVoid` = 0");
$outp = "";
$result_array = array();
while($rs = $result->fetch_assoc()) {
   array_push($result_array, $rs);
}       
echo json_encode($result_array);
$conn->close();
?>