<?php
include "header.php";
include "sidebar.php";
?>
<!-- AJAX PENCARIAN -->
<script language="javascript">
    var ajax;
    
    function initAjax(){
        try{
            ajax = new XMLHttpRequest;
        }
        catch(e){
            try{
                ajax = new ActiveXObject("Msxml2.XMLHTTP");
            }
            catch(e){
                try{
                    ajax = new ActiveXObject("Microsoft.XMLHTTP");
                }
                catch(e){
                    alert("Ooops! Browser Anda tak support AJAX");
                    return false;
                }
            }
        }
    }
    function validasi(keyEvent){
        keyEvent = (keyEvent) ? keyEvent : window.event;
        input = (keyEvent.target) ? keyEvent.target : keyEvent.srcElement;
        if(keyEvent.type=="keyup"){
            var targetDiv = document.getElementById("hasilcari");
            targetDiv.innerHTML="";
            if(input.value){
                hasilCari("search_ajax?anggota_pj="+ input.value);
            }
        }
    }
    function hasilCari(dataSource){
        initAjax();
        if(ajax){
            ajax.open("GET",dataSource);
            ajax.onreadystatechange = 
            function(){
                if(ajax.readyState == 4 && ajax.status == 200){
                    var targetDiv = document.getElementById("hasilcari");
                    targetDiv.innerHTML = ajax.responseText;
                }
            }
            ajax.send(null);
        }
    }
