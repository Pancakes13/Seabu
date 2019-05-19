<?php
require("../../connection.php");
$month = $_POST['month'];
$id = $_POST['branch_id'];
$house = "Warehouse";

$result = $conn->query("SELECT `il`.`item_line_id`, `i`.`item_id`, 
                `i`.`name`, `il`.`old_stock`, `bi`.`qty` AS 'item_qty', 
                `il`.`price`, `il`.`qty`, `s`.`transaction_timestamp`,
                `s`.`type`, `s`.`transaction_timestamp`, 
                `e`.`first_name`, `e`.`last_name`, DATE(`s`.`transaction_timestamp`) AS `dateToday`,
                `b`.`branch_id` AS `branch_id`, `b`.`name` AS `branch_name`,
                `b2`.`branch_id` AS `branch2_id`, `b2`.`name` AS `branch2_name`
                FROM `stock_transaction` `s` 
                INNER JOIN `item_line` `il`
                ON  `s`.`stock_transaction_id` = `il`.`stock_transaction_id`
                INNER JOIN `branch_item` `bi`
                ON `il`.`branch_item_id` = `bi`.`branch_item_id`
                INNER JOIN `item` `i`
                ON `bi`.`item_id` = `i`.`item_id`
                INNER JOIN `employee` `e`
                ON `e`.`employee_id` = `s`.`employee_id`
                INNER JOIN `branch` `b`
                ON `e`.`branch_id` = `b`.`branch_id`
                INNER JOIN `branch` `b2`
                ON `bi`.`branch_id` = `b2`.`branch_id`
                AND MONTH(DATE(`s`.`transaction_timestamp`)) = $month
                AND `s`.`isVoid` = 0
                AND `bi`.`branch_id` != 1
                AND `b2`.`branch_id` = $id
                AND `s`.`type` IN ('Transfer', 'TransferHouse')
                ORDER BY `s`.`transaction_timestamp` DESC");

$result_array = array();
while($rs = $result->fetch_assoc()) {
   if ($rs['type'] === 'Transfer') {
      $rs['transferBranch'] = $house;
      $rs['receiveBranch'] = $rs['branch2_name'];
   } else {
      $rs['transferBranch'] = $rs['branch2_name'];
      $rs['receiveBranch'] = $house;
   }
   array_push($result_array, $rs);
}       
echo json_encode($result_array);
$conn->close();
?>
