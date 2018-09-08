<?php
require ("../panelsidebar.php");
require ("../panelheader.php");
?>
    
        <!-- Header-->

        <div class="form-group" style="width:30%; margin-left:1%; margin-top:3%;">
          <label class=" form-control-label">Search Tally By Date <i class="fa fa-calendar"></i></label>
          <div class="input-group">
           
            <input class="form-control" type="date" value="<?php echo date('d/m/y');?>">
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
                              <table class="table">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Item Name</th>
                                    <th scope="col">Price (Php)</th>
                                    <th scope="col">Served</th>
                                    <th scope="col">Gross Profit (Php)</th>
                                </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <th scope="row">1</th>
                                <td>Cheezy Scallops</td>
                                <td>140</td>
                                <td>4</td>
                                <td>560</td>
                              </tr>
                              <tr>
                                <th scope="row">2</th>
                                <td>Seafood Sisig</td>
                                <td>120</td>
                                <td>3</td>
                                <td>360</td>
                              </tr>
                              <tr>
                                <th scope="row">3</th>
                                <td>Crablets</td>
                                <td>80</td>
                                <td>5</td>
                                <td>400</td>
                              </tr>
                              <tr>
                                <th scope="row">4</th>
                                <td>Cheezy Scallops</td>
                                <td>150</td>
                                <td>1</td>
                                <td>150</td>
                              </tr>
                              <tr>
                                <th scope="row">5</th>
                                <td>Squid Small</td>
                                <td>110</td>
                                <td>0</td>
                                <td>0</td>
                              </tr>
                              <tr>
                                <th scope="row">TOTAL</th>
                                <td></td>
                                <td></td>
                                <td>13</td>
                                <td>1470</td>
                              </tr>
                        </tbody>
                    </table>
                          </div>
                      </div>
                  

                  </div>
                </div>
            </div>
        </div>


    </div><!-- /#right-panel -->

    <!-- Right Panel -->

<?php
require ("../footer.php");
?>
