<html>
<head>
<title> Book </title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="text/javascript" src="../assets/js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" href="../assets/jquery-311.js"></script>
<script type="text/javascript" href="../assets/bootstrap/js/bootstrap.js"></script>
<link rel="stylesheet" type="text/css" href="../assets/bootstrap/css/bootstrapp.css">
<link rel="stylesheet" type="text/css" href="../assets/font-awesome/css/font-awesome.css">
<link rel="stylesheet" type="text/css" href="../assets/css/blue-theme.css">
<link rel="stylesheet" type="text/css" href="../assets/css/w3-4.css">
<link rel="icon" type="image/png" href="../fav.png">

<style>
  html,body,h1,h2,h3,h4,h5 {font-family: "Candara", sans-serif}
  a {text-decoration:none;}
</style>
<body class="w3-theme-l5">

<!-- Navbar -->
<div class="w3-top">
 <div class="w3-bar w3-theme-d2 w3-left-align w3-large">
  <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onClick="openNav()"><i class="fa fa-bars"></i></a>
   <a href="index.php" style="text-decoration: none" class="w3-bar-item w3-hide-small w3-padding-large w3-hover-theme navbar-form navbar-left" title="Koleksi Buku"><i class="fa fa-home w3-margin-right"></i>Book</a>
  <a href="products.php" style="text-decoration: none" class="w3-bar-item w3-hide-small w3-padding-large w3-hover-theme navbar-form navbar-left" title="Koleksi Buku">Produk</a>
  <?php 
            include "../config.php";
            session_start();
            if (empty($_SESSION['items'])){
              echo "<a href='cart_vieww.php' style='text-decoration: none' class='w3-bar-item w3-hide-small w3-padding-large w3-hover-theme navbar-form navbar-left'  title='Ayo belanja! Keranjangmu masih kosong'><span class='fa fa-shopping-cart'></span> <span class='badge w3-red'>0</span></a>";
            }
            else{
              $tt =0;
              foreach ($_SESSION['items'] as $key => $value) {
                  $tt += $value;
                }
              echo "<a href='cart_vieww.php' style='text-decoration:none' class='w3-bar-item w3-hide-small w3-padding-large w3-hover-theme navbar-form navbar-left'><span class='fa fa-shopping-cart'></span> <span class='badge w3-green'>".$tt."</span></a></li>";
          }
          ?>
     <?php 
          if(!empty($_SESSION['customer'])){
            echo "<a href='sign_out.php' class='w3-right w3-bar-item w3-hide-small w3-right w3-padding-large navbar-form w3-hover-theme' style='text-decoration:none'><span class='fa fa-sign-out'></span> Logout</a>";
            echo "<a href=akun.php title='Akun Anda' class='w3-right w3-bar-item w3-hide-small w3-right w3-padding-large navbar-form w3-hover-theme' style='text-decoration:none'><span class='fa fa-user-o'></span> Hello $_SESSION[customer]!</a>";
          }
          else{
            echo "<a href='sign_in.php' class='w3-right w3-bar-item w3-hide-small w3-right w3-padding-large navbar-form w3-hover-theme' style='text-decoration:none'><span class='fa fa-sign-in'></span> Login</a>";
            echo "<a href=# class='w3-right w3-bar-item w3-hide-small w3-right w3-padding-large navbar-form w3-hover-theme' style='text-decoration:none'><span class='fa fa-user-o'></span> Hello, User!</a></li>";
          }
          ?>

  <a href="#" class="w3-bar-item w3-hide-small w3-right w3-padding-large" title="Cari buku">
  <form class="navbar-form navbar-left" action="search.php">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Cari produk..." name="keyword" style="width:550px">
                <div class="input-group-btn">
                  <button class="btn btn-warning" type="submit">Go</button>
                </div>
              </div>
            </form>
  </a>
 
 </div>
</div>

<!-- Navbar on small screens -->
<!-- <div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large">
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 1</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 2</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 3</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">My Profile</a>
</div> -->

      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
    
<br>

<?php 
function login(){
  echo "
  <br> <br> <br> <br>
  <div class='module form-module w3-card'>
    <div class='toggle'>
    </div>
    <div class=form>
      <h2>Login</h2>
      <form method='POST' action='signin_act.php'>
        <input type='text' placeholder='Username' name='username'/>
        <input type='password' placeholder='Password' name='password'/>
        <button name='login'> Login </button></a>
      </form>
    </div>
    <div class='cta'><a href='sign_in.php?create' class='w3-text-white'>Belum punya akun?</a></div>
  </div> ";
  }

if(isset($_GET['create'])){ ?>
<br>
 <div class="module form-module w3-card" style="margin-top: 70px">
  <div class="toggle">
  </div>
  <div class="form">
    <h2>Buat Akun</h2>
    <form method="POST" action="signup_act.php">
      <input type="text" placeholder="Nama" name="nm"/>
      <input type="text" placeholder="Username" name="uname"/>
      <input type="password" placeholder="Password" name="pass"/>
      <input type="text" placeholder="Telepon" name="telp" maxlength="13" />
      <button name="buat"> Buat Akun </button>
    </form>
    </div>
  <div class='cta'><a href='sign_in.php' class="w3-text-white">Sudah punya akun? Login</a></div>
</div> 

<?php 

} 

else{
  login();
}
?>

</body>
</html>