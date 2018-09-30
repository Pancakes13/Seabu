<?php
require ("../panelsidebar.php");
require ("../panelheader.php");
?>
    
        <!-- Header-->

        <div class="form-group" style="width:30%; margin-left:1%; margin-top:3%;">
          <label class=" form-control-label">Search Tally By Date <i class="fa fa-calendar"></i></label>
          <div class="input-group">
           
            <input class="form-control" type="date" value="<?php echo date('Y-m-d');?>">
            <button class="input-group-addon"><i class="fa fa-search"></i></button>
          </div>
        </div>
        

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
                  <div class="col-md-12">
                    <div class="card">
                          <div class="card-header">
                              <strong class="card-title"><?php echo date("F d, Y (l)");?></strong>
                              <button type="button" class="btn btn-warning btn-sm" 
                              style="float:right;" data-toggle="modal" data-target="#addModal"
                              >
                              Edit Tally <i class="fa fa-edit"></i>
                            </button>
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
                                </tr>
                              </table>
                            </form>
                          </div>
                      </div>
                  

                  </div>
                </div>
            </div>
        </div>


    </div><!-- /#right-panel -->

    <!-- Right Panel -->
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
      swal(
                  'Success!',
                  'You have submitted the daily tally!',
                  'success'
                )
      PopulateTallyTable();
    })
  }); 
});

function getDailyTally() {
    $.ajax({
      method: "GET", url: "../queries/get/getItems.php", 
    }).done(function( data ) {
      var jsonObject = JSON.parse(data);
                var result = jsonObject.map(function (item) {
                    var result = [];
                    myTable.append('<tr><td style="width:40%;">'+item.name+' <input name="item[]" value="'+item.item_id+'" hidden></td>'
                    +'<td style="width:20%;"><input id="price" name="price[]" class="form-control" type="number" value="'+item.price+'" readonly="true"></td>'
                    +'<td style="width:10%;"><input id="qty" name="qty[]" class="form-control" type="number" value="'+item.qty+'"></td>'
                    +'<td> <select name="type[]" class="form-control">'
                    +'<option value="local">Local</option>'
                    +'<option value="honestbee">Honestbee</option>'
                    +'</select></td>'
                    +'<td id="subTotal" style="width:10%; text-align:right;">'+item.price*item.qty+'</td></tr>');
                    
                });
                myTable.append('<tr><td></td><td></td><td></td><td><strong>TOTAL</strong><td id="totalValue"></td></tr>');
                myTable.append('<tr><td></td><td></td><td></td><td><td><button class="btn btn-success" type="submit">Submit Daily Tally</button></td></tr>');
        });
        $(document).on('change', "#qty",function () {
          
          var toValidate = parseInt($("#qty").val());
          var price = parseInt($("#price").val());
          $("#subTotal").html(toValidate*price);
      });
}

function PopulateTallyTable() {
    $.ajax({
      method: "GET", url: "../queries/get/getItems.php", 
    }).done(function( data ) {
      var jsonObject = JSON.parse(data);
                var result = jsonObject.map(function (item) {
                    var result = [];
                    myTable.append('<tr><td style="width:40%;">'+item.name+' <input name="item[]" value="'+item.item_id+'" hidden></td>'
                    +'<td style="width:20%;"><input name="price[]" class="price form-control" type="number" value="'+item.price+'" readonly="true"></td>'
                    +'<td style="width:10%;"><input name="qty[]" class="qty form-control" type="number" value="0"></td>'
                    +'<td> <select name="type[]" class="form-control">'
                    +'<option value="local">Local</option>'
                    +'<option value="honestbee">Honestbee</option>'
                    +'</select></td>'
                    +'<td style="width:10%;"><input class="subTotal form-control" type="number" value="0" readonly="true"></td></tr>');
                    
                });
                myTable.append('<tr><td></td><td></td><td></td><td id="total"><strong>TOTAL</strong><td id="totalValue"></td></tr>');
                myTable.append('<tr><td></td><td></td><td></td><td><td><button class="btn btn-success" type="submit">Submit Daily Tally</button></td></tr>');
        });
        /*
        $(document).on('change', ".qty",function () {
          var test1 = $(this).closest(".qty").val();
alert(test1);
          var toValidate = parseInt($("input.qty.form-control").val());
          var price = parseInt($("input.price.form-control").val());
          $("td").closest("input.subTotal.form-control").val(toValidate*price);
      });*/
}

</script>
<?php
require ("../footer.php");
?>
