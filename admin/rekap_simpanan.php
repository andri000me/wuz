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
                                <h5>REKAP SIMPANAN</h5>
                        
            <?php

            function index(){
                $db = new database();
                $sum=10;
                $jum = $db->selectCount('simpanan');
                $halaman=ceil($jum / $sum);
                $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
                $start = ($page - 1) * $sum;
                $no = $start;
            ?>
      </div>

            <div class="pnn ml" style="padding:20px">
                <table class="table">
                    <thead>
                        <th>No</th>
                        <th>Kode Simpanan</th>
                        <th>Kategori Simpanan</th>
                        <th>Waktu</th>
                        <th>Anggota</th>
                        <th>Nominal</th>
                        <th colspan="2">Opsi</th>
                    </thead>
                    <tbody id="data">
                        <?php
                            foreach($db->selectAllLimit('simpanan',$start,$sum) as $r){
                                $no++;
                        ?>
                        <tr>
                            <td><?=$no?></td>
                            <td><a href="?det&kd=<?=$r[0]?>" class="w3-fdef" title="Lihat Detail"><?=$r[0]?></a></td>
                            <?php $dtt = $db->selectID('kategori_simpanan',$r[1]);
                            $dtt_ = $dtt->fetch();
                            ?>
                            <td>
                                <?php
                                if($dtt_[1]=='pokok')
                                    echo "<label class='label label-default'>";
                                elseif($dtt_[1]=='wajib')
                                    echo "<label class='label label-info'>";
                                elseif($dtt_[1]=='sukarela')
                                    echo "<label class='label label-warning'>";
                                ?>
                            <?=$dtt_[1]?>
                            </td>
                            <td><?=$r[3]?></td>
                            <?php $dtt = $db->selectID('anggota',$r[2]);
                            $dtt_ = $dtt->fetch();
                            ?>
                            <td><?=$dtt_[1]?></td>
                            <td><?=number_format($r[4])?></td>
                            <td class="center"><a href="crud/delete?sp&kd=<?=$r[0]?>" onClick="\return Confirm('Yakin hapus?');/"><i class="fa fa-trash-o w3-ftoss icon"></i></a></td>

                        </tr>
                            <?php
                                }
                            ?> 
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><b>TOTAL :</td>
                            <td><b>Rp <?php number_format($db->sum());?></td>
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
                    $data = $db->selectID('anggota',$_GET['kd']);
                    $r = $data->fetch();
                ?>
            </div>
            <a onclick="window.history.go(-1)" class="w3-fdef">
                <div class="l-menu tooltips" data-placement="bottom" data-original-title="Tambah Data">
                    <span class="fa fa-arrow-left semi-circ fa-lg" > Kembali</span> 
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
                            <th colspan="2">Detail Anggota</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="8" style="width:120px"><img src="<?=$r[8]?>" style="width:100px"></td>
                            </tr>
                            <tr>
                                <td style="width:30%">Kode ANggota</td>
                                <td>:</td>
                                <td><?=$r[0]?></td>
                            </tr>
                            <tr>
                                <td>Nama Anggota</td>
                                <td>:</td>
                                <td><?=$r[1]?></td>
                            </tr>
                            <tr>
                                <td>Tanggal Registrasi</td>
                                <td>:</td>
                                <td><?=$r[2]?></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td><?=$r[3]?></td>
                            </tr>
                            <tr>
                                <td>No. Telepon</td>
                                <td>:</td>
                                <td><?=$r[4]?></td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>:</td>
                                <td><?=$r[5]?></td>
                            </tr>
                            <tr>
                                <td>Tempat, Tanggal Lahir</td>
                                <td>:</td>
                                <td><?=$r[6].", ".$r['tgl_lahir']?></td>
                            </tr>
                        </tbody>
                    </table>

                <?php
                    } //detail

                function edit(){
                $db = new database();
                $query = $db->selectID('anggota',$_GET['kd']);
                $r = $query->fetch();
                ?>

                <a onclick="window.history.go(-1)" class="w3-fdef">
                <div class="l-menu tooltips" data-placement="bottom" data-original-title="Tambah Data">
                    <span class="fa fa-arrow-left semi-circ fa-lg"> Kembali</span> 
                </div>
                </a>
            <div class="pnn ml" style="padding:20px">
                <form action="crud/update?a" method="post" enctype="multipart/form-data">
                        <table class="form-crud">
                            <tr>
                                <input name="ft" type="hidden" class="form-control" value="<?=$r[8]?>">
                                <td>Kode Anggota</td>
                                <td>:</td>
                                <td><input name="kd" type="text" class="form-control" value="<?=$r[0]?>" readonly></td>
                            </tr>
                            <tr>
                                <td>Nama Anggota</td>
                                <td>:</td>
                                <td><input name="nm" type="text" class="form-control" value="<?=$r[1]?>"></td>
                            </tr>
                            <tr>
                                <td>Tanggal Registrasi</td>
                                <td>:</td>
                                <td><input name="tgl" type="date" class="form-control" value="<?=$r[2]?>"></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td><input name="alm" type="text" class="form-control" value="<?=$r[3]?>"></td>
                            </tr>
                             <tr>
                                <td>No. Telepon</td>
                                <td>:</td>
                                <td><input name="telp" type="text" class="form-control" value="<?=$r[4]?>"></td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>:</td>
                                <td>
                                    <select class="form-control" name="jk">
                                        <option value="P" <?=(($r[5] == 'P' ? 'selected' : ''))?>>Perempuan</option>
                                        <option value="L" <?=(($r[5] == 'L' ? 'selected' : ''))?>>Laki - laki</option>
                                    </select>
                                </td>
                            </tr>
                             <tr>
                                <td>Tempat Lahir</td>
                                <td>:</td>
                                <td><input name="tmp" type="text" class="form-control" value="<?=$r[6]?>"></td>
                            </tr>
                            <tr>
                                <td>Tanggal Lahir</td>
                                <td>:</td>
                                <td><input name="tgl_l" type="text" class="form-control" value="<?=$r[7]?>"></td>
                            </tr>
                            <tr>
                                <td>Foto</td>
                                <td>:</td>
                                <td><input name="foto" type="file" class="form-control" value="<?=$r[8]?>"></td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="submit" name="update" value="update">

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
                elseif(isset($_POST['update'])){
                    echo "hu";
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