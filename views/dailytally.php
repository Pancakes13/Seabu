<?php
require ("../panelsidebar.php");
require ("../panelheader.php");
?>
<div style="width:30%; margin-left:1%;">
  Select Branch
  <select id="branch" class="form-control">
    <option value="1">Sugbo Mercado</option>
    <option value="2">The Market</option>
    <option value="3">Yellowcube</option>
  </select>
</div>
<div class="form-group" style="width:30%; margin-left:1%; margin-top:2%;">
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

          <form id="dailyTally">
            <div id="smartwizard">
              <ul>
                <li><a href="#step-1">Step 1<br /><small>Enter Daily Tally</small></a></li>
                <li><a href="#step-2">Step 2<br /><small>Enter Money Denomination</small></a></li>
              </ul>
              <div>
                <div id="step-1" class="">
                  <div class="card">
                    <div class="card-header">
                      <strong class="card-title"><?php echo date("F d, Y (l)");?></strong>
                    </div>
                    <div class="card-body">
                      <table id="tallyTable" class="table">
                      </table>
                    </div>
                  </div>
                </div>

                <div id="step-2" class="">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="card">
                        <div class="card-header">
                          <strong class="card-title">Money Denomination</strong>
                        </div>
                        <div class="card-body">
                          <table id="moneyTable" class="table">
                            <tr>
                              <th>Money Value</th>
                              <th>Qty</th>
                              <th style="text-align:right;">Subtotal</th>
                            </tr>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              
              </div>
            </div>
          </form>
          
        </div>
      </div>
    </div>
  </div>
</div>

<!--Delete Modal-->
<div class="modal fade" id="voidModal" aria-hidden="true">
  <form>
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="mediumModalLabel">Void Transaction</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Are you sure you want to void this transaction?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button id="voidTally" type="submit" class="btn btn-danger" data-dismiss="modal">Void Transaction</button>
        </div>
      </div>
    </div>
  </form>
</div>
<!--END OF Delete Modal-->

<script>
var myTable = "";
var moneyTable = "";
var stock_transaction = 0;
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

  $(document).on('click', '#voidTally', function(){
    $.ajax({
      type: "POST",
      url: "../queries/delete/voidDailyTally.php",
      data: {"stock_transaction_id": stock_transaction},
    }).done(function( data ) {
      $('#tallyTable tr').remove();
      PopulateTallyTable();
      swal(
        'Success!',
        'You have voided the transaction!',
        'success'
      )
    })
  });

  $('#smartwizard').smartWizard({
    selected: 0,
    transitionEffect:'fade',
    toolbarSettings: {
      showPreviousButton: false,
      showNextButton: false
    },
    anchorSettings: {
      anchorClickable: false,
      removeDoneStepOnNavigateBack: false
    },
    keyNavigation: false
  });

  $("#branch").change(function(){
    $('#tallyTable tr').remove();
    PopulateTallyTable();
  });
});

