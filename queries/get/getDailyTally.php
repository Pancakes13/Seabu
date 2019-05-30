<?php
require("../../connection.php");

$id = $_POST['branch_id'];

$result = $conn->query("SELECT `i`.`item_id`, `i`.`name`, `bi`.`qty` AS 'item_qty', `il`.`price`, `il`.`qty`,
                    `s`.`transaction_timestamp`, `s`.`type`, `s`.`stock_transaction_id`, `b`.`branch_id`
                    FROM `stock_transaction` `s` 
                    INNER JOIN `item_line` `il`
                    ON  `s`.`stock_transaction_id` = `il`.`stock_transaction_id`
                    INNER JOIN `branch_item` `bi`
                    ON `il`.`branch_item_id` = `bi`.`branch_item_id`
                    INNER JOIN `item` `i`
                    ON `bi`.`item_id` = `i`.`item_id`
                    INNER JOIN `branch` `b`
                    ON `bi`.`branch_id` = `b`.`branch_id`
                    AND DATE(`s`.`transaction_timestamp`) = CURDATE()
                    AND `s`.`type` = 'Sold'
                    AND `s`.`isVoid` = 0
                    AND `b`.`branch_id` = $id
                    AND `b`.`branch_id` != 1
                    ORDER BY `i`.`name`"); //convert timestamp to date
$outp = "";
$result_array = array();
while($rs = $result->fetch_assoc()) {
   array_push($result_array, $rs);
}       
echo json_encode($result_array);
$conn->close();
?>