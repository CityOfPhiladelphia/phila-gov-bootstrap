/* imgsizer (flexible images for fluid sites) */
var imgSizer={Config:{imgCache:[],spacer:"/path/to/your/spacer.gif"},collate:function(aScope){var isOldIE=(document.all&&!window.opera&&!window.XDomainRequest)?1:0;if(isOldIE&&document.getElementsByTagName){var c=imgSizer;var imgCache=c.Config.imgCache;var images=(aScope&&aScope.length)?aScope:document.getElementsByTagName("img");for(var i=0;i<images.length;i++){images[i].origWidth=images[i].offsetWidth;images[i].origHeight=images[i].offsetHeight;imgCache.push(images[i]);c.ieAlpha(images[i]);images[i].style.width="100%";}
if(imgCache.length){c.resize(function(){for(var i=0;i<imgCache.length;i++){var ratio=(imgCache[i].offsetWidth/imgCache[i].origWidth);imgCache[i].style.height=(imgCache[i].origHeight*ratio)+"px";}});}}},ieAlpha:function(img){var c=imgSizer;if(img.oldSrc){img.src=img.oldSrc;}
var src=img.src;img.style.width=img.offsetWidth+"px";img.style.height=img.offsetHeight+"px";img.style.filter="progid:DXImageTransform.Microsoft.AlphaImageLoader(src='"+src+"', sizingMethod='scale')"
img.oldSrc=src;img.src=c.Config.spacer;},resize:function(func){var oldonresize=window.onresize;if(typeof window.onresize!='function'){window.onresize=func;}else{window.onresize=function(){if(oldonresize){oldonresize();}
func();}}}}

// add twitter bootstrap classes and color based on how many times tag is used
function addTwitterBSClass(thisObj) {
  var title = jQuery(thisObj).attr('title');
  if (title) {
    var titles = title.split(' ');
    if (titles[0]) {
      var num = parseInt(titles[0]);
      if (num > 0)
      	jQuery(thisObj).addClass('label label-default');
      if (num == 2)
        jQuery(thisObj).addClass('label label-info');
      if (num > 2 && num < 4)
        jQuery(thisObj).addClass('label label-success');
      if (num >= 5 && num < 10)
        jQuery(thisObj).addClass('label label-warning');
      if (num >=10)
        jQuery(thisObj).addClass('label label-important');
    }
  }
  else
  	jQuery(thisObj).addClass('label');
  return true;
}

//for the date/time area on the homepage


