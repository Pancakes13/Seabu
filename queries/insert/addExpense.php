<?php
require("../../connection.php");
$name  = $_POST['name'];
$desc  = $_POST['desc'];
$price  = $_POST['price'];
$emp_id = 1; //SESSION VALUE

/* validate whether user has entered all values. */

if(!$name || !$price || !$desc){

  $result = 2;

}else{
    //Insert Item
    $sql    = "INSERT into `expense` (`name`, `description`, `price`, `employee_id`) values (?, ?, ?, ?)  ";

    $stmt   = $conn->prepare($sql);
    $stmt->bind_param('ssss', $name, $desc, $price, $emp_id);
    
    if($stmt->execute()){
        $result = 1;
    }
}

echo $result;

$conn->close();
?>
