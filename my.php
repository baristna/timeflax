<?php ob_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php include('connection.php');include('functions.php');include('classes.php'); include('jsprocess.php');
if ($login=="false") {
	header('refresh:$errorwait; url=login.php?mte410');
};
if(isset($_GET['info'])) { header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); };
$thispage=new page;
$thispage->pagename="my.php";
$thispage->cd_page="1";
$thispage->cd_pagesize="9";
$thispage->cd_maxpagenum="50";
$thispage->timeupperpoint=dtplus($dtstamp,"0000-00-00 01:00:00");
$thispage->mintime=$dtstamp;
$thispage->mingmttime=gmttodt($dtstamp);
$thispage->maxtime=dtplus($dtstamp,"0000-00-00 01:00:00");
$thispage->maxgmttime=gmttodt($thispage->maxtime);
$thispage->pagecreate();	
$_SESSION['prevurl']=$thispage->fullurl();

$st_mypage="";
$st_settings="";
$con_countdowns="";
	$con_c_all="";
	$con_c_own="";
	$con_c_waitings="";
$con_users="";
	$con_u_subscribers="";
	$con_u_subscribings="";
$con_programs="";
	$con_p_all="";
	$con_p_own="";
	$con_p_waitings="";
$cd_edit="";
$cd_new="";
$prg_new="";
$prg_edit="";
$currentbutton=$thispage->cd_stage; $$currentbutton='selected';
$currentbutton=$thispage->cd_substage; $$currentbutton='selected'; ?>
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
	<script type="text/javascript" src="files/js/mypage.js"></script>
</head>


<body>

<div class="lightbox" id="lb-avatar-delete">
	<div class="lightbox-in">
		<div class="lightbox-head"></div>
		<div class="lightbox-body"><?php echo wrd('Picture_will_be_deleted'); ?></div>
		<div class="lightbox-foot">
			<a class="buttonlight lb-close"><?php echo wrd('Cancel'); ?></a>
			<a class="buttonlight" href="action.php?delete=avatar"><?php echo wrd('Accept'); ?></a>
		</div>
	</div>
