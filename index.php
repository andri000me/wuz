<?php
session_start();
include "admin/models/general.php";
$db = new database();

if($db->logged()){
    header("location:admin");
}

if(isset($_POST['log'])){
    $un = htmlentities($_POST['un']);
    $pass = htmlentities($_POST['pass']);
    $lv = htmlentities($_POST['level']);

    $db->login($un,$pass,$lv);
}
?>

<html>
  <head>
    <meta charset="utf-8">
    <title>Login - Wuz Data Manage</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <!-- favicon  -->
    <link rel="icon" type="image/png" href="assets/images/fav.png">
    <!-- site css -->
    <link rel="stylesheet" href="assets/css/login.css">
    <style>
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-image: url('assets/images/how_to.jpg');
        background-size: 180%;
      }
    </style>
  </head>
  <body>
  <div class="div-line">
    <div class="huah">
      <b style="font-size:50px">Welcome!</b>
      <p style="font-size:20px">Silakan Login Untuk Memanage Data Wuz<br>
      Semoga hari Anda menyenangkan !</h3>
    </div>
  </div>
 <div class="container" style="">
      <div class="login">
        <center>
            <img src="assets/images/logo-white.png" style="margin-right:30px!important">
            <hr>
            <h4>LOGIN</h4>
        <p>
        <form method="post" action=""><input type="text" value="Username" onBlur="if(this.value == '') this.value = 'Username'" onFocus="if(this.value == 'Username') this.value = ''" name="un" required></p>
            <p><input type="password"  value="Password" onBlur="if(this.value == '') this.value = 'Password'" onFocus="if(this.value == 'Password') this.value = ''" name="pass" required></p> 
            <p>
               <select name="level">
                <option value="SA">Super Admin</option>  
                 <option value="AV">Admin Verifikator</option>                   
               </select>
            </p>
            <p><input type='submit' value='Sign In' name='log'></a></p>
        </form>
      </div> <!-- end login -->
    </div>
  </body>
</html>