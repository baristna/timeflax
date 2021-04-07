var now=new Date();
var programcreating="false";
var draftprogram=new Array();

$.bignumbers = function (number){
	var result;
	if (number<0) { result=0; }
	else if (number>=0 && number<1000) { result=number; }
	else if (number>=1000 && number<1000000) { result=Math.floor(number/1000)+'k'; }
	else if (number>=1000000 && number<1000000000) { result=Math.floor(number/1000000)+'m';}
	else { result=Math.floor(number/1000000000)+'b'; }; 
	return result;	
}

$.syncinterval = function (func,interval,control) { 
		var 
		now=new Date();
		realMinute=now.getMinutes(),
		realSecond=now.getSeconds(),
		nowSecond=realSecond,
		nowMinute=realMinute,
		minuteError=0,
		countingVar=1,
		totalDiff=0;

		var loopthat = setInterval(function(){
		
		if (nowSecond==0) {
			nowMinute++;
			nowMinute=nowMinute%60;
		};
		if (countingVar==0){
			
			now=new Date();
			realSecond=now.getSeconds();
			realMinute=now.getMinutes();
			
			totalDiff=((realMinute*60)+(realSecond))-((nowMinute*60)+(nowSecond));
			if(totalDiff>0){
				for (i=1;i<=totalDiff;i++) {
					func();
					nowSecond++;
					countingVar++;
				};
			} else if (totalDiff==0){
				func();
				nowSecond++;
				countingVar++;
			} else if (totalDiff<0) {
				
			};
		} else {
			func();
			nowSecond++;
			countingVar++;
		};
		countingVar=countingVar%control;
		nowSecond=nowSecond%60;
	},interval);
};

$.windowresize =  function(func) {
var resizeTimer = null;
	$(window).bind('resize', function() {
    if (resizeTimer) clearTimeout(resizeTimer);
    resizeTimer = setTimeout(func, 100);
	});	
}
$.windowscroll =  function(func) {
var scrollTimer = null;
	$(window).bind('scroll', function() {
    if (scrollTimer) clearTimeout(scrollTimer);
    scrollTimer = setTimeout(func, 10);
	});	
}

$.tfnow = function (e) {
	var myDate = new Date();
	var nowYear=myDate.getFullYear();
	var nowMonth=( '0' + (myDate.getMonth()+1) ).slice(-2);
	var nowDay=('0'+myDate.getDate()).slice(-2);
	var nowHour=( '0' + (myDate.getHours()) ).slice(-2);
	var nowMinute=('0'+myDate.getMinutes()).slice(-2);
	var nowSecond=('0'+myDate.getSeconds()).slice(-2);
	var nowAll=nowYear+nowMonth+nowDay+nowHour+nowMinute+nowSecond;
	var displayDate = nowYear+'.'+nowMonth+'.'+nowDay+' / '+nowHour+':'+nowMinute+':'+nowSecond;
	var result;
	if (e==0) { result=nowAll; 
	} else if (e==1) { result=nowYear;
	} else if (e==2) { result=nowMonth;
	} else if (e==3) { result=nowDay;
	} else if (e==4) { result=nowHour;
	} else if (e==5) { result=nowMinute;
	} else if (e==6) { result=nowSecond;
	} else if (e==7) { result=displayDate; };
	return result;
};
$(function() {
    var availableTags = [
      "ActionScript",
      "Scheme"
    ];
    $( "#search" ).autocomplete({
      source: availableTags
    });
  });


$.words = function(name,lang) {
	var data="";
	$.ajax({
	type: "GET",
	url: "files/xml/language.xml",
	dataType: "xml",
    async: false,  
	success:function(xml){ 
			data = $($(xml).find('word[name="'+name+'"]')).find('lang[opt="'+lang+'"]').text(); 
		},
	fail: function() {data = name}
	});
	return data;
}

