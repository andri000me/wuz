<?php
	$file=$_GET['nama_file'];	


header("Content-Type:".$file);
  header("Content-Disposition: attachment; filename=\"".$file."\"");
  $fp = fopen("./backup/".$file, 'r');
  $data = fread($fp, filesize("./backup/".$file));
  fclose($fp);
  print $data;

   //    // nama file yang akan didownload
	// header("Content-Disposition: attachment; filename=".$file);
 //    // ukuran file yang akan didownload
	// header("Content-length: ".$file);
 //    // jenis file yang akan didownload
	// header("Content-type: ".$file);
	// // proses membaca isi file yang akan didownload dari folder
	// $fp  = fopen("./backup/".$file, 'r');
	// $content = fread($fp, filesize('./backup/'.$file));
	// fclose($fp);
	// echo $content;
	// exit;
?>