<?php 
mysql_connect('localhost','root','');
include "header.php";
include "sidebar.php";
$crud = new crud();
?>
 <!--main content start-->
      <section id="main-content">
          <section class="wrapper">

              <div class="row">
                  <div class="col-lg-12">
                  
                      <div class="row mt">
                        <div class="col-md-12 col-sm-4 mb" style="z-index:1002">
                          <div class="white-panel pnn">
                            <div class="white-header goleft ml">
                                <h5>DATA RESERVATION</h5>
<textarea id="printing-css" style="display:none;"><?php include "../../assets/css/print.css";?></textarea>
<iframe id="printing-frame" name="print_frame" src="about:blank" style="display:none;"></iframe>
<script type="text/javascript">
//<![CDATA[
function printDiv(elementId) {
    var a = document.getElementById('printing-css').value;
    var b = document.getElementById(elementId).innerHTML;
    window.frames["print_frame"].document.title = document.title;
    window.frames["print_frame"].document.body.innerHTML = '<style>' + a + '</style>' + 'Laporan Penjualan<br><br>' + b;
    window.frames["print_frame"].window.focus();
    window.frames["print_frame"].window.print();
}
//]]>
</script>

 <section class="parallax section right-cont">
<div class="wrapsection">
    <div class="container">
        <div class="row">
        
<div class="col-md-10 w3-body w3-white"><br><br>
<a href="?lap"><button style="margin-bottom:20px" class="btn btn-info col-md-3">Laporan Data reservation</button></a>
<a href="reports/reservation" target="_blank"><button style="margin-bottom:20px" class="btn btn-danger col-md-3"><span class="fa fa-file-pdf-o"></span> PDF Data Reservation</button></a>
<a href="csv/export.php?ex&key=reservation"><button style="margin-bottom:20px" class="btn btn-warning col-md-3"> <span class="fa fa-arrow-down"></span>  CSV</button></a>


<a href="?dist"><button style="margin-bottom:20px" class="btn btn-success col-md-3">Reservation Per Customer</button></a>
<a href="?prd"><button style="margin-bottom:20px" class="btn btn-success col-md-3">Reservation Per Periode</button></a>
<a href="?bln"><button style="margin-bottom:20px" class="btn btn-warning col-md-3"> Reservation Per Bulan</button></a>
<a href="?thn"><button style="margin-bottom:20px" class="btn btn-info col-md-3">Reservation Per Tahun</button></a>

<br><br><br><br><br>

