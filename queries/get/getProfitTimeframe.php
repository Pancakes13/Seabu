<?php
require("../../connection.php");
$date1 = $_POST['date1'];
$date2 = $_POST['date2'];

$result = $conn->query("SELECT COALESCE(SUM(`price`), 0) AS 'totalExpenses'
FROM `expense`
WHERE DATE(`expense_timestamp`) >= 	'$date1' AND DATE(`expense_timestamp`) <= '$date2'
AND `isDeleted` = 0");

$resultFish = $conn->query("SELECT COALESCE(SUM(`price`), 0) AS 'fishExpenses'
FROM `fisherman_expense`
WHERE DATE(`expense_timestamp`) >= 	'$date1' AND DATE(`expense_timestamp`) <= '$date2'
AND `isDeleted` = 0");

$result2 = $conn->query("SELECT SUM(`i`.`price`*`bi`.`qty`) AS `total`
FROM `item_line` `i`
INNER JOIN `stock_transaction` `s`
ON `i`.`stock_transaction_id` = `s`.`stock_transaction_id`
INNER JOIN `branch_item` `bi`
ON `i`.`branch_item_id` = `bi`.`branch_item_id`
AND `s`.`isVoid` = 0
WHERE DATE(`transaction_timestamp`) >= '$date1' AND DATE(`transaction_timestamp`) <= '$date2'");

$result_array = array();
$rs = $result->fetch_assoc();
$rs2 = $result2->fetch_assoc();
$rsFish = $resultFish->fetch_assoc();
$rs['total'] = $rs2['total'];
$rs['fishExpenses'] = $rsFish['fishExpenses'];
$rs['netProfit'] = $rs2['total'] - ($rs['totalExpenses'] + $rsFish['fishExpenses']);

array_push($result_array, $rs);

echo json_encode($result_array);
$conn->close();
?>