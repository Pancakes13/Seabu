<?php
require("../../connection.php");
session_start();
$branch = $_POST['branch_id'];

$name  = (strlen($_POST['name']) <= 50) ? $_POST['name'] : null;

$price  = ((float)$_POST['price']) ? $_POST['price'] : null;

/* validate whether user has entered all values. */

if(!$name || !$price || ($price < 0 && $branch != 10)){

  $result = 2;

}else{
    try{
        $conn->autocommit(false);
        //Insert Item
        $sql    = "INSERT into `item` (`name`, `price`) values (?, ?)";

        $stmt   = $conn->prepare($sql);
        $stmt->bind_param('ss', $name, $price);
        $stmt->execute();

        $action = 'Create';
        $item_id = $conn->insert_id;
        $employee_id = $_SESSION["user_id"];
        $desc = 'Item was Created';

        $branchList = $conn->query("SELECT *
        FROM `branch`");

        if($branchList->num_rows > 0){
            while($b = $branchList->fetch_assoc()) {
                $insertBranchItem = "INSERT INTO `branch_item` (`branch_id`, `item_id`) values (?, ?)";
                $branchItemStmt = $conn->prepare($insertBranchItem);
                $branchItemStmt->bind_param('ss', $b['branch_id'], $item_id);
                $branchItemStmt->execute();
            }

        }
        //Insert Item Log
        $sql2    = "INSERT into `item_log` (`log_action`, `log_description`, `item_id`, `employee_id`) values (?, ?, ?, ?)  ";

        $stmt2   = $conn->prepare($sql2);

        $stmt2->bind_param('ssss', $action, $desc, $item_id, $employee_id);
        $stmt2->execute();
        
        $result = 1;
        $conn->commit();
        $conn->autocommit(true);
    }
    catch(Exception $ex){
        echo "Error on item insert: " . $ex->getMessage();
    }
}

echo $result;

$conn->close();
?>