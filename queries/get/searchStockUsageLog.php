<?php
require("../../connection.php");
$date1 = $_POST['date1'];
$date2 = $_POST['date2'];
$id = $_POST['branch_id'];

$result = $conn->query("SELECT `il`.`item_line_id`, `i`.`item_id`, 
                `i`.`name`, `il`.`old_stock`, `i`.`qty` AS 'item_qty', 
                `il`.`price`, `il`.`qty`, `il`.`item_line_type`,
                `s`.`transaction_timestamp`, `s`.`type`, `s`.`transaction_timestamp`, 
                `e`.`first_name`, `e`.`last_name`, DATE(`s`.`transaction_timestamp`) AS `dateToday`,
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
                AND DATE(`s`.`transaction_timestamp`) >= '$date1' AND DATE(`s`.`transaction_timestamp`) <= '$date2'
                AND `s`.`isVoid` = 0
                AND `i`.`branch_id` = $id
                AND `i`.`branch_id` != 10
                ORDER BY `s`.`transaction_timestamp` DESC");

$result_array = array();
while($rs = $result->fetch_assoc()) {
   $rs['sold'] = ($rs['type'] === 'Sold')? $rs['qty'] : 0;
   $rs['new'] = ($rs['type'] === 'Restock')? $rs['qty'] : 0;
   $rs['damaged'] = ($rs['type'] === 'Damaged')? $rs['qty'] : 0;
   $rs['stock'] = $rs['old_stock'] + $rs['new'] - $rs['sold'] - $rs['damaged'];
   array_push($result_array, $rs);
}       
echo json_encode($result_array);
$conn->close();
?>
