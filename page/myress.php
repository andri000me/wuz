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

<div class="col-md-8 w3-card" style="left:13%!important;top:35%!important;position:absolute!important;background:white;padding: 30px 40px;">

		<?php
		$var = " kd_customer = '".$_SESSION['kd_cust']."'";
		$r = $db->select('reservation',$var); 
		if($r->rowCount()==0){
		?>
		<div style="margin-bottom: 45px; text-align: center">
		<img src="../assets/img/fitur/sorry-301.png">
		<h3>Anda belum punya Transasksi Booking di <span class='text-blue'>Wuz!</span> Ayo mulai cari rute</h3>
		<a href="index"><button class ="btn bg-blue">Cari Rute</button></a>
		</div>
		<?php
		} else {
		?>

	<h4><b>Reservasiku</h4></b>
	<hr>
	<table class="table" style="width:95%;margin-left: 20px">
		<thead>
			<th>No</th>
            <th>Kode Reservasi</th>
            <th>Tanggal Reservasi</th>
            <th>Tanggal Keberangkatan</th>
            <th>Rute</th>
            <th>Jumlah Ticket</th>
            <th>Total Harga</th>
            <th>Status</th>
            <th> </th>
        </thead>
        <tbody>
	<?php 
		$no =1;
		foreach ($r->fetchAll() as $s) {
	?>
		<tr>
			<td><?=$no++?></td>
			<td><?=$s[0]?></td>
			<td><?=$s[1]?></td>
			<td><?=$s[2]?></td>
			<td><?=$s[4]?></td>
			<td><?=$s[5]?></td>
			<td><?=number_format($s[6])?></td>
			<td>
				<?php
				if($s[10]=='N')
					echo "<label class='danger' style='margin:1px 2px 6px 3px' title='Ayo lakukan pembayaran dan segera konfirmasi'>Belum Dikonfirmasi</label>";
				elseif($s[10]=='P')
					echo "<label class='warning' style='margin:1px 2px 6px 3px'>Proses Konfirmasi</label>";
				else
					echo "<label class='success' style='margin:1px 2px 6px 3px'>Pembayaran Telah Dikonfirmsi</label>";
				?>
			</td>
			<td><a href="myres?det&kd=<?=$s[0]?>" class="text-blue" title="Lihat Detail">Lihat</a></td>
		</tr>
	<?php 
} ?>
	</tbody>
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
}
?>
