
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php include('connection.php'); include('functions.php'); include('classes.php'); include('jsprocess.php'); ?>
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
                        	<li class="rightside"> </li>
               				
                        	<li class="leftside"> </li>
                        </ul>
               </div><!--tf-header-main-in-menu-->
		</div><!--tf-header-main-in-->
    </div><!--tf-header-main-->
</div><!--tf-header-->

<div id="tf-container" style="color:#FFFFFF; text-align:center; width:1100px; margin:0 auto;">
	<div style="margin:0 auto; margin-top:150px; width:500px;">
		<div style="margin-bottom:20px;">
		<a href="index.php"><img src="files/images/blogo.png" width="300"  /></a>
		<?php 
		$t=1;
		$words="Ne zaman ba??lad?????? unutulmu?? bir sava????n h??l?? devam etti??i uzak bir d??nyada, Kayle b??y??k bir kahramand??. K??t??l??????, bulundu??u her yerde yok etmeye adanm???? ??l??ms??z bir ??rk??n en g????l??s??yd??. Kayle 10 bin y??l boyunca, zaman??n kendisinden bile eskilerde d??v??lm???? alevden k??l??c??yla, halk?? i??in yorulmak bilmeden sava??t??. Narin g??r??nt??s??n??, soyu t??kenmi?? bir zanaatk??r ??rk??ndan geri kalan son ??aheser olan sihirli z??rh??yla ??rtt??. Kayle g??zel, ??arp??c?? bir yarat??k olsa da, o zaman oldu??u gibi ??imdi de y??z??n?? g??stermekten ka????n??yor. Sava??, ruhunda iyile??mez yaralar a??m????. Zafer aray??????nda, bazen k??t??l??k bal????????na saplananlar?? ????karmaya ??al????sa da, genellikle d??nyay??, pi??manl??k nedir bilmeyecek halde oldu??unu d??????nd??klerinden ar??nd??r??yor. Kayle'a g??re adalet, s??k s??k ??ok ??irkin bir ??ey olabiliyor.

On y??l ??nce, Kayle k??t??l????e kar???? sava????n?? neredeyse kazan??yordu... ta ki halk??n??n a??a???? g??rd?????? isyank??r karde??i Morgana, aniden yeni ve g????l?? m??ttefikler edinene kadar: Runeterra olarak adland??r??lan, o zamana kadar bilmedikleri bir d??nyan??n b??y??c??leri. Morgana; Kayle ile halk??n?? dize getirme ihtimali olan bir tak??m ??ok g????l??, yeni yetenekler kar????l??????nda, Runeterra'l?? baz?? sihirdarlar??n hizmetine girdi. D??nyas??n?? kurtarabilmek i??in, Kayle'??n da League of Legends'la (Efsaneler Ligi) anla??ma yapmaktan ba??ka ??aresi yoktu. Lig'in lideri Y??ksek Konsey ??yesi Reginald Ashram'a kendi teklifiyle gitti. Ashram, 1000 y??ll??k hizmeti kar????l??????nda, Lig'in Kayle'??n d??nyas??yla olan t??m etkile??imini durdurdu. Ashram'??n be?? y??l ??nce ortadan kaybolmas??yla, Kayle Valoran'da yeni ama??lar edindi: Ashram'??n kaybolmas??na kimin ya da neyin yol a??t??????n?? bulmak, karde??i Morgana'y?? Adalet Meydanlar??nda yenmek ve League of Legends'a kendi adalet anlay??????n?? getirmek.";
		$word=explode(' ',$words);
		$length=count($word);
		$x; $y;
		$get=mysql_query("SELECT * FROM programs");
		while ($read=mysql_fetch_assoc($get)) {
				$a=$read['program_id'];
				$y=rand(10, 25);
				$sentence="";
				for($i=0;$i<=$y;$i++){
					$x=rand(2, 100);
					$sentence.=$word[$x].' ';
				};
				mysql_query("UPDATE programs SET program_name='$sentence' WHERE program_id='$a'");
					echo $a.':'.$sentence.'<br>';
				};
		?>
		</div>
		<div>
			</div>
		<div class="indexmenu">
			<div>
				
			</div>
		</div>
		<div style="width:600px;">
			<div style="width:250px; float: left">
			
				</div>
				
			<div>
			
			</div>
		</div>
		
		<br />
		
			
			</div>		
		<br />
		<br />
		<br />
		<br />
	</div>
	
</div>

<div class="fixed-endinfo">
	<div class="fixed-endinfo-in" >
		
	</div>
</div>
</body>
</html>
<?php ob_end_flush(); ?>