$.lbAlign = function(){
	$('.lightbox-in').each(function() {
		$(this).css('top',($(window).height()-$(this).height())/2);
		$(this).css('left',($(window).width()-$(this).width())/2);
		$('.lb-close' , this).click(function(event){
			$('.lightbox').hide();
		});
	});
}

$.lightBox = function(xinfo){
		$('#lb-info').show();
		
		var infostyle=xinfo.slice(0,3);
		var infocode=xinfo.slice(3);
		
		/*$('#lightbox-title').html($.words(infostyle,lang));*/
		$('#lb-info .lightbox-body').html($.words('m'+infocode,lang)+infocode);
		$('#lb-info .lightbox-foot').html('<span class="lb-close"><a class="buttonlight" href="#x">Ok</a></span>');
		
		if (infostyle=='non') {
			$('#lb-info .lightbox-head').css('background','url(files/images/rEffect1black.png)').css('background-size','cover');
			$('#lb-info .lightbox-foot').css('background','url(files/images/rEffect2black.png)').css('background-size','cover');
		} else if (infostyle=='mte') {
			$('#lb-info .lightbox-head').css('background','url(files/images/rEffect1red.png)').css('background-size','cover');
			$('#lb-info .lightbox-foot').css('background','url(files/images/rEffect2red.png)').css('background-size','cover');
		} else if (infostyle=='mti') {
			$('#lb-info .lightbox-head').css('background','url(files/images/rEffect1yellow.png)').css('background-size','cover');
			$('#lb-info .lightbox-foot').css('background','url(files/images/rEffect2yellow.png)').css('background-size','cover');			
		} else if (infostyle=='mts') {
			$('#lb-info .lightbox-head').css('background','url(files/images/rEffect1green.png)').css('background-size','cover');
			$('#lb-info .lightbox-foot').css('background','url(files/images/rEffect2green.png)').css('background-size','cover');			
		};
		$.lbAlign();
}
  
$.fn.frontPage =  function(fPset) {
	var fPsetting = $.extend({
		color:'black',
	},fPset);
	$(this).show();
	return this.each(function() {
		$('.lightbox-head', this).css('background','url(files/images/rEffect1'+fPsetting.color+'.png)').css('background-size','cover');
		$('.lightbox-foot', this).css('background','url(files/images/rEffect2'+fPsetting.color+'.png)').css('background-size','cover');	
	});
	$.lbAlign();
}



$.fn.imageCropper = function(settings){
	var iCsetting = $.extend({
		imagewidth: 200,
		imageheight: 400
	},settings);
	
		return this.each(function(){
			$(this).wrap('<div class="image-cropper"></div>');
			$(this).wrap('<div class="scene"></div>');
			$(this).wrap('<div class="mask"></div>');
			$(this).wrap('<div class="rail"></div>');
			$(this).draggable({ addClasses:false, containment:"parent", cursor:"crosshair",
			drag :  function(){
				var imageTopMargin=$(this).parent().parent().offset().top-$(this).offset().top;
				var imageLeftMargin=$(this).parent().parent().offset().left-$(this).offset().left;
				$('#imagetopmargin').val(imageTopMargin);
				$('#imageleftmargin').val(imageLeftMargin);
			}
			});
			var railmargintop=(iCsetting.imageheight-200);
			var railmarginleft=(iCsetting.imagewidth-200);
			var railwidth=(railmarginleft*2)+200;
			var railheight=(railmargintop*2)+200;
			var railmargin='-'+railmargintop+'px 0px 0px -'+railmarginleft+'px';
			$('.image-cropper').css({"text-align":"center","width":"300px","background":"#CCCCCC"});
			$('.image-cropper > .scene').css({'width':'200px','height':'200px','background':'#000000','margin':'0 auto'});
			$('.image-cropper > .scene > .mask').css({'width':'300px','height':'200px','margin':'0 auto','overflow':'hidden','position':'absolute','text-align':'center'});
			$('.image-cropper > .scene > .mask > .rail').css({'width':railwidth,'height':railheight,'position':'absolute','margin':railmargin,'background':'url(files/images/trans32.png)','text-align':'center'});
			$(this).css({'width':iCsetting.imagewidth,'height':iCsetting.imageheight,'margin':'0 auto'});
			$('.image-cropper > .scene > .mask').droppable({ accept:'.image-cropper > .scene > .mask > .rail > img', scroll:false });
			
		});	
};

