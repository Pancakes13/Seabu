<?php
require("../../connection.php");
$item = $_POST['item'];

$result = $conn->query("SELECT 
SUM(CASE WHEN MONTH(`s`.`transaction_timestamp`) = '01' && YEAR(CURDATE()) THEN `i`.`qty` ELSE 0 END) AS 'janCnt',
SUM(CASE WHEN MONTH(`s`.`transaction_timestamp`) = '02' && YEAR(CURDATE()) THEN `i`.`qty` ELSE 0 END) AS 'febCnt',
SUM(CASE WHEN MONTH(`s`.`transaction_timestamp`) = '03' && YEAR(CURDATE()) THEN `i`.`qty` ELSE 0 END) AS 'marCnt',
SUM(CASE WHEN MONTH(`s`.`transaction_timestamp`) = '04' && YEAR(CURDATE()) THEN `i`.`qty` ELSE 0 END) AS 'aprCnt',
SUM(CASE WHEN MONTH(`s`.`transaction_timestamp`) = '05' && YEAR(CURDATE()) THEN `i`.`qty` ELSE 0 END) AS 'mayCnt',
SUM(CASE WHEN MONTH(`s`.`transaction_timestamp`) = '06' && YEAR(CURDATE()) THEN `i`.`qty` ELSE 0 END) AS 'junCnt',
SUM(CASE WHEN MONTH(`s`.`transaction_timestamp`) = '07' && YEAR(CURDATE()) THEN `i`.`qty` ELSE 0 END) AS 'julCnt',
SUM(CASE WHEN MONTH(`s`.`transaction_timestamp`) = '08' && YEAR(CURDATE()) THEN `i`.`qty` ELSE 0 END) AS 'augCnt',
SUM(CASE WHEN MONTH(`s`.`transaction_timestamp`) = '09' && YEAR(CURDATE()) THEN `i`.`qty` ELSE 0 END) AS 'sepCnt',
SUM(CASE WHEN MONTH(`s`.`transaction_timestamp`) = '10' && YEAR(CURDATE()) THEN `i`.`qty` ELSE 0 END) AS 'octCnt',
SUM(CASE WHEN MONTH(`s`.`transaction_timestamp`) = '11' && YEAR(CURDATE()) THEN `i`.`qty` ELSE 0 END) AS 'novCnt',
SUM(CASE WHEN MONTH(`s`.`transaction_timestamp`) = '12' && YEAR(CURDATE()) THEN `i`.`qty` ELSE 0 END) AS 'decCnt'
FROM `item_line` `i`
INNER JOIN `stock_transaction` `s`
ON `i`.`stock_transaction_id` = `s`.`stock_transaction_id`
AND `s`.`type` = 'Sold'
AND `i`.`item_id` = $item");
$outp = "";
$result_array = array();
while($rs = $result->fetch_assoc()) {
   array_push($result_array, $rs);
}       
echo json_encode($result_array);
$conn->close();
?>