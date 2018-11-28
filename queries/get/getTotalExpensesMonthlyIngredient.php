<?php
require("../../connection.php");

$result = $conn->query("SELECT 
SUM(CASE WHEN MONTH(`expense_timestamp`) = '01' && YEAR(CURDATE()) THEN `price` ELSE 0 END) AS 'janCnt',
SUM(CASE WHEN MONTH(`expense_timestamp`) = '02' && YEAR(CURDATE()) THEN `price` ELSE 0 END) AS 'febCnt',
SUM(CASE WHEN MONTH(`expense_timestamp`) = '03' && YEAR(CURDATE()) THEN `price` ELSE 0 END) AS 'marCnt',
SUM(CASE WHEN MONTH(`expense_timestamp`) = '04' && YEAR(CURDATE()) THEN `price` ELSE 0 END) AS 'aprCnt',
SUM(CASE WHEN MONTH(`expense_timestamp`) = '05' && YEAR(CURDATE()) THEN `price` ELSE 0 END) AS 'mayCnt',
SUM(CASE WHEN MONTH(`expense_timestamp`) = '06' && YEAR(CURDATE()) THEN `price` ELSE 0 END) AS 'junCnt',
SUM(CASE WHEN MONTH(`expense_timestamp`) = '07' && YEAR(CURDATE()) THEN `price` ELSE 0 END) AS 'julCnt',
SUM(CASE WHEN MONTH(`expense_timestamp`) = '08' && YEAR(CURDATE()) THEN `price` ELSE 0 END) AS 'augCnt',
SUM(CASE WHEN MONTH(`expense_timestamp`) = '09' && YEAR(CURDATE()) THEN `price` ELSE 0 END) AS 'sepCnt',
SUM(CASE WHEN MONTH(`expense_timestamp`) = '10' && YEAR(CURDATE()) THEN `price` ELSE 0 END) AS 'octCnt',
SUM(CASE WHEN MONTH(`expense_timestamp`) = '11' && YEAR(CURDATE()) THEN `price` ELSE 0 END) AS 'novCnt',
SUM(CASE WHEN MONTH(`expense_timestamp`) = '12' && YEAR(CURDATE()) THEN `price` ELSE 0 END) AS 'decCnt'
FROM `expense`
WHERE `isDeleted` = 0
AND `expense_type` = 'Ingredient'");
$outp = "";
$result_array = array();
while($rs = $result->fetch_assoc()) {
   array_push($result_array, $rs);
}       
echo json_encode($result_array);
$conn->close();
?>