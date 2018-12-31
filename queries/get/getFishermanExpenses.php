<?php
require("../../connection.php");

$result = $conn->query("SELECT `f`.`fisherman_expense_id`, `f`.`item_name`, `f`.`item_qty`,
                          `f`.`price`, `f`.`expense_timestamp`, 
                          `em`.`first_name`, `em`.`last_name`
                          FROM `fisherman_expense` `f`
                          INNER JOIN `employee` `em`
                          ON `f`.`employee_id` = `em`.`employee_id`
                          AND `f`.`isDeleted` = 0
                          ORDER BY `f`.`expense_timestamp` DESC");
$outp = "";
$result_array = array();
while($rs = $result->fetch_assoc()) {
   array_push($result_array, $rs);
}       
echo json_encode($result_array);
$conn->close();
?>