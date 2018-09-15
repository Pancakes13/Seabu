<?php
require("../../connection.php");
$name  = $_POST['name'];

$price  = $_POST['price'];


/* validate whether user has entered all values. */

if(!$name || !$price){

  $result = 2;

}else {

   //SQL query to get results from database
   $sql    = "INSERT into `item` (`name`, `price`) values (?, ?)  ";

   $stmt   = $conn->prepare($sql);

   $stmt->bind_param('ss', $name, $price);

   if($stmt->execute()){
     
        $result = 1;
     
   }

}

echo $result;

$conn->close();
?>
