$(document).ready(function(){
	var languagescript="";
	$.each(languages,function(a){
   		languagescript = languagescript+' <a class="buttonstd" href="action.php?language='+a+'"><img src="files/flags/'+languages[a][1]+'.png" />'+languages[a][0]+' ('+languages[a][1]+')</a>';
	});
	            
	$('body').append('<div class="lightbox" id="lb-language"><div class="lightbox-in"><div class="lightbox-head">'+$.words('Language',lang)+'</div><div class="lightbox-body">'+languagescript+'</div><div class="lightbox-foot"><span class="lb-close"> <a class="buttonlight" href="#x">Ok</a> </span></div></div></div>');
	$('body').append('<div class="lightbox" id="lb-info"><div class="lightbox-in"><div class="lightbox-head"></div><div class="lightbox-body"></div><div class="lightbox-foot"></div></div></div>');
	$('#tf-area').append('<div id="slidebox" style=""><ul style=""></ul></div>');
	/* LIGHTBOX AND FRONTPAGE */
	
	
	
	if(info!='non') {
		$.lightBox(info);
	} else {
		//$.lightBox('mti902');	
	}
	$('.lightbox .lbclose').click(function(event){
		$('.lightbox').hide();
	});
	$('.lightbox').click(function() {
		$('.lightbox').hide();
	});
	$('.lightbox-in').click(function(event){
		 event.stopPropagation();
	});
	
	$('#changelaguage').click(function(){
		$('#lb-language').frontPage();
		$.lbAlign();
	});
	$('#avatar-change').click(function(){
		$('#lb-avatar-change').frontPage({ color:'black' });
		$.lbAlign();	
	});
	$('#avatar-delete').click(function(){
		$('#lb-avatar-delete').frontPage({ color:'red' });
		$.lbAlign();	
	});
	
	
	
	$('#tf-leftmenu-in').jScrollPane();
	$('#tf-programlist-in').jScrollPane().droppable();
	
	
	$('.tf_prg-body').jScrollPane({verticalDragMaxHeight:999});
	$('.jspDrag').mousedown(function(){ $(this).css('background','#FFFF79'); });
	$(window).mouseup(function(){ $('.jspDrag').css('background','#DDD'); });
	$('.timepicker').datetimepicker({dateFormat: 'yy-mm-dd',showMinute: true,timeFormat: 'HH:mm:ss',stepHour: 1,stepMinute: 1,stepSecond: 1});
	$('#ui-datepicker-div').css('font-size','12px');
	$('.ui-autocomplete ,.ui-front ui-menu ,.ui-widget ,.ui-widget-content ,.ui-corner-all').css('font-size','12px').css('textAlign','left');
	 
	setTimeout(function(){
	isitfirst=true;
	$.tfcdcreater();
	$.syncinterval($.tfcountdown,1000,60);
	
	
	$('.tf_prg-body-row-left').hover(function(){
			if ($(this).hasClass('count')){
				$('.tf_prg-body-row-left-remain',this).fadeOut(200);
				$('.tf_prg-body-row-left-expire',this).fadeIn(200);
			}
		},function(){
			if ($(this).hasClass('count')){
				$('.tf_prg-body-row-left-remain',this).fadeIn(200);
				$('.tf_prg-body-row-left-expire',this).fadeOut(200);
			}
		});
	
	
	
	/* SLIDE BOX */
	$.fn.slidebox = function() {
		$('#slidebox > ul').html($('ol',this).html())
		var sbHeight=$('#slidebox').height(); // 200
		var wdHeight=$(window).height(); // 400
		var scTop=$(window).scrollTop(); // 100
		var tTop=$(this).offset().top; // 300 - aslında 300-100=200
		var abTop =tTop-scTop; // 200 oldu. gercek yükseklik
		var btLine=abTop+sbHeight; // 200+200= 400 alt çizginin bulunduğu nokta sayfamız da 400 olduğuna göre sıkıntı yok
		var maxTop=wdHeight-sbHeight+scTop;
		var fnlTop=0;
		if (btLine>wdHeight) { var fnlTop=maxTop; } else { var fnlTop=tTop; };
		$('#slidebox').offset({ top:fnlTop }).show();
	}
	var curWidTop=$(window).scrollTop();
	$(window).scroll(function(e){ 
		$('#slidebox').offset({ top:($('#slidebox').offset().top+$(window).scrollTop()-curWidTop) });
		curWidTop=$(window).scrollTop();
	});
	$('#tf-leftmenu .sb').mouseover(function(event){
		//$('#slidebox').offset({top:$(this).offset().top})
		$('#slidebox').clearQueue();
		event.stopPropagation();	
		$(this).slidebox();
	});
	$('#tf-leftmenu .sb , #slidebox').mouseleave(function(){
		$('#slidebox').delay(1000).fadeOut(200);
	});
	$('#slidebox').mouseover(function(event){
		$(this).stop(true,true);
		$(this).clearQueue();
		event.stopPropagation();
		$(this).show();	
	});
	
	/* WAIT PROGRAMS BUTTON POST DATA */
	$('.tf_prg-head-right a').click(function(){
		if(login=="true") {			
			var fprgid=$(this).attr('prgid');
			var fcount=$(this).attr('cnumb');
			if($(this).attr('alt')=="false") {
				$.ajax({
					type: "POST",
					url: "action.php",
					data: {'fprgid':fprgid,'action':'waitprg'},
					success: function(e){
					},
				}); 
				$(' > img',this).attr('src','files/images/wait-b.png');
				$(this).attr('alt','true');
				fcount++; 
				$(this).attr('cnumb',fcount);
				$(' > span',this).html($.bignumbers(fcount));
				
			} else {
				$.ajax({
					type: "POST",
					url: "action.php",
					data: {'fprgid':fprgid,'action':'cancelwaitprg'},
					success: function(){
					},
				});
				$(' > img',this).attr('src','files/images/wait-g.png');
				$(this).attr('alt','false');
				fcount--;
				$(this).attr('cnumb',fcount);
				$(' > span',this).html($.bignumbers(fcount));
			};
		} else {
			window.location.href='login.php';	
		};
	});
	
	
	/* WAIT CDS BUTTON POST DATA */
	$('.tf_cd-head-waitings a').click(function(){
		if(login=="true") {			
			var fcdid=$(this).attr('cdid');
			var fcount=$(this).attr('cnumb');
			if($(this).attr('alt')=="false") {
				$.ajax({
					type: "POST",
					url: "action.php",
					data: {'fcdid':fcdid,'action':'wait'},
					success: function(e){
					},
				}); 
				$(' > img',this).attr('src','files/images/wait-b.png');
				$(this).attr('alt','true');
				fcount++; 
				$(this).attr('cnumb',fcount);
				$(' > span',this).html($.bignumbers(fcount));
				
			} else {
				$.ajax({
					type: "POST",
					url: "action.php",
					data: {'fcdid':fcdid,'action':'cancelwait'},
					success: function(){
					},
				});
				$(' > img',this).attr('src','files/images/wait-g.png');
				$(this).attr('alt','false');
				fcount--;
				$(this).attr('cnumb',fcount);
				$(' > span',this).html($.bignumbers(fcount));
			};
		} else {
			window.location.href='login.php';	
		};
	});
	
	
	// WATCH POST DATA
	$('.userfollow').click(function(){
		if(login=="true") {			
			var fuserid=$(this).attr('uid');
			var fcount=$(this).attr('cnumb');
			if($(this).attr('alt')=="false") {
				$.ajax({
					type: "POST",
					url: "action.php",
					data: {'fuserid':fuserid,'action':'followuser'},
					success: function(e){
					},
				}); 
				$(this).removeClass('notfollowed').addClass('followed');
				$(this).attr('alt','true');
				fcount++;
				$(this).attr('cnumb',fcount);
				$(' > div',this).html($.bignumbers(fcount)); 
				
			} else {
				$.ajax({
					type: "POST",
					url: "action.php",
					data: {'fuserid':fuserid,'action':'unfollowuser'},
					success: function(){
					},
				});
				$(this).removeClass('followed').addClass('notfollowed');
				$(this).attr('alt','false');
				fcount--;
				$(this).attr('cnumb',fcount);
				$(' > div',this).html($.bignumbers(fcount)); 
			};
		} else {
			window.location.href='login.php';	
		};
	});
	
	$('.tf-programlist-in-item-a').click(function(){
		var deletecd=$(this).parent().attr('prgid');
		$(this).parent().remove();
		$.ajax({
			type: "POST",
			url: "control.php",
			data: {'deletecd':deletecd,'action':'deletecdfromdraft'},
			success: function(e){},
		}); 
	});
	
},1000);
	
	$('#ntfclear').click(function(){
		$.ajax({
				url:"action.php",
				type:"POST",
				async: true,
				data: {'ntfclear':'true'},
				success: function(e){
					$('#notifications-panel').html('<i>'+$.words("You_dont_have_any_notification",lang)+'</i>');
					$.lightBox('mti202');					
				}
			});
	});
	
	/* RESIZE and CSS */
	$.windowresize(function() {
		$('#tf-leftmenu-in').jScrollPane();
		$('.jspDrag').mousedown(function(){ $(this).css('background','#FFFF79'); });
		$(window).mouseup(function(){ $('.jspDrag').css('background','#DDD'); });
		$.lbAlign();
	});
	
	
	
	
	/* MENUBAR ACTIONS */
	$('ul.menubarright > li.submenu').hover(function(){
		$(' > ul',this).hide().slideDown(200,'easeOutCirc');
	},function(){
		$(' ul.menubarright > li > ul').clearQueue().stop();
		$(' > ul',this).hide();
	});
	$('li.subclick > a').click(function(){
			$(' > ul',$(this).parent()).fadeIn(300);
	});
	$('html').click(function() {
		$('li.subclick > ul').fadeOut(300);
	 });
	
	 $('li.subclick').click(function(event){
		 event.stopPropagation();
	 });
	$('ul.menubarright > li ').hover(function(){	
		$(' ul.menubarright li ').clearQueue();
		$(' > a',this).animate({'backgroundColor':'#333','color':'#FFF'},200);
	},function(){
		$(' ul.menubarright li ').clearQueue().stop();
		$(' > a',this).animate({'backgroundColor':'#222','color':'#DDD'},000);
	});
	$('ul.menubarright > li > ul > li ').hover(function(){	
		$(' ul.menubarright li ').clearQueue();
		$(' > a',this).animate({'backgroundColor':'#555','color':'#FFF'},200);
	},function(){
		$(' ul.menubarright li ').clearQueue().stop();
		$(' > a',this).animate({'backgroundColor':'#333','color':'#DDD'},000);
	});
	
	
	$('ul.menubarleft > li ').hover(function(){	
		$(' ul.menubarleft li ').clearQueue();
		$(this).animate({'backgroundColor':'#333','color':'#FFF'},200);
	},function(){
		$(' ul.menubarleft li ').clearQueue().stop();
		$(this).animate({'backgroundColor':'#222','color':'#FFF'},000);
	});
	$('ul.menubarleft > li.subhover').hover(function(){
		$(' > ul',this).hide().slideDown(200,'easeOutCirc');
	},function(){
		$(' ul.menubarleft > li > ul').clearQueue().stop();
		$(' > ul',this).hide();
	});
	$('ul.menubarleft > li > ul > li').hover(function(){	
		$(' ul.menubarleft li ').clearQueue();
		$(this).animate({'backgroundColor':'#555','color':'#FFF'},200);
	},function(){
		$(' ul.menubarleft li ').clearQueue().stop();
		$(this).animate({'backgroundColor':'#333','color':'#FFF'},000);
	});
	
	
	
	
	
	/* LOCATION FORM APPEND CITIES DEPEND COUNTRY */
	$("select#countryselect").change(function(){
		var country = $('select#countryselect').val();
		var currentlink=$(this).attr('currurl');
		var loc=currentlink+'country='+country;
		window.location.href=loc;
	});
	$("select#categoryselect").change(function(){
		var category = $('select#categoryselect').val();
		var currentlink=$(this).attr('currurl');
		var loc=currentlink+'category='+category;
		window.location.href=loc;
	});
	

	
	/* TIME INTERVAL FORM LINK CREATING and REDIRECT */
	$('#timeinterval #applytimeinterval').click(function(){
		var maxdt=$('#timeinterval #maxtime').val().split(' ');
		var maxdate=maxdt[0].split('-');
		var maxtime=maxdt[1].split(':');
		
		var mindt=$('#timeinterval #mintime').val().split(' ');
		var mindate=mindt[0].split('-');
		var mintime=mindt[1].split(':');
		
		if (mindate[0]==null || mindate[0]=="") { mindate[0]=tfnow(1); };
		if (mindate[1]==null || mindate[1]=="") { mindate[1]=tfnow(2); };
		if (mindate[2]==null || mindate[2]=="") { mindate[2]=tfnow(3); };
		if (mintime[0]==null || mintime[0]=="") { mintime[0]=tfnow(4); };
		if (mintime[1]==null || mintime[1]=="") { mintime[1]=tfnow(5); };
		if (mintime[2]==null || mintime[2]=="") { mintime[2]=tfnow(6); };
		if (maxdate[0]==null || maxdate[0]=="") { maxdate[0]=tfnow(1); };
		if (maxdate[1]==null || maxdate[1]=="") { maxdate[1]=tfnow(2); };
		if (maxdate[2]==null || maxdate[2]=="") { maxdate[2]=tfnow(3); };
		if (maxtime[0]==null || maxtime[0]=="") { maxtime[0]=tfnow(4); };
		if (maxtime[1]==null || maxtime[1]=="") { maxtime[1]=tfnow(5); };
		if (maxtime[2]==null || maxtime[2]=="") { maxtime[2]=tfnow(6); };
		var timeinterval=mindate[0]+mindate[1]+mindate[2]+mintime[0]+mintime[1]+mintime[2]+"-"+maxdate[0]+maxdate[1]+maxdate[2]+maxtime[0]+maxtime[1]+maxtime[2];            
		timeinterval = timeinterval.replace(/[0]/g,'t');              
		timeinterval = timeinterval.replace(/[1]/g,'i');              
		timeinterval = timeinterval.replace(/[2]/g,'m');              
		timeinterval = timeinterval.replace(/[3]/g,'e');              
		timeinterval = timeinterval.replace(/[4]/g,'f');              
		timeinterval = timeinterval.replace(/[5]/g,'l');              
		timeinterval = timeinterval.replace(/[6]/g,'a');              
		timeinterval = timeinterval.replace(/[7]/g,'x');              
		timeinterval = timeinterval.replace(/[8]/g,'c');             
		timeinterval = timeinterval.replace(/[9]/g,'d'); 
		var timeintervalurl=$('#timeinterval #timeintervalurl').val();
		var location=timeintervalurl+"timeinterval="+timeinterval;
		window.location.href = location;
	});
	
	
	
	
	
	
	/* BUTTON ACTIONS */
	Mousetrap.bind('left', function() {
			var prevloc = $('#prevpage').attr('href');
			if (prevloc!=undefined) {
				window.location.href=prevloc;
			};
	});
	Mousetrap.bind('right', function() { 
			var nextloc = $('#nextpage').attr('href');
			if (nextloc!=undefined) {
				window.location.href=nextloc;
			}
		});
	Mousetrap.bind('end', function() { 
			var lastloc = $('#lastpage').attr('href');
			if (lastloc!=undefined) {
				window.location.href=lastloc;
			}
		});
	Mousetrap.bind('home', function() { 
			var firstloc = $('#firstpage').attr('href');
			if (firstloc!=undefined) {
				window.location.href=firstloc;
			};
		});
	Mousetrap.bind('r', function() { 
			window.location.href="countdowns.php?order=random";
		});
		
		
	$.lbAlign();
	
});



