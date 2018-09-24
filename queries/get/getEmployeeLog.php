<?php
require("../../connection.php");
$id = $_GET['employee_id'];
$result = $conn->query("SELECT `el`.`action`, `el`.`log_description`, `el`.`log_timestamp`, `e`.`first_name`, `e`.`last_name`
                    FROM `employee_log` `el` 
                    INNER JOIN `employee` `e`
                    ON `el`.`employee_id` = `e`.`employee_id`
                    AND `el`.`employee_id` = $id");

$result_array = array();
while($rs = $result->fetch_assoc()) {
   array_push($result_array, $rs);
}       
echo json_encode($result_array);
$conn->close();
?>