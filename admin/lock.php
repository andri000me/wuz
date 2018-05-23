<?php 
session_start();
include "db.php";
$db = new database();
if($db->logged()){
        unset($_SESSION['nama']);
        unset($_SESSION['level']);
        session_destroy();
}

if(isset($_POST['log'])){
    $un = htmlentities($_POST['un']);
    $pass = htmlentities($_POST['pass']);
    $lv = htmlentities($_POST['level']);

    $query = $d->prepare("SELECT * FROM user where username = '$un' && level = '$lv'");
            $query->bindParam(1,$un);
            $query->bindParam(2,$lv);
            $query->execute();
            $data = $query->fetch();

            if($query->rowCount() > 0){
                if(password_verify($pass, $data['password'])){
                    $_SESSION['kd_user'] = $data[0];
                    $_SESSION['username_user'] = $un;
                    $_SESSION['nama_user'] = $data[1];
                    $_SESSION['level_user'] = $lv;
                    if($lv == 'SA' || $lv == 'AV'){
                        header('location:index');
                    }
                }
                else{
                    echo "<script>alert('Password Salah'); window.location.href=window.history.go(-1); </script>";
                }
            }
            else{
                echo "<script>alert('Username Tidak Terdaftar'); window.location.href=window.history.go(-1); </script>";
            }
}
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Lock Wuz</title>

    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap2.css" rel="stylesheet">
    <!--external css-->
    <link href="../assets/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="../assets/css/style-admin2.css" rel="stylesheet">
    <link href="../assets/css/style-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body style="background: #444C57">
    <div style="background: #444C57; width:100%; height:100%;bottom: 0" >

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

	  	<div class="container">
	  	
	  		<div id="showtime" ></div>
	  			<div class="col-lg-4 col-lg-offset-4">
	  				<div class="lock-screen">
		  				<h2><a data-toggle="modal" href="#myModal"><i class="fa fa-lock"></i></a></h2>
		  				<p style="color:white">UNLOCK</p>
		  				
				          <!-- Modal -->
                        <form action="" method="post" class="form-group">
				          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
				              <div class="modal-dialog">
				                  <div class="modal-content">
				                      <div class="modal-header">
				                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                          <h4 class="modal-title">Selamat Datang Kembali</h4>
				                      </div>
				                      <div class="modal-body">
                                            <input type="text" name="un" value="<?=$_SESSION['username_user']?>"  class="form-control placeholder-no-fix">
				                          <input type="password" name="pass" placeholder="Password" class="form-control placeholder-no-fix">
                                          <select name="level" class="form-control">
                <option value="admin">Super Admin</option>  
                 <option value="teller">Admin Verifikator</option>                   
               </select>
				
				                      </div>
				                      <div class="modal-footer centered">
				                          <button data-dismiss="modal" class="btn btn-theme04" type="button">Cancel</button>
                                          <input type="submit" name="log" class="btn btn-theme03" value="Login">
				                      </div>
				                  </div>
				              </div>
				          </div>
                      </form>
				          <!-- modal -->
		  				
		  				
	  				</div><! --/lock-screen -->
	  			</div><!-- /col-lg-4 -->
	  	
	  	</div><!-- /container -->

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="../assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("../assets/img/", {speed: 500});
    </script>

    <script>
        function getTime()
        {
            var today=new Date();
            var h=today.getHours();
            var m=today.getMinutes();
            var s=today.getSeconds();
            // add a zero in front of numbers<10
            m=checkTime(m);
            s=checkTime(s);
            document.getElementById('showtime').innerHTML=h+":"+m+":"+s;
            t=setTimeout(function(){getTime()},500);
        }

        function checkTime(i)
        {
            if (i<10)
            {
                i="0" + i;
            }
            return i;
        }
    </script>

  </body>
</html>
