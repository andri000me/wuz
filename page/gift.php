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
<?php
if(isset($_SESSION['username_cust'])){
?>
<div class="col-md-8 w3-card" style="left:13%!important;top:35%!important;position:absolute!important;background:white;padding: 30px 40px;">

		<?php
		$var = $_SESSION['kd_cust'];
		$r = $db->selectID('customer',$var); 
		$d = $r->fetch();
		if($d[8]==0){
		?>
		<div style="margin-bottom: 45px; text-align: center">
		<img src="../assets/img/fitur/sorry-301.png">
		<h3>Anda belum punya <span class='text-blue'>Wuz's Gift</span> Ayo mulai transaksi dan dapatkan potongan harga!</h3>
		<a href="index"><button class ="btn bg-blue">Cari Rute</button></a>
		</div>
		<?php
		} else {
		?>

	<h4><b>My Wuz's Gift</h4></b>
	<div style="margin-bottom: 45px; text-align: center">
		<img src="../assets/img/fitur/potongan.png">
		<h3>Selamat! Anda memiliki <span class='text-blue'>Wuz's Gift</span> sebesar Rp <?=number_format($d[8])?></h3>
		<a href="index"><button class ="btn bg-blue">Mulai Transaksi</button></a>
		<br><br>
		<h5>
			Wuz's Gift adalah sebuah reward yang diberikan oleh Wuz. Dapatkan Wuz's Gift sebesar Rp 5000 setiap satu kali transaksi!<br>
			Gunakan Wuz's Gift saat pembayaran, sehingga Anda bisa  mendapat potongan harga.
			<br>
		Kesenangan Anda kesenangan Kami juga.</h5>
		</div>
<?php
}
}
else{
?>

<div class="col-md-8 w3-card" style="left:13%!important;top:35%!important;position:absolute!important;background:white;padding: 30px 40px;">

	<h4><b>Apa itu Wuz's Gift?</h4></b>
	<div style="margin-bottom: 45px; text-align: center">
		<img src="../assets/img/fitur/potongan.png">
		<h5>
			Wuz's Gift adalah sebuah reward yang diberikan oleh Wuz. Dapatkan Wuz's Gift sebesar Rp 5000 setiap satu kali transaksi!<br>
			Gunakan Wuz's Gift saat pembayaran, sehingga Anda bisa  mendapat potongan harga.
			<br>
		Kesenangan Anda kesenangan Kami juga.</h5>
		<br>
		<a href="index"><button class ="btn bg-blue">Aku mau Wuz's Gift</button></a>
		</div>

<?php
}
?>
