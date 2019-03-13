<?php
require("../../connection.php");

$id = $_POST['branch_id'];
$result = $conn->query("SELECT `i`.`item_id`, `i`.`name`, `i`.`price`, `bi`.`branch_item_id`, `bi`.`qty`, `bi`.`branch_id`
                          FROM `item` `i`
                          INNER JOIN `branch_item` `bi`
                          ON `i`.`item_id` = `bi`.`item_id`
                          WHERE `bi`.`branch_id` = $id
                          AND `isDeleted` = 0");
$outp = "";
$result_array = array();
while($rs = $result->fetch_assoc()) {
   array_push($result_array, $rs);
}       
echo json_encode($result_array);
$conn->close();
?>