function PopulateTallyTable() {
  var exists = false;
  let id = $("#branch").val();
  
  $.ajax({
    method: "POST", url: "../queries/get/getDailyTally.php",
    data: {"branch_id": id},
  }).done(function( data ) {
    var jsonObject = JSON.parse(data);
    if(jsonObject.length > 0){
      exists = true;
      myTable.append('<tr><th>Item Name</th>'
        +'<th>Price (Php)</th>'
        +'<th>Current Stock (Pcs/Kg)</th>'
        +'<th>Qty</th>'
        +'<th>Type</th>'
        +'<th style="text-align:right;">Subtotal</th>'
        +'</tr>');
      var result = jsonObject.map(function (item) {
      var result = [];
      stock_transaction = item.stock_transaction_id;
      myTable.append('<tr class="item"><td style="width:25%;">'+item.name+' <input name="item[]" value="'+item.item_id+'" hidden></td>'
        +'<td style="width:20%;"><input name="price[]" class="price form-control" type="number" value="'+item.price+'" readonly="true"></td>'
        +'<td><input name="current_stock[]" class="qty form-control" value="'+item.item_qty+'" readonly></td>'
        +'<td style="width:10%;"><input class="qty form-control" type="number" value="'+item.qty+'" readonly></td>'
        +'<td><input class="qty form-control" type="text" value="'+item.item_line_type+'" readonly></td>'
        +'<td class="subTotal" style="text-align:right;">'+item.price*item.qty+'</td></tr>');
    });
    var date  = new Date();
    var newDate = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
    myTable.append('<tr><td></td><td></td><td></td><td></td><td id="total"><strong>TOTAL</strong><td id="totalValue" style="text-align:right;">0</td></tr>');
    myTable.append('<tr><td></td><td></td><td></td><td></td><td></td><td style="text-align:right;"><button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#voidModal">Void Tally <i class="fa fa-trash"></i></button></td></tr>');

    var total = 0;
    $("tr.item").each(function() {
      $this = $(this);
      total += parseInt($this.find(".subTotal").html());
    });
    $("#totalValue").html(total);
    $('#smartwizard').smartWizard("reset");
    $('#smartwizard').smartWizard({
      selected: 0,
      transitionEffect:'fade',
      toolbarSettings: {
        toolbarPosition: 'bottom',
        toolbarButtonPosition: 'right',
        showPreviousButton: false
      },
      anchorSettings: {
        anchorClickable: false,
        removeDoneStepOnNavigateBack: false
      },
      lang: {
        next: 'Enter Money'
      },
      keyNavigation: false
    });
    } else {
      let id = $("#branch").val();
      
      $.ajax({
      method: "POST",
      url: "../queries/get/getItems.php",
      data: {"branch_id": id},
    }).done(function( data ) {
      var jsonObject = JSON.parse(data);
      myTable.append('<tr><th>Item Name</th>'
        +'<th>Price (Php)</th>'
        +'<th>Current Stock (Pcs/Kg)</th>'
        +'<th>Qty</th>'
        +'<th>Type</th>'
        +'<th style="text-align:right;">Subtotal</th>'
        +'</tr>');
      var result = jsonObject.map(function (item) {
        var result = [];
        myTable.append('<tr class="item"><td style="width:25%;">'+item.name+' <input name="item[]" value="'+item.item_id+'" hidden> <input name="stock_transaction_id" value="'+item.stock_transaction_id+'" hidden></td>'
          +'<td style="width:15%;"><input name="price[]" class="price form-control" type="number" value="'+item.price+'" readonly="true"></td>'
          +'<td><input name="current_stock[]" class="qty form-control" value="'+item.qty+'" readonly></td>'
          +'<td style="width:10%;"><input name="qty[]" class="qty form-control" type="number" value="0" min="0" max="'+item.qty+'"></td>'
          +'<td style="width:15%;"> <select name="type[]" class="form-control">'
          +'<option value="local">Local</option>'
          +'<option value="honestbee">Honestbee</option>'
          +'</select></td>'
          +'<td class="subTotal" style="text-align:right; font-weight:bold;">0</td></tr>');
      });
      myTable.append('<tr><td></td><td></td><td></td><td></td><td id="total"><strong>TOTAL</strong></td><td id="totalValue" style="text-align:right;">0</td></tr>');
      myTable.append('<tr><td></td><td></td><td></td><td></td><td><button id="next-btn" class="btn btn-primary" type="button">Enter Money Denomination</button></td><td></td></tr>');
      
      $("#next-btn").on("click", function() {
        $('#expectedEarnings').html($("#totalValue").html());
        $('#smartwizard').smartWizard("next");
      });
    });
    moneyTable = $('#moneyTable');
    PopulateMoneyDenominationTable();
    }
  });
}

function PopulateMoneyDenominationTable() {
  var exists = false;
  $.ajax({
    method: "GET", url: "../queries/get/getMoneyBill.php", 
  }).done(function( data ) {
    var jsonObject = JSON.parse(data);
    exists = true;
    var result = jsonObject.map(function (item) {
      var result = [];
      moneyTable.append('<tr class="moneyItem"><td style="width:40%;">'+item.money_value+'</td>'
        +'<td style="width:20%;"><input name="moneyQty[]" class="moneyQty form-control" type="number" value="0" min="0"> <input name="moneyId[]" value="'+item.money_bill_id+'" hidden> </td>'
        +'<td class="moneySubTotal" style="width:10%; text-align:right;">0</td></tr>');
    });
    moneyTable.append('<tr><td></td><td id="moneyTotal"><strong>TOTAL</strong></td><td id="moneyTotalValue" style="text-align:right;">0</td></tr>');
    moneyTable.append('<tr><td></td><td id="moneyTotal"><strong>EXPECTED EARNINGS</strong></td><td id="expectedEarnings" style="text-align:right;"></td></tr>');
    moneyTable.append('<tr><td></td><td></td><td><button class="btn btn-success" type="submit">Submit Daily Tally</button></td></tr>');
  })
}

$(document).on('change', ".qty",function () {
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

$(document).on('change', ".moneyQty",function () {
  var test1 = $(this).closest(".qty").val();
  var value = $(this).closest("td").parent()[0].cells[0].innerHTML;
  var qty = parseFloat($(this).closest("td").parent()[0].cells[1].children[0].value);
  $(this).closest("td").parent()[0].cells[2].innerHTML = qty*value;
   
   var total = 0;
  $("tr.moneyItem").each(function() {
    $this = $(this);
    total += parseFloat($this.find(".moneySubTotal").html());
  });
  $("#moneyTotalValue").html(total);
});

$("#searchBtn").on('click', function(){ 
  var date  = $("#searchDate").val();
  window.location = "editDailyTally.php?date="+date;
});
</script>
<?php
require ("../footer.php");
?>
