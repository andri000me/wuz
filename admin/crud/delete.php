<?php
include '../models/general.php';
$crud = new database();
$crud = new crud();

if(isset($_GET['b'])){
    $crud->delete('barang',$_GET['kd']);
}

elseif(isset($_GET['j'])){
    $crud->delete('jenis',$_GET['kd']);
}

elseif(isset($_GET['s'])){
    $qry=$d->prepare("DELETE FROM seat where id='$_GET[kd]'");
    if($qry->execute()){
    	echo "<script>alert('Data berhasil dihapus'); window.history.go(-1);</script>";
	}
	else {
		echo "<script>alert('Aduh Gagal'); window.href.location='../index';</script>";
	}
}

elseif(isset($_GET['c'])){
    $crud->delete('customer',$_GET['kd']);
}

elseif(isset($_GET['u'])){
    $crud->delete('user',$_GET['kd']);
}

elseif(isset($_GET['tt'])){
    $query = $d->prepare("DELETE FROM transportation_type where kd_tt = '$_GET[kd]'");
    if($query->execute())
		echo "<script>alert('Data berhasil dihapus'); window.history.go(-1);</script>";
	else 
		echo "<script>alert('Aduh Gagal'); window.href.location='../index';</script>";
}

elseif(isset($_GET['trans'])){
    $crud->delete('transportation',$_GET['kd']);
}

elseif(isset($_GET['place'])){
    $crud->delete('place',$_GET['kd']);
}

elseif(isset($_GET['rute'])){
    $crud->delete('rute',$_GET['kd']);
}

elseif(isset($_GET['res'])){
	$query = $d->prepare("DELETE FROM reservation_item where kd_reservation='$_GET[kd]'");
	if($query->execute()){
		$qry = $d->prepare("DELETE FROM reservation where kd_reservation ='$_GET[kd]'");
		if($qry->execute())
			echo "<script>alert('Berhasil Dihapus'); window.history.go(-1);</script>";
		else
			echo "<script>alert('Terjadi Kesalahan'); window.history.go(-1);</script>";
	}
	else{
		echo "window.history.go(-1);</script>";
	}
}

elseif(isset($_GET['br'])){
    $query = $d->prepare("DELETE FROM retur_item where kd_retur ='$_GET[kd]'");
	if($query->execute()){
		$qry = $d->prepare("DELETE FROM retur where kd_retur ='$_GET[kd]'");
		if($qry->execute())
			echo "<script>alert('Berhasil Dihapus'); window.href.location='../retur';</script>";
		else
			echo "<script>alert('Aduh Gagal'); window.href.location='../retur';</script>";
	}
	else{
		header ('location:retur');
	}
}

elseif(isset($_GET['pj'])){
    $query = $d->prepare("DELETE FROM penjualan_item where kd_penjualan ='$_GET[kd]'");
	if($query->execute()){
		$qry = $d->prepare("DELETE FROM penjualan where kd_penjualan ='$_GET[kd]'");
		if($qry->execute()){
			echo "<script>alert('Berhasil Dihapus');</script>";
		header('location:../vpenjualan');
		}
		else{
			echo "<script>alert('Aduh Gagal');</script>";
		header('location:../vpenjualan');
		}
	}
	else{
		header ('location:../vpenjualan');
	}
}
?>