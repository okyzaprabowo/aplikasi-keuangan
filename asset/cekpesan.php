<?php
$server = "localhost"; //
$username = "root";  //
$password = "root"; //
$database = "smsgateway_cilegon";

$konek = mysql_connect($server, $username, $password) or die ("Gagal konek ke server MySQL" .mysql_error());
$bukadb = mysql_select_db($database) or die ("Gagal membuka database $database" .mysql_error());

$text = "SELECT * FROM inbox WHERE Processed='true' order by ID DESC";		
$tot_hal = mysql_query($text);		
$msg = mysql_num_rows($tot_hal);
if($msg>0){
	echo $msg;
}else{
	echo 0;
}
?>
