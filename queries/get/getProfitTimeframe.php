<?php
require("../../connection.php");
$date1 = $_POST['date1'];
$date2 = $_POST['date2'];

$result = $conn->query("SELECT SUM(`price`) AS 'totalExpenses'
FROM `expense`
WHERE DATE(`expense_timestamp`) >= 	'$date1' AND DATE(`expense_timestamp`) <= '$date2'
AND `isDeleted` = 0");

$result2 = $conn->query("SELECT SUM(`i`.`price`*`i`.`qty`) AS `total`
FROM `item_line` `i`
INNER JOIN `stock_transaction` `s`
ON `i`.`stock_transaction_id` = `s`.`stock_transaction_id`
AND `s`.`isVoid` = 0
WHERE DATE(`transaction_timestamp`) >= '$date1' AND DATE(`transaction_timestamp`) <= '$date2'");

$result_array = array();
$rs = $result->fetch_assoc();
$rs2 = $result2->fetch_assoc();
$rs3['netProfit'] = $rs2['total'] - $rs['totalExpenses'];

array_push($result_array, $rs);
array_push($result_array, $rs2);
array_push($result_array, $rs3);

echo json_encode($result_array);
$conn->close();
?>