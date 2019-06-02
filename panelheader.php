<?php
if ($_SESSION['isAdmin'] == 0) {
  $adminURLs =  array("stockTransfer.php", "stockUsage.php", "sales_logs.php",
                    "voidTransactions.php");
  $url = $_SERVER['REQUEST_URI'];
  $pos = strrpos($url, '/');
  $page = $pos === false ? $url : substr($url, $pos + 1);
  
  if(in_array($page, $adminURLs)) {
    header("Location: http://localhost/Seabu/views/home.php");
  }
}
?>
<!-- Right Panel -->

    <div id="right-panel" class="right-panel">

<!-- Header-->
<header id="header" class="header" style="background-color: #FF8C00; ">
    <div class="header-menu">
        <div class="col-sm-12">
            <div class="user-area dropdown float-right">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="user-avatar rounded-circle" src="../images/default.jpg" alt="User Avatar">
                </a>

                <div class="user-menu dropdown-menu">
                    <a class="nav-link" href="../queries/get/logoutEmployee.php"><i class="fa fa-power -off"></i>Logout</a>
                </div>
            </div>
        </div>
    </div>

</header>
