<?php
require("../../connection.php");

$result = $conn->query("SELECT `e`.`employee_id`, `e`.`username`, `e`.`first_name`, `e`.`last_name`, 
                      `e`.`middle_name`, `e`.`email`, `e`.`contact_no`, `e`.`birthdate`, `b`.`branch_id`, `b`.`name`
                      FROM `employee` `e`
                      INNER JOIN `branch` `b`
                      ON `e`.`branch_id` = `b`.`branch_id`
                      WHERE `isDeleted` = 0");
$outp = "";
$result_array = array();
while($rs = $result->fetch_assoc()) {
   array_push($result_array, $rs);
}       
echo json_encode($result_array);
$conn->close();
?>