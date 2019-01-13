<?php
require("../../connection.php");

$id = $_POST['stock_transaction_id'];
$result = $conn->query("SELECT `il`.`item_line_id`, `il`.`old_stock`
                FROM `stock_transaction` `s` 
                INNER JOIN `item_line` `il`
                ON  `s`.`stock_transaction_id` = `il`.`stock_transaction_id`
                AND `s`.`type` = 'Sold'
                AND `s`.`stock_transaction_id` = $id");

$result_array = array();
while($rs = $result->fetch_assoc()) {
   array_push($result_array, $rs);
}       
echo json_encode($result_array);
$conn->close();
?>
