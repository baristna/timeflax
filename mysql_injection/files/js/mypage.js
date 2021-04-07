$(document).ready(function(e) {
	
	var as_userauth,as_mailauth,as_auserauth,as_countryauth,as_languageauth = "false";
	$('#account_settings #change_user_name').blur(function(){
		var changeusername = $.trim($(this).val());
		var chartest = new RegExp(/[^a-z,A-Z,0-9,_]/);
		var chars = chartest.test(changeusername);
		if (changeusername!="" && chars==false && changeusername.length<=16 && changeusername.length>=6) {
			$.ajax({
				url:"control.php",
				type:"POST",
				async: false,
				data: {'changeusername':changeusername},
				beforeSend: function(){ $('#account_settings #change_user_name').css('background','url(files/images/preloader-blur.gif) no-repeat right #EEE').css('backgroundSize','cover').css('color','#FFF');},
				success: function(e){
					var res = $.trim(e);
					if (res=="true") {
						$('#account_settings #change_user_name').css('background','url(files/images/true.png) no-repeat right #EEE').css('backgroundSize','contain').css('color','#000');
						as_userauth=true;
					} else {
						$('#account_settings #change_user_name').css('background','url(files/images/wrong.png) no-repeat right #EEE').css('backgroundSize','contain').css('color','#000');
						as_userauth=false;
					}					
				}
			});
		} else {	
			as_userauth=false; 
			$(this).css('background','url(files/images/wrong.png) no-repeat right #EEE').css('backgroundSize','contain').css('color','#000');
		};
	});
	$('#account_settings #change_user_aname').blur(function(){
		var changeaname = $.trim($(this).val());
		var chartest = new RegExp(/[^a-z,A-Z,0-9,_, ,ş,Ş,ı,I,ö,Ö,ü,Ü,ğ,Ğ,ç,Ç]/);
		var chars = chartest.test(changeaname);
		if (changeaname!="" && chars==false && changeaname.length<=16 && changeaname.length>=6) {
			$.ajax({
				url:"control.php",
				type:"POST",
				async: false,
				data: {'changeaname':changeaname},
				beforeSend: function(){ $('#account_settings #change_user_aname').css('background','url(files/images/preloader-blur.gif) no-repeat right #EEE').css('backgroundSize','cover').css('color','#FFF');},
				success: function(e){
					var res = $.trim(e);
					if (res=="true") {
						$('#account_settings #change_user_aname').css('background','url(files/images/true.png) no-repeat right #EEE').css('backgroundSize','contain').css('color','#000');
						as_auserauth=true;
					} else {
						$('#account_settings #change_user_aname').css('background','url(files/images/wrong.png) no-repeat right #EEE').css('backgroundSize','contain').css('color','#000');
						as_auserauth=false;
					}					
				}
			});
		} else {	
			as_auserauth=false; 
			$(this).css('background','url(files/images/wrong.png) no-repeat right #EEE').css('backgroundSize','contain').css('color','#000');
		};
	});
	$('#account_settings #change_mail').blur(function(){
		var changemail = $.trim($(this).val());
		var chartest = new RegExp(/^[a-z]{1}[\d\w\.-]+@[\d\w-]{3,}\.[\w]{2,3}(\.\w{2})?$/);
		var chars = chartest.test(changemail);
		if (changemail!="" && chars==true) {
			$.ajax({
				url:"control.php",
				type:"POST",
				async: false,
				data: {'changemail':changemail},
				beforeSend: function(){ $('#account_settings #change_mail').css('background','url(files/images/preloader-blur.gif) no-repeat right #EEE').css('backgroundSize','cover').css('color','#FFF');},
				success: function(e){
					var res = $.trim(e);
					if (res=="true") {
						$('#account_settings #change_mail').css('background','url(files/images/true.png) no-repeat right #EEE').css('backgroundSize','contain').css('color','#000');
						as_mailauth=true;
					} else {
						$('#account_settings #change_mail').css('background','url(files/images/wrong.png) no-repeat right #EEE').css('backgroundSize','contain').css('color','#000');
						as_mailauth=false;
					}				
				}
			});
		} else {	
			as_mailauth=false; 
			$(this).css('background','url(files/images/wrong.png) no-repeat right #EEE').css('backgroundSize','contain').css('color','#000');
		};
	});
	$('#account_settings #change_country').blur(function(){
		var countrycode = $.trim($(this).val());
		if (countrycode!="") {
			$.ajax({
				url:"control.php",
				type:"POST",
				async: false,
				data: {'countrycode':countrycode},
				success: function(e){
					var res = $.trim(e);
					if (res=="false") {
						as_countryauth=true;
					} else {
						as_countryauth=false;
						
					}					
				}
			});
		} else {	
			as_countryauth=false; 
		};
	});
	
	$('#account_settings #change_language').blur(function(){
		var languageid = $.trim($(this).val());
		if (languageid!="") {
			$.ajax({
				url:"control.php",
				type:"POST",
				async: false,
				data: {'languageid':languageid},
				success: function(e){
					var res = $.trim(e);
					if (res=="false") {
						as_languageauth=true;
					} else {
						as_languageauth=false;
					}					
				}
			});
		} else {	
			as_languageauth=false; 
		};
	});
	
	$('#account_settings #account_settings_submit').click(function(){
			$('#change_user_name').blur();
			$('#change_user_aname').blur();
			$('#change_mail').blur();
			$('#change_country').blur();
			$('#change_language').blur();	
			if(as_languageauth==true && as_countryauth==true && as_userauth==true && as_mailauth==true && as_auserauth) {           
				$('#account_settings').submit();
				/*$.ajax({
					type:'POST',
					url:'action.php',
					data:$('form#account_settings').serialize(),
					success:function(e){ console.log(e); },
					error:function(){ }
				}); */
			} else { 
				
			};
		
	});
	
	var changepasswordauth='false', changepasswordreauth='false';
	$('#change_password').blur(function(){
		var changepassword = $.trim($(this).val());
		var chartest = new RegExp(/[^a-z,A-Z,0-9,_]/);
		var chars = chartest.test(changepassword);
		if (changepassword!="" && chars==false && changepassword.length<=16 && changepassword.length>=6 ) {
			$(this).css('background','url(files/images/true.png) no-repeat right #EEE').css('backgroundSize','contain');
			changepasswordauth='true';
		} else {	
			changepasswordauth='false';
			$(this).css('background','url(files/images/wrong.png) no-repeat right #EEE').css('backgroundSize','contain');
		};		
		
	}); 
	
	$('#change_passwordre').blur(function(){
		var changepasswordre = $.trim($(this).val());
		var changepassword = $('#change_password').val();
		if (changepasswordre == changepassword && changepasswordre!="") {
			$(this).css('background','url(files/images/true.png) no-repeat right #EEE').css('backgroundSize','contain');
			changepasswordreauth='true';
		} else if (changepasswordre=="") {	
			$(this).css('background','url(files/images/wrong.png) no-repeat right #EEE').css('backgroundSize','contain');
			changepasswordreauth='false';
		} else if (changepasswordre != changepassword) {	
			$(this).css('background','url(files/images/wrong.png) no-repeat right #EEE').css('backgroundSize','contain');
			changepasswordreauth='false';
		};		
	});
	$('#change_password_submit').click(function(){
		$('#change_password').blur();
		$('#change_passwordre').blur();
		if (changepasswordauth=="true" && changepasswordreauth=="true" && $('#oldpassword').val()!=""){
			$('form#change_password_form').submit();	
		}
		
	});
	/**********************************************/
	var changeanswerauth='false', changeanswerreauth='false', changequestionauth='false';
	$('#changequestion').blur(function(){
		var changequestion = $.trim($(this).val());
		var chartest = new RegExp(/[^a-z,A-Z,0-9,_,?, ,ş,Ş,ı,I,ö,Ö,ü,Ü,ğ,Ğ,ç,Ç]/);
		var chars = chartest.test(changequestion);
		if (changequestion!="" && chars==false && changequestion.length<=48 && changequestion.length>=6 ) {
			$(this).css('background','url(files/images/true.png) no-repeat right #EEE').css('backgroundSize','contain');
			changequestionauth='true';
		} else {	
			changequestionauth='false';
			$(this).css('background','url(files/images/wrong.png) no-repeat right #EEE').css('backgroundSize','contain');
		};		
		
	}); 	
	
	$('#changeanswer').blur(function(){
		var changeanswer = $.trim($(this).val());
		var chartest = new RegExp(/[^a-z,A-Z,0-9,_]/);
		var chars = chartest.test(changeanswer);
		if (changeanswer!="" && chars==false && changeanswer.length<=16 && changeanswer.length>=6 ) {
			$(this).css('background','url(files/images/true.png) no-repeat right #EEE').css('backgroundSize','contain');
			changeanswerauth='true';
		} else {	
			changeanswerauth='false';
			$(this).css('background','url(files/images/wrong.png) no-repeat right #EEE').css('backgroundSize','contain');
		};		
		
	}); 
	
	$('#changeanswerre').blur(function(){
		var changeanswerre = $.trim($(this).val());
		var changeanswer = $('#changeanswer').val();
		if (changeanswerre == changeanswer && changeanswerre!="") {
			$(this).css('background','url(files/images/true.png) no-repeat right #EEE').css('backgroundSize','contain');
			changeanswerreauth='true';
		} else if (changeanswerre=="") {	
			$(this).css('background','url(files/images/wrong.png) no-repeat right #EEE').css('backgroundSize','contain');
			changeanswerreauth='false';
		} else if (changeanswerre != changeanswer) {	
			$(this).css('background','url(files/images/wrong.png) no-repeat right #EEE').css('backgroundSize','contain');
			changeanswerreauth='false';
		};		
	});
	$('#change_security_submit').click(function(){
		$('#changequestion').blur();
		$('#changeanswer').blur();
		$('#changeanswerre').blur();
		if (changeanswerauth=="true" && changeanswerreauth=="true" && changequestionauth=="true" && $('#password').val()!=""){
			$('form#change_security').submit();	
		}
		
	});
});
	
					