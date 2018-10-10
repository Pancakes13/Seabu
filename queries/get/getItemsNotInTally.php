<?php
require("../../connection.php");

$result = $conn->query("SELECT `i`.`item_id`, `i`.`name`, `i`.`price`, `i`.`qty` , `il`.`item_line_id`
                FROM `item` `i`
                INNER JOIN `item_line` `il`
                ON `i`.`item_id` = `il`.`item_id`
                INNER JOIN `stock_transaction` `s`
                ON `il`.`stock_transaction_id` = `s`.`stock_transaction_id`
                WHERE `i`.`isDeleted` = 0
                AND DATE(`s`.`transaction_timestamp`) = CURDATE()
                GROUP BY `i`.`item_id`");
//GET ALL NOT IN THE LIST ABOVE//
            $outp = "";
$result_array = array();
while($rs = $result->fetch_assoc()) {
   array_push($result_array, $rs);
}       
echo json_encode($result_array);
$conn->close();
?>