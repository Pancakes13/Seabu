<?php
require ("../panelsidebar.php");
require ("../panelheader.php");
?>

<div class="form-group" style="width:30%; margin-left:1%; margin-top:3%;">
  <label class=" form-control-label">Search Tally By Date <i class="fa fa-calendar"></i></label>
  <div class="input-group">
    <input id="searchDate" class="form-control" type="date" value="<?php echo date('Y-m-d');?>">
    <button id="searchBtn" class="input-group-addon"><i class="fa fa-search"></i></button>
  </div>
</div>

<div class="content mt-3">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <strong class="card-title"><?php echo date("F d, Y (l)");?></strong>
          </div>
          <div class="card-body">
            <form id="dailyTally">
              <table id="tallyTable" class="table">
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
$(document).ready(function(){
  myTable = $('#tallyTable');
  PopulateTallyTable();

  $('#dailyTally').submit(function(e) {
    e.preventDefault(); 
    $.ajax({
      type: "POST",
      url: "../queries/insert/addDailyTally.php",
      data: $(this).serialize(),
    }).done(function( data ) {
      $('#tallyTable tr').remove();
      PopulateTallyTable();
      swal(
        'Success!',
        'You have submitted the daily tally!',
        'success'
      )
    })
  });

});

function PopulateTallyTable() {
  var exists = false;
  $.ajax({
    method: "GET", url: "../queries/get/getDailyTally.php", 
  }).done(function( data ) {
    var jsonObject = JSON.parse(data);
    if(jsonObject.length > 0){
      exists = true;
      var result = jsonObject.map(function (item) {
      var result = [];
      myTable.append('<tr class="item"><td style="width:40%;">'+item.name+' <input name="item[]" value="'+item.item_id+'" hidden></td>'
        +'<td style="width:20%;"><input name="price[]" class="price form-control" type="number" value="'+item.price+'" readonly="true"></td>'
        +'<td><input class="qty form-control" value="'+item.item_qty+'" readonly></td>'
        +'<td style="width:10%;"><input class="qty form-control" type="number" value="'+item.qty+'" readonly></td>'
        +'<td><input class="qty form-control" type="text" value="'+item.item_line_type+'" readonly></td>'
        +'<td class="subTotal" style="width:10%; text-align:right;">'+item.price*item.qty+'</td></tr>');
    });
    var date  = new Date();
    var newDate = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
    myTable.append('<tr><td></td><td></td><td></td><td id="total"><strong>TOTAL</strong><td id="totalValue" style="text-align:right;">0</td></tr>');
    myTable.append('<tr><td></td><td></td><td></td><td><td style="text-align:right;"><a href="editDailyTally.php?date='+newDate+'"><button type="button" class="btn btn-warning btn-sm">Edit Tally <i class="fa fa-edit"></i></button></a></td></tr>');

    var total = 0;
    $("tr.item").each(function() {
      $this = $(this);
      total += parseInt($this.find(".subTotal").html());
    });
    $("#totalValue").html(total);
    }else{
      $.ajax({
      method: "GET", url: "../queries/get/getItems.php", 
    }).done(function( data ) {
      var jsonObject = JSON.parse(data);
      var result = jsonObject.map(function (item) {
        var result = [];
        myTable.append('<tr class="item"><td style="width:40%;">'+item.name+' <input name="item[]" value="'+item.item_id+'" hidden> <input name="stock_transaction_id" value="'+item.stock_transaction_id+'"></td>'
          +'<td style="width:20%;"><input name="price[]" class="price form-control" type="number" value="'+item.price+'" readonly="true"></td>'
          +'<td><input class="qty form-control" value="'+item.qty+'" readonly></td>'
          +'<td style="width:10%;"><input name="qty[]" class="qty form-control" type="number" value="0" min="0" max="'+item.qty+'"></td>'
          +'<td> <select name="type[]" class="form-control">'
          +'<option value="local">Local</option>'
          +'<option value="honestbee">Honestbee</option>'
          +'</select></td>'
          +'<td class="subTotal" style="width:10%; text-align:right;">0</td></tr>');
      });
      myTable.append('<tr><td></td><td></td><td></td><td id="total"><strong>TOTAL</strong><td id="totalValue" style="text-align:right;">0</td></tr>');
      myTable.append('<tr><td></td><td></td><td></td><td><td><button class="btn btn-success" type="submit">Submit Daily Tally</button></td></tr>');
    });
    }
  });
}

$(document).on('change', ".qty",function () {
  var numRows = $('#tallyTable tr').length;
  var test1 = $(this).closest(".qty").val();
  var qty = parseInt($(this).closest("td").parent()[0].cells[1].children[0].value);
  var price = parseInt($(this).closest("td").parent()[0].cells[3].children[0].value);
  $(this).closest("td").parent()[0].cells[5].innerHTML = qty*price;
          
  var total = 0;
  $("tr.item").each(function() {
    $this = $(this);
    total += parseInt($this.find(".subTotal").html());
  });
  $("#totalValue").html(total);
});

$("#searchBtn").on('click', function(){ 
  var date  = $("#searchDate").val();
  window.location = "editDailyTally.php?date="+date;
}); 

</script>
<?php
require ("../footer.php");
?>
