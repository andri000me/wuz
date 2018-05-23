    <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
                  <h6 class="centered" style="margin-top: 0px">Welcome!</h6>
                  <h5 class="centered"><?=$_SESSION['nama_user']?></h5>
                    
                  <?php
                     if($_SESSION['level_user']=='SA'){
                  ?>
                  <li class="sub-menu">
                      <a href="user">
                          <i class="fa fa-user"></i>
                          <span>User</span>
                      </a>
                  </li>
                  <?php
                        }
                    ?>
                  <li class="sub-menu">
                      <a href="customer">
                          <i class="fa fa-user"></i>
                          <span>Customer</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-plane"></i>
                          <span>Transportation</span>
                      </a>
                      <ul class="sub">
                          <li><a href="transportation_type">Transportation Type</a></li>
                          <li><a href="airplane">Airplane Data</a></li>
                          <li><a href="train">Train Data</a></li>
                          <li><a href="rekap_transportation">Rekap Transportation</a></li>
                      </ul>
                  </li>
                   <li class="sub-menu">
                      <a href="seat">
                          <i class="fa fa-desktop"></i>
                          <span>Seat</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="rute">
                          <i class="fa fa-desktop"></i>
                          <span>Rute</span>
                      </a>
                  </li>
                  <?php
                    if($_SESSION['level_user']=='SA'){
                  ?>
                  <li class="sub-menu">
                      <a href="place">
                          <i class="fa fa-desktop"></i>
                          <span>Place</span>
                      </a>
                  </li>
                  <?php
                    }
                  ?> 
                   <li class="sub-menu">
                      <a href="reservation">
                          <i class="fa fa-ticket"></i>
                          <span>Reservation</span>
                          <?php
                            $re = $d->prepare("SELECT * FROM reservation where status_pembayaran='P'");
                            $re->execute();
                            $re_ = $re->rowCount();
                            if($re_==0)
                              echo "<label class='label label-danger label-xs' style='margin:1px 2px 6px 3px'> ".$re_."</span>";
                            else
                              echo "<label class='label label-info label-xs' style='margin:1px 2px 6px 3px'>".$re_."</label>";
                          ?>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-book"></i>
                          <span>Reports</span>
                      </a>
                      <ul class="sub">
                          <li><a href="reports/customer" target="_blank">Customer</a></li>
                          <li><a href="reports/rute" target="_blank">Rute</a></li>
                          <li><a href="laporan_res">Reservation</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="backup.php">
                          <i class="fa fa-database"></i>
                          <span>Backup</span>
                      </a>
                  </li>
                  <?php
                    //if($_SESSION['level_user']=='SA'){
                  ?>
                  <!-- <li class="sub-menu">
                      <a href="restore.php">
                          <i class="fa fa-database"></i>
                          <span>Restore Database</span>
                      </a>
                  </li> -->
                  <?php
                    //  } 
                    ?>

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->