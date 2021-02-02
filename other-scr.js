$(window).on('load', function () {
$(".top .navigation").prepend('<div class="btn-nav"></div>');	
	$(".top .navigation.nav-top li").on('mouseenter',function () {
	if ($( window ).width() >= 1025 ) {
	$('ul', this).addClass('ul-hov');
	}	
    });
	$(".top .navigation.nav-top li").on('mouseleave',function () {
	if ($( window ).width() >= 1025 ) {
	$('ul', this).removeClass('ul-hov');
	}	
    });
	$(".navigation.nav-left ul li .drp-ic").click(function () { 	
	 $(this).next().toggle();
	});
	$(".navigation.nav-left ul li .drp-ic").click(function () {	
	 $(this).toggleClass("drp-ic-cl");
	});
    //$( ".navigation ul li ul" ).before('<span class="drp-ic"><i class="fas fa-angle-down"></i></span>');
  $(window).resize(function () { 
	if ($( window ).width() >= 1025 ) {
	$('.navigation.nav-top ul').show();
	$('.navigation.nav-top ul li ul').removeClass('ul-hov');
	$('.navigation.nav-top ul li ul li ul').addClass('ul-hov');
	}
	$(".navigation.nav-top li").on('mouseenter',function () {
	if ($( window ).width() >= 1025 ) {
	$('ul', this).addClass('ul-hov');
	}	
    });
	$(".navigation.nav-top li").on('mouseleave',function () {
	if ($( window ).width() >= 1025 ) {
	$('ul', this).removeClass('ul-hov');
	}	
    });
	$(".navigation.nav-left ul li .drp-ic").click(function () { 	 
	 if ($( window ).width() <= 1024 ) {	 	 
	 $(this).next().toggle();
	 }
	});
    if ($( window ).width() <= 1024 ) {
	$('.ltop').removeClass('ltop-act');$('.lcent').removeClass('lcent-act');$('.lbotm').removeClass('lbotm-act');	
	$('.navigation ul').hide();	
	$(".drp-ic").removeClass("drp-ic-cl");
	}
  });
  $(".btn-nav").html('<span class="mline ltop"></span><span class="mline lcent"></span><span class="mline lbotm"></span>');				
	 $(".btn-nav").click(
	 function () {
	 $('.ltop').toggleClass('ltop-act');$('.lcent').toggleClass('lcent-act');$('.lbotm').toggleClass('lbotm-act');
	 if ($( window ).width() <= 1024 ) {
	 $('.top .navigation ul').slideToggle();
	 $('.top .navigation ul li ul').hide();
	 $('.top .navigation ul li ul li ul').hide();
	 $(".drp-ic").removeClass("drp-ic-cl");

	 }
	 });
	 $(".top .navigation ul li a").click(
	 function () {
	 if ($( window ).width() <= 1024 ) {
	 $('.top .navigation ul').hide();
	 $('.ltop').removeClass('ltop-act');$('.lcent').removeClass('lcent-act');$('.lbotm').removeClass('lbotm-act');
	 }
	 });
	 $(".top .navigation ul li .drp-ic").click(
	 function () {
	 if ($( window ).width() <= 1024 ) {	 	 
	 $(this).next().toggle();
	 }
	 });
	 $(".top .navigation .drp-ic").click(
	 function () {
	 if ($( window ).width() <= 1024 ) {	
	 $(this).toggleClass("drp-ic-cl");
	 }
	 });
	var top_h = $('.top').height();
	$('.top-h').text(top_h);
	var body_cont = $(".body-content");
	var foot_web = $(".footer");
	var body_cont_h = body_cont.height();
	$(".page-h").text(body_cont_h);
	var wind_h = $(window).height();
	$(".wind-h").text(wind_h);
	var footer_h = foot_web.height();
	var new_wind_h = wind_h - top_h;
	var new_wind_h_2 = new_wind_h - footer_h;
	$(".new-h").text(new_wind_h_2);
	/*if(body_cont_h < wind_h){
		body_cont.height(new_wind_h_2);
    }*/
	$('.wrap_page').css('padding-top', top_h-2);
	$(window).resize(function () {
		//if($(window).width() >= 651){
		var top_h = $('.top').height();
        $('.top-h').text(top_h);
        $('.wrap_page').css('padding-top', top_h-2);
		//}
	});
	$(window).scroll(function() {
		var topPos = $( window ).scrollTop();
		if (topPos >= 0) {
			var top_h = $('.top').height();
            $('.top-h').text(top_h);
            $('.wrap_page').css('padding-top', top_h-2);
		}
		
	});
});
$(document).ready(function () {
$(window).scroll(function() {
 var topPos = $( window ).scrollTop();
 if (topPos >= 500) {
	 $(".btn-top").fadeIn();
	 }
	 else{
	$(".btn-top").fadeOut();
	}
});
$(".btn-top").click(
	function () {
	//$(window).scrollTop(0);
	$("html, body").animate({
    scrollTop:0
   }, 300);
	return false;
});
    
var btn_frm_log = $("#btnFrmLogin");

$(btn_frm_log).click(function () {
   var reqFld = $("#loginForm .req-fld");
   var u_name = $("#username");
   var u_name_val = u_name.val();
   var u_pass = $("#password");
   var u_pass_val = u_pass.val();
   setTimeout(function(){ $(".errMsg").hide();$(".wrap-field").removeClass("redFld"); }, 10000); 
   $.each(reqFld,function(){
		var txtReqFld = $(this);
		var txtReqVal = txtReqFld.val();
	     if(txtReqVal.length < 1){
		   txtReqFld.parent(".wrap-field").addClass("redFld");
		   txtReqFld.prev(".errMsg").show();
		   setTimeout(function(){ $(".errMsg").hide();$(".wrap-field").removeClass("redFld"); }, 10000);
	     }
	   });
	   if( u_name_val.length < 3 || u_name_val.length > 10){
		  $(u_name).parent(".wrap-field").addClass("redFld");
		  $(u_name).parent(".wrap-field").children(".errMsg").show();
		  return false; 
	   }
	   else if(u_pass_val.length < 8 || u_pass_val.length > 20){
		  $(u_pass).parent(".wrap-field").addClass("redFld");
		  $(u_pass).parent(".wrap-field").children(".errMsg").show();
		   return false; 
	   }
	   else
	   {
		return true;
	   }
    
   });
var btn_frm_reg = $("#btnFrmReg");
$(btn_frm_reg).click(function () {
   var reqFld = $("#RegForm .req-fld");
   var f_name = $("#fname");
   var f_name_val = f_name.val();
   var l_name = $("#fname");
   var l_name_val = l_name.val();
   var email_add = $("#email");
   var email_add_val = email_add.val();
   setTimeout(function(){ $(".errMsg").hide();$(".wrap-field").removeClass("redFld"); }, 10000); 
   $.each(reqFld,function(){
		var txtReqFld = $(this);
		var txtReqVal = txtReqFld.val();
	     if(txtReqVal.length < 1){
		   txtReqFld.parent(".wrap-field").addClass("redFld");
		   txtReqFld.prev(".errMsg").show();
		   setTimeout(function(){ $(".errMsg").hide();$(".wrap-field").removeClass("redFld"); }, 10000);
	     }
	   });
	   if( f_name_val.length < 3 || f_name_val.length > 10){
		  $(f_name).parent(".wrap-field").addClass("redFld");
		  $(f_name).parent(".wrap-field").children(".errMsg").show();
		  return false; 
	   }
	   else if(l_name_val.length < 8 || l_name_val.length > 20){
		  $(l_name).parent(".wrap-field").addClass("redFld");
		  $(l_name).parent(".wrap-field").children(".errMsg").show();
		   return false; 
	   }
	   else if(email_add_val.length < 10 || email_add_val.length > 100){
		  $(email_add).parent(".wrap-field").addClass("redFld");
		  $(email_add).parent(".wrap-field").children(".errMsg").show();
		   return false; 
	   }
	   else
	   {
		return true;
	   }
    
   });
});
	