<?php
	include 'header.php';
	include 'menu.php';
?>

<style type="text/css">
	.containerr{
		z-index:3;
		width:25%;
		position:absolute;
		left:55%;
		top:44%;
		transform: translate(50%, -50%);
		background: #ddd;
		border-radius: 2px;
		box-shadow:0 4px 7px 0 rgba(0,0,0,0.16),0 3px 10px 0 rgba(0,0,0,0.12);
	}
	.login{
		margin:50px;
	}
	.login img{
		width:60%;
		height:60%;
	}
	input[type=submit]{
		background:#3295fa;
		border:none;
		color:white;
		padding:8px 0;
		width:100%!important;
		cursor:pointer;
	}
	input[type=text],input[type=password],input[type=email]{
		font-size: 12px;
		padding:8px 12px;
		width:90%;
		border:none;
	} 
</style>

	<!-- banner -->
	<div class="head head-blue" style="width:85%">
		<h2 class="w3-text-white"><b>Menjadi Eksklusif dengan menjadi Member Wuz</b></h2>
		<h4>Dapatkan Wuz's Gift untuk potongan harga, hanya untuk Sahabat Wuz !</h4>
	</div>
	<!-- /banner -->

	<div style="width:66%;left:0;padding:30px;margin-bottom: 70px">		
		<div class="col-md-5" style="background-color:#eee;padding: 20px">
			<div style="display:inline-block;"><img src="../assets/img/fitur/potongan.png" style="width:60px"></div>
			Kami memiliki Wuz's Gift yang siap kami berikan kepada Anda yang melakukan Transaksi degan Wuz!. 
		</div>
		<div class="col-md-5" style="background-color:#eee; padding: 20px">
			<div style="display:inline-block;"><img src="../assets/img/fitur/harga_jujur.png" style="width:60px"></div>
			Mudah dalam proses pencarian rute sesuai dengan keinginan Anda. 
		</div>
		<div class="col-md-5" style="background-color:#eee; padding: 20px">
			<div style="display:inline-block;"><img src="../assets/img/fitur/pilihan_pembayaran.png" style="width:60px"></div> Tersedia banyak pilihan metode pembayaran, mulai dari Transfer serta Alfamart dan Indomaret.
		</div>
		<div class="col-md-5" style="background-color:#eee; padding: 20px">
			<div style="display:inline-block;"><img src="../assets/img/fitur/stay_guarantee.png" style="width:60px">
			</div>Sistem Kami memudahkan dalam pemesanan tiket dengan keamanan yang sangat baik dan terpercaya.
		</div>
	</div>


<?php
function formLogin(){
	$db = new database();

?>

 <div class="containerr" style="">
      <div class="login">
        <center>
            <img src="../assets/images/logo-def.png" style="margin-right:30px!important">
            <hr style="background-color:#0d2135">
            <h4>LOGIN</h4>
        <p>
        <form method="post" action="?in">
        	<?php 
        		if($db->isLogged()){
			?>
				<script>alert('Anda sudah login');window.location.href='index';</script>
			<?php
				} elseif(isset($_SESSION['username_cust'])){
			?>
				<input type="text" value="<?=$_SESSION['username_cust']?>" onBlur="if(this.value == '') this.value = 'Username'" onFocus="if(this.value == 'Username') this.value = ''" name="un" required></p>
			<?php
				}
				else{
			?>
				<input type="text" value="Username" onBlur="if(this.value == '') this.value = 'Username'" onFocus="if(this.value == 'Username') this.value = ''" name="un" required></p>
			<?php
				}
			?>
            <p><input type="password"  value="Password" onBlur="if(this.value == '') this.value = 'Password'" onFocus="if(this.value == 'Password') this.value = ''" name="pw" required></p> 
            <p>
            </p>
            <p><input type='submit' value='Sign In' name='log'></a></p>
        </form>
        Belum bergabung? Ayo <a href="?reg">Register</a>
      </div> <!-- end login -->
    </div>

<?php } ?>


<?php function formRegister(){ 
	$db = new database(); ?>
	
	<div class="containerr" style="top:50%">
      <div class="login">
        <center>
            <img src="../assets/images/logo-def.png" style="margin-right:30px!important">
            <hr style="background-color:#0d2135">
            <h4>REGISTER</h4>
        <p>
        <form method="post" action="?rg">
        	<input type="text" value="Nama Lengkap" onBlur="if(this.value == '') this.value = 'Nama Lengkap'" onFocus="if(this.value == 'Nama Lengkap') this.value = ''" name="nm" required></p>
            <p><input type="text" value="Username" onBlur="if(this.value == '') this.value = 'Username'" onFocus="if(this.value == 'Username') this.value = ''" name="un" required></p> 
            <p><input type="password"  value="Password" onBlur="if(this.value == '') this.value = 'Password'" onFocus="if(this.value == 'Password') this.value = ''" name="pw" required></p>
            <p><input type="email" value="Email" onBlur="if(this.value == '') this.value = 'Email'" onFocus="if(this.value == 'Email') this.value = ''" name="email" required></p> 
            <p>
            </p>
            <p><input type='submit' value='Register' name='log'></a></p>
        </form>
        Sudah bergabung? Ayo <a href="?log">Sign In</a>
      </div> <!-- end login -->
    </div>
	<br>
<?php } ?>

<?php
if(isset($_GET['reg'])){
	formRegister();
}
if(isset($_GET['log'])){
	formLogin();
}
?>

<?php include 'footer.php'; 

if(isset($_GET['rg'])){
	$kd = $db->getKd();
	$nm = htmlentities($_POST['nm']);
	$un = htmlentities($_POST['un']);
	$pw = htmlentities(password_hash($_POST['pw'],PASSWORD_DEFAULT));
	$email = htmlentities($_POST['email']);
	$nul = 'null';
	$nol = 0;
	$data = " '$kd','$nm','$un','$pw','$email', 'null', 'null','null','0'";
	$db->register($kd,$nm,$un,$pw,$email,$nul,$nul,$nul,$nol);
}

if(isset($_GET['in'])){
	$un = htmlentities($_POST['un']);
	$pw = htmlentities($_POST['pw']);
	$db->login($un,$pw);
}

if(isset($_GET['out'])){
	$db->logout();
}

?>