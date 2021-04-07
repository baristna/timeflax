<?php  
class user
{
	public $user_id;
	public $user_name;
	public $user_aname;
	public $user_mail;
	public $user_password;
	public $user_passwordre;
	public $user_passwordold;
	public $user_register;
	public $user_country;
	public $user_countrytd;
	public $user_language;
	public $user_avatar;
	public $user_activate_time;
	public $user_rel;
	public $user_auth;
	public $user_show_mail;
	public $user_question;
	public $user_answer;
	public $user_answerre;
	public $user_notifications;	
	public $user_draftprogram;	
	public $userarray;
	public function __construct(){
		$this->user_countrytd=countrytd($this->user_country);
	}
	public function createarray(){
		$this->userarray=array(				
				0 => $this->user_id,	
				1 => $this->user_name,
				2 => $this->user_aname,
				3 => $this->user_mail,
				4 => $this->user_password,
				5 => $this->user_country,
				6 => $this->user_countrytd,
				7 => $this->user_language,
				8 => $this->user_avatar,
				9 => $this->user_activate_time,
				10 => $this->user_rel,
				11 => $this->user_auth,
				12 => $this->user_show_mail,
				13 => $this->user_question,
				14 => $this->user_answer,
				15 => $this->user_notifications,
				16 => $this->user_register,
				17 => $this->user_passwordre,
				18 => $this->user_answerre,
				19 => $this->user_draftprogram,
				'id' => $this->user_id,
				'name' => $this->user_name,
				'aname' => $this->user_aname,
				'mail' => $this->user_mail,
				'password' => $this->user_password,
				'passwordre' => $this->user_passwordre,
				'country' => $this->user_country,
				'countrytd' => $this->user_countrytd,
				'language' => $this->user_language,
				'avatar' => $this->user_avatar,
				'activate_time' => $this->user_activate_time,
				'rel' => $this->user_rel,
				'auth' => $this->user_auth,
				'show_mail' => $this->user_show_mail,
				'question' => $this->user_question,
				'answer' => $this->user_answer,
				'answerre' => $this->user_answerre,
				'notifications' => $this->user_notifications,
				'register' => $this->user_register,
				'program' => $this->user_draftprogram,
				
			);	
	}
	
	function getuser($id) {
		$finduser=mysql_fetch_assoc(mysql_query("SELECT * FROM users WHERE user_id='$id'"));
		$prg=mysql_fetch_assoc(mysql_query("SELECT * FROM programs WHERE program_userid='$this->user_id' && program_state='0'"));
		$this->user_draftprogram=$prg['program_id'];
		$this->user_id=$id;
		$this->user_aname=$finduser['user_aname'];
		$this->user_mail=$finduser['user_mail'];
		$this->user_register=$finduser['user_register'];
		$this->user_country=$finduser['user_country'];
		$this->user_countrytd=countrytd($this->user_country);
		$this->user_avatar=$finduser['user_avatar'];
		$this->user_activate_time=$finduser['user_activate_time'];
		$this->user_rel=$finduser['user_rel'];
		$this->user_auth=$finduser['user_auth'];
		$this->user_show_mail=$finduser['user_show_mail'];
		$this->createarray();
		return $this->userarray;
	}
}

class edituser extends user {
	function new_control_name() {
		$pattern = '/[^a-z,A-Z,0-9,_]/';
		preg_match($pattern, $this->user_name, $matches);
		if (empty($matches) && strlen($this->user_name)<=16 && strlen($this->user_name)>=6) { 
			$read=mysql_fetch_assoc(mysql_query("SELECT count(user_name) as user FROM users WHERE user_name='$this->user_name'"));
			if ($read['user']>=1) { return false; } else { return true; };
		} else { 
			return false; 
		};
	}
	
	function new_control_mail(){
		$pattern = '/^[a-z]{1}[\d\w\.-]+@[\d\w-]{3,}\.[\w]{2,3}(\.\w{2})?$/';
		preg_match($pattern, $this->user_mail, $matches);
		if (!empty($matches)) { 	
			$read=mysql_fetch_assoc(mysql_query("SELECT count(user_mail) as mail FROM users WHERE user_mail='$this->user_mail'"));
			if ($read['mail']>0) { return false;  } else { return true; };
		} else { 
			return false; 
		};
	}
	function new_control_password(){
		$pattern = '/[^a-z,A-Z,0-9,_]/';
		preg_match($pattern, $this->user_password, $matches);
		if (empty($matches) && strlen($this->user_password)<=16 && strlen($this->user_password)>=6 && $this->user_password==$this->user_passwordre  ) { 
			return true;
		} else { 
			return false; 
		};
	}
	function new_control_country(){
		if ($this->user_countrytd=="") {
			return false;	
		} else {
			return true;	
		}
	}
	function new_control_language(){
		if ($this->user_language=="") {
			return false;	
		} else {
			return true;	
		}
	}
	function new_control_question(){
		$pattern = '/[^a-z,A-Z,0-9,_, ,ş,Ş,ı,I,ö,Ö,ü,Ü,ğ,Ğ,ç,Ç]/';
		preg_match($pattern, $this->user_question, $matches);
		if (!empty($matches) || strlen($this->user_question)>48 && strlen($this->user_question)<6  ) { 
			return false;
		} else {
			return true;	
		}
	}
	function new_control_answer(){
		$pattern = '/[^a-z,A-Z,0-9,_]/';
		preg_match($pattern, $this->user_answer, $matches);
		if (empty($matches) && strlen($this->user_answer)<=16 && strlen($this->user_answer)>=6 && $this->user_answer==$this->user_answerre  ) { 
			return true;
		} else { 
			return false; 
		};	
	}
	function new_control_all(){
		if ($this->new_control_answer()){
			if($this->new_control_country()){
				if($this->new_control_mail()){
					if($this->new_control_name()){
						if($this->new_control_password()){
							if($this->new_control_question()){
								if($this->new_control_language()){
									return 'true';
								} else {
									return 'wlang';	
								}
							} else {
								return 'wquestion';	
							}
						} else {
							return 'wpass';	
						}
					} else {
						return 'wname';	
					}	
				} else {
					return 'wmail';	
				}
			} else {
				return 'wcountry';	
			}
		} else {
			return 'wanswer';	
		};
	}
	function newuser(){
		if ($this->new_control_all()=='true'){
			$md5password=md5($this->user_password);
			$md5answer=md5($this->user_answer);
			$userdone="INSERT INTO users 
			(user_name,user_aname,user_mail,user_password,user_country,user_language,user_question,user_answer) VALUES 
			('$this->user_name','$this->user_name','$this->user_mail','$md5password','$this->user_countrytd','$this->user_language','$this->user_question','$md5answer')";
			
			if (mysql_query($userdone)){
				return 'true';	
			} else {
				return 'error';	
			}	
		} else {
			return $this->new_control();	
		}
	}
	
	
	function change_control_name($id) {
		$pattern = '/[^a-z,A-Z,0-9,_]/';
		preg_match($pattern, $this->user_name, $matches);
		if (empty($matches) && strlen($this->user_name)<=16 && strlen($this->user_name)>=6) { 
			$read=mysql_fetch_assoc(mysql_query("SELECT count(user_name) as user FROM users WHERE user_name='$this->user_name' AND user_id!='$id'"));
			if ($read['user']>=1) {
				return false; 
			} else { 
				return true; 
			};
		} else { 
			return false; 
		};
	}
	function change_name($id) {
		if ($this->change_control_name($id)){
			$done="UPDATE users SET user_name = '$this->user_name' WHERE user_id='$id'";
			if (mysql_query($done)){
				return true; 
			} else {
				return false; 
			};
		} else {
			return false;
		}
	}
	function change_control_aname($id) {
		$pattern = '/[^a-z,A-Z,0-9,_, ,ş,Ş,ı,I,ö,Ö,ü,Ü,ğ,Ğ,ç,Ç]/';
		preg_match($pattern, $this->user_aname, $matches);
		if (empty($matches) && strlen($this->user_aname)<=16 && strlen($this->user_aname)>=6) { 
			$read=mysql_fetch_assoc(mysql_query("SELECT count(user_aname) as user FROM users WHERE user_aname='$this->user_aname' AND user_id!='$id'"));
			if ($read['user']>=1) {
				return false; 
			} else { 
				return true;
			};
		} else { 
			return false; 
		};
	}
	function change_aname($id) {
		if ($this->change_control_aname($id)){
			$done="UPDATE users SET user_aname = '$this->user_aname' WHERE user_id='$id'";
			if (mysql_query($done)){
				return true; 
			} else { 
				return false; 
			}
		} else {
			return false;
		}
	}
	function change_control_mail($id){
		$pattern = '/^[a-z]{1}[\d\w\.-]+@[\d\w-]{3,}\.[\w]{2,3}(\.\w{2})?$/';
		preg_match($pattern, $this->user_mail, $matches);
		if (!empty($matches)) { 	
			$read=mysql_fetch_assoc(mysql_query("SELECT count(user_mail) as mail FROM users WHERE user_mail='$this->user_mail' AND user_id!='$id'"));
			if ($read['mail']>0) { 
				return false; 
			} else { 
				return true; 
			};
		} else { 
			return false; 
		};
	}
	function change_mail($id){
		if ($this->change_control_mail($id)){	
			$done="UPDATE users SET user_mail = '$this->user_mail' WHERE user_id='$id'";
			if (mysql_query($done)){
				return true; 
			};
		} else { 
			return false; 
		};
	}
	function change_language($id){	
		$done="UPDATE users SET user_language = '$this->user_language' WHERE user_id='$id'";
		$_SESSION["lang"]=$this->user_language;
		if (mysql_query($done)){
			return true; 
		};
	}
	function change_country($id){	
		$done="UPDATE users SET user_country = '$this->user_country' WHERE user_id='$id'";
		if (mysql_query($done)){
			return true; 
		};
	}
		
