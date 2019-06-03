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
    
    <a href="stock.php"><button type="button" class="btn" style="margin-left:1.5%;">
        Back <i class="fa fa-toggle-left"></i>
    </button></a>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body col-md-8 offset-md-2" style="text-align:center;">
            <h2>Item Sales for <?php echo date("Y");?></h2>
            <canvas id="saleChart"></canvas>
          </div>
        </div>
      </div>
    </div>

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title" id="title"><?php echo $_GET['item_name'];?> Log</strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered"><thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Description</th>
                                        <th>Timestamp</th>
                                        <th>Performed By</th>
                                        <th>Branch Name</th>
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
  getInformation();
});
function PopulateItemLogTable() {
    $.ajax({
        method: "GET", url: "../queries/get/getItemLog.php?item_id="+<?php echo $_GET['item_id']?>, 
    }).done(function( data ) {
        var jsonObject = JSON.parse(data);
        var result = jsonObject.map(function (item) {
            var result = [];
            result.push(item.log_action);
            result.push(item.log_description);
            result.push(item.log_timestamp);  
            result.push(item.first_name+" "+item.last_name);
            result.push(item.branch_name);
            return result;
        });
        myTable.rows.add(result);
        myTable.draw();
    });
}

function getInformation() {
    var id = <?php echo $_GET['item_id'];?>;
    $.ajax({
    method: "POST", url: "../queries/get/getStockUsageMonthlyItem.php", 
    data: {"item": id},
  }).done(function( data ) {
    var jsonObject = JSON.parse(data);
    var ctx = document.getElementById( "saleChart" );
    //    ctx.height = 200;
    var myChart = new Chart( ctx, {
        type: 'pie',
        data: {
            labels: [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            datasets: [
                {
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
                    backgroundColor: [
						"#00ffff",
						"#00ff00",
						"#ffff00",
						"#ff3300",
						"#ff0066",
                        "#cc00cc",
                        "#0000ff",
                        "#669999",
                        "#4d4d00",
                        "#993333",
                        "#ffcc99",
                        "#cc99ff"
					],
                }
            ]
        }
    });
  });
}

</script>
<?php
require ("../footer.php");
?>
