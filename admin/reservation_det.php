<?php
include "header.php";
include "sidebar.php";
if(!isset($_GET['kd'])){
	echo "<script>window.history.go(-1);</script>";
}
$db = new database();
$crud = new crud();
$rr=$db->selectID('reservation',$_GET['kd']);
$r = $rr->fetch();
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
        </div>

            <div class="pnn ml" style="padding:20px">
           <table class="table" style="width:40%">
			<thead>
				<h4 style="text-align:left">Detail Reservation</h4>
			</thead>
			<tbody>
				<tr> 
					<td>Kode Reservation</td>
					<td>:</td>
					<td><?=$r[0]?></td>
				</tr>
				<tr> 
					<td>Tanggal Reservasi</td>
					<td>:</td>
					<td><?=$r[1]?></td>
				</tr>
				<tr> 
					<td>Tanggal Keberangkatan</td>
					<td>:</td>
					<td><?=$r[2]?></td>
				</tr>
				<tr> 
					<td>Kode Customer</td>
					<td>:</td>
					<td><a href="customer?det&kd=<?=$r[3]?>" class="text-blue"><?=$r[3]?></a></td>
				</tr>
				<tr> 
					<td>Kode Rute</td>
					<td>:</td>
					<td><a href="rute?det&kd=<?=$r[4]?>" class="text-blue"><?=$r[4]?></a></td>
				</tr>
				<tr> 
					<td>Jumlah Tiket</td>
					<td>:</td>
					<td><?=$r[5]?></td>
				</tr>
				<tr> 
					<td>Total Price</td>
					<td>:</td>
					<td><?=number_format($r[6])?></td>
				</tr>
				<tr> 
					<td>Metode Pembayaran</td>
					<td>:</td>
					<td><?=$r[8]?></td>
				</tr>
				<tr> 
					<td>Kode Pembayaran</td>
					<td>:</td>
					<td><?=$r[9]?></td>
				</tr>
			</tbody>
	</table>
	<?php
		$var = " kd_reservation = '$r[0]'";
		$r = $db->select('reservation_item',$var); 
	?>

	<br><h5 style="text-align:left">Reservation Item</h5>
    <table class="table" style="width:95%;margin-left: 20px">
		<thead>
			<th>No</th>
            <th>Kode Reservasi</th>
            <th>Nama Penumpang</th>
            <th>Jenis ID</th>
            <th>Nomor ID</th>
            <th>Kode Seat</th>
            <th>Price</th>
        </thead>
        <tbody>
	<?php 
		$no =1;
		foreach ($r->fetchAll() as $s) {
	?>
		<tr>
			<td><?=$no++?></td>
			<td><?=$s[1]?></td>
			<td><?=$s[2]?></td>
			<td><?=$s[3]?></td>
			<td><?=$s[4]?></td>
			<td><?=$s[5]?></td>
			<td><?=number_format($s[7])?></td>
		</tr>
	<?php 
} ?>
	</tbody>
</table>
            </div>

                          </div>
                        </div><!-- /col-md-4 --> 
                    </div><!-- /row -->
                    
                  </div><!-- /col-lg-12 END SECTION MIDDLE -->
                
            
          </section>
      </section>
     <!--main content end-->

<?php
include "footer.php";
?>