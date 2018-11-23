<?php
require ("../panelsidebar.php");
require ("../panelheader.php");
?>
<div class="content mt-3">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <h4>Monthly Tally for <?php echo date("Y");?></h4>
            <canvas id="earningChart"></canvas>
          </div>

          <div class="card-body">
            <h4>Expenses for <?php echo date("Y");?></h4>
            <canvas id="expenseChart"></canvas>
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
                    <div id="itemSalesBody" class="card-body">
                      <canvas id="itemSalesChart"></canvas>
                    </div>
                    <div id="itemTable" class="card-body">
                      <table id="homeItemTable" class="table table-striped table-bordered"><thead>
                        <tr>
                          <th>Item Name</th>
                          <th>Price (Php)</th>
                          <th>Current Stock (Pcs/Kg)</th>
                          <th style="width:15%;">Action</th>
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
$(document).ready(function(){
  getInformation();
  myTable = $('#homeItemTable').DataTable();
  PopulateItemsTable();
});

function getInformation() {
  var exists = false;
  $.ajax({
    method: "GET", url: "../queries/get/getTotalEarningsMonthly.php", 
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
  getItemSales(1);
}

function getItemSales(item) {
  $.ajax({
    method: "POST",
    url: "../queries/get/getStockUsageMonthlyItem.php",
    data: {"item": item},
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
    $.ajax({
      method: "GET", url: "../queries/get/getItems.php", 
    }).done(function( data ) {
      var jsonObject = JSON.parse(data);
      var result = jsonObject.map(function (item) {
        var result = [];
        result.push(item.name);
        result.push(item.price);
        result.push(item.qty);
        result.push('<button type="button" data-itemid="'+item.item_id+'" class="btn btn-primary btn-sm viewItemSales"> View Item <i class="fa fa-eye"></i></button>');
        return result;
      });
      myTable.rows.add(result);
      myTable.draw();
    });
}

$(document).on('click', '.viewItemSales', function(){
  getItemSales($(this).data("itemid"));
})

</script>
<?php
require ("../footer.php");
?>
