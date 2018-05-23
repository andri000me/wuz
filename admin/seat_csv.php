<?php 
include 'header.php';
include 'sidebar.php';
$db = new database();
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
                                <h5>DATA SEAT</h5>
                               

			<a onclick="window.history.go(-1)" class="w3-fdef">
                <div class="l-menu tooltips" data-placement="bottom" data-original-title="Tambah Data">
                    <span class="fa fa-arrow-left semi-circ fa-lg"> Kembali</span> 
                </div>
                </a>

        </div>
            <div class="pnn ml goleft" style="padding:20px; margin-top: 60px; padding-bottom: 100px!important;">
<?php
$error=0;  

if(isset($_POST['enter']))
	{  
	$count=$_POST['count']+1;  
		for($j=1;$j<$count;$j++)  
		{  
			$input_kd = "kd".$j;  
			$kd =$_POST[$input_kd];  
			$input_bc = "bc".$j;  
			$bc =$_POST[$input_bc];  
			// $input_jd = "jd".$j; 
			// $jd =$_POST[$input_jd];  
			// $input_pn = "pn".$j;  
			// $pn =$_POST[$input_pn];  
			// $input_hr = "hr".$j;  
			// $hr =$_POST[$input_hr];  
			// $input_ds = "ds".$j; 
			// $ds =$_POST[$input_ds];  
			// $input_st = "st".$j;  
			// $st =$_POST[$input_st];  
			// $input_rak = "rak".$j;  
			// $rak =$_POST[$input_rak]; 
			$data = "'null','$kd','$bc'";
			$crud->insertt('seat',$data);
		}  
	echo "<script>alert('STATUS : IMPORT DATA BERHASIL'); window.location.href='seat';</script>";  
	}  

elseif(isset($_POST['import']))  
 {  
	 if ($_FILES['csv']['size'] > 0) {   
	   
	   $handle = fopen($_FILES['csv']['tmp_name'],"r"); 
	    while ($dataq = fgetcsv($handle)){
		$cek = strpos($dataq[0],";");
		}
		$step=1;  
		if($cek){ 
			$handle = fopen($_FILES['csv']['tmp_name'],"r"); 
	   		$data = fgetcsv($handle,1000,";"); 

 ?>  
 <form action="?insert" method="post" enctype="multipart/form-data" name="form1" id="form1">   
 <?php  
 echo "  
<div style='overflow-y:hidden; overflow-x:scroll;'>
<table class='table' style='width:50%'>  
 <thead> 
 <th>No</th>  
 <th>Kode </th> 
 <th>Kode Transportasi</th>  
 </thead>";   
   do {   
     if (count($data)==2) {  
         if($data[1])  
         {   
 echo "<tr>";  
 echo "<td align=center>".$step."</td>";  
 echo "<td><input type='text' name='kd".$step."' value='".$data[0]."' class='form-control'/></td>";  
 echo "<td><input type='text' name='bc".$step."' value='".$data[1]."'class='form-control'/></td>"; 
 // echo "<td><input type='text' name='jd".$step."' value='".$data[2]."'/></td>";  
 // echo "<td><input type='text' name='pn".$step."' value='".$data[3]."'/></td>"; 
 // echo "<td><input type='text' name='hr".$step."' value='".$data[4]."'/></td>";  
 // echo "<td><input type='text' name='ds".$step."' value='".$data[5]."'/></td>"; 
 // echo "<td><input type='text' name='st".$step."' value='".$data[6]."'/></td>";  
 // echo "<td><input type='text' name='rak".$step."' value='".$data[7]."'/></td>"; 
 echo "</tr>";  
 $step++;}  
     }  
     else echo "ERROR! jumlah field tidak sesuai<br/>";   
   } while ($data = fgetcsv($handle,1000,";"));   
 }  //cek

 else{ //cek
 		$handle = fopen($_FILES['csv']['tmp_name'],"r"); 
		$data = fgetcsv($handle,1000,","); 

 ?>  
 <form action="?insert" method="post" enctype="multipart/form-data" name="form1" id="form1">   
 <?php  
 echo "  
<div style='overflow-y:hidden; overflow-x:scroll;'>
<table class='table table-responsive'>  
 <thead> 
 <th>No</th>  
 <th>Kode </th> 
 <th>Kode Transportasi</th>  
 </thead>";  
   do {   
     if (count($data)==2) {  
         if($data[1])  
         {   
 echo "<tr>";  
 echo "<td align=center>".$step."</td>";  
 echo "<td><input type='text' name='kd".$step."' value='".$data[0]."' class='form-control'/></td>";  
 echo "<td><input type='text' name='bc".$step."' value='".$data[1]."' class='form-control'/></td>"; 
 // echo "<td><input type='text' name='jd".$step."' value='".$data[2]."'/></td>";  
 // echo "<td><input type='text' name='pn".$step."' value='".$data[3]."'/></td>"; 
 // echo "<td><input type='text' name='hr".$step."' value='".$data[4]."'/></td>";  
 // echo "<td><input type='text' name='ds".$step."' value='".$data[5]."'/></td>"; 
 // echo "<td><input type='text' name='st".$step."' value='".$data[6]."'/></td>";  
 // echo "<td><input type='text' name='rak".$step."' value='".$data[7]."'/></td>"; 
 echo "</tr>";  
 $step++;}  
     }  
     else echo "ERROR! jumlah field tidak sesuai<br/>";   
   } while ($data = fgetcsv($handle,1000,","));   
 }


 ?>    
 </table>  
 </div>
<p class="w3-text-theme"><h5><label class="label label-info">Jumlah Data : <?=($step-1)?><input type='hidden' name='count' value='<?=($step-1)?>'></label></h5><br>
<input type='submit' name='enter' value='Simpan' class="w3-btn w3-blue"/></p><br>
 </form> 
 <?php 
 } }
 else { ?>
  


 <form action="?import" method="post" enctype="multipart/form-data" name="form1" id="form1">   
  Pilih File CSV yang akan diimport: <br />  
  <input name="csv" type="file" id="csv"/>   <br>
  <input type="submit" name="import" value="Import" class="w3-button w3-blue" />   
 </form>   
 <br> 

<?php } ?>

<div class="alert w3-orange w3-text-white"> 
 <h4><label class="label label-danger"><b>Note</b></label></h4>  
  <ul><li>File yang diupload harus berformat <b>CSV</b>
  <li>File boleh berekstensi .txt tapi format penulisan harus seperti CSV
  <li>Pastikan urutan kolom pada file CSV benar 😃
  <li>Pastikan tidak ada nama kolom pada baris pertama 😊
  <li>Pastikan kode transportasi telah terdaftar di data master 😉
  </ul>
</div>
</div>