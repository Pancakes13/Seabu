<?php
session_start();
if($_SESSION['isAdmin'] == 1)
{
  require ("../panelsidebar-admin.php");
}
else
{
  require ("../panelsidebar-user.php");
}
require ("../panelheader.php");
?>
<div><h3><center>Inventory Management System</center></h3></div>
<br>
<div style="width:40%; margin-left:1%;">
  Select Branch
  <select id="branch" class="form-control">
  </select>
</div>

<div class="content mt-3">
  <div class="animated fadeIn">
      <div class="row">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                      <strong class="card-title" id="title">Profit</strong>
                  </div>
                  <div class="card-body">
                      <table id="profitTable" class="table table-bordered">
                          <tr>
                            <td>Total Gross Profit</td>
                            <td>Total Expenses</td>
                            <td>Net Profit</td>
                          </tr>
                        <tbody>
                          <tr>
                            <td id="grossProfit"></td>
                            <td id="totalExpenses"></td>
                            <td id="netProfit"></td>
                          </tr>
                        </tbody>
                      </table>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>

<div class="content mt-3">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h4>Monthly Tally for <?php echo date("Y");?></h4>
            <div id="earningBody">
              <canvas id="earningChart"></canvas>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h4>Expenses for <?php echo date("Y");?></h4>
            <div id="expenseBody">
              <canvas id="expenseChart"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="content mt-3">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="content mt-3">
            <div class="animated fadeIn">
              <div class="row">
                <div class="col-md-12">
                  <div class="card">
                    <div class="card-header">
                      <h4>Item Sales</h4>
                    </div>
                    <div class="row justify-content-md-center">
                      <div class="col-md-8 offset-md2">
                        <div id="itemSalesBody" class="card-body">
                          <canvas id="itemSalesChart"></canvas>
                        </div>
                      </div>
                    </div>
                    <div id="itemTable" class="card-body">
                      <table id="homeItemTable" class="table table-striped table-bordered"><thead>
                        <tr>
                          <th>Item Name</th>
                          <th>Price (Php)</th>
                          <th width="20%">Stock <span class="fa fa-question-circle-o" title="Current Stock (pc/Kg)"></span></th>
                          <th style="width:5%;">Action</th>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
var myTable = "";
var bdayTable = "";
$(document).ready(function(){
  initBranches();
  myTable = $('#homeItemTable').DataTable();
  bdayTable = $('#upcomingBirthdayTable').DataTable();
  getBirthdayTable();

  $("#branch").change(function(){
    myTable.clear();
    getInformation();
    $(document.getElementById( "earningChart")).remove();
    $('#earningBody').append('<canvas id="earningChart"><canvas>');
    $(document.getElementById( "expenseChart")).remove();
    $('#expenseBody').append('<canvas id="expenseChart"><canvas>');
    myTable.clear();
    PopulateItemsTable();
  });
});

function initBranches() {
  $.ajax({
    method: "POST",
    url: "../queries/get/getBranchesStores.php"
  }).done(function( data ) {
    var jsonObject = JSON.parse(data);
    var result = jsonObject.map(function (item) {
      $('#branch').append('<option value="'+item.branch_id+'">'+item.name+'</option>');
    });
    $("#branch_id").val($("#branch").val());
    getInformation();
    PopulateItemsTable();
    getProfit();
  });
}

