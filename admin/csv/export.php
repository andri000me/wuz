<?php
mysql_connect('localhost','root',''); mysql_select_db('db_ticketing');
if(isset($_GET['ex'])){
	$key = $_GET['key'];
	 $results = mysql_query("SHOW COLUMNS FROM $key") or die ("errorn");
	 $num = mysql_num_rows($results);
	 $out = "";
		if ($num > 0){
			while($r = mysql_fetch_assoc($results)){
				$out .= $r['Field'].';';}
		}
			$out .="\n";
			 $results = mysql_query( "SELECT  * FROM $key") or die ("errorm");
			 while ($l = mysql_fetch_array($results)){
			 	for ($i = 0; $i <$num ; $i++){
			 		$out .="".$l["$i"].';';}
			 		$out .="\n";
			 }

		 $file = $key.'-'.date('Y-m-d H-i-s').".csv";
		header("Content-type: text/csv; charset=utf-8");
		header("Content-Disposition: attachment; filename=\"".$file."\"");
		header("Pragma: no-cache");
		header("Expires: 0");
		echo $out;
}
?>