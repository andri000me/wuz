<?php
include "header.php";
include "sidebar.php";
include "models/muser.php";
$usob = new user();
if($_SESSION['level_user'] != 'SA'){
    echo "<script>window.history.go(-1);</script>";
}
else{
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
                                <h5>DATA USER</h5>

        <a href="csv/export.php?ex&key=customer">
            <button style="margin:15px 10px 15px 20px" class="btn btn-success col-md-2" title="Download Data CSV"> 
                <span class="fa fa-arrow-down"></span> Data CSV
            </button>
        </a>
                        <!-- Modal -->
                    <form action="crud/create?u" method="post">
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index:8999">
                          <div class="modal-dialog">
                            <div class="modal-content goleft" style="z-index:9999">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Tambah Data</h4>
                              </div>
                              <div class="modal-body">
                                <input type="hidden" name="kd" value="<?=$usob->getKd()?>">
                                <br>
                                <p>Nama
                                <p><input name="nm" type="text" class="form-control" placeholder="Nama Lengkap" required>
                                <p>Username
                                <p><input name="un" type="text" class="form-control" placeholder="Usernanme" required>
                                <p>Password
                                <p><input name="pw" type="password" class="form-control" placeholder="password" required maxlength="13">
                                <p>Level
                                <p>
                                <select name="lv" class="form-control" required="">
                                    <option value="SA">Super Admin</option>
                                    <option value="AV">Admin Verifikator</option>
                                </select>
                              </div>
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
                $sum=20;
                $jum = $db->selectCount('user');
                $halaman=ceil($jum / $sum);
                $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
                $start = ($page - 1) * $sum;
                $no = $start;
            ?>
            <a href="" data-toggle="modal" data-target="#myModal">
             <div class="r-menu tooltips" data-placement="bottom" data-original-title="Tambah Data">
                    <span class="fa fa-plus circle fa-lg"> </span> 
                </div>
            </a> 
        </div>

            <div class="pnn ml" style="padding:20px">
                <table class="table">
                    <thead>
                        <th>No</th>
                        <th>Kode User</th>
                        <th>Nama User</th>
                        <th>Level</th>
                        <th colspan="3">Opsi</th>
                    </thead>
                    <tbody id="data">
                        <?php
                            foreach($db->selectAllLimit('user',$start,$sum) as $r){
                                $no++;
                        ?>
                        <tr>
                            <td><?=$no?></td>
                            <td><a href="?det&kd=<?=$r[0]?>" class="w3-text-blue" title="Lihat Detail"><?=$r[0]?></a></td>
                            <td><?=$r[1]?></td>
                            <td><?=(($r[4] == 'AV' ? 'Admin Verifikator' : 'Super Admin'))?></td>
                            <td class="center"><a href="?ed&kd=<?=$r[0]?>"><i class="fa fa-edit w3-ftoss icon"></i></a></td>
                            <td class="center"><a href="reports/user?kd=<?=$r[0]?>" target="_blank"><i class="fa fa-print w3-fdef icon"></i></a></td>
                            <td class="center"><?="<a href=crud/delete?u&kd=$r[0] onClick=\"return confirm('Yakin hapus data $r[1]?');\">";?><i class="fa fa-trash-o w3-text-red icon"></i></a></td>

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
                    $data = $db->selectID('user',$_GET['kd']);
                    $r = $data->fetch();
                ?>
            <a onclick="window.history.go(-1)" class="w3-fdef">
                <div class="l-menu tooltips" data-placement="bottom" data-original-title="Tambah Data">
                    <span class="fa fa-arrow-left semi-circ fa-lg" > Kembali</span> 
                </div>
            </a>
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
            </div>
                <table class="table" style="width:90%;margin:0 0px 20px 30px">
                        <thead>
                            <th colspan="2">Detail User</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="width:18%">Kode user</td>
                                <td>:</td>
                                <td><?=$r[0]?></td>
                            </tr>
                            <tr>
                                <td>Nama User</td>
                                <td>:</td>
                                <td><?=$r[1]?></td>
                            </tr>
                            <tr>
                                <td>Username</td>
                                <td>:</td>
                                <td><?=$r[2]?></td>
                            </tr>
                            <tr>
                                <td>Level</td>
                                <td>:</td>
                                <td><?=(($r[4] == 'AV' ? 'Admin Verifikator' : 'Super Admin'))?></td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <br>

                <?php
                    } //detail

                function edit(){
                $db = new database();
                $query = $db->selectID('user',$_GET['kd']);
                $r = $query->fetch();
                ?>

                <a onclick="window.history.go(-1)" class="w3-fdef">
                <div class="l-menu tooltips" data-placement="bottom" data-original-title="Tambah Data">
                    <span class="fa fa-arrow-left semi-circ fa-lg"> Kembali</span> 
                </div>
                </a>
            </div>
            <div class="pnn ml" style="padding:20px">
                <form action="crud/update?u" method="post">
                        <table class="form-crud">
                            <tr>
                                <td>Kode User</td>
                                <td>:</td>
                                <td class="td-pad"><input name="kd" type="text" class="form-control" value="<?=$r[0]?>" readonly></td>
                            </tr>
                            <tr>
                                <td>Nama user</td>
                                <td>:</td>
                                <td class="td-pad"><input name="nm" type="text" class="form-control" value="<?=$r[1]?>"></td>
                            </tr>
                            <tr>
                                <td>Username</td>
                                <td>:</td>
                                <td class="td-pad"><input name="un" type="text" class="form-control" value="<?=$r[2]?>"></td>
                            </tr>
                            <tr>
                                <td>Level</td>
                                <td>:</td>
                                <td class="td-pad">
                                    <select class="form-control" name="lv">
                                        <option value="AV" <?=(($r[4] == 'AV' ? 'selected' : ''))?>>Admin Verifikator</option>
                                        <option value="SA" <?=(($r[4] == 'SA' ? 'selected' : ''))?>>Super Admin</option>
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
                  
                  
      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->                  
                  
                  <div class="col-lg-3 ds">
                    <!--COMPLETED ACTIONS DONUTS CHART-->
          
                        <!-- CALENDAR-->
              </div><! --/row -->
          </section>
      </section>
     <!--main content end-->

<?php
include "footer.php";
}
?>