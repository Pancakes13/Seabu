<?php
require("../../connection.php");
$id = $_GET['item_id'];
$result = $conn->query("SELECT `i`.`item_id`, `i`.`name`, `il`.`price`, `il`.`qty`, 
                    `s`.`transaction_timestamp`, `s`.`type`
                    FROM `stock_transaction` `s` 
                    INNER JOIN `item_line` `il`
                    ON  `s`.`stock_transaction_id` = `il`.`stock_transaction_id`
                    INNER JOIN `item` `i`
                    ON `il`.`item_id` = `i`.`item_id`
                    AND `s`.`transaction_timestamp` = CURDATE()"); //convert timestamp to date
$outp = "";
$result_array = array();
while($rs = $result->fetch_assoc()) {
   array_push($result_array, $rs);
}       
echo json_encode($result_array);
$conn->close();
?>