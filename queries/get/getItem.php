<?php
require("../../connection.php");
$id = $_GET['item_id'];
$result = $conn->query("SELECT `item_id`, `name`, `price`, `qty`  
                          FROM `item` 
                          WHERE `isDeleted` = 0
                          AND   `item_id` = $id");
$outp = "";
$result_array = array();
while($rs = $result->fetch_assoc()) {
   array_push($result_array, $rs);
}       
echo json_encode($result_array);
$conn->close();
?>