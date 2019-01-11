<?php
require("../../connection.php");
$date1 = $_GET['date1'];
$date2 = $_GET['date2'];

$result = $conn->query("SELECT SUM(`i`.`price`*`i`.`qty`) AS `total`
FROM `item_line` `i`
INNER JOIN `stock_transaction` `s`
ON `i`.`stock_transaction_id` = `s`.`stock_transaction_id`
WHERE DATE(`transaction_timestamp`) >= 	$date1 AND DATE(`transaction_timestamp`) <= $date2
AND `s`.`isVoid` = 0");
$outp = "";
$result_array = array();
while($rs = $result->fetch_assoc()) {
   array_push($result_array, $rs);
}       
echo json_encode($result_array);
$conn->close();
?>