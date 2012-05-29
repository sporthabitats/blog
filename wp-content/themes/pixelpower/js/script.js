jQuery.noConflict();
jQuery(function($) { 

	
	
	
	/* Drop Down Menu (superfish + hoverintent + supersubs)
	___________________________________________________________________ */
	// http://users.tpg.com.au/j_birch/plugins/superfish/#getting-started
	// http://users.tpg.com.au/j_birch/plugins/superfish/#options
	$("ul.sf-menu").supersubs({ 
            minWidth:    10,   // minimum width of sub-menus in em units 
            maxWidth:    20,   // maximum width of sub-menus in em units 
            extraWidth:  1     // extra width can ensure lines don't sometimes turn over 
                               // due to slight rounding differences and font-family 
        }).superfish({			
			dropShadows:    false,
			delay:			400
			
							}); // call supersubs first, then superfish, so that subs are 
                         		// not display:none when measuring. Call before initialising 
                         		// containing tabs for same reason. 

	
	
	/* Alternate Menu, on change of dropdown go to url
	___________________________________________________________________ */	
	$("#navigation-small").change(function() {
		window.location = $(this).find("option:selected").val();
	});




	/* Tipsy Tooltip Setup
	___________________________________________________________________ */	
	$('.tooltip, .flickr_badge_image img').tipsy({gravity: $.fn.tipsy.autoNS, opacity: 1});	
	$('.bio-social-links a').tipsy({gravity: 's', opacity: 1, offset: 2});
	$('.image-caption a').tipsy({gravity: 'w', opacity: 1});
	$('a#scroll-top').tipsy({ gravity: 'se' });




	/* Focus on search form hover
	___________________________________________________________________ */	
	$("#s").hover(function(){
		$(this).focus();
	});	
	
	
	
	
	/* Scroll to top animation
	___________________________________________________________________ */
	$('#scroll-top').click(function(){ 
		$('html, body').animate({scrollTop:0}, 600); return false; 
	});
	
	
	
	/* Hide Parent Elem
	___________________________________________________________________ */
	$('.hideparent').click(function(){ 
		$(this).parent().fadeOut(); 
		return false; 
	});
	
	
	
	
	/* Portfolio Filter	
	___________________________________________________________________ */
	$('.portfolio-filter a').click(function(){ 		
		// remove current on all
		$('.portfolio-filter a').removeClass('current');		
		var portfolio_wrap = $('.portfolio-item-wrap');
		var tag = $(this).attr('class');		
		// add current on current filter
		$(this).addClass('current');		
		if(tag === 'tag-all') {  
            $(portfolio_wrap).find('article').stop().fadeTo(500, 1);  
        } else {  
            $(portfolio_wrap).find('article').each(function() {  
                if(!$(this).hasClass(tag)) {  
                    $(this).stop().fadeTo(500, .2);
                } else {  
                    $(this).stop().fadeTo(500, 1);  
                }  
            });  
        }  		
		return false;
	});
	
	
	
	

	/* WordPress [gallery] shortcode, adding clearfix to clean up some issues in IE
	___________________________________________________________________ */
	$('div.gallery').addClass('clearfix');
	
	


}); // end jQuery dom ready