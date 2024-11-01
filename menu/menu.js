jQuery(window).ready(function(){
    /*
     * Adjust the <html> margin based on the height of the menu bar
     */
    function toastMMsetHeights(){
        if(jQuery('.toast-mm-banner').css('display') == 'block'){
            var mm_bar_height = jQuery('.toast-mm-banner').outerHeight();
            jQuery('body, .toast-mm-menu').css({'padding-top': mm_bar_height});
            jQuery('.toast-mm-overflow').css({'max-height': 'calc(100vh - 50px - '+mm_bar_height+'px)'});
        }else{
            jQuery('body, .toast-mm-menu').css({'padding-top': 0});
        }
    }

    jQuery(window).resize(function(){
            toastMMsetHeights();
    })
    toastMMsetHeights();

    /*
     * Open and close the navigation
     */
    jQuery('.toast-mm-banner__hamburger').on('click', function(){
        if(jQuery('.toast-mm').hasClass('active')){
            jQuery('.toast-mm').removeClass('active');
        }else{
            jQuery('.toast-mm').addClass('active');
        }
    })

    /* 
     * Append arrow icons to links with submenus
     */
    jQuery('.toast-mm .menu-item-has-children > a').append('<div class="toast-mm-open-submenu"><div class="toast-mm-chevron"></div></div>');

    /*
     * Open and close sub-navigation
     */
	function open_sub_menu(sub_menu, sub_menu_trigger){
			if(jQuery(sub_menu_trigger).hasClass('active')){
				jQuery(sub_menu_trigger).removeClass('active');
				var sub_menu_height = jQuery(sub_menu).css({'height': 'auto'}).height();
				jQuery(sub_menu).height(sub_menu_height);
				jQuery(sub_menu).height(0);

				//close child submenus
				jQuery(sub_menu).find('.sub-menu').height(0);
				jQuery(sub_menu_trigger).find('li').removeClass('active');

			}else{
				jQuery(sub_menu_trigger).addClass('active');
				var sub_menu_height = jQuery(sub_menu).css({'height': 'auto'}).height();
				jQuery(sub_menu).height(0);
				jQuery(sub_menu).height(sub_menu_height);

				//amend parent submenus
				jQuery(sub_menu_trigger).parents('.sub-menu').css({'height': 'auto'});
			}
	}
	
	
	
    jQuery('body').on('click','.toast-mm-open-submenu', function(e){
        e.preventDefault();
		e.stopPropagation();
        var sub_menu = jQuery(this).parent('a').parent('.menu-item-has-children').find('.sub-menu')[0];
        var sub_menu_trigger = jQuery(this).parent('a').parent('.menu-item-has-children');
       
        open_sub_menu(sub_menu, sub_menu_trigger);
    })
	
	/* If parent links to itself open sub menu**/
	jQuery('body').on('click','.toast-mm-menu li a', function(e){
		if(jQuery(this).attr('href') == '#'){
			e.preventDefault();
			e.stopPropagation();
			var sub_menu = jQuery(this).parent('.menu-item-has-children').find('.sub-menu')[0];
        	var sub_menu_trigger = jQuery(this).parent('.menu-item-has-children');
       
        	open_sub_menu(sub_menu, sub_menu_trigger);
		}
    })
	

})