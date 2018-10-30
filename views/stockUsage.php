<?php
require ("../panelsidebar.php");
require ("../panelheader.php");
?>
    
    <a href="stock.php"><button type="button" class="btn" style="margin-left:1.5%;">
        Back <i class="fa fa-toggle-left"></i>
    </button></a>
    <form id="searchStockUsage">
        <div class="form-group" style="width:40%; margin-left:1%; margin-top:3%;">
            <label class=" form-control-label">Start Date/End Date <i class="fa fa-calendar"></i></label>
            <div class="input-group">
                <input id="startDate" class="form-control" type="date" value="<?php echo date('1960-01-01');?>">
                <input id="endDate" class="form-control" type="date" value="<?php echo date('Y-m-d');?>">
                <button id="submit" class="input-group-addon"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title" id="title">Stock Transaction Log</strong>
                            </div>
                            <div class="card-body">
                                <table id="stockUsage-table" class="table table-bordered"><thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .animated -->
        </div><!-- .content -->

    </div><!-- /#right-panel -->

    <!-- Right Panel -->
<script>
var myTable = "";
$(document).ready(function(){
  myTable = $('#stockUsage-table');
  PopulateStockUsageTable();
  $('#searchStockUsage').submit(function(e) {
    e.preventDefault();
    PopulateStockUsageTable();
  });
});
function PopulateStockUsageTable() {
    $('#stockUsage-table tr').remove();
    date1 = $('#startDate').val();
    date2 = $('#endDate').val();
    
    $.ajax({
        method: "POST",
        url: "../queries/get/searchStockUsageLog.php",
        data: {"date1": date1, "date2": date2},
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
                +'<tr style="font-weight:bold"><td>Timestamp</td><td>Item</td><td>Action</td><td>Current Stock</td><td>Old Stock</td><td>Quantity</td><td>Performed By</td></tr>');
            }
            myTable.append('<tr class="item"><td>'+item.transaction_timestamp+'</td>'
            +'<td>'+item.name+'</td>'
            +'<td>'+item.type+'</td>'
            +'<td>'+item.item_qty+'</td>'
            +'<td>'+item.old_stock+'</td>'
            +'<td>'+item.qty+'</td>'
            +'<td>'+item.first_name+" "+item.last_name+'</td></tr>');
        });
    });
}

</script>
<?php
require ("../footer.php");
?>
