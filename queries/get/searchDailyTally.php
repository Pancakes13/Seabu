<?php
require("../../connection.php");
$date  = $_POST['date'];
$result = $conn->query("SELECT `i`.`item_id`, `i`.`name`, `il`.`item_line_id`, `il`.`price`, `il`.`qty`, `il`.`item_line_type`,
                `s`.`stock_transaction_id`, `s`.`transaction_timestamp`, `s`.`type`
                FROM `stock_transaction` `s` 
                INNER JOIN `item_line` `il`
                ON  `s`.`stock_transaction_id` = `il`.`stock_transaction_id`
                INNER JOIN `item` `i`
                ON `il`.`item_id` = `i`.`item_id`
                AND DATE(`s`.`transaction_timestamp`) ='$date'");
$outp = "";
$result_array = array();
while($rs = $result->fetch_assoc()) {
   array_push($result_array, $rs);
}       
echo json_encode($result_array);
$conn->close();
?>