<?php ob_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php include('connection.php'); include('functions.php'); include('classes.php'); include('jsprocess.php');
$_SESSION['prevurl']='login.php';
$thispage->pagename="login.php";
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
	<link id="maincss" rel="stylesheet" href="jsscroolpane.css" type="text/css" />
	<link id="maincss" rel="stylesheet" href="timepicker.css" type="text/css" />
	<script type="text/javascript" src="files/js/jquery-1.9.0.js"></script>
	<script type="text/javascript" src="files/js/jquery-ui-1.10.2.custom.js"></script>
	<script type="text/javascript" src="files/js/plugins.js"></script>
	<script type="text/javascript" src="files/js/tf-functions.js"></script>
	<script type="text/javascript" src="files/js/main.js"></script>
	<script type="text/javascript" src="files/js/newcontrol.js"></script>
</head>


<body>
<?php include('header.php'); ?>

<div id="tf-container">
	<div id="tf-container-in">
        <div id="tf-leftmenu"><div id="tf-leftmenu-in"><p>
			<ul class="leftblock">
            	<li><a href="info.php?node=about"><?php echo wrd('About'); ?></a></li>
				<li><a href="info.php?node=help"><?php echo wrd('Help'); ?></a></li>
				<li><a href="info.php?node=blog"><?php echo wrd('Blog'); ?></a></li>
				<li><a href="info.php?node=contact"><?php echo wrd('Contact'); ?></a></li>
				<li><a href="info.php?node=terms"><?php echo wrd('Terms_of_Service'); ?></a></li>
				<li><a href="info.php?node=policy"><?php echo wrd('Privacy_Policy'); ?></a></li>
				<li><a href="info.php?node=advertising"><?php echo wrd('Advertising'); ?></a></li>
				<li><a href="info.php?node=faq"><?php echo wrd('FAQ'); ?></a></li>
				<li><a href="info.php?node=using"><?php echo wrd('Using_timeflax'); ?></a></li>
            </ul>   
			<br /><br /><br /><br />
		</p></div></div><!-- tf-leftmenu-->
        
        
        <div id="tf-area">
        	<div id="tf-area-in">
					<div class="tfh1top">
						<ul class="text">
						<b><?php echo wrd('Login_and_Sign_Up'); ?></b>
						</ul>
					</div>
					<div class="twocloumn">
						<div class="cloumn">
							<div class="cloumn-block">
								<div class="cloumn-block-head"  id="loginbox">
								<h2><?php echo wrd('Login'); ?></h2>
								</div>
								<div class="cloumn-block-body">
								<form action="action.php" method="post">
								<input type="hidden" name="login" value="true" tabindex="10" />
								<?php echo wrd('Username_or_Mail'); ?><br />
								<input type="text" name="s_username" tabindex="11" /><br />
								<?php echo wrd('Password'); ?><br />
								<input type="password" name="s_password" tabindex="12" /><br />
								<div style="text-align:right; padding:0; margin-top:12px;"><a href="#s" class="buttonlight facebook-button"><?php echo wrd('Facebook_Login'); ?></a> <input type="submit" class="buttonlight" value="<?php echo wrd('Submit'); ?>" tabindex="13" /></div>
								</form>
								</div>
							</div>
							
							
							<div class="cloumn-block">
								<div class="cloumn-block-head"  id="forgotpasswordbox">
								<h2><?php echo wrd('Forgot_Password'); ?></h2>
								</div>
								<div class="cloumn-block-body">
									<span id="firststepdone" style="display:none;"><?php echo wrd('Username_or_Mail'); ?>: <span style="font-weight:bold"></span><br /></span>
									<form id="fp_firststep">
									<?php echo "1. ".wrd('Step').": ".wrd('Username_or_Mail'); ?><br />
									<input type="text" id="fp_username" tabindex="20" /><br />
										<div style="text-align:right; padding:0; margin-top:12px;">
										<input type="button" id="fp_firststep" class="buttonlight" value="<?php echo wrd('Next'); ?>"  tabindex="21"/>
										</div>
									</form>
									<span id="secondstepdone" style="display:none;"><?php echo wrd('Secret_Question_is_Answered'); ?><br /></span>
									<form id="fp_secondstep" style="display:none;">
									<br />
									<?php echo "2. ".wrd('Step').": ".wrd('Secret_Question'); ?> : <span id="secret_quest">?</span><br />
									<input type="password" id="fp_answer" tabindex="20" /><br />
										<div style="text-align:right; padding:0; margin-top:12px;">
										<input type="button" id="fp_secondstep" class="buttonlight" value="<?php echo wrd('Next'); ?>"  tabindex="21"/>
										</div>
									</form>
									<span id="thirdstepdone" style="display:none;"><?php echo wrd('NewPassDone'); ?></span>
									<form id="fp_thirdstep" style="display:none;">
									<br /><?php echo "3. ".wrd('Step').":<br/>".wrd('New_Password'); ?><br />
									<input type="password" id="fp_newpass" tabindex="20" /><br />
									<?php echo wrd('New_Password')." (".wrd('Again').")"; ?><br />
									<input type="password" id="fp_newpassagain" tabindex="20" /><br />
										<div style="text-align:right; padding:0; margin-top:12px;">
										<input type="button" id="fp_thirdstep" class="buttonlight" value="<?php echo wrd('Apply'); ?>"  tabindex="21"/>
										</div>
									</form>
								</div>
							</div>
						</div>
						
						
						<div class="cloumn">
							<div class="cloumn-block" >
								<div class="cloumn-block-head" id="newuserbox">
								<h2><?php echo wrd('Sign_Up'); ?></h2>
								</div>
								<div class="cloumn-block-body">
								<form action="action.php" method="post" name="newuser" id="newuser">
								<?php echo wrd('Username'); ?> <span id="newuserinfo" class="red"></span><br />
								<input type="text" name="new_username" id="newusername" value="" autocomplete="off" tabindex="30"/><br />
								<?php echo wrd('e-Mail'); ?> <span id="newmailinfo" class="red"></span><br />
								<input type="text" name="new_mail" id="newmail" autocomplete="off" value=" " tabindex="31"/><br /><br />
								<?php echo wrd('Password'); ?> <span id="newpasswordinfo" class="red"></span><br />
								<input type="password" id="newpassword" name="new_password" autocomplete="off" tabindex="32" value=""/><br />
								<?php echo wrd('Password_Again'); ?> <span id="newpasswordreinfo" class="red"></span><br />
								<input type="password" id="newpasswordre" name="new_passwordre" tabindex="33" value=""/><br /><br />
								
								<?php echo wrd('Secret_Question'); ?> <span id="newsecretquestioninfo" class="red"></span><br />
								<input type="text" id="newsecretquestion" name="new_secretquestion" tabindex="34" value="" /><br />
								<?php echo wrd('Secret_Answer'); ?> <span id="newsecretanswerinfo" class="red"></span><br />
								<input type="password" id="newsecretanswer" name="new_secretanswer" tabindex="35" value=""/><br />
								<?php echo wrd('Secret_Answer_Again'); ?> <span id="newsecretanswerreinfo" class="red"></span><br />
								<input type="password" id="newsecretanswerre" name="new_secretanswerre" tabindex="36" value=""/><br /><br />
								
								<span id="newcountryinfo"><?php echo wrd('Country'); ?></span>
								<select style="width:145px;" name="countrytd" id="newcountry" tabindex="37">
									<?php 
									$getcountry=mysql_query("SELECT * FROM countries");
									while ($readcountry=mysql_fetch_assoc($getcountry)) { 
									$cntname=$readcountry['country_name']; 
									$cnttd=$readcountry['country_td'];
									?>
									<option <?php if($cnttd=="US") { echo  'selected="selected"'; } ?> value="<?php echo $cnttd; ?>"><?php echo ucfirst_tr($cntname); ?></option>
									<?php }; ?>
								</select>
								<span id="newcountryinfo"><?php echo wrd('Language'); ?></span>
								<select style="width:100px;" name="new_language" id="newlanguage" tabindex="39">
								<?php 
								$getlng=mysql_query("SELECT * FROM languages");
								while ($readlng=mysql_fetch_assoc($getlng)) { 
								$lngid=$readlng['language_id']; 
								$lngname=$readlng['language_name']; 
								$lngcode=$readlng['language_code'];
								?>
								<option <?php if($lngid==$lang) { echo  'selected="selected"'; } ?> value="<?php echo $lngid; ?>"><?php echo $lngname." (".$lngcode.")"; ?></option>
								<?php }; ?>
								</select>
								
								<div style="text-align:right; padding:0; margin-top:12px;"><span style="font-size:13px">
								<?php echo wrd('I_read_and_accept_Terms_of_Service'); ?></span>
								
								<input type="button" class="buttonlight" id="newsubmit" value="Onayla" tabindex="40" /></div>
								</form>
								</div>
							</div>
						</div>
						<div style="clear:both"></div>
						
                	</div>
                 </div><!--tf-area-in-->
        </div><!-- tf-area-->
        
        
        
        
   		<?php include('footer.php'); ?>
        </div><!-- tf-container-in -->
	</div><!-- tf-container-->
</body>
</html>
<?php ob_end_flush(); ?>