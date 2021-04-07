<?php ob_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php include('connection.php'); include('functions.php'); include('classes.php'); include('jsprocess.php'); 
$thispage=new page;
$thispage->pagename="countdowns.php";
$thispage->cd_page="1";
$thispage->cd_pagesize="9";
$thispage->cd_maxpagenum="50";
$thispage->cd_order="trend";
$thispage->timeupperpoint=dtplus($dtstamp,"0000-00-00 01:00:00");
$thispage->mintime=$dtstamp;
$thispage->mingmttime=gmttodt($dtstamp);
$thispage->maxtime=dtplus($dtstamp,"0000-00-00 01:00:00");
$thispage->maxgmttime=gmttodt($thispage->maxtime);
$thispage->pagecreate();
$_SESSION['prevurl']=$thispage->fullurl();
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
        	<ul class="leftblock">
            	<li class="<?php echo $thispage->btn_trend; ?>"><a href="<?php echo $thispage->createurl('order'); ?>order=trend"><?php echo wrd('ord_trend'); ?></a></li>
            	<li class="<?php echo $thispage->btn_highlight; ?>"><a href="<?php echo $thispage->createurl('order'); ?>order=highlight"><?php echo wrd('ord_highlight'); ?></a></li>
                <li class="<?php echo $thispage->btn_expire; ?>"><a href="<?php echo $thispage->createurl('order'); ?>order=expire"><?php echo wrd('ord_expire'); ?></a></li>
                <li class="<?php echo $thispage->btn_new; ?>"><a href="<?php echo $thispage->createurl('order'); ?>order=new"><?php echo wrd('ord_new'); ?></a></li>
                <li class="<?php echo $thispage->btn_popular; ?>"><a href="<?php echo $thispage->createurl('order'); ?>order=popular"><?php echo wrd('ord_popular'); ?></a></li>
            </ul>
            <hr />
            <ul class="leftblock">
            	<li><?php echo wrd('Time_Zone'); ?>
                	<ul>    
                        <li class="<?php if ($thispage->cd_timestyle=='') { echo "selected"; }; ?>"><a href="<?php echo $thispage->createurl('timestyle'); ?>"><?php echo wrd('All'); ?></a></li>
                		<li class="<?php if ($thispage->cd_timestyle=='global') { echo "selected"; }; ?>"><a href="<?php echo $thispage->createurl('timestyle')."timestyle=global"; ?>"><?php echo wrd('Global'); ?></a></li>
                		<li class="<?php if ($thispage->cd_timestyle=='local') { echo "selected"; }; ?>"><a href="<?php echo $thispage->createurl('timestyle')."timestyle=local"; ?>"><?php echo wrd('Local'); ?></a></li>

                    </ul>
                 </li>
            </ul>
            <hr />
            <ul class="leftblock">
            	<li><?php echo wrd('Categories'); ?>
                	<ul>    
                        <li class="<?php if ($thispage->cd_category=='') { echo "selected"; }; ?>"><a href="<?php echo $thispage->createurl('category'); ?>"><?php echo wrd('All'); ?></a></li>
                         <li>
                        	<select currurl="<?php echo $thispage->createurl('category'); ?>"  id="categoryselect" style="width:145px;" name="categoryselect">
								<option><?php echo wrd('Choose_Category'); ?></option>
                                <?php 
                                $getdata=mysql_query("select * from categories");
								while($read=mysql_fetch_assoc($getdata)){
								$category_name=$read['category_name'];
								$category_id=$read['category_id'];
                                ?>
                                <option value="<?php echo $category_id; ?>" <?php if ($category_id==$thispage->cd_category) { echo  'selected="selected"'; }; ?>><?php echo wrd("cat_".$category_name); ?></option>
                                <?php }; ?>
                            </select>
                        </li>
                    </ul>
                 </li>
            </ul>
            <hr />
            <ul class="leftblock">
            	<li><?php echo wrd('Location'); ?>
                	<ul>    
                        <li class="<?php if ($thispage->cd_country=='all') { echo "selected"; }; ?>" ><a href="<?php echo $thispage->createurl('country')."country=all"; ?>"><?php echo wrd('All_Countries'); ?></a></li>
                        <li>
                        	<select currurl="<?php echo $thispage->createurl('country'); ?>"  id="countryselect" style="width:145px;" name="countrytd">
								<option><?php echo wrd('Choose_Country'); ?></option>
                                <?php 
                                $getcountry=mysql_query("SELECT * FROM countries");
                                while ($readcountry=mysql_fetch_assoc($getcountry)) { 
                                $cntname=$readcountry['country_name']; 
                                $cnttd=$readcountry['country_td'];
                                ?>
                                <option value="<?php echo $cnttd; ?>" <?php if ($cnttd==$thispage->cd_country) { echo  'selected="selected"'; $thispage->info_country=$cntname; }; ?>><?php echo ucfirst_tr($cntname); ?></option>
                                <?php }; ?>
                            </select>
                        </li>
						<li class="<?php if ($thispage->cd_country=='') { echo "selected"; }; ?>" ><a href="<?php echo $thispage->createurl('country')."country=WWO"; ?>"><?php echo wrd('World_Wide'); ?></a></li>

                    </ul>
                 </li>
            </ul>
			<hr />
            <ul class="leftblock">
            	<li><?php echo wrd('Time_Interval'); ?>
                	<ul id="timeinterval">  
                        <li class="<?php if ($thispage->cd_timeinterval==""){ echo "selected"; }; ?>"><a href="<?php echo $thispage->createurl('timeinterval'); ?>"><?php echo wrd('All'); ?></a></li>
                    	<li><?php echo wrd('Start'); ?></li>
                        <li><input type="text" class="timepicker" id="mintime" value="<?php echo $dtstamp; ?>" /></li>
                    	<li><?php echo wrd('End'); ?></li>
                        <li><input type="text" class="timepicker" id="maxtime" value="<?php echo $thispage->maxtime; ?>" /></li>
                        <li><input type="hidden" id="timeintervalurl" value="<?php echo $thispage->createurl('timeinterval') ?>" /></li><br />
                        <li><a href="#x" id="applytimeinterval"><?php echo wrd('Apply'); ?></a></li>
                   	</ul>
                </li>
            </ul>   
         	<br /><br /><br />
        </p>
		</div><!-- tf-leftmenu-in-->
		</div><!-- tf-leftmenu-->
		
		<?php include('programlist.php'); ?>
           
        <div id="tf-area">
        	<div id="tf-area-in">
			<div id="tf-ads-top" style=" padding:0px 12px 0px 12px; text-align:center;">
				<div id="tf-ads-top-in">
				</div>
			</div>
            	<div class="tfh1top">
				<ul class="text">
                	<?php echo "<b>".wrd('Countdowns')."</b> > "; ?>
					<?php if ($thispage->info_select!="") {  echo "<b>".wrd($thispage->info_select)."</b> , ";  }; ?>
					<?php echo "<b>".wrd($thispage->info_order)."</b>"; ?>
                	<?php if ($thispage->info_timestyle!="") {  echo " , <b>".wrd('Time_Zone')."</b> ".wrd($thispage->info_timestyle);  }; ?>
					<?php if ($thispage->info_category!="" ) { echo " , <b>".wrd('Category')."</b> ".wrd($thispage->info_category); }; ?>
                	<?php if ($thispage->info_country!="") {  echo " , <b>".wrd('Country')."</b> <span class='tfh1top-withicon'><img src='files/flags/".$thispage->cd_country.".png'/> ".$thispage->info_country.'</span>';  }; ?>
                	<?php if (isset($_GET['timeinterval'])) {  echo "<br/><b>".wrd('Time_Interval').": Başlangıç </b>".$thispage->mintime." <b>Bitiş</b> ".$thispage->maxtime;  }; ?>
                </ul>
				</div>
                <div class="tf_cd-external"  tf-id="1"></div>
				<?php 
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
					
                 </div><!--tf-area-in-->
        </div><!-- tf-area-->
        
        
  		<?php include('footer.php'); ?>
        </div><!-- tf-container-in -->
	</div><!-- tf-container-->
</body>
</html>
<?php ob_end_flush(); ?>