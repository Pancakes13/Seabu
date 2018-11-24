<?php
require("../../connection.php");

$stock_type = "Sold";
$emp_id = 1; //Session value//
$item  = $_POST['item']; 
$price = $_POST['price'];
$stock = $_POST['current_stock'];
$qty = $_POST['qty'];
$type = $_POST['type'];

if(!$stock_type || !$emp_id || !$item){

    $result = 2;
  
  }else{
    $tallyExists = $conn->query("SELECT `i`.`item_id`, `i`.`name`, `i`.`qty` AS 'item_qty', `il`.`price`, `il`.`qty`, `il`.`item_line_type`,
    `s`.`transaction_timestamp`, `s`.`type`
    FROM `stock_transaction` `s` 
    INNER JOIN `item_line` `il`
    ON  `s`.`stock_transaction_id` = `il`.`stock_transaction_id`
    INNER JOIN `item` `i`
    ON `il`.`item_id` = `i`.`item_id`
    AND DATE(`s`.`transaction_timestamp`) = CURDATE()
    AND `s`.`type` = 'Sold'");
    
    $result = 2;

    if($tallyExists->num_rows == 0){
      try{
        $conn->autocommit(false);
        //Insert Stock Transaction
        $sql    = "INSERT into `stock_transaction` (`type`, `employee_id`) values (?, ?)";
    
        $stmt   = $conn->prepare($sql);
        
        $stmt->bind_param('ss', $stock_type, $emp_id);
        
        $stmt->execute();
        //Insert Item Line
        $id = $conn->insert_id;

        for($x=0; $x<count($item); $x++){
          if($qty[$x]>0){
              echo $type[$x];
            $sql2    = "INSERT into `item_line` (`price`, `old_stock`, `qty`, `item_line_type`, `stock_transaction_id`, `item_id`) values (?, ?, ?, ?, ?, ?)  ";
        
            $stmt2   = $conn->prepare($sql2);
        
            $stmt2->bind_param('ssssss', $price[$x], $stock[$x], $qty[$x], $type[$x], $id, $item[$x]);
            $stmt2->execute();
            
            $sql3 = "UPDATE `item` 
            SET `qty` = (`qty` - ?)
            WHERE `item_id` = ?";
            
            $stmt3 = $conn->prepare($sql3);
            $stmt3->bind_param('ss', $qty[$x], $item[$x]);
            
            $stmt3->execute();
            $result = 1;
          }
        }
        $conn->commit();
        $conn->autocommit(true);
      }
      catch(Exception $ex){
        echo "Erro on inserting in daily tally process: " . $ex->getMessage();
      }
    }
  }

echo $result;

$conn->close();
?>
