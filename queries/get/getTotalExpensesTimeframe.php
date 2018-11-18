<?php
require("../../connection.php");
$date1 = $_GET['date1'];
$date2 = $_GET['date2'];

$result = $conn->query("SELECT SUM(`price`) 
FROM `expense`
WHERE DATE(`expense_timestamp`) >= 	$date1 AND DATE(`expense_timestamp`) <= $date2
AND `isDeleted` = 0");
$outp = "";
$result_array = array();
while($rs = $result->fetch_assoc()) {
   array_push($result_array, $rs);
}       
echo json_encode($result_array);
$conn->close();
?>