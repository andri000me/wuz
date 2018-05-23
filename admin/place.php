<?php
include "header.php";
include "sidebar.php";
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
                                <h5>DATA PLACE</h5>
                        <!-- Modal -->
                    <form action="crud/create?place" method="post" enctype="multipart/form-data">
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index:8999">
                          <div class="modal-dialog">
                            <div class="modal-content goleft" style="z-index:9999">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Tambah Data</h4>
                              </div>
                              <div class="modal-body">
                                <p>Kode
                                <input type="text" name="kd" class="form-control" placeholder="Example : SJ" title="Isikan 2 digit Huruf Kapital dari masing masing awal kata nama tempat" required="">
                                <br>
                                <br>
                                <p>Nama 
                                <p><input name="nm" type="text" class="form-control" placeholder="Nama" required>
                                <p>Jenis
                                <p>
                                <select name="jn" class="form-control" required="">
                                    <option value="Bandara">Bandara</option>
                                    <option value="Stasiun">Stasiun</option>
                                </select>
                                <p>Kota
                                <p><input name="kt" type="text" class="form-control" placeholder="Kota" maxlength="30" required="">
                                <p>Alamat
                                <p>
                                    <textarea class="form-control" name="alm" style="text-align: left" required></textarea>
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
                $jum = $db->selectCount('place');
                $halaman=ceil($jum / $sum);
                $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
                $start = ($page - 1) * $sum;
                $no = $start;
            ?>
      </div>
      <a href="csv/export.php?ex&key=place">
            <button style="margin:15px 10px 15px 20px" class="btn btn-success col-md-2" title="Download Data CSV"> 
                <span class="fa fa-arrow-down"></span> Data CSV
            </button>
        </a>
        
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
                        <th>Kode Place</th>
                        <th>Nama Place</th>
                        <th>Jenis</th>
                        <th>Kota</th>
                        <th colspan="2">Opsi</th>
                    </thead>
                    <tbody id="data">
                        <?php
                            foreach($db->selectAllLimit('place',$start,$sum) as $r){
                                $no++;
                        ?>
                        <tr>
                            <td><?=$no?></td>
                            <td><a href="?det&kd=<?=$r[0]?>" class="w3-text-blue" title="Lihat Detail"><?=$r[0]?></a></td>
                            <td><?=$r[1]?></td>
                            <td>
                                <?php
                                if($r[2] == 'Bandara'){
                                    echo "<label class='label label-info'>Bandara</td>";
                                }
                                else{
                                    echo "<label class='label label-success'> Stasiun</a></td>";
                                }
                                ?>
                            <td><?=$r[3]?></td>
                            <td class="center"><a href="?ed&kd=<?=$r[0]?>"><i class="fa fa-edit w3-ftoss icon"></i></a></td>
                            <td class="center"><?="<a href=crud/delete?place&kd=$r[0] onClick=\"return confirm('Yakin hapus data $r[1]?');\">";?><i class="fa fa-trash-o w3-text-red icon"></i></a></td>
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
                    $data = $db->selectID('place',$_GET['kd']);
                    $r = $data->fetch();
                ?>
            </div>
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
            <br>
            <br><br>
                <table class="table" style="width:70%;margin:0 0px 20px 30px">
                        <thead>
                            <th colspan="2">Detail Place</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="width:15%">Kode Place</td>
                                <td>:</td>
                                <td><?=$r[0]?></td>
                            </tr>
                            <tr>
                                <td>Nama Place</td>
                                <td>:</td>
                                <td><?=$r[1]?></td>
                            </tr>
                            <tr>
                                <td>Jenis</td>
                                <td>:</td>
                                <td><?=$r[2]?></td>
                            </tr>
                            <tr>
                                <td>Kota</td>
                                <td>:</td>
                                <td><?=$r[3]?></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
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
                $query = $db->selectID('place',$_GET['kd']);
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
                <form action="crud/update?place" method="post" class="form-group">
                        <table class="form-crud">
                            <tr>
                                <td>Kode place</td>
                                <td>:</td>
                                <td class="td-pad" style="width:250px"><input name="kd" type="text" class="form-control" value="<?=$r[0]?>" readonly></td>
                            </tr>
                            <tr>
                                <td>Nama place</td>
                                <td>:</td>
                                <td  class="td-pad"><input name="nm" type="text" class="form-control" value="<?=$r[1]?>"></td>
                            </tr>
                            <tr>
                                <td>Jenis</td>
                                <td>:</td>
                                <td class="td-pad">
                                    <select class="form-control" name="jn">
                                        <option value="Bandara" <?=(($r[2] == 'Bandara' ? 'selected' : ''))?>>Bandara</option>
                                        <option value="Stasiun" <?=(($r[2] == 'Stasiun' ? 'selected' : ''))?>>Stasiun</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Kota</td>
                                <td>:</td>
                                <td class="td-pad"><input name="kt" type="text" class="form-control" value="<?=$r[3]?>"></td>
                            </tr>
                             <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td  class="td-pad">
                                    <textarea class="form-control" name="alm" style="text-align: left"><?=$r[4]?></textarea>
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
                    edit();
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
}
?>