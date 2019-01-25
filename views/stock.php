<?php
require ("../panelsidebar.php");
require ("../panelheader.php");
?>
    

        <div class="content mt-3" style="width:40%;">
          Select Branch
          <select id="branch" class="form-control">
            <option value="1">Sugbo Mercado</option>
            <option value="2">The Market</option>
            <option value="3">Yellowcube</option>
          </select>
        </div>
        <div class="content mt-3">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <strong class="card-title">Items in Stock</strong>
                      <button type="button" class="btn btn-success" 
                      style="float:right;" data-toggle="modal" data-target="#addModal"
                      >
                        Add Item <i class="fa fa-plus"></i>
                      </button>
                    </div>
                  <div id="itemTable" class="card-body">
                    <table id="bootstrap-data-table" class="table table-striped table-bordered"><thead>
                      <tr>
                        <th>Item Name</th>
                        <th>Price (Php)</th>
                        <th>Current Stock (Pcs/Kg)</th>
                        <th style="width:20%;">Action</th>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!--Stock Modal-->
        <div class="modal fade" id="stockModal" aria-hidden="true">
          <form>
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="mediumModalLabel">Stock Management</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <input id="modelId" type="text" class="form-control" hidden>
                  <div class="form-group">
                    <label>Item Name</label>
                    <input id="stockModelName" type="text" class="form-control" readonly>
                  </div>
                  <div class="form-group">
                    <label>Current Stock</label>
                    <input id="modelStock" type="number" class="form-control" readonly>
                  </div>
                  <div class="form-group">
                    <label>Stock Management Type</label>
                    <select id="modelType" name="type" class="form-control">
                      <option value="Restock">Restock</option>
                      <option value="Damaged">Item Damaged</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Quantity</label>
                    <input id="modelQty" type="number" class="form-control">
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  <button type="button" class="btn btn-primary" type="submit" id="submitStock" data-dismiss="modal">Manage Stock</button>
                </div>
              </div>
            </div>
          </form>
        </div>
        <!--END OF Stock Modal-->

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
                    <input type="text" class="form-control" name="name" id="name">
                  </div>
                  <div class="form-group">
                    <label>Price</label>
                    <input type="number" class="form-control" name="price" id="price">
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  <button type="button" class="btn btn-success" type="submit" id="addBtn" data-dismiss="modal">Add Item</button>
                </div>
              </div>
            </div>
          </form>
        </div>
        <!--END OF Add Modal-->

        <!--Edit Modal-->
        <div id="editModal" class="modal fade" aria-hidden="true">
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
                <input id="modelId" type="text" class="form-control" hidden>
                  <div class="form-group">
                    <label>Item Name</label>
                    <input id="modelName" type="text" class="form-control">
                  </div>
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <label for="price" class="control-label mb-1">Price</label>
                        <input id="modelPrice" class="form-control price" type="number">
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="stock" class="control-label mb-1">Current Stock</label>
                        <input id="modelQty" class="form-control stock" type="number">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  <button id="submitEdit" class="btn btn-warning" type="submit" data-dismiss="modal">Edit Item</button>
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
                  Are you sure you want to delete 
                    <span id="delItemName"></span>
                  ?
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

    <!-- Right Panel -->
