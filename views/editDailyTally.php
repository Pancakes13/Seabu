<?php
require ("../panelsidebar.php");
require ("../panelheader.php");
?>

<div style="width:40%; margin-left:1%;">
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
      <a href="dailytally.php"><button class="btn btn-primary"><i class="fa fa-toggle-left"></i> Go Back</button></a> 
        <div class="card">
          <form id="dailyTally">
            <div class="card">
              <div class="card-header">
                  <strong class="card-title"><?php echo date("F d, Y (l)", strtotime($_GET['date']));?></strong>
                  <input id="searchDate" value="<?php echo $_GET['date'];?>" hidden="true">
                  <input id="searchBranch" value="<?php echo $_GET['branch_id'];?>" hidden="true">
              </div>
              <div id="editDailyTallyCard" class="card-body">
                <table id="tallyTable" class="table">
                    <tr>
                        <th>Item Name</th>
                        <th>Price (Php)</th>
                        <th>Old Stock (Pcs/Kg)</th>
                        <th>Current Stock (Pcs/Kg)</th>
                        <th>Qty</th>
                        <th>Type</th>
                        <th style="text-align:right;">Subtotal</th>
                    </tr>
                </table>
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
$(document).ready(function(){
  myTable = $('#tallyTable');
  PopulateTallyTable();

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

  $("#branch").change(function(){
    $('#tallyTable tr').remove();
    $("#noDailyTally").remove();
    PopulateTallyTable();
  });
});

function PopulateTallyTable() {
  var date = $("#searchDate").val();
  let id = $("#branch").val();

  $.ajax({
    method: "POST",
    url: "../queries/get/searchDailyTally.php",
    data: {"date": date, "branch_id": id},
  }).done(function( data ) {
    var jsonObject = JSON.parse(data);
    if (jsonObject[0]) {
      $("#stockTransactionId").val(jsonObject[0].stock_transaction_id);
      var result = jsonObject.map(function (item) {
      var result = [];
      stock_transaction = item.stock_transaction_id;
      myTable.append('<tr class="item"><td>'+item.name+' <input name="item[]" value="'+item.item_id+'" hidden> <input name="item_line_id[]" value="'+item.item_line_id+'" hidden> <input name="stock_transaction_id" value="'+item.stock_transaction_id+'" hidden></td>'
          +'<td><input name="price[]" class="editPrice form-control" type="number" value="'+item.price+'" readonly="true"></td>'
          +'<td><input name="oldStock[]" class="qty form-control" value="'+item.old_stock+'" readonly></td>'
          +'<td><input name="currentStock[]" class="qty form-control" value="'+item.stock_qty+'" readonly></td>'
          +'<td><input name="qty[]" class="editQty form-control" type="number" value="'+item.qty+'" readonly></td>'
          +'<td><input name="type[]" class="qty form-control" type="text" value="'+item.item_line_type+'" readonly></td>'
          +'<td class="editSubTotal" style="text-align:right;">'+item.price*item.qty+'</td></tr>');
      });
      myTable.append('<tr><td></td><td></td><td></td><td></td><td></td><td id="total" style="text-align:right;"><strong>TOTAL</strong><td id="editTotalValue" style="text-align:right;">0</td></tr>');
      myTable.append('<tr><td></td><td></td><td></td><td></td><td></td><td></td><td style="text-align:right;"><button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#voidModal">Void Tally <i class="fa fa-trash"></i></button></td></tr>');
      
      $("#next-btn").on("click", function() {
        $('#smartwizard').smartWizard("next");
      });
      var total = 0;
      $("tr.item").each(function() {
        $this = $(this);
        total += parseInt($this.find(".editSubTotal").html());
      });
      $("#editTotalValue").html(total);
    } else {
      $("#editDailyTallyCard").append('<div id="noDailyTally" class="row justify-content-md-center">No daily tally records found for this date!</div>');
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
  $("tr.newitem").each(function() {
    $this = $(this);
    total += parseInt($this.find(".subTotal").html());
  });
  $("#totalValue").html(total);
});

</script>
<?php
require ("../footer.php");
?>
