<?php
require("../../connection.php");

$id = $_POST['branch_id'];
$result = $conn->query("SELECT `item_id`, `name`, `price`, `qty`  
                          FROM `item` 
                          WHERE `branch_id` = $id
                          AND `isDeleted` = 0
                          AND `branch_id` != 10");
$outp = "";
$result_array = array();
while($rs = $result->fetch_assoc()) {
   array_push($result_array, $rs);
}       
echo json_encode($result_array);
$conn->close();
?>