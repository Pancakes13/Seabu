<?php
require("../../connection.php");
session_start();
$name  = (strlen($_POST['name']) <= 100) ? $_POST['name'] : null;
$price  = ((float)$_POST['price']) ? $_POST['price'] : null;
$qty  = ((int)$_POST['qty']) ? $_POST['qty'] : null;
$emp_id = $_SESSION["user_id"];

/* validate whether user has entered all values. */

if(!$name || !$price || !$qty || $qty <= 0 || $price < 0){

  $result = 2;

}else{
    //Insert Item
    try{
        $sql    = "INSERT into `fisherman_expense` (`item_name`, `price`, `item_qty`, `employee_id`) values (?, ?, ?, ?)  ";

        $stmt   = $conn->prepare($sql);
        $stmt->bind_param('ssss', $name, $price, $qty, $emp_id);
        
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