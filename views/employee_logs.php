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
                            <strong class="card-title">Cheezy Scallops Log</strong>
                            
                        </div>
                        <div class="card-body">
                  <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>Action</th>
                        <th>Timestamp</th>
                        <th>Description</th>
                        <th>Performed By</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Updated</td>
                            <td>12/09/2018 09:53:20</td>
                            <td>Updated the name of the item</td>
                            <td>John Doe</td>
                        </tr>
                        <tr>
                            <td>Created</td>
                            <td>12/09/2018 09:40:00</td>
                            <td>Created the item</td>
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
