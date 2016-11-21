/* Anime Scroll
=========================================== */
	jQuery.easing.quart = function(x, t, b, c, d){
	return -c * ((t=t/d-1)*t*t*t - 1) + b;
	};
		var aniscroll = {
		setInit : function(){
			$('a[href*=#],area[href*=#]').click(function(){
			if(location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname){
				var $target = $(this.hash);
				$target = $target.length && $target || $('[name='+this.hash.slice(1)+']');
				if($target.length){
					var targetOffset = $target.offset().top;
					var targetTag = navigator.appName.match(/Opera/)? "html" : "html,body";
					$(targetTag).animate({scrollTop: targetOffset}, 'quart');
					return false;
				}
			}
			});
		}
		}
	
/* effectButtonSocial
=========================================== */

var effectButtonSocial = {
	setInit : function(){
		$(".btn-list-share").click(function(){
			$objSocial = $(this);
			
			if(!$objSocial.hasClass("open")) {
				$(".btn-list-share").removeClass("open").next(".list-social").hide()
				$objSocial.addClass("open").next(".list-social").show();
			}else {
				$objSocial.removeClass("open").next(".list-social").hide();
			}
			
			$objSocial.next(".list-social").mouseleave(function(){
				$objSocial.removeClass("open").next(".list-social").hide();
			});
		});
	}
}


/* socialButtonWindown
=========================================== */
var socialButtonWindown = {
	setInit : function(){
		$(".btn-social").click(function(){
			// get url
			var url = $(this).attr("href");
			
			// open new windown
			window.open(url, 'snswindow', 'width=550, height=450,personalbar=0,toolbar=0,scrollbars=1,resizable=1');
			return false;
		});
	}
}


/* confirmBox
=========================================== */
var confirmBox = {
	setInit : function(){
		
		$(".confirm").click(function(){
			$objBtn = $(this);
		    var objDialog =	$objBtn.parent().next(".dialog-confirm");
			$(".dialog-confirm-inner").hide();
			objDialog.find(".dialog-confirm-inner").show();
		});
		
		$(".btn-cancel").click(function(){
			$(this).closest(".dialog-confirm-inner").hide();
		});
	}
}


/* dragHover
=========================================== */
var dragHover = {
	setInit : function(){
		$(".drag-frame").on({
            dragleave: function() {
				$(this).removeClass("d-over");
            },
            dragover: function(e) {
                e.preventDefault(); // Chrome / Safari
				$(this).addClass("d-over");
            },
            drop: function(e) {
				$(this).removeClass("d-over");
            }
        });	
	}
}


/* effectButtonSocial
=========================================== */

var scrollThumbnails = {
	setInit : function(){
		// Declare
		var objWrapper = $(".lyt-list-thumbnails");
		var barControl = $(".control-bar");
		var prevBtn = $(".lyt-list-thumbnails").find(".prev-area");
		var nextBtn = $(".lyt-list-thumbnails").find(".next-area");
		var barWidth = 12;
		var currentWidth = 900;
		var scrollWidth = 0;
		var middleLeft = 0;
		var easingTime = 2000;
		var borderWidth = 4;
		
		
		// set width for control bar
		barControl.find("li").each(function(i, e) {
            barWidth = barWidth + $(this).width() + borderWidth + 12 ; 
		});
		barControl.width(barWidth);
		
		//check max width higher 900px
		if(barWidth > currentWidth) {
			//
			scrollWidth = barWidth - currentWidth
			middleLeft = -(scrollWidth/2);
			barControl.css("left", middleLeft); 
			
			//
			nextBtn.hover(function() {
				nextBtn.css("z-index","10");
				prevBtn.css("z-index","10");
                barControl.animate({ "left": -scrollWidth }, easingTime, function(){
					nextBtn.css("z-index","-1");
				});
            },function(){
				barControl.animate().stop();
			});
			
			//
			prevBtn.hover(function() {
				nextBtn.css("z-index","10");
				prevBtn.css("z-index","10");
                barControl.animate({ "left": 0 }, easingTime, function(){
					prevBtn.css("z-index","-1");
				});
            },function(){
				barControl.animate().stop();
			});
		} 
		else {
			prevBtn.hide();
			nextBtn.hide();
		}
	}
}

/* ===========================================
* START
=========================================== */
	$(document).ready(function(){
		
		// Anime Scroll
		aniscroll.setInit();
		
		// Social Button Effect
		effectButtonSocial.setInit();
		
		//
		socialButtonWindown.setInit();
		
		// login-popup
		$(".iframe").colorbox({
			iframe:true,
			//href:'/login/login_popup.html ', 
			innerWidth:700, 
			innerHeight:150
		});
		
		
		$(".iframe-max-vote").colorbox({
			iframe:true,
			//href:'modal/max_vote.html ', 
			innerWidth:700, 
			innerHeight:149
		});
		
		// confirm popup
		confirmBox.setInit();
		
		// drag and drop hover
		dragHover.setInit();
	}); 
	
	jQuery(window).load(function() {
    	scrollThumbnails.setInit();
	});
	
