<?php
require("../../connection.php");

$stock_type = "Sold";
$emp_id = 1; //Session value//

if(!$stock_type || !$emp_id){

    $result = 2;
  
  }else{
      //Insert Stock Transaction
      $sql    = "INSERT into `stock_transaction` (`type`, `employee_id`) values (?, ?)";
  
      $stmt   = $conn->prepare($sql);
      
      $stmt->bind_param('ss', $stock_type, $emp_id);
      
      if($stmt->execute()){
        //Insert Item Line
        $id = $conn->insert_id;
        $item  = $_POST['item'];
        $price = $_POST['price'];
        $qty = $_POST['qty'];
        $type = $_POST['type'];
        for($x=0; $x<count($item); $x++){
          if($qty[$x]>0){
              echo $type[$x];
            $sql2    = "INSERT into `item_line` (`price`, `qty`, `item_line_type`, `stock_transaction_id`, `item_id`) values (?, ?, ?, ?, ?)  ";
        
            $stmt2   = $conn->prepare($sql2);
        
            $stmt2->bind_param('sssss', $price[$x], $qty[$x], $type[$x], $id, $item[$x]);
            if($stmt2->execute()){
                $result = 1;
            }
          }
        }
        
      }
  }

echo $result;

$conn->close();
?>
