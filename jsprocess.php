<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
</head>
<body>
<script type="text/javascript">
var languages= new Array();
	<?php #LANGUAGE INFO
	$thispage=new page;
	$thispage->pagename="user.php";
	$getlng=mysql_query("SELECT * FROM languages");
	while ($readlng=mysql_fetch_assoc($getlng)) { 
	$lngid=$readlng['language_id']; 
	$lngname=$readlng['language_name']; 
	$lngcode=$readlng['language_code'];
	?>
	languages[<?php echo $lngid; ?>]=new Array();
	languages[<?php echo $lngid; ?>][0]='<?php echo $lngname; ?>';
	languages[<?php echo $lngid; ?>][1]='<?php echo $lngcode; ?>';
	<?php };?>
	
	var info='<?php echo $info;  ?>';
	var lang='<?php echo $lang;  ?>';
	var login='<?php echo $login;  ?>';
	<?php if ($login=='true') { ?>
		var user='<?php echo $currentuser['id'];  ?>';
	<?php }; ?>
</script>