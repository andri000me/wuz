<?php
include 'header.php';
include 'menu.php';
?>

<!-- banner -->
	<div class="head head-blue" style="width:85%">
		<h2 class="w3-text-white"><b>Reservasi Akan Sempurna dengan Pembayaran</b></h2>
		<h4>Semakin cepat menyelesaikan pembayaran, semakin cepat pula E-Ticket mengampiri Anda</h4>
		<!-- <img src="../assets/img/fitur/stay_guarantee.png"> -->
	</div>
<!-- /banner -->

<div class="col-md-6 w3-card" style="left:20%!important;top:35%!important;position:absolute!important;background:white;padding: 30px 40px;">
	<?php 
		if(isset($_GET['det'])){
			$r = $db->selectID('reservation',$_GET['kd']); 
			$s = $r->fetch();
			echo '<a onclick="window.history.go(-1)">
                <div class="l-menu tooltips" data-placement="bottom">
                    <span class="fa fa-arrow-left fa-lg" style="cursor:pointer"> Kembali</span> 
                </div>
                </a>
                <br><h4><b>Reservasiku</h4></b>';
		}
		else{
			$r = $db->selectID('reservation',$_SESSION['kd_res']); 
			$s = $r->fetch();
			echo "<h4><b>Reservasiku</h4></b>";
		}
	?>
	<table class="table" style="width:80%;margin-left: 70px">
		<thead>
            <th colspan="3"></th>
        </thead>
		<tr>
			<td>Kode Reservasi</td>
			<td>:</td>
			<td><?=$s[0]?></td>
		</tr>
		<tr>
			<td>Tanggal Reservasi</td>
			<td>:</td>
			<td><?=$s[1]?></td>
		</tr>
		<tr>
			<td>Tanggal Keberangkatan</td>
			<td>:</td>
			<td><?=$s[2]?></td>
		</tr>
		<tr>
			<td>Rute</td>
			<td>:</td>
			<td><?=$s[4]?></td>
		</tr>
		<tr>
			<td>Jumlah Ticket</td>
			<td>:</td>
			<td><?=$s[5]?></td>
		</tr>
		<tr>
			<td>Total Harga</td>
			<td>:</td>
			<td><?="Rp ".number_format($s[6])?></td>
		</tr>
		<tr>
			<td>Metode Pembayaran</td>
			<td>:</td>
			<td><?=$s[8]?></td>
		</tr>
		<tr>
			<td>Kode Pembayaran</td>
			<td>:</td>
			<td><?=$s[9]?></td>
		</tr>
		<tr>
			<td>Status</td>
			<td>:</td>
			<td>
				<?php
				if($s[10]=='N')
					echo "<span class='badge w3-red' style='padding:3px;border-radius:3px'>Belum Konfirmasi Pembayaran</span>";
				elseif($s[10]=='P')
					echo "<span class='badge w3-orange' style='padding:3px;border-radius:3px'>Proses Konfirmasi oleh Admin</span>";
				else
					echo "<span class='badge w3-green' style='padding:3px;border-radius:3px'>Pembayaran Telah Dikonfirmsi</span>";
				?>
			</td>
		</tr>
		<tr>
			<td colspan="3">
				<?php
					if($s[10]=='N'){
				?>
				<a href="?konf&kd=<?=$_SESSION['kd_res']?>"><button class="btn-block btn-info btn">Konfirmasi Pembayaran</button></a>
				<?php
					}
					elseif($s[10]=='P'){
				?>
				<button class="btn-block btn-orange btn" disabled>Konfirmasi Sedang Diproses</button></a>
				<?php
					} elseif($s[10]=='Y'){
				?>
				<a href="e-ticket?kd=<?=$_SESSION['kd_res']?>" target="_blank"><button class="btn-block btn-success btn">Download E-Ticket</button></a>
				<?php
					}
				?>
		</td>
	</table>
</div>

<!-- <div class="form-cari" style="top:70%">
			<div class="form-container">
				<div class="form-cari-body">
					   		<div class="col-md-3 left">
							   	<h4 class="text-blue">Tiket Kereta Api</h4>
							</div>
							<div class="col-md-11">

							</div>
				</div> <!-- form-cari-body -->

			<!-- </div> form-container -->
<!-- </div> --> 

<!-- content -->
	<div style="height: 500px;background-color: white;color: white">

		<!-- promo -->
		<div class="container" style="padding-top: 200px;">
			b
		</div>
	</div>


<?php
	if(isset($_GET['konf']) && isset($_GET['kd'])){
		$kd = $_GET['kd'];
		$upd = $d->prepare("UPDATE reservation SET status_pembayaran = 'P' where kd_reservation ='$kd'");
		if($upd->execute()){
			echo "<script>alert('Konfirmasi telah dikirim, tunggu konfirmasi dari Admin'); window.location.href='myres';</script>";
		}
		else{
			echo "<script>alert('Konfirmasi Gagal'); window.location.href='myres';</script>";
		}
	}
?>

<?php include 'footer.php';