jQuery(document).ready(function($){
	
	$( "#page_template" ).change(function(){
		voyageTemplate($(this).val());
	});

	function voyageTemplate(template){
		$( "#voyage-page-meta" ).hide();

		if ( 'page-templates/blog.php' == template
			|| 'page-templates/blog-sticky.php' == template ) {
			$( "#p_voyage_category" ).show();
			$( "#p_voyage_postperpage" ).show();
			$( "#p_voyage_sidebar" ).show();
			$( "#p_voyage_title" ).show();
			$( "#p_voyage_column" ).hide();
			$( "#p_voyage_thumbnail" ).hide();
			$( "#p_voyage_size_x" ).hide();
			$( "#p_voyage_size_y" ).hide();
			$( "#p_voyage_intro" ).hide();
			$( "#p_voyage_disp_meta" ).hide();

			$( "#voyage-page-meta" ).show();
		}
		else if ( 'page-templates/atozindex.php' == template
			|| 'page-templates/portfolio.php' == template
			|| 'page-templates/portfolio-dynamic.php' == template ) {
			$( "#p_voyage_category" ).show();
			$( "#p_voyage_postperpage" ).show();
			$( "#p_voyage_sidebar" ).show();
			$( "#p_voyage_title" ).show();
			$( "#p_voyage_column" ).show();
			$( "#p_voyage_thumbnail" ).show();
			$( "#p_voyage_size_x" ).show();
			$( "#p_voyage_size_y" ).show();
			$( "#p_voyage_intro" ).show();
			$( "#p_voyage_disp_meta" ).show();

			$( "#voyage-page-meta" ).show();
		}
		else if ( 'page-templates/imageslider.php' == template ) {
			$( "#p_voyage_category" ).show();
			$( "#p_voyage_postperpage" ).show();
			$( "#p_voyage_sidebar" ).show();
			$( "#p_voyage_title" ).hide();
			$( "#p_voyage_column" ).hide();
			$( "#p_voyage_thumbnail" ).show();
			$( "#p_voyage_size_x" ).show();
			$( "#p_voyage_size_y" ).show();
			$( "#p_voyage_intro" ).hide();
			$( "#p_voyage_disp_meta" ).hide();

			$( "#voyage-page-meta" ).show();
		}
	}
	
	voyageTemplate( $( "#page_template" ).val() );
});
