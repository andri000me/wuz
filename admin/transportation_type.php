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
                                <h5>TRANSPORTATION TYPE</h5>
            <?php

            function index(){
                $db = new database();
                $sum=20;
                $jum = $db->selectCount('transportation_type');
                $halaman=ceil($jum / $sum);
                $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
                $start = ($page - 1) * $sum;
                $no = $start;
            ?>
        </div>

        <a href="csv/export.php?ex&key=transportation_type">
            <button style="margin:15px 30px" class="btn btn-success col-md-2" title="Download Data CSV"> 
                <span class="fa fa-arrow-down"></span> Data CSV
            </button>
        </a>
        <a href="reports/transportation_type" target="_blank">
            <button style="margin:15px 20px" class="btn btn-danger col-md-2" title="Data PDF"> 
                <span class="fa fa-file"></span> Data PDF
            </button>
        </a>
        <br><br><br><br>

        <?php
            if($_SESSION['level_user']=='SA'){
        ?>
        <form method="POST" action="crud/create?tt" style="margin-left: 20px">
            <div class="col-md-2 left w3-def">
                Kode : <input name="kd" type="text" class="form-control" placeholder="Kode" required title="Isi dengan 2 - 3 digit huruf kapital">
            </div>
            <div class="col-md-4 left w3-def">
                Nama : <input name="desk" type="text" class="form-control" placeholder="Nama">
            </div>
            <div class="col-md-2">
                <br><input type="submit" class="btn btn-info" value="Tambah" name="tambah">
            </div>
        </form>
        <br><br><br><br>
        <?php } ?>

            <div class="pnn ml" style="padding:20px">
                <table class="table" style="width:85%">
                    <thead>
                        <th>No</th>
                        <th>Kode Transportation Type</th>
                        <th>Nama Transportation Type</th>
                        <?php
                            if($_SESSION['level_user']=='SA'){
                          ?>
                        <th colspan="2">Opsi</th>
                        <?php } ?>
                    </thead>
                    <tbody id="data">
                        <?php
                            foreach($db->selectAllLimit('transportation_type',$start,$sum) as $r){
                                $no++;
                        ?>
                        <tr>
                            <td><?=$no?></td>
                            <td><?=$r[0]?></td>
                            <td><?=$r[1]?></td>
                            <?php
                                if($_SESSION['level_user']=='SA'){
                              ?>
                            <td class="center"><a href="?ed&kd=<?=$r[0]?>"><i class="fa fa-edit w3-ftoss icon"></i></a></td>
                            <td class="center"><?="<a href=crud/delete?tt&kd=$r[0] onClick=\"return confirm('Yakin hapus data $r[1]?');\">";?><i class="fa fa-trash-o w3-text-red icon"></i></a></td>
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

                function edit(){
                $db = new database();
                $data = " kd_tt='".$_GET['kd']."'";
                $query = $db->select('transportation_type', $data);
                $r = $query->fetch();
                ?>

                <a onclick="window.history.go(-1)" class="w3-fdef">
                <div class="l-menu tooltips" data-placement="bottom" data-original-title="Tambah Data">
                    <span class="fa fa-arrow-left semi-circ fa-lg"> Kembali</span> 
                </div>
                </a>

        </div>
            <div class="pnn ml" style="padding:20px; margin-top: 60px; padding-bottom: 100px!important">
                <form action="crud/update?tt" method="post" enctype="multipart/form-data" class="form-group">
                        <table class="form-crud">
                            <tr>
                                <td>Kode Transportation Type</td>
                                <td>:</td>
                                <td class="td-pad" style="width:250px"><input name="kd" type="text" class="form-control" value="<?=$r[0]?>" readonly></td>
                            </tr>
                            <tr>
                                <td>Nama </td>
                                <td>:</td>
                                <td  class="td-pad"><input name="desk" type="text" class="form-control" value="<?=$r[1]?>"></td>
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