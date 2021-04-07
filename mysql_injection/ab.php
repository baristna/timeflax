
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

<div id="tf-header" style=""><!-- UST BÖLÜM -->
    <div id="tf-header-main"> <!-- GRİ KUŞAK -->
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
		$words="Ne zaman başladığı unutulmuş bir savaşın hâlâ devam ettiği uzak bir dünyada, Kayle büyük bir kahramandı. Kötülüğü, bulunduğu her yerde yok etmeye adanmış ölümsüz bir ırkın en güçlüsüydü. Kayle 10 bin yıl boyunca, zamanın kendisinden bile eskilerde dövülmüş alevden kılıcıyla, halkı için yorulmak bilmeden savaştı. Narin görüntüsünü, soyu tükenmiş bir zanaatkâr ırkından geri kalan son şaheser olan sihirli zırhıyla örttü. Kayle güzel, çarpıcı bir yaratık olsa da, o zaman olduğu gibi şimdi de yüzünü göstermekten kaçınıyor. Savaş, ruhunda iyileşmez yaralar açmış. Zafer arayışında, bazen kötülük balçığına saplananları çıkarmaya çalışsa da, genellikle dünyayı, pişmanlık nedir bilmeyecek halde olduğunu düşündüklerinden arındırıyor. Kayle'a göre adalet, sık sık çok çirkin bir şey olabiliyor.

On yıl önce, Kayle kötülüğe karşı savaşını neredeyse kazanıyordu... ta ki halkının aşağı gördüğü isyankâr kardeşi Morgana, aniden yeni ve güçlü müttefikler edinene kadar: Runeterra olarak adlandırılan, o zamana kadar bilmedikleri bir dünyanın büyücüleri. Morgana; Kayle ile halkını dize getirme ihtimali olan bir takım çok güçlü, yeni yetenekler karşılığında, Runeterra'lı bazı sihirdarların hizmetine girdi. Dünyasını kurtarabilmek için, Kayle'ın da League of Legends'la (Efsaneler Ligi) anlaşma yapmaktan başka çaresi yoktu. Lig'in lideri Yüksek Konsey Üyesi Reginald Ashram'a kendi teklifiyle gitti. Ashram, 1000 yıllık hizmeti karşılığında, Lig'in Kayle'ın dünyasıyla olan tüm etkileşimini durdurdu. Ashram'ın beş yıl önce ortadan kaybolmasıyla, Kayle Valoran'da yeni amaçlar edindi: Ashram'ın kaybolmasına kimin ya da neyin yol açtığını bulmak, kardeşi Morgana'yı Adalet Meydanlarında yenmek ve League of Legends'a kendi adalet anlayışını getirmek.";
		$word=explode(' ',$words);
		$x; $y;
		
		
		for ($j=1;$j<=5;$j++){
			
			$y=rand(10, 25);
			$sentence="";
			for($i=0;$i<=$y;$i++){
				$x=rand(2, 100);
				$sentence.=$word[$x].' ';
			};
			
			$y=rand(10, 50);
			$sentence2="";
			for($i=0;$i<=$y;$i++){
				$x=rand(2, 100);
				$sentence2.=$word[$x].' ';
			};
			
			mysql_query("INSERT INTO programs (program_name,program_desc,program_country,program_userid,program_state) VALUES ('$sentence','$sentence2','TR','3','1')");
			echo $j.'-'.$sentence.'<br>'.$sentence2.'<br><br>';
		}
		
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