$.tfpexp = function(x) { /* Verilen elementin parametrelerini parçalayıp, 2 boyutlu array olarak geri döndürür.  */
	var e = $(x).attr('params');
	e=$.trim(e);
	var firststep=e.split(';');
	var secondstep=new Array();
	/* fonksiyon içerisinde kullanılacak olan dizi oluşturuluyor ve tüm parametrelerin varsayılan değerler yükleniyor. */
		secondstep['ajax']='off';
		secondstep['type']='2';
		
		secondstep['share']='on';
		secondstep['waiters']='on';
		secondstep['user']='on';
		secondstep['footer']='on';
		secondstep['header']='on';
		secondstep['footer']='on';
		secondstep['icon']='off';
		secondstep['countdown']='on';
		secondstep['expire']='on';
		secondstep['text']='on';
		secondstep['title']='on';
		secondstep['width']='265';
		secondstep['color']='hg#FFF,ht#222,hi#black,htw#null,bg#FFF,bt#222,btw#null,fg#FFF,ft#222,fi#black,ftw#null,tw#null';
		
		secondstep['hg']='null'; secondstep['ht']='null'; secondstep['hi']='black'; secondstep['htw']='null';
		secondstep['bg']='null'; secondstep['bt']='null'; secondstep['btw']='null';
		secondstep['fg']='null'; secondstep['ft']='null'; secondstep['hi']='null'; secondstep['ftw']='null';
		secondstep['tw']='null'; 
		secondstep['border']='null';
		
		secondstep['cdid']='1';
		secondstep['size']='default';
	$.each(firststep,function(a){   
   		var tempa = firststep[a].trim().split(':');
   		secondstep[tempa[0]]=tempa[1];
	});
	var colors = new Array();
	colors = secondstep['color'].split(',');
	$.each(colors,function(b){
		var tempb = colors[b].trim().split('#');
		secondstep[tempb[0]]=tempb[1];
	});
	return secondstep;
}

$.tfcdexternal = function(){
	$('.tf_cd-external').each(function() {
		var tfid=$(this).attr('tf-id');
		$(this).attr('class','tf_cd-current');
			$.ajax({
				type: "POST",
				url: "tf-ajax.php",
				data: {'tfid':tfid},
  				dataType:"html",
				async:false,
				success: function(res){
					$('.tf_cd-current').html(res);
				},
				complete:function(){
					$('.tf_cd-current').attr('class','tf_cd-material');
				},
			});
	});
	$(document).trigger('tfcdexternalend');
}

