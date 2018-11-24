<?php
require ("../panelsidebar.php");
require ("../panelheader.php");
?>
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title" id="title">Stock Transaction Log</strong>
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
  PopulateItemLogTable();
});
function PopulateItemLogTable() {
    $('#salesLogs-table tr').remove();
    $.ajax({
        method: "GET", url: "../queries/get/getStockTransactionLog.php", 
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

</script>
<?php
require ("../footer.php");
?>
