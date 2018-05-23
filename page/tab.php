<!DOCTYPE html>
<html>
<title>W3.CSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../assets/css/w3.css">
<body>
  <?php include "header.php"; ?>

<div class="w3-sidebar w3-bar-block w3-light-grey w3-card" style="width:130px">
  <h5 class="w3-bar-item">Menu</h5>
  <button class="w3-bar-item w3-button tablink" onclick="openCity(event, 'London')">London</button>
  <button class="w3-bar-item w3-button tablink" onclick="openCity(event, 'Paris')">Paris</button>
  <button class="w3-bar-item w3-button tablink" onclick="openCity(event, 'Tokyo')">Tokyo</button>
</div>

<div style="margin-left:130px">
  <div class="w3-padding">Vertical Tab Example (sidebar)</div>

  <div id="London" class="w3-container city" style="display:none">
    <h2>London</h2>
    <p>London is the capital city of England.</p>
    <p>It is the most populous city in the United Kingdom, with a metropolitan area of over 13 million inhabitants.</p>
  </div>

  <div id="Paris" class="w3-container city" style="display:none">
    <h2>Paris</h2>
    <p>Paris is the capital of France.</p> 
    <p>The Paris area is one of the largest population centers in Europe, with more than 12 million inhabitants.</p>
  </div>

  <div id="Tokyo" class="w3-container city" style="display:none">
    <h2>Tokyo</h2>
    <p>Tokyo is the capital of Japan.</p>
    <p>It is the center of the Greater Tokyo Area, and the most populous metropolitan area in the world.</p>
  </div>

</div>

<script>
function openCity(evt, cityName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("city");
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" w3-red", ""); 
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " w3-red";
}
</script>

</body>
</html>

<!DOCTYPE html>
<html>
<title>W3.CSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body>

<div class="w3-sidebar w3-bar-block w3-black w3-card" style="width:130px">
  <h5 class="w3-bar-item">Menu</h5>
  <button class="w3-bar-item w3-button tablink" onclick="openLink(event, 'Fade')">Fade</button>
  <button class="w3-bar-item w3-button tablink" onclick="openLink(event, 'Left')">Left</button>
  <button class="w3-bar-item w3-button tablink" onclick="openLink(event, 'Right')">Right</button>
  <button class="w3-bar-item w3-button tablink" onclick="openLink(event, 'Top')">Top</button>
  <button class="w3-bar-item w3-button tablink" onclick="openLink(event, 'Bottom')">Bottom</button>
  <button class="w3-bar-item w3-button tablink" onclick="openLink(event, 'Zoom')">Zoom</button>
</div>

<div style="margin-left:130px">
  <div class="w3-padding">Use any of the w3-animate-classes to fade, zoom or slide in tab content.</div>

  <div id="Fade" class="w3-container city w3-animate-opacity" style="display:none">
    <h2>Fade in</h2>
    <p>London is the capital city of England.</p>
    <p>It is the most populous city in the United Kingdom, with a metropolitan area of over 13 million inhabitants.</p>
  </div>

  <div id="Left" class="w3-container city w3-animate-left" style="display:none">
    <h2>Slide in from left</h2>
    <p>Paris is the capital of France.</p> 
    <p>The Paris area is one of the largest population centers in Europe, with more than 12 million inhabitants.</p>
  </div>

  <div id="Top" class="w3-container city w3-animate-top" style="display:none">
    <h2>Slide in from top</h2>
    <p>Tokyo is the capital of Japan.</p>
    <p>It is the center of the Greater Tokyo Area, and the most populous metropolitan area in the world.</p>
  </div>

  <div id="Right" class="w3-container city w3-animate-right" style="display:none">
    <h2>Slide in from right</h2>
    <p>London is the capital city of England.</p>
    <p>It is the most populous city in the United Kingdom, with a metropolitan area of over 13 million inhabitants.</p>
  </div>

  <div id="Bottom" class="w3-container city w3-animate-bottom" style="display:none">
    <h2>Slide in from bottom</h2>
    <p>Paris is the capital of France.</p> 
    <p>The Paris area is one of the largest population centers in Europe, with more than 12 million inhabitants.</p>
  </div>

  <div id="Zoom" class="w3-container city w3-animate-zoom" style="display:none">
    <h2>Zoom in</h2>
    <p>Tokyo is the capital of Japan.</p>
    <p>It is the center of the Greater Tokyo Area, and the most populous metropolitan area in the world.</p>
  </div>

</div>

<script>
function openLink(evt, animName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("city");
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
     tablinks[i].className = tablinks[i].className.replace(" w3-red", "");
  }
  document.getElementById(animName).style.display = "block";
  evt.currentTarget.className += " w3-red";
}
</script>

</body>
</html>


<!DOCTYPE html>
<html>
<style>
/* The container */
.container {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 22px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

/* Hide the browser's default radio button */
.container input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

/* Create a custom radio button */
.checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #eee;
    border-radius: 50%;
}

/* On mouse-over, add a grey background color */
.container:hover input ~ .checkmark {
    background-color: #ccc;
}

/* When the radio button is checked, add a blue background */
.container input:checked ~ .checkmark {
    background-color: #2196F3;
}

/* Create the indicator (the dot/circle - hidden when not checked) */
.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

/* Show the indicator (dot/circle) when checked */
.container input:checked ~ .checkmark:after {
    display: block;
}

/* Style the indicator (dot/circle) */
.container .checkmark:after {
  top: 9px;
  left: 9px;
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background: white;
}
</style>
<body>

<h1>Custom Radio Buttons</h1>
<label class="container">One
  <input type="radio" checked="checked" name="radio">
  <span class="checkmark"></span>
</label>
<label class="container">Two
  <input type="radio" name="radio">
  <span class="checkmark"></span>
</label>
<label class="container">Three
  <input type="radio" name="radio">
  <span class="checkmark"></span>
</label>
<label class="container">Four
  <input type="radio" name="radio">
  <span class="checkmark"></span>
</label>

</body>
</html>


<form action="#">
  <p>
    <input type="radio" id="test1" name="radio-group" checked>
    <label for="test1">Apple</label>
  </p>
  <p>
    <input type="radio" id="test2" name="radio-group">
    <label for="test2">Peach</label>
  </p>
  <p>
    <input type="radio" id="test3" name="radio-group">
    <label for="test3">Orange</label>
  </p>
</form>

[type="radio"]:checked,
[type="radio"]:not(:checked) {
    position: absolute;
    left: -9999px;
}
[type="radio"]:checked + label,
[type="radio"]:not(:checked) + label
{
    position: relative;
    padding-left: 28px;
    cursor: pointer;
    line-height: 20px;
    display: inline-block;
    color: #666;
}
[type="radio"]:checked + label:before,
[type="radio"]:not(:checked) + label:before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    width: 18px;
    height: 18px;
    border: 1px solid #ddd;
    border-radius: 100%;
    background: #fff;
}
[type="radio"]:checked + label:after,
[type="radio"]:not(:checked) + label:after {
    content: '';
    width: 12px;
    height: 12px;
    background: #F87DA9;
    position: absolute;
    top: 4px;
    left: 4px;
    border-radius: 100%;
    -webkit-transition: all 0.2s ease;
    transition: all 0.2s ease;
}
[type="radio"]:not(:checked) + label:after {
    opacity: 0;
    -webkit-transform: scale(0);
    transform: scale(0);
}
[type="radio"]:checked + label:after {
    opacity: 1;
    -webkit-transform: scale(1);
    transform: scale(1);
}
