
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php include('connection.php');    ?>
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
	<script type="text/javascript" src="files/js/jquery-1.9.0.js"></script>
	<script type="text/javascript" src="files/js/jquery-ui-1.10.2.custom.js"></script>
	<script type="text/javascript" src="files/js/plugins.js"></script>
	<script type="text/javascript" src="files/js/tf-functions.js"></script>
	<script type="text/javascript" src="files/js/main.js"></script>
</head>
<body>
<style type="text/css">
body {background:#CCC;}
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
<div id="clearsight"></div>
<div id="fromurl">
		<?php 
		if (1==0) {
			//Get the file
			$content = file_get_contents("http://ia.media-imdb.com/images/M/MV5BMTEwNTU2MjAwMDdeQTJeQWpwZ15BbWU3MDk2Njc2Njk@._V1_SY209_CR0,0,140,209_.jpg");
			//Store in the filesystem.
			$fp = fopen("asdasdasd.jpg", "w");
			fwrite($fp, $content);
			fclose($fp);
		}
		
		$veri = file_get_contents("http://www.imdb.com/movies-coming-soon/2014-03/");
		$x=explode('<div class="list detail">',$veri);
		$y=explode('<div class="see-more">',$x[1]);
		
		$z=explode('<h4 class="li_group">',$y[0]);
		foreach ($z as $name => $value) {
			if ($name!=0){
				$q=explode('">',$value);
				$entrydate=explode('&nbsp;',$q[1]);
				echo '<div class="tf_imdb" tf_date="'.$entrydate[0].'">'.$value.'</div>';
			}
		}	
				#mysql_query("UPDATE programs SET program_name='$sentence' WHERE program_id='$a'");
		?>
</div>
<script>
var daterr,imdb_all,imdb_date,imdb_name,imdb_link,imdb_pict;
	$('.tf_imdb').each(function(){
		daterr=$(this).attr('tf_date');
		$(' > .list_item',this).each(function(){
			$(this).attr('tf_datein',daterr);
		})
	})
	$('.list_item').each(function(){
		imdb_date='<div id="imdb_date">'+$(this).attr('tf_datein')+'</div>';
		imdb_name='<div id="imdb_name">'+$(' h4 > a ',this).html()+'</div>';
		imdb_desc='<div id="imdb_desc">'+$(' .outline ',this).html()+'</div>';
		imdb_link='<div id="imdb_link">http://www.imdb.com'+$(' h4 > a ',this).attr('href')+'</div>';
		imdb_pict='<div id="imdb_pict">'+$(' img.poster ',this).attr('src')+'</div>';
		imdb_all=imdb_date+imdb_name+imdb_desc+imdb_link+imdb_pict;
		$('#clearsight').append('<div class="tf_imdb_item">'+imdb_all+'</div><br><br>');
	});
	$('#fromurl').remove();
</script>
</body>
</html>
<?php ob_end_flush(); ?>