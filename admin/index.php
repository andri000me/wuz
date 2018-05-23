<?php
include "header.php";
include "sidebar.php";
?>
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">

              <div class="row">
                  <div class="col-lg-12 main-chart">
                  
                      <div class="row mt">
                      <!-- SERVER STATUS PANELS -->
                        <div class="col-md-4 col-sm-4 mb" style="z-index:1003">
                          <div class="white-panel pn donut-chart" style="height:300px">
                            <div class="white-header">
                    <h5 style="color:#2A323C">DATA TRANSPORTASI</h5>
                            </div>
                <div class="row">
                  <div class="col-sm-12 col-xs-6 goleft">
                    <font style="color:#68DFF0; margin-left: 15px"><i class="fa fa-train" style="color: #68DFF0"></i> Jumlah Kereta Ekonomi</font>
                    <br>
                    <font style="color:#5bc0de; margin-left: 15px"><i class="fa fa-train" style="color:#5bc0de"></i> Jumlah Kereta Bisnis</font>
                    <br>
                    <font style="color:#3295fa;margin-left: 15px"><i class="fa fa-plane" style="color:#3295fa"></i> Jumlah Pesawat Ekonomi</font>
                    <br>
                    <font style="color:#32aace; margin-left: 15px"><i class="fa fa-plane" style="color:#32aace"></i> Jumlah Pesawat Bisnis</font>
                  </div>
                            </div>
                <canvas id="serverstatus01" height="120" width="120"></canvas>
                <?php
                  $et = $d->prepare("SELECT * FROM transportation where kd_tt='ET'");
                  $et->execute();
                  $ett =$et->rowCount();
                  $eb = $d->prepare("SELECT * FROM transportation where kd_tt='BT'");
                  $eb->execute();
                  $ebb =$eb->rowCount();
                  $ep = $d->prepare("SELECT * FROM transportation where kd_tt='EP'");
                  $ep->execute();
                  $epp =$ep->rowCount();
                  $bp = $d->prepare("SELECT * FROM transportation where kd_tt='BP'");
                  $bp->execute();
                  $bpp =$bp->rowCount();
                  echo "<script> var et = ".($ett)."; </script>";
                  echo "<script> var eb = ".($ebb)."; </script>";
                  echo "<script> var ep = ".($epp)."; </script>";
                  echo "<script> var bp = ".($bpp)."; </script>";
                ?>
                <script>
                  var doughnutData = [
                      {
                        value: et,
                        color:"#68dff0"
                      },
                      {
                        value : eb,
                        color : "#5bc0de"
                      },
                      {
                        value : ep,
                        color : "#3295fa"
                      },
                      {
                        value : bp,
                        color : "#32aace"
                      }
                    ];
                    var myDoughnut = new Chart(document.getElementById("serverstatus01").getContext("2d")).Doughnut(doughnutData);
                </script>
                          </div><! --/grey-panel -->
                        </div><!-- /col-md-4-->
                        
            <div class="col-md-4 mb" style="z-index:1003">
              <!-- WHITE PANEL - TOP USER -->
              <div class="white-panel pn" style="height:300px">
                <div class="white-header">
                  <h5 style="color:#2A323C">DATA CUSTOMER</h5>
                </div>
                <p style="font-size: 80pt; color:#5bc0de"><span class="fa fa-group"></span></p>
                <p style="color:#5bc0de"><b>Customer</b></p>
                <p style="color:#444c57"><b>Terdapat <?=$db->selectCount('customer')?> Customer Terdaftar</b></p>
              </div>
            </div><!-- /col-md-4 -->

             <div class="col-md-4 mb" style="z-index:1003">
              <!-- WHITE PANEL - TOP USER -->
              <div class="white-panel pn" style="height:300px">
                <div class="white-header">
                  <h5 style="color:#2A323C">DATA RESERVATION</h5>
                </div>
                <p style="font-size: 80pt; color:#5bc0de"><span class="fa fa-ticket"></span></p>
                <p style="color:#5bc0de"><b>Reservation</b></p>
                <p style="color:#444c57"><b>Terdapat <?=$db->selectCount('reservation')?> Reservation</b></p>
              </div>
            </div><!-- /col-md-4 -->

                    </div><!-- /row -->
                    
                            
          <div class="row">
            <!-- TWITTER PANEL -->
            <div class="col-md-4 mb">
                          <div class="darkblue-panel pn">
                            <div class="darkblue-header">
                    <h5>DATA KURSI</h5>
                            </div>
                 <p style="font-size: 80pt; color:#68dff0"><span class="fa fa-archive"></span></p>
                <p style="color:white"><b>Terdapat <?=$db->selectCount('seat')?> Seat</b></p>
                </footer>
                          </div><! -- /darkblue panel -->
            </div><!-- /col-md-4 -->

            <!-- TWITTER PANEL -->
            <div class="col-md-4 mb">
                          <div class="darkblue-panel pn">
                            <div class="darkblue-header">
                    <h5>RUTE</h5>
                            </div>
                 <p style="font-size: 80pt; color:#68dff0"><span class="fa fa-archive"></span></p>
                <p style="color:white"><b>Terdapat <?=$db->selectCount('rute')?> Rute</b></p>
                </footer>
                          </div><! -- /darkblue panel -->
            </div><!-- /col-md-4 -->
                        
            
          </div><!-- /row -->
        
          
                  </div><!-- /col-lg-12 END SECTION MIDDLE -->      

          </section>
      </section>
     <!--main content end-->

<?php
include "footer.php";
?>