$.tfdragging = function() { 
	/* PROGRAM CREATING */
	$('#programCreating').click(function(){
			if (programcreating=="true") {
				$( ".tf_cd" ).draggable({disabled:true});
				$('#creatingswich').attr('src','files/images/plus.png');
				$('#tf-programlist').hide();
				programcreating="false";
				
			} else {
				$( ".tf_cd" ).draggable("enable");
				$('#creatingswich').attr('src','files/images/plus-s.png');
				$('#tf-programlist').show();
				$('#tf-programlist-in').jScrollPane();
				programcreating="true";
			}
			
	});
	
	if (login=="true") {
 		var draggedcd="";
 		var draggedtitle="";
		$( ".tf_cd" ).draggable({
		start: function( ) {
			$('#tf-programlist').stop(false,false).clearQueue().show().animate({opacity:'100'});;
			draggedcd= $(this).attr('alt');
			draggedtitle= $(this).attr('altname');
			},
  		stop: function() {
			$('#tf-programlist-in').css('background-color','#FFF');
			},
		cursor:'move',
		helper:'clone',
		zIndex:'1300',
		disable:true,
		});
		$('#tf-programlist').droppable({
			over:function(){
				$(this).css('background-color','#FFFFA9');
				$('#tf-programlist-in').css('background-color','#FFFFA9');
				$('#tf-programlist-bottom').css('background-color','#FFFFA9');
				
				},
			out:function(){
				$(this).css('background-color','#FFF');
				$('#tf-programlist-in').css('background-color','#FFF');
				$('#tf-programlist-bottom').css('background-color','#FFF');
				},
			drop:function(){
				
				$(this).css('background-color','#FFF');
				$('#tf-programlist-in').jScrollPane().css('background-color','#FFF');
				$('#tf-programlist-bottom').css('background-color','#FFF');
				
					$.ajax({
						type: "POST",
						url: "control.php",
						data: {'draggedcd':draggedcd,'action':'addcdtodraft'},
						success: function(e){
							if($.trim(e)=='true'){
								var newprogramitem='<li class="tf-programlist-in-item" prgid="'+draggedcd+'"><a href="#x"  class="tf-programlist-in-item-a"><img height="10" width="10" src="files/images/icon-X.png"></a>'+draggedtitle+'</li>';
								$('#programlist').append(newprogramitem);
								draftprogram.push(draggedcd);
							} else {
							};
						},
					}); 
				}
		});
	}; // LOGİN
	
	
	$( ".tf_cd" ).draggable({disabled:true});
};


