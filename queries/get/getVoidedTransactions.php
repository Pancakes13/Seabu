<?php
require("../../connection.php");

$result = $conn->query("SELECT `s`.`transaction_timestamp`, `s`.`type`, `s`.`transaction_timestamp`, 
            `e`.`first_name`, `e`.`last_name`, `b`.`branch_id`, `b`.`name` AS `branch_name`,
            `em`.`first_name` AS `void_first_name`, `em`.`last_name` AS `void_last_name`,
            `v`.`transaction_timestamp` AS `dateVoid`
            FROM `stock_transaction` `s`
            INNER JOIN `employee` `e`
            ON `e`.`employee_id` = `s`.`employee_id`
            INNER JOIN `branch` `b`
            ON `e`.`branch_id` = `b`.`branch_id`
            INNER JOIN `void_transaction` `v`
            ON `s`.`stock_transaction_id` = `v`.`stock_transaction_id`
            INNER JOIN `employee` `em`
            ON `v`.`employee_id` = `em`.`employee_id`
            AND `s`.`type` = 'Sold'");

$result_array = array();
while($rs = $result->fetch_assoc()) {
   array_push($result_array, $rs);
}       
echo json_encode($result_array);
$conn->close();
?>
