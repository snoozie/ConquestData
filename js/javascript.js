$(document).ready(function() {
    /*
     *  Simple image gallery. Uses default settings
     */

    $('.fancybox').fancybox();
	$("#give_pass").fancybox({
	maxWidth	: 960,
		maxHeight	: 600,
		fitToView	: false,
		width		: '90%',
		height		: '90%',
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none',
    iframe: {
	    scrolling : 'auto',
	    preload   : true
    },
          helpers: {
              title : {
                  type : 'float'
              }
          }
      });
});

