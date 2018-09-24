<?php
require ("../panelsidebar.php");
require ("../panelheader.php");
?>
    
    <a href="employee.php"><button type="button" class="btn" style="margin-left:1.5%;">
        Back <i class="fa fa-toggle-left"></i>
    </button></a>

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title" id="title"><?php echo $_GET['employee_username'];?> Log</strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered"><thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Description</th>
                                        <th>Timestamp</th>
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
  myTable = $('#bootstrap-data-table').DataTable();
  PopulateItemLogTable();
});
function PopulateItemLogTable() {
    $.ajax({
        method: "GET", url: "../queries/get/getEmployeeLog.php?employee_id="+<?php echo $_GET['employee_id']?>, 
    }).done(function( data ) {
        var jsonObject = JSON.parse(data);
        var result = jsonObject.map(function (item) {
            var result = [];
            result.push(item.action);
            result.push(item.log_description);
            result.push(item.log_timestamp);  
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
