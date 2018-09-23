<?php
require("../../connection.php");

$result = $conn->query("SELECT `e`.`expense_id`, `e`.`name`, `e`.`description`, `e`.`price`, `e`.`expense_timestamp`, `em`.`first_name`, `em`.`last_name`
                          FROM `expense` `e`
                          INNER JOIN `employee` `em`
                          ON `e`.`employee_id` = `em`.`employee_id`
                          ORDER BY `expense_timestamp` DESC");
$outp = "";
$result_array = array();
while($rs = $result->fetch_assoc()) {
   array_push($result_array, $rs);
}       
echo json_encode($result_array);
$conn->close();
?>