<!-- menu -->
	<div class="top"></div>

	<!-- navbar -->
	<div class="navbar navbar-def">
		<div class="brand"><a href="index"><img src="../assets/images/logo-white.png"></a></div>
		<div class="navigation" id="navi">
			<ul>
				<li><a href="index">Beranda</a></li>
				<li><a href="gift">Wuz's Gift</a></li>
				<?php
				if($db->isLogged()){
				?>
				
				<li><a href="myress">Reservasiku</a></li>
				<li><a href="login?out"><button class="btn btn-sm btn-hov">Logout</button></a></li>
				<?php
				}
				else{
				?>
				<li><a href="login?reg">Register</a></li>
				<li><a href="login?log"><button class="btn btn-sm btn-hov">SIGN IN !</button></a></li>
				<?php } ?>
				<li><a href="javascript:void(0)" class="burger" onclick="burger()">&#9776;</a></li>
			</ul>
		</div>
	</div>
	<!-- /navbar -->
