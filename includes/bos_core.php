<?php 

/**
 * CORE SCRIPT
 * ----------------------------------------------------------------------------
 */




register_activation_hook( BOS_PLUGIN_FILE , 'bos_searchbox_install' );
function bos_searchbox_install() {
            
        //this install defaults values
        $bos_searchbox_options = array( 
        
            'calendar' => 0, //default value for calendar ( not visible )
            'flexible_dates' => 1, //default value for flexible dates feature ( visible )
            'month_format' => 'short', //default value for calendar month format
            'logodim' => 'blue_150x25', //default booking.com color/dimension
            'logopos' => 'left', //default booking.com position        
            'textcolor' => '#003580', //default text color of B.com searchbox
            'bgcolor' => '#FEBA02', //default background color of B.com searchbox
            'submit_bgcolor' => '#0896FF', //default background color for submit
            'submit_bordercolor' => '#0896FF', //default boredr color for submit
            'submit_textcolor' => '#FFFFFF', //default text color for submit
            'target_page' => 'http://www.booking.com/searchresults.html', //default landing page
            'plugin_ver' => BOS_PLUGIN_VERSION //plugin version       
        );
        
        update_option( 'bos_searchbox_options', $bos_searchbox_options ) ;
        
}

// Add settings link on plugin page
add_filter( 'plugin_action_links_'.BOS_PLUGIN_FILE , 'bos_searchbox_settings_link' ) ;
function bos_searchbox_settings_link( $links ) {
     
  $settings_link = '<a href="options-general.php?page=bos_searchbox.php">' . __('Settings', BOS_TEXT_DOMAIN) . '</a>' ; 
  array_unshift( $links, $settings_link ); 
  return $links; 
  
}

// Add a menu for our option page
add_action('admin_menu', 'bos_searchbox_add_page') ;
function bos_searchbox_add_page() {
    
    add_options_page( 
        'Booking.com searchbox settings', // Page title on browser bar 
        'Booking.com searchbox', // menu item text
        'manage_options', // only administartors can open this
        'bos_searchbox', // unique name of settings page
        'bos_searchbox_option_page' //call to fucntion which creates the form
     );
     
}

/* Localization and internazionalization */
add_action('plugins_loaded', 'bos_searchbox_init');   
function bos_searchbox_init() {
    load_plugin_textdomain( BOS_TEXT_DOMAIN, false, dirname( BOS_PLUGIN_FILE ) . '/languages/' ); 
}

/* Ajax for searchbox preview */
add_action( 'wp_ajax_bos_preview', 'bos_ajax_preview' );
function bos_ajax_preview() {    
    
    if( isset( $_REQUEST[ 'nonce' ] ) ) {

        // Verify that the incoming request is coming with the security nonce
        if( wp_verify_nonce( $_REQUEST[ 'nonce' ] , 'bos_ajax_nonce' ) ) {
            
            $arrayFields = bos_searchbox_settings_fields_array();
            
            foreach( $arrayFields as $field) {
                
                if ( $field[ 1 ] == 'text' || $field[ 1 ] == 'radio' || $field[ 1 ] == 'select' ) {                 
                        
                    $options[ $field[ 0 ] ] = isset( $_REQUEST[ $field[ 0 ] ] ) ? stripslashes ( sanitize_text_field ( $_REQUEST[ $field[ 0 ] ] ) ) : '' ;                    
                    
                } //if ( $field[ 1 ] == 'text' )
               
               
                elseif ( $field[ 1 ] == 'checkbox'  ) {
                   
                    if ( $field[ 0 ] == 'calendar' ) {
                    
                        $options[ $field[ 0 ] ] = empty( $_REQUEST[ 'calendar' ] ) ? 0 : 1;                        
                        
                    } //if ( $field[ 0 ] == 'calendar' )
                    
                   if ( $field[ 0 ] == 'flexible_dates' ) {
                    
                        $options[ $field[ 0 ] ] = empty( $_REQUEST[ 'flexible_dates' ] ) ? 0 : 1;                        
                        
                    } //if ( $field[ 0 ] == 'flexible_dates' )
                    
                }
        
            } //foreach( $arrayFields as $field)
            
            $preview = true;                       
            
            echo '<div id="bos_preview_title"><img src="' . BOS_IMG_PLUGIN_DIR . '/preview_title.png" alt="Preview" /></div>' ;
            bos_create_searchbox( $options , $preview ) ;
            
            die() ;
    
        } else {
                     
             die( 'There was an issue in the preview statement' ) ;
    
        } 
    
    }

}

// Create the searchbox
function bos_create_searchbox( $searchbox_options, $preview ) {
    
    $options = $searchbox_options ;
    $preview_mode = $preview ? $preview : false ;
        
    
    // Set variables for the searchbox: if none the default values will be used
    $destination = !empty( $options[ 'destination' ] ) ? $options[ 'destination' ] : '' ;
    $widget_width = !empty( $options[ 'widget_width' ] ) ? $options[ 'widget_width' ] : '' ;
    $calendar = !empty( $options[ 'calendar' ] ) ? $options[ 'calendar' ] : 0 ;
    $flexible_dates = !empty( $options[ 'flexible_dates' ] ) ? $options[ 'flexible_dates' ] : 0 ;
    $month_format = !empty(  $options[ 'month_format' ] ) ? $options[ 'month_format' ] : '' ;
    $logodim = !empty( $options[ 'logodim' ] ) ? $options[ 'logodim' ] : 'blue_150x25' ;
    $logopos = !empty(  $options[ 'logopos' ] ) ? $options[ 'logopos' ] : 'left' ;
    $textcolor = !empty(  $options[ 'textcolor' ] ) ? $options[ 'textcolor' ] : '#003580' ;
    $bgcolor = !empty(  $options[ 'bgcolor' ] ) ? $options[ 'bgcolor' ] : '#FEBA02' ;
    $submit_bgcolor = !empty(  $options[ 'submit_bgcolor' ] ) ? $options[ 'submit_bgcolor' ] : '#0896FF' ;   
    $submit_bordercolor = !empty( $options[ 'submit_bordercolor' ] ) ? $options[ 'submit_bordercolor' ] : '#0896FF' ;
    $submit_textcolor = !empty( $options[ 'submit_textcolor' ] ) ? $options[ 'submit_textcolor' ] : '#FFFFFF' ;   
    $maintitle = !empty( $options[ 'maintitle' ] ) ? $options[ 'maintitle' ] : __( 'Need a hotel?', BOS_TEXT_DOMAIN ) ;
    $checkin = !empty( $options[ 'checkin' ] ) ? $options[ 'checkin' ] : __( 'check-in date', BOS_TEXT_DOMAIN ) ;
    $checkout = !empty( $options[ 'checkout' ] ) ? $options[ 'checkout' ] : __( 'check-out date', BOS_TEXT_DOMAIN ) ;
    $submit = !empty( $options[ 'submit'] ) ? $options[ 'submit'] : __( 'search', BOS_TEXT_DOMAIN ) ;     
    
    // Set the default searchresults page
    $target_page = !empty( $options[ 'target_page'] ) ? $options[ 'target_page'] : 'http://www.booking.com/searchresults.html' ;
    
    // Set the default aid if no aid provided
    $aid = empty( $options[ 'aid' ] ) || !is_numeric( $options[ 'aid' ] ) || $options[ 'aid' ] == '' || $options[ 'aid' ] == ' '  ? BOS_DEFAULT_AID  : $options[ 'aid' ] ;

    include BOS_INC_PLUGIN_DIR . '/bos_searchbox.php' ; 
         
}

?>