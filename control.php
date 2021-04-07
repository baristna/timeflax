<?php include('connection.php'); include('functions.php'); include('classes.php');


#Yeni Kullanıcı Adı Seçimi
$newuserdraft=new edituser;
if(isset($_POST['newusername'])){
	$newuserdraft->user_name=$_POST['newusername'];
	if ($newuserdraft->new_control_name()){ echo "false"; } else { echo "true"; };
}

#Yeni Mail Seçimi
if(isset($_POST['newmail'])){
	$newuserdraft->user_mail=$_POST['newmail'];
	if ($newuserdraft->new_control_mail()){ echo "false"; } else { echo "true"; };
}


#Kullanıcı login adını değiştirme kontorlü
if(isset($_POST['changeusername'])){
	$changeusername=$_POST['changeusername'];
	$userdraft=new edituser;
	$userdraft->user_name=$changeusername;
	if ($userdraft->change_control_name($currentuser[0])) { echo "true"; } else { echo "false"; };
	
}
#Kullanıcı adını değiştirme kontrolü
if(isset($_POST['changeaname'])){
	$changeaname=$_POST['changeaname'];
	$userdraft=new edituser;
	$userdraft->user_aname=$changeaname;
	if ($userdraft->change_control_aname($currentuser[0])) { echo "true"; } else { echo "false"; };
}
#Kullanıcı mail değiştirme kontrolü
if(isset($_POST['changemail'])){
	$changemail=$_POST['changemail'];
	$userdraft=new edituser;
	$userdraft->user_mail=$changemail;
	if ($userdraft->change_control_mail($currentuser[0])) { echo "true"; } else { echo "false"; }
}
#Şifre mail değiştirme kontrolü
if(isset($_POST['changepassword']) && isset($_POST['changepasswordre'])){
	$changemail=$_POST['changemail'];
	$userdraft=new edituser;
	$userdraft->user_password=md5($_POST['password']);
	$userdraft->user_passwordre=md5($_POST['passwordre']);
	if ($userdraft->change_control_password($currentuser[0])) { echo "true"; } else { echo "false"; }
}

#Ülke Kontrol
if(isset($_POST['countrycode'])){
	$countrycode=$_POST['countrycode'];
		$read=mysql_fetch_assoc(mysql_query("SELECT count(country_td) as tds FROM countries WHERE country_td='$countrycode'"));
		if ($read['tds']!=1) { echo "true"; } else { echo "false"; };
	
}

#Dil Kontrol
if(isset($_POST['languageid'])){
	$languageid=$_POST['languageid'];
		$read=mysql_fetch_assoc(mysql_query("SELECT count(language_id) as lngs FROM languages WHERE language_id='$languageid'"));
		if ($read['lngs']!=1) { echo "true"; } else { echo "false"; };
	
}
#Şifre Yenileme 1. Adım Kullanıcının Gizli sorusunu getir.
if(isset($_POST['fp_username']) && !isset($_POST['fp_answer']) && !isset($_POST['fp_newpass'])){
	$fpusername=$_POST['fp_username'];
	if ($read=mysql_fetch_assoc(mysql_query("
		SELECT * FROM users
		WHERE user_name='$fpusername' OR user_mail='$fpusername'
		"))) {
			echo $read['user_question'];
		} else {
			echo "non";
		};
}
#Şifre Yenileme 2. Adım Gizli cevabı sorgula.
if(isset($_POST['fp_answer']) && isset($_POST['fp_username']) && !isset($_POST['fp_newpass'])){
	$fpusername=$_POST['fp_username'];
	$fpanswer=md5($_POST['fp_answer']);
	if ($read=mysql_fetch_assoc(mysql_query("
		SELECT * FROM users
		WHERE user_name='$fpusername' OR user_mail='$fpusername'
		"))) {
			if ($read['user_answer']==$fpanswer){ 
				echo "true";
			} else {
				echo "false";	
			};
		} else {
			echo "non";
		};
}
#Şifre Yenileme 3. Adım Gizli cevabı sorgula.
if(isset($_POST['fp_answer']) && isset($_POST['fp_username']) && isset($_POST['fp_newpass'])){
	
	$fpusername=$_POST['fp_username'];
	$fpanswer=md5($_POST['fp_answer']);
	$fpnewpass=md5($_POST['fp_newpass']);
	if ($read=mysql_fetch_assoc(mysql_query("
		SELECT * FROM users
		WHERE user_name='$fpusername' OR user_mail='$fpusername'
		"))) {
			if ($read['user_answer']==$fpanswer){
				if ($done=mysql_query("
					UPDATE users SET user_password = '$fpnewpass'
					WHERE user_name='$fpusername' OR user_mail='$fpusername'
					")) {
						echo "true";
					};
				echo "fail";
			} else {
				echo "false";	
			};
		} else {
			echo "non";
		};
}


## Program Listesine CD Ekle
if ($login=='true' && isset($_POST['action'])) {
	$action=$_POST['action'];
	if($action=='addcdtodraft'){
		
		$draggedcd=$_POST['draggedcd'];
		$program_id=$currentuser[19];
		$countcds=mysql_fetch_assoc(mysql_query("SELECT count(program_contain_id) as cntcds FROM program_contains WHERE program_contain_pid='$program_id' AND program_contain_cd='$draggedcd'"));
		$countedcds=$countcds['cntcds'];
		if ($countedcds<1) {
			if($done=mysql_query("INSERT INTO program_contains (program_contain_pid,program_contain_cd) VALUES ('$program_id','$draggedcd')")){;
				echo "true";
			} else {
				echo "error";
			};
		} else {
			echo "false";
		};
		
	} else if ($action=='deletecdfromdraft') {
		$deletecd=$_POST['deletecd'];
		$program_id=$currentuser[19];
		if($done=mysql_query("DELETE FROM program_contains  WHERE program_contain_pid='$program_id' AND program_contain_cd='$deletecd'")){
			echo "true";
		} else {
			echo "error";
		};
	}
}







