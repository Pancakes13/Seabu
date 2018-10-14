<?php
require("../../connection.php");
$result = $conn->query("SELECT `i`.`item_id`, `i`.`name`, `i`.`qty` AS 'item_qty', `il`.`price`, `il`.`qty`, `il`.`item_line_type`,
                    `s`.`transaction_timestamp`, `s`.`type`
                    FROM `stock_transaction` `s` 
                    INNER JOIN `item_line` `il`
                    ON  `s`.`stock_transaction_id` = `il`.`stock_transaction_id`
                    INNER JOIN `item` `i`
                    ON `il`.`item_id` = `i`.`item_id`
                    AND DATE(`s`.`transaction_timestamp`) = CURDATE()
                    AND `s`.`type` = 'Sold'"); //convert timestamp to date
$outp = "";
$result_array = array();
while($rs = $result->fetch_assoc()) {
   array_push($result_array, $rs);
}       
echo json_encode($result_array);
$conn->close();
?>