// Can also be used with $(document).ready()
jQuery(window).load(function(){
  jQuery('.flexslider').flexslider({
	animation: "fade",
	slideshowSpeed: mt_script_vars.cap_slider_time,
	slideshow: mt_script_vars.cap_slider_slideshow
  });
});



jQuery(document).ready(function(){
	jQuery.fn.exists = function(){return this.length>0;}
	if (jQuery('.visual a').exists()) {
		jQuery('.visual a').animate({"opacity":"0"});
		jQuery('.visual a').hover(function(){
			jQuery(this).stop().animate({"opacity":"1"}, 300);
		},
		function(){
			jQuery(this).stop().animate({"opacity":"0"}, 300);
		});
	}
	if (jQuery('.item-list a').exists()) {
		jQuery('.item-list a').css({"color":"#3c3e3f"});
		jQuery('.item-list a').hover(function(){
			jQuery(this).stop().animate({"color":"#dd5c1a"}, 300);
		},
		function(){
			jQuery(this).stop().animate({"color":"#3c3e3f"}, 300);
		});
	}
	if (jQuery('.item-box .more').exists()) {
		jQuery('.item-box .more').css({"color":"#444444"});
		jQuery('.item-box .more').hover(function(){
			jQuery(this).stop().animate({"color":"#d85a19"}, 300);
		},
		function(){
			jQuery(this).stop().animate({"color":"#444444"}, 300);
		});
	}
	if (jQuery('.news h3 a').exists()) {
		jQuery('.news h3 a').hover(function(){
			jQuery(this).stop().animate({"color":"#df6629"}, 300);
		},
		function(){
			jQuery(this).stop().animate({"color":"#343638"}, 300);
		});
	}
	if (jQuery('.preview-block .preview .caption').exists()) {
		jQuery('.preview-block .preview .caption').css({"color":"#444444"});
		jQuery('.preview-block .preview .caption').hover(function(){
			jQuery(this).stop().animate({"color":"#dd5c1a"}, 300);
		},
		function(){
			jQuery(this).stop().animate({"color":"#444444"}, 300);
		});
	}
	if (jQuery('.catalog a').exists()) {
		jQuery('.catalog a').css({"color":"#444444"});
		jQuery('.catalog a').hover(function(){
			jQuery(this).stop().animate({"color":"#dd5c1a"}, 300);
		},
		function(){
			jQuery(this).stop().animate({"color":"#444444"}, 300);
		});
	}
	if (jQuery('.visual .mask').exists()) {
		jQuery('.visual .mask').animate({"opacity":"0"});
		jQuery('.visual .mask').hover(function(){
			jQuery(this).stop().animate({"opacity":"1"}, 300);
		},
		function(){
			jQuery(this).stop().animate({"opacity":"0"}, 300);
		});
	}
	if (jQuery('.footer-social a').exists()) {
		jQuery('.footer-social a').hover(function(){
			jQuery(this).stop().animate({"color":"#dd5d1c"}, 300);
		},
		function(){
			jQuery(this).stop().animate({"color":"#dcdbd0"}, 300);
		});
	}
	if (jQuery('.footer-nav a').exists()) {
		jQuery('.footer-nav a').hover(function(){
			jQuery(this).stop().animate({"color":"#dd5e1d"}, 300);
		},
		function(){
			jQuery(this).stop().animate({"color":"#a19f95"}, 300);
		});
	}
	if (jQuery('.bullet-list a').exists()) {
		jQuery('.bullet-list a').hover(function(){
			jQuery(this).stop().animate({"color":"#d85a19"}, 300);
		},
		function(){
			jQuery(this).stop().animate({"color":"#3c3e3f"}, 300);
		});
	}
});


//counter for product page
jQuery(document).ready(function(){
	jQuery('.inc').click(function() {
		 var curval = jQuery(".numvalue").val();
		 curval = parseInt(curval);
		 curval = curval + 1;
		 jQuery(".numvalue").val(curval);
	});
});
jQuery(document).ready(function(){
	jQuery('.dec').click(function() {
		 var curval = jQuery(".numvalue").val();
		 curval = parseInt(curval);
		 curval = curval - 1;
		 if (curval <= 0){ curval = 0;}
		 jQuery(".numvalue").val(curval);
	});
});
