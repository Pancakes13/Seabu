<?php
require ("../panelsidebar.php");
require ("../panelheader.php");
?>
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <a href="dailytally.php"><button class="btn btn-primary"><i class="fa fa-toggle-left"></i> Go Back</button></a>
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title"><?php echo date("F d, Y (l)", strtotime($_GET['date']));?></strong>
                        <input id="searchDate" value="<?php echo $_GET['date'];?>" hidden="true">
                    </div>
                    <div class="card-body">
                        <form id="dailyTally">
                            <table id="tallyTable" class="table">
                                <tr>
                                    <th>Item Name</th>
                                    <th>Price (Php)</th>
                                    <th>Qty</th>
                                    <th>Type</th>
                                    <th style="text-align:right;">Subtotal</th>
                                    <th style="text-align:right;">Action</th>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Add to Tally</strong>
                    </div>
                    <div class="card-body">
                        <form id="newDailyTally">
                            <table id="newTallyTable" class="table">
                                <tr>
                                    <th>Item Name</th>
                                    <th>Price (Php)</th>
                                    <th>Current Stock (Pcs/Kg)</th>
                                    <th>Qty</th>
                                    <th>Type</th>
                                    <th style="text-align:right;">Subtotal</th>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
var myTable = "";
var newTable = "";
$(document).ready(function(){
  myTable = $('#tallyTable');
  newTable = $('#newTallyTable');
  PopulateTallyTable();
  PopulateNewTallyTable();
  $('#dailyTally').submit(function(e) {
    e.preventDefault(); 
    $.ajax({
      type: "POST",
      url: "../queries/update/updateDailyTally.php",
      data: $(this).serialize(),
    }).done(function( data ) {
      $('#tallyTable tr').remove();
      PopulateTallyTable();
      swal(
        'Success!',
        'You have updated the daily tally!',
        'success'
      )
    })
  }); 
});

function PopulateTallyTable() {
  var date = $("#searchDate").val();
  $.ajax({
    method: "POST",
    url: "../queries/get/searchDailyTally.php",
    data: {"date": date},
  }).done(function( data ) {
    var jsonObject = JSON.parse(data);
    var result = jsonObject.map(function (item) {
    var result = [];
    myTable.append('<tr class="item"><td style="width:40%;">'+item.name+' <input name="item[]" value="'+item.item_id+'" hidden> <input name="item_line_id[]" value="'+item.item_line_id+'" hidden> <input name="stock_transaction_id" value="'+item.stock_transaction_id+'" hidden></td>'
        +'<td style="width:20%;"><input name="price[]" class="price form-control" type="number" value="'+item.price+'" readonly="true"></td>'
        +'<td style="width:10%;"><input name="qty[]" class="qty form-control" type="number" value="'+item.qty+'" min="1"></td>'
        +'<td><input name="type[]" class="qty form-control" type="text" value="'+item.item_line_type+'"></td>'
        +'<td class="subTotal" style="text-align:right;">'+item.price*item.qty+'</td>'
        +'<td class="action" style="width:5%; text-align:right;"><button type="button" class="btn btn-danger btn-sm delBtn" data-itemlineid="'+item.item_line_id+'" data-itemname="'+item.name+'" ><i class="fa fa-trash"></i></button></td></tr>');
    });
    myTable.append('<tr><td></td><td></td><td></td><td></td><td id="total" style="text-align:right;"><strong>TOTAL</strong><td id="totalValue" style="text-align:right;">0</td></tr>');
    myTable.append('<tr><td></td><td></td><td></td><td><td><td><button type="submit" class="btn btn-warning btn-sm">Edit Tally <i class="fa fa-edit"></i></button></td></tr>');

    var total = 0;
    $("tr.item").each(function() {
      $this = $(this);
      total += parseInt($this.find(".subTotal").html());
    });
    $("#totalValue").html(total);
  });
}

function PopulateNewTallyTable() {
  var date = $("#searchDate").val();
  $.ajax({
    method: "POST",
    url: "../queries/get/getItemsNotInTally.php",
    data: {"date": date},
  }).done(function( data ) {
    var jsonObject = JSON.parse(data);
      var result = jsonObject.map(function (item) {
        var result = [];
        newTable.append('<tr class="item"><td style="width:40%;">'+item.name+' <input name="item[]" value="'+item.item_id+'" hidden></td>'
          +'<td style="width:20%;"><input name="price[]" class="price form-control" type="number" value="'+item.price+'" readonly="true"></td>'
          +'<td><input class="qty form-control" value="'+item.qty+'" readonly></td>'
          +'<td style="width:10%;"><input name="qty[]" class="qty form-control" type="number" value="0" min="0" max="'+item.qty+'"></td>'
          +'<td> <select name="type[]" class="form-control">'
          +'<option value="local">Local</option>'
          +'<option value="honestbee">Honestbee</option>'
          +'</select></td>'
          +'<td class="subTotal" style="width:10%; text-align:right;">0</td></tr>');
      });
      newTable.append('<tr><td></td><td></td><td></td><td id="total"><strong>TOTAL</strong><td id="totalValue" style="text-align:right;">0</td></tr>');
      newTable.append('<tr><td></td><td></td><td></td><td><td><button class="btn btn-success" type="submit">Submit Daily Tally</button></td></tr>');
    var total = 0;
    $("tr.item").each(function() {
      $this = $(this);
      total += parseInt($this.find(".subTotal").html());
    });
    $("#totalValue").html(total);
  });
}

$(document).on('change', ".qty",function () {
    var numRows = $('#tallyTable tr').length;
    var test1 = $(this).closest(".qty").val();
    var qty = parseInt($(this).closest("td").parent()[0].cells[1].children[0].value);
    var price = parseInt($(this).closest("td").parent()[0].cells[2].children[0].value);
    $(this).closest("td").parent()[0].cells[4].innerHTML = qty*price;
    
    var total = 0;
    $("tr.item").each(function() {
        $this = $(this);
        total += parseInt($this.find(".subTotal").html());
    });
    $("#totalValue").html(total);
});

$(document).on('click', '#tallyTable .delBtn', function(){ 
    const swalWithBootstrapButtons = swal.mixin({
        confirmButtonClass: 'btn btn-danger',
        cancelButtonClass: 'btn',
        buttonsStyling: false,
    })

    swalWithBootstrapButtons({
        title: 'Are you sure you want to delete this item line?',
        text: $(this).data("itemname"),
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            var id  = $(this).data("itemlineid");
            $.ajax({ 
                method: "POST",
                url: "../queries/delete/deleteItemLine.php",
                data: {"item_line_id": id},

            }).done(function( data ) { 
                var result = $.parseJSON(data); 
    
                var str = '';
                myTable.empty();
                PopulateTallyTable();
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

</script>
<?php
require ("../footer.php");
?>
