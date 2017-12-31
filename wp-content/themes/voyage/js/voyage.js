jQuery(document).ready(function($){
	
	$(".toggle-off div").hide();

	$("p.toggle-title").click(function(){
		$(this).toggleClass("active").next().slideToggle("slow");
	});
	
	$(".carousel-control.left").click(function(){
		$(".carousel").carousel('prev');
		return false;
	});

	$(".carousel-control.right").click(function(){
		$(".carousel").carousel('next');
		return false;
	});	
	//Add Pretty Print class
	$("#content pre").addClass("prettyprint");
	
	// Back-to-top Script
	$(".back-to-top").hide();
	// fade in back-to-top 
	$(window).scroll(function () {
		if ($(this).scrollTop() > 500) {
			$('.back-to-top').fadeIn();
		} else {
			$('.back-to-top').fadeOut();
		}
	});
	
	// scroll body to 0px on click
	$('.back-to-top a').click(function () {
		$('body,html,header').animate({
			scrollTop: 0
		}, 800);
		return false;
	});
	//Mobile
	if ( jQuery.mobileMenu ) {
		$('.top-menu .menu').mobileMenu({
			prependTo:'.top-menu',
			topOptionText:'Menu',
			groupPageText:''
		});		
	}
	
	if( jQuery.colorbox ) {
		$('.format-gallery a[href$=".jpg"],.format-gallery a[href$=".jpeg"],.format-gallery a[href$=".png"],.format-gallery a[href$=".gif"]').colorbox({
			slideshow:'true',
			slideshowSpeed:'5000',
			maxWidth:'100%',
			maxHeight:'100%',
			rel:'gallery',
			fixed:'true'
		});	
	}

	if( jQuery.skitter ) {
		$('.box_skitter').skitter({
		theme: 'clean',
		numbers_align: 'right',
		dots: true, 
		preview: true,
		interval: 5000,
		show_randomly: true
		});
	}
});

(function($) {
  $(function(){	

	var $col = $('#portfolio-column').val();
	
	if ($col > 0) {
		
	var $container = $('#content');
    $container.imagesLoaded(function(){
		$container.masonry({
    		itemSelector : '.item',
	  		isAnimated: true,
  			columnWidth: function( containerWidth ) {
				return containerWidth / $col;
  			},
  		});
    });
		
	$container.infinitescroll({
      navSelector  : '#nav-below',
      nextSelector : '#nav-below a.next.page-numbers',
      itemSelector : '.item',     // selector for all items you'll retrieve
      loading: {
          finishedMsg: '<em>All items are loaded.</em>',
		  msgText: '<em>Loading...</em>'
        		}
     },
     // trigger Masonry as a callback
	function( newElements ) {
        // hide new items while they are loading
        var $newElems = $( newElements ).css({ opacity: 0 });
        // ensure that images load before adding to masonry layout
        $newElems.imagesLoaded(function(){
          // show elems now they're ready
          $newElems.animate({ opacity: 1 });
          $container.masonry( 'appended', $newElems, true ); 
        });
    });		
		
	}

	var $window = $(window);
	// make code pretty
	window.prettyPrint && prettyPrint();		

  });	
})(jQuery);
