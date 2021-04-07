<?php include('connection.php');include('functions.php');include('classes.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
</head>
<body>
<?php 
#LOGIN LOGOUT PROCESS
if (isset($_GET['logout'])){
	unset($_SESSION['timeflaxuser']);
	$login="false";	
	header ("refresh:$errorwait; url=index.php");
} else if (isset($_POST['s_username']) && isset($_POST['s_password'])) {
	$tfuser=new userlogin;
	$tfuser->user_name=$_POST['s_username'];
	$tfuser->user_password=md5($_POST['s_password']);
	$isitdone=$tfuser->login();
	if($isitdone=='true'){
		if ($tfuser->user_notifications!=""){
			header ("refresh:$errorwait; url=my.php");
		} else {
			header ("refresh:$errorwait; url=my.php?stage=notifications");
		}
	} else if ($isitdone=='wpass') {
		header ("refresh:$errorwait; url=login.php?info=mte401");	
	} else if ($isitdone=='wuser') {
		header ("refresh:$errorwait; url=login.php?info=mte402");	
	} else if ($isitdone=='error') {
		header ("refresh:$errorwait; url=login.php?info=mte901");	
	}
}

# NEW USER
if(isset($_POST['new_username']) && 
			isset($_POST['new_mail']) && 
			isset($_POST['new_password']) && 
			isset($_POST['new_passwordre']) && 
			isset($_POST['countrytd']) && 
			isset($_POST['new_secretquestion']) && 
			isset($_POST['new_secretanswer']) && 
			isset($_POST['new_secretanswerre']) && 
			isset($_POST['new_language'])){                  
	$newuserdraft=new edituser;
	$newuserdraft->user_name=$_POST['new_username'];
	$newuserdraft->user_mail=trim($_POST['new_mail']);
	$newuserdraft->user_password=$_POST['new_password'];
	$newuserdraft->user_passwordre=$_POST['new_passwordre'];
	$newuserdraft->user_countrytd=$_POST['countrytd'];
	$newuserdraft->user_question=$_POST['new_secretquestion'];
	$newuserdraft->user_answer=$_POST['new_secretanswer'];
	$newuserdraft->user_answerre=$_POST['new_secretanswerre'];
	$newuserdraft->user_language=$_POST['new_language'];
	$result=$newuserdraft->newuser();
	if ($result=='true'){
		$loginuser=new userlogin;
		$loginuser->user_name=$_POST['new_username'];
		$loginuser->user_password=md5($_POST['new_password']);
		$loginuser->login();
		
		mysql_query("INSERT INTO programs (program_userid,program_state) VALUES ('$currentuser[0]','0')");
		unset($_SESSION["lang"]);
		$_SESSION["lang"]=$_POST['new_language'];
		header ("refresh:$errorwait; url=my.php?info=mts301");
	} else {
		header ("refresh:$errorwait; url=login.php?info=mte403");
	}
}

#HESAP BİLGİLERİNİ GÜNCELLE
if (isset($_POST['account_update']) && isset($_POST['change_mail']) && isset($_POST['change_user_name']) && isset($_POST['change_user_aname']) && isset($_POST['change_country']) && isset($_POST['change_language'])){              
	$userdraft=new edituser;
	$userdraft->user_name=$_POST['change_user_name'];
	$userdraft->user_aname=$_POST['change_user_aname'];
	$userdraft->user_mail=$_POST['change_mail'];
	$userdraft->user_country=$_POST['change_country'];
	$userdraft->user_language=$_POST['change_language'];
	
	if ($userdraft->change_aname($currentuser[0]) &&
	$userdraft->change_name($currentuser[0]) &&
	$userdraft->change_mail($currentuser[0]) &&
	$userdraft->change_country($currentuser[0]) &&
	$userdraft->change_language($currentuser[0])) 
	{
		unset($_SESSION['timeflaxuser']);
		$userlogin=new userlogin;
		$userlogin->user_name=$_POST['change_user_name'];
		$userlogin->user_password=$currentuser['password'];
		if ($userlogin->login()=='true'){
			header ("refresh:$errorwait; url=my.php?stage=st_settings&info=mts302");
		} else {
			header ("refresh:$errorwait; url=my.php?stage=st_settings&info=mti101");
		}
	} else {
		header ("refresh:$errorwait; url=my.php?stage=st_settings&info=mte404");
	}
}

#Şifre değiştirme kontrolü
if(isset($_POST['changepassword']) && isset($_POST['changepasswordre']) && isset($_POST['oldpassword'])){
	$userdraft=new edituser;
	$userdraft->user_passwordold=$_POST['oldpassword'];
	$userdraft->user_password=$_POST['changepassword'];
	$userdraft->user_passwordre=$_POST['changepasswordre'];
	if ($userdraft->change_password($currentuser[0])=='true') { 
		unset($_SESSION['timeflaxuser']);
		$userlogin=new userlogin;
		$userlogin->user_name=$currentuser['name'];
		$userlogin->user_password=md5($_POST['changepassword']);
		$isitdone=$userlogin->login();
		if ($isitdone=='true'){
			header ("refresh:$errorwait; url=my.php?stage=st_settings&info=mts303");
		} else {
			header ("refresh:$errorwait; url=my.php?stage=st_settings&info=mti102");
		}
	} else {
		header ("refresh:$errorwait; url=my.php?stage=st_settings&info=mte405");
	}
}

#GUVENLİK BİLGİLERİ DEĞİŞTİRME
if(isset($_POST['changeanswer']) && isset($_POST['changequestion']) && isset($_POST['changeanswerre']) && isset($_POST['password'])){
	$userdraft=new edituser;
	$userdraft->user_password=$_POST['password'];
	$userdraft->user_answer=$_POST['changeanswer'];
	$userdraft->user_answerre=$_POST['changeanswerre'];
	$userdraft->user_question=$_POST['changequestion'];
	if ($userdraft->change_control_answer($currentuser[0]) && $userdraft->change_control_question($currentuser[0]) && $userdraft->verify_password($currentuser[0])) {
		
		
		$userdraft->change_answer($currentuser[0]);
		$userdraft->change_question($currentuser[0]);
		unset($_SESSION['timeflaxuser']);
		$userlogin=new userlogin;
		$userlogin->user_name=$currentuser['name'];
		$userlogin->user_password=md5($_POST['password']);
		$isitdone=$userlogin->login();
		if ($isitdone=='true'){
			header ("refresh:$errorwait; url=my.php?stage=st_settings&info=mts304");
		} else {
			header ("refresh:$errorwait; url=my.php?stage=st_settings&info=mti103");
		}		
	} else {
		header ("refresh:$errorwait; url=my.php?stage=st_settings&info=mte406");	
	}
};

#RESIM GUNCELLE
if (isset($_FILES['tmpavatar'])){
	$newavatar=new image;
	$newavatar->image=$_FILES['tmpavatar'];
	$newavatar->margintop=$_POST['imagetop'];
	$newavatar->marginleft=$_POST['imageleft'];
	$result=$newavatar->newavatar($currentuser[0]);
	switch ($result) {
		case "success": $m="" ; break;
		case "wfile": $m="info=mte407" ; break;
		case "wsize":  $m="info=mte408" ; break;
		case "non":  $m="info=mte409" ; break;
		default:  ; break;	
	}
	header ("refresh:$errorwait; url=my.php?stage=st_settings&$m");
}

#RESIM SILME
if (isset($_GET['delete'])){
	if ($_GET['delete']=='avatar') {
		$pic="files/avatars/$currentuser[0].jpg";
		unlink($pic);
		$done=mysql_query("UPDATE users SET user_avatar = 'default' WHERE user_id ='$currentuser[0]'");
		header ("refresh:$errorwait; url=my.php?stage=st_settings&info=mts306");
		$_SESSION['timeflaxuser']['avatar']='default';
	}
}

#WAIT WATCH OLAYLARI
if ($login=='true' && isset($_POST['action'])) {
	$action=$_POST['action'];
	
	if($action=='wait'){
		$fcdid=$_POST['fcdid'];
		mysql_query("INSERT INTO waitings (waiting_user,waiting_cd) VALUES ('$currentuser[0]','$fcdid')");
	} else if ($action=='cancelwait') {
		$fcdid=$_POST['fcdid'];
		mysql_query("DELETE FROM waitings where waiting_user='$currentuser[0]' and waiting_cd='$fcdid'");
	}
	if($action=='waitprg'){
		$fprgid=$_POST['fprgid'];
		mysql_query("INSERT INTO waitingsp (waitingp_user,waitingp_prg) VALUES ('$currentuser[0]','$fprgid')");
	} else if ($action=='cancelwaitprg') {
		$fprgid=$_POST['fprgid'];
		mysql_query("DELETE FROM waitingsp where waitingp_user='$currentuser[0]' and waitingp_prg='$fprgid'");
	}
	
	if($action=='followuser'){
		$watchedid=$_POST['fuserid'];
		mysql_query("INSERT INTO watches (watch_er,watch_ed) VALUES ('$currentuser[0]','$watchedid')");
	} else if ($action=='unfollowuser') {
		$watchedid=$_POST['fuserid'];
		mysql_query("DELETE FROM watches WHERE watch_er='$currentuser[0]' and watch_ed='$watchedid'");
	}
}
	
	

#DIL SECIMI
if (isset($_GET['language'])) {
	$language=$_GET['language']; 
	if ($login=="true") { 
		mysql_query("UPDATE users SET user_language = '$language' WHERE user_id='$currentuser[0]'"); 
		$_SESSION['timeflaxuser']['language']=$language;
	} else { 
		setcookie('lang',$language,time()+36000);
	}
	$prevurl=$_SESSION['prevurl'];
	header ("Location:$prevurl");
}


	
#ULKEYE GORE SEHIR LISTESI
if (isset($_POST['countrytd'])) { ?>
	<?php 
	$countrytd=$_POST['countrytd'];
	$city="";
	if (isset($_POST['city'])) { $city=$_POST['city']; };
	$getdata=mysql_query("SELECT * FROM cities WHERE city_parent='$countrytd'");
	while ($read=mysql_fetch_assoc($getdata)) {
	$city_name=$read['city_name'];
	$city_id=$read['city_id'];	
	?>
	<option value="<?php echo $city_id; ?>" <?php if ($city_id==$city && $first==true) { echo  'selected="selected"'; }; ?>><?php echo ucfirst_tr($city_name); ?></option>
	<?php 
	}; 
	
};
# NOTIFICATION CLEAR
if (isset($_POST['ntfclear']) && $login=='true') {
	$done=mysql_query("DELETE FROM notifications WHERE not_userid='$self_id'");	
}



#AJAX ILE COUNTDOWN CEKME
if(isset($_POST['action']) and $_POST['action']=="getcountdown") {
	$tf_ajax_id=$_POST['tfid'];
	$getcds=mysql_query("SELECT * FROM cds INNER JOIN users ON cd_userid = users.user_id WHERE cd_id = '$tf_ajax_id'");
	while ($readcds=mysql_fetch_assoc($getcds)) {
		$cd_id=$readcds['cd_id'];
		$cd_title=$readcds['cd_title'];
		$cd_text=$readcds['cd_text'];
		$cd_icon=$readcds['cd_icon'];
		$cd_expire=$readcds['cd_expire'];
		$cd_followers=$readcds['cd_followers'];
		$user_id=$readcds['user_id'];
		$user_name=$readcds['user_name'];
	?>
		<span class="cdid">#<?php echo $cd_id; ?></span>
		<span class="cdtitle"><?php echo $cd_title; ?></span>
		<span class="cdfollow"><?php echo $cd_followers; ?></span>
		<span class="cdicon"><?php echo $cd_icon; ?></span>
		<span class="cdtext"><?php echo $cd_text; ?></span>
		<span class="cdexpire"><?php echo dateexp($cd_expire,0); ?></span>
		<span class="cde"><h1><?php echo dateexp($cd_expire,6); ?></h1>
		<h2><?php echo dateexp(dtdiff($cd_expire,$dtstamp),5); ?></h2>
		<h3><?php echo dateexp(dtdiff($cd_expire,$dtstamp),4); ?></h3>
		<h4><?php echo dateexp(dtdiff($cd_expire,$dtstamp),3); ?></h4>
		<h5><?php echo dateexp(dtdiff($cd_expire,$dtstamp),2);?></h5>
		<h6><?php echo dateexp(dtdiff($cd_expire,$dtstamp),1); ?></h6></span>
		<span class="cduser"><?php echo $user_name; ?></span>
	<?php }; 
};

?>