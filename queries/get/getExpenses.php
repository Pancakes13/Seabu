<?php
require("../../connection.php");
$type  = $_POST['type'];

$result = $conn->query("SELECT `e`.`expense_id`, `e`.`name`, `e`.`description`, `e`.`price`, 
                          `e`.`expense_type`, `e`.`expense_timestamp`, 
                          `em`.`first_name`, `em`.`last_name`,
                          `b`.`branch_id`, `b`.`name` AS `branch_name`
                          FROM `expense` `e`
                          INNER JOIN `employee` `em`
                          ON `e`.`employee_id` = `em`.`employee_id`
                          INNER JOIN `branch` `b`
                          ON `em`.`branch_id` = `b`.`branch_id`
                          AND `e`.`isDeleted` = 0
                          AND `e`.`expense_type` = '$type'
                          ORDER BY `expense_timestamp` DESC");
$outp = "";
$result_array = array();
while($rs = $result->fetch_assoc()) {
   array_push($result_array, $rs);
}       
echo json_encode($result_array);
$conn->close();
?>