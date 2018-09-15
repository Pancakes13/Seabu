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
                            <strong class="card-title">Cheezy Scallops Log</strong>
                            
                        </div>
                        <div class="card-body">
                  <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>Item Name</th>
                        <th>Action</th>
                        <th>Timestamp</th>
                        <th>Qty</th>
                        <th>Performed By</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Cheezy Scallops</td>
                            <td>Restock</td>
                            <td>12/09/2018 09:40:00</td>
                            <td>30</td>
                            <td>John Doe</td>
                        </tr>
                        <tr>
                            <td>Cheezy Scallops</td>
                            <td>Served</td>
                            <td>12/09/2018 09:50:00</td>
                            <td>14</td>
                            <td>John Doe</td>
                        </tr>
                      
                    </tbody>
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
$('#bootstrap-data-table').DataTable( {
"columnDefs": [
    { "orderable": false, "targets": 3 }
  ]
  });
</script>
<?php
require ("../footer.php");
?>
