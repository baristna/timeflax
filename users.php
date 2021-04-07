<?php ob_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php include('connection.php'); include('functions.php'); include('classes.php'); include('jsprocess.php'); 
$thispage=new page;
$thispage->pagename="users.php";
$thispage->users_page="1";
$thispage->users_pagesize="10";
$thispage->users_maxpagenum="50";
$thispage->users_order="popular";
$thispage->pagecreate();
#$_SESSION['prevurl']=$thispage->fullurl();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<link rel="image_src" href="link.gif"/>
	<title>TimeFlax</title>
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
	<link id="maincss" rel="stylesheet" href="userbox.css" type="text/css" />
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
			<ul class="leftblock">
				<li class="<?php echo $thispage->btn_popular; ?>"><a href="<?php echo $thispage->createurl('order'); ?>order=popular"><?php echo wrd('ord_popular'); ?></a></li>
            	<li class="<?php echo $thispage->btn_trend; ?>"><a href="<?php echo $thispage->createurl('order'); ?>order=trend"><?php echo wrd('ord_trend'); ?></a></li>
            	<?php if($login=="true") { ?>
				<li class="<?php echo $thispage->btn_recommend; ?>"><a href="<?php echo $thispage->createurl('order'); ?>order=recommend"><?php echo wrd('ord_recommend'); ?></a></li>
            	<?php }; ?>
			</ul>
			<hr />
            <ul class="leftblock">
            	<li><?php echo wrd('Location'); ?>
                	<ul>    
                        <li class="<?php if ($thispage->users_country=='all') { echo "selected"; }; ?>" ><a href="<?php echo $thispage->createurl('country')."country=all"; ?>"><?php echo wrd('All_Countries'); ?></a></li>
                        <li>
                        	<select currurl="<?php echo $thispage->createurl('country'); ?>"  id="countryselect" style="width:145px;" name="countrytd">
								<option><?php echo wrd('Choose_Country'); ?></option>
                                <?php 
                                $getcountry=mysql_query("SELECT * FROM countries");
                                while ($readcountry=mysql_fetch_assoc($getcountry)) { 
                                $cntname=$readcountry['country_name']; 
                                $cnttd=$readcountry['country_td'];
                                ?>
                                <option value="<?php echo $cnttd; ?>" <?php if ($cnttd==$thispage->users_country) { echo  'selected="selected"'; $thispage->info_country=$cntname; }; ?>><?php echo ucfirst_tr($cntname); ?></option>
                                <?php }; ?>
                            </select>
                        </li>
						<li class="<?php if ($thispage->cd_country=='') { echo "selected"; }; ?>" ><a href="<?php echo $thispage->createurl('country')."country=WWO"; ?>"><?php echo wrd('World_Wide'); ?></a></li>

                    </ul>
                 </li>
            </ul>
			<hr />
        	<ul class="leftblock">
            	<li class="<?php echo $thispage->btn_trend; ?>"><a href="<?php echo $thispage->createurl('order'); ?>order=trend"><?php echo wrd('ord_trend'); ?></a>
                	<ul><?php trendusers(); ?></ul>
                </li>
            </ul>
			<?php if($login=="true") { ?>
			<hr />
        	<ul class="leftblock">
					<li class="<?php echo $thispage->btn_recommend; ?>"><a href="<?php echo $thispage->createurl('order'); ?>order=recommend"><?php echo wrd('ord_recommend'); ?></a>
						<ul><?php recommendedusers(); ?></ul>
					</li>
				</ul>
            </ul>
            <?php }; ?>
         	<br /><br /><br />
        </p>
		</div><!-- tf-leftmenu-in-->
		</div><!-- tf-leftmenu-->
		
           
        <div id="tf-area">
        	<div id="tf-area-in">
			<div id="tf-ads-top" style=" padding:0px 12px 0px 12px; text-align:center;">
				<div id="tf-ads-top-in">
				
				</div>
			</div>
            	<div class="tfh1top">
				<ul class="text">
					<?php echo "<b>".wrd('Programs')."</b> > "; ?>
					<?php if ($thispage->info_select!="") {  echo "<b>".wrd($thispage->info_select)."</b> , ";  }; ?>
					<?php echo "<b>".wrd($thispage->info_order)."</b>"; ?>
					<?php if ($thispage->info_category!="" ) { echo " , <b>".wrd('Category')."</b> ".wrd($thispage->info_category); }; ?>
                	 </ul>
				</div>
				

				<?php 
					$writeusers=new users;
					$writeusers->createusers($thispage->users_sqlcommand());	
				if ($writeusers->countrows==0) { ?>
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
                	<?php if ($writeusers->countrows!=0) { ?>
						 <div class="tfh1bottom" style="height:30px; padding-top:10px; text-align:center;">
							<?php $thispage->usersbuttons(); ?> 
						 </div>
                     <?php }; ?>
					 
                 </div><!--tf-area-in-->
        </div><!-- tf-area-->
        
        
  		<?php include('footer.php'); ?>
        </div><!-- tf-container-in -->
	</div><!-- tf-container-->
</body>
</html>
<?php ob_end_flush(); ?>