$.tfcdcreater = function() { 
	$('.tf_cd-material').each(function() { 
		var cdid=$(' .cdid',this).html();
		var cduid=$(' .cduid',this).html();
		var cdtitle=$(' .cdtitle',this).html();
		var cdtext=$(' .cdtext',this).html();
		var cdtotalwait=$(' .cdtotalwait',this).html();
		var cdtotalwaitconv = $.bignumbers(cdtotalwait);
		var cdisitwaited=$(' .cdisitwaited',this).html();
		var cdicon=$(' .cdicon',this).html();
		var cdrago=$(' .cdrago',this).html();
		var cdexpire=$(' .cdexpire',this).html();
		var cde=new Array();
		cde[1]=$(' .cde h1',this).html();
		cde[2]=$(' .cde h2',this).html();
		cde[3]=$(' .cde h3',this).html();
		cde[4]=$(' .cde h4',this).html();
		cde[5]=$(' .cde h5',this).html();
		cde[6]=$(' .cde h6',this).html();
		var cdeyear= cde[6];
		var cdemonth= cde[5];
		var cdeday= cde[4];
		var cdehour= cde[3];
		var cdeminute= cde[2];
		var cdesecond= cde[1];
		var cduser=$(' .cduser',this).html();
		var mine=$(' .mine',this).html();
		$(this).html('');
		if (cdisitwaited=="true" && login=="true") { var waitcolor="b"; } else { var waitcolor="g";}
		

		$(this).attr('alt',cdid);
		$(this).attr('altname',cdtitle);
		$(this).append('<div class="tf_cd-head"></div>');
			$(' > .tf_cd-head ',this).append('<div class="tf_cd-head-state state" style="display:none">counting</div>');
			$(' > .tf_cd-head ',this).append('<div class="tf_cd-head-title title"><a class="tf_cd-title-drag" href="countdown.php?cid='+cdid+'\">'+cdtitle+'</a></div>');
			$(' > .tf_cd-head ',this).append('<div class="tf_cd-head-waitings"><a href="#x" class="tf_cd-head-waitings-a" alt="'+cdisitwaited+'" cdid="'+cdid+'" cnumb="'+cdtotalwait+'" ><img src="files/images/wait-'+waitcolor+'.png"height="17px" /><br /><span>'+cdtotalwaitconv+'</span></a></div>');
		$(this).append('<div class="tf_cd-body"></div>');
			$(' > .tf_cd-body ',this).append('<div class="tf_cd-body-top"><div class="tf_cd-body-top-icon"><img src="files/icons/default/'+cdicon+'.png"  height="45px" /></div><div class="tf_cd-body-top-text">'+cdtext+'</div>');
			$(' > .tf_cd-body ',this).append('<div class="tf_cd-body-bottom"><div class="expiredstamp"><img src="files/images/expired.png"></div><div class="year">'+cdeyear+'</div><div class="yeart"></div><div class="month">'+cdemonth+'</div><div class="montht"></div><div class="day">'+cdeday+'</div><div class="dayt"></div><div class="hour">'+cdehour+'</div><div class="hourt"></div><div class="minute">'+cdeminute+'</div><div class="minutet"></div><div class="second">'+cdesecond+'</div><div class="secondt"></div><div class="end">'+$.words('left',lang)+'</div></div>');
			$(' > .tf_cd-body ',this).append('<div class="tf_cd-body-expire">'+cdexpire+'</div>');
		$(this).append('<div class="tf_cd-foot"></div>');
			$(' > .tf_cd-foot ',this).append('<div class="tf_cd-foot-share">'+cdrago+'</div>');
			if (mine=="false") { 
			$(' > .tf_cd-foot ',this).append('<div class="tf_cd-foot-user"><a href="user.php?id='+cduid+'&stage=u_st_profile">'+cduser+'</a></div>');
			} else {
			$(' > .tf_cd-foot ',this).append('<div class="tf_cd-foot-user"><a href="my.php?editcd='+cdid+'"><img alt="mine" src="files/images/icon-Settings2.png" width="21" height="21" /></a></div>');	
			};
		$(this).attr('class','tf_cd count tfcd'); /*tf_cd-material işlenmiştir ve class tf_cd olarak değiştirilmiştir. */
		
		
		
		
		var prm= new Array();
		prm=$.tfpexp(this); 
		var tfid=prm['cd-id']; 	 
		
		if (prm['width']<220) { prm['width']=220; };
		$(this).css('width',prm['width']);
		$(' .tf_cd-head-title ',this).css('width',prm['width']-65);
		$(' .tf_cd-head-waitings ',this).css('width',prm['width']-20);  
		$(' .tf_cd-foot-user ',this).css('width',prm['width']-20); 
		$(' .tf_cd-body-expire ',this).css('width',prm['width']); 
		
		if (prm['header']=="off") { $(' .tf_cd-head ', this).css('display','none');};
		if (prm['title']=="off") { $(' .tf_cd-head-title ', this).css('display','none');};
		if (prm['waitings']=="off") { $(' .tf_cd-head-waitings ', this).css('display','none');};
		
		if (prm['body']=="off") { $(' .tf_cd-body ', this).css('display','none');};
		if (prm['text']=="off") { $(' .tf_cd-body-top ', this).css('display','none');};
		if (prm['icon']=="on") { $(' .tf_cd-body-top-icon ', this).css('display','none');};
		if (prm['countdown']=="off") { $(' .tf_cd-body-bottom ', this).css('display','none');};
		if (prm['expire']=="off") { $(' .tf_cd-body-expire ', this).css('display','none');};
		
		if (prm['footer']=="off") { $(' .tf_cd-foot ', this).css('display','none');  };
		if (prm['share']=="off") { $(' .tf_cd-foot-share ', this).css('display','none');};
		if (prm['user']=="off") { $(' .tf_cd-foot-user a:first ', this).css('display','none'); $(' .tf_cd-foot-user img ', this).css('display','block');}; 
		
		
		if (prm['hg']!="null" && prm['hg']!="none") { $(' .tf_cd-head ', this).css('background-color','#'+prm['hg']);} else if (prm['hg']!="null" && prm['hg']=="none") { $(' .tf_cd-head ', this).css('background',''); }; 
		if (prm['ht']!="null") { $(' .tf_cd-head a', this).css('color','#'+prm['ht']);};  
				
		if (prm['bg']!="null" && prm['bg']!="none") { $(' .tf_cd-body ', this).css('background-color','#'+prm['bg']);} else if (prm['bg']!="null" && prm['bg']=="none") { $(' .tf_cd-body ', this).css('background',''); };
		if (prm['bt']!="null") { $(' .tf_cd-body ', this).css('color','#'+prm['bt']);}; 
		
		if (prm['fg']!="null" && prm['fg']!="none") { $(' .tf_cd-foot ', this).css('background-color','#'+prm['fg']);} else if (prm['fg']!="null" && prm['fg']=="none") { $(' .tf_cd-foot ', this).css('background',''); } ;
		if (prm['ft']!="null") { $(' .tf_cd-foot ', this).css('color','#'+prm['ft']); $(' .tf_cd-foot a ', this).css('color','#'+prm['ft']);};
		
		//if (prm['hi']=="black") { $(' .tf_cd-head-waitings img ', this).attr('src','files/images/wait-b.png'); $(' .tf_cd-head-waitings a span ', this).css('color','#000000');  } else if (prm['hi']=="white") { $(' .tf_cd-head-waitings img ', this).attr('src','files/images/wait-w.png'); $(' .tf_cd-head-waitings a ', this).css('color','#FFFFFF');  } 
		//if (prm['fi']=="black") { $(' .tf_cd-foot img[alt="embed"] ', this).attr('src','files/images/icon-Embed-b.png'); $(' .tf_cd-foot img[alt="facebook"] ', this).attr('src','files/images/icon-Facebook-b.png'); $(' .tf_cd-foot img[alt="twitter"] ', this).attr('src','files/images/icon-Twitter-b.png'); } else if (prm['fi']=="white") { $(' .tf_cd-foot img[alt="embed"] ', this).attr('src','files/images/icon-Embed-w.png'); $(' .tf_cd-foot img[alt="facebook"] ', this).attr('src','files/images/icon-Facebook-w.png'); $(' .tf_cd-foot img[alt="twitter"] ', this).attr('src','files/images/icon-Twitter-w.png'); }

		if (prm['tw']!="null") { prm['htw']=prm['tw']; prm['btw']=prm['tw']; prm['ftw']=prm['tw']; };
		if (prm['htw']!="null") { $(' .tf_cd-head ', this).css('font-weight',prm['htw']);};
		if (prm['btw']!="null") { $(' .tf_cd-body ', this).css('font-weight',prm['btw']);};
		if (prm['ftw']!="null") { $(' .tf_cd-foot ', this).css('font-weight',prm['ftw']);};
		 
		if (prm['border']!='null'){ $(this).css('border',prm['border']);};
		$(' .tf_cd-head ', this).css('background-image','url(files/images/rEffect1black.png)');
		$(' .tf_cd-foot ', this).css('background-image','url(files/images/rEffect2black.png)');
		
		$.tfdragging();
	});
	
}

