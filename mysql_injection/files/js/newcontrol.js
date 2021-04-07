$(document).ready(function(e) {
	var userauth=false,languageauth=false,mailauth=false,passwordauth=false,passwordreauth=false,countryauth="",secretquestionauth=false,secretanswerauth=false,secretanswerreauth=false;
	var alreadyTaken=$.words('already_taken',lang),
		empty=$.words('empty',lang),
		notEligible=$.words('not_eligible',lang),
		max16chars=$.words('cant_be_more_than_16_characters',lang),
		min6chars=$.words('cant_be_less_than_6_characters',lang),
		alreadyUsed=$.words('already_used',lang),
		notValid=$.words('not_valid',lang),
		passwordsDontMatch=$.words('passwords_dont_match',lang),
		answersDontMatch=$.words('answers_dont_match',lang)
	
	
	
	
	$('#newuser > #newusername').blur(function(){
		var newusername = $.trim($(this).val());
		var chartest = new RegExp(/[^a-z,A-Z,0-9,_]/);
		var chars = chartest.test(newusername);
		if (newusername!="" && chars==false && newusername.length<=16 && newusername.length>=6) {
			$.ajax({
				url:"control.php",
				type:"POST",
				async: false,
				data: {'newusername':newusername},
				beforeSend: function(){ $('#newuser > #newusername').css('background','url(files/images/preloader-blur.gif) no-repeat right #EEE').css('backgroundSize','cover').css('color','#FFF');},
				success: function(e){
					var res = $.trim(e);
					if (res=="false") {
						$('#newuser > #newusername').css('background','url(files/images/true.png) no-repeat right #EEE').css('backgroundSize','contain').css('color','#000');
						$('#newuserinfo').html("");
						userauth=true;
					} else {
						$('#newuser > #newusername').css('background','url(files/images/wrong.png) no-repeat right #EEE').css('backgroundSize','contain').css('color','#000');
						$('#newuserinfo').html(alreadyTaken);
						userauth=false;
					}					
				}
			});
		} else {	
			userauth=false; 
			$(this).css('background','url(files/images/wrong.png) no-repeat right #EEE').css('backgroundSize','contain').css('color','#000');
			if (newusername=="") { $('#newuserinfo').html(empty);}
			else if (chars==true) { $('#newuserinfo').html(notEligible); }
			else if (newusername.length>16) { $('#newuserinfo').html(max16chars); }
			else if (newusername.length<6) { $('#newuserinfo').html(min6chars); };
		};
	});
	$('#newuser > #newmail').blur(function(){
		var newmail = $.trim($(this).val());
		var chartest = new RegExp(/^[a-z]{1}[\d\w\.-]+@[\d\w-]{3,}\.[\w]{2,3}(\.\w{2})?$/);
		var chars = chartest.test(newmail);
		if (newmail!="" && chars==true) {
			$.ajax({
				url:"control.php",
				type:"POST",
				async: false,
				data: {'newmail':newmail},
				beforeSend: function(){ $('#newuser > #newmail').css('background','url(files/images/preloader-blur.gif) no-repeat right #EEE').css('backgroundSize','cover').css('color','#FFF');},
				success: function(e){
					var res = $.trim(e);
					if (res=="false") {
						$('#newuser > #newmail').css('background','url(files/images/true.png) no-repeat right #EEE').css('backgroundSize','contain').css('color','#000');
						$('#newmailinfo').html(""); mailauth=true;
					} else {
						$('#newuser > #newmail').css('background','url(files/images/wrong.png) no-repeat right #EEE').css('backgroundSize','contain').css('color','#000');
						$('#newmailinfo').html(alreadyUsed); mailauth=false;
					}					
				}
			});
		} else { 
			mailauth=true;
			$(this).css('background','url(files/images/wrong.png) no-repeat right #EEE').css('backgroundSize','contain').css('color','#000');
			if (newmail=="") { $('#newmailinfo').html(empty); }
			else if (chars==false) { $('#newmailinfo').html(notValid); };
		};		
	});
	$('#newuser > #newpassword').blur(function(){
		var newpassword = $.trim($(this).val());
		var chartest = new RegExp(/[^a-z,A-Z,0-9,_]/);
		var chars = chartest.test(newpassword);
		if (newpassword!="" && chars==false && newpassword.length<=16 && newpassword.length>=6 ) {
			$(this).css('background','url(files/images/true.png) no-repeat right #EEE').css('backgroundSize','contain');
			$('#newpasswordinfo').html(""); 
			passwordauth=true;
		} else {	
			passwordauth=false;
			$(this).css('background','url(files/images/wrong.png) no-repeat right #EEE').css('backgroundSize','contain');
			if (newpassword=="") { $('#newpasswordinfo').html(empty); }
			else if (chars==true) { $('#newpasswordinfo').html(notEligible); }
			else if (newpassword.length>16) { $('#newpasswordinfo').html(max16chars); }
			else if (newpassword.length<6) { $('#newpasswordinfo').html(min6chars); }
		};		
	});
	$('#newuser > #newpasswordre').blur(function(){
		var newpasswordre = $.trim($(this).val());
		var newpassword = $('#newuser > #newpassword').val();
		if (newpasswordre == newpassword && newpasswordre!="") {
			$(this).css('background','url(files/images/true.png) no-repeat right #EEE').css('backgroundSize','contain');
			$('#newpasswordreinfo').html(""); passwordreauth=true;
		} else if (newpasswordre=="") {	
			$(this).css('background','url(files/images/wrong.png) no-repeat right #EEE').css('backgroundSize','contain');
			$('#newpasswordreinfo').html(empty); passwordreauth=false;
		} else if (newpasswordre != newpassword) {	
			$(this).css('background','url(files/images/wrong.png) no-repeat right #EEE').css('backgroundSize','contain');
			$('#newpasswordreinfo').html(passwordsDontMatch); passwordreauth=false;
		};		
	});
	$('#newuser > #newsecretquestion').blur(function(){
		var newsecretquestion = $.trim($(this).val());
		var chartest = new RegExp(/[^a-z,A-Z,0-9,_, ,?]/);
		var chars = chartest.test(newsecretquestion);
		if (newsecretquestion!="" && chars==false && newsecretquestion.length<=16 && newsecretquestion.length>=6) {
			$(this).css('background','url(files/images/true.png) no-repeat right #EEE').css('backgroundSize','contain').css('color','#000');
			$('#newsecretquestioninfo').html("");
			secretquestionauth=true;		
		} else {	
			secretquestionauth=false; 
			$(this).css('background','url(files/images/wrong.png) no-repeat right #EEE').css('backgroundSize','contain').css('color','#000');
			if (newsecretquestion=="") { $('#newsecretquestioninfo').html(empty);}
			else if (chars==true) { $('#newsecretquestioninfo').html(notEligible); }
			else if (newsecretquestion.length>16) { $('#newsecretquestioninfo').html(max16chars); }
			else if (newsecretquestion.length<6) { $('#newsecretquestioninfo').html(min6chars); };
		};	
	});
	$('#newuser > #newsecretanswer').blur(function(){
		var newsecretanswer = $.trim($(this).val());
		var chartest = new RegExp(/[^a-z,A-Z,0-9,_]/);
		var chars = chartest.test(newsecretanswer);
		if (newsecretanswer!="" && chars==false && newsecretanswer.length<=16 && newsecretanswer.length>=6) {
			$(this).css('background','url(files/images/true.png) no-repeat right #EEE').css('backgroundSize','contain').css('color','#000');
			$('#newsecretanswerinfo').html("");
			secretanswerauth=true;		
		} else {	
			secretanswerauth=false; 
			$(this).css('background','url(files/images/wrong.png) no-repeat right #EEE').css('backgroundSize','contain').css('color','#000');
			if (newsecretanswer=="") { $('#newsecretanswerinfo').html(empty);}
			else if (chars==true) { $('#newsecretanswerinfo').html(notEligible); }
			else if (newsecretanswer.length>16) { $('#newsecretanswerinfo').html(max16chars); }
			else if (newsecretanswer.length<6) { $('#newsecretanswerinfo').html(min6chars); };
		};	
	});
	$('#newuser > #newsecretanswerre').blur(function(){
		var newsecretanswerre = $.trim($(this).val());
		var newsecretanswer = $('#newuser > #newsecretanswer').val();
		if (newsecretanswerre == newsecretanswer && newsecretanswerre!="") {
			$(this).css('background','url(files/images/true.png) no-repeat right #EEE').css('backgroundSize','contain');
			$('#newsecretanswerreinfo').html(""); secretanswerreauth=true;
		} else if (newsecretanswerre=="") {	
			$(this).css('background','url(files/images/wrong.png) no-repeat right #EEE').css('backgroundSize','contain');
			$('#newsecretanswerreinfo').html(empty); secretanswerreauh=false;
		} else if (newsecretanswerre != newsecretanswer) {	
			$(this).css('background','url(files/images/wrong.png) no-repeat right #EEE').css('backgroundSize','contain');
			$('#newsecretanswerreinfo').html(answersDontMatch); secretanswerreauth=false;
		};		
	});
	
	$('#newcountry').blur(function(){
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
						countryauth=true;
					} else {
						countryauth=false;
						
					}					
				}
			});
		} else {	
			countryauth=false; 
		};
	});
	$('#newlanguage').blur(function(){
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
						languageauth=true;
					} else {
						languageauth=false;
					}					
				}
			});
		} else {	
			languageauth=false; 
		};
	});
	
	$('#newuser #newsubmit').click(function(){
		
			$('#newusername').blur();
			$('#newmail').blur();
			$('#newpassword').blur();
			$('#newpasswordre').blur();
			$('#newsecretquestion').blur();	
			$('#newsecretanswer').blur();
			$('#newsecretanswerre').blur();
			$('#newcountry').blur();
			$('#newlanguage').blur();		
		
			if(languageauth==true && countryauth==true && userauth==true && mailauth==true && passwordauth==true && passwordreauth==true && secretquestionauth==true && secretanswerauth==true && secretanswerreauth==true) {           
				$('form#newuser').submit(); 
			} else { 
				
			};
		
	});
	
	$('form#fp_firststep  input#fp_firststep').click(function(){
		var fpusername = $('form#fp_firststep  input#fp_username').val();
		$.ajax({
				url:"control.php",
				type:"POST",
				async: true,
				data: {'fp_username':fpusername},
				beforeSend: function(){ $('form#fp_firststep input#fp_username').css('background','url(files/images/preloader-blur.gif) no-repeat right #EEE').css('backgroundSize','cover').css('color','#FFF');},
				success: function(e){
					var res = $.trim(e);
					if (res!="non") {
						$('form#fp_secondstep span#secret_quest').html(res);
						$('form#fp_firststep').hide();
						$('span#firststepdone > span').html(fpusername);
						$('span#firststepdone').show();
						$('form#fp_secondstep').show();
					} else {
						$('form#fp_firststep input#fp_username').css('background','url(files/images/wrong.png) no-repeat right #EEE').css('backgroundSize','contain').css('color','#000');
						$.lightBox('mte411');
					}					
				}
			});
	});
	
	$('form#fp_secondstep  input#fp_secondstep').click(function(){
		var fpusername = $('form#fp_firststep  input#fp_username').val();
		var fpanswer = $('form#fp_secondstep  input#fp_answer').val();
		$.ajax({
				url:"control.php",
				type:"POST",
				async: true,
				data: {'fp_username':fpusername,'fp_answer':fpanswer},
				beforeSend: function(){ $('form#fp_secondstep input#fp_anser').css('background','url(files/images/preloader-blur.gif) no-repeat right #EEE').css('backgroundSize','cover').css('color','#FFF');},
				success: function(e){
					var res = $.trim(e);
					if (res!="non" && res!="false") {
						$('form#fp_secondstep').hide();
						$('form#fp_thirdstep').show();
						$('span#secondstepdone').show();
					} else {
						$('form#fp_secondstep input#fp_answer').css('background','url(files/images/wrong.png) no-repeat right #EEE').css('backgroundSize','contain').css('color','#000');
						$.lightBox('mte412');
					}					
				}
			});
	});
	
	$('form#fp_thirdstep  input#fp_thirdstep').click(function(){
		var fpusername = $('form#fp_firststep  input#fp_username').val();
		var fpanswer = $('form#fp_secondstep  input#fp_answer').val();
		var fpnewpass = $('form#fp_thirdstep  input#fp_newpass').val();
		var fpnewpassagain = $('form#fp_thirdstep  input#fp_newpassagain').val();
		if (fpnewpass==fpnewpassagain && fpnewpass.length>=6 && fpnewpass.length<=16) {
		$.ajax({
				url:"control.php",
				type:"POST",
				async: false,
				data: {'fp_username':fpusername,'fp_answer':fpanswer, 'fp_newpass':fpnewpass},
				success: function(e){
					var res = $.trim(e);
					if (res!="non" && res!="false") {
						$('form#fp_thirdstep').hide();
						$('span#firststepdone').hide();
						$('span#secondstepdone').hide();
						$('span#thirdstepdone').hide();
						$('form#fp_firststep').show();
						$('form#fp_firststep input#fp_username').css('background','#EEE').css('color','#000').val('');
						$('form#fp_secondstep input#fp_asnwer').css('background','#EEE').css('color','#000').val('');
						$('form#fp_thirdstep input#fp_newpass').css('background','#EEE').css('color','#000').val('');
						$('form#fp_thirdstep input#fp_newpassagain').css('background','#EEE').css('color','#000').val('');
					} else {
						$('form#fp_thirdstep input#fp_newpass').css('background','url(files/images/wrong.png) no-repeat right #EEE').css('backgroundSize','contain').css('color','#000');
						$('form#fp_thirdstep input#fp_newpassagain').css('background','url(files/images/wrong.png) no-repeat right #EEE').css('backgroundSize','contain').css('color','#000');
						$.lightBox('m411');
					}					
				}
			});
		} else {
			$('form#fp_thirdstep input#fp_newpass').css('background','url(files/images/wrong.png) no-repeat right #EEE').css('backgroundSize','contain').css('color','#000');
			$('form#fp_thirdstep input#fp_newpassagain').css('background','url(files/images/wrong.png) no-repeat right #EEE').css('backgroundSize','contain').css('color','#000');
			if (fpnewpass!=fpnewpassagain) {
				$.lightBox('mte414');
			} else {
				if (fpnewpass.length<6) {
					$.lightBox('mte413');
				} else if (fpnewpass.length>16) {
					$.lightBox('mte415');
				};
			};
		};
	});
	
});	
					