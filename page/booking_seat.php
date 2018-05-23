<?php
error_reporting(0);
	include 'header.php';
	include 'menu_booking.php';
	include 'book.php';
	if(!isset($_SESSION)){
	session_start();}

	$_SESSION['key'][0] = "";

	if(!isset($_POST['select_seat'])){
		echo "<script>alert('Anda tidak berhak mengakses halaman ini');window.history.go(-1);</script>";
	}
	elseif(isset($_POST['select_seat']) ){
		$_SESSION['nama'] = $_POST['nama'];
		$_SESSION['email'] = $_POST['email'];
		if($_SESSION['jml_penumpang']==2){
			$_SESSION['title1'] = $_POST['title1'];
			$_SESSION['title2'] = $_POST['title2'];
			
			$_SESSION['nama_pas1'] = $_POST['nama1'];
			$_SESSION['nama_pas2'] = $_POST['nama2'];

			$_SESSION['tipe_id1'] = $_POST['tipeid1'];
			$_SESSION['tipe_id2']= $_POST['tipeid2'];

			$_SESSION['nomorid1'] = $_POST['nomorid1'];
			$_SESSION['nomorid2'] = $_POST['nomorid2'];
		} elseif($_SESSION['jml_penumpang']==3){
			$_SESSION['title1'] = $_POST['title1'];
			$_SESSION['title2'] = $_POST['title2'];
			$_SESSION['title3'] = $_POST['title3'];
			
			$_SESSION['nama_pas1']= $_POST['nama1'];
			$_SESSION['nama_pas2']= $_POST['nama2'];
			$_SESSION['nama_pas3']= $_POST['nama3'];

			$_SESSION['tipe_id1'] = $_POST['tipeid1'];
			$_SESSION['tipe_id2']= $_POST['tipeid2'];
			$_SESSION['tipe_id3'] = $_POST['tipeid3'];

			$_SESSION['nomorid1']= $_POST['nomorid1'];
			$_SESSION['nomorid2'] = $_POST['nomorid2'];
			$_SESSION['nomorid3'] = $_POST['nomorid3'];
		} else{
			$_SESSION['title'] = $_POST['title1'];
			$_SESSION['nama_pas']= $_POST['nama1'];
			$_SESSION['tipe_id']= $_POST['tipeid1'];
			$_SESSION['nomorid'] = $_POST['nomorid1'];
		}
?>

	<!-- content -->
	<div class="content">
		<div class="col-md-12" style="margin-bottom: 15px">
			<div class="col-md-9" style="margin-left: 150px">
				<h3>Booking Seat</h3>
			</div>
		</div>
		<div class="container" style="width:84%;padding: 50px 0px 50px 150px; color: #434343">

		<div class="col-md-12" style="margin-bottom: 15px">
			<div class="col-md-9 div-round" style="margin-left: 30px; height:350px;padding-left: 70px">

			<form action="booking_review" method="POST">
				<?php
					$qry = $d->prepare("SELECT * FROM seat where kd_transportation='$_SESSION[id_transportasi]' AND kd_seat LIKE 'A%'");
					$qry->execute();
					$a = $qry->rowCount();

					$qry = $d->prepare("SELECT * FROM seat where kd_transportation='$_SESSION[id_transportasi]' AND kd_seat LIKE 'B%'");
					$qry->execute();
					$b = $qry->rowCount();

					$qry = $d->prepare("SELECT * FROM seat where kd_transportation='$_SESSION[id_transportasi]' AND kd_seat LIKE 'C%'");
					$qry->execute();
					$c = $qry->rowCount();

					$qry = $d->prepare("SELECT * FROM seat where kd_transportation='$_SESSION[id_transportasi]' AND kd_seat LIKE 'D%'");
					$qry->execute();
					$dd = $qry->rowCount();

					// $kk = array();
					// 		$kk = ['jk' => "kl"];
					// 		print_r($kk);

					$kl = 0;
					$mut = 0;
					$qry_ = $d->prepare("SELECT * from reservation where tgl_berangkat='$_SESSION[tgl]'");
					$qry_->execute();
					foreach ($qry_->fetchAll() as $hu) {

						$qryy = $d->prepare("SELECT * from reservation_item where kd_reservation='$hu[0]'");
						$qryy->execute();
						$jmmm = $qryy->rowCount();
						// echo "k".$jmmm;
						foreach($qryy->fetchAll() as $ha){
							// echo "l".$jmmm;

						$qryyy = $d->prepare("SELECT * from seat where id='$ha[5]'");
						$qryyy->execute();
						$haa = $qryyy->fetch();

						
						$has = substr($haa[1], 0,3);
						$hh = array($kl=>$has);
						$kl++;
						// print_r($hh);
						foreach ($hh as $key => $value) {
							 // echo "mut".$value;
							 $_SESSION['key'][$mut] = $value;
							 $mut++;
							 // if($value=='A05')
							 // 	echo "dum";
							 // else
							 // 	echo "kk";
						

						// for ($i=0; $i < $jm ; $i++) { 
						// 	echo "m<br>";
						// }
						 
							// for ($i=0; $i < $jmmm ; $i++) { 
							// 	$hh .= ""
							// }
						// $has[0] ="";
						// for ($i=0; $i < $jmmm ; $i++) { 
						// 	for ($i=0; $i < $jmmm ; $i++) { 
						// 		$has[$i] .= substr($haa[1], 0,3);
						// 		$i++;
						// 	//$haas = array($i => $hss );
						// 	} 
						// } //for

						
						} //$qryy
					} //$qry_
				}					

					echo "<br>A";
					$km = 0;
					$kmm=0;
					for ($i=01; $i <= $a ; $i++) { 

					    
					if($i<10){
						$roar ="A0".$i;
					}
					else{
						$roar ="A".$i;
					}					

					//echo $roar.$_SESSION['key'][$km];
							 
					if($roar == $_SESSION['key'][$km]){
						$km++;
					?>
					<label class="con-check">
					  <input type="checkbox" name="check[]" disabled="">
					  <span class="checkmark" style="background-color: #ddd"></span>
					</label>
					<?php
					} 
					else{ 
						echo " <label class=con-check>
					  <input type=checkbox name=check[] value=".$roar." id=check".$i." onclick=setChecks(this)>
					  <span class=checkmark style=background-color: #0f1c2f></span>
					</label>";
					} 
					} 

					echo "<br>B";
					$kn = 0;
					for ($i=01; $i <= $b ; $i++) { 
										    
					if($i<10)
						$roar ="B0".$i;
					else
						$roar ="B".$i;		
						$ff = count($_SESSION['key']);

					if($roar == $_SESSION['key'][$kn]){
						// echo $_SESSION['key'][$kn];
						$kn++;
					?>
					<label class="con-check">
					  <input type="checkbox"  name="check[]" disabled="">
					  <span class="checkmark" style="background-color: #ddd"></span>
					</label>
					<?php
					} else{
						$ii = $i+15;
						echo " <label class=con-check>
					  <input type=checkbox name=check[] value=".$roar." id=check".$ii." onclick=setChecks(this)>
					  <span class=checkmark style=background-color: #0f1c2f></span>
					</label>";
					}
					} // for

					 echo "<br>";
					 for($i=1;$i<=15;$i++){
					 	echo "<div style='width:40px;text-align:center;display:inline-block;margin:20px 5px 20px'>$i</div>";
					 }

					echo "<br>C";
					$jb=0;
					for ($i=1; $i <= $c ; $i++) { 
					    			    
					if($i<10)
						$roar ="C0".$i;
					else
						$roar ="C".$i;					
							 
					if($roar == $_SESSION['key'][$jb]){
						$jb++;
					?>
					<label class="con-check">
					  <input type="checkbox" name="check[]" disabled="">
					  <span class="checkmark" style="background-color: #ddd"></span>
					</label>
					<?php
					} else{
						$iii = $i+25;
						echo " <label class=con-check>
					  <input type=checkbox name=check[] value=".$roar." id=check".$iii." onclick=setChecks(this)>
					  <span class=checkmark style=background-color: #0f1c2f></span>
					</label>";
					}
					} 

					echo "<br>D";
					$jj = 0;
					for ($i=1; $i <= $dd ; $i++) { 
										    
					if($i<10)
						$roar ="D0".$i;
					else
						$roar ="D".$i;					
							 
					if($roar == $_SESSION['key'][$jj]){
						$jj++;
					?>
					<label class="con-check">
					  <input type="checkbox" name="check[]" disabled="">
					  <span class="checkmark" style="background-color: #ddd"></span>
					</label>
					<?php
					} else{
						$iiii = $i+35;
						echo " <label class=con-check>
					  <input type=checkbox name=check[] value=".$roar." id=check".$iiii." onclick=setChecks(this)>
					  <span class='checkmark' style=background-color: white></span>
					</label>";
					}
					}
					?>
					<!-- <br><br>
					<label class="con-check" style="font-size: 14px"> Available
					  <input type="checkbox" name="check[]" disabled>
					  <span class="checkmark" style="background-color: white;margin-left:30px"></span>
					</label> -->
					<input type="submit" name="lanjut" value="Lanjut" class="btn bg-blue" style="margin-top: 40px;margin-left:500px">
				</form>
			</div>


		</div> <!-- col md 12 -->

		</div>
		
	</div>
	<!-- /content -->
<?php
echo "<script>var maxChecks=".$_SESSION['jml_penumpang']."</script>";
?>

<script type="text/javascript">
//initial checkCount of zero
var checkCount=0
function setChecks(obj){
//increment/decrement checkCount
if(obj.checked){
checkCount=checkCount+1
}else{
checkCount=checkCount-1
}
//if they checked a 4th box, uncheck the box, then decrement checkcount and pop alert
if (checkCount>maxChecks){
obj.checked=false
checkCount=checkCount-1
alert('Maaf, Anda hanya dapat memilih '+maxChecks+' kursi')
}
}

</script>

<?php
}

else{
	echo "<script>alert('Anda tidak berhak mengakses halaman ini');window.history.go(-1);</script>";
}
?>