window.onbeforeunload = confirmExit;
function confirmExit()
		{
				if(savedprogram=="false") {
					$('#tf-programlist').stop(false,false).clearQueue().show().animate({opacity:'100'});;
					return $.words('Discard_Unsaved_List',lang);
				} else {
					
				};
		};
 

$.tfcountdown = function(){
	$('.count').each(function() {
		
	var state = $(' .state',this).html();
	if (state=='counting'){
		var remyear = $(' .year',this).html();
		var remmonth=$(' .month',this).html();
		var remday=$(' .day',this).html();
		var remhour=$(' .hour',this).html();
		var remminute=$(' .minute',this).html();
		var remsecond=$(' .second',this).html();
		if(remsecond!=0)
		{ remsecond--; }
		else { remsecond=59; 
				if(remminute!=0){ remminute--; }
				else { remminute=59;
						if(remhour!=0) { remhour--;}
						else { remhour=23;
								if(remday!=0){remday--;}
								else { var dayplus;
										var nowmonth = now.getMonth()+1;
										switch (nowmonth) {
										case 1: dayplus=31; break;
										case 2: if (now.getFullYear()%4==0) {dayplus=29} else { daypluse=28 }; break;
										case 3: dayplus=31; break;
										case 4: dayplus=30; break;
										case 5: dayplus=31; break;
										case 6: dayplus=30; break;
										case 7: dayplus=31; break;
										case 8: dayplus=31; break;
										case 9: dayplus=30; break;
										case 10: dayplus=31; break;
										case 11: dayplus=30; break;
										case 12: dayplus=31; break;
										default: dayplus=31;
										}
										remday=dayplus-1;
										if (remmonth!=0) { remmonth--; }
										else { remmonth=11; 
												if(remyear!=0) { remyear--; }
												else {
													$(' .state',this).html('expired');
													$(this).removeClass('count');
													state='expired';
													$('  .second',this).html('');
													$('  .secondt',this).html('');
													$('  .end',this).html('');
													
													if ($(this).hasClass('tfcd')){ // Countdown Box için bitiş stili
														$(' .expiredstamp',this).fadeIn(300);
														$(' .expiredstamp > img ', this).animate({'height':'75px'},300,'easeInCirc');
														$(' .tf_cd-head ', this).css('background-image','url(files/images/rEffect1red.png)');
														$(' .tf_cd-foot ', this).css('background-image','url(files/images/rEffect2red.png)');
													} else if ($(this).hasClass('tfprg')) { // Program Box için bitiş stili
														$('.tf_prg-body-row-left-remain', this).hide();
														$('.tf_prg-body-row-left-expire', this).show().css('color','#F00');
													} else { // 	
													} 
												};
										};
								};
						};	
				};		
		};
		
		if (state=='counting') {
			$(' .year',this).html(('0'+remyear).slice(-2));
			$(' .month',this).html(('0'+remmonth).slice(-2));
			$(' .day',this).html(('0'+remday).slice(-2));
			$(' .hour',this).html(('0'+remhour).slice(-2));
			$(' .minute',this).html(('0'+remminute).slice(-2));
			$(' .second',this).html(('0'+remsecond).slice(-2));
			if(remsecond==1) { $(' .secondt',this).html($.words("second",lang)); } else {  $(' .secondt',this).html($.words("seconds",lang)) };
			
		};
		if(state=='counting' && (remsecond==59 || isitfirst == true)){
			
			if(remminute==1) { $(' .minutet',this).html($.words('minute',lang)); } else {  $(' .minutet',this).html($.words("minutes",lang)) };
			if(remhour==1) { $(' .hourt',this).html($.words("hour",lang)); } else {  $(' .hourt',this).html($.words("hours",lang)) };
			if(remday==1) { $(' .dayt',this).html($.words("day",lang)); } else {  $(' .dayt',this).html($.words("days",lang)) };
			if(remmonth==1) { $(' .montht',this).html($.words("month",lang)); } else {  $(' .montht',this).html($.words("months",lang)) };
			if(remyear==1) { $(' .yeart',this).html($.words("year",lang)); } else {  $(' .yeart',this).html($.words("years",lang)) };
			var timestyle='1';
			$(' .tf_cd-body-bottom-big', this).removeClass('tf_cd-body-bottom-big').hide();
			$(' .tf_cd-body-bottom-bigt', this).removeClass('tf_cd-body-bottom-bigt').hide();
			$(' .tf_cd-body-bottom-small', this).removeClass('tf_cd-body-bottom-small').hide();
			$(' .tf_cd-body-bottom-smallt', this).removeClass('tf_cd-body-bottom-smallt').hide();
			if(remminute==0) { timestyle="1"; };
			if(remminute>0) { timestyle="2"; };
			if(remhour>0) { timestyle="3"; };
			if(remday>0) { timestyle="4"; };
			if(remmonth>0) { timestyle="5"; }; 
			if(remyear>0) { timestyle="6"; };
			
			$('.second, .secondt, .minute, .minutet, .hour, .hourt, .day, .dayt, .month, .montht, .year, .yeart',this).hide();
			
			$('.end',this).show();
			if (timestyle=="1") {
				if ($(this).hasClass('tfcd')){ // Countdown Box için bitiş stili
					$(' .tf_cd-body-bottom .second',this).addClass('tf_cd-body-bottom-full').hide().show();
					$(' .tf_cd-body-bottom .end',this).hide(); 
				} else {
					$(' .second',this).show();
					$(' .secondt',this).show();
				}
			} else if (timestyle=='2') {
				$(' .tf_cd-body-bottom .minute',this).addClass('tf_cd-body-bottom-big'); $(' .minute',this).show();
				$(' .tf_cd-body-bottom .second',this).addClass('tf_cd-body-bottom-small'); $(' .second',this).show();
				$(' .tf_cd-body-bottom .minutet',this).addClass('tf_cd-body-bottom-bigt'); $(' .minutet',this).show();
				$(' .tf_cd-body-bottom .secondt',this).addClass('tf_cd-body-bottom-smallt'); $(' .secondt',this).show();
			} else if (timestyle=='3') { 
				$(' .tf_cd-body-bottom .hour',this).addClass('tf_cd-body-bottom-big'); $(' .hour',this).show();
				$(' .tf_cd-body-bottom .minute',this).addClass('tf_cd-body-bottom-small'); $(' .minute',this).show();
				$(' .tf_cd-body-bottom .hourt',this).addClass('tf_cd-body-bottom-bigt'); $(' .hourt',this).show();
				$(' .tf_cd-body-bottom .minutet',this).addClass('tf_cd-body-bottom-smallt'); $(' .minutet',this).show();
			} else if (timestyle=='4') {
				$(' .tf_cd-body-bottom .day',this).addClass('tf_cd-body-bottom-big'); $(' .day',this).show();
				$(' .tf_cd-body-bottom .hour',this).addClass('tf_cd-body-bottom-small'); $(' .hour',this).show();
				$(' .tf_cd-body-bottom .dayt',this).addClass('tf_cd-body-bottom-bigt'); $(' .dayt',this).show();
				$(' .tf_cd-body-bottom .hourt',this).addClass('tf_cd-body-bottom-smallt'); $(' .hourt',this).show();
			} else if (timestyle=='5') {
				$(' .tf_cd-body-bottom .month',this).addClass('tf_cd-body-bottom-big'); $(' .month',this).show();
				$(' .tf_cd-body-bottom .day',this).addClass('tf_cd-body-bottom-small'); $(' .day',this).show();
				$(' .tf_cd-body-bottom .montht',this).addClass('tf_cd-body-bottom-bigt'); $(' .montht',this).show();
				$(' .tf_cd-body-bottom .dayt',this).addClass('tf_cd-body-bottom-smallt'); $(' .dayt',this).show();
			} else if (timestyle=='6') {
				$(' .tf_cd-body-bottom .year',this).addClass('tf_cd-body-bottom-big'); $(' .year',this).show();
				$(' .tf_cd-body-bottom .month',this).addClass('tf_cd-body-bottom-small'); $(' .month',this).show();
				$(' .tf_cd-body-bottom .yeart',this).addClass('tf_cd-body-bottom-bigt'); $(' .yeart',this).show();
				$(' .tf_cd-body-bottom .montht',this).addClass('tf_cd-body-bottom-smallt'); $(' .montht',this).show();
			};
		};
	};
    });
	isitfirst=false;
};