</div>
<div class="lightbox" id="lb-avatar-change">
	<div class="lightbox-in">
	<div class="lightbox-head"><?php echo wrd('Change_Picture'); ?></div>
	<div class="lightbox-body" style="text-align:left;">
	
		<script type="text/javascript">
        function readURL(input) {
			$('#foo').html('<img src="#x" id="bar" />');
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#bar').attr('src', e.target.result);
					
					var iW=$('#bar').width();
					var iH=$('#bar').height();
					if (iW<iH) { var rat = 200/iW; iH=iH*rat; iW=200; }
					else if (iW>iH) { var rat =200/iH; iW=iW*rat; iH=200; }
					else { iW=200; iH=200; };
					$('#bar').imageCropper({ imagewidth:iW,imageheight:iH });
					
					var imageTopMargin=$('#bar').parent().parent().offset().top-$('#bar').offset().top;
					var imageLeftMargin=$('#bar').parent().parent().offset().left-$('#bar').offset().left;
					$('#imagetopmargin').val(imageTopMargin);
					$('#imageleftmargin').val(imageLeftMargin);
					
					$.lbAlign();
					$('#chageavatar-apply').removeAttr('disabled');
					
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    	</script>
		<form enctype="multipart/form-data" action="action.php" method="post" id="avatar-loader" runat="server">
		<input  name="tmpavatar" id="tmpavatar" type="file" onchange="readURL(this);">
		<input type="hidden" name="imageleft" value="0" id="imageleftmargin" /><input type="hidden" name="imagetop" id="imagetopmargin" value="0" />
		</form>
		<div id="foo"></div>
	</div>
	<div class="lightbox-foot">
		<a href="#x" class="buttonlight lb-close">Vazgeç</a> 
		<input  id="chageavatar-apply" type="button" href="#x" class="buttonlight" onclick="$('#avatar-loader').submit()" disabled="disabled" value="<?php echo wrd('Apply'); ?>"></div>
	</div>
</div>
<?php include('header.php'); ?>






<div id="tf-container">
	<div id="tf-container-in">



        <div id="tf-leftmenu"><div id="tf-leftmenu-in"><p>
		
		<ul class="leftblock" style="text-align:right ;">
            	<li style="font-size:21px;"><a href="my.php"><?php if ($currentuser['rel']==1) { echo "<img class='radic' src='files/images/icon-RadicB.png'>"; }; echo $currentuser['aname']; ?></a></li>                            
			
				<li class="<?php echo $st_mypage; ?>"><a href="<?php echo "my.php?"; ?>stage=st_mypage"><?php echo wrd('My_Page'); ?>
						<?php 
						if (isset($_COOKIE['notification'])) { ?>
						(<?php echo $_COOKIE['notification']; ?>)
						<?php }; ?>
				</a></li>
				<li class="<?php echo $st_settings; ?>"><a href="<?php echo "my.php?"; ?>stage=st_settings"><?php echo wrd('Settings'); ?></a></li>							
         </ul>
            <hr />
            <ul class="leftblock" style="text-align:right">
            	<li><?php echo wrd('Connections'); ?>
                	<ul>    
                       	<li class="<?php echo $con_countdowns; ?> sb" ><a href="my.php?stage=con_countdowns&substage=con_c_all"><?php echo wrd('Countdowns'); ?></a>
						<ol style="display:none">								
								<li><a href="my.php?stage=con_countdowns&substage=con_c_all"><?php echo wrd('All'); ?></a></li>
								<li><a href="my.php?stage=con_countdowns&substage=con_c_own"><?php echo wrd('My_Countdowns'); ?></a></li>
								<li><a href="my.php?stage=con_countdowns&substage=con_c_waitings"><?php echo wrd('My_Waitings'); ?></a></li>
							</ol>
						</li>
						<li class="<?php echo $con_users; ?> sb" ><a href="my.php?stage=con_users&substage=con_u_subscribings"><?php echo wrd('Users'); ?></a>
						<ol style="display:none">			
								<li><a href="my.php?stage=con_users&substage=con_u_subscribings"><?php echo wrd('Subscribings'); ?></a></li>
								<li><a href="my.php?stage=con_users&substage=con_u_subscribers"><?php echo wrd('Subscribers'); ?></a></li>
							</ol>
						</li>
						<li class="<?php echo $con_programs; ?> sb" ><a href="my.php?stage=con_programs&substage=con_p_all"><?php echo wrd('Programs'); ?></a>
						<ol style="display:none">								
								<li><a href="my.php?stage=con_programs&substage=con_p_all"><?php echo wrd('All'); ?></a></li>
								<li><a href="my.php?stage=con_programs&substage=con_p_own"><?php echo wrd('My_Programs'); ?></a></li>
								<li><a href="my.php?stage=con_programs&substage=con_p_waitings"><?php echo wrd('My_Waitings'); ?></a></li>
							</ol>
						</li>	
                    </ul>
                 </li>
            </ul>
			<hr />
            <ul class="leftblock" style="text-align:right">
            	<li><?php echo wrd('Countdown'); ?>
                	<ul>    
                       	<li class="<?php echo $cd_new; ?>"><a href="<?php echo "my.php?"; ?>stage=cd_new"><?php echo wrd('Create'); ?></a></li>
						<li class="<?php echo $cd_edit; ?>"><a href="<?php echo "my.php?"; ?>stage=cd_edit"><?php echo wrd('Edit'); ?></a></li>	
                    </ul>
                 </li>
            </ul>
			<hr />
            <ul class="leftblock" style="text-align:right">
            	<li><?php echo wrd('Programs'); ?>
                	<ul>    
                       	<li class="<?php echo $prg_new; ?>"><a href="<?php echo "my.php?"; ?>stage=prg_new"><?php echo wrd('Create'); ?></a></li>
						<li class="<?php echo $prg_edit; ?>"><a href="<?php echo "my.php?"; ?>stage=prg_edit"><?php echo wrd('Edit'); ?></a></li>	
                    </ul>
                 </li>
            </ul>
			<hr />
			
			<ul class="leftblock" style="text-align:right ;">
				<li class=""><a href="action.php?logout=true"><?php echo wrd('Logout'); ?></a></li>									
			 </ul>
			
			
			<br /><br /><br />
        </p></div></div><!-- tf-leftmenu-->
		
		<?php include('programlist.php'); ?>				
        
        
        <div id="tf-area">
        	<div id="tf-area-in">
			
								<div class="tfh1top">
									<ul class="text">
										<?php echo wrd($thispage->cd_stage); ?> 
										<?php if ($thispage->cd_substage!="") { echo " > ".wrd($thispage->cd_substage); }; ?>
									</ul>
							
									<ul class="menu right">
										<?php if ($thispage->cd_stage=="con_countdowns") { ?>
											<li class="<?php echo $con_c_all; ?>"><a href="my.php?stage=con_countdowns&substage=con_c_all"><?php echo wrd('All'); ?></a></li>
											<li class="<?php echo $con_c_own; ?>"><a href="my.php?stage=con_countdowns&substage=con_c_own"><?php echo wrd('My_Countdowns'); ?></a></li>
											<li class="<?php echo $con_c_waitings; ?>"><a href="my.php?stage=con_countdowns&substage=con_c_waitings"><?php echo wrd('My_Waitings'); ?></a></li>
										<?php } else if ($thispage->cd_stage=="con_users") { ?>
											<li class="<?php echo $con_u_subscribings; ?>"><a href="my.php?stage=con_users&substage=con_u_subscribings"><?php echo wrd('Subscribings'); ?></a></li>
											<li class="<?php echo $con_u_subscribers; ?>"><a href="my.php?stage=con_users&substage=con_u_subscribers"><?php echo wrd('Subscribers'); ?></a></li>
										<?php } else if ($thispage->cd_stage=="con_programs") { ?>
											<li class="<?php echo $con_p_all; ?>"><a href="my.php?stage=con_programs&substage=con_p_all"><?php echo wrd('All'); ?></a></li>
											<li class="<?php echo $con_p_own; ?>"><a href="my.php?stage=con_programs&substage=con_p_own"><?php echo wrd('My_Programs'); ?></a></li>
											<li class="<?php echo $con_p_waitings; ?>"><a href="my.php?stage=con_programs&substage=con_p_waitings"><?php echo wrd('My_Waitings'); ?></a></li>
										<?php }; ?>
									</ul>
								</div>
								
								<?php
								if ($thispage->cd_stage=="con_countdowns"){/* select cds (tablo seçimi) inner join users (ekleyen üye) left join new (takipçi sayısı) where zaman ve kategori, order sıralama biçimi */ 
									$writecountdowns=new countdown;
									$writecountdowns->createcountdowns($thispage->cd_sqlcommand());	
									if ($writecountdowns->countrows==0) { ?>
									<div class="onecloumn">
										<div class="cloumn">
											<div class="cloumn-block">
												<div class="cloumn-block-head">
													Bulunamadı
												</div>
												<div class="cloumn-block-body">
													Aradığınız kriterlerde sonuç bulunamadı
												</div>
												<div class="cloumn-block-foot">
													
												</div>
											</div>
										</div>
									</div>      
									<?php }; ?>
									<div style="clear:both"></div>
								<?php if ($writecountdowns->countrows!=0) { ?>
								 <div class="tfh1bottom" style="height:30px; padding-top:10px; text-align:center;">
									<?php $thispage->pagebuttons(); ?>
								</div>
							<?php }; ?>
								
								
								<?php } else if ($thispage->cd_stage=="st_mypage") { ## MYPAGE ?>
														
									<ul class="leftblock" style="text-align:right; width:158px">
										<li style=""><?php echo wrd('Popularity').": ".userpopularity($currentuser['id']); ?></li><br />
										<li style=""><?php echo wrd('Watchers').": ".userwatchers($currentuser['id']); ?></li>
										<li style=""><?php echo wrd('Total_Waitings').": ".usertotalwait($currentuser['id']); ?></li>
										<li style=""><?php echo wrd('Total_Cds').": ".usercdscount($currentuser['id']); ?></li>
									</ul>
									
									
									<div class="onecloumn">
										<div class="cloumn">
											<div class="cloumn-block">
												<div class="cloumn-block-head">
													<?php echo wrd('Notifications'); ?>
												</div>
												<div class="cloumn-block-body">
													<ul style="list-style:none; padding-left:0px;" id="notifications-panel">
													<?php
														$xx=0;
														$getnots=mysql_query("SELECT * FROM notifications WHERE not_userid='$currentuser[0]' ORDER BY not_time DESC");
														while ($readnots=mysql_fetch_assoc($getnots)){
														$xx=$xx+1;
														$not_time=$readnots['not_time'];
														$not_reason=$readnots['not_reason'];
														$not_user=$readnots['not_user'];
														$not_countdown=$readnots['not_countdown'];
														$not_text=$readnots['not_text'];
														$not_link=$readnots['not_link'];
														$not_seen=$readnots['not_seen'];	
														if ($not_seen=='0') { $seencolor='#000'; } else { $seencolor='#999'; };												
													?>
														<li style="color:<?php echo $seencolor; ?>">
														<?php echo $not_time." : "; 
															if ($not_user!='') { echo ' <b><a href="user.php?id='.$not_user.'">'.username($not_user).'</a></b> ';  };
															echo wrd($not_reason)." ";
															if ($not_countdown!='') { echo '<b><a href="cd.php?id='.$not_countdown.'">'.cdtitle($not_countdown).'</a></b> ';  };
															if ($not_text!='') { echo wrd($not_text);  };
														?>
														</li>
													<?php 
													};
													if ($xx==0) { echo '<i>'.wrd('You_dont_have_any_notification').'</i>'; };
													$getnots=mysql_query("UPDATE notifications SET not_seen='1' WHERE not_userid='$currentuser[0]'");?>
													</ul>
												</div>
												<div class="cloumn-block-foot">
												<?php if ($xx!=0) {  ?>
													<div  style="text-align:right"><a id="ntfclear" class="buttonlight">Temizle</a></div>
												<?php }; ?>
												</div>
											</div>
										</div>
									</div>
									<?php } else if ($thispage->cd_stage=="st_settings") { ## SETTINGS ?>
									<div class="lefttwocloumn">
										<div class="cloumn">
											<div class="cloumn-block">
												<div class="cloumn-block-head">
													<?php echo $currentuser['aname']; ?>
												</div>
												<div class="cloumn-block-body" id="imagebox">
													<img src="files/avatars/<?php echo $currentuser['avatar']; ?>.jpg?" />
												</div>
												<div class="cloumn-block-foot" style="text-align:right">
													<a class="buttonlight" href="#x" id="avatar-delete"><?php echo wrd('Delete_Picture'); ?></a>
													<a class="buttonlight" href="#x" id="avatar-change"><?php echo wrd('Change_Picture'); ?></a>
												</div>
											</div>
										</div>
										
										<div class="cloumn">
											<div class="cloumn-block">
												<div class="cloumn-block-head">
													<?php echo wrd('Account_Settings'); ?>
												</div>
												<div class="cloumn-block-body">
													<form id="account_settings" method="post" action="action.php">
													<input type="hidden" name="account_update" value="true" />
													<table width="100%">
														<tr>
															<td><?php echo wrd('User_ID'); ?></td>
															<td width="350"><b><?php echo $currentuser['id']; ?></b></td>
														</tr>
														<tr>
															<td><?php echo wrd('User_login_name'); ?></td>
															<td width="350"><input type="text" name="change_user_name" id="change_user_name" value="<?php echo $currentuser['name']; ?>" /></td>
														</tr>
														<tr>
															<td><?php echo wrd('e-Mail'); ?></td>
															<td><input type="text" id="change_mail"  name="change_mail" value="<?php echo $currentuser['mail']; ?>" /></td>
														</tr>
														<tr>
															<td><?php echo wrd('Username'); ?></td>
															<td><input type="text" id="change_user_aname"  name="change_user_aname" value="<?php echo $currentuser['aname']; ?>" /></td>
														</tr>
														<tr>
															<td><?php echo wrd('Country'); ?></td>
															<td><select name="change_country"  id="change_country" tabindex="37">
																<?php 
																$getcountry=mysql_query("SELECT * FROM countries");
																while ($readcountry=mysql_fetch_assoc($getcountry)) { 
																$cntname=$readcountry['country_name']; 
																$cnttd=$readcountry['country_td'];
																?>
																<option <?php if($cnttd==$currentuser['country']) { echo  'selected="selected"'; } ?> value="<?php echo $cnttd; ?>"><?php echo ucfirst_tr($cntname); ?></option>
																<?php }; ?>
															</select></td>
														</tr>
														<tr>
															<td><?php echo wrd('Language'); ?></td>
															<td><select style="width:145px;" name="change_language" id="change_language" tabindex="37">
																<?php 
																$getlng=mysql_query("SELECT * FROM languages");
																while ($readlng=mysql_fetch_assoc($getlng)) { 
																$lngid=$readlng['language_id']; 
																$lngname=$readlng['language_name']; 
																$lngcode=$readlng['language_code'];
																?>
																<option <?php if($lngid==$lang) { echo  'selected="selected"'; } ?> value="<?php echo $lngid; ?>"><?php echo $lngname." (".$lngcode.")"; ?></option>
																<?php }; ?>
															</select></td>
														</tr>
													</table>
													
												<div style="text-align:right">
													<a class="buttonlight" id="account_settings_submit" href="#x"><?php echo wrd('Save_Changes'); ?></a>
												</div>
												</form>											
												</div>
											</div>
											<div class="cloumn-block">
												<div class="cloumn-block-head">
													<?php echo wrd('Security_Settings'); ?>
												</div>
												<div class="cloumn-block-body">
												<form method="post" action="action.php" id="change_password_form">
													<table width="100%">
														<tr>
															<td><?php echo wrd('Current_Password'); ?></td>
															<td width="350"><input type="password" name="oldpassword" id="oldpassword"  value="" /></td>
														</tr>
														<tr>
															<td><?php echo wrd('New_Password'); ?></td>
															<td><input type="password" name="changepassword" id="change_password" value="" /></td>
														</tr>
														<tr>
															<td><?php echo wrd('New_Password')." (".wrd('Again').")"; ?></td>
															<td><input type="password" name="changepasswordre" id="change_passwordre"  value="" /></td>
														</tr>
													</table><br />
													<div style="text-align:right">
														<a class="buttonlight" href="#x" id="change_password_submit"><?php echo wrd('Change_Password'); ?></a>
													</div><br />	
												</form>
												<form id="change_security" method="post" action="action.php">	
													<table width="100%">
														<tr>
															<td><?php echo wrd('Secret_Question'); ?></td>
															<td width="350"><input type="text" name="changequestion" id="changequestion" value="<?php echo $currentuser['question']; ?>" /></td>
														</tr>
														<tr>
															<td><?php echo wrd('Secret_Answer'); ?></td>
															<td><input type="password" name="changeanswer" id="changeanswer" value="" /></td>
														</tr>
														<tr>
															<td><?php echo wrd('Secret_Answer')." (".wrd('Again').")"; ?></td>
															<td><input type="password" name="changeanswerre" id="changeanswerre"  value="" /></td>
														</tr>
														<tr>
															<td><?php echo wrd('Current_Password'); ?></td>
															<td><input type="password" name="password" id="password"  value="" /></td>
														</tr>
													</table>
														<br />
													<div style="text-align:right">
														<a class="buttonlight" id="change_security_submit"><?php echo wrd('Change_Security_Informations'); ?></a>
													</div>
													</form>										
												</div>
											</div>
											
											<div class="cloumn-block">
												<div class="cloumn-block-head">
													<?php echo wrd('Delete_Account'); ?>
												</div>
												<div class="cloumn-block-body">
												<table width="100%">
													<tr>
														<td><?php echo wrd('Delete_account_without_sharings'); ?></td>
														<td align="right"><input type="radio" name="delete" value="withoutall"  /></td>
													</tr>
													<tr>
														<td><?php echo wrd('Delete_account_with_all'); ?></td>
														<td align="right"><input type="radio" name="delete" value="withall" /></td>
													</tr>
												</table><br />
														
													
													<div style="text-align:right">
														<a class="buttonlight" href="#x"><?php echo wrd('Delete_Account'); ?></a>
													</div>
												</div>
											</div>

											
										</div>
										<div style="clear:both"></div>
									</div>

									
								<?php } else if ($thispage->cd_stage=="st_new") { ## NEW ?>
								<div class="fivecloumn">
									<div class="cloumn">
									<?php 
									$getusers=mysql_query("SELECT * FROM users");
									while ($readusers=mysql_fetch_assoc($getusers)) {
									?>
										<div class="cloumn-block">
											<div class="cloumn-block-head">
												<div class="left" style="float:left">
													<img src="files/flags/TR.png" /> TR
												</div>												
												<div class="right">
													<a href="#x">1001<img src="files/images/subscribe-b.png" /></a>
												</div>
											</div>
											<div class="cloumn-block-body">
											<img src="files/avatars/<?php echo $readusers['user_avatar']; ?>.jpg" />
											</div>
											<div class="cloumn-block-foot">
												<div>
											<?php echo $readusers['user_name']; ?>
												</div>
											</div>
										</div>
										<?php }; ?>
										<div style="clear:both"></div>
									</div>
								</div>
								<?php } else { ?>
								
								
								
								
								<?php };  ## END STAGES ?>
                 </div><!--tf-area-in-->
        </div><!-- tf-area-->

        
       
		<?php include('footer.php'); ?>	
        </div><!-- tf-container-in -->
	</div><!-- tf-container-->
</body>
</html>
<?php ob_end_flush(); ?>






