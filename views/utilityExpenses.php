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
    <div class="row justify-content-md-center">
      <div class="col-md-8 offset-md2">
        <div class="card">
          <div class="card-body">
            <h4>Expenses for <?php echo date("Y");?></h4>
            <canvas id="expenseChart"></canvas>
          </div>
        </div>
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
                    <strong class="card-title">Utility Expenses</strong>
                    <button type="button" class="btn btn-success" 
                    style="float:right;" data-toggle="modal" data-target="#addModal"
                    >
                      Add Expense <i class="fa fa-plus"></i>
                    </button>
                  </div>
                  <div id="itemTable" class="card-body">
                    <table id="expense-table" class="table table-striped table-bordered"><thead>
                      <tr>
                        <th>Timestamp</th>
                        <th>Expense Name</th>
                        <th>Description</th>
                        <th>Price (Php)</th>
                        <th>Noted By</th>
                        <th>Branch Name</th>
                        <th style="width:8%;">Action</th>
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
          <form id="addForm">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="mediumModalLabel">Add Expense</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <label>Expense Name</label>
                    <input type="text" class="form-control" id="name">
                  </div>
                  <div class="form-group">
                    <label>Price</label>
                    <input type="number" class="form-control" id="price">
                  </div>
                  <div class="form-group">
                    <label>Description</label>
                    <textarea rows="4" cols="50" class="form-control" id="description"></textarea>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  <button type="button" class="btn btn-success" type="submit" id="addBtn" data-dismiss="modal">Add Expense</button>
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
                    <label>Expense Name</label>
                    <input id="modelName" type="text" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Price</label>
                    <input id="modelPrice" type="number" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Description</label>
                    <textarea id="modelDesc" rows="4" cols="50" class="form-control" id="description"></textarea>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  <button id="submitEdit" type="button" class="btn btn-warning" type="button" data-dismiss="modal">Edit Item</button>
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
var form = document.getElementById("addForm");
$(document).ready(function(){
  myTable = $('#expense-table').DataTable({
    "order": [[ 0, "desc" ]]
  });
  getTotalExpenses();
  PopulateExpenseTable();
});

function getTotalExpenses() {
  $.ajax({
    method: "GET", url: "../queries/get/getTotalExpensesMonthlyUtility.php", 
  }).done(function( data ) {
    var jsonObject = JSON.parse(data);
    var ctx = document.getElementById( "expenseChart" );
    //    ctx.height = 200;
    var myChart = new Chart( ctx, {
        type: 'bar',
        data: {
            labels: [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            datasets: [
                {
                    label: "Monthly Expenses",
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
                    borderColor: "#00ff00",
                    borderWidth: "0",
                    backgroundColor: "#66ff66"
                            }
                        ]
        },
        options: {
            scales: {
                yAxes: [ {
                    ticks: {
                        beginAtZero: true
                    }
                                } ]
            }
        }
    });
  });
}

function PopulateExpenseTable() {
    $.ajax({
      method: "POST",
      url: "../queries/get/getExpenses.php",
      data: {"type": 'Utility'},
    }).done(function( data ) {
      var jsonObject = JSON.parse(data);
      var result = jsonObject.map(function (item) {
        var result = [];
        var f = new Date(item.expense_timestamp);
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
        result.push(month[f.getMonth()]+" "+f.getDate()+", "+f.getFullYear()+" "+f.getHours()+":"+f.getMinutes()+":"+f.getSeconds());
        result.push(item.name);
        result.push(item.description);
        result.push(item.price);
        result.push(item.first_name+" "+item.last_name);
        result.push(item.branch_name);
        result.push('<button type="button" class="btn btn-warning btn-sm editBtn" data-toggle="modal" data-target="#editModal" data-expense_id="'+item.expense_id+'" data-expense_name="'+item.name+'" data-price="'+item.price+'" data-desc="'+item.description+'"><i class="fa fa-edit"></i></button>'
          +'<button type="button" class="btn btn-danger btn-sm delBtn" data-expense_id="'+item.expense_id+'" data-expense_name="'+item.name+'" ><i class="fa fa-trash"></i></button>');
        return result;
      });
      myTable.rows.add(result);
      myTable.draw();
    });
}
$("#addBtn").on('click', function(){ 
            var name  = $("#name").val();
            var price  = $("#price").val();
            var description  = $("#description").val();
            
            $.ajax({ 

              method: "POST",
              url: "../queries/insert/addExpense.php",

              data: {"name": name, "desc": description, "price": price, "type": 'Utility'},

             }).done(function( data ) { 
                var result = $.parseJSON(data); 
    
                var str = '';

                if(result == 1) {

                  str = 'User record saved successfully.';
                
                }else{
                  str == 'All fields are required.';
                }

              myTable.clear();
              PopulateExpenseTable();
              getTotalExpenses();
              form.reset();
              swal(
                  'Success!',
                  'You have added an expense!',
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
            title: 'Are you sure you want to delete this expense?',
            text: $(this).data("expense_name"),
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
          }).then((result) => {
            if (result.value) {
            var id  = $(this).data("expense_id");
            $.ajax({ 

              method: "POST",
              url: "../queries/delete/deleteExpense.php",

              data: {"expense_id": id},

             }).done(function( data ) { 
                var result = $.parseJSON(data); 
    
                var str = '';
                myTable.clear();
                PopulateExpenseTable();
                getTotalExpenses();
                swalWithBootstrapButtons(
                  'Deleted!',
                  'Expense has been deleted.',
                  'success'
                )
              });
              
            } else if (result.dismiss === swal.DismissReason.cancel) {
              swalWithBootstrapButtons(
                'Cancelled',
                'Expense was not deleted',
                'error'
              )
            }
          })
        });

        $(document).on('click', '#itemTable .editBtn', function(){ 
          var id  = $(this).data("expense_id");
          var name  = $(this).data("expense_name");
          var price  = $(this).data("price");
          var desc  = $(this).data("desc");
          
          $("#modelId").val(id);
          $("#modelName.form-control").val(name);
          $("#modelPrice").val(price);
          $("#modelDesc").val(desc);
        });

        $(document).on('click', '#submitEdit', function(){
          var id = $("#modelId").val();
          var name = $("#modelName.form-control").val();
          var price = $("#modelPrice").val();
          var desc = $("#modelDesc").val();
          var type = "Utility";
          
          $.ajax({ 
            method: "POST",
            url: "../queries/update/updateExpense.php",
            data: {"id": id, "name": name, "price": price, "desc": desc, "type": type},
          }).done(function( data ) { 
            var result = $.parseJSON(data); 
            myTable.clear();
            PopulateExpenseTable();
            getTotalExpenses();
            swal(
                'Success!',
                'You have added an expense!',
                'success'
              )
          });     
        });
</script>

<?php
require ("../footer.php");
?>