<?php
include "header.php";
include "sidebar.php";
include "models/mtransportation.php";
$trans = new transportation();
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
                                <h5>DATA TRAIN</h5>
                        <!-- Modal -->
                    <form action="crud/create?trans" method="post" enctype="multipart/form-data">
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index:8999">
                          <div class="modal-dialog">
                            <div class="modal-content goleft" style="z-index:9999">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Tambah Data</h4>
                              </div>
                              <div class="modal-body">
                                <p>Kode
                                <input type="text" name="kd" class="form-control" placeholder="Example : SJ" title="Isikan 2 digit Huruf Kapital dari masing masing awal kata nama transportasi" required="">
                                <br>
                                <p>Nama 
                                <p><input name="nm" type="text" class="form-control" placeholder="Nama Kereta" required>
                                <p>Jumlah Kursi
                                <p><input name="seat_qty" type="text" class="form-control" placeholder="Jumlah Kursi" maxlength="3" required="">
                                <p>Type kereta
                                <p>
                                <select name="kd_tt" class="form-control" required>
                                    <option value="ET">Economi</option>
                                    <option value="BT">Bussiness</option>
                                </select>
                                <p>Deskripsi
                                <p>
                                <textarea name="desc" class="form-control" required=""></textarea>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <input type="submit" name="simpan" value="Simpan" class="btn btn-success">
                              </div>
                            </div>
                          </div>
                        </div> 
                    </form>
                        <!-- modal -->
            <?php

            function index(){
                $db = new database();
                $trans = new transportation();
                $sum=20;
                $jum = $trans->selectCount('P');
                $halaman=ceil($jum / $sum);
                $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
                $start = ($page - 1) * $sum;
                $no = $start;
            ?>
      </div>
      <?php
            if($_SESSION['level_user']=='SA'){
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
                        <th>Kode kereta</th>
                        <th>Nama kereta</th>
                        <th>Type</th>
                        <?php
                            if($_SESSION['level_user']=='SA'){
                        ?>
                        <th colspan="2">Opsi</th>
                        <?php } ?>
                    </thead>
                    <tbody id="data">
                        <?php
                            foreach($trans->selectAllLimit('T',$start,$sum) as $r){
                                $no++;
                        ?>
                        <tr>
                            <td><?=$no?></td>
                            <td><a href="?det&kd=<?=$r[0]?>" class="w3-text-blue" title="Lihat Detail"><?=$r[0]?></a></td>
                            <td><?=$r[1]?></td>
                            <td>
                                <?php
                                if($r[3] == 'ET'){
                                    echo "<label class='label label-success' style='cursor:pointer'>Economi</td>";
                                }
                                else{
                                    echo "<label class='label label-info' style='cursor:pointer'>Bussiness</td>";
                                }
                                ?>
                            <?php
                                // $data = " kd_anggota='".$r[0]."'";
                                // $qry = $custob->selectKr('simpanan',$data);
                                // if($qry==0){
                                //     echo "<td><a href='simpanan_pokok'><label class='label label-danger' style='cursor:pointer'>Belum</a></td>";
                                // }
                                // else{
                                //     echo "<td><label class='label label-info'>Sudah</td>";
                                // }
                            ?>
                            <?php
                                if($_SESSION['level_user']=='SA'){
                            ?>
                            <td class="center"><a href="?ed&kd=<?=$r[0]?>"><i class="fa fa-edit w3-ftoss icon"></i></a></td>
                            <td class="center"><?="<a href=crud/delete?trans&kd=$r[0] onClick=\"return confirm('Yakin hapus data $r[1]?');\">";?><i class="fa fa-trash-o w3-text-red icon"></i></a></td>
                            <?php } ?>
                        </tr>
                            <?php
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

                function detail(){
                $db = new database();
                $data = $db->selectID('transportation',$_GET['kd']);
                $r = $data->fetch();
                ?>
            </div>
            <a onclick="window.history.go(-1)" class="w3-fdef">
                <div class="l-menu tooltips" data-placement="bottom" data-original-title="Tambah Data">
                    <span class="fa fa-arrow-left semi-circ fa-lg" > Kembali</span> 
                </div>
            </a>
            <?php
                if($_SESSION['level_user']=='SA'){
            ?>
            <a href="" data-toggle="modal" data-target="#myModal">
             <div class="r-menu tooltips" data-placement="bottom" data-original-title="Tambah Data">
                    <span class="fa fa-plus circle fa-lg"> </span> 
                </div>
            </a> 
            <a href="?ed&kd=<?=$r[0]?>">
                <div class="r-menu tooltips" data-placement="bottom" data-original-title="Tambah Data">
                    <span class="fa fa-pencil circle fa-lg"> </span> 
                </div>
            </a>
            <?php } ?>
            </div>
                <table class="table" style="width:90%;margin:0 0px 20px 30px">
                        <thead>
                            <th colspan="2">Detail kereta</th>
                        </thead>
                        <tbody>
                           <!--  <tr>
                                <td rowspan="8" style="width:120px"><img src="<?=$r[8]?>" style="width:100px"></td>
                            </tr> -->
                            <tr>
                                <td style="width:15%">Kode kereta</td>
                                <td>:</td>
                                <td><?=$r[0]?></td>
                            </tr>
                            <tr>
                                <td>Nama Kereta</td>
                                <td>:</td>
                                <td><?=$r[1]?></td>
                            </tr>
                            <tr>
                                <td>Jumlah Kursi</td>
                                <td>:</td>
                                <td><?=$r[2]?></td>
                            </tr>
                            <tr>
                                <td>Jenis Kereta</td>
                                <td>:</td>
                                <td><?=(($r[3] == 'ET' ? 'Economi' : 'Bussiness'))?></td>
                            </tr>
                            <tr>
                                <td>Description</td>
                                <td>:</td>
                                <td><?=$r[4]?></td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <br>

                <?php
                    } //detail


                function edit(){
                $db = new database();
                $query = $db->selectID('transportation',$_GET['kd']);
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
                <form action="crud/update?trans" method="post" enctype="multipart/form-data" class="form-group">
                        <table class="form-crud">
                            <tr>
                                <td>Kode kereta</td>
                                <td>:</td>
                                <td class="td-pad" style="width:250px"><input name="kd" type="text" class="form-control" value="<?=$r[0]?>" readonly></td>
                            </tr>
                            <tr>
                                <td>Nama Kereta</td>
                                <td>:</td>
                                <td  class="td-pad"><input name="nm" type="text" class="form-control" value="<?=$r[1]?>"></td>
                            </tr>
                            <tr>
                                <td>Jumlah Kursi</td>
                                <td>:</td>
                                <td class="td-pad"><input name="seat_qty" type="text" class="form-control" value="<?=$r[2]?>"></td>
                            </tr>
                            <tr>
                                <td>Jenis Kereta</td>
                                <td>:</td>
                                <td class="td-pad">
                                    <select class="form-control" name="kd_tt">
                                        <option value="ET" <?=(($r[3] == 'ET' ? 'selected' : ''))?>>Economi</option>
                                        <option value="BT" <?=(($r[3] == 'BT' ? 'selected' : ''))?>>Bussiness</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Deskripsi</td>
                                <td>:</td>
                                <td class="td-pad">
                                    <textarea class="form-control" name="desc" style="text-align: left"><?=$r[4]?></textarea>
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