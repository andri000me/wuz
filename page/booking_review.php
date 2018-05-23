<?php
	include 'header.php';
	include 'menu_booking.php';
	include 'book.php';
	if(!isset($_SESSION)){
	session_start();}

	if(isset($_POST['lanjut'])){
		unset($_SESSION['key']);
		$seat = $_POST['check'];
		for ($i=0; $i < $_SESSION['jml_penumpang'] ; $i++) { 
			$a = $i+1;
			$_SESSION['seat'][$a] = $seat[$i]."G1";
			// echo $_SESSION['seat'][$a];
			$a++;
		}

		for ($i=1; $i <= $_SESSION['jml_penumpang'] ; $i++) { 
			$kdd = $_SESSION['seat'][$i];
			$sit = $d->prepare("SELECT * FROM seat  where kd_seat = '$kdd'");
			$sit->execute();
			$r = $sit->fetch();
			$_SESSION['idseat'][$i]= $r[0];
		}
	}
?>

	<!-- content -->
	<div class="content">
		<div class="container" style="width:84%;padding: 50px 0px 50px 150px; color: #434343">

		<div class="col-md-12" style="margin-bottom: 15px">
			<div class="col-md-9" style="margin-left: 30px">
				<blockquote class="bq-blue" style="border-left-color: green">
					<span class="fa fa-check" style="color:green"></span> Periksa pesanan tiket Anda dengan seksama ya! Setelah itu silakan lanjut ke Payment. 
				</blockquote>
				<br>
				<h3>Review</h3>
				<br>
			</div>

			<div class="col-md-5" style="margin-left: 30px">
				<h4>Data Transportasi</h4>
					<blockquote class="bq-blue">
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
					<a href="booking_payment"><button name="lanjut" class="btn bg-blue" style="float: right"> Lanjut ke Payment</button></a>
			</div>

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
	include 'footer.php';
?>