<div class="footer-top">
	<img src="../assets/images/top-footer.png" width="100%" style="margin: 0;">
</div>
<div class="footer">
			<a href="#"><img src="../assets/images/logo-white.png"></a>
		<div class="footer-container">
			<b>Customer Service</b><br>
			080-9009009<br>
			cswuz@gmail.com
			<br>
			<br>
			<br>
			<br>
		</div>
		<div class="footer-container">
			<b>Rute Populer</b><br>
			Jakarta - Bali<br>
			Jakarta - Singapore<br>
			Jakarta - Kuala Lumpur<br>
			Jakarta - Malang<br>
			Jakarta - Yogyakarta
			<br>
			<br>
		</div>
		<div class="footer-container">
			<b>Country</b><br>
			Singapore<br>
			Malaysia<br>
			Filiphina<br>
			Vietnam<br>
			Korea<br>
			Thailand
		</div>
		<div class="footer-container">
			<b>About Wuz</b><br>
			Cara Pesan<br>
			Bantuan<br>
			Kontak Kami
			<br>
			<br>
			<br>
			<br>
		</div>
		<div class="footer-container">
			<a href="https://www.facebook.com" title="Facebook"><img src="../assets/images/facebook.png" class="mini-logo" id="1"></a>
			<a href="https://www.twitter.com" title="Twitter"><img src="../assets/images/twitter.png" class="mini-logo" id="2"></a>
			<a href="https://www.gmail.com" title="Google+"><img src="../assets/images/google.png" class="mini-logo" id="3"></a>
			<a href="https://www.instagram.com" title="Instagram"><img src="../assets/images/instagram.png" class="mini-logo" id="4"></a>
			<br><br><br><br><br><br>
		</div>
	</div>
	<div class="footer-cpy">
			Copyright © 2018 <a href="index" style="font-weight: bold;color:white">Wuz</a>
	</div>

<script>
	function burger(){
		var x = document.getElementById("navi");
		if (x.className == "navigation"){
			x.className += " responsive" ;
		}
		else{
			x.className = "navigation";
		}
	}

function openCity(evt, cityName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("city");
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" w3-def", ""); 
  }
  document.getElementById(cityName).style.display = "block";
  document.getElementById("menu").style.display = "none";
  evt.currentTarget.className += " w3-def";
}
</script>

</body>
</html>