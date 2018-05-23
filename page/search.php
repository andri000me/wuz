<?php
	include 'header.php';
	include 'menu.php';
	if(!isset($_SESSION)){
	session_start();}
?>
	<!-- banner -->
	<div class="head head-blue" style="width:85%">
		<h2 class="w3-text-white"><b>Booking tiket cepat dimanapun, kapanpun</b></h2>
		<h4>Tiket kereta, tiket pesawat bisa mudah didapat hanya dengan beberapa sentuhan dengan Wuz</h4>
	</div>
	<!-- /banner -->

	<!-- content -->
	<div class="content">
		<div class="container" style="width:84%;padding: 50px 0px 50px 150px; color: #434343">
	<?php
	if(isset($_POST['search'])){
		if($_POST['asal']=='Pilih Tempat Keberangkatn' OR $_POST['tujuan']=='Pilih Tempat Tujuan'){
			echo "<script> alert('Maaf, Anda belum mengisi Kota Asal maupun Kota Tujuan'); window.location.href='index';</script>";
		}
		else{
		$asal = $_POST['asal'];
		$tujuan = $_POST['tujuan'];
		$tgl =$_POST['tgl'];
		$jml = $_POST['jml'];
		$tgll = date_create($tgl);
		$date = date_format($tgll,"D, d F Y");
		$_SESSION['tgl'] = $tgl;
		$_SESSION['jml_penumpang'] = $jml;
		$_SESSION['date'] = $date;

		$data = $db->selectID('place',$asal);
		$as = $data->fetch();
		$data_ = $db->selectID('place',$tujuan);
		$tu = $data_->fetch();

	?>

	<h3><?=$as[1]." (".$as[3].")"?>  <span class="fa fa-arrow-right" style="font-size: 20px">  </span>  <?=" ".$tu[1]." (".$tu[3].")"?></h3>
	<h4><?=$date?></h4>
	<a href="index"><button style="float:right;margin-right: 210px;margin-bottom: 25px" class="btn bg-def">Cari Rute Lain</button></a>

	<?php
		$conn = $db->connection();
		$query= $conn->prepare("SELECT * FROM rute where rute_from='$asal' AND rute_to='$tujuan'");
		$query->execute();

		if($query->rowCount() == 0){
	?>

	<div class="col-md-10" style="margin-bottom: 45px; text-align: center">
		<img src="../assets/img/fitur/sorry-301.png">
		<h3>Maaf, data rute yang Anda cari tidak ditemukan</h3>
		<a href="index"><button class ="btn bg-blue">Cari Rute Lain</button></a>
	</div>


	<?php
		}
		else{
		foreach ($query->fetchAll() as $r) {

		 $query = $conn->prepare("SELECT SUM(jml_ticket) FROM reservation where kd_rute ='$r[0]'");
		 $query->execute();
		 $jml_ticket_pesan = $query->fetch();

		 $qry = $conn->prepare("SELECT seat_qty FROM transportation where kd_transportation ='$r[5]'");
		 $query->execute();
		 $seat_qty = $query->fetch();

		 if($jml_ticket_pesan[0]<=$seat_qty[0]){
	?>
		<!-- hasil search enable -->
		<div class="col-md-12" style="margin-bottom: 15px">
			<div class="div-round col-md-9" style="margin-left: 30px;"">
	<?php
		} else{
	?>

		<!-- hasil search disable -->
		<div class="col-md-12" style="margin-bottom: 15px">
			<div class="div-round col-md-9" style="margin-left: 30px;background-color: #ddd"">
	<?php
		}
	?>
				<div class="col-md-6">
				<?php
				$dt = $db->selectID('transportation',$r[5]);
				$tr = $dt->fetch();
				?>
				<b><?=$tr[1]?></b>
				<br>
				<i><small><?=(($tr[3]=='BP' OR $tr[3]=='BT')?'Bussiness':'Economy')?></i></small>
				<h4><?=$r[1]?></h4>
				<h6><?=$as[1]." (".$as[3].")"?>  <span class="glyphicon glyphicon-arrow-right" style="font-size: 12px">  </span>  <?=" ".$tu[1]." (".$tu[3].")"?></h6>
				</div>
				<div class="col-md-4 right">
					<strong><h4 class="text-blue">Rp <?=number_format($r[4])?></h4></strong>
	<?php
		if($jml_ticket_pesan[0]<=$seat_qty[0]){
	?>
					<!-- button enable -->
					<a href="booking?act=add&amp;rute_id=<?=$r[0]?>&amp;ref=booking_information"><button class="btn bg-blue" style="padding: 15px 30px!important">PESAN</button></a>
	<?php
		} else{
	?>
					<!-- button disable -->
					<button class="btn" style="padding: 15px 30px!important">PESAN</button>
	<?php
		}
	?>
				</div>
			</div>
		</div>

		<!-- /hasil search -->

	<?php
		}
	}
	}
	}
	?>	 
	</div>
		<div class="container" style="padding: 50px 80px;margin-top:250px">
		<!-- promo -->
		<!-- <br>
		<br>
		<h1>Promo Hari Ini</h1>
			<div id="promo" class="promo">
				<span class="icon"><img src="../assets/images/promo.png"></span><img src="../assets/img/bali.jpeg">
				<div class="text-promo">
				Yogyakarta - Bali<br>
				<h3 class="center">Rp 358.000</h3>
					<a href="" class="btn-promo">Pesan</a>
				</div>
			</div>
			<div id="promo" class="promo">
				<span class="icon"><img src="../assets/images/promo.png"></span><img src="../assets/img/yogya.jpeg">
				<div class="text-promo">
				Surabaya - Yogyakarta<br>
				<h3 class="center">Rp 358.000</h3>
					<a href="" class="btn-promo">Pesan</a>
				</div>
			</div>
			<div id="promo" class="promo">
				<span class="icon"><img src="../assets/images/promo.png"></span><img src="../assets/img/kl.jpeg">
				<div class="text-promo">
				Jakarta - KL<br>
				<h3 class="center">Rp 358.000</h3>
					<a href="" class="btn-promo">Pesan</a>
				</div>
			</div>
		</div> -->

		<!-- keunggulan -->
		<div class="container" id="ke"><br><br><br><br><br>
		<h1 style="margin-top: 150px">Mengapa Memilih Pemesanan Tiket Ini?</h1>
			<div id="keunggulan" class="ku">
				<div class="icon-keunggulan">
					<img src="../assets/img/fitur/best_price_guarantee.png">
				</div>
				Harganya terjangkau, situs kami membandingkan harga-harga dari setiap tiket per maskapai.
			</div>
			<div id="keunggulan" class="ku">
				<div class="icon-keunggulan">
					<img src="../assets/img/fitur/harga_jujur.png">
				</div>
				Harga tiket yang jujur, pada situs kami tidak ada biaya yang tersembunyi.
			</div>
			<div id="keunggulan" class="ku">
				<div class="icon-keunggulan">
					<img src="../assets/img/fitur/harga_jujur.png">
				</div>
				Harganya terjangkau, situs kami membandingkan harga-harga dari setiap tiket per maskapai.
			</div>
			<div id="keunggulan" class="ku">
				<div class="icon-keunggulan">
					<img src="../assets/img/fitur/harga_jujur.png">
				</div>
				Harganya terjangkau, situs kami membandingkan harga-harga dari setiap tiket per maskapai.
			</div>
		</div>

		<img src="../assets/images/line.png" style="width:100%">

		<div class="container">
		<h1>Partner Kami</h1>
			<div id="partner">
				Airline Partner<br><br>
				<div class="partner-image">
					<img src="../assets/img/garuda.png">
					<img src="../assets/img/citylink.png">
					<img src="../assets/img/jetstar.png">
					<img src="../assets/img/lionair.png">
					<img src="../assets/img/namair.png">
					<img src="../assets/img/scoot.png">
					<img src="../assets/img/sriwijaya.png">
					<img src="../assets/img/singapore.png">
					<img src="../assets/img/batikair.png">
					<img src="../assets/img/airasia.png">
					<img src="../assets/img/wingsair.png">
					<img src="../assets/img/thaiairways.png">
				</div>
				<br>
					<a href="#">Lihat Semua</a>
			</div>

			<div id="partner">
				Official Payment Partner<br><br>
				<div class="partner-image">
					<img src="../assets/img/payment/alfa.png">
					<img src="../assets/img/payment/indo.png">
					<img src="../assets/img/payment/bca.png">
					<img src="../assets/img/payment/bri.png">
					<img src="../assets/img/payment/mandiri.png">
				</div>
				<br>
					<a href="#">Lihat Semua</a>
			</div>

		</div>
	</div>
	<!-- /content -->

<?php
	include 'footer.php';
?>