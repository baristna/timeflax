<?php ob_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php 
if(isset($_GET['lang'])){
	setcookie('lang',$_GET['lang'],time()+36000);
	$lang=$_GET['lang'];
}
include('connection.php'); include('functions.php'); include('classes.php'); include('jsprocess.php'); 

$_SESSION['prevurl']='index.php';
$thispage->pagename=="index.php";
$reditectto=$sitearray['REDIRECTING_PAGE'];
if ($reditectto!="") {
header("refresh:$errorwait; url=$reditectto");
};
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<link rel="image_src" href="link.gif"/>
	<title>Timeflax</title>
	<meta name="description" content="description">
	<meta name="Keywords" content="keywords">
	<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
	<meta http-equiv="Content-Language" content="tr"/>
	<meta name="cache-control" content="Public"/>
	<meta name="robots" content="ALL"/>
	<meta name="rating" content="SAFE FOR KIDS"/>
	<meta name="distribution" content="GLOBAL"/>
	<meta name="classification" content="timeflax">
	<meta name="copyright" content="2013 timeflax">
    <meta property="og:title" content="content" />
    <meta property="og:image" content="link.gif" />
	<link rel="icon" href="favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon"> 
    <link rel="stylesheet" media="all" type="text/css" href="jqueryui.css" />
	<link id="maincss" rel="stylesheet" href="timeflax.css" type="text/css" />
	<link id="maincss" rel="stylesheet" href="countdownbox.css" type="text/css" />
	<link id="maincss" rel="stylesheet" href="programbox.css" type="text/css" />
	<link id="maincss" rel="stylesheet" href="jsscroolpane.css" type="text/css" />
	<link id="maincss" rel="stylesheet" href="timepicker.css" type="text/css" />
	<script type="text/javascript" src="files/js/jquery-1.9.0.js"></script>
	<script type="text/javascript" src="files/js/jquery-ui-1.10.2.custom.js"></script>
	<script type="text/javascript" src="files/js/plugins.js"></script>
	<script type="text/javascript" src="files/js/tf-functions.js"></script>
	<script type="text/javascript" src="files/js/main.js"></script>
</head>
<body>
<style type="text/css">
body {background:#333;}
.indexmenu { width:400px; margin:0 auto;  margin-top:20px;}
.indexmenu > div { display:inline-block; }
.indexmenu > div > a { border-left:#444 solid 1px; border-right:#222 solid 1px; padding:10px 10px 10px 10px; float:left; width:100px;text-decoration:none; color:#FFFFFF; display:block; }
.indexmenu > div > a:first-child { border-left:none; }
.indexmenu > div > a:last-child { border-right:none; }
.indexmenu > div > a:hover { background:#393939; }

.fixed-endinfo {background:#222; position:fixed; bottom:0; left:0; right:0; color:#FFFFFF; font-size:13px; padding:5px 0px 5px 0px;}
.fixed-endinfo a { color:#FFFFFF; text-decoration:none }
.fixed-endinfo-in {width:1100px;  margin:0 auto;}
.fixed-endinfo-in-left {float:left;}
.fixed-endinfo-in-right { text-align:right; }
</style>

<div id="tf-header" style=""><!-- UST B??L??M -->
    <div id="tf-header-main"> <!-- GR?? KU??AK -->
     	<div id="tf-header-main-in">
               <div id="tf-header-main-in-right"><!-- MENU BAR -->
                        <ul class="menubarright">
                        </ul>
               </div><!--tf-header-main-in-menu-->
		</div><!--tf-header-main-in-->
    </div><!--tf-header-main-->
</div><!--tf-header-->

<div id="tf-container" style="color:#FFFFFF; text-align:center; width:1100px; margin:0 auto;">
	<div style="margin:0 auto; margin-top:150px; width:500px;">
		<div style="margin-bottom:20px;">
		<a href="index.php"><img src="files/images/blogo.png" width="300"  /></a>
		</div>
		<div>
			<h2>??ok Yak??nda Hizmetinizde</h2>
		</div>
		<div class="indexmenu">
		
		</div>
	</div>
	
</div>

<div class="fixed-endinfo">
	<div class="fixed-endinfo-in" >
		<div class="fixed-endinfo-in-left">
			
		
		</div>
		<div class="fixed-endinfo-in-right" >
			
		</div>
	</div>
</div>
</body>
</html>
<?php ob_end_flush(); ?>