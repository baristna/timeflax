<?php ob_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php include('connection.php'); include('functions.php'); include('classes.php'); include('jsprocess.php');
$thispage=new page;
$thispage->pagename="user.php";
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
$cd_all="";
$cd_own="";
$cd_waitings="";
$st_new="";
$st_edit="";
$st_notifications="";
$st_settings="";

if(isset($_GET['id'])) {
	$finduser=new user;
	$thisuser = $finduser->getuser($_GET['id']);
} else {
	header('refresh:0; url=index.php');	
}
			
if ($login=="true") {
	$watches=mysql_fetch_assoc(mysql_query("SELECT count(watch_ed),watch_er as isitwatched 
											FROM watches 
											WHERE watch_ed='$thisuser[0]' and watch_er='$currentuser[0]' "));
	$isitwatched=$watches['isitwatched'];
	if ($isitwatched=="") { $isitwatched=0; };
} else {
	$isitwatched=0;
}


$u_st_profile="";
$u_con_countdowns="";
	$u_con_c_all="";
	$u_con_c_own="";
	$u_con_c_waitings="";
$u_con_users="";
	$u_con_u_subscribings="";
	$u_con_u_subscribers="";
$u_con_programs="";
	$u_con_p_all="";
	$u_con_p_own="";
	$u_con_p_waitings="";
$currentbutton=$thispage->cd_stage; $$currentbutton='selected';
$currentbutton=$thispage->cd_substage; $$currentbutton='selected'; 
	

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<link rel="image_src" href="<?php echo $thispage->meta_img; ?>"/>
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
    <meta property="og:image" content="<?php echo $thispage->meta_img; ?>" />
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
</head>


<body>
       
<?php include('header.php'); ?>

<div id="tf-container">
	<div id="tf-container-in">



        <div id="tf-leftmenu"><div id="tf-leftmenu-in"><p>
            <img src="files/avatars/<?php echo $thisuser['avatar']; ?>.jpg" width="158" />
         	<ul class="leftblock" style="text-align:right ; width:158px;">
            	<li style="font-size:21px;"><a href="user.php?id=<?php echo $thisuser['id']; ?>&stage=u_st_profile"><?php if ($thisuser['rel']==1) { echo "<img class='radic' src='files/images/icon-RadicB.png'>"; }; echo $thisuser['aname']; ?></a></li>                            
				<li><b><?php echo $thisuser['countrytd']; ?></b></li>
				<li style=""><?php echo wrd('Popularity').": ".userpopularity($thisuser['id']); ?></li>
            </ul>
         	<ul class="leftblock" style="text-align:right ; width:158px;">
				<?php if ($thisuser['id']!=$currentuser[0] && $login=="true") { 
					if ($isitwatched>=1) { ?>
					<li><a id="stop_watch" href="#x"><?php echo wrd('Stop_Watching'); ?></a></li>
				<?php } else { ?>
					<li><a id="watch" href="#x"><?php echo wrd('Watch'); ?></a></li>
				<?php }; };?>
            </ul>
			<hr /> <ul class="leftblock" style="text-align:right;  width:158px;">
            	<li><?php echo wrd('Connections'); ?>
                	<ul>    
                       	<li class="<?php echo $u_con_countdowns; ?> sb" ><a href="<?php echo "user.php?id=$thisuser[0]&"; ?>stage=u_con_countdowns&substage=u_con_c_all"><?php echo wrd('Countdowns'); ?></a>
						<ol style="display:none">								
								<li><a href="<?php echo "user.php?id=$thisuser[0]&"; ?>stage=u_con_countdowns&substage=u_con_c_all"><?php echo wrd('All'); ?></a></li>
								<li><a href="<?php echo "user.php?id=$thisuser[0]&"; ?>stage=u_con_countdowns&substage=u_con_c_own"><?php echo wrd('Own_Countdowns'); ?></a></li>
								<li><a href="<?php echo "user.php?id=$thisuser[0]&"; ?>stage=u_con_countdowns&substage=u_con_c_waitings"><?php echo wrd('Own_Waitings'); ?></a></li>
							</ol>
						</li>
						<li class="<?php echo $u_con_users; ?> sb" ><a href="<?php echo "user.php?id=$thisuser[0]&"; ?>stage=u_con_users&substage=u_con_u_subscribings"><?php echo wrd('Users'); ?></a>
							<ol style="display:none">								
								<li><a href="<?php echo "user.php?id=$thisuser[0]&"; ?>stage=u_con_programs&substage=subscribings"><?php echo wrd('Subscribings'); ?></a></li>
								<li><a href="<?php echo "user.php?id=$thisuser[0]&"; ?>stage=u_con_programs&substage=subscribers"><?php echo wrd('Subscribers'); ?></a></li>
							</ol>
						</li>
						<li class="<?php echo $u_con_programs; ?> sb" ><a href="<?php echo "user.php?id=$thisuser[0]&"; ?>stage=u_con_programs&substage=u_con_p_all"><?php echo wrd('Programs'); ?></a>
							<ol style="display:none">								
								<li><a href="<?php echo "user.php?id=$thisuser[0]&"; ?>stage=u_con_programs&substage=u_con_p_all"><?php echo wrd('All'); ?></a></li>
								<li><a href="<?php echo "user.php?id=$thisuser[0]&"; ?>stage=u_con_programs&substage=u_con_p_own"><?php echo wrd('Own_Programs'); ?></a></li>
								<li><a href="<?php echo "user.php?id=$thisuser[0]&"; ?>stage=u_con_programs&substage=u_con_p_waitings"><?php echo wrd('Own_Waitings'); ?></a></li>
							</ol>
						</li>	
                    </ul>
                 </li>
            </ul>
			
			
			
			<br />
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
										<?php if ($thispage->cd_stage=="u_con_countdowns") { ?>
											<li class="<?php echo $u_con_c_all; ?>"><a href="<?php echo "user.php?id=$thisuser[0]&"; ?>?stage=u_con_countdowns&substage=u_con_c_all"><?php echo wrd('All'); ?></a></li>
											<li class="<?php echo $u_con_c_own; ?>"><a href="<?php echo "user.php?id=$thisuser[0]&"; ?>stage=u_con_countdowns&substage=u_con_c_own"><?php echo wrd('Own_Countdowns'); ?></a></li>
											<li class="<?php echo $u_con_c_waitings; ?>"><a href="<?php echo "user.php?id=$thisuser[0]&"; ?>stage=u_con_countdowns&substage=u_con_c_waitings"><?php echo wrd('Own_Waitings'); ?></a></li>
										<?php } else if ($thispage->cd_stage=="u_con_users") { ?>
											<li class="<?php echo $u_con_u_subscribings; ?>"><a href="<?php echo "user.php?id=$thisuser[0]&"; ?>stage=u_con_users&substage=u_con_u_subscribings"><?php echo wrd('Subscribings'); ?></a></li>
											<li class="<?php echo $u_con_u_subscribers; ?>"><a href="<?php echo "user.php?id=$thisuser[0]&"; ?>stage=u_con_users&substage=u_con_u_subscribers"><?php echo wrd('Subscribers'); ?></a></li>
										<?php } else if ($thispage->cd_stage=="u_con_programs") { ?>
											<li class="<?php echo $u_con_p_all; ?>"><a href="<?php echo "user.php?id=$thisuser[0]&"; ?>stage=u_con_programs&substage=u_con_p_all"><?php echo wrd('All'); ?></a></li>
											<li class="<?php echo $u_con_p_own; ?>"><a href="<?php echo "user.php?id=$thisuser[0]&"; ?>stage=u_con_programs&substage=u_con_p_own"><?php echo wrd('Own_Programs'); ?></a></li>
											<li class="<?php echo $u_con_p_waitings; ?>"><a href="<?php echo "user.php?id=$thisuser[0]&"; ?>stage=u_con_programs&substage=u_con_p_waitings"><?php echo wrd('Own_Waitings'); ?></a></li>
										<?php }; ?>
									</ul>
								</div>
								
								
								<?php if ($thispage->cd_stage=='u_con_countdowns') { ############### COUNTDONWS?>
								<?php 
									$writecountdowns=new countdown;
									$writecountdowns->createcountdowns($thispage->cd_sqlcommand());	
								if ($writecountdowns->countrows==0) { ?>
								<div class="onecloumn">
									<div class="newcloumn">
										<div class="newcloumn-block">
											<div class="newcloumn-block-head">
												Bulunamadı
											</div>
											<div class="newcloumn-block-body">
												Aradığınız kriterlerde sonuç bulunamadı
											</div>
											<div class="newcloumn-block-foot">
												
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
							<?php };?>
					
					<?php } else if ($thispage->cd_stage=='u_con_programs') { ?>
					
					bbbv
					<?php } else { ?>
					asdasd
					<?php }; ?>
							
                 </div><!--tf-area-in-->
        </div><!-- tf-area-->
             
		<?php include('footer.php'); ?>
        </div><!-- tf-container-in -->
	</div><!-- tf-container-->
</body>
</html>
<?php ob_end_flush(); ?>