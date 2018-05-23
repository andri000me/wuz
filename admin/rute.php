<?php
include "header.php";
include "sidebar.php";
include "models/mrute.php";
$rute = new rute();
$crud = new crud();
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
                                <h5>DATA RUTE</h5>

                        <!-- Modal -->
                    <form action="crud/create?rute" method="post">
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index:8999">
                          <div class="modal-dialog">
                            <div class="modal-content goleft" style="z-index:9999">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Tambah Data</h4>
                              </div>
                              <div class="modal-body">
                                <p>Kode
                                <input type="text" name="kd" class="form-control" value="<?=$rute->getKd()?>" title="Kode Rute" readonly>
                                <br>
                                <p>Jam Keberangkatan 
                                <p><input name="jam" type="text" class="form-control" placeholder="Ex = 20:00">
                                <p>Tempat Keberangkatan
                                <p><select name="asal" class="form-control" required="">
                                        <option>Pilih Tempat Keberangkatan</option>
                                        <?php
                                            foreach ($crud->selectAll('place') as $key) {
                                                echo "<option value=$key[0]>($key[0]) $key[1] - $key[3]</option>";
                                            }
                                        ?>
                                    </select> 
                                <p>Tempat Tujuan
                                <p>
                                <select name="tujuan" class="form-control" required="">
                                        <option>Pilih Tempat Tujuan</option>
                                        <?php
                                            foreach ($crud->selectAll('place') as $key) {
                                                echo "<option value=$key[0]>($key[0]) $key[1] - $key[3]</option>";
                                            }
                                        ?>
                                    </select> 
                                <p>Harga
                                <p><input name="harga" type="text" class="form-control" placeholder="Harga Tiket" required>
                                 <p>Transportasi
                                <p><select name="trans" class="form-control" required="">
                                        <option>Pilih Transportasi</option>
                                        <?php
                                            foreach ($crud->selectAll('transportation') as $key) {
                                                echo "<option value=$key[0]>($key[0]) $key[1] - $key[3]</option>";
                                            }
                                        ?>
                                    </select> 
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <input type="submit" name="simpan" value="Simpan" class="btn btn-info">
                              </div>
                            </div>
                          </div>
                        </div> 
                    </form>
                        <!-- modal -->
            <?php

            function index(){
                $db = new database();
                $rute = new rute();
                $crud = new crud();
                $sum=20;
                $halaman=ceil($jum / $sum);
                $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
                $start = ($page - 1) * $sum;
                $no = $start;
            ?>
      </div>

        <a href="csv/export.php?ex&key=rute">
            <button style="margin:15px 10px 15px 20px" class="btn btn-success col-md-2" title="Download Data CSV"> 
                <span class="fa fa-arrow-down"></span> Data CSV
            </button>
        </a>
        <a href="reports/rute" target="_blank">
            <button style="margin:15px 20px" class="btn btn-danger col-md-2" title="Data PDF"> 
                <span class="fa fa-file"></span> Data PDF
            </button>
        </a>
        <?php if($_SESSION['level_user']=='SA'){
            ?>
      <a href="" data-toggle="modal" data-target="#myModal">
             <div class="r-menu tooltips" data-placement="bottom" data-original-title="Tambah Data">
                    <span class="fa fa-plus circle fa-lg"> </span> 
                </div>
            </a> 
        <?php } ?>
        </div>

            <div class="pnn ml" style="padding:20px">
                <table class="table">
                    <thead>
                        <th>No</th>
                        <th>Kode Rute</th>
                        <th>Jam Keberangkatan</th>
                        <th>Asal</th>
                        <th>Tujuan</th>
                        <?php if($_SESSION['level_user']=='SA'){ ?>
                        <th colspan="2">Opsi</th>
                        <?php } ?>
                    </thead>
                    <tbody id="data">
                        <?php
                            foreach($crud->selectAll('rute') as $r){
                                $no++;
                        ?>
                        <tr>
                            <td><?=$no?></td>
                            <td><a href="?det&kd=<?=$r[0]?>" class="w3-text-blue" title="Lihat Detail"><?=$r[0]?></a></td>
                            <td><?=$r[1]?></td>
                            <td><?php $q=$db->selectID('place',$r[2]); $rr=$q->fetch(); echo $rr[2]." ".$rr[1] ?></td>
                            <td><?php $q=$db->selectID('place',$r[3]); $rr=$q->fetch(); echo $rr[2]." ".$rr[1] ?></td>
                            <td class="center"><a href="?ed&kd=<?=$r[0]?>"><i class="fa fa-edit w3-ftoss icon"></i></a></td>
                            <td class="center"><?="<a href=crud/delete?rute&kd=$r[0] onClick=\"return confirm('Yakin hapus data $r[1]?');\">";?><i class="fa fa-trash-o w3-text-red icon"></i></a></td>
                            <?php } ?>
                        </tr>
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

                function detail(){
                $db = new database();
                $data = $db->selectID('rute',$_GET['kd']);
                $r = $data->fetch();
                ?>
            </div>
            <a onclick="window.history.go(-1)" class="w3-fdef">
                <div class="l-menu tooltips" data-placement="bottom" data-original-title="Kembali">
                    <span class="fa fa-arrow-left semi-circ fa-lg" > Kembali</span> 
                </div>
            </a>
            <?php if($_SESSION['level_user']=='SA'){ ?>
            <a href="" data-toggle="modal" data-target="#myModal">
             <div class="r-menu tooltips" data-placement="bottom" data-original-title="Tambah Data">
                    <span class="fa fa-plus circle fa-lg"> </span> 
                </div>
            </a> 
            <a href="?ed&kd=<?=$r[0]?>">
                <div class="r-menu tooltips" data-placement="bottom" data-original-title="Edit Data">
                    <span class="fa fa-pencil circle fa-lg"> </span> 
                </div>
            </a>
            <?php } ?>
            </div>
                <table class="table" style="width:90%;margin:0 0px 20px 30px">
                        <thead>
                            <th colspan="2">Detail Rute</th>
                        </thead>
                        <tbody>
                           <!--  <tr>
                                <td rowspan="8" style="width:120px"><img src="<?=$r[8]?>" style="width:100px"></td>
                            </tr> -->
                            <tr>
                                <td style="width:15%">Kode Rute</td>
                                <td>:</td>
                                <td><?=$r[0]?></td>
                            </tr>
                            <tr>
                                <td>Jam Keberangkatan</td>
                                <td>:</td>
                                <td><?=$r[1]?></td>
                            </tr>
                            <tr>
                                <td>Tempat Keberangkatan</td>
                                <td>:</td>
                                <td><?php $q=$db->selectID('place',$r[2]); $rr = $q->fetch(); echo $rr[2]." ".$rr[1]?></td>
                            </tr>
                            <tr>
                                <td>Tempat Tujuan</td>
                                <td>:</td>
                                <td><?php $q=$db->selectID('place',$r[3]); $rr = $q->fetch(); echo $rr[2]." ".$rr[1]?></td>
                            </tr>
                            <tr>
                                <td>Harga</td>
                                <td>:</td>
                                <td><?=$r[4]?></td>
                            </tr>
                            <tr>
                                <td>Transportation</td>
                                <td>:</td>
                                <td><?=$r[5]?></td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <br>

                <?php
                    } //detail


                function edit(){
                $db = new database();
                $crud = new crud();
                $query = $db->selectID('rute',$_GET['kd']);
                $r = $query->fetch();
                ?>
                </div>
                <a onclick="window.history.go(-1)" class="w3-fdef">
                <div class="l-menu tooltips" data-placement="bottom" data-original-title="Tambah Data">
                    <span class="fa fa-arrow-left semi-circ fa-lg"> Kembali</span> 
                </div>
                </a>
        </div>
            <div class="pnn ml" style="padding:20px">
                <form action="crud/update?rute" method="post" enctype="multipart/form-data" class="form-group">
                        <table class="form-crud">
                            <tr>
                                <td>Kode Rute</td>
                                <td>:</td>
                                <td class="td-pad" style="width:250px"><input name="kd" type="text" class="form-control" value="<?=$r[0]?>" readonly></td>
                            </tr>
                            <tr>
                                <td>Jam Keberangkatan</td>
                                <td>:</td>
                                <td  class="td-pad"><input name="jam" type="text" class="form-control" value="<?=$r[1]?>"></td>
                            </tr>
                            <tr>
                                <td>Tempat Keberangkatan</td>
                                <td>:</td>
                                <td class="td-pad"> 
                                    <select name="asal" class="form-control" required="">
                                        <?php
                                            foreach ($crud->selectAll('place') as $key) {
                                                echo "<option value=$key[0]".(($r[2]==$key[0])?' selected':'').">($key[0]) $key[1] - $key[3]</option>";
                                            }
                                        ?>
                                    </select> </td>
                            </tr>
                            <tr>
                                <td>Tujuan</td>
                                <td>:</td>
                                <td class="td-pad">
                                   <select name="tujuan" class="form-control" required="">
                                        <?php
                                            foreach ($crud->selectAll('place') as $key) {
                                                echo "<option value=$key[0]".(($r[3]==$key[0])?' selected':'').">($key[0]) $key[1] - $key[3]</option>";
                                            }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Harga</td>
                                <td>:</td>
                                <td class="td-pad"><input name="harga" type="text" class="form-control" value="<?=$r[4]?>"></td>
                            </tr>
                            <tr>
                                <td>Transportation</td>
                                <td>:</td>
                                <td class="td-pad"><select name="trans" class="form-control" required="">
                                        <?php
                                            foreach ($crud->selectAll('transportation') as $key) {
                                                echo "<option value=$key[0]".(($r[5]==$key[0])?' selected':'').">($key[0]) $key[1] - $key[3]</option>";
                                            }
                                        ?>
                                    </select></td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="submit" name="update" value="update" class="btn btn-info">

                    </form>
                                </td>
                            </tr>
                        </table>
                </div>

                <?php
                } // edit

                if(isset($_GET['det'])){
                    detail();
                }

                elseif(isset($_GET['ed'])){
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