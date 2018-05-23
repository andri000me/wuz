<?php
include "header.php";
include "sidebar.php";
?>
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">

              <div class="row">
                  <div class="col-lg-12">
                  
                      <div class="row mt">
                        <div class="col-md-12 col-sm-4 mb" style="z-index:1002">
                          <div class="white-panel pnn">
                            <div class="white-header goleft ml">
                                <h5>DATA RESERVATION</h5>
            <?php

            function index(){
                $db = new database();
                $crud = new crud();
                $sum=20;
                $jum = $db->selectCount('reservation');
                $halaman=ceil($jum / $sum);
                $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
                $start = ($page - 1) * $sum;
                $no = $start;
            ?>
        </div>
        <a href="laporan_res">
            <button style="margin:15px 35px" class="btn btn-success col-md-2" title="Download Data CSV"> 
                <span class="fa fa-file-o"></span> Reports
            </button>
        </a>

            <div class="pnn ml" style="padding:20px">
                <table class="table" style="width:85%">
                    <thead>
                        <th>No</th>
                        <th>Kode Reservation</th>
                        <th>Tanggal Reservasi</th>
                        <th>Tanggal Keberangkatan</th>
                        <th>Kode Customer</th>
                        <th>Kode Rute</th>
                        <th>Status Pembayaran</th>
                        <th>Konfirmasi</th>

                        <?php if($_SESSION['level_user']=='SA'){ ?>
                        <th colspan="2">Opsi</th>
                        <?php } ?>
                    </thead>
                    <tbody id="data">
                        <?php
                            foreach($db->selectAllLimitt('reservation',$start,$sum) as $r){
                                $no++;
                        ?>
                        <tr>
                            <td><?=$no?></td>
                            <td><a href="reservation_det?kd=<?=$r[0]?>" class="text-blue"><?=$r[0]?></a></td>
                            <td><?=$r[1]?></td>
                            <td><?=$r[2]?></td>
                            <td><a href="customer?det&kd=<?=$r[3]?>" class="text-blue" title="Lihat Detail Customer"><?=$r[3]?></a></td>
                            <td><a href="rute?det&kd=<?=$r[4]?>" class="text-blue" title="Lihat Detail Rute"><?=$r[4]?></a></td>
                            <td><?=$r[10]?></td>
                            <td>
                                <?php
                                    if($r[10]=='N')
                                        echo "<button class='btn btn-xs btn-danger btn-block' disabled style='cursor:pointer!important'>Belum Konfirmasi <span class='fa fa-close'> </span></button>";
                                    elseif($r[10]=='P')
                                        echo "<a href='?konf&kd=".$r[0]."'><button class='btn btn-block btn-xs btn-warning' style='cursor:pointer!important'>Meminta Dikonfirmasi <span class='fa fa-pencil'> </span></button></a>";
                                    else
                                        echo "<button class='btn btn-xs btn-block btn-info' disabled style='cursor:pointer!important'>Telah Dikonfirmasi <span class='fa fa-check'> </span></button>";
                                ?>
                            </td>
                            <?php if($_SESSION['level_user']=='SA'){ ?>
                            <!-- <td class="center"><a href="?ed&kd=<?=$r[0]?>"><i class="fa fa-edit w3-ftoss icon"></i></a></td> -->
                            <td class="center"><?="<a href=crud/delete?res&kd=$r[0] onClick=\"return confirm('Yakin hapus data $r[1]?');\">";?><i class="fa fa-trash-o w3-text-red icon"></i></a></td>
                            <td class="center"><?="<a href=e-ticket?kd=$r[0]>";?><i class="fa fa-file-o text-blue icon"></i></a></td>
                            <?php } ?>
                        </tr>
                            <?php
                                }

                                if(isset($_GET['konf']) && isset($_GET['kd'])){
                                    $kd = $_GET['kd'];
                                    $host = "localhost";
                                    $dbname="db_ticketing";
                                    $un = "root";
                                    $pw="";
                                    $d = new PDO("mysql:host={$host};dbname={$dbname}", $un,$pw);
                                    $upd = $d->prepare("UPDATE reservation SET status_pembayaran = 'Y' where kd_reservation ='$kd'");
                                    if($upd->execute()){
                                        echo "<script>alert('Konfirmasi Berhasil'); window.location.href='reservation';</script>";
                                    }
                                    else{
                                        echo "<script>alert('Konfirmasi Gagal'); window.location.href='reservation';</script>";
                                    }
                                }
                            ?> 
                    </tbody>
                </table>
                <center>
                    <ul class="pagination mb">     
                      <?php 
                      for($x=1;$x<=$halaman;$x++){
                        ?>
                        <li><a href="?page=<?php echo $x ?>"><?php echo $x ?></a></li>
                        <?php
                      }
                      ?>            
                </ul>
                </center>
            </div>
                <?php
                    } //index

                function edit(){
                $db = new database();
                $crud = new crud();
                $data = " id='".$_GET['kd']."'";
                $query = $db->select('reservation', $data);
                $r = $query->fetch();
                ?>

                <a onclick="window.history.go(-1)" class="w3-fdef">
                <div class="l-menu tooltips" data-placement="bottom" data-original-title="Tambah Data">
                    <span class="fa fa-arrow-left semi-circ fa-lg"> Kembali</span> 
                </div>
                </a>

        </div>
            <div class="pnn ml" style="padding:20px; margin-top: 60px; padding-bottom: 100px!important">
                <form action="crud/update?s" method="post" class="form-group">
                        <table class="form-crud">
                            <tr>
                                <td>ID Reservation</td>
                                <td>:</td>
                                <td class="td-pad" style="width:250px"><input name="id" type="text" class="form-control" value="<?=$r[0]?>" readonly></td>
                            </tr>
                            <tr>
                                <td>Kode Reservation</td>
                                <td>:</td>
                                <td class="td-pad" style="width:250px"><input name="kd" type="text" class="form-control" value="<?=$r[1]?>"></td>
                            </tr>
                            <tr>
                                <td>Reservation</td>
                                <td>:</td>
                                <td  class="td-pad">
                                    <select name="kd_trans" class="form-control" required>
                                        <?php
                                            foreach($crud->selectAll('reservation') as $t){
                                                $j = substr($t[3], 1);
                                                echo "<option value=".$t[0].(($r[2]==$t[0])?' selected':'').">".(($j=='T')?'Kereta ':'Pesawat ').$t[1]."</option>";
                                            }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="submit" name="update" value="update" class="btn btn-success">

                    </form>
                                </td>
                            </tr>
                        </table>
                </div>

                <?php
                } // edit

                if(isset($_GET['ed'])){
                    if($_SESSION['level_user']=='SA'){
                    edit();
                    }
                }
                else{
                    index();
                }
                ?>

                          </div>
                        </div><!-- /col-md-4 --> 
                    </div><!-- /row -->
                    
                  </div><!-- /col-lg-12 END SECTION MIDDLE -->
                
            
          </section>
      </section>
     <!--main content end-->

<?php
include "footer.php";
?>