// as the page loads, call these scripts
jQuery(document).ready(function($) {    
	// modify tag cloud links to match up with twitter bootstrap
	$("#tag-cloud a").each(function() {
	    addTwitterBSClass(this);
	    return true;
	});
	
	$("p.tags a").each(function() {
		addTwitterBSClass(this);
		return true;
	});
	
	$("ol.commentlist a.comment-reply-link").each(function() {
		$(this).addClass('btn btn-success btn-mini');
		return true;
	});
	
	$('#cancel-comment-reply-link').each(function() {
		$(this).addClass('btn btn-danger btn-mini');
		return true;
	});
	
	$('article.post').hover(function(){
		$('a.edit-post').show();
	},function(){
		$('a.edit-post').hide();
	});
	
	// Input placeholder text fix for IE
	// $('[placeholder]').focus(function() {
	//   var input = $(this);
	//   if (input.val() == input.attr('placeholder')) {
	// 	input.val('');
	// 	input.removeClass('placeholder');
	//   }
	// }).blur(function() {
	//   var input = $(this);
	//   if (input.val() == '' || input.val() == input.attr('placeholder')) {
	// 	input.addClass('placeholder');
	// 	input.val(input.attr('placeholder')); 
	//   }
	// }).blur();
	
	// Prevent submission of empty form
	$('[placeholder]').parents('form').submit(function() {
	  $(this).find('[placeholder]').each(function() {
		var input = $(this);
		if (input.val() == input.attr('placeholder')) {
		  input.val('');
		}
	  })
	});
	
	// $('#s').focus(function(){
	// 	if( $(window).width() < 940 ){
	// 		$(this).animate({ width: '200px' });
	// 	}
	// });
	
	// $('#s').blur(function(){
	// 	if( $(window).width() < 940 ){
	// 		$(this).animate({ width: '100px' });
	// 	}
	// });
			
	$('.alert-message').alert();
	
	$('.dropdown-toggle').dropdown();
    
	function clickableBoxes(){
		window.location=$(this).find("a").attr("href"); 
       	return false;
	}
	
    //force trending boxes to be clickable
    $(".trending .no-img").click(clickableBoxes);

	//increase/decrease font size
     $('#incfont').click(function(){    
			curSize= parseInt($('body').css('font-size')) + 2;
  			if(curSize<=20)
			$('body').css('font-size', curSize);
        });  
  	$('#decfont').click(function(){    
        curSize= parseInt($('body').css('font-size')) - 2;
		if(curSize>=12)
        $('body').css('font-size', curSize);
    }); 

    function isHidden(el) {
        return (el.offsetParent === null);
    }
	
/*	function preventDefault(e) {
    	e.preventDefault();
	}
*/
	
/*	navigation! */
	
	//bg fade main nav
    $('#main-nav.navbar-toggle').click(function(e){
        $('#full-page-overlay').fadeToggle(200);
		$('.navbar-default').css('z-index', '99999');//bring to top so users can still search
		$('#side-menu-button').toggleClass('hide');
    });
	
	//collapse menu when overlay is clicked
	$("#full-page-overlay").on('click', function() {
		if ($('.navbar-collapse').hasClass('in')){
			$('#main-nav.navbar-toggle').click();
		}
		if ($('.navmenu-fixed-left').hasClass('in')){
			$('#side-menu-button .side-menu').click();
			$('.side-menu i').removeClass('glyphicon-chevron-left');
			$('.side-menu i').addClass('glyphicon-chevron-right');
		}
		$('body').removeClass('no-scroll');
	});

	
	//bg fade side nav
    $('#side-menu-button .side-menu').click(function(e){
        $('#full-page-overlay').fadeToggle(200);
		$('.navbar-default').css('z-index', '99998'); //send search to back	
		$('.side-menu i').removeClass('glyphicon-chevron-right');
		$('.side-menu i').addClass('glyphicon-chevron-left');
		
		$('body').toggleClass('no-scroll');
		
		if ($('.navmenu-fixed-left').hasClass('in')){
			$('.side-menu i').removeClass('glyphicon-chevron-left');
			$('.side-menu i').addClass('glyphicon-chevron-right');
			//$('body').removeClass('no-scroll');
		}else {
		//	$('body').addClass('no-scroll');
		}
    });
	
	
    $('#full-page-overlay').click(function(e){
        $('#full-page-overlay').fadeOut(200, function(){
            $(".text-size-bubble").fadeOut(100);
            $(".translate-bubble").fadeOut(100);
        });
    });
    
    //accessibility jawns
    $( ".translate-bubble-link").click(function() {
        $(".translate-bubble").fadeToggle("fast");
        
        $(".text-size-bubble").fadeOut("fast");
        $('#full-page-overlay').fadeToggle(200);
		$('.navbar-default').css('z-index', '99998'); //send search to back	
        
         return false;
    }); 
    
    $( ".text-size-bubble-link" ).click(function() {
        $( ".text-size-bubble" ).fadeToggle("fast");
        $(".translate-bubble").fadeOut("fast");
        $('#full-page-overlay').fadeToggle(200);
		$('.navbar-default').css('z-index', '99998'); //send search to back	
     
        return false;
    }); 
   
	
	
	$("#side-nav .menu").addClass("nav nav-pills nav-stacked");
	
	$("#side-nav .sub-menu").addClass("nav nav-pills nav-stacked");
	
	/*$(".widget_nav_menu li").each(function() {
		  if ($(this).hasClass("active"))
				$(this).children().toggle();
		});
	*/
	$('#side-nav .menu-item-has-children ul').hide();
   	$('.current-menu-item').children().show();
	$('.current-menu-ancestor').children().show();
	
	$('.current-menu-item').parent().show();
	$('.current-menu-ancestor').parent().show();


/*homepage */

    //mobile view swiper
    var mySwiper = $('.swiper-container').swiper({
        mode:'horizontal',
        loop: true,
        slidesPerView: 2,
        preventLinks:true
  });

	//make slide boxes clickable
    $(".swiper-slide").click(clickableBoxes);
       
    $(".pick-me").fancySelect({
        forceiOS:true
    });
	
	jQuery.fn.exists = function(){return this.length>0;}
		
	if ($('#side-menu-button').exists()) {
		$('h1.page-header').addClass('h1-push-left');
	}
	
	//for 'yalls trying to re-size the browser window
	$(window).resize(function() {
		$('#full-page-overlay').fadeOut(200);
	});
	
	//init datatables!
	$('.sortable').DataTable({
		paging: false
	});

});


