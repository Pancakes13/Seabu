-<?php
require("../../connection.php");
$name  = (strlen($_POST['name']) <= 50) ? $_POST['name'] : null;

$price  = (is_float($_POST['price'])) ? $_POST['price'] : null;


/* validate whether user has entered all values. */

if(!$name || !$price || $price < 0){

  $result = 2;

}else{
    //Insert Item
    $sql    = "INSERT into `item` (`name`, `price`) values (?, ?)  ";

    $stmt   = $conn->prepare($sql);
    $stmt->bind_param('ss', $name, $price);
    
    if($stmt->execute()){
      //Insert Item Log
      $sql2    = "INSERT into `item_log` (`log_action`, `log_description`, `item_id`, `employee_id`) values (?, ?, ?, ?)  ";
  
        $stmt2   = $conn->prepare($sql2);
  
        $action = 'Create';
        $item_id = $conn->insert_id;
        $employee_id = 1; //Session value//
        $desc = 'Item was Created';

        $stmt2->bind_param('ssss', $action, $desc, $item_id, $employee_id);
        if($stmt2->execute()){
            $result = 1;
        }
    }
}

echo $result;

$conn->close();
?>