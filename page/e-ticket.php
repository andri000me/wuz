<?php 
include "models/db.php";
$db = new database();
session_start();
if(empty($_SESSION['username_cust'])){ 
echo "<script>";
echo "alert('Anda tidak boleh mengakses halaman ini');";
echo "window.location.href='../index.php';";
echo "</script>";}
	$host = "localhost";
	$dbname="db_ticketing";
	$un = "root";
	$pw="";
	$d = new PDO("mysql:host={$host};dbname={$dbname}", $un,$pw);
	mysql_connect('localhost','root','');
	mysql_select_db('db_ticketing');
?>
<html>
<head>
<title> Wuz Ticket </title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../assets/font-awesome/css/font-awesome.css">
<link rel="icon" type="image/png" href="../../img/fav.png">
<body style="font-size: 8pt">
<div class="col-md-5">
<!-- <img src="../assets/images/logo-def.png" style="width:90px; height: 35px;display: inline-block;">
<b><h4>WUZ TICKET</b></h4> -->
			
	<hr style="border-width: 3pt; ">
			<?php 
			$kd = $_GET['kd'];
			foreach($db->selectID('reservation',$kd) as $r){
		?>
	<table class="table" style="font-size: 8pt"><!-- <b>Detail Reservation</b> -->
		<thead>
			<th><img src="../assets/images/logo-def.png" style="width:90px; height: 35px;margin: 1px"></th>
			<th><h4>WUZ TICKET</b></h4></th>
		</thead>
	<tbody style="font-size: 8pt">
				<tr> 
					<td>Kode Reservasi : <?=$r[0]?></td>
					<td>Tanggal Reservasi :<?=$r[1]?></td>
				</tr>
				<tr> 
					<td>Kode Rute : 
						<?php
	                    $qry = $db->selectID('rute',$r[4]);
	                    $rr = $qry->fetch();
	                    $pla = mysql_query("SELECT * FROM place where kd_place='$rr[2]'");
	                    $asal = mysql_fetch_array($pla);
	                    $plaa = mysql_query("SELECT * FROM place where kd_place='$rr[3]'");
	                    $tuj = mysql_fetch_array($plaa);
	                    echo $asal[1]." - ".$tuj[1];
	                    ?></td>
					<td >Tanggal Berangkat : <?=$r[2]?></td>
				</tr>
				
				<tr> 
					<td>Total Harga : Rp. <?=number_format($r[6])?></td>
					<td>Transportasi : 
						<?php
							$rm = $db->selectID('transportation',$rr[5]);
							$tr = $rm->fetch();
							echo $tr[1];
						?></td>
				</tr>
			</tbody>
	</table>
<?php } ?>
<h5><b>Detail Penumpang</h5></b>
		<table class="table" style="font-size: 8pt">
			<thead class="w3-theme-l4">
				<tr>
					<th>No</th>
					<th>Nama Penumpang</th>
					<th>Jenis ID</th>
					<th>Nomor ID</th>
					<th>Kursi</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$no = 0;
				$kd = $_GET['kd'];
                    foreach($db->select('reservation_item',"kd_reservation='$kd'") as $r_){
					$no++;
			?>
				<tr>
					<td><?=$no?></td>
					<td><?=$r_[2]?></td>
					<td><?=$r_[3]?></td>
					<td><?=$r_[4]?></td>
					<td><?php 
						$seat = mysql_query("SELECT * FROM seat where id='$r_[5]'");
	                    $seatt = mysql_fetch_array($seat);
	                    echo $seatt[1];
						?>
					</td>
				</tr>

			<?php } ?>
			</tbody>
		</table>

		<script> 
		window.print();
		</script>