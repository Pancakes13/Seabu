<?php
require("../../connection.php");

$result = $conn->query("SELECT `employee_id`, `username`, `first_name`, `last_name`, 
                        `middle_name`, `email`, `contact_no`, `birthdate`  
                          FROM `employee` 
                          WHERE `isDeleted` = 0");
$outp = "";
$result_array = array();
while($rs = $result->fetch_assoc()) {
   array_push($result_array, $rs);
}       
echo json_encode($result_array);
$conn->close();
?>