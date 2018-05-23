<?php
	include 'header.php';
	include 'menu_booking.php';
	include 'book.php';
	if(!isset($_SESSION)){
	session_start();}
?>

	<!-- content -->
	<div class="content">
		<div class="container" style="width:84%;padding: 50px 0px 50px 150px; color: #434343">

		<div class="col-md-12" style="margin-bottom: 15px">
			<div class="col-md-9" style="margin-left: 30px">
				<h3>Booking</h3>
				<br>
				<blockquote class="bq-blue">Ayo <a href="register?in" title="Ayo Login!"><u>Sign In</u></a> untuk mendapat akses yang mudah.</blockquote>
			</div>

			<form action="booking_seat" method="POST">

			<div class="col-md-5" style="margin-left: 30px">
				<h4>Informasi Kontak</h4>
					<blockquote class="bq-blue">
						Nama
						<input type="text" name="nama" class="form-control" placeholder ="Nama Lengkap" style="width:90%; margin:4px" required>
						<small>Nama lengkap sesuai kartu identitas</small>
						<br>
						Email
						<input type="email" name="email" class="form-control" placeholder ="your.email@email.com" style="width:90%; margin:4px 0px" required>
					</blockquote>

				<br>
				<h4>Data Penumpang</h4>
					<?php
						for($i=1;$i<=$_SESSION['jml_penumpang'];$i++){
						?>
					<blockquote class="bq-blue" style="height:160px">
						<div class="col-md-10" style="margin-bottom: 15px"><b>Penumpang <?=$i?></b></div>
						<div class="col-md-3">
							Title
							<select name="title<?=$i?>" class="form-control" style="width:80px;">
								<option value="Mas">Mas</option>
								<option value="Mbak">Mbak</option>
							</select>
						</div>
						<div class="col-md-5" style="margin-bottom: 15px">
							Nama
							<input type="text" name="nama<?=$i?>" class="form-control" style="width:200px" required>
						</div>
						<div class="col-md-3">
							Tipe ID
							<select name="tipeid<?=$i?>" class="form-control" style="width:80px;">
								<option value="KTP">KTP</option>
								<option value="Paspor">Paspor</option>
								<option value="Lainnya">Lainnya</option>
							</select>
						</div>
						<div class="col-md-5">
							Nomor ID
							<input type="text" name="nomorid<?=$i?>" class="form-control" style="width:200px" required>
						</div>
					</blockquote>
					<br>

						<?php
						}
						?>

					<h4>Detail Harga</h4>
					<blockquote class="bq-blue" style="padding: 30px 10px 40px">
						<div class="col-md-6">
							Harga <?=number_format($data['price'])?> x <?=$_SESSION['jml_penumpang']?>
						</div>
						<div class="col-md-4 text-blue" style="text-align: right">
							Rp <?=number_format($jumlah_harga)?>
						</div>
					</blockquote>
					<br>
					<input type="submit" name="select_seat" class="btn bg-blue" value="Lanjut Pilih Kursi" style="float: right">
			</div>
			</form>

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