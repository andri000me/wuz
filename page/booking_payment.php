<?php
include "header.php";
include "menu_booking.php";
include "book.php";
?>
<br><br>
<?php
if (empty($_SESSION)){
	session_start();
}
if(!isset($_SESSION['idseat'])){
  echo "<script>window.location.href='index';</script>";
} else{


function pembayaran(){
        $db = new database();
        include "book.php";
    ?>
<div class="col-md-4" style="margin-left: 950px; width:315px">
        <h3>Data Perjalanan</h3>
        <br>
          <blockquote class="bq-blue" style="border-left:1px solid #ddd; background:#ececec">
            Waktu Perjalanan <br>
            <small><?=$_SESSION['date']?></small>
            <br>
            Waktu Keberangkatan
            <small>
              <?php
              $hm = date_create($data[1]);
              $hmm = date_format($hm,"H:i")
              ?>
              <?=$hmm?></small>
            <br>
            <?php
            $qry = $db->selectID('transportation', $_SESSION['id_transportasi']);
            $dt_trans = $qry->fetch();
            echo "<b>$dt_trans[1]</b>";

            $qry = $db->selectID('place', $data[2]);
            $dt_asal = $qry->fetch();
            echo "<br>$dt_asal[1] <span class='glyphicon glyphicon-arrow-right' style='font-size:12px'> </span>";

            $qry = $db->selectID('place', $data[3]);
            $dt_tuj = $qry->fetch();
            echo " $dt_tuj[1]";
            ?>
            <br><br>
            Kursi
            <br>
            <?php
            for ($i=1; $i <= $_SESSION['jml_penumpang'] ; $i++) { 
              echo "<b>".$_SESSION['seat'][$i].", ";
            }
            ?>
          </blockquote>
      </div>  


<div class="form-cari">
      <div class="form-container">
        <div class="w3-sidebar w3-bar-block w3-light-grey" style="width:150px;top:85px;height: 480px">
          <button class="w3-bar-item bg-blue"><b><h5>Pembayaran</b></h5></button>
          <button class="w3-bar-item w3-button tablink" onclick="openCity(event, 'transfer')">Transfer </button>
          <button class="w3-bar-item w3-button tablink" onclick="openCity(event, 'indomaret')">Indomaret  </button>
          <button class="w3-bar-item w3-button tablink" onclick="openCity(event, 'alfamart')">Alfamart  </button>
        </div>

        <div class="form-cari-body" style="top:18%;width:340%; height:460px">
          <div id="menu" class="w3-container">
             <form action="?transfer" class="form-group" method="post">
                <div class="col-md-3 left">
                  <h4 class="text-blue">Transfer</h4>
              </div>
              <div class="col-md-11">
                  <br>
                <div class="col-md-5">
                  <form action="#">
                    <p>
                    <input type="radio" id="test1" name="radio-group" value="BCA" checked>
                    <label for="test1" style="left:-80px">BCA</label></p>
                    <p>
                    <input type="radio" id="test2" name="radio-group" value="BRI">
                    <label for="test2" style="left:-83px">BRI </label></p>
                  </p>
                  <p>
                    <input type="radio" id="test3" name="radio-group" value="Mandiri">
                    <label for="test3" style="left:-69px">Mandiri</label>
                  </p>
            </div>

                  <div class="col-md-5" style="text-align: left;padding-left: 28px">
                    <img src="../assets/img/payment/bca.png" style="height:35px"><br>
                    <img src="../assets/img/payment/bri.png" style="height:28px"><br>
                    <img src="../assets/img/payment/mandiri.png" style="height:26px">
                  </div>
                  <br><br><br><br><br><br><br>

                <div class="col-md-9 left">
                    <h4>Detail Harga</h4>
                </div>
                    <br><br>
                        <div class="col-md-6 left">
                            Harga <?=number_format($data['price'])?> x <?=$_SESSION['jml_penumpang']?>
                            <br>
                            Biaya Administrasi
                        </div>
                        <div class="col-md-4 text-blue" style="text-align: right">
                            <?=number_format($jumlah_harga)?>
                            <br>
                            <?=number_format(10000)?>
                        </div>
                        <hr><hr>
                        <div class="col-md-6 left">
                            <h4>Total</h4>
                        </div>
                        <div class="col-md-4 text-blue" style="text-align: right">
                            <?php $_SESSION['total_harga'] = $jumlah_harga+10000 ?>
                            <h4 class="text-blue"><b>Rp <?=number_format($_SESSION['total_harga'])?></b></h4>
                        </div>
                    </div>
                   <div class="col-md-12">
                        <br><p style="right: 46px">
                      <input type="submit" class="btn bg-blue" name="payment" value="Lanjut dengan Transfer">
                  </p>
                    </div>
               </div>
            </form>
        
          <div id="transfer" class="w3-container pay" style="display:none;">
             <form action="?transfer" class="form-group" method="post">
                <div class="col-md-6">
                <div class="col-md-3 left">
                  <h4 class="text-blue">Transfer</h4>
              </div>
                </div>
              <div class="col-md-11">
                  <br>
                <div class="col-md-5">
                    <p>
                    <input type="radio" id="test4" name="radio-group"  value="BCA" checked>
                    <label for="test4" style="left:-80px">BCA</label></p>
                    <p>
                    <input type="radio" id="test5" name="radio-group" value="BRI">
                    <label for="test5" style="left:-83px">BRI </label></p>
                  </p>
                  <p>
                    <input type="radio" id="test6" name="radio-group" value="Mandiri">
                    <label for="test6" style="left:-69px">Mandiri</label>
                  </p>
            </div>

                  <div class="col-md-5" style="text-align: left;padding-left: 28px">
                    <img src="../assets/img/payment/bca.png" style="height:35px"><br>
                    <img src="../assets/img/payment/bri.png" style="height:28px"><br>
                    <img src="../assets/img/payment/mandiri.png" style="height:26px">
                  </div>
                  <br><br><br><br><br><br><br>
                <div class="col-md-12"">
                <div class="col-md-10 left">
                    <h4>Detail Harga</h4>
                </div>
                    <br><br>
                        <div class="col-md-5 left">
                            Harga <?=number_format($data['price'])?> x <?=$_SESSION['jml_penumpang']?>
                            <br>
                            Biaya Administrasi
                        </div>
                        <div class="col-md-4 text-blue left" style="text-align: right">
                            <?=number_format($jumlah_harga)?>
                            <br>
                            <?=number_format(10000)?>
                        </div>
                        <hr><hr>
                        <div class="col-md-5 left">
                            <h4>Total</h4>
                        </div>
                        <div class="col-md-4 text-blue left" style="text-align: right">
                            <?php $_SESSION['total_harga'] = $jumlah_harga+10000 ?>
                            <h4 class="text-blue"><b>Rp <?=number_format($_SESSION['total_harga'])?></b></h4>
                        </div>
                    </div>
                   <div class="col-md-12">
                        <br><p style="left: 360px">
                      <input type="submit" class="btn bg-blue" name="payment" value="Lanjut dengan Transfer">
                  </p>
                    </div>
               </div>
            </form>
         </div>

           <div id="indomaret" class="w3-container pay" style="display:none;z-index: 555">
             <form action="?indoalfa&indo" class="form-group" method="post">
                <div class="col-md-12">
                <div class="col-md-3 left">
                  <h4 class="text-blue">Indomaret</h4>
                  <input type="hidden" name="hula" value="Indomaret">
              </div>
                </div>
              <div class="col-md-11">
                  <br>
                <div class="col-md-12">
                   <pre>Pembayaran menggunakan Indomaret dikenakan biaya <br>Rp 2000 untuk administrasi Indomaret</pre>
            </div>

                  <br><br><br><br><br><br>
                <div class="col-md-12">
                <div class="col-md-10 left">
                    <h4>Detail Harga</h4>
                </div>
                    <br><br>
                        <div class="col-md-5 left">
                            Harga <?=number_format($data['price'])?> x <?=$_SESSION['jml_penumpang']?>
                            <br>
                            Biaya Administrasi
                        </div>
                        <div class="col-md-4 text-blue left" style="text-align: right">
                            <?=number_format($jumlah_harga)?>
                            <br>
                            <?=number_format(10000)?>
                        </div>
                        <br><br><br><br>
                        <div class="col-md-5 left">
                            <h4>Total</h4>
                        </div>
                        <div class="col-md-4 text-blue left" style="text-align: right">
                            <?php $_SESSION['total_harga'] = $jumlah_harga+10000 ?>
                            <h4 class="text-blue"><b>Rp <?=number_format($_SESSION['total_harga'])?></b></h4>
                        </div>
                    </div>
                   <div class="col-md-12">
                        <br><p style="left: 360px">
                      <input type="submit" class="btn bg-blue" name="payment" value="Lanjut dengan Indomaret">
                  </p>
                    </div>
               </div>
            </form>
             </div>


             <div id="alfamart" class="w3-container pay" style="display:none">
             <form action="?indoalfa&alfa" class="form-group" method="post">
                <div class="col-md-12">
                <div class="col-md-3 left">
                  <h4 class="text-blue">Alfamart</h4>
                  <input type="hidden" name="hula" valuee="Alfamart">
              </div>
                </div>
              <div class="col-md-11">
                  <br>
                <div class="col-md-12">
                   <pre>Pembayaran menggunakan Alfamart dikenakan biaya <br>Rp 2000 untuk administrasi Alfamart</pre>
            </div>

                  <br><br><br><br><br><br>
                <div class="col-md-12">
                <div class="col-md-10 left">
                    <h4>Detail Harga</h4>
                </div>
                    <br><br>
                        <div class="col-md-5 left">
                            Harga <?=number_format($data['price'])?> x <?=$_SESSION['jml_penumpang']?>
                            <br>
                            Biaya Administrasi
                        </div>
                        <div class="col-md-4 text-blue left" style="text-align: right">
                            <?=number_format($jumlah_harga)?>
                            <br>
                            <?=number_format(10000)?>
                        </div>
                        <br><br><br><br>
                        <div class="col-md-5 left">
                            <h4>Total</h4>
                        </div>
                        <div class="col-md-4 text-blue left" style="text-align: right">
                            <?php $_SESSION['total_harga'] = $jumlah_harga+10000 ?>
                            <h4 class="text-blue"><b>Rp <?=number_format($_SESSION['total_harga'])?></b></h4>
                        </div>
                    </div>
                   <div class="col-md-12">
                        <br><p style="left: 360px">
                      <input type="submit" class="btn bg-blue" name="payment" value="Lanjut degan Alfamart">
                  </p>
                    </div>
               </div>
            </form>

        </div> <!-- form-cari-body -->

      </div> <!-- form-container -->
    </div>

<?php
}

// TRANSFER
if(isset($_GET['transfer'])){
  // BILA BELUM LOGIN
  if(!isset($_SESSION['username_cust'])){
    echo "<script type='text/javascript'>
        alert('Satu langkah lagi.. Anda harus login dahulu!');
        window.location.href='login?log';
        </script>";
  } else{

    $_SESSION['pembayaran'] = $_POST['radio-group'];
?>
<div class="content">
        <div class="container" style="width:84%;padding: 20px 0px 50px 150px; color: #434343">

        <div class="col-md-12" style="margin-bottom: 15px">
            <div class="col-md-9" style="margin-left: 30px">
                <h3>Payment</h3>
                <br>
                <blockquote class="bq-blue"><i class="fa fa-check"> </i> Data pilihan Payment Anda telah tersimpan</blockquote>
            </div>

            <div class="col-md-5" style="margin-left: 30px">
                <h4>Payment's Instruction</h4>
                    <blockquote class="bq-blue">
                        1. Transfer uang SESUAI dengan nominal yang tertera pada Detail Harga<br>
                        <br>
                        2. Pilihan Bank yang Anda pilih adalah <?=$_SESSION['pembayaran']?>, transfer ke rekening : 
                        <?php
                            if($_SESSION['pembayaran']=='Mandiri'){
                        ?>
                        <small style="font-size: 16px">Wuz : <b>785563547365</b> (Mandiri)</small>
                        <small style="font-size: 16px">Wuz Payment : <b>761123456379</b> (Mandiri)</small>
                        <?php
                        } elseif($_SESSION['pembayaran']=='BCA'){
                        ?>
                        <small style="font-size: 16px">Wuz : <b>874563547373</b> (BCA)</small>
                        <small style="font-size: 16px">Wuz Payment : <b>993112316371</b> (BCA)</small>
                        <?php
                        } elseif($_SESSION['pembayaran']=='BRI'){
                        ?>
                        <small style="font-size: 16px">Wuz : <b>813456354122</b> (BRI)</small>
                        <small style="font-size: 16px">Wuz Payment : <b>343112316370</b> (BRI)</small>
                        <?php
                        }     ?>
                        <br>
                        3. Selesaikan transaksi Anda<br><br>
                        4. Login kembali di Website Wuz dan lakukan konfirmasi pembayaran agar E-ticket Anda segera dikirim
                    </blockquote>

                <br>
                <h4>Data Penumpang</h4>
                  <?php
                  if($_SESSION['jml_penumpang']==1){
                  ?>
                  <blockquote class="bq-blue" style="height:90px">
                  <?php
                    echo $_SESSION['title']." ".$_SESSION['nama_pas'];?>
                    <br><?=$_SESSION['tipe_id']." : ".$_SESSION['nomorid'];
                  }
                  else{
                    echo '<blockquote class="bq-blue" style="height:150px">';
                    for($i=1;$i<=$_SESSION['jml_penumpang'];$i++){
                      $t = 'title'.$i;
                      $n = 'nama_pas'.$i;
                      $tid = 'tipe_id'.$i;
                      $nid = 'nomorid'.$i;
                    ?>
                    <?=$i?>. <?=$_SESSION[$t]." ".$_SESSION[$n]?>
                    <br><?=$_SESSION[$tid]." : ".$_SESSION[$nid]."<br><br>";
                  }
                  ?>
                  <br>
                  <hr>

                    <?php
                    }
                    ?>
                    </blockquote>

                    <h4>Detail Harga</h4>
                    <blockquote class="bq-blue" style="padding: 30px 10px 40px">
                        <div class="col-md-6">
                            Harga <?=number_format($data['price'])?> x <?=$_SESSION['jml_penumpang']?>
                            <br>
                            Biaya Administrasi
                        </div>
                        <div class="col-md-4 text-blue" style="text-align: right">
                            <?=number_format($jumlah_harga)?>
                            <br>
                            <?=number_format(10000)?>
                        </div>
                        <hr><hr>
                        <div class="col-md-6">
                            <h4>Total</h4>
                        </div>
                        <div class="col-md-4 text-blue" style="text-align: right">
                            <?php $_SESSION['total_harga'] = $jumlah_harga+10000 ?>
                            <h4 class="text-blue"><b>Rp <?=number_format($_SESSION['total_harga'])?></b></h4>
                        </div>
                    </blockquote>
                    <br>
                    <h4>Wuz's Gift</h4>
                    <blockquote class="bq-blue" style="padding: 10px 10px 40px">
                        <?php 
                          $dataa = " username='".$_SESSION['username_cust']."' AND nm_customer='".$_SESSION['nama_cust']."'";
                          $gi = $db->select('customer',$dataa);
                          $gift = $gi->fetch();
                          if($gift['gift']>0){
                            $_SESSION['gift'] = $gift['gift'];
                            $_SESSION['potong'] = $_SESSION['total_harga']-$_SESSION['gift']; 
                            ?>
                          <br>
                          Anda memiliki Wuz's Gift sebesar <b class="text-blue"> Rp <?=number_format($_SESSION['gift'])?></b>
                          <br> Bila digunakan, Anda mendapat potongan sesuai Wuz's Gift milik Anda
                          <br>Sehingga Anda hanya perlu membayar sebesar 
                          <h4 class="text-blue center"><b> Rp <?=number_format($_SESSION['potong'])?></b></h4>
                          <small>Klik Lanjut dengan Gift bila ingin menggunakannya</small>
                          <small> Data akan langsung tersimpan saat Anda menekan Klik</small>
                    </blockquote>
                    <br>
                    <br>
                    <a href="booking_process?p=<?=$_SESSION['pembayaran']?>"><button name="lanjut" class="btn btn-warning"> Finish Tanpa Gift</button></a>
                    <a href="booking_process?p=<?=$_SESSION['pembayaran']?>&gift"><button name="lanjut" style="margin-right: 2px" class="btn bg-blue" style="float: right"> Finish Dengan Gift</button></a>
                  </div>
                          <?php
                          } else {
                          ?>
                          <br><small>Wuz's Gift milik Anda = Rp 0, lakukan transaksi untuk mengumpulkan Wuz's Gift</small>
                        </div>
                    </blockquote>
                    <br>
                    <br>
                    <a href="booking_process?p=<?=$_SESSION['pembayaran']?>"><button name="lanjut" class="btn bg-blue" style="bottom:0"> Finish</button></a>
                    <?php
                     }
                        ?>
       

            <div class="col-md-4" style="margin-left: 30px; width:315px">
                <h3>Data Perjalanan</h3>
                <br>
                    <blockquote class="bq-blue" style="border-left:1px solid #ddd; background:#ececec">
                        Waktu Perjalanan <br>
                        <small><?=$_SESSION['date']?></small>
                        <br>
                        Waktu Keberangkatan
                        <small>
                            <?php
                            $hm = date_create($data[1]);
                            $hmm = date_format($hm,"H:i")
                            ?>
                            <?=$hmm?></small>
                        <br>
                        <?php
                        $qry = $db->selectID('transportation', $_SESSION['id_transportasi']);
                        $dt_trans = $qry->fetch();
                        echo "<b>$dt_trans[1]</b>";

                        $qry = $db->selectID('place', $data[2]);
                        $dt_asal = $qry->fetch();
                        echo "<br>$dt_asal[1] <span class='glyphicon glyphicon-arrow-right' style='font-size:12px'> </span>";

                        $qry = $db->selectID('place', $data[3]);
                        $dt_tuj = $qry->fetch();
                        echo " $dt_tuj[1]";
                        ?>
                        <br><br>
                        Kursi
                        <br>
                        <?php
                        for ($i=1; $i <= $_SESSION['jml_penumpang'] ; $i++) { 
                          echo "<b>".$_SESSION['seat'][$i].", ";
                        }
                        ?>

                    </blockquote>
            </div>          

        </div> <!-- col md 12 -->

        </div>
        
    </div>
    <!-- /content -->

 <!-- <form method="POST" action="?fix&transfer_act&e=transfer_kon"> -->


<?php
  } //if
}

elseif(isset($_GET['indoalfa'])){
  if(!isset($_SESSION['username_cust'])){
    echo "<script type='text/javascript'>
        alert('Satu langkah lagi.. Anda harus login dahulu!');
        window.location.href='login?log';
        </script>";
  } else{
    if(isset($_GET['indo'])){
        $_SESSION['pembayaran'] = 'Indomaret';
    }
    elseif(isset($_GET['alfa'])){
        $_SESSION['pembayaran'] = 'Alfamart';
    }
?>

<div class="content">
        <div class="container" style="width:84%;padding: 20px 0px 50px 150px; color: #434343">

        <div class="col-md-12" style="margin-bottom: 15px">
            <div class="col-md-9" style="margin-left: 30px">
                <h3>Payment</h3>
                <br>
                <blockquote class="bq-blue"><i class="fa fa-check"> </i> Data pilihan Payment Anda telah tersimpan</blockquote>
            </div>

            <div class="col-md-5" style="margin-left: 30px">
                <h4>Payment's Instruction</h4>
                    <blockquote class="bq-blue">
                        1. Pembayaran yang Anda pilih adalah melalui <b><?=$_SESSION['pembayaran']?> </b>dengan kode:
                        <br> 
                            <div class="col-md-2 div-round" style="margin-left: 35%">
                         <?php

                            $string = 'lasdmutiaramzki';
                            $angka = '123456789';
                            $str ='';
                            for ($i = 0; $i<2; $i++){
                                $kode = rand(0,strlen($string)-1);
                                $str .= $string{$kode};
                            }
                            $ank ='';
                            for ($i = 0; $i<3; $i++){
                                $kd = rand(0,strlen($angka)-1);
                                $ank .= $angka{$kd};
                            }

                            $kd_market=$str.$ank;
                            $_SESSION['kd_pembayaran'] = $kd_market;
                             echo "<h4 style='text-align:center'><b>".$_SESSION['kd_pembayaran']."</b></h4>";
                         ?>
                         </div><br><br><br><br>
                        2. Datang ke kasir <?=$_SESSION['pembayaran']?>, dan katakan hendak melakukan transaksi Booking Ticket Wuz<br><br>
                        3. Tunjukkan kode Anda, selesaikan transaksi Anda
                        <small>Pembayaran jenis ini dikenakan biaya tambahan Rp 2000</small><br>
                        4. Login kembali di Website Wuz dan lakukan konfirmasi pembayaran agar E-ticket Anda segera dikirim
                    </blockquote>

                <br>
                  <h4>Data Penumpang</h4>
                     <?php
                  if($_SESSION['jml_penumpang']==1){
                  ?>
                  <blockquote class="bq-blue" style="height:90px">
                  <?php
                    echo $_SESSION['title']." ".$_SESSION['nama_pas'];?>
                    <br><?=$_SESSION['tipe_id']." : ".$_SESSION['nomorid'];
                  }
                  else{
                    echo '<blockquote class="bq-blue" style="height:150px">';
                    for($i=1;$i<=$_SESSION['jml_penumpang'];$i++){
                    $t = 'title'.$i;
                      $n = 'nama_pas'.$i;
                      $tid = 'tipe_id'.$i;
                      $nid = 'nomorid'.$i;
                    ?>
                    <?=$i?>. <?=$_SESSION[$t]." ".$_SESSION[$n]?>
                    <br><?=$_SESSION[$tid]." : ".$_SESSION[$nid]."<br><br>";
                  }
                  ?>
                    <br>
                    <hr>

                      <?php
                      }
                      ?>
                    </blockquote>

                    <h4>Detail Harga</h4>
                    <blockquote class="bq-blue" style="padding: 30px 10px 40px">
                        <div class="col-md-6">
                            Harga <?=number_format($data['price'])?> x <?=$_SESSION['jml_penumpang']?>
                            <br>
                            Biaya Administrasi
                        </div>
                        <div class="col-md-4 text-blue" style="text-align: right">
                            <?=number_format($jumlah_harga)?>
                            <br>
                            <?=number_format(10000)?>
                        </div>
                        <hr><hr>
                        <div class="col-md-6">
                            <h4>Total</h4>
                        </div>
                        <div class="col-md-4 text-blue" style="text-align: right">
                            <?php $_SESSION['total_harga'] = $jumlah_harga+10000 ?>
                            <h4 class="text-blue"><b>Rp <?=number_format($_SESSION['total_harga'])?></b></h4>
                        </div>
                    </blockquote>
                      <br>
                    <h4>Wuz's Gift</h4>
                    <blockquote class="bq-blue" style="padding: 10px 10px 40px">
                        <?php 
                          $dataa = " username='".$_SESSION['username_cust']."' AND nm_customer='".$_SESSION['nama_cust']."'";
                          $gi = $db->select('customer',$dataa);
                          $gift = $gi->fetch();
                          if($gift['gift']>0){
                            $_SESSION['gift'] = $gift['gift'];
                            $_SESSION['potong'] = $_SESSION['total_harga']-$_SESSION['gift']; 
                            ?>
                          <br>
                          Anda memiliki Wuz's Gift sebesar <b class="text-blue"> Rp <?=number_format($_SESSION['gift'])?></b>
                          <br> Bila digunakan, Anda mendapat potongan sesuai Wuz's Gift milik Anda
                          <br>Sehingga Anda hanya perlu membayar sebesar 
                          <h4 class="text-blue center"><b> Rp <?=number_format($_SESSION['potong'])?></b></h4>
                          <small>Klik Lanjut dengan Gift bila ingin menggunakannya</small>
                            <small> Data akan langsung tersimpan saat Anda menekan Button</small>
                    </blockquote>
                    <br>
                    <br>
                    <a href="booking_process?p=<?=$_SESSION['pembayaran']?>"><button name="lanjut" class="btn btn-warning"> Finish Tanpa Gift</button></a>
                    <a href="booking_process?p=<?=$_SESSION['pembayaran']?>&gift"><button name="lanjut" style="margin-right: 2px" class="btn bg-blue" style="float: right"> Finish Dengan Gift</button></a>
                  </div>
                          <?php
                          } else {
                          ?>
                          <br><small>Wuz's Gift milik Anda = Rp 0, lakukan transaksi untuk mengumpulkan Wuz's Gift</small>
                        </div>
                    </blockquote>
                    <br>
                    <br>
                    <a href="booking_process?p=<?=$_SESSION['pembayaran']?>"><button name="lanjut" class="btn bg-blue" style="bottom: 0"> Finish</button></a>
                    <?php
                     }
                        ?>

            <div class="col-md-4" style="margin-left: 30px; width:315px">
                <h3>Data Perjalanan</h3>
                <br>
                    <blockquote class="bq-blue" style="border-left:1px solid #ddd; background:#ececec">
                        Waktu Perjalanan <br>
                        <small><?=$_SESSION['date']?></small>
                        <br>
                        Waktu Keberangkatan
                        <small>
                            <?php
                            $hm = date_create($data[1]);
                            $hmm = date_format($hm,"H:i")
                            ?>
                            <?=$hmm?></small>
                        <br>
                        <?php
                        $qry = $db->selectID('transportation', $_SESSION['id_transportasi']);
                        $dt_trans = $qry->fetch();
                        echo "<b>$dt_trans[1]</b>";

                        $qry = $db->selectID('place', $data[2]);
                        $dt_asal = $qry->fetch();
                        echo "<br>$dt_asal[1] <span class='glyphicon glyphicon-arrow-right' style='font-size:12px'> </span>";

                        $qry = $db->selectID('place', $data[3]);
                        $dt_tuj = $qry->fetch();
                        echo " $dt_tuj[1]";
                        ?>
                    </blockquote>
            </div>          

        </div> <!-- col md 12 -->

        </div>
        
    </div>
    <!-- /content -->


<?php
  } // if
}

elseif(isset($_GET['form'])){
$total = 0;
if(isset($_SESSION['username'])){
if(isset($_SESSION['items'])){
	foreach($_SESSION['items'] as $key => $val){
		$query = mysql_query("SELECT * FROM item where id_item = '$key'");
		$rs = mysql_fetch_array($query);

		$jml = $val * count($_SESSION['items']);
		$tt =0;
        foreach ($_SESSION['items'] as $key => $value) {
        $tt += $value;
          }
          
	$ongkir = $jml*1000;
	$total += $ongkir;

        foreach ($_SESSION['items'] as $key => $value) {
        $tt += $value;
          }
}
}
	?>
<div class="w3-main w3-card col-md-10 w3-card   w3-padding" style="margin-left:320px; height:93%">
<br>
	<div style='background-color: orange; color: white'>
      <hr style='border-top: 2px dashed #e65100'><center><h4><b>Checkout</h4></center></b><hr style='border-top: 2px dashed #e65100'>
    </div>
<div class="col-md-6">
<form method="POST" action="?fix">
<table class="table" style="font-size: 12px">
  <thead>
    <th colspan="3">FORM CHECKOUT</th>
  </thead>
  <tbody>
    <tr>
      <td>Nama Lengkap</td>
      <td>:</td>
      <td>
      <input type="text" class="form-control" name="nama" required="Harus diisi"> </td>
    </tr> 
    <tr>
      <td>Telepon</td>
      <td>:</td>
      <td><input type="text" class="form-control" name="telp" required="Harus diisi"></td>
    </tr>
    <tr>
      <td>Email</td>
      <td>:</td>
      <td><input type="text" class="form-control" name="email" required="Harus diisi"></td>
    </tr>
    <tr>
      <td>Alamat</td>
      <td>:</td>
      <td><textarea class="form-control" name="alm" required="Harus diisi"></textarea> </td>
    </tr>
  </tbody>
</table>
<input type='hidden' value="<?=$jml?>" name='val'>
<input type='hidden' value="<?=$total?>" name='total'>
<input type='hidden' value="<?=$ongkir?>" name='ongkir'> 
<input type="submit" class="btn btn-success" value="Lanjut" name="fix"> <br><br>
</form>
<hr>

<?php
} 
	else{
		echo "<script type='text/javascript'>
		    alert('Sekali langkah lagi.. Anda harus login dahulu!');
		    window.location.href='login?log.php';
		    </script>";

	}
}

elseif(isset($_GET['fix'])){
	if(isset($_GET['transfer_act'])){
		
	}
	if(isset($_SESSION['customer'])){
		$query = mysql_query("SELECT * FROM customer where username = '$_SESSION[customer]'");
		$data = mysql_fetch_array($query);
			$cari_kd=mysql_query("select max(kd_penjualan) as kode from penjualan"); 
            $tm_cari=mysql_fetch_array($cari_kd);
            $kode=substr($tm_cari['kode'],4,4); 
            $tambah=$kode+1; 
              if($tambah < 10){ 
                $kd_transaksi="KT000".$tambah;
                }else{
                $kd_transaksi="KT00".$tambah;
                }

		$tgl = date('Y-m-d H:i:s');

		$trans = mysql_query("insert into penjualan values ('$kd_transaksi', '$tgl', 'U0001' ,'$data[0]', '$data[1]', '$_SESSION[jml]', '$_SESSION[total]')");
			if($trans){
				foreach($_SESSION['items'] as $key => $val){

					$query = mysql_query("SELECT * FROM buku where kd_buku = '$key'");
					$rs = mysql_fetch_array($query);
					$total = $rs['harga'] * $val;

					$get_trans = mysql_query("SELECT * FROM penjualan where kd_penjualan = '$kd_transaksi'");
					$fetch_trans = mysql_fetch_array($get_trans);
					$kd_transaksi_ = $fetch_trans['kd_penjualan'];

						$trans_det = mysql_query("INSERT INTO penjualan_item VALUES('null','$kd_transaksi', '$rs[0]', '$val', 'null', '$total')");

							if ($trans_det){
								if(isset($_GET['e'])){
									$e = $_GET['e'];
									echo "<script> alert('berhasil'); window.location.href='konfirmasi.php?".$e."';</script>";
								}
							}
							else {
								echo "<script> alert('gagal memasukkan data'); </script>";
								echo mysql_error();
							}

				}

			}
			else {
				echo "<script> alert('Gagal'); </script>";
				echo "<div style='margin-left:690px'><br><br><br><br><br> error".mysql_error();
			}
	}

	else{
		
		echo "<script type='text/javascript'>
	    alert('Oops, Anda harus login dahulu!');
	    window.location.href='sign_in.php';
	    </script>";
	}
}

elseif(isset($_GET['pembayaran'])){
	pembayaran();
}

else{
	pembayaran();
}

}

?>
</div>
<script>
function openCity(evt, cityName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("pay");
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" w3-def", ""); 
  }
  document.getElementById(cityName).style.display = "block";
  document.getElementById("menu").style.display = "none";
  evt.currentTarget.className += " w3-def";
}
</script>