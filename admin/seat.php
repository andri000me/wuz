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
                                <h5>DATA SEAT</h5>
            <?php

            function index(){
                $db = new database();
                $crud = new crud();
                $sum=20;
                $jum = $db->selectCount('seat');
                $halaman=ceil($jum / $sum);
                $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
                $start = ($page - 1) * $sum;
                $no = $start;
            ?>
        </div>
        <?php if($_SESSION['level_user']=='SA'){ ?>
        <a href="seat_csv">
            <button style="margin:15px 10px 15px 30px" class="btn btn-info col-md-2" title="Tambah data massal"> 
                <span class="fa fa-plus"></span> Tambah Data Massal
            </button>
        </a>
        <?php } ?>
        <a href="csv/export.php?ex&key=seat">
            <button style="margin:15px 10px 15px 20px" class="btn btn-success col-md-2" title="Download Data CSV"> 
                <span class="fa fa-arrow-down"></span> Data CSV
            </button>
        </a>

        <a href="reports/seat" target="_blank">
            <button style="margin:15px 20px" class="btn btn-danger col-md-2" title="Data PDF"> 
                <span class="fa fa-file"></span> Data PDF
            </button>
        </a>

        <?php if($_SESSION['level_user']=='SA'){ ?>
        <br><br><br><br>

        <form method="POST" action="crud/create?s" style="margin-left: 20px">
            <div class="col-md-2 left w3-def">
                Kode : <input name="kd" type="text" class="form-control" placeholder="Example : A01G1" required title="Isi dengan 5 digit">
            </div>
            <div class="col-md-4 left w3-def">
                Reservation : 
                <select name="kd_trans" class="form-control" required>
                    <?php
                        foreach($crud->selectAll('transportation') as $t){
                            $j = substr($t[3], 1);
                            echo "<option value=".$t[0].">".$t[0]." - ".(($j=='T')?'Kereta ':'Pesawat ').$t[1]."</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="col-md-1">
                <br><input type="submit" class="btn btn-info" value="Tambah" name="tambah">
            </div>
        </form>
            
            <?php } ?>


        <?php if($_SESSION['level_user']=='SA'){ ?>
        <br><br><br>
            <?php } ?>

            <div class="pnn ml" style="padding:20px">
                <table class="table" style="width:70%">
                    <thead>
                        <th>No</th>
                        <th>ID</th>
                        <th>Kode Seat</th>
                        <th>Transportation</th>

                        <?php if($_SESSION['level_user']=='SA'){ ?>
                        <th colspan="2">Opsi</th>
                        <?php } ?>
                    </thead>
                    <tbody id="data">
                        <?php
                            foreach($db->selectAllLimit('seat',$start,$sum) as $r){
                                $no++;
                        ?>
                        <tr>
                            <td><?=$no?></td>
                            <td><?=$r[0]?></td>
                            <td><?=$r[1]?></td>
                            <?php
                                $data = $db->selectID('transportation',$r[2]);
                                $r_ = $data->fetch();
                                $j_ = substr($r_[3], 1);
                            ?>
                            <td><?=$r[2]." - ".(($j_=='T')?'Kereta ':'Pesawat ').$r_[1]?></td>
                            <?php if($_SESSION['level_user']=='SA'){ ?>
                            <td class="center"><a href="?ed&kd=<?=$r[0]?>"><i class="fa fa-edit w3-ftoss icon"></i></a></td>
                            <td class="center"><?="<a href=crud/delete?s&kd=$r[0] onClick=\"return confirm('Yakin hapus data $r[1]?');\">";?><i class="fa fa-trash-o w3-text-red icon"></i></a></td>
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
                $crud = new crud();
                $data = " id='".$_GET['kd']."'";
                $query = $db->select('seat', $data);
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
                                <td>ID Seat</td>
                                <td>:</td>
                                <td class="td-pad" style="width:250px"><input name="id" type="text" class="form-control" value="<?=$r[0]?>" readonly></td>
                            </tr>
                            <tr>
                                <td>Kode Seat</td>
                                <td>:</td>
                                <td class="td-pad" style="width:250px"><input name="kd" type="text" class="form-control" value="<?=$r[1]?>"></td>
                            </tr>
                            <tr>
                                <td>Transportation</td>
                                <td>:</td>
                                <td  class="td-pad">
                                    <select name="kd_trans" class="form-control" required>
                                        <?php
                                            foreach($crud->selectAll('transportation') as $t){
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