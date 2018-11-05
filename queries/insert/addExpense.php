<?php
require("../../connection.php");
$name  = $_POST['name'];
$desc  = $_POST['desc'];
$price  = $_POST['price'];
$type = $_POST['type'];
$emp_id = 1; //SESSION VALUE

/* validate whether user has entered all values. */

if(!$name || !$price || !$desc || !$type){

  $result = 2;

}else{
    //Insert Item
    $sql    = "INSERT into `expense` (`name`, `description`, `price`, `expense_type`, `employee_id`) values (?, ?, ?, ?, ?)  ";

    $stmt   = $conn->prepare($sql);
    $stmt->bind_param('sssss', $name, $desc, $price, $type, $emp_id);
    
    if($stmt->execute()){
        $result = 1;
    }
}

echo $result;

$conn->close();
?>