<?php
	if(isset($_GET['lap'])){
?>

<a href="javascript:printDiv('printlap');"><button class="btn btn-default"><i class="fa fa-print"></i> Print</button></a>
<div id="printlap">
<table class="table table-hover" style="font-size: 12px;">
    <thead>
        <th>No</th>
        <th>Kode</th>
        <th>Tanggal Reservasi</th>
        <th>Tanggal Berangkat</th>
        <th>Customer</th>
        <th>Kode Rute</th>
        <th>Jumlah Tiket</th>
        <th>Total Harga</th>
    </thead>
    <tbody>
    <?php

       $no=0;
        foreach($crud->selectAll('reservation') as $r){
        $no++;
    ?>
        <tr> 
            <td><?=$no;?>.</td>
            <td class="w3-text-blue"><a href="reservation_det?kd=<?=$r[0]?>"><?=$r[0]?></a></td>
            <td><?=$r[1]?></td>
            <td><?=$r[2]?></td>
            <?php
                $data = $db->selectID('customer',$r[3]);
                $data_ = $data->fetch();
            ?>
            <td><?=$data_[1]?></td>
            <td><?=$r[4]?></td>
            <td><?=$r[5]?></td>
            <td><?=$r[6]?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<b class="w3-text-theme">Jumlah Data : <?=$db->selectCount('reservation')?></b>
</div>
<?php
	} 

elseif(isset($_GET['dist'])){
	$kd=$_GET['dist']; ?>

<div class="col-md-6">
<div class="col-md-10">
<form action="?dist">
<select name="dist" class="form-control">
    <option>Pilih User</option>
    <?php 
        foreach($crud->selectAll('customer') as $r){
        echo "<option value=$r[0]>$r[1]</option>"; 
            }
    ?>
</select>
</div>
<input type="submit" value="Go" class="w3-button w3-toss">
</form>
</div>

<a href="javascript:printDiv('printdist');"><button class="btn btn-default"><i class="fa fa-print"></i> Print</button></a>
<div id="printdist">
<table class="table table-hover" style="font-size: 12px;">
     <thead>
        <th>No</th>
        <th>Kode</th>
        <th>Tanggal Reservasi</th>
        <th>Tanggal Berangkat</th>
        <th>Customer</th>
        <th>Kode Rute</th>
        <th>Jumlah Tiket</th>
        <th>Total Harga</th>
    </thead>
    <tbody>
    <?php
        $no=0;
        $data = "kd_customer ='$kd'";
        foreach($db->select('reservation',$data) as $r){
        $no++;
    ?>
        <tr> 
            <td><?=$no;?>.</td>
            <td class="w3-text-blue"><a href="reservation_det?kd=<?=$r[0]?>"><?=$r[0]?></a></td>
            <td><?=$r[1]?></td>
            <td><?=$r[2]?></td>
            <?php
                $data = $db->selectID('customer',$r[3]);
                $data_ = $data->fetch();
            ?>
            <td><?=$data_[1]?></td>
            <td><?=$r[4]?></td>
            <td><?=$r[5]?></td>
            <td><?=$r[6]?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
</div>

<?php
} // get jn

elseif(isset($_GET['prd'])){
    error_reporting(0);
    if (isset($_GET['prd_aw'])){
    $aw=$_GET['prd_aw'];
    $ak=$_GET['prd']; } ?>

<div class="col-md-12">
<div class="col-md-5">
<form action="?prd_aw&prd_ak">
<select name="prd_aw" class="form-control">
    <option>Pilih Tanggal Awal</option>
    <?php 
        $qry = $d->prepare("SELECT DISTINCT date_format(tgl_reservasi, '%d %M %Y') as kw, tgl_reservasi as ori FROM reservation");
        $qry->execute();
        $data = $qry->fetchAll();
        foreach($data as $r){
        echo "<option value=$r[1]>$r[1]</option>"; 
            }
    ?>
</select>
</div>

<div class="col-md-5">
<select name="prd" class="form-control">
    <option>Pilih Tanggal Akhir</option>
    <?php 
       $qry = $d->prepare("SELECT DISTINCT date_format(tgl_reservasi, '%d %M %Y') as kw, tgl_reservasi as ori FROM reservation");
        $qry->execute();
        $data = $qry->fetchAll();
        foreach($data as $r){
        echo "<option value=$r[1]>$r[1]</option>"; 
            }
    ?>
</select>
</div>
<input type="submit" value="Go" class="btn btn-success">
</form>
<a href="javascript:printDiv('printprd');"><button class="btn btn-default"><i class="fa fa-print"></i> Print</button></a>
</div>

<div id="printprd">
<p class="w3-text-theme">Reservation Periode <b><?=$aw?></b> sampai <b><?=$ak?></b></p>
<table class="table table-hover" style="font-size: 12px;">
    <thead>
         <th>No</th>
        <th>Kode</th>
        <th>Tanggal Reservasi</th>
        <th>Tanggal Berangkat</th>
        <th>Customer</th>
        <th>Kode Rute</th>
        <th>Jumlah Tiket</th>
        <th>Total Harga</th>
    </thead>
    <tbody>
    <?php
        $query=$d->prepare("SELECT * FROM reservation where tgl_reservasi BETWEEN '$aw' AND '$ak' ");
        $query->execute();
        $data = $query->fetchAll();
        $no=0;
        foreach($data as $r){
        $no++;
    ?>
        <tr> 
            <td><?=$no;?>.</td>
            <td class="w3-text-blue"><a href="reservation_det?kd=<?=$r[0]?>"><?=$r[0]?></a></td>
            <td><?=$r[1]?></td>
            <td><?=$r[2]?></td>
            <?php
                $data = $db->selectID('customer',$r[3]);
                $data_ = $data->fetch();
            ?>
            <td><?=$data_[1]?></td>
            <td><?=$r[4]?></td>
            <td><?=$r[5]?></td>
            <td><?=$r[6]?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
</div>

<?php
} // get prd

elseif(isset($_GET['bln'])){
    $bln=$_GET['bln']; ?>

<div class="col-md-6">
<div class="col-md-10">
<form action="?bln">
<select name="bln" class="form-control">
    <option>Pilih Bulan Tahun</option>
    <?php 
        $qry = $d->prepare("SELECT DISTINCT date_format(tgl_reservasi, '%M%Y') as bln, date_format(tgl_reservasi, '%M %Y') as blnn FROM reservation");
        $qry->execute();
        $data = $qry->fetchAll();
        foreach($data as $r){
        echo "<option value=$r[0]>$r[1]</option>"; 
            }
    ?>
</select>
</div>
<input type="submit" value="Go" class="btn btn-success">
</form>
</div>

<a href="javascript:printDiv('printbln');"><button class="btn btn-default"><i class="fa fa-print"></i> Print</button></a>
<div id="printbln">
<table class="table table-hover" style="font-size: 12px;">
    <thead>
         <th>No</th>
        <th>Kode</th>
        <th>Tanggal Reservasi</th>
        <th>Tanggal Berangkat</th>
        <th>Customer</th>
        <th>Kode Rute</th>
        <th>Jumlah Tiket</th>
        <th>Total Harga</th>
    </thead>
    <tbody>
    <?php
        $query=$d->prepare("SELECT * FROM reservation WHERE date_format(tgl_reservasi, '%M%Y') = '$bln'");
        $query->execute();
        $data = $query->fetchAll();
        $no=0;
        foreach($data as $r){
        $no++;
    ?>
       <tr> 
            <td><?=$no;?>.</td>
            <td class="w3-text-blue"><a href="reservation_det?kd=<?=$r[0]?>"><?=$r[0]?></a></td>
            <td><?=$r[1]?></td>
            <td><?=$r[2]?></td>
            <?php
                $data = $db->selectID('customer',$r[3]);
                $data_ = $data->fetch();
            ?>
            <td><?=$data_[1]?></td>
            <td><?=$r[4]?></td>
            <td><?=$r[5]?></td>
            <td><?=$r[6]?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
</div>

<?php
} // get bln

elseif(isset($_GET['thn'])){
    $thn=$_GET['thn']; ?>

<div class="col-md-6">
<div class="col-md-10">
<form action="?thn">
<select name="thn" class="form-control">
    <option>Pilih Tahun</option>
    <?php 
        $qry = $d->prepare("SELECT DISTINCT date_format(tgl_reservasi,'%Y') as thn FROM reservation");
        $qry->execute();
        $data = $qry->fetchAll();
        foreach($data as $r){
        echo "<option value=$r[0]>$r[0]</option>"; 
            }
    ?>
</select>
</div>
<input type="submit" value="Go" class="btn btn-success">
</form>
</div>
<a href="javascript:printDiv('printthn');"><button class="btn btn-default"><i class="fa fa-print"></i> Print</button></a>
<div id="printthn">
<br><p class="w3-text-theme">Data Transaksi Tahun <?=$thn?><br>
<table class="table table-hover" style="font-size: 12px;">
    <thead>
         <th>No</th>
        <th>Kode</th>
        <th>Tanggal Reservasi</th>
        <th>Tanggal Berangkat</th>
        <th>Customer</th>
        <th>Kode Rute</th>
        <th>Jumlah Tiket</th>
        <th>Total Harga</th>
    </thead>
    <tbody>
    <?php
        $query=$d->prepare("SELECT * FROM reservation WHERE date_format(tgl_reservasi, '%Y') = '$thn'");
        $query->execute();
        $data = $query->fetchAll();
        $no=0;
        foreach($data as $r){
        $no++;
    ?>
        <tr> 
            <td><?=$no;?>.</td>
            <td class="w3-text-blue"><a href="reservation_det?kd=<?=$r[0]?>"><?=$r[0]?></a></td>
            <td><?=$r[1]?></td>
            <td><?=$r[2]?></td>
            <?php
                $data = $db->selectID('customer',$r[3]);
                $data_ = $data->fetch();
            ?>
            <td><?=$data_[1]?></td>
            <td><?=$r[4]?></td>
            <td><?=$r[5]?></td>
            <td><?=$r[6]?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
</div>

<?php
} // get thn

else {
?>

<div class="alert alert-info">
	<ul>
		<li>Laporan Data berisi rekap data yang bisa Anda akses langsung di web ini</li>
		<li>PDF Data berisi rekap data dalam bentuk PDF yang bisa direview dahulu dan bisa didownload setelahnya</li>
		<li>Data CSV adalah rekap data dalam bentuk CSV dan otamatis akan terdownload</li>
	</ul>
</div>

<?php 
} 
?>