<script>
var myTable = "";
$(document).ready(function(){
  myTable = $('#bootstrap-data-table').DataTable();
  PopulateItemsTable();

  $("#branch").change(function(){
    myTable.clear();
    PopulateItemsTable();
  });
});
function PopulateItemsTable() {
    let id = $("#branch").val();

    $.ajax({
      method: "POST",
      url: "../queries/get/getItems.php",
      data: {"branch_id": id},
    }).done(function( data ) {
      var jsonObject = JSON.parse(data);
      var result = jsonObject.map(function (item) {
        var result = [];
        result.push(item.name);
        result.push(item.price);
        result.push(item.qty);
        result.push('<button type="button" class="btn btn-warning btn-sm editBtn" data-toggle="modal" data-target="#editModal" data-itemid="'+item.item_id+'" data-itemname="'+item.name+'" data-price="'+item.price+'" data-qty="'+item.qty+'"><i class="fa fa-edit"></i></button>'
          +'<button type="button" class="btn btn-danger btn-sm delBtn" data-itemid="'+item.item_id+'" data-itemname="'+item.name+'" ><i class="fa fa-trash"></i></button>'
          +'<button type="button" class="btn btn-primary btn-sm stockBtn" data-toggle="modal" data-target="#stockModal" data-itemid="'+item.item_id+'" data-itemname="'+item.name+'" data-qty="'+item.qty+'"><i class="fa fa-archive"></i></button>'
          +'<a href="item_logs.php?item_id='+item.item_id+'&item_name='+item.name+'"><button type="button" class="btn btn-secondary btn-sm"><i class="fa fa-eye"></i></button></a>');
        return result;
      });
      myTable.rows.add(result);
      myTable.draw();
    });
}
$("#addBtn").on('click', function(){ 
            var name  = $("#name").val();
  
            var price  = $("#price").val();
            
            var id = $("#branch").val();

            $.ajax({ 

              method: "POST",
              url: "../queries/insert/addItem.php",

              data: {"name": name, "price": price, "branch_id": id},

             }).done(function( data ) { 
                var result = $.parseJSON(data); 
    
                var str = '';

                if(result == 1) {

                  str = 'User record saved successfully.';
                
                }else{
                  str == 'All fields are required.';
                }

              $("#message").css('color', 'red').html(str);
              myTable.clear();
              PopulateItemsTable();
              swal(
                  'Success!',
                  'You have created an item!',
                  'success'
                )
              });
              
       }); 
        $(document).on('click', '#itemTable .delBtn', function(){ 
          const swalWithBootstrapButtons = swal.mixin({
            confirmButtonClass: 'btn btn-danger',
            cancelButtonClass: 'btn',
            buttonsStyling: false,
          })

          swalWithBootstrapButtons({
            title: 'Are you sure you want to delete this item?',
            text: $(this).data("itemname"),
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
          }).then((result) => {
            if (result.value) {
            var id  = $(this).data("itemid");
            $.ajax({ 

              method: "POST",
              url: "../queries/delete/deleteItem.php",

              data: {"item_id": id},

             }).done(function( data ) { 
                var result = $.parseJSON(data); 
    
                var str = '';
                myTable.clear();
                PopulateItemsTable();
                swalWithBootstrapButtons(
                  'Deleted!',
                  'Item has been deleted.',
                  'success'
                )
              });
              
            } else if (result.dismiss === swal.DismissReason.cancel) {
              swalWithBootstrapButtons(
                'Cancelled',
                'Item was not deleted',
                'error'
              )
            }
          })
        });

        $(document).on('click', '#itemTable .stockBtn', function(){ 
          var id  = $(this).data("itemid");
          var name = $(this).data("itemname")
          var qty  = $(this).data("qty");
          
          $("#modelId").val(id);
          $("#stockModelName").val(name);
          $("#modelStock").val(qty);
        });

        $(document).on('click', '#submitStock', function(){
          var id = $("#modelId").val();
          var type  = $("#modelType").val();
          var stock = $("#modelStock").val();
          var qty = $("#modelQty").val();
          
          if (type === 'Damaged') {
            qty *= -1;
          }
          $.ajax({ 
            method: "POST",
            url: "../queries/update/restock.php",
            data: {"item_id": id, "current_stock": stock, "type": type, "qty": qty},
          }).done(function( data ) { 
            var result = $.parseJSON(data); 

            myTable.clear();
            PopulateItemsTable();
            $("#modelQty").val('');
            swal(
                'Success!',
                'You have restocked an item!',
                'success'
              )
          });
        });

        $(document).on('click', '#itemTable .editBtn', function(){ 
          var id  = $(this).data("itemid");
          var name  = $(this).data("itemname");
          var price  = $(this).data("price");
          var qty  = $(this).data("qty");
          
          $("#modelId").val(id);
          $("#modelName.form-control").val(name);
          $("#modelPrice.price").val(price);
          $("#modelQty.stock").val(qty);
        });

        $(document).on('click', '#submitEdit', function(){
          var id = $("#modelId").val();
          var name  = $("#modelName.form-control").val();
          var price  = $("#modelPrice.price").val();
          var qty = $("#modelQty.stock").val();
            $.ajax({ 

              method: "POST",
              url: "../queries/update/updateItem.php",

              data: {"id": id, "name": name, "price": price, "qty": qty},

             }).done(function( data ) { 
                var result = $.parseJSON(data); 
    
              myTable.clear();
              PopulateItemsTable();
              swal(
                  'Success!',
                  'You have updated an item!',
                  'success'
                )
              });
              
        });
</script>

<?php
require ("../footer.php");
?>