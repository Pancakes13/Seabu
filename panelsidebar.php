<!doctype html>
<html class="no-js" lang=""> 
<?php
    require ("assets/stylesheets.php");
?>
<body>
        <!-- Left Panel -->

    <aside id="left-panel" class="left-panel" style="background-color: #076369;">
        <nav class="navbar navbar-expand-sm navbar-default"style="background-color: #076369;">

            <div class="navbar-header" style="background-color: white;">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./"><img src="../images/seabu-logo.png" alt="Logo"></a>
                <a class="navbar-brand hidden" href="./"><img src="../images/logo2.png" alt="Logo"></a>
            </div>

           <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="home.php"> <i class="menu-icon fa fa-home"></i>Home </a>
                    </li>
                    <h3 class="menu-title" style="color: white;">Menu</h3><!-- /.menu-title -->
                    <!-- Tree Menu sample
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Tally</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-table"></i><a href="view-invent.html">View Tally</a></li>
                            <li><i class="fa fa-table"></i><a href="input-invent.php">Input Tally</a></li>          
                        </ul>
                    </li>
                    -->
                    <li>
                        <a href="dailytally.php"> <i class="menu-icon fa fa-calendar-plus-o"></i>Daily Tally</a>
                    </li>
                    <li>
                        <a href="stock.php"> <i class="menu-icon fa fa-cutlery"></i>Stock</a>
                    </li>
                    <!--
                    <li>
                        <a href="yearlytotals.php"> <i class="menu-icon fa fa-area-chart"></i>Yearly Totals</a>
                    </li>
                    -->
                    <li>
                        <a href="stockUsage.php"> <i class="menu-icon fa fa-cart-arrow-down"></i>Stock Usage</a>
                    </li>

                    <li>
                        <a href="stock_logs.php"> <i class="menu-icon fa fa-book"></i>Stock Logs</a>
                    </li>

                    <li>
                        <a href="expenses.php"> <i class="menu-icon fa fa-money"></i>Expenses</a>
                    </li>

                    <li>
                        <a href="employee.php"> <i class="menu-icon fa fa-group"></i>Employee</a>
                    </li>
                    

                    <!--
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-th"></i>Forms</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-th"></i><a href="forms-basic.html">Basic Form</a></li>
                            <li><i class="menu-icon fa fa-th"></i><a href="forms-advanced.html">Advanced Form</a></li>
                        </ul>
                    </li>
                    -->
                    
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->
