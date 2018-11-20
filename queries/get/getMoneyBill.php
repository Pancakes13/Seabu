<?php
require("../../connection.php");

$result = $conn->query("SELECT `money_bill_id`, `money_value`
FROM `money_bill`
ORDER BY `money_value`");

$outp = "";
$result_array = array();
while($rs = $result->fetch_assoc()) {
   array_push($result_array, $rs);
}       
echo json_encode($result_array);
$conn->close();
?>