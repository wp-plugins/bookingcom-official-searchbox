(function($) {
	$(function() {

		// Setup a click handler to initiate the Ajax request and handle the response
		$( '#preview_button' ).click( function() {
			
			var ajax_loader = '<div id=\"bos_ajax_loader\"><h1>Loading...</h1>' ;
				ajax_loader = ajax_loader + '<img src=\"' ;
				ajax_loader = ajax_loader + objectL10n.images_js_path ;
				ajax_loader = ajax_loader + '\/ajax-loader.gif"></div>' ;				
				$( '#bos_preview' ).append( ajax_loader ) ;
				$( '#flexi_searchbox' ).css( 'opacity','0.5' ) ;
			
			var data = {
																
				action : 'bos_preview', // The function for handling the request
				nonce : $( '#bos_ajax_nonce' ).text(),// The security nonce
				aid : $( '#aid' ).val(), // bgcolor
				destination : $( '#destination' ).val(), // destination				
				widget_width : $( '#widget_width' ).val(), // widget_width
				calendar : $( '#calendar:checked' ).val(), // calendar
				flexible_dates : $( '#flexible_dates:checked' ).val(), // flexible dates
				month_format : $( '.month_format:checked' ).val(), // logodim
				logodim : $( '.logodim:checked' ).val(), // logodim
				logopos : $( '#logopos' ).val(), // logopos				
				bgcolor : $( '#bgcolor' ).val(), // bgcolor
				textcolor : $( '#textcolor' ).val(), // textcolor
				submit_bgcolor : $( '#submit_bgcolor' ).val(), // submit_bgcolor
				submit_bordercolor : $( '#submit_bordercolor' ).val(), // submit_bordercolor
				submit_textcolor : $( '#submit_textcolor' ).val(), // submit_textcolor
				maintitle : $( '#maintitle' ).val(), // maintitle
				checkin : $( '#checkin' ).val(), // checkin
				checkout : $( '#checkout' ).val(), // checkout
				submit : $( '#submit' ).val() // submit				
		
			};
			
			$.post( ajaxurl, data , function( response ) {			
				
				$( '#bos_preview' ).html( response ) ;
				$( '#flexi_searchbox' ).css( 'opacity','1' ) ;
				$( '#bos_ajax_loader' ).empty() ;														

			});		


		});// $('#preview_button').click( function()	


	});
})(jQuery);
