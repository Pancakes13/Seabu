<?php
require("../../connection.php");
$name  = (strlen($_POST['name']) <= 100) ? $_POST['name'] : null;
$desc  = $_POST['desc'];
$price  = ((float)$_POST['price']) ? $_POST['price'] : null;
$type = $_POST['type'];
$emp_id = 1; //SESSION VALUE

/* validate whether user has entered all values. */

if(!$name || !$price || !$desc || !$type || $price < 0){

  $result = 2;

}else{
    //Insert Item
    try{
        $sql    = "INSERT into `expense` (`name`, `description`, `price`, `expense_type`, `employee_id`) values (?, ?, ?, ?, ?)  ";

        $stmt   = $conn->prepare($sql);
        $stmt->bind_param('sssss', $name, $desc, $price, $type, $emp_id);
        
        if($stmt->execute()){
            $result = 1;
        }
    }
    catch(Exception $ex){
        echo "Error on inserting expense: " . $ex->getMessage();
    }
}

echo $result;

$conn->close();
?>