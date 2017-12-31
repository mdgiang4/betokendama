// JavaScript Document
jQuery(document).ready(function($){	
	// Tabs
	listsTab = $("#voyage-tabs a");
	if ( listsTab.length > 0 ) {
		currentTab = $('#currenttab').val();	
		$(listsTab[currentTab]).addClass("voyage-current");
	}

	$('#voyage-wrapper .voyage-pane').eq($('.voyage-current').index()).show();
		
	$('#voyage-tabs a').click(function() {
		$('#voyage-tabs a').removeClass('voyage-current');
		$(this).addClass('voyage-current');
		$('#voyage-wrapper .voyage-pane').hide();
		$('#voyage-wrapper .voyage-pane').eq($(this).index()).show();
		$('#currenttab').val($(this).index());
	});
});

jQuery(document).ready(function ($) {
    setTimeout(function () {
        $(".fade").fadeOut("slow", function () {
            $(".fade").remove();
        });

    }, 3000);
});
