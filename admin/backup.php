<!-- 12- 19 April 2018 -->
<?php
	error_reporting(0);
	$file=date("Ymd").'_backup_wuz_'.time().'.sql';
	backup_tables("localhost","root","","db_ticketing",$file);
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Koperasi Simpan Pinjam untuk UPK Sekolah">
    <meta name="author" content="mahe">

    <title>Wuz - Data Manage</title>

    <!-- Bootstrap  -->
    <link href="../assets/css/bootstrap2.css" rel="stylesheet">
    <!--external css-->
    <link rel="stylesheet" type="text/css" href="../assets/web-font/css/fontawesome-all.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="../assets/css/style-admin.css">    
    <link rel="stylesheet" type="text/css" href="../assets/css/w3.css"> 

    <!-- favicon  -->
    <link rel="icon" type="image/png" href="../assets/images/logo-white.png">
    
    <!-- Custom styles -->
    <link href="../assets/css/style-admin2.css" rel="stylesheet">
    <link href="../assets/css/style-responsive.css" rel="stylesheet">

    <script src="../assets/js/chart-master/Chart.js"></script>
    <script src="../assets/js/common-scripts.js"></script>
  </head>

  <body>

<section id="container" style="margin-left: 0;left:0">
      <!--header start-->
      <header class="header black-bg"  id="navi" style="margin-left: 0;left:0; height: 40px">
            <div class="sidebar-toggle-box">
                <div class="fa fa-bars tooltips" data-placement="bottom" data-original-title="Menu" onclick="burger()"></div>
            </div>
            <!--logo start-->
            <a href="index" class="logo"><b>WUZ DATA MANAGE</b></a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
            </div>
            <div class="top-menu">
              <ul class="nav pull-right top-menu">
                    <li><a class="logout" href="lock#" style="border-radius: 50%; padding: 7px 8px; background:transparent; border: 1px solid #666666;">
                            <i class="fa fa-lock fa-lg"></i>
                        </a>
                    </li>
                    <li><a class="logout" href="?out">Logout</a></li>
              </ul>
            </div>
        </header>
      <!--header end-->

<br><br><br><br>
<h3><p align="center">Backup database telah berhasil !</p></h3><br>
<p align="center">
	<a onclick="window.history.go(-1)"><button class="btn btn-warning"><i class="fa fa-arrow-left"> </i> Kembali</button></a>
	<a style="cursor:pointer" onclick="location.href='download_backup_data?nama_file=<?=$file;?>'" title="Download"><button class="btn btn-info">Download file database</button></a>
</p>;
<?php
	function backup_tables($host,$user,$pass,$name,$nama_file,$tables ='*')	{
	$link = mysql_connect($host,$user,$pass);
	mysql_select_db($name,$link);
	if($tables == '*'){
		$tables = array();
		$result = mysql_query('SHOW TABLES');
		while($row = mysql_fetch_row($result)){
			$tables[] = $row[0];
		}
	}
	else{
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}
	foreach ($tables as $table) {
		$result = mysql_query('SELECT * FROM '.$table);
		$num_fields = mysql_num_fields($result);
		$return.= 'DROP TABLE '.$table.';';
		$return .= "\n";
	}
	foreach($tables as $table){
		$result = mysql_query('SELECT * FROM '.$table);
		$num_fields = mysql_num_fields($result);
		// $return.= 'DROP TABLE '.$table.';';
		$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
		$return.= "\n\n".$row2[1].";\n\n";
			for ($i = 0; $i < $num_fields; $i++) {
				while($row = mysql_fetch_row($result)){
				$return.= 'INSERT INTO '.$table.' VALUES(';
				for($j=0; $j < $num_fields; $j++) {
					$row[$j] = addslashes($row[$j]);
					$row[$j] = ereg_replace("\n","\\n",$row[$j]);
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
					if ($j < ($num_fields-1)) { $return.= ','; }
				}
				$return.= ");\n";
				}
			}
			$return.="\n\n\n";
		}							
		$nama_file;
		$handle = fopen('./backup/'.$nama_file,'w+');
		fwrite($handle,$return);
			fclose($handle);
	}
?>;