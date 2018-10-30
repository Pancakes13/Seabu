<?php
require ("../panelsidebar.php");
require ("../panelheader.php");
?>
    
    <a href="stock.php"><button type="button" class="btn" style="margin-left:1.5%;">
        Back <i class="fa fa-toggle-left"></i>
    </button></a>

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title" id="title">Stock Transaction Log</strong>
                            </div>
                            <div class="card-body">
                                <table id="stock-table" class="table table-striped table-bordered"><thead>
                                    <tr>
                                        <th>Timestamp</th>
                                        <th>Item</th>
                                        <th>Action</th>
                                        <th>Current Stock</th>
                                        <th>Old Stock</th>
                                        <th>Quantity</th>
                                        <th>Performed By</th>
                                    </tr>
                            
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
  myTable = $('#stock-table').DataTable({
    "order": [[ 0, "desc" ]]
  });
  PopulateItemLogTable();
});
function PopulateItemLogTable() {
    $.ajax({
        method: "GET", url: "../queries/get/getStockTransactionLog.php", 
    }).done(function( data ) {
        var jsonObject = JSON.parse(data);
        var result = jsonObject.map(function (item) {
            var result = [];
            result.push(item.transaction_timestamp);
            result.push(item.name);
            result.push(item.type);
            result.push(item.item_qty);
            result.push(item.old_stock);
            result.push(item.qty); 
            result.push(item.first_name+" "+item.last_name);
            return result;
        });
        myTable.rows.add(result);
        myTable.draw();
    });
}

</script>
<?php
require ("../footer.php");
?>
