<?php
require("../../connection.php");

$result = $conn->query("SELECT * 
                        FROM employee e
                        INNER JOIN branch b
                        ON e.branch_id = b.branch_id
                        WHERE DATE_FORMAT(`birthdate`, '%m-%d') >= DATE_FORMAT(NOW(), '%m-%d') 
                        AND DATE_FORMAT(`birthdate`, '%m-%d') <= DATE_FORMAT((NOW() + INTERVAL +10 DAY), '%m-%d')");
$outp = "";
$result_array = array();
while($rs = $result->fetch_assoc()) {
   array_push($result_array, $rs);
}       
echo json_encode($result_array);
$conn->close();
?>