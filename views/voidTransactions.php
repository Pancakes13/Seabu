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
        <div class="content mt-3">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <strong class="card-title">Voided Transactions</strong>
                  </div>
                  <div id="itemTable" class="card-body">
                    <table id="bootstrap-data-table" class="table table-striped table-bordered"><thead>
                      <tr>
                        <th>Void Timestamp</th>
                        <th>Performed By</th>
                        <th>Branch</th>
                        <th>Transaction Timestamp</th>
                        <th>Employee</th>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

    <!-- Right Panel -->
<script>
var myTable = "";
$(document).ready(function(){
  myTable = $('#bootstrap-data-table').DataTable();
  PopulateItemsTable();
});
function PopulateItemsTable() {
    $.ajax({
      method: "GET",
      url: "../queries/get/getVoidedTransactions.php",
    }).done(function( data ) {
      var jsonObject = JSON.parse(data);
      var result = jsonObject.map(function (item) {
        var result = [];
        result.push(item.dateVoid);
        result.push(item.void_first_name + ' ' + item.void_last_name);
        result.push(item.branch_name)
        result.push(item.transaction_timestamp);
        result.push(item.first_name + ' ' + item.last_name);
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