</script>

      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">

              <div class="row">
                  <div class="col-lg-12">
                  
                      <div class="row mt">
                        <div class="col-md-12 col-sm-4 mb" style="z-index:1002">
                          <div class="white-panel pnn">
                            <div class="white-header goleft ml">
                                <h5>PINJAMAN</h5>
        
            <?php

             function index(){
                $db = new database();
            ?>
            <a href="?tam" class="w3-fdef">
                <div class="l-menu tooltips" data-placement="bottom" data-original-title="Tambah Data" style="position: absolute">
                    <span class="fa fa-eye semi-circ fa-lg" > Lihat Data</span> 
                </div>
            </a>
            <a href="?ind" data-toggle="modal" data-target="#myModal">
             <div class="r-menu" data-placement="bottom" data-original-title="Tambah Data">
                    <span class="fa fa-plus circle fa-lg"> </span> 
                </div>
            </a> 
        </div>

            <div class="pnn ml" style="padding:20px">
                
                <!-- INPUT ITEM TRANSAKSI -->

<!--  PENCARIAN -->
    <div class="col-md-6">
        <table class="table" style="font-size:11pt">
            <thead>
                <h4><label class="label label-info">
                Pencarian
                </label></h4>
            </thead>
            <tbody>
                    <tr>
                        <td>
                            <input type="text" onkeyup = "validasi(event);" class="form-control col=md-4" placeholder="Cari barang berdasar kode / nama barang">
                        </td>
                    </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-6">
        <table class="table" style="font-size:11pt">
            <thead>
                <h4><label class="label label-success">
                Hasil Pencarian
                </label></h4>
            </thead>
            <tbody><tr><td><div id="hasilcari"></div></td></tr>
            </tbody>
        </table>
    </div>

<!--  TAMPIL DATA SESSION -->
<form method="post" action="crud/create?pj">
    <table class="table" style="font-size:11pt;width:80%">
        <thead>
            <th>Data Peminjaman</th>
        </thead>
            <tbody>
            <?php 
                $total = 0;
                $jum = 0;
                if(isset($_SESSION['bayar'])){
                    foreach ($_SESSION['bayar'] as $key => $value) {
                        $qry = $db->selectID('anggota',$key);
                        $r = $qry->fetch();
                ?>
                <tr>
                    <td style="width:30%">Kode Anggota</td>
                    <td>:</td>
                    <td><input type="text" name="kd" value="<?=$r[0]?>" class="form-control" readonly></td>
                </tr>
                <tr>
                    <td>Nama Anggota</td>
                    <td>:</td>
                    <td><input type="text" name="nm" value="<?=$r[1]?>" class="form-control" readonly></td>
                </tr>
                <tr>
                    <td>Besar Pinjaman</td>
                    <td>:</td>
                    <td><input type="text" name="nom" placeholder="Besar Pinjaman" class="form-control"> </td>
                </tr>
                <tr>
                    <td>Lama Angsuran</td>
                    <td>:</td>
                    <td>
                        <select name="lm" class="form-control">
                            <option value="2">2 Bulan</option>
                            <option value="3">3 Bulan</option>
                            <option value="6">6 Bulan</option>
                            <option value="10">10 Bulan</option>
                            <option value="12">12 Bulan</option>
                            <option value="18">18 Bulan</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Bunga</td>
                    <td>:</td>
                    <td><input type="text" name="bn" class="form-control" value="1,25" readonly=""> </td>
                </tr>
                    <td><a href="?act=hapus&kd=<?=$r[0]?>&ref=pinjamam"><input type="button" class="btn btn-danger" value="Batal"></a>
                    <input type="submit" class="btn btn-info" value="Simpan"></td>
                </tr>
                <?php
                    } 
                } ?>
            </tbody>
    </table>
</form>
    <p class="w3-fdef goright"><i><b>Petugas : <?=$_SESSION['nama']?></i></b></p>
</div>
                <?php
                    } //index

            function tampil(){
                $db = new database();
                $sum=20;
                $jum = $db->selectCount('anggota');
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
                        <th>Kode Pinjaman</th>
                        <th>Nama Anggota</th>
                        <th>Tanggal</th>
                        <th>Nominal</th>
                        <th>Pegawai</th>
                        <th colspan="3">Opsi</th>
                    </thead>
                    <tbody id="data">
                        <?php
                            foreach($db->selectAllLimit('pinjaman',$start,$sum) as $r){
                                $no++;
                        ?>
                        <tr>
                            <td><?=$no?></td>
                            <td><a href="?det&kd=<?=$r[0]?>" class="w3-fdef" title="Lihat Detail"><?=$r[0]?></a></td>
                            <?php
                            $data = $db->selectID('anggota',$r[2]);
                            $data_ = $data->fetch();
                            ?>
                            <td><a href="anggota?det&kd=<?=$data_[0]?>">(<?=$data_[0]?>)</a> <?=$data_[1]?></td>
                            <td><?=$r[3]?></td>
                            <td><?=$r[4]?></td>
                            <?php
                            $dtt = $db->selectID('pegawai',$r[3]);
                            $dtt_ = $dtt->fetch();
                            ?>
                            <td><?=$dtt_[1]?></td>
                            <td class="center"><a href="reports/bukti?id=<?=$r[0]?>" target="_blank"><i class="fa fa-print w3-fdef icon"></i></a></td>
                            <td class="center"><a href="crud/delete?sp&kd=<?=$r[0]?>" onClick="\return Confirm('Yakin hapus?');/"><i class="fa fa-trash-o w3-ftoss icon"></i></a></td>

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
                    } //tam

                if(isset($_GET['tam'])){
                    tampil();
                }
                elseif(isset($_GET['ind'])){
                    index();
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

    function clear(){
    if (isset($_SESSION['bayar'])) {
                foreach ($_SESSION['bayar'] as $key => $val) {
                    unset($_SESSION['bayar'][$key]);
                }
                unset($_SESSION['bayar']);
                unset($_SESSION['final']);
                unset($_SESSION['total']);
            }
}


if(isset($_GET['act']) && isset($_GET['ref'])){
    $act = $_GET['act'];
    $ref = $_GET['ref'];

    if($act == "add"){
        if(isset($_GET['kd'])){
            $qr = $d->prepare("SELECT * FROM simpanan where kd_kategori_simpanan='K1' AND kd_anggota='$_GET[kd]'");
            $qr->execute();
            $jm = $qr->rowCount();
            if($jm==0){
                echo "<script>alert('Maaf, Anggota belum mengisi simpanan pokok');
                        window.location.href='simpanan_pokok';</script>";
            }
            else{

            $kd = $_GET['kd'];
            foreach($db->selectID('anggota',$kd) as $r){

                    if(isset($_SESSION['bayar'][$kd])){
                        $_SESSION['bayar'][$kd] += 1;
                        } else {
                        $_SESSION['bayar'][$kd] = 1;
                    
                }
            }
        }
        }
    }
    elseif($act == "hapus"){
        if(isset($_GET['kd'])){
            $kd = $_GET['kd'];
            if(isset($_SESSION['bayar'][$kd])){
                unset($_SESSION['bayar'][$kd]);
            } 
        }
    }
    elseif ($act == "clear") {
        clear();
    } 
    echo "<script>";
    echo "window.location.href='".$ref."';";
    echo "</script>";
}  


include "footer.php";
?>