	function change_control_password($id) {
		$pattern = '/[^a-z,A-Z,0-9,_]/';
		preg_match($pattern, $this->user_password, $matches);
		if (empty($matches) && strlen($this->user_password)<=16 && strlen($this->user_password)>=6 && $this->user_password==$this->user_passwordre) { 
			return true;
		} else { 
			return false; 
		};
	}
	function change_password($id) {
		if ($this->change_control_password($id)){
			$read=mysql_fetch_assoc(mysql_query("SELECT user_password,user_id FROM users WHERE user_id='$id'"));
			if ($read['user_password']==md5($this->user_passwordold)){
				$md5password=md5($this->user_password);
				$done="UPDATE users SET user_password = '$md5password' WHERE user_id='$id'";
				if (mysql_query($done)){
					return 'true'; 
				} else {
					return 'error'; 
				};
			} else { 
				return 'wpass'; 
			}
		} else {
			return 'wmatch';
		}
	}
		
	function change_control_answer($id) {
		$pattern = '/[^a-z,A-Z,0-9,_]/';
		preg_match($pattern, $this->user_answer, $matches);
		if (empty($matches) && strlen($this->user_answer)<=16 && strlen($this->user_answer)>=6 && $this->user_answer==$this->user_answer) { 
			return true;
		} else { 
			return false; 
		};
	}
	function change_answer($id) {
		if ($this->change_control_answer($id)){
			$read=mysql_fetch_assoc(mysql_query("SELECT user_answer,user_id FROM users WHERE user_id='$id'"));
			if ($read['user_answer']==md5($this->user_answer)){
				$md5answer=md5($this->user_answer);
				$done="UPDATE users SET user_answer = '$md5answer' WHERE user_id='$id'";
				if (mysql_query($done)){
					return 'true'; 
				} else {
					return 'error'; 
				};
			} else { 
				return 'wpass'; 
			}
		} else {
			return 'wmatch';
		}
	}
	function change_control_question($id) {
		$pattern = '/[^a-z,A-Z,0-9,_, ,ş,Ş,ı,I,ö,Ö,ü,Ü,ğ,Ğ,ç,Ç,?]/';
		preg_match($pattern, $this->user_question, $matches);
		if (empty($matches) && strlen($this->user_question)<=48 && strlen($this->user_question)>=6) { 
			return true;
		} else { 
			return false; 
		};
	}
	function change_question($id) {
		if ($this->change_control_question($id)){
			$read=mysql_fetch_assoc(mysql_query("SELECT user_password,user_id FROM users WHERE user_id='$id'"));
			if ($read['user_password']==md5($this->user_password)){
				$done="UPDATE users SET user_question = '$this->user_question' WHERE user_id='$id'";
				if (mysql_query($done)){
					return 'true'; 
				} else { 
					return 'false'; 
				}
			} else {
				return 'false';	
			}
		} else {
			return 'false';
		}
	}
	function verify_password($id){
		$read=mysql_fetch_assoc(mysql_query("SELECT user_password FROM users WHERE user_id='$id'"));
		if ($read['user_password']==md5($this->user_password)) {
			return true;
		} else {
			return false;	
		}
	}
}

