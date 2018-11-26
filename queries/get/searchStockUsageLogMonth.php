<?php
require("../../connection.php");
$month = $_POST['month'];

$result = $conn->query("SELECT `il`.`item_line_id`, `i`.`item_id`, `i`.`name`, `il`.`old_stock`, `i`.`qty` AS 'item_qty', `il`.`price`, `il`.`qty`, `il`.`item_line_type`,
   `s`.`transaction_timestamp`, `s`.`type`, `s`.`transaction_timestamp`, `e`.`first_name`, `e`.`last_name`, DATE(`s`.`transaction_timestamp`) AS `dateToday`,
   `b`.`branch_id`, `b`.`name` AS `branch_name`
   FROM `stock_transaction` `s` 
   INNER JOIN `item_line` `il`
   ON  `s`.`stock_transaction_id` = `il`.`stock_transaction_id`
   INNER JOIN `item` `i`
   ON `il`.`item_id` = `i`.`item_id`
   INNER JOIN `employee` `e`
   ON `e`.`employee_id` = `s`.`employee_id`
   INNER JOIN `branch` `b`
   ON `e`.`branch_id` = `b`.`branch_id`
   AND MONTH(DATE(`s`.`transaction_timestamp`)) = $month
   ORDER BY `s`.`transaction_timestamp` DESC");

$result_array = array();
while($rs = $result->fetch_assoc()) {
   array_push($result_array, $rs);
}       
echo json_encode($result_array);
$conn->close();
?>
