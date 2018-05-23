<!-- <!DOCTYPE html>
<html>
<head>
    <title>huhu</title>
    <style type="text/css">
        
[type="radio"]:checked,
[type="radio"]:not(:checked) {
    position: absolute;
    left: -9999px;
}
[type="radio"]:checked + label,
[type="radio"]:not(:checked) + label
{
    position: relative;
    padding-left: 38px;
    padding-top: 4px;
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
    width: 28px;
    height: 37px;
    border: 1px solid #ddd;
    border-radius: 10%;
    background: #fff;
}
[type="radio"]:checked + label:after,
[type="radio"]:not(:checked) + label:after {
    content: '';
    width: 22px;
    height: 31px;
    background: #F87DA9;
    position: absolute;
    top: 4px;
    left: 4px;
    border-radius: 10%;
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
.green{
    background-color: green!important;
}
.blue{
    background-color: blue!important;
}
.red{
    background-color: red!important;
}

    </style>
</head>
<body>

    <?php
   // for ($i=1; $i <15 ; $i++) { 
        ?>
        <p>
    <input type="radio" id="test<?=$i?>" name="radio-group" class="green" style="display:block" checked>
    <label for="test<?=$i?>"></label>
  </p>
        <?php  //  }
    ?>
<form action="#">
  <p>
    <input type="radio" id="test1" name="radio-group" class="green" checked>
    <label for="test1">Apple</label>
  </p>
  <p>
    <input type="radio" id="test2" name="radio-group" class="blue">
    <label for="test2">Peach</label>
  </p>
  <p>
    <input type="radio" id="test3" name="radio-group" class="red">
    <label for="test3">Orange</label>
  </p>
</form>

</body>
</html> -->
<!DOCTYPE html>
<html>
<style>
/* The con-radio */
.con-radio {
    display: inline-block;
    position: relative;
    padding-left: 30px;
    margin: 0 8px 10px 0;
    cursor: pointer;
    font-size: 22px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

/* Hide the browser's default radio button */
.con-radio input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

/* Create a custom radio button */
.checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 35px;
    width: 35px;
    background-color: #eee;
    border-radius: 15%;
}

/* On mouse-over, add a grey background color */
.con-radio:hover input ~ .checkmark {
    background-color: #ccc;
}

/* When the radio button is checked, add a blue background */
.con-radio input:checked ~ .checkmark {
    background-color: blue;
}

/* Create the indicator (the dot/circle - hidden when not checked) */
.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

/* Show the indicator (dot/circle) when checked */
.con-radio input:checked ~ .checkmark:after {
    left:3px;
    top:3px;
    display: block;
    width:28px;
    height:28px;
    border-radius: 15%;
}

/* Style the indicator (dot/circle) */
.con-radio .checkmark:after {
  top: 9px;
  left: 9px;
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background: red;
}

.green{
    background-color: green!important;
}
.blue{
    background-color: blue!important;
}
.red{
    background-color: red!important;
}
</style>
<body>

<h1>Custom Radio Buttons</h1>

<?php
for ($i=0; $i < 15; $i++) { 
    
?>
<label class="con-radio">
  <input type="radio" checked="checked" name="radio">
  <span class="checkmark"></span>
</label>
<?php
} ?>

<label class="con-radio">Two
  <input type="radio" name="radio" disabled="">
  <span class="checkmark green"></span>
</label>
<label class="con-radio">Three
  <input type="radio" name="radio">
  <span class="checkmark"></span>
</label>
<label class="con-radio">Four
  <input type="radio" name="radio">
  <span class="checkmark"></span>
</label>

</body>
</html>