################################################################################################################################3
################################################################################################################################3
################################################################################################################################3
################################################################################################################################3
################################################################################################################################3
################################################################################################################################3
################################################################################################################################3
################################################################################################################################3
## USER LOGIN/LOGOUT
class userlogin extends user {
	function verifylogininfos(){
		$getdata=mysql_fetch_assoc(mysql_query("SELECT * FROM users WHERE user_name='$this->user_name' ||  user_name='$this->user_mail'"));
		if ($this->user_password==$getdata['user_password']) {
			
			$this->user_id=$getdata['user_id'];
			$prg=mysql_fetch_assoc(mysql_query("SELECT * FROM programs WHERE program_userid='$this->user_id' && program_state='0'"));
			$this->user_draftprogram=$prg['program_id'];
			$this->user_name=$getdata['user_name'];
			$this->user_aname=$getdata['user_aname'];
			$this->user_mail=$getdata['user_mail'];
			$this->user_password=$getdata['user_password'];
			$this->user_register=$getdata['user_register'];
			$this->user_country=$getdata['user_country'];
			$this->user_language=$getdata['user_language'];
			$this->user_avatar=$getdata['user_avatar'];
			$this->user_activate_time=$getdata['user_activate_time'];
			$this->user_rel=$getdata['user_rel'];
			$this->user_auth=$getdata['user_auth'];
			$this->user_show_mail=$getdata['user_show_mail'];
			$this->user_question=$getdata['user_question'];
			$this->user_answer=$getdata['user_answer'];
			$this->__construct();
			return 'true';
		} else {
			if (!isset($getdata['user_password'])) {
				return 'wuser';	
			} else if (isset($getdata['user_password']) && $this->user_password!=$getdata['user_password']) {
				return 'wpass';	
			} else {
				return 'error';
			}
		}
	}
	function login(){
		global $currentuser;
		$verifyresult=$this->verifylogininfos();
		if ($verifyresult=='true'){
			$ntfcontrol=mysql_fetch_assoc(mysql_query("
				SELECT not_userid,count(DISTINCT not_id) as ntfs 
				FROM notifications 
				WHERE not_userid='$this->user_id' AND not_seen='0' "));
				$ntfcount=$ntfcontrol['ntfs'];
				if ($ntfcount>0 && $ntfcount<100) {
					$this->user_notifications=$ntfcount;
				} else if ($ntfcount>99) {
					$this->user_notifications='+99';
				} else {
					$this->user_notifications="0";
				};
			$this->createarray();
			$_SESSION['timeflaxuser']=$this->userarray;
			$currentuser=$this->userarray;
		} else  {
			unset($_SESSION['timeflaxuser']);
		}
		return $verifyresult;
	}
	function logout(){
		unset($_SESSION['timeflaxuser']);	
	}
}



################################################################################################################################3
################################################################################################################################3
################################################################################################################################3
################################################################################################################################3
################################################################################################################################3
################################################################################################################################3
## PAGE PARAMETERS ################################################################################################
class page {
	public $pagename; /*index fln (NON) */
	public $meta_title;
	public $meta_desc;
	public $meta_img;
	public $meta_keyword;
	
	public $cr_url; /* createurl() fonksiyonuyla belirlenen bölüme göre url içinde olacak */
	public $cr_url_full; /* createurl() fonksiyonuyla belirlenen bölüme göre url içinde olacak */
	public $mintime;
	public $mingmttime;
	public $maxtime;
	public $maxgmttime;
	public $timeupperpoint;
	public $db_countrow;
	public $searchpage;
	
	public $btn_trend;
	public $btn_highlight;
	public $btn_new;
	public $btn_expire;
	public $btn_popular;
	public $btn_recommend;
	
	public $info_country;
	public $info_category;
	public $info_select;
	public $info_order;
	public $info_timestyle;
	public $info_search;
	
	public $cd_sql_select;
	public $cd_sql_orderby;
	public $cd_sql_where;
	public $cd_sql_limit;
	public $cd_sql_innerjoin;
	public $cd_sql_leftjoin;
	
	public $cd_array;
	
	public $cd_page;	/* Görüntülenen Sayfa Numarası */
	public $cd_pagesize;	  /* Sayfanın alabileceği gerisayımların sayısının üst sınırı */
	public $cd_maxpagenum;	/* En son sayfa sınırı */
	public $cd_sqlpage;	   /* SQL LIMIT işlemi için hesaplama sonu LIMIT başlangıç numarası */
	
	public $cd_order;
	public $cd_search;
	public $cd_timeinterval;
	public $cd_timestyle;
	public $cd_category;
	public $cd_country;
	public $cd_select;
	public $cd_detailed;
	public $cd_stage;
	public $cd_substage;
	
	public $prg_array;
	public $prg_sql_select;
	public $prg_sql_orderby;
	public $prg_sql_where;
	public $prg_sql_limit;
	public $prg_sql_innerjoin;
	public $prg_sql_leftjoin;
	public $prg_sql_join;
	public $prg_page;	/* Görüntülenen Sayfa Numarası */
	public $prg_pagesize;	  /* Sayfanın alabileceği gerisayımların sayısının üst sınırı */
	public $prg_maxpagenum;	/* En son sayfa sınırı */
	public $prg_sqlpage;	   /* SQL LIMIT işlemi için hesaplama sonu LIMIT başlangıç numarası */
	public $prg_search;
	public $prg_order;
	public $prg_category;
	public $prg_country;
	
	
	public $users_array;
	public $users_sql_select;
	public $users_sql_orderby;
	public $users_sql_where;
	public $users_sql_limit;
	public $users_sql_innerjoin;
	public $users_sql_leftjoin;
	public $users_sql_join;
	public $users_page;	/* Görüntülenen Sayfa Numarası */
	public $users_pagesize;	  /* Sayfanın alabileceği gerisayımların sayısının üst sınırı */
	public $users_maxpagenum;	/* En son sayfa sınırı */
	public $users_sqlpage;	   /* SQL LIMIT işlemi için hesaplama sonu LIMIT başlangıç numarası */
	public $users_search;
	public $users_order;
	public $users_country;
	
	public $deneme;
	
	function __construct() {
		
		global $login;
		global $currentuser;
		
		
		## COUNTDOWN 
		if (isset($_GET['search'])){ $this->cd_search=$_GET['search'];};
		if (isset($_GET['timestyle'])){ $this->cd_timestyle=$_GET['timestyle'];};
		if (isset($_GET['timeinterval'])){ $this->cd_timeinterval=$_GET['timeinterval'];};
		if (isset($_GET['page'])){ $this->cd_page=$_GET['page']; };
		if (isset($_GET['category'])){ $this->cd_category=$_GET['category'];};
		if (isset($_GET['country'])) { 
			$this->cd_country=$_GET['country'];
		} else if (!isset($_GET['country']) && $login=='true') {
			$this->cd_country=$currentuser['country'];
		};
		if (isset($_GET['order'])){ $this->cd_order=$_GET['order']; };
		
		## PROGRAMS
		
		if (isset($_GET['search'])){ $this->prg_search=$_GET['search'];};
		if (isset($_GET['page'])){ $this->prg_page=$_GET['page']; };
		if (isset($_GET['category'])){ $this->prg_category=$_GET['category'];};
		if (isset($_GET['country'])) { 
			$this->prg_country=$_GET['country'];
		} else if (!isset($_GET['country']) && $login=='true') {
			$this->prg_country=$currentuser['country'];
		};
		if (isset($_GET['order'])){ $this->prg_order=$_GET['order']; };
		
		
		if ($this->pagename=="my.php" || $this->pagename=='user.php'){
			if (isset($_GET['stage'])){ 
				$this->cd_stage=$_GET['stage']; 
				if (isset($_GET['substage'])) {
					$this->cd_substage=$_GET['substage'];
				}
			} else { 
				$this->cd_stage="con_countdowns"; 
				$this->cd_substage="con_c_all";
			};
		};
		
		## USERS 
		if (isset($_GET['search'])){ $this->users_search=$_GET['search'];};
		if (isset($_GET['page'])){ $this->users_page=$_GET['page']; };
		if (isset($_GET['country'])) { 
			$this->users_country=$_GET['country'];
		} else if (!isset($_GET['country']) && $login=='true') {
			$this->users_country=$currentuser['country'];
		};
		if (isset($_GET['order'])){ $this->users_order=$_GET['order']; };
		
		
		
		$this->searchpage="countdowns.php";
		switch ($this->pagename) {
					case "countdowns.php"; 	$this->searchpage= "countdowns.php";  break;
					case "programs.php"; 	$this->searchpage= "programs.php";  break;
					case "users.php"; 	$this->searchpage= "users.php";  break;
				}
	}
	##################################################################################################
	function getpagevariables() {
		if (isset($_GET['timestyle'])){ 
			$this->cd_timestyle=$_GET['timestyle']; }
		if (isset($_GET['timeinterval'])){ 
			$this->cd_timeinterval=$_GET['timeinterval']; }
		if (isset($_GET['category'])){ 
			$this->cd_category = $_GET['category'];
			$this->info_category="cat_".catname($this->cd_category);
		}
		if (isset($_GET['country'])) { 
			$this->cd_country = $_GET['country'];
		}
		if (isset($_GET['search'])){  
			$this->cd_search=$_GET['search']; 
		};
		if (isset($_GET['order'])){
			$this->cd_order=$_GET['order'];
			switch ($this->cd_order) {
				case "trend"; break;
				case "highlight"; break;
				case "new"; break;
				case "expire"; break;
				case "random";  break;
				case "popular";  break;
				default: $this->cd_order="trend"; break;
			};
			$this->info_order="ord_".$this->cd_order;
		};
					
	

		
	}
	function pagecreate(){
		$this->__construct();
		
		
		global $login;
		global $currentuser;
		global $thisuser;
		global $dtstamp;
		global $lastpoint;
		
		
		
		######################################## COUNTDOWNS.PHP
		if ($this->pagename=="countdowns.php" or $this->pagename == "my.php" or $this->pagename == "user.php"){
			
			## COUNTDOWNS DEFAULT SQL
			$this->cd_sql_select="SELECT * ,datediff(date(cd_expire),date('$dtstamp'))+1 as leftdays FROM cds ";
			$this->cd_sql_innerjoin="INNER JOIN users ON cd_userid = users.user_id ";
			$this->cd_sql_leftjoin = "
				LEFT JOIN (SELECT count(DISTINCT waiting_user) as totalwait,waiting_cd FROM waitings GROUP BY waiting_cd ) as new
				ON cds.cd_id = new.waiting_cd ";
			$this->cd_sql_where=" ";
			$this->cd_sql_orderby = " cd_ads desc ";
	
			$this->cd_sql_leftjoin = $this->cd_sql_leftjoin."
				LEFT JOIN (SELECT DISTINCT waiting_user AS isitwaited, waiting_cd FROM waitings WHERE waiting_user = '$currentuser[0]') as waited
				ON cds.cd_id = waited.waiting_cd ";
			$this->cd_sql_leftjoin = $this->cd_sql_leftjoin."
				LEFT JOIN ( SELECT *,sum(DISTINCT log_cause) as logcount FROM logs 
				WHERE log_register>'$lastpoint' and log_style='cds' GROUP BY log_object  ) as logged  
				ON logged.log_object=cds.cd_id ";
				
																										
			## CD PAGE NUMBER
			if ($this->cd_page > $this->cd_maxpagenum) { $this->cd_page=$this->cd_maxpagenum; }
			else if ($this->cd_page < 1) { $this->cd_page=0; };
			$this->cd_sqlpage=($this->cd_page-1)*($this->cd_pagesize);
			$this->cd_sql_limit= $this->cd_sqlpage.','.$this->cd_pagesize;
			
			
			
			## CD TIME STYLE AND TIME INTERVAL
			if (isset($_GET['timestyle'])){ 
				$this->cd_timestyle=$_GET['timestyle'];
				$this->info_timestyle="ts_".$this->cd_timestyle;
				switch ($this->cd_timestyle) {
					  case "global" ; $x=0; break;
					  case "local" ; $x=1; break;
					  default; ;
				};
				if (isset($_GET['timeinterval'])){
					$this->cd_timeinterval=$_GET['timeinterval'];
					$ti=explode('-',$_GET['timeinterval']);
					$this->mintime=urltodt($ti[0]); $this->maxtime=urltodt($ti[1]);
					$this->mingmttime=gmttodt($this->mintime); $this->maxgmttime=gmttodt($this->maxtime);
					switch ($this->cd_timestyle) {
						  case "global" ; $lowerlimit=$this->mintime; $upperlimit=$this->maxtime; break;
						  case "local" ; $lowerlimit=$this->mingmttime; $upperlimit=$this->maxgmttime; break;
						  default; 
					};
					$this->cd_sql_where .=" cd_type=".$x." and cd_expire>'$lowerlimit' and cd_expire<'$upperlimit'";
				} else {
					$this->cd_sql_where .=" cd_type=".$x." and cd_expire>'$dtstamp'";
				};
			} else {
				if (isset($_GET['timeinterval'])){
					$this->cd_timeinterval=$_GET['timeinterval'];
					$ti=explode('-',$_GET['timeinterval']);
					$this->mintime=urltodt($ti[0]); $this->maxtime=urltodt($ti[1]);
					$this->mingmttime=gmttodt($this->mintime); $this->maxgmttime=gmttodt($this->maxtime);
					$this->cd_sql_where.=" ((cd_type=0 and cd_expire>'$this->mintime' and cd_expire<'$this->maxtime') 
						or (cd_type=1 and cd_expire>'$this->mingmttime' and cd_expire<'$this->maxgmttime'))";
				} else {
					$this->cd_sql_where.=" ((cd_type=0 and cd_expire>'$this->mintime') or (cd_type=1 and cd_expire>'$this->mingmttime')) ";
				}			
			}
			
			## CD CATEGORY
			if (isset($_GET['category'])){ 
				$this->info_category="cat_".catname($this->cd_category);
				$this->cd_sql_where=$this->cd_sql_where." and cd_category='".$_GET['category']."'";
			};
			
			## CD SELECT
			if (isset($_GET['select'])){
				$this->info_select="sel_".$this->cd_select;
				if ($_GET['select']=="subscribe") {
					$this->cd_sql_innerjoin.="INNER JOIN (SELECT watch_er,watch_ed FROM watches WHERE watch_er='$currentuser[0]') as watched
					ON cds.cd_userid=watched.watch_ed";
				}
			};
			
			## CD COUNTRY
			if (isset($_GET['country'])) { 
				if ($_GET['country']!="" && $_GET['country']!="all"){
					$this->cd_sql_where=$this->cd_sql_where." and (cd_country='".$_GET['country']."' or cd_country='WWO')";
				}
				$this->cd_country=$_GET['country'];
			} else {
				if ($login=="true" && $currentuser['country']!=""){
					$this->cd_sql_where=$this->cd_sql_where. " and cd_country='".$currentuser['country']."'";
				}
			}
			
			## CD SEARCH
			if (isset($_GET['search'])){  
				$this->info_search=$this->cd_search;
				$this->cd_sql_where.= cd_sql_like_where($this->cd_search);
				$this->cd_sql_orderby.= ' , '.cd_sql_like_orderby($this->cd_search);
			};
			
			## CD ORDER
			if (isset($_GET['order']) || $this->cd_order!=""){
				switch ($this->cd_order) {
					case "trend"; break;
					case "highlight"; break;
					case "new"; break;
					case "expire"; break;
					case "random";  break;
					case "popular";  break;
					default: $this->cd_order="trend"; break;
				};
				
				$this->info_order="ord_".$this->cd_order;
				
				switch ($this->cd_order) {
					case "trend"; 		$this->cd_sql_orderby.= ", IFNULL(logcount,0) desc, cd_expire "; 
										$this->btn_trend="selected";  break;
					case "highlight"; 	$this->cd_sql_orderby.= ", totalwait/leftdays DESC , cd_expire "; 
										$this->btn_highlight="selected";  break;
					case "new"; 		  $this->cd_sql_orderby.= ", cd_register DESC "; 
										$this->btn_new="selected"; ;break;
					case "expire";		$this->cd_sql_orderby.= ", cd_expire, totalwait/leftdays DESC "; 
										$this->btn_expire = "selected" ; break;
					case "random";  		$this->cd_sql_orderby.= ", rand()"; 
										$this->cd_maxpagenum=1; break;
					case "popular";  		$this->cd_sql_orderby.= ", totalwait DESC, cd_expire";
										$this->btn_popular="selected"; break;
				}
			};	
		};
		
		########################################################### PROGRAMS.PHP
		if ($this->pagename=="programs.php" or $this->pagename == "my.php" or $this->pagename == "user.php"){
			
			## DEFAULT SQLS
			$this->prg_sql_select="SELECT * FROM programs";
			$this->prg_sql_innerjoin="INNER JOIN users ON user_id=program_userid ";
			$this->prg_sql_leftjoin = "
				LEFT JOIN (SELECT count(DISTINCT waitingp_user) as totalwait,waitingp_prg FROM waitingsp GROUP BY waitingp_prg ) as new
				ON programs.program_id = new.waitingp_prg";
			$this->prg_sql_where="  program_state>=1  ";
			$this->prg_sql_orderby = " program_ads desc ";
			$this->prg_sql_leftjoin = $this->prg_sql_leftjoin."
				LEFT JOIN (SELECT DISTINCT waitingp_user AS isitwaited, waitingp_prg FROM waitingsp WHERE waitingp_user = '$currentuser[0]') as waited
				ON programs.program_id = waited.waitingp_prg";
				
			$this->prg_sql_leftjoin = $this->prg_sql_leftjoin."
				LEFT JOIN ( SELECT *,sum(DISTINCT log_cause) as logcount FROM logs 
				WHERE log_register>'$lastpoint' and log_style='programs' GROUP BY log_object  ) as logged  
				ON logged.log_object=programs.program_id ";
				
			## PRG PAGE NUMBER
			if ($this->prg_page > $this->prg_maxpagenum) { $this->prg_page=$this->prg_maxpagenum; }
			else if ($this->prg_page < 1) { $this->prg_page=0; };
			$this->prg_sqlpage=($this->prg_page-1)*($this->prg_pagesize);
			$this->prg_sql_limit= $this->prg_sqlpage.','.$this->prg_pagesize;
			

			
			## PRG SELECT
			if (isset($_GET['select'])){ 
				$this->info_select="sel_".$this->prg_select;
				if ($_GET['select']=="subscribe") {
					$this->prg_sql_innerjoin.="INNER JOIN (SELECT watch_er,watch_ed FROM watches WHERE watch_er='$currentuser[0]') as watched
					ON cds.cd_userid=watched.watch_ed";
				}
			};
			
			## PRG COUNTRY
			if (isset($_GET['country'])) { 
				if ($_GET['country']!="" && $_GET['country']!="all"){
					$this->prg_sql_where=$this->prg_sql_where." and (program_country='".$_GET['country']."' or program_country='WWO')";
				}
				$this->prg_country=$_GET['country'];
			} else {
				if ($login=="true" && $currentuser['country']!=""){
					$this->prg_sql_where=$this->prg_sql_where." and program_country='".$currentuser['country']."'";
				}
			}
			
			## PRG CATEGORY
			if (isset($_GET['category'])){ 
				$this->info_category="cat_".catname($this->prg_category);
				$this->prg_sql_where=$this->prg_sql_where." and program_category='".$_GET['category']."'";
			};
			
			## PRG SEARCH
			if (isset($_GET['search'])){ 
				$this->info_search=$this->prg_search;
				$this->prg_sql_where.=prg_sql_like_where($this->prg_search);
				$this->info_search=$this->prg_search;
				$this->prg_sql_orderby.= ','.prg_sql_like_orderby($this->prg_search);
			};
			
			
			## PRG ORDER
			if (isset($_GET['order']) || $this->prg_order!=""){
				switch ($this->prg_order) {
					case "trend"; break;
					case "new";  break;
					case "popular"; break;
					default: $this->prg_order="trend";
				}
				$this->info_order="ord_".$this->prg_order;
				switch ($this->prg_order) {
					case "trend"; 	$this->prg_sql_orderby.= ", IFNULL(logcount,0) desc, program_register desc "; 
										$this->btn_trend="selected";  break;
					case "new"; 		  $this->prg_sql_orderby.= ", program_register DESC "; 
										$this->btn_new="selected"; ;break;
					case "popular";  		$this->prg_sql_orderby.= ", totalwait DESC";
										$this->btn_popular="selected"; break;
				}
			};	
		};
		
		######################################## USERS.PHP
		if ($this->pagename=="users.php" or $this->pagename == "my.php" or $this->pagename == "user.php"){
				
			## DEFAULT SQLS
			$this->users_sql_select="
				SELECT *,user_id as suserid,user_aname as susername, 
						user_rel as suserrel,user_avatar as suseravatar, 
						user_desc as suserdesc FROM users";
			$this->users_sql_innerjoin="";
			$this->users_sql_join="";
			$this->users_sql_leftjoin = "

				LEFT JOIN (
				SELECT watch_register,watch_ed,count(DISTINCT watch_er) as watchings FROM watches
				GROUP BY watch_ed ) as watched 
				ON watched.watch_ed=users.user_id
				LEFT JOIN (
				SELECT *,sum(DISTINCT log_cause) as logcount FROM logs 
				WHERE log_register>'$lastpoint' and log_style='user' GROUP BY log_object  ) as logged  
				ON logged.log_object=users.user_id";
			
			$this->users_sql_where=" user_state=0 and user_id<> '$currentuser[0]'  ";
			$this->users_sql_orderby = "user_rel desc  ";
			
				
				
																										
			## USERS PAGE NUMBER
			if ($this->users_page > $this->users_maxpagenum) { $this->users_page=$this->users_maxpagenum; }
			else if ($this->users_page < 1) { $this->users_page=0; };
			$this->users_sqlpage=($this->users_page-1)*($this->users_pagesize);
			$this->users_sql_limit= $this->users_sqlpage.','.$this->users_pagesize;
			
			
			## USERS COUNTRY
			if (isset($_GET['country'])) { 
				if ($_GET['country']!="" && $_GET['country']!="all"){
					$this->users_sql_where=$this->users_sql_where." and (user_country='".$_GET['country']."' or user_country='WWO')";
				}
				$this->users_country=$_GET['country'];
			} else {
				if ($login=="true" && $currentuser['country']!=""){
					$this->users_sql_where=$this->users_sql_where. " and user_country='".$currentuser['country']."'";
				}
			}
			
			## USERS SEARCH
			if (isset($_GET['search'])){  
				$this->info_search=$this->users_search;
				$this->users_sql_where.= users_sql_like_where($this->users_search);
				$this->info_search=$this->users_search;
				$this->users_sql_orderby.= ' , '.users_sql_like_orderby($this->users_search);
			};
			
			## USERS ORDER
			if (isset($_GET['order']) || $this->users_order!=""){
				switch ($this->users_order) {
					case "popular"; break;
					case "trend";  break;
					case "recommend";  break;
					default: $this->users_order="popular";
				}
				$this->info_order="ord_".$this->users_order;
				switch ($this->users_order) {
					case "popular"; 		$this->users_sql_orderby.= ", (IFNULL(watchings,0)+IFNULL(logcount,0)) desc "; 
											$this->users_sql_leftjoin .= "
											LEFT JOIN (SELECT watch_ed as w_ed,watch_er as w_er,watch_id as isitwatched FROM watches) as watch 
											ON users.user_id=w_ed AND w_er='$currentuser[0]'";
										$this->btn_popular="selected";  break;
					case "trend"; 		$this->users_sql_orderby.= ", IFNULL(logcount,0) desc "; 
										$this->users_sql_leftjoin .= "
											LEFT JOIN (SELECT watch_ed as w_ed,watch_er as w_er,watch_id as isitwatched FROM watches) as watch 
											ON users.user_id=w_ed AND w_er='$currentuser[0]'";

										$this->btn_trend="selected";  break;
					case "recommend"; $this->users_sql_orderby.= ", pop desc "; 
										$this->users_sql_select="SELECT *,suserid,susername,suserrel,suserdesc,suseravatar, count(suserid) as pop FROM users ";
										$this->users_sql_where.=" and chain.watch_ed<>'$currentuser[0]' GROUP BY suserid";
										$this->users_sql_join="
											JOIN (SELECT * FROM watches WHERE watch_er='$currentuser[0]') as watchings  On users.user_id = watchings.watch_er
											JOIN (SELECT * FROM watches ) as chain  On chain.watch_er = watchings.watch_ed";
										$this->users_sql_leftjoin .= "
											LEFT JOIN (SELECT user_aname as susername,user_id as suserid,user_rel as suserrel, user_avatar as suseravatar, user_desc as suserdesc FROM users) as suser ON suserid=chain.watch_ed
											LEFT JOIN (SELECT watch_ed as w_ed,watch_er as w_er,watch_id as isitwatched FROM watches) as watch ON suserid=w_ed AND w_er='$currentuser[0]'
											 ";
										$this->btn_recommend="selected";  break;
				}
			};	
		};
		
		################################################### MY.PHP
		if ($this->pagename=='my.php') {
			if (isset($_GET['stage'])){
				$this->cd_stage=$_GET['stage'];	
			} else {
				$this->cd_stage="con_countdowns";	
			}
			
			if (isset($_GET['substage'])) {
				$this->cd_substage=$_GET['substage'];
				if ($this->cd_substage=="con_c_own") {
					$this->cd_sql_where=" cd_userid='$currentuser[0]'";
				} else if ($this->cd_substage=="con_c_waitings"){
					$this->cd_sql_where=" cd_userid!='$currentuser[0]' AND waited.isitwaited!=''";
				} else if ($this->cd_substage=="con_c_all"){
					$this->cd_sql_where="(cd_userid='$currentuser[0]' OR waited.isitwaited!='')";
				} 
			} else {
				$this->cd_sql_where=" (cd_userid='$currentuser[0]' OR waited.isitwaited!='')";
				if ($this->cd_stage=="con_countdowns") { 
					$this->cd_substage="con_c_all"; 
				} else if ($this->cd_stage=="con_users") { 
					$this->cd_substage="con_u_subscribings"; 
				} else if ($this->cd_stage=="con_programs") { 
					$this->cd_substage="con_p_all"; 
				} else {
					
				}
			}
			$this->cd_sql_orderby=" cd_expire, totalwait/leftdays DESC ";
		};
		
		### USER.PHP VARIABLES
		if ($this->pagename=='user.php') {
			$this->cd_sql_leftjoin =$this->cd_sql_leftjoin ." LEFT JOIN (SELECT DISTINCT waiting_user AS selisitwaited, waiting_cd as waitingcd FROM waitings WHERE waiting_user = '$thisuser[0]') as selwaited
													ON cds.cd_id = selwaited.waitingcd";
			
			
			if (isset($_GET['stage'])){
				$this->cd_stage=$_GET['stage'];	
			} else {
				$this->cd_stage="u_st_profile";	
			}
			
			if (isset($_GET['substage'])) {
				$this->cd_substage=$_GET['substage'];
				if ($this->cd_substage=="u_con_c_own") {
					$this->cd_sql_where=" cd_userid='".$_GET['id']."'";
				} else if ($this->cd_substage=="u_con_c_waitings"){
					$this->cd_sql_where=" cd_userid!='".$_GET['id']."' AND selwaited.selisitwaited!=''";
				} else if ($this->cd_substage=="u_con_c_all"){
					$this->cd_sql_where="cd_userid='".$_GET['id']."' OR selwaited.selisitwaited!=''";
				} 
			} else {
				$this->cd_sql_where=" cd_userid='".$_GET['id']."' OR selwaited.selisitwaited!=''";
				if ($this->cd_stage=="u_con_countdowns") { 
					$this->cd_substage="u_con_c_all"; 
				} else if ($this->cd_stage=="u_con_users") { 
					$this->cd_substage="u_con_u_subscribings"; 
				} else if ($this->cd_stage=="u_con_programs") { 
					$this->cd_substage="u_con_p_all"; 
				} else {
					$this->cd_substage=""; 
				}
			}
		};
		
		
		if ($this->pagename=='user.php' || $this->pagename=='my.php'){
			$this->cd_sql_orderby=" cd_expire, totalwait/leftdays DESC ";
		}
		
		if ($this->pagename=="countdowns.php"){ $this->meta_img='link.gif'; }
		else if ($this->pagename=="my.php"){ $this->meta_img='link.gif'; }
		else if ($this->pagename=="user.php"){ $this->meta_img="files/avatars/$thisuser[8].jpg"; }
		else if ($this->pagename=="countdown.php"){ $this->meta_img='link.gif'; }
	}
	
	function geturlvariables(){
		$this->__construct();
		
		$this->cr_url="";
		if ($this->pagename=="countdowns.php"){
			$this->cd_array = array(
				'search' => $this->cd_search,
				'category' => $this->cd_category,
				'order' => $this->cd_order,
				'timeinterval' => $this->cd_timeinterval,
				'timestyle' => $this->cd_timestyle,
				'country' => $this->cd_country,
				'select' => $this->cd_select,
				'detailed' => $this->cd_detailed,
				'stage' => $this->cd_stage,
			);
		};		
		
		if ($this->pagename=='programs.php'){
			$this->cd_array = array(
				'search' => $this->prg_search,
				'page' => $this->prg_page,
				'order' => $this->prg_order,
				'category' => $this->prg_category,
				'country' => $this->prg_country,
			);
		};

		if ($this->pagename=="my.php"){
			$this->cd_array = array(
				'page' => $this->cd_page,
				'stage' => $this->cd_stage,
				'substage' => $this->cd_substage,
			);
		};
		
		if ($this->pagename=='user.php'){
			$this->cd_array = array(
				'id' => $_GET['id'],
				'page' => $this->cd_page,
				'stage' => $this->cd_stage,
				'substage' => $this->cd_substage,
			);
		};
		if ($this->pagename=="users.php"){
			$this->cd_array = array(
				'search' => $this->users_search,
				'order' => $this->users_order,
				'country' => $this->users_country,
				'page' => $this->users_page,
			);
		};
		
	}
	
	function createurl($for){
		$this->geturlvariables();
		$this->cr_url=$this->pagename."?";
		foreach ($this->cd_array as $name => $value ){
			if ($name!=$for && $value!="" && $name!="page"){
				$this->cr_url.=$name."=".$value."&";
			}
		}
		
		return $this->cr_url;
		
	}
	function fullurl() {
		$this->geturlvariables();
		$this->cr_url_full=$this->pagename."?";
		foreach ($this->cd_array as $name => $value ){
			if ($value!=""){
				$this->cr_url_full.=$name."=".$value."&";
			}
		}	
		return $this->cr_url_full;
	}
	
	function cd_sqlcommand(){
		return
			"$this->cd_sql_select
			$this->cd_sql_innerjoin
			$this->cd_sql_leftjoin
			WHERE $this->cd_sql_where
			ORDER BY $this->cd_sql_orderby
			LIMIT $this->cd_sql_limit";
	}
	
	
	
	function prg_sqlcommand(){
		global $currentuser;
		return
			"$this->prg_sql_select
			$this->prg_sql_innerjoin
			$this->prg_sql_leftjoin
			WHERE $this->prg_sql_where
			ORDER BY $this->prg_sql_orderby
			LIMIT $this->prg_sql_limit";
	}
	function users_sqlcommand(){
		global $currentuser;
		return
			"$this->users_sql_select
			$this->users_sql_join
			$this->users_sql_innerjoin
			$this->users_sql_leftjoin
			WHERE $this->users_sql_where
			ORDER BY $this->users_sql_orderby
			LIMIT $this->users_sql_limit";
	}
	
	function pagebuttons(){
		$this->pagecreate();
		$count=mysql_query("SELECT count(cd_id) as sumofcds FROM cds $this->cd_sql_innerjoin  $this->cd_sql_leftjoin  WHERE $this->cd_sql_where"); 
		while ($readcount=mysql_fetch_assoc($count)){
		$totalpage=ceil($readcount['sumofcds']/$this->cd_pagesize);
		if ($totalpage>$this->cd_maxpagenum) { $totalpage=$this->cd_maxpagenum; };
		if ($this->cd_page>$totalpage) { $this->cd_page=$totalpage; };
		};
		if ($totalpage>1) {
		$tostart=true; $toend=true;
		$start=($this->cd_page)-5;  if($start<=1){ $start=1; $tostart=false; };
		$end=$this->cd_page+5;  if ($end>=$totalpage) { $end=$totalpage; $toend=false; };
		if ($tostart==true) { echo "<a id='firstpage' href='".$this->createurl('page')."page=1'>&lt;&lt;</a>"; }; 
		if ($this->cd_page!=1) { echo "<a id='prevpage' href='".$this->createurl('page')."page=".($this->cd_page-1)."'>&lt;</a>"; }; 
		for ($i=$start;$i<=$end;$i++){ 
			if ($i==$this->cd_page) { echo "<a class='current' href='#current'>".$i."</a>";
			} else { echo "<a href='".$this->createurl('page')."page=".$i."'>".$i."</a>";
			}; 
		};
		if ($this->cd_page!=$totalpage) { echo "<a id='nextpage' href='".$this->createurl('page')."page=".($this->cd_page+1)."'>&gt;</a>"; }; 
		if ($toend==true) { echo "<a id='lastpage' href='".$this->createurl('page')."page=".$totalpage."'>&gt;&gt;</a>"; };
		};	
	}
	
	function prgbuttons(){
		$this->pagecreate();
		$count=mysql_query("SELECT count(program_id) as sumofprgs FROM programs $this->prg_sql_innerjoin  $this->prg_sql_leftjoin  WHERE $this->prg_sql_where"); 
		while ($readcount=mysql_fetch_assoc($count)){
			$this->deneme=$readcount['sumofprgs'];
		$totalpage=ceil($readcount['sumofprgs']/$this->prg_pagesize);
		if ($totalpage>$this->prg_maxpagenum) { $totalpage=$this->prg_maxpagenum; };
		if ($this->prg_page>$totalpage) { $this->prg_page=$totalpage; };
		};
		if ($totalpage>1) {
		$tostart=true; $toend=true;
		$start=($this->prg_page)-5;  if($start<=1){ $start=1; $tostart=false; };
		$end=$this->prg_page+5;  if ($end>=$totalpage) { $end=$totalpage; $toend=false; };
		if ($tostart==true) { echo "<a id='firstpage' href='".$this->createurl('page')."page=1'>&lt;&lt;</a>"; }; 
		if ($this->prg_page!=1) { echo "<a id='prevpage' href='".$this->createurl('page')."page=".($this->prg_page-1)."'>&lt;</a>"; }; 
		for ($i=$start;$i<=$end;$i++){ 
			if ($i==$this->prg_page) { echo "<a class='current' href='#current'>".$i."</a>";
			} else { echo "<a href='".$this->createurl('page')."page=".$i."'>".$i."</a>";
			}; 
		};
		if ($this->prg_page!=$totalpage) { echo "<a id='nextpage' href='".$this->createurl('page')."page=".($this->prg_page+1)."'>&gt;</a>"; }; 
		if ($toend==true) { echo "<a id='lastpage' href='".$this->createurl('page')."page=".$totalpage."'>&gt;&gt;</a>"; };
		};	
	}
	
	function usersbuttons(){
		$this->pagecreate();
		$count=mysql_query("SELECT count(user_id) as sumofusers FROM users $this->users_sql_join $this->users_sql_innerjoin  $this->users_sql_leftjoin  WHERE $this->users_sql_where"); 
		while ($readcount=mysql_fetch_assoc($count)){
			$totalpage=ceil($readcount['sumofusers']/$this->users_pagesize);
			if ($totalpage>$this->users_maxpagenum) { $totalpage=$this->users_maxpagenum; };
			if ($this->users_page > $totalpage) { $this->users_page=$totalpage; };
		};
		if ($totalpage>1) {
			$tostart=true; $toend=true;
			$start=($this->users_page)-5;  if($start<=1){ $start=1; $tostart=false; };
			$end=$this->users_page+5;  if ($end>=$totalpage) { $end=$totalpage; $toend=false; };
			if ($tostart==true) { echo "<a id='firstpage' href='".$this->createurl('page')."page=1'>&lt;&lt;</a>"; }; 
			if ($this->users_page!=1) { echo "<a id='prevpage' href='".$this->createurl('page')."page=".($this->users_page-1)."'>&lt;</a>"; }; 
			for ($i=$start;$i<=$end;$i++){ 
				if ($i==$this->users_page) { 
					echo "<a class='current' href='#current'>".$i."</a>";
				} else { 
					echo "<a href='".$this->createurl('page')."page=".$i."'>".$i."</a>";
				}; 
			};
			if ($this->users_page!=$totalpage) { echo "<a id='nextpage' href='".$this->createurl('page')."page=".($this->users_page+1)."'>&gt;</a>"; }; 
			if ($toend==true) { echo "<a id='lastpage' href='".$this->createurl('page')."page=".$totalpage."'>&gt;&gt;</a>"; };
		};	
	}
}

################################################################################################################################3
################################################################################################################################3
################################################################################################################################3
################################################################################################################################3
################################################################################################################################3
################################################################################################################################3
#### COUNTDOWN
class countdown {
	public $cd_id;
	public $cd_title;
	public $cd_type;
	public $cd_text;
	public $cd_category;
	public $cd_register;
	public $cd_expire;
	public $cd_ex;
	public $cd_logcount;
	public $totalwait;
	public $isitwaited;
	public $user_id;
	public $user_name;
	public $user_aname;
	public $ago;
	public $registerago;
	public $rem_sec;
	public $rem_min;
	public $rem_hou;
	public $rem_day;
	public $rem_mon;
	public $rem_yea;
	public $user_rel;
	public $mine;
	public $countrows;
	public $cdexpire;
	
	function buildcountdown(){
		global $dtstamp;
		if ($this->cd_type==1) { $this->cd_expire=dttogmt($this->cd_expire); };
		if (dtexpired($this->cd_expire,$dtstamp)=="1") { $this->cd_ex=dtplus($dtstamp,"00-00-00 00:00:01");  } else { $this->cd_ex=$this->cd_expire; };
		$this->ago=dtremaining(dtdiff($dtstamp,$this->cd_register));
		$this->registerago=$this->ago['number']." ".wrd($this->ago['text'])." ".wrd('ago');	
		$this->rem_sec=dateexp(dtdiff($this->cd_ex,$dtstamp),6);
		$this->rem_min=dateexp(dtdiff($this->cd_ex,$dtstamp),5);
		$this->rem_hou=dateexp(dtdiff($this->cd_ex,$dtstamp),4);
		$this->rem_day=dateexp(dtdiff($this->cd_ex,$dtstamp),3);
		$this->rem_mon=dateexp(dtdiff($this->cd_ex,$dtstamp),2);
		$this->rem_yea=dateexp(dtdiff($this->cd_ex,$dtstamp),1);	
		$this->cdexpire=dateexp($this->cd_expire,0);	
	}
	
	function createcountdowns($sqlcommand){
		
		global $currentuser;
		$getcds=mysql_query($sqlcommand);
		$this->countrows=0;
		while ($readcds=mysql_fetch_assoc($getcds)) {
		$this->countrows++;
		$this->isitwaited=$readcds['isitwaited'];
		$this->cd_id=$readcds['cd_id'];
		$this->cd_title=$readcds['cd_title'];
		$this->cd_type=$readcds['cd_type'];
		$this->cd_text=$readcds['cd_text'];
		$this->cd_category=$readcds['cd_category'];
		$this->cd_register=$readcds['cd_register'];
		$this->cd_expire=$readcds['cd_expire'];
		$this->cd_logcount=$readcds['logcount'];
		$this->totalwait=$readcds['totalwait'];
		$this->user_id=$readcds['user_id'];
		$this->user_name=$readcds['user_name'];
		$this->user_aname=$readcds['user_aname'];
		$this->user_rel=$readcds['user_rel'];
		$this->buildcountdown();
		if ($this->totalwait=="") { $this->totalwait="0"; };
		if ($this->isitwaited=="") { $this->isitwaited="false"; } else { $this->isitwaited="true"; };
		$cduser=""; 
		if ($this->user_rel==1) { $cduser = "<img class='radic' src='files/images/icon-Radic.png'>"; } ; $cduser=$cduser.$this->user_aname;
		if ($this->user_id==$currentuser[0]) $this->mine= 'true'; else $this->mine= 'false'; 
		echo 
		 "<div class='tf_cd-material' params=''>
			<span class='cdisitwaited'>$this->isitwaited</span>
			<span class='cdid'>$this->cd_id</span>
			<span class='cduid'>$this->user_id</span>
			<span class='cdtitle'>$this->cd_title</span>
			<span class='cdtotalwait'>$this->totalwait</span>
			<span class='cdicon'>$this->cd_category</span>
			<span class='cdtext'>$this->cd_text</span>
			<span class='cdrago'>$this->registerago </span>
			<span class='cdexpire'>$this->cdexpire</span>
			<span class='cde'>
			<h1 title='count'>$this->rem_sec</h1>
			<h2 title='count'>$this->rem_min</h2>
			<h3 title='count'>$this->rem_hou</h3>
			<h4 title='count'>$this->rem_day</h4>
			<h5 title='count'>$this->rem_mon</h5>
			<h6 title='count'>$this->rem_yea</h6></span>
			<span class='cduser'>$cduser</span>
			<span class='mine'>$this->mine</span>
		</div>";
		};
		
	}
	
}

################################################################################################################################3
################################################################################################################################3
################################################################################################################################3
################################################################################################################################3
################################################################################################################################3
################################################################################################################################3
#### USERS
class users {
	public $userid;
	public $username;
	public $userdesc;
	public $useravatar;
	public $userrel;
	public $watchings;
	public $logcount;
	public $isitwatched;
	
	function createusers($sqlcommand){
		
		global $currentuser;
		$getusers=mysql_query($sqlcommand);
		$this->countrows=0;
		while ($readusers=mysql_fetch_assoc($getusers)) {
		$this->countrows++;
		$this->userid=$readusers['suserid']; 
		$this->username=$readusers['susername']; 
		$this->userdesc=$readusers['suserdesc']; 
		$this->useravatar=$readusers['suseravatar'];
		$this->userrel=$readusers['suserrel']; 
		$this->watchings=$readusers['watchings'];
		$this->logcount=$readusers['logcount'];
		$this->isitwatched=$readusers['isitwatched'];
		if ($this->watchings=="") { $this->watchings=0; }; ## TOPLAM TAKIPÇİLER
		if ($this->logcount=="") { $this->logcount=0; }; ## SON BİR HAFTA KAYITLARI
		$bignumber=bignumbers($this->watchings);
		?> 
			<div class="tf_user">
			   		<div class="tf_user-imagebox">
			  			<div><a href="user.php?id=<?php echo $this->userid; ?>&stage=u_st_profile"><img src="files/avatars/<?php echo $this->useravatar; ?>.jpg" /></a></div>
					</div>
					<div class="tf_user-name">
						<div class="tf_user-name-top">
							<a href="user.php?id=<?php echo $this->userid; ?>&stage=u_st_profile"><?php echo $this->username; ?>
							<?php if ($this->userrel==1) { echo '<img width="25" height="25" src="files/images/icon-RadicB.png">'; }; ?></a></div>
						<div class="tf_user-name-bottom"><?php echo $this->userdesc; ?></div>
					</div>
					<div class="tf_user-detail">
						<div>Countdowns : <?php echo usercdscount($this->userid); ?></div>
						<div>Programs :<?php echo userprgcount($this->userid); ?></div>
					</div>
					<div class="tf_user-followbox">
						<a href="#x" cnumb="<?php echo $this->watchings; ?>" alt="<?php if ($this->isitwatched>=1) { echo "true"; } else { echo "false"; } ; ?>" uid="<?php echo $this->userid; ?>" class="userfollow <?php if ($this->isitwatched>=1) { echo "followed"; } else { echo "notfollowed"; } ; ?>"><img src="files/images/icon-Subscribe.png" />
						<div style="text-align:center; color:#FFF"><?php echo $bignumber; ?></div></a>         
					</div>
					<div style="clear:both"></div>
			   </div>
		<?php };
		
	}
	
}


################################################################################################################################3
################################################################################################################################3
################################################################################################################################3
################################################################################################################################3
################################################################################################################################3
################################################################################################################################3
#### PROGRAMS
class program {
	public $program_id;
	public $program_name;
	public $program_desc;
	public $program_user;
	public $program_userid;
	public $program_icon;
	public $program_register;
	public $ago;
	public $registerago;
	public $program_totalwait;
	public $program_isitwaited;
	public $countrows;
	
	function programcds($prg_id){
		 $getprgcont=mysql_query("
				SELECT * FROM program_contains 
				LEFT JOIN cds ON cd_id=program_contain_cd
				LEFT JOIN users ON user_id=cd_userid
				WHERE program_contain_pid='$prg_id'");
				$nmr=1;
				while ($readprgcont=mysql_fetch_assoc($getprgcont)){
					$prg_cont_cd=$readprgcont['program_contain_cd'];
					$prg_cont_user=$readprgcont['user_aname'];
					$prg_cont_userid=$readprgcont['user_id'];
					$prg_cd_expire=$readprgcont['cd_expire'];
					$prg_cd_register=$readprgcont['cd_register'];
					$prg_cd_type=$readprgcont['cd_type'];
					$prg_cd_title=$readprgcont['cd_title'];
					$prg_cd_text=$readprgcont['cd_text']; 
					$contcd=new countdown();
					$contcd->cd_expire=$prg_cd_expire;
					$contcd->cd_register=$prg_cd_register;
					$contcd->cd_type=$prg_cd_type;
					$contcd->buildcountdown();
				?>
				<div class="tf_prg-body-row">
					<div class="tf_prg-body-row-num"><?php echo $nmr; $nmr++; ?></div>
					<div class="tf_prg-body-row-left  count  tfprg">
						<span class="tf_prg-body-row-left-remain">
							<span class="state">counting</span>
							<span class="year"><?php echo $contcd->rem_yea; ?></span>
							<span class="yeart">yıl</span>
							<span class="month"><?php echo $contcd->rem_mon; ?></span>
							<span class="montht">ay</span>
							<span class="day"><?php echo $contcd->rem_day; ?></span>
							<span class="dayt">gün</span>
							<span class="hour"><?php echo $contcd->rem_hou; ?></span>
							<span class="hourt">saat</span>
							<span class="minute"><?php echo $contcd->rem_min; ?></span>
							<span class="minutet">dakika</span>
							<span class="second"><?php echo $contcd->rem_sec; ?></span>
							<span class="secondt">saniye</span>
							<span class="expiredstamp">expired</span>
						</span>
						<span class="tf_prg-body-row-left-expire"><?php echo $contcd->cdexpire; ?></span>
					</div>
					<div class="tf_prg-body-row-title"><a href="countdown.php?cid=<?php echo $prg_cont_cd; ?>"><?php echo $prg_cd_title; ?> CD ID = <?php echo $prg_cont_cd; ?></a></div>
					<div class="tf_prg-body-row-user"><a href="user.php?id=<?php echo $prg_cont_userid; ?>&stage=u_st_profile"><?php echo $prg_cont_user; ?></a></div>
					<div></div>
				</div>
		<?php };	
	}

	function createprograms($sqlcommand){
		
		global $currentuser;
		global $dtstamp;
		$this->countrows=0;
		$getprgs=mysql_query($sqlcommand);
		while ($readprg=mysql_fetch_assoc($getprgs)){
		$this->countrows++;
		$this->program_id=$readprg['program_id'];
		$this->program_name=$readprg['program_name'];
		$this->program_desc=$readprg['program_desc'];
		$this->program_user=$readprg['user_aname'];
		$this->program_icon=$readprg['program_icon'];
		$this->program_register=$readprg['program_register'];
			$this->ago=dtremaining(dtdiff($dtstamp,$this->program_register));
			$this->registerago=$this->ago['number']." ".wrd($this->ago['text'])." ".wrd('ago');	
		$this->program_userid=$readprg['user_id'];
		$this->program_totalwait=$readprg['totalwait'];
		$this->program_isitwaited=$readprg['isitwaited'];
		if ($this->program_isitwaited != "") { $isitwaited="true"; } else { $isitwaited="false"; }; 
		if ($this->program_totalwait=="") { $this->program_totalwait=0; };
		?>
							
		
		<div class="tf_prg">
			<div class="tf_prg-head">
				<div class="tf_prg-head-left">
			    	<img src="files/icons/default/<?php echo $this->program_icon; ?>.png" width="14" height="14" /> <a href="#x"><?php echo $this->program_name; ?></a>
				</div>
				<div class="tf_prg-head-right">
					<a href="#x"  alt="<?php echo $isitwaited; ?>" prgid="<?php  echo $this->program_id; ?>" cnumb="<?php echo $this->program_totalwait; ?>">
					<img src="files/images/wait-<?php if ($isitwaited=="true") { echo "b"; } else { echo "g"; } ?>.png" height="17px" style=""> <span><?php echo bignumbers($this->program_totalwait); ?> </span>
					</a>
				</div>                          
				
				<div style="clear:both;"></div>
			</div>
			
			<div class="tf_prg-header">
				<div class="tf_prg-header-num">#</div>
				<div class="tf_prg-header-left"><?php echo wrd('Time_Left'); ?></div>
				<div class="tf_prg-header-title"><?php echo wrd('Title'); ?></div>
				<div class="tf_prg-header-user"><?php echo wrd('User'); ?></div>
				<div></div>
			</div>
			
			
			<div class="tf_prg-body" >
				<?php $writeprogramcds=new program;
				$writeprogramcds->programcds($this->program_id); ?>
			</div>
			
			
			<div class="tf_prg-foot">
				<div class="tf_prg-foot-right">
					<a href="user.php?id=<?php echo $this->program_userid; ?>&stage=u_st_profile"><?php echo $this->program_user; ?></a>
				</div>
				<div class="tf_prg-foot-left">
					<?php echo $this->registerago; ?>
				</div>
			</div>
		</div>							
		<?php };
	}
}











################################################################################################################################3
################################################################################################################################3
################################################################################################################################3
################################################################################################################################3
################################################################################################################################3
################################################################################################################################3
#### IMAGE
class image {
	public $image;
	public $name;
	public $path;
	public $height;
	public $weight;
	public $marginleft;
	public $margintop;
	function __construct (){
		
	}
	function newavatar($id){
		
		$prop=$this->image;
		if ($prop['name']) {
			if ($prop['size']/1024<=1024){
				$size=getimagesize($prop['tmp_name']);
				switch($size["mime"]){
				case "image/jpeg": $run = imagecreatefromjpeg($prop['tmp_name']); break;
				case "image/gif": $run = imagecreatefromgif($prop['tmp_name']); break;
				case "image/png": $run = imagecreatefrompng($prop['tmp_name']); break;
				default: $run=false; $result='wfile'; break; };
				
				if ($run!=false) {
					$avatar_tmp=$prop['tmp_name'];
					$orgwidth=$size[0];
					$orgheight=$size[1];
					$topmargin=0;
					$leftmargin=0;
					if ($orgheight>$orgwidth){
						$ratio=$orgwidth/400;
						$newheight=$orgheight/$ratio;
						$newwidth=400;
						$topmargin=($this->margintop)*2;
					} else if ($orgheight<$orgwidth){
						$ratio=$orgheight/400;
						$newwidth=$orgwidth/$ratio;
						$newheight=400;
						$leftmargin=($this->marginleft)*2;
					} else {
						$newwidth=400; $newheight=400;
					}
					
					$ipath='files/avatars/'.$id.'.jpg';
					$run=ImageCreateFromJPEG($prop['tmp_name']);
					$fullimage=imagecreatetruecolor('400','400');
					imageCopyResized($fullimage,$run,-$leftmargin,-$topmargin,0,0,$newwidth,$newheight,$orgwidth,$orgheight);
					ImageJpeg($fullimage,$ipath);
					
					$useimage=mysql_query("UPDATE users SET user_avatar = '$id' WHERE user_id='$id'");
					$_SESSION['timeflaxuser']['avatar']=$id;
					return "success";
				} else {
					 return "wfile";
				}
			} else {
				return "wsize";	
			}
		} else {
			return "non";	
		}
	}
}



################################################################################################################################3
################################################################################################################################3
################################################################################################################################3
################################################################################################################################3
################################################################################################################################3
################################################################################################################################3
################################################################################################################################3
## LOGIN CONTROL AND REDIRECT TO VARIABLES

if (isset($_COOKIE['lang'])){ 
	$lang=$_COOKIE['lang'];
} else { 
	$lang="0"; setcookie('lang','0',time()+36000); 
};

if (isset($_SESSION['timeflaxuser'])){
	$login='true';
	$currentuser=$_SESSION['timeflaxuser'];
	$lang=$currentuser['language'];
} else {
	$login='false';
	$x= new user;
	$currentuser = $x->createarray();
}

if(isset($_GET['id'])) {
	$finduser=new user;
	$thisuser = $finduser->getuser($_GET['id']);
}



$info="non";
if (isset($_GET['info'])){ 
		$info=$_GET['info'];
};

?>
			
			 