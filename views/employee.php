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
                    <strong class="card-title">Employee List</strong>
                    <button type="button" class="btn btn-success" 
                    style="float:right;" data-toggle="modal" data-target="#addModal"
                    >
                      Add Employee <i class="fa fa-plus"></i>
                    </button>
                  </div>
                  <div id="itemTable" class="card-body">
                    <table id="bootstrap-data-table" class="table table-striped table-bordered"><thead>
                      <tr>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Branch Name</th>
                        <th>Email</th>
                        <th>Contact Number</th>
                        <th>Birthdate</th>
                        <th style="width:10%;">Action</th>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!--Add Modal-->
        <div class="modal fade" id="addModal" aria-hidden="true">
          <form id="addEmployee">
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
                    <label>First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name">
                  </div>
                  <div class="form-group">
                    <label>Middle Name</label>
                    <input type="text" class="form-control" id="middle_name" name="middle_name">
                  </div>
                  <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name">
                  </div>
                  <div class="form-group">
                    <label>Branch</label>
                    <select class="form-control" id="branch" name="branchName">
                      <option value="1">Sugbo Mercado</option>
                      <option value="2">The Market</option>
                      <option value="3">Yellowcube</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" id="email" name="email">
                  </div>
                  <div class="form-group">
                    <label>Contact Number</label>
                    <input type="text" class="form-control" id="contact_no" name="contact_num">
                  </div>
                  <div class="form-group">
                    <label>Birthdate</label>
                    <input type="date" class="form-control" id="birthdate" name="bday">
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-success">Add Employee</button>
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
                      <label>First Name</label>
                      <input type="text" class="form-control" id="model_fn">
                    </div>
                    <div class="form-group">
                      <label>Middle Name</label>
                      <input type="text" class="form-control" id="model_mn">
                    </div>
                    <div class="form-group">
                      <label>Last Name</label>
                      <input type="text" class="form-control" id="model_ln">
                    </div>
                    <div class="form-group">
                      <label>Branch Name</label>
                      <select type="text" class="form-control" id="model_branch">
                        <option value="1">Sugbo Mercado</option>
                        <option value="2">Option 2</option>
                        <option value="3">Option 3</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Email</label>
                      <input type="email" class="form-control" id="model_email">
                    </div>
                    <div class="form-group">
                      <label>Contact Number</label>
                      <input type="text" class="form-control" id="model_contact_no">
                    </div>
                    <div class="form-group">
                      <label>Birthdate</label>
                      <input type="date" class="form-control" id="model_birthdate">
                    </div>
                  </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  <button id="submitEdit" class="btn btn-warning" type="submit" data-dismiss="modal">Edit Employee</button>
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
                  <button type="button" class="btn btn-danger" type="submit">Delete Employee</button>
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

  $('#addEmployee').submit(function(e) {
    e.preventDefault(); 
    $.ajax({
      type: "POST",
      url: "../queries/insert/addEmployee.php",
      data: $(this).serialize(),
    }).done(function( data ) {
      $("#first_name").val('');
      $("#middle_name").val('');
      $("#last_name").val('');
      $("#email").val('');
      $("#contact_no").val('');
      $("#birthdate").val('');
      $("#password").val('');
      
      if (data == 'email already exists') {
        swal(
          'Error!',
          'Email already exists!',
          'error'
        )
      } else {
        var result = $.parseJSON(data);
        if (result == 1) {
          var str = '';
          $("#message").css('color', 'red').html(str);
          myTable.clear();
          PopulateItemsTable();
          swal(
            'Success!',
            'You have added an Employee!',
            'success'
          )
        } else if (result == 2) {
          swal(
            'Error!',
            'Missing a required field!',
            'error'
          )
        }
      }
    })
  });
});
function PopulateItemsTable() {
    $.ajax({
      method: "GET", url: "../queries/get/getEmployees.php", 
    }).done(function( data ) {
      var jsonObject = JSON.parse(data);
      var result = jsonObject.map(function (item) {
        var result = [];
        result.push(item.last_name);
        result.push(item.first_name);
        result.push(item.middle_name);
        result.push(item.name);
        result.push(item.email);
        result.push(item.contact_no);
        result.push(item.birthdate);
        result.push('<button type="button" class="btn btn-warning btn-sm editBtn" data-toggle="modal" data-target="#editModal"'
        +'data-employee_id="'+item.employee_id+'" data-last_name="'+item.last_name+'"'
        +'data-first_name="'+item.first_name+'" data-middle_name="'+item.middle_name+'"'
        +'data-name="'+item.name+'"'
        +'data-email="'+item.email+'" data-contact_no="'+item.contact_no+'" data-birthdate="'+item.birthdate+'">'
        +'<i class="fa fa-edit"></i></button>'
          +'<button type="button" class="btn btn-danger btn-sm delBtn" data-employee_id="'+item.employee_id+'" ><i class="fa fa-trash"></i></button>'
          +'<a href="employee_logs.php?employee_id='+item.employee_id+'"><button type="button" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></button></a>');
        return result;
      });
      myTable.rows.add(result);
      myTable.draw();
    });
}
        $(document).on('click', '#itemTable .delBtn', function(){ 
          const swalWithBootstrapButtons = swal.mixin({
            confirmButtonClass: 'btn btn-danger',
            cancelButtonClass: 'btn',
            buttonsStyling: false,
          })

          swalWithBootstrapButtons({
            title: 'Are you sure you want to delete this item?',
            text: $(this).data("first_name"),
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
          }).then((result) => {
            if (result.value) {
            var id  = $(this).data("employee_id");
            $.ajax({ 

              method: "POST",
              url: "../queries/delete/deleteEmployee.php",

              data: {"employee_id": id},

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

        $(document).on('click', '#itemTable .editBtn', function(){
          var id  = $(this).data("employee_id");
          var ln  = $(this).data("last_name");
          var mn  = $(this).data("middle_name");
          var fn  = $(this).data("first_name");
          var branch = $(this).data("name");
          var email  = $(this).data("email");
          var num  = $(this).data("contact_no");
          var birthdate  = $(this).data("birthdate");
          
          $("#modelId").val(id);
          $("#model_ln").val(ln);
          $("#model_mn").val(mn);
          $("#model_fn").val(fn);
          $('#model_branch option:contains("'+branch+'")').prop('selected',true);
          $("#model_email").val(email);
          $("#model_contact_no").val(num);
          $("#model_birthdate").val(birthdate);
        });

        $(document).on('click', '#submitEdit', function(){
          var id  = $("#modelId").val();
          var ln  = $("#model_ln").val();
          var mn  = $("#model_mn").val();
          var fn  = $("#model_fn").val();
          var branch  = $("#model_branch").children("option:selected").val();
          var email  = $("#model_email").val();
          var num  = $("#model_contact_no").val();
          var birthdate  = $("#model_birthdate").val();
          
            $.ajax({ 

              method: "POST",
              url: "../queries/update/updateEmployee.php",

              data: {"id": id, "first_name": fn, "middle_name": mn, "last_name": ln, "branch": branch, "email": email, "num": num, "birthdate": birthdate},

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