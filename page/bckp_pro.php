<?php
if(!isset($_SESSION)){
	session_start();
}
include "models/db.php";
include "models/mbooking.php";
$db = new database();
$book = new booking();
if(isset($_GET['p'])){
	if(isset($_GET['gift'])){
		$hrg = $_SESSION['potong'];
	} else{
		$hrg = $_SESSION['total_harga'];
	}

	// if(!isset($_SESSION['nama_cust'])){
	// 	echo "<script>alert('Satu langkah lagi, Ayo login dahulu!'); window.location.href='login?log';</script>";
	// } else{
		$kd_res = $book->getKd();
		$_SESSION['kd_res'] = $kd_res;
		$date_now = date('Y-m-d');
		if($_SESSION['pembayaran']=='Mandiri' || $_SESSION['pembayaran']=='BCA' || $_SESSION['pembayaran']=='BRI'){
			$kd_bayar = "";
		} else{
			$kd_bayar = $_SESSION['kd_pembayaran'];
		}

		$qry = $d->prepare("INSERT INTO reservation VALUES ('$kd_res','$date_now','$_SESSION[tgl]','$_SESSION[kd_cust]','$_SESSION[rute_id]','$_SESSION[jml_penumpang]','$hrg','U00001','$_SESSION[pembayaran]','$kd_bayar','N')");

		if($qry->execute()){
			if(isset($_SESSION['potong'])){
				$upd = $d->prepare("UPDATE customer set gift= '0' where kd_customer = '$_SESSION[kd_cust]");
				if($upd->execute()){
					echo "<script>alert('Maaf terjadi kesalahan update'); </script>";
				}
				else{
					echo "<script>alert('Tidak update'); </script>";	
				}
			}
			else{
				echo "<script>alert('Tidak ada gift'); </script>";
			}

			$ambil = $d->prepare("SELECT * FROM reservation where kd_reservation ='$kd_res'");
			$ambil->execute();
			$r = $ambil->fetch();

			if($_SESSION['jml_penumpang']==1){
					$nama_pas = $_SESSION['nama_pas'];
					$tipe_id = $_SESSION['tipe_id'];
					$nomorid = $_SESSION['nomorid'];
					$seat = $_SESSION['idseat'];

				$qry_ = $d->prepare("INSERT INTO reservation_item VALUES ('null','$r[0]','$nama_pas','$tipe_id','$nomorid','$seat','1','$_SESSION[harga]')");
				if($qry_->execute()){
					echo "<script>alert('pen1'); </script>";
				} else{
					echo "<script>alert('Maaf terjadi kesalahan1'); </script>";
				}
            }
            elseif($_SESSION['jml_penumpang']==2 || $_SESSION['jml_penumpang']==3){
			for ($i=1; $i <=$_SESSION['jml_penumpang'] ; $i++) { 
				$ambil = $d->prepare("SELECT * FROM reservation where kd_reservation ='$kd_res'");
				$ambil->execute();
				$r = $ambil->fetch();

                      $t = 'title'.$i;
                      $n = 'nama_pas'.$i;
                      $tid = 'tipe_id'.$i;
                      $nid = 'nomorid'.$i;

				$nama_pas = $_SESSION[$n];
				$tipe_id = $_SESSION[$tid];
				$nomorid = $_SESSION[$nid];
				$seat = $_SESSION['idseat'][$i];

				// mysql_connect('localhost','root','');
				// mysql_select_db('db_ticketing');

				$qry_ = $d->prepare("INSERT INTO reservation_item VALUES ('null','$r[0]','$nama_pas','$tipe_id','$nomorid','$seat','1','$_SESSION[harga]')");
				if($qry_->execute()){
					echo "<script>alert('pen2'); </script>";
				} else{
					echo "<script>alert('Maaf terjadi kesalahan2'); window.location.href='index';</script>";
				}
			}

			}
			unset($_SESSION['idseat']);
			unset($_SESSION['nomorid']);
			unset($_SESSION['jml_penumpang']);
			unset($_SESSION['nama_pas']);
			unset($_SESSION['tipe_id']);
			unset($_SESSION['potong']);

			echo "<script>alert('Pemasanan Tiket Anda telah tersimpan. Segera lakukan pembayaran ya!');
			window.location.href='myres';</script>";
		} else{
			echo "<script>alert('Maaf, Terjadi Kesalahan');
			window.location.href='index';</script>";
		}

	//}

} else{
	echo "<script>alert('Anda tidak boleh mengakses halaman ini'); window.history.go(-1);</script>";
}
?>