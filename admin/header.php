<?php
//created by mahe
session_start();
include "models/general.php";
$db = new database();

if(!$db->logged()){
    echo "<script>";                                                             
    echo "window.location.href='../mercusuar'; </script>";
}
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
    <link rel="stylesheet" type="text/css" href="../assets/css/font-awesome.css">
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

 <section id="container" >
      <!--header start-->
      <header class="header black-bg"  id="navi">
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
                    <!-- <li><a class="logout" href="lock#" style="border-radius: 50%; padding: 7px 8px; background:transparent; border: 1px solid #666666;">
                            <i class="fa fa-lock fa-lg"></i>
                        </a>
                    </li> -->
                    <li><a class="logout" href="?out">Logout</a></li>
              </ul>
            </div>
        </header>
      <!--header end-->
<?php
if(isset($_GET['out'])){
    $db->logout();
}
?>