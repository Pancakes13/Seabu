<?php
require("../../connection.php");
$date  = $_POST['date'];
$result = $conn->query("SELECT `i`.`item_id`, `i`.`name`, `i`.`price`, `i`.`qty` AS 'item_qty',
                `il`.`item_line_id`, `il`.`qty`, `il`.`item_line_type`
                FROM `item` `i`
                INNER JOIN `item_line` `il`
                ON `i`.`item_id` = `il`.`item_id`
                INNER JOIN `stock_transaction` `s`
                ON `il`.`stock_transaction_id` = `s`.`stock_transaction_id`
                WHERE `i`.`isDeleted` = 0
                AND DATE(`s`.`transaction_timestamp`) = '$date'
                GROUP BY `i`.`item_id`");
//GET ALL NOT IN THE LIST ABOVE//
            $date  = $_POST['date'];$outp = "";
$result_array = array();
$str = "SELECT `item_id`, `name`, `price`, `qty`  
FROM `item` 
WHERE `isDeleted` = 0";
while($rs = $result->fetch_assoc()) {
    $str .= " AND NOT `item_id` = ".$rs['item_id'];
}
$result2 = $conn->query($str);
$result2_array = array();
while($rs2 = $result2->fetch_assoc()) {
    array_push($result2_array, $rs2);
}
echo json_encode($result2_array);
$conn->close();
?>