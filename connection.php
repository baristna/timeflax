<?php
$source=1;
if ($source==1) {
$dbhost ="localhost";
$dbuser ="root";
$dbpass ="";
$dbname ="timeflax"; 
} else {
$dbhost ="mysql.hostinger.web.tr";
$dbuser ="u836924720_time";
$dbpass ="8862btbt";
$dbname ="u836924720_flax";
}
#error_reporting(0);

$connection =mysql_connect($dbhost,$dbuser,$dbpass);
if(!$connection){
	echo "Veritabani Baglanti Problemi";
	header ("refresh:30; url=/");
	};
$con =mysql_select_db($dbname,$connection);
if(!$con){
	echo "Veritabani Bulunamiyor.";
	header ("refresh:30; url=/");
	};

@mysql_query ('SET NAMES UTF8');
@mysql_query ('SET COLLATION_CONNECTION=UTF8');

session_start();
$user_id_draft_program;
$readsite=mysql_query("SELECT * FROM site_settings");
while ($getsite=mysql_fetch_assoc($readsite)) {
	// name = id, value=1 // name =name , value=maintenance // name=value , value=0 // name=desc, value=bakım modu
	foreach ($getsite as $name => $value) {
		if ($name=='site_setting_name') {
			$x=$value;
		}
		if ($name=='site_setting_value'){
			$y=$value;	
		}
		if (isset($x) && isset($y)) {
		$sitearray[$x]=$y;
		}
	}
}
if ($sitearray['MAINTENANCE_MODE']==1) {
	header('refresh:0; url=maintenance.php');	
}

$dtstamp=date("Y-m-d").' '.date("H:i:s");
$dtname=date("Y").date("m").date("d").date("H").date("i").date("s");
#date_default_timezone_set('Europe/Istanbul');
$dtstamp="2013-01-01 00:00:02";
$gmth=substr(date('O'),1,2);
$gmti=substr(date('O'),3,2);
$gmtdir=substr(date('O'),0,1);
$errorwait=0;
?>
			
			 