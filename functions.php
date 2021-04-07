<?php	

function bignumbers($x) {
	if($x<0) { $result=0; }
	else if ($x>=0 && $x<1000) { $result=$x; }
	else if ($x>=1000 && $x<1000000) { $result=floor($x/1000).'k'; }
	else if ($x>=1000000 && $x<1000000000) { $result=floor($x/1000000).'m'; }
	else { $result=floor($x/1000000000).'b'; };
	return $result;	
}
function strtoupper_tr($su)
{
 $tmp = str_replace(
 array("a","b","c","ç","d","e","f","g","ğ","h","ı",
"i","j","k","l","m","n","o","ö","p","r","s","ş","t",
"u","ü","v","y","z","q","w","x"),
 array("A","B","C","Ç","D","E","F","G","Ğ","H","I",
"İ","J","K","L","M","N","O","Ö","P","R","S","Ş","T",
"U","Ü","V","Y","Z","Q","W","X"),
 $su
 );
 return $tmp;
};

function strtolower_tr($sl)
{
 $tmp = str_replace(
 array("A","B","C","Ç","D","E","F","G","Ğ","H","I",
"İ","J","K","L","M","N","O","Ö","P","R","S","Ş","T",
"U","Ü","V","Y","Z","Q","W","X"),
 array("a","b","c","ç","d","e","f","g","ğ","h","ı",
"i","j","k","l","m","n","o","ö","p","r","s","ş","t",
"u","ü","v","y","z","q","w","x"),
 $sl
 );
 return $tmp;
}
 
function ucfirst_tr($suf)
{
	if (substr($suf,0,1)=="ö") {
	return strtoupper_tr(substr($suf,0,2)) . strtolower_tr(substr($suf,2));
	} else {
 	return strtoupper_tr(substr($suf,0,1)) . strtolower_tr(substr($suf,1));
	};
};

function mside($z) {
	if ($z<0) { $y=(-1); }
	else if ($z>0) { $y=(+1); }
	else { $y=0; };
	return $y;
}
function mdays($month,$year) {
			switch ($month) {
				  case "01" ; $mdays=31; break;
				  case "02" ; if ($year%4==0) {$mdays=29;} else {$mdays=28;}; break;
				  case "03" ; $mdays=31; break;
				  case "04" ; $mdays=30; break;
				  case "05" ; $mdays=31; break;
				  case "06" ; $mdays=30; break;
				  case "07" ; $mdays=31; break;
				  case "08" ; $mdays=31; break;
				  case "09" ; $mdays=30; break;
				  case "10" ; $mdays=31; break;
				  case "11" ; $mdays=30; break;
				  case "12" ; $mdays=31; break;
				  default; $mdays=31;
			  };
			  return $mdays;
};

function dateexp($x,$c) {
		if ($c>6 || $c<0) $c=7;
		$y=explode(' ',$x);
		$time=explode(':',$y[1]);
		$date=explode('-',$y[0]);
		$year=$date[0];
		$month=$date[1];
		$day=$date[2];
		$full="$year.$month.$day / $y[1]";
		$datearray=array($full,$year,$month,$day,$time[0],$time[1],$time[2]);
		$end=$datearray[$c];
		return $end;
};

function urltodt($x) {
	$forbid=array('t','i','m','e',"f",'l','a','x','c','d');
	$repl=array('0','1','2','3','4','5','6','7','8','9');
	$x=str_replace($forbid,$repl,$x);
	$year=substr($x,0,4);
	$month=substr($x,4,2);
	$day=substr($x,6,2);
	$hour=substr($x,8,2);
	$minute=substr($x,10,2);
	$second=substr($x,12,2);
	$full="$year-$month-$day $hour:$minute:$second";
	return $full;
}
function dttourl($x) {
	$y=explode(' ',$x);
	$time=explode(':',$y[1]);
	$date=explode('-',$y[0]);
	$year=$date[0];
	$month=$date[1];
	$day=$date[2];
	$hour=$time[0];
	$minute=$time[1];
	$second=$time[2];
	$full=$year.$month.$day.$hour.$minute.$second;
	$forbid=array('0','1','2','3','4','5','6','7','8','9','-');
	$repl=array('t','i','m','e',"f",'l','a','x','c','d');
	$full=str_replace($forbid,$repl,$full);
	return $full;
}

function dtexpired($dt1,$dt2) {
	  $y1=dateexp($dt1,1);
	  $m1=dateexp($dt1,2);
	  $d1=dateexp($dt1,3);
	  $h1=dateexp($dt1,4);
	  $i1=dateexp($dt1,5);
	  $s1=dateexp($dt1,6);
	  
	  
	  $y2=dateexp($dt2,1);
	  $m2=dateexp($dt2,2);
	  $d2=dateexp($dt2,3);
	  $h2=dateexp($dt2,4);
	  $i2=dateexp($dt2,5);
	  $s2=dateexp($dt2,6);
	  if( (  (mside($y1-$y2)*32)+(mside($m1-$m2)*16)+(mside($d1-$d2)*8)+(mside($h1-$h2)*4)+(mside($i1-$i2)*2)+(mside($s1-$s2))  )>=0) {
		return "0";
	  } else {
		return "1";
	  };	
}

function dtdiff($dt2,$dt1) {
	  $y2=dateexp($dt2,1);
	  $m2=dateexp($dt2,2);
	  $d2=dateexp($dt2,3);
	  $h2=dateexp($dt2,4);
	  $i2=dateexp($dt2,5);
	  $s2=dateexp($dt2,6);
	  
	  $y1=dateexp($dt1,1);
	  $m1=dateexp($dt1,2);
	  $d1=dateexp($dt1,3);
	  $h1=dateexp($dt1,4);
	  $i1=dateexp($dt1,5);
	  $s1=dateexp($dt1,6);
		  $mdays= mdays($m1,$y1);
		  if ($s1>$s2) { $s2=$s2+60; $i2=$i2-1; };
		  $sr=$s2-$s1; 
		  if ($i1>$i2) { $i2=$i2+60; $h2=$h2-1; };
		  $ir=$i2-$i1; 
		  if ($h1>$h2) { $h2=$h2+24; $d2=$d2-1; };
		  $hr=$h2-$h1;	
		  if ($d1>$d2) { $d2=$d2+$mdays; $m2=$m2-1; };
		  $dr=$d2-$d1;
		  if ($m1>$m2) { $m2=$m2+12; $y2=$y2-1; }
		  $mr=$m2-$m1;				
		  $yr=$y2-$y1;
		  $sr = substr("0$sr", -2);
		  $ir = substr("0$ir", -2);
		  $hr = substr("0$hr", -2);
		  $dr = substr("0$dr", -2);
		  $mr = substr("0$mr", -2);
		  $yr = substr("0$yr", -2);
		  return "$yr-$mr-$dr $hr:$ir:$sr";
};

function dtminus($dt2,$dt1) { ## UNUSED
	$y2=dateexp($dt2,1);
	  $m2=dateexp($dt2,2);
	  $d2=dateexp($dt2,3);
	  $h2=dateexp($dt2,4);
	  $i2=dateexp($dt2,5);
	  $s2=dateexp($dt2,6);
	  
	  $y1=dateexp($dt1,1);
	  $m1=dateexp($dt1,2);
	  $d1=dateexp($dt1,3);
	  $h1=dateexp($dt1,4);
	  $i1=dateexp($dt1,5);
	  $s1=dateexp($dt1,6);
	 	$mdays= mdays($m2,$y2);
		  ## 2013 01 01 00:00:00 - 0000 00 00 00:00:01
		  if ($s1>$s2) { $s2=$s2+60; $i2=$i2-1; };
		  $sr=$s2-$s1; 
		  ## 2013 01 01 00:(-1):59
		  if ($i1>$i2) { $i2=$i2+60; $h2=$h2-1; };
		  $ir=$i2-$i1; 
		  ## 2013 01 01 (-1):59:59
		  if ($h1>$h2) { $h2=$h2+24; $d2=$d2-1; };
		  $hr=$h2-$h1;	
		  ## 2013 01 00 23:59:59
		  if ($d1>=$d2) { 
		  	if ($m1>=($m2-1)) {
				$y2=$y2-1;					
				$yr=$y2-$y1;
				$m2=$m2+11; 
			}
			$mr=$m2-$m1;
			$mdays = mdays($mr,$yr);
			$d2=$d2+$mdays;
		  } else {
			 if ($m1>=$m2) {
				$y2=$y2-1;					
				$yr=$y2-$y1;
				$m2=$m2+12;
			 }
			 $mr=$m2-$m1;
		  }
		  $dr=$d2-$d1;	
		  
		  $sr = substr("0$sr", -2);
		  $ir = substr("0$ir", -2);
		  $hr = substr("0$hr", -2);
		  $dr = substr("0$dr", -2);
		  $mr = substr("0$mr", -2);
		  $yr = substr("0000$yr", -4);
		  return "$yr-$mr-$dr $hr:$ir:$sr";
};

function dtplus($dt2,$dt1) {
	  $y2=dateexp($dt2,1);
	  $m2=dateexp($dt2,2);
	  $d2=dateexp($dt2,3);
	  $h2=dateexp($dt2,4);
	  $i2=dateexp($dt2,5);
	  $s2=dateexp($dt2,6);
	  
	  $y1=dateexp($dt1,1);
	  $m1=dateexp($dt1,2);
	  $d1=dateexp($dt1,3);
	  $h1=dateexp($dt1,4);
	  $i1=dateexp($dt1,5);
	  $s1=dateexp($dt1,6);
	  				
	 $mdays=mdays($m1,$y1);
	  
	  $sr=$s1+$s2;
	  $irp=0; $hrp=0; $drp=0;
	  if($sr>=60) { $sr=$sr-60; $irp=1; };
	  $ir=$i1+$i2+$irp;
	  if($ir>=60) { $ir=$ir-60; $hrp=1; };
	  $hr=$h1+$h2+$hrp;	
	  if($hr>=24) { $hr=$hr-24; $drp=1; };
	  $dr=$d1+$d2+$drp;
	  $mr=$m1+$m2;
	  $yrp=0;
	  if ($mr>=12) { $mr=$mr-12; $yrp=1; };
	  if ($dr>=$mdays) { $dr=$dr-$mdays; $mrp=1; };
	  if ($dr>=$mdays) { $dr=$dr-$mdays; $mrp=1; };
	  if ($mr>=12) { $mr=$mr-12; $yrp=1; };
	  $yr=$y1+$y2+$yrp;
	  	  
	  $sr = substr("0$sr", -2);
	  $ir = substr("0$ir", -2);
	  $hr = substr("0$hr", -2);
	  $dr = substr("0$dr", -2);
	  $mr = substr("0$mr", -2);
	  
	  return "$yr-$mr-$dr $hr:$ir:$sr";
};

function gmttodt($dt){
	global $gmtdir;
	global $gmth;
	global $gmti;
	$dtp="0000-00-00 $gmth:$gmti:00";
	if ($gmtdir=='+') {
		return dtplus($dt,$dtp);
	} else if ($gmtdir=='-'){
		return dtdiff($dt,$dtp);
	}
}

function dttogmt($dt){
	global $gmtdir;
	global $gmth;
	global $gmti;
	$dtp="0000-00-00 $gmth:$gmti:00";
	if ($gmtdir=='-') {
		return dtplus($dt,$dtp);
	} else if ($gmtdir=='+') {
		return dtdiff($dt,$dtp);
	};
};

function dtremaining($datetime) {
	$full=explode(' ',$datetime);
	$date=explode('-',$full[0]);
	$time=explode(':',$full[1]);
	if ($date[0]>0) { 
		$num=$date[0]; if ($date[0]>1) { $text='years'; } else { $text='year'; };
	} else if ($date[1]>0) {
		$num=$date[1]; if ($date[1]>1) { $text='months'; } else { $text='month'; };
	} else if ($date[2]>0) {
		$num=$date[2]; if ($date[2]>1) { $text='days'; } else { $text='day'; };
	} else if ($time[0]>0) {
		$num=$time[0]; if ($time[0]>1) { $text='hours'; } else { $text='hour'; };
	} else if ($time[1]>0) {
		$num=$time[1]; if ($time[1]>1) { $text='minutes'; } else { $text='minute'; };
	} else if ($time[2]>0) {
		$num=$time[2]; if ($time[2]>1) { $text='seconds'; } else { $text='second'; };
	};
	$end['number']=$num*1;
	$end['text']=$text;
	return $end;
}

	
	
$readxml=simplexml_load_file('files/xml/language.xml');
foreach ($readxml->word as $word) {
	$langname=$word['name'];
	$langen=$word->lang[0];
	$langtr=$word->lang[1];
	$words["$langname"] = array($langen,$langtr);
};

function cd_sql_like_where($searchparams){
		$searchparam=explode(" ",$searchparams);
		$searchwhere=" and ( ";
		foreach ($searchparam as $name => $value) {
			$searchwhere.="(cd_title like '%".$value."%') || ";
		}
		$searchwhere.="(cd_title like !'') ) ";
		return $searchwhere;
		};
		
function cd_sql_like_orderby($searchparams){
		$searchparam=explode(" ",$searchparams);
		$searchorderby=" ( ";
		foreach ($searchparam as $name => $value) {
			$searchorderby.=" (case when cd_title like '%".$value."%' then 1 else 0 end) +";
		}
		$searchorderby.="0 ) desc ";
		return $searchorderby;
};


function prg_sql_like_where($searchparams){
		$searchparam=explode(" ",$searchparams);
		$searchwhere=" and ( ";
		foreach ($searchparam as $name => $value) {
			$searchwhere.="(program_name like '%".$value."%') || ";
		}
		$searchwhere.="(program_name like !'') ) ";
		return $searchwhere;
		};
		
function prg_sql_like_orderby($searchparams){
		$searchparam=explode(" ",$searchparams);
		$searchorderby=" ( ";
		foreach ($searchparam as $name => $value) {
			$searchorderby.=" (case when program_name like '%".$value."%' then 1 else 0 end) +";
		}
		$searchorderby.="0 ) desc ";
		return $searchorderby;
};

	
function users_sql_like_where($searchparams){
		$searchparam=explode(" ",$searchparams);
		$searchwhere=" and ( ";
		foreach ($searchparam as $name => $value) {
			$searchwhere.="(user_aname like '%".$value."%') || ";
		}
		$searchwhere.="(user_aname like !'') ) ";
		return $searchwhere;
		};
		
function users_sql_like_orderby($searchparams){
		$searchparam=explode(" ",$searchparams);
		$searchorderby=" ( ";
		foreach ($searchparam as $name => $value) {
			$searchorderby.=" (case when user_aname like '%".$value."%' then 1 else 0 end) +";
		}
		$searchorderby.="0 ) desc ";
		return $searchorderby;
};
function wrd($x) {
	global $lang;
	global $words;
	if (isset($words[$x][$lang])) { $end=$words[$x][$lang]; } else { $end=$x."*"; };
	return $end;
}


function usercdscount($x) {
	$calcrel=mysql_fetch_assoc(mysql_query("
	SELECT *,count(cd_id) as tcd FROM cds WHERE cd_userid=$x
	"));	
	if ($calcrel['tcd']=="") $end=0; else $end=$calcrel['tcd'];
	return $end;		
}

function userprgcount($x) {
	$calcrel=mysql_fetch_assoc(mysql_query("
	SELECT *,count(program_id) as tprg FROM programs WHERE program_userid=$x and program_state>0"));	
	if ($calcrel['tprg']=="") $end=0; else $end=$calcrel['tprg'];
	return $end;		
}

function usertotalwait($x) {
	$calcrel=mysql_fetch_assoc(mysql_query("
	SELECT sum(totalwait) as tw FROM
	(SELECT * FROM cds 
	LEFT JOIN (SELECT count(DISTINCT waiting_user) as totalwait,waiting_cd FROM waitings GROUP BY waiting_cd ) as new
	ON cds.cd_id = new.waiting_cd
	WHERE cd_userid=$x) as finalform
	"));	
	if ($calcrel['tw']=="") $end=0; else $end=$calcrel['tw'];
	return $end;		
}

function userwatchers($x) {
	$calcrel=mysql_fetch_assoc(mysql_query("SELECT count(DISTINCT watch_er) as watchers,watch_ed FROM watches WHERE watch_ed='$x'"));	
	if ($calcrel['watchers']=="") $end=0; else $end=$calcrel['watchers'];
	return $end;		
}

function userpopularity($x) {
	##if (usertotalwait($x)!=0 && usercdscount($x)!=0) {
	##$endofcalculation = usertotalwait($x)/usercdscount($x);	
	##} else { $endofcalculation=0; };
	##return (integer)$endofcalculation;
	$end=usercdscount($x)+10*usertotalwait($x)+100*userwatchers($x);
	return $end;
}

function countrytd($x) {
	$y=mysql_fetch_assoc(mysql_query("SELECT * FROM countries WHERE country_td='$x'"));
	$z=$y['country_name'];	
	return $z;
}

function catname($x) {
	$y=mysql_fetch_assoc(mysql_query("SELECT * FROM categories WHERE category_id='$x'"));
	$z=$y['category_name'];	
	return $z;
}

function username($x) {
	$y=mysql_fetch_assoc(mysql_query("SELECT user_id,user_aname FROM users WHERE user_id='$x'"));
	$z=$y['user_aname'];	
	return $z;
}


function cdtitle($x) {
	$y=mysql_fetch_assoc(mysql_query("SELECT cd_id,cd_title FROM cds WHERE cd_id='$x'"));
	$z=$y['cd_title'];	
	return $z;
}

function sqlpagecalc($x,$y){
	$z=($x-1)*$y;
	return $z.",".$y;	
}

$lastpoint=dtminus($dtstamp,'0000-00-07 00:00:00');


function trendusers() {
	global $lastpoint;
	$getusers=mysql_query("
		SELECT user_id,user_aname,watchings,logcount,user_rel FROM users
		LEFT JOIN (
			SELECT watch_register,watch_ed,count(DISTINCT watch_er) as watchings FROM watches
			GROUP BY watch_ed ) as watched 
			ON watched.watch_ed=users.user_id
		
		LEFT JOIN (
			SELECT *,sum(DISTINCT log_cause) as logcount FROM logs 
			WHERE log_register>'$lastpoint' and log_style='user' GROUP BY log_object  ) as logged  
			ON logged.log_object=users.user_id
		ORDER BY user_rel desc , IFNULL(logcount,0) desc, IFNULL(watchings,0) desc LIMIT 0,5		
		");
		
		while ($readusers=mysql_fetch_assoc($getusers)) { 
			$userid=$readusers['user_id']; 
			$username=$readusers['user_aname']; 
			$watchings=$readusers['watchings'];
			$logcount=$readusers['logcount'];
			$userrel=$readusers['user_rel'];
			if ($watchings=="") { $watchings=0; }; ## TOPLAM TAKIPÇİLER
			if ($logcount=="") { $logcount=0; }; ## SON BİR HAFTA KAYITLARI
			
			echo '<li><a href="user.php?id='.$userid.'&stage=u_st_profile">'.$username;
			if ($userrel==1) { echo '<img class="radic" src="files/images/icon-RadicB.png">';} ;
			echo '</a></li>';
		}; 
};

function recommendedusers() {
	global $lastpoint;		
	global $currentuser;		
	$getusers=mysql_query("SELECT recid,recname,recrel,user_rel,count(recid) as pop FROM users 
	JOIN (SELECT * FROM watches WHERE watch_er='$currentuser[0]') as watchings  On users.user_id = watchings.watch_er
	JOIN (SELECT * FROM watches ) as chain  On chain.watch_er = watchings.watch_ed
	LEFT JOIN (SELECT user_aname as recname,user_id as recid,user_rel as recrel FROM users) as recuser ON recid=chain.watch_ed
	WHERE chain.watch_ed<>'$currentuser[0]' GROUP BY recid ORDER BY pop desc 
	");
	while ($readusers=mysql_fetch_assoc($getusers)) { 
		$userid=$readusers['recid']; 
		$username=$readusers['recname']; 
		$userpop=$readusers['pop'];
		$userrel=$readusers['recrel']; 
		
		echo '<li><a href="user.php?id='.$userid.'&stage=u_st_profile">'.$username;			
		if ($userrel==1) { echo '<img class="radic" src="files/images/icon-RadicB.png">'; };
		echo '</a></li>';
	};
}
?>
			
			 