<?php
require("../../connection.php");

$result = $conn->query("SELECT `item_id`, `name`, `price`, `qty`  
                          FROM `item` 
                          WHERE `isDeleted` = 0");
$outp = "";
$result_array = array();
while($rs = $result->fetch_assoc()) {
   array_push($result_array, $rs);
}       
echo json_encode($result_array);
$conn->close();
?>