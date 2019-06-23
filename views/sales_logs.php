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
    <div class="content mt-3" style="width:40%;">
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
                            <strong class="card-title" id="title">Stock Transaction Log</strong>
                            <a href="#" id="export"><button style="float:right;" type="button" id="printButton" class="btn btn-info">Export to CSV <i class="fa fa-print"></i></button></a>
                        </div>
                        <div class="card-body">
                            <table id="salesLogs-table" class="table table-bordered"><thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .animated -->
    </div><!-- .content -->

<script>
var myTable = "";
$(document).ready(function(){
  myTable = $('#salesLogs-table');
  initBranches();

  $("#branch").change(function(){
    $('#salesLogs-table tr').remove();
    PopulateItemLogTable();
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
    PopulateItemLogTable();
  });
}


function PopulateItemLogTable() {
    $('#salesLogs-table tr').remove();
    let id = $("#branch").val();
    $.ajax({
        method: "POST",
        url: "../queries/get/getStockTransactionLog.php",
        data: {"branch_id": id}
    }).done(function( data ) {
        var jsonObject = JSON.parse(data);
        var lastTimestamp = "";
        var result = jsonObject.map(function (item) {
            var result = [];
            if(lastTimestamp != item.dateToday){
                lastTimestamp = item.dateToday;

                var f = new Date(lastTimestamp);
                var month = new Array();
                month[0] = "January";
                month[1] = "February";
                month[2] = "March";
                month[3] = "April";
                month[4] = "May";
                month[5] = "June";
                month[6] = "July";
                month[7] = "August";
                month[8] = "September";
                month[9] = "October";
                month[10] = "November";
                month[11] = "December";
                
                myTable.append('<tr style="background-color:#f2f2f2"><td><strong>'+month[f.getMonth()]+" "+f.getDate()+", "+f.getFullYear()+'</strong></td>'
                +'<td></td><td></td><td></td><td></td><td></td><td></td></tr>'
                +'<tr style="font-weight:bold"><td>Timestamp</td><td>Item</td><td>Price</td><td>Served</td><td>Gross Profit</td><td>Performed By</td><td>Branch Name</td></tr>');
            }
            myTable.append('<tr class="item"><td>'+item.transaction_timestamp+'</td>'
            +'<td>'+item.name+'</td>'
            +'<td>'+item.price+'</td>'
            +'<td>'+item.qty+'</td>'
            +'<td>'+item.gross_profit+'</td>'
            +'<td>'+item.first_name+" "+item.last_name+'</td>'
            +'<td>'+item.branch_name+'</td></tr>');
        });
    });
}

$("#export").on('click', function(){
  var $row = $('#tallyTable tr:first').find("th:visible");
  $fileName = 'Sales.csv';
  exportStockUsage.apply(this, [$('#salesLogs-table'), $fileName]);
});

</script>
<?php
require ("../footer.php");
?>
