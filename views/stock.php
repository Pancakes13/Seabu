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
                            <strong class="card-title">Items in Stock</strong>
                            <button type="button" class="btn btn-success btn-sm" 
                              style="float:right;" data-toggle="modal" data-target="#addModal"
                              >
                              Add Item <i class="fa fa-plus"></i>
                            </button>
                        </div>
                        <div id="itemTable" class="card-body">
                  
                    
                        </div>
                    </div>
                </div>


                </div>
            </div><!-- .animated -->
        </div><!-- .content -->

        <!--Add Modal-->
        <div class="modal fade" id="addModal" aria-hidden="true">
          <form>
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="mediumModalLabel">Add Item</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <label>Item Name</label>
                    <input type="text" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Price</label>
                    <input type="number" class="form-control">
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  <button type="button" class="btn btn-success" type="submit">Add Item</button>
                </div>
              </div>
            </div>
          </form>
        </div>
        <!--END OF Add Modal-->

        <!--Edit Modal-->
        <div class="modal fade" id="editModal" aria-hidden="true">
          <form>
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="mediumModalLabel">Edit Item</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <label>Item Name</label>
                    <input type="text" class="form-control">
                  </div>
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <label for="price" class="control-label mb-1">Price</label>
                        <input class="form-control price" >
                      </div>
                    </div>
                    <div class="col-6">
                      <label for="stock" class="control-label mb-1">Current Stock</label>
                      <input class="form-control stock">
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  <button type="button" class="btn btn-warning" type="submit">Edit Item</button>
                </div>
              </div>
            </div>
          </form>
        </div>
        <!--END OF Edit Modal-->

        <!--Delete Modal-->
        <div class="modal fade" id="deleteModal" aria-hidden="true">
          <form>
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="mediumModalLabel">Delete Item</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  Are you sure you want to delete item?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  <button type="button" class="btn btn-danger" type="submit">Delete Item</button>
                </div>
              </div>
            </div>
          </form>
        </div>
        <!--END OF Delete Modal-->

    </div><!-- /#right-panel -->

    <!-- Right Panel -->
<script>
$(document).ready(function(){
  $.ajax({
      method: "GET", url: "../queries/get/getItems.php", 
    }).done(function( data ) {
    var result = $.parseJSON(data);
    var tbl = '<table id="bootstrap-data-table" class="table table-striped table-bordered"><thead>'
                  +'<tr>' 
                  +'<th>Item Name</th>'
                  +'<th>Price (Php)</th>'
                  +'<th>Current Stock (Pcs/Kg)</th>'
                  +'<th>Action</th>'
                  +'</tr>'
              +'</thead>'
              +'<tbody>';
    
    //from result create a string of data and append to the div
    $.each( result, function( key, value ) {
      tbl += '<tr>'
                +'<td>'+value["item_id"]+'</td>'
                +'<td>'+value["name"]+'</td>'
                +'<td>'+value["price"]+'</td>'
                +'<td>'+value["qty"]+'</td>'
              +'</tr>';
      });
      tbl += '</tbody></table>';

      $("#itemTable").html(tbl);
      $('#bootstrap-data-table').DataTable( {
      "columnDefs": [
          { "orderable": false, "targets": 3 }
        ]
    });
  });
});
</script>

<?php
require ("../footer.php");
?>