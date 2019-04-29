<?php
require("../../connection.php");
$result = $conn->query("SELECT `branch_id`, `name`  
                          FROM `branch`");
$outp = "";
$result_array = array();
while($rs = $result->fetch_assoc()) {
   array_push($result_array, $rs);
}       
echo json_encode($result_array);
$conn->close();
?>