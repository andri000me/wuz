
</head>
<body>
<form>
Option1 <input type="checkbox" id="check1" onclick="setChecks(this)"><br />
Option2 <input type="checkbox" id="check2" onclick="setChecks(this)"><br />
Option3 <input type="checkbox" id="check3" onclick="setChecks(this)"><br />
Option4 <input type="checkbox" id="check4" onclick="setChecks(this)"><br />
Option5 <input type="checkbox" id="check5" onclick="setChecks(this)"><br />
Option6 <input type="checkbox" id="check6" onclick="setChecks(this)"><br />
</form>
<?php
echo "<script>var maxChecks=3 </script>";
?> <script type="text/javascript">
//initial checkCount of zero
var checkCount=0
//maximum number of allowed checked boxes
function setChecks(obj){
//increment/decrement checkCount
if(obj.checked){
checkCount=checkCount+1
}else{
checkCount=checkCount-1
}
//if they checked a 4th box, uncheck the box, then decrement checkcount and pop alert
if (checkCount>maxChecks){
obj.checked=false
checkCount=checkCount-1
alert('you may only choose up to '+maxChecks+' options')
}
}

</script>
</body> -->
<!-- 
<!DOCTYPE html>
<html>
<style>
/* The con-check */
.con-check {
    display: inline-block;
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

/* Hide the browser's default checkbox */
.con-check input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

/* Create a custom checkbox */
.checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #eee;
        border:2px solid black;
}

/* On mouse-over, add a grey background color */
.con-check:hover input ~ .checkmark {
    background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.con-check input:checked ~ .checkmark {
    background-color: #2196F3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

/* Show the checkmark when checked */
.con-check input:checked ~ .checkmark:after {
    display: block;
}

/* Style the checkmark/indicator */
.con-check .checkmark:after {
    left: 9px;
    top: 5px;
    width: 5px;
    height: 10px;
    border: solid white;
    opacity: 0;
    border-width: 0 3px 3px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
}
</style>
<body>

<h1>Custom Checkboxes</h1>
<label class="con-check">One
  <input type="checkbox" checked="checked">
  <span class="checkmark"></span>
</label>
<label class="con-check">Two
  <input type="checkbox">
  <span class="checkmark"></span>
</label>
<label class="con-check">Three
  <input type="checkbox">
  <span class="checkmark"></span>
</label>
<label class="con-check">Four
  <input type="checkbox">
  <span class="checkmark"></span>
</label>

</body>
</html>
 -->