<?php
require("../../connection.php");

$id = $_POST['branch_id'];

$result = $conn->query("SELECT `i`.`item_id`, `i`.`name`, `i`.`qty` AS 'item_qty', `il`.`price`, `il`.`qty`, `il`.`item_line_type`,
                    `s`.`transaction_timestamp`, `s`.`type`, `s`.`stock_transaction_id`, `b`.`branch_id`
                    FROM `stock_transaction` `s` 
                    INNER JOIN `item_line` `il`
                    ON  `s`.`stock_transaction_id` = `il`.`stock_transaction_id`
                    INNER JOIN `item` `i`
                    ON `il`.`item_id` = `i`.`item_id`
                    INNER JOIN `branch` `b`
                    ON `i`.`branch_id` = `b`.`branch_id`
                    AND DATE(`s`.`transaction_timestamp`) = CURDATE()
                    AND `s`.`type` = 'Sold'
                    AND `s`.`isVoid` = 0
                    AND `b`.`branch_id` = $id"); //convert timestamp to date
$outp = "";
$result_array = array();
while($rs = $result->fetch_assoc()) {
   array_push($result_array, $rs);
}       
echo json_encode($result_array);
$conn->close();
?>