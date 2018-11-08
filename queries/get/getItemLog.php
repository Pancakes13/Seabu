<?php
require("../../connection.php");
$id = $_GET['item_id'];
$result = $conn->query("SELECT `il`.`log_action`, `il`.`log_description`, `il`.`log_timestamp`, 
                    `i`.`name`, `e`.`first_name`, `e`.`last_name`,
                    `b`.`branch_id`, `b`.`name` AS `branch_name`
                    FROM `item_log` `il` 
                    INNER JOIN `item` `i`
                    ON  `il`.`item_id` = `i`.`item_id`
                    INNER JOIN `employee` `e`
                    ON `il`.`employee_id` = `e`.`employee_id`
                    INNER JOIN `branch` `b`
                    ON `e`.`branch_id` = `b`.`branch_id`
                    AND `il`.`item_id` = $id");

$result_array = array();
while($rs = $result->fetch_assoc()) {
   array_push($result_array, $rs);
}       
echo json_encode($result_array);
$conn->close();
?>