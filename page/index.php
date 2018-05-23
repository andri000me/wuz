<?php
	include 'header.php';
	if(!isset($_SESSION)){
	session_start();}
?>
<!-- menu -->
	<div class="top"></div>

	<!-- navbar -->
	<div class="navbar navbar-def">
		<div class="brand"><a href="index"><img src="../assets/images/logo-white.png"></a></div>
		<div class="navigation" id="navi">
			<ul>
				<li><a href="index">Beranda</a></li>
				<li><a href="#ke">Keunggulan</a></li>
				<li><a href="gift">Wuz's Gift</a></li>
				<?php
				if($db->isLogged()){
				?>
				
				<li><a href="myress">Reservasiku</a></li>
				<li><a href="login?out"><button class="btn btn-sm btn-hov">Logout</button></a></li>
				<?php
				}
				else{
				?>
				<li><a href="login?reg">Register</a></li>
				<li><a href="login?log"><button class="btn btn-sm btn-hov">SIGN IN !</button></a></li>
				<?php } ?>
				<li><a href="javascript:void(0)" class="burger" onclick="burger()">&#9776;</a></li>
			</ul>
		</div>
	</div>
	<!-- /navbar -->
	<!-- banner -->
	<div class="banner">
		<div class="slider">
			<ul>
				<li style="background-image:url(../assets/images/banner2.jpg)"></li>
				<!-- <li style="background-image:url(../assets/img/fitur/avatar.png);"></li> -->
				<li style="background-image:url(../assets/images/banner.jpg)"></li>
			</ul>
<!-- 			<span class="previous"></span>
			<span class="next"></span> -->
		</div>

		<div class="form-cari">
			<div class="form-container">
				<div class="w3-sidebar w3-bar-block w3-light-grey" style="width:150px">
					<button class="w3-bar-item w3-button tablink" onclick="openCity(event, 'Kereta')">Kereta Api <i class="fa fa-train" style="margin-left: 18px"></i></button>
					<button class="w3-bar-item w3-button tablink" onclick="openCity(event, 'Pesawat')">Pesawat  <i class="fa fa-plane" style="margin-left: 25px"></i></button>
				</div>

				<div class="form-cari-body">
					<div id="menu" class="w3-container">
					   <form action="search?t" class="form-group" method="post">
					   		<div class="col-md-3 left">
							   	<h4 class="text-blue">Tiket Kereta Api</h4>
							</div>
							<div class="col-md-11">
							    <br>
								<div class="col-md-5" style="margin-right: 10px">
									<p class="left">Asal</p>
							    	<select name="asal" class="form-control" required="">
							    		<option>Pilih Tempat Keberangkatan</option>
							    		<?php
							    			$data = " jenis ='Stasiun'";
							    			foreach ($db->select('place',$data) as $key) {
							    				echo "<option value=$key[0]>($key[0]) $key[1] - $key[3]</option>";
							    			}
							    		?>
							    	</select> 
							    </div>
							    <div class="col-md-5">
							    	<p class="left">Tujuan</p>
							    	<select name="tujuan" class="form-control" required>
							    		<option>Pilih Tempat Tujuan</option>
							    		<?php
							    			$data = " jenis ='Stasiun'";
							    			foreach ($db->select('place',$data) as $key) {
							    				echo "<option value=$key[0]>($key[0]) $key[1] - $key[3]</option>";
							    			}
							    		?>
							    	</select> 
							    </div>
							    <br><br><br><br><br>
							    <div class="col-md-3" style="margin-right: 40px">
							    	<p class="left">Tanggal Keberangkatan</p>
							    		<input type="date" name="tgl" class="form-control" required>
							    </div>
							    <div class="col-md-1" style="margin-right: 10px">
							    	<p class="left">Penumpang</p>
							    	<select name="jml" class="form-control" required="">
							    		<option value="1">1</option>
							    		<option value="2">2</option>
							    		<option value="3">3</option>
							    	</select>
							    </div>
							     <div class="col-md-5">
							    	<br><p class="left"> </p>
							    		<input type="submit" class="btn btn-block btn-info" name="search" value="Cari">
							    </div>
							 </div>
						</form>
					</div>

				
					<div id="Kereta" class="w3-container city" style="display:none">
					   <form action="search?t" class="form-group" method="post">
					   		<div class="col-md-3 left">
							   	<h4 class="text-blue">Tiket Kereta Api</i></h4>
							</div>
							<div class="col-md-11">
							    <br>
								<div class="col-md-5" style="margin-right: 10px">
									<p class="left">Asal</p>
							    	<select name="asal" class="form-control" required>
							    		<option>Pilih Tempat Keberangkatan</option>
							    		<?php
							    			$data = " jenis ='Stasiun'";
							    			foreach ($db->select('place',$data) as $key) {
							    				echo "<option value=$key[0]>($key[0]) $key[1] - $key[3]</option>";
							    			}
							    		?>
							    	</select> 
							    </div>
							    <div class="col-md-5">
							    	<p class="left">Tujuan</p>
							    	<select name="tujuan" class="form-control" required>
							    		<option>Pilih Tempat Tujuan</option>
							    		<?php
							    			$data = " jenis ='Stasiun'";
							    			foreach ($db->select('place',$data) as $key) {
							    				echo "<option value=$key[0]>($key[0]) $key[1] - $key[3]</option>";
							    			}
							    		?>
							    	</select> 
							    </div>
							    <br><br><br><br><br>
							    <div class="col-md-3" style="margin-right: 40px">
							    	<p class="left">Tanggal Keberangkatan</p>
							    		<input type="date" name="tgl" class="form-control" required>
							    </div>
							    <div class="col-md-1" style="margin-right: 10px">
							    	<p class="left">Penumpang</p>
							    	<select name="jml" class="form-control" required="">
							    		<option value="1">1</option>
							    		<option value="2">2</option>
							    		<option value="3">3</option>
							    	</select>
							    </div>
							     <div class="col-md-5">
							    	<br><p class="left"> </p>
							    		<input type="submit" class="btn btn-block btn-info" name="search" value="Cari">
							    </div>
							 </div>
						</form>
					</div>

					<div id="Pesawat" class="w3-container city" style="display:none">
						 <form action="search?a" class="form-group" method="post">
					   		<div class="col-md-3 left">
							   	<h4 class="text-blue">Tiket Pesawat</h4>
							</div>
							<div class="col-md-11">
							    <br>
								<div class="col-md-5" style="margin-right: 10px">
									<p class="left">Asal</p>
							    	<select name="asal" class="form-control" required>
							    		<option>Pilih Tempat Keberangkatan</option>
							    		<?php
							    			$data = " jenis ='Bandara'";
							    			foreach ($db->select('place',$data) as $key) {
							    				echo "<option value=$key[0]>($key[0]) $key[1] - $key[3]</option>";
							    			}
							    		?>
							    	</select> 
							    </div>
							    <div class="col-md-5">
							    	<p class="left">Tujuan</p>
							    	<select name="tujuan" class="form-control" required>
							    		<option>Pilih Tempat Tujuan</option>
							    		<?php
							    			$data = " jenis ='Bandara'";
							    			foreach ($db->select('place',$data) as $key) {
							    				echo "<option value=$key[0]>($key[0]) $key[1] - $key[3]</option>";
							    			}
							    		?>
							    	</select> 
							    </div>
							    <br><br><br><br><br>
							    <div class="col-md-3" style="margin-right: 40px">
							    	<p class="left">Tanggal Keberangkatan</p>
							    		<input type="date" name="tgl" class="form-control" required="">
							    </div>
							    <div class="col-md-1" style="margin-right: 10px">
							    	<p class="left">Penumpang</p>
							    	<select name="jml" class="form-control" required="">
							    		<option value="1">1</option>
							    		<option value="2">2</option>
							    		<option value="3">3</option>
							    	</select>
							    </div>
							     <div class="col-md-5">
							    	<br><p class="left"> </p>
							    		<input type="submit" class="btn btn-block btn-info" name="search" value="Cari">
							    </div>
							 </div>
						</form>
					</div>
				</div> <!-- form-cari-body -->

			</div> <!-- form-container -->
		</div>
		<!-- <div class="form-cari">
			<div class="form-container">
				<div class="form-cari-head">CARI DAN PESAN TIKET DI SINI</div>
				<div class="form-cari-body">
					<form action="" class="search">
						<div class="form-group">
							<label>KEBERANGKATAN</label>
							<input type="text" name="keberangkatan">
						</div>
						<div class="form-group">
							<label>KEDATANGAN</label>
							<input type="text" name="kedatangan">
						</div>
						<div class="form-group">
							<label>PERGI</label>
							<input type="text" name="pergi">
						</div>
						<div class="form-group">
							<label>PULANG</label>
							<input type="text" name="pulang">
						</div>
						<div class="form-group">
							<label>PENUMPANG</label>
							<input type="text" name="penumpang">
						</div>
						<input type="submit" name="cari" class="btn btn-orange" value="CARI">
					</form>
				</div>
			</div>
		</div> -->
	</div>
	<!-- /banner -->

	<!-- content -->
	<div class="content">

		<!-- promo -->
		<div class="container" style="padding-top: 200px">

		<br><br><br>
		<div style="text-align:center">
		<h3>Jadilah Eksklusif dengan Menjadi Member Wuz</h4>
		<h5><a href="login?log">Sign In</a> atau <a href="login?reg">Register</a> untuk mempermudah proses <i>Booking</i> Anda</h4>
		</div>
		<br>
		<br><br>