function getInformation() {
  var exists = false;
  let id = $("#branch").val();
  
  $.ajax({
    method: "POST",
    url: "../queries/get/getTotalEarningsMonthly.php",
    data: {"branch_id": id},
  }).done(function( data ) {
    var jsonObject = JSON.parse(data);
    var ctx = document.getElementById( "earningChart" );
    //    ctx.height = 200;
    var myChart = new Chart( ctx, {
        type: 'bar',
        data: {
            labels: [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            datasets: [
                {
                    label: "Monthly Earnings",
                    data: [
                      jsonObject[0].janCnt,
                      jsonObject[0].febCnt,
                      jsonObject[0].marCnt,
                      jsonObject[0].aprCnt,
                      jsonObject[0].mayCnt,
                      jsonObject[0].junCnt,
                      jsonObject[0].julCnt,
                      jsonObject[0].augCnt,
                      jsonObject[0].sepCnt,
                      jsonObject[0].octCnt,
                      jsonObject[0].novCnt,
                      jsonObject[0].decCnt 
                    ],
                    borderColor: "rgba(0, 12, 255, 0.9)",
                    borderWidth: "0",
                    backgroundColor: "rgba(0, 123, 255, 0.5)"
                            }
                        ]
        },
        options: {
            scales: {
                yAxes: [ {
                    ticks: {
                        beginAtZero: true
                    }
                                } ]
            }
        }
    });
  });

  $.ajax({
    method: "GET", url: "../queries/get/getTotalExpensesMonthly.php",
  }).done(function( data ) {
    var jsonObject = JSON.parse(data);
    var ctx = document.getElementById( "expenseChart" );
    //    ctx.height = 200;
    var myChart = new Chart( ctx, {
        type: 'bar',
        data: {
            labels: [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            datasets: [
                {
                    label: "Monthly Expenses",
                    data: [
                      jsonObject[0].janCnt,
                      jsonObject[0].febCnt,
                      jsonObject[0].marCnt,
                      jsonObject[0].aprCnt,
                      jsonObject[0].mayCnt,
                      jsonObject[0].junCnt,
                      jsonObject[0].julCnt,
                      jsonObject[0].augCnt,
                      jsonObject[0].sepCnt,
                      jsonObject[0].octCnt,
                      jsonObject[0].novCnt,
                      jsonObject[0].decCnt 
                    ],
                    borderColor: "#00ff00",
                    borderWidth: "0",
                    backgroundColor: "#66ff66"
                            }
                        ]
        },
        options: {
            scales: {
                yAxes: [ {
                    ticks: {
                        beginAtZero: true
                    }
                                } ]
            }
        }
    });
  });
}

function getItemSales(item) {
  let id = $("#branch").val();

  $.ajax({
    method: "POST",
    url: "../queries/get/getStockUsageMonthlyItem.php",
    data: {"item": item, "branch_id": id},
  }).done(function( data ) {
    var jsonObject = JSON.parse(data);
    
    $(document.getElementById( "itemSalesChart")).remove();
    $('#itemSalesBody').append('<canvas id="itemSalesChart"><canvas>');
    var ctx = document.getElementById( "itemSalesChart" );
    var myChart = new Chart( ctx, {
        type: 'bar',
        data: {
            labels: [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            datasets: [
                {
                    label: "Monthly Item Sales",
                    data: [
                      jsonObject[0].janCnt,
                      jsonObject[0].febCnt,
                      jsonObject[0].marCnt,
                      jsonObject[0].aprCnt,
                      jsonObject[0].mayCnt,
                      jsonObject[0].junCnt,
                      jsonObject[0].julCnt,
                      jsonObject[0].augCnt,
                      jsonObject[0].sepCnt,
                      jsonObject[0].octCnt,
                      jsonObject[0].novCnt,
                      jsonObject[0].decCnt 
                    ],
                    borderColor: "#00ff00",
                    borderWidth: "0",
                    backgroundColor: "#66ff66"
                            }
                        ]
        },
        options: {
            scales: {
                yAxes: [ {
                    ticks: {
                        beginAtZero: true
                    }
                                } ]
            }
        }
    });
  });
}

function PopulateItemsTable() {
    let id = $("#branch").val();
    
    $.ajax({
      method: "POST",
      url: "../queries/get/getItems.php",
      data: {"branch_id": id},
    }).done(function( data ) {
      var jsonObject = JSON.parse(data);
      getItemSales(jsonObject[0].item_id);
      var result = jsonObject.map(function (item) {
        var result = [];
        result.push(item.name);
        result.push(item.price);
        result.push(item.qty);
        result.push('<button type="button" data-itemid="'+item.item_id+'" class="btn btn-primary btn-sm viewItemSales"> <i class="fa fa-eye"></i></button>');
        return result;
      });
      myTable.rows.add(result);
      myTable.draw();
    });
}

function getBirthdayTable() {
    let id = $("#branch").val();
    
    $.ajax({
      method: "POST",
      url: "../queries/get/getEmployeeBirthday.php"
    }).done(function( data ) {
      var jsonObject = JSON.parse(data);
      // getItemSales(jsonObject[0].item_id);
      var result = jsonObject.map(function (item) {
        var result = [];
        result.push(item.last_name + ', ' + item.first_name);
        result.push(item.birthdate);
        result.push(item.contact_no);
        result.push(item.name);
        return result;
      });
      bdayTable.rows.add(result);
      bdayTable.draw();
    });
}

$(document).on('click', '.viewItemSales', function(){
  getItemSales($(this).data("itemid"));
})

function getProfit() {
  $.ajax({
    method: "POST",
    url: "../queries/get/getProfitTimeframe.php",
    data: {"date1": '2018-12-01', "date2": '2019-12-31'},
  }).done(function( data ) {
    var jsonObject = JSON.parse(data);
    var result = jsonObject.map(function (item) {
      $('#grossProfit').html(item.total);
      $('#totalExpenses').html((parseFloat(item.totalExpenses) + parseFloat(item.fishExpenses)).toFixed(2));
      $('#netProfit').html(item.netProfit.toFixed(2));
    });
  });
}

</script>
<?php
require ("../footer.php");
?>