<!-- 
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
		<div class="container" id="ke">
		<br><br><br>
		<h1>Mengapa Memilih Pemesanan Tiket Ini?</h1>
			<div id="keunggulan" class="ku">
				<div class="icon-keunggulan">
					<img src="../assets/img/fitur/potongan.png">
				</div>
				Kami memiliki Wuz's Gift yang siap kami berikan kepada Anda yang melakukan Transaksi degan Wuz!. Dapatkan potongan harganya!
			</div>
			<div id="keunggulan" class="ku">
				<div class="icon-keunggulan">
					<img src="../assets/img/fitur/harga_jujur.png">
				</div>
				Mudah dalam proses pencarian rute sesuai dengan keinginan Anda. 
			</div>
			<div id="keunggulan" class="ku">
				<div class="icon-keunggulan">
					<img src="../assets/img/fitur/pilihan_pembayaran.png">
				</div>
				Tersedia banyak pilihan metode pembayaran, mulai dari Transfer dengan beberapa Bank tersedia serta Alfamart dan Indomaret.
			</div>
			<div id="keunggulan" class="ku">
				<div class="icon-keunggulan">
					<img src="../assets/img/fitur/stay_guarantee.png">
				</div>
				Sistem Kami memudahkan dalam pemesanan tiket dengan keamanan yang sangat baik dan terpercaya.
			</div>
		</div>
		<br>
		<br>

		<img src="../assets/images/line.png" style="width:100%">
		<br> <br>
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
					<!-- <a href="#">Lihat Semua</a> -->
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
					<!-- <a href="#">Lihat Semua</a> -->
			</div>

		</div>
	</div>
	<!-- /content -->

<?php
	include 'footer.php';
?>