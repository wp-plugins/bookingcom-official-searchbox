<?php

/**
 * INITIALIZE CSS AND SCRIPT
 * ----------------------------------------------------------------------------
 */

// Register our style to WP
add_action( 'init', 'bos_searchbox_add_styles' ) ;
function bos_searchbox_add_styles() {
    //wp_register_style( $handle, $src, $deps, $ver, $media );
    wp_register_style( 'bos_cp_main_css', BOS_JS_PLUGIN_DIR . '/colorpicker/css/colorpicker.css' ) ;
    wp_register_style( 'bos_settings_css', BOS_CSS_PLUGIN_DIR . '/bos_settings.css', '' , '1.1' ) ;
    wp_register_style( 'bos_sb_main_css', BOS_CSS_PLUGIN_DIR . '/bos_searchbox.css', '' , '1.1' ) ;
}

// Add style just for admin settings page
add_action('admin_print_styles-settings_page_bos_searchbox', 'bos_searchbox_add_settings_styles') ;
function bos_searchbox_add_settings_styles() {
        
    //Add here just color picker style in plugin settings page only
    wp_enqueue_style( 'bos_cp_main_css' ) ;
    wp_enqueue_style( 'bos_settings_css' ) ;
    wp_enqueue_style( 'bos_sb_main_css' ) ;
    
}    

// Register our scripts to WP
add_action( 'init', 'bos_searchbox_add_scripts' ) ;
function bos_searchbox_add_scripts() {
        
    wp_enqueue_script( 'jquery' );
    //wp_register_script( $handle, $src, $deps, $ver, $in_footer );
    wp_register_script( 'bos_main_js', BOS_JS_PLUGIN_DIR . '/bos_main.js', '', '1.0', true ) ;
    wp_register_script( 'bos_date_js', BOS_JS_PLUGIN_DIR . '/bos_date.js', '', '1.0', true ) ;
    wp_register_script( 'bos_general_js', BOS_JS_PLUGIN_DIR . '/bos_general.js', '', '1.1', true ) ;    
    wp_register_script( 'bos_cp_main_js', BOS_JS_PLUGIN_DIR .'/colorpicker/js/colorpicker.js', array('jquery'), '', true ) ;
    wp_register_script( 'bos_cp_eye_js', BOS_JS_PLUGIN_DIR .'/colorpicker/js/eye.js', array('bos_cp_main_js'), '', true ) ; //set dependency on bos_cp_main_js
    wp_register_script( 'bos_cp_utils_js', BOS_JS_PLUGIN_DIR .'/colorpicker/js/utils.js', array('bos_cp_main_js'), '', true ) ;  
    wp_register_script( 'bos_cp_layout_js', BOS_JS_PLUGIN_DIR .'/colorpicker/js/layout.js', array('bos_cp_main_js'), '', true ) ;   
   
    
    //Localize in javascript bos_date.js
    wp_localize_script( 'bos_date_js', 'objectL10n', array(        
        'destinationErrorMsg' => __( 'Sorry, we need at least part of the name to start searching.', BOS_TEXT_DOMAIN ),
        'tooManyDays' => __( 'Your check-out date is more than 30 nights after your check-in date. Bookings can only be made for a maximum period of 30 nights. Please enter alternative dates and try again.', BOS_TEXT_DOMAIN ),
        'dateInThePast' => __( 'Your check-in date is in the past. Please check your dates and try again.', BOS_TEXT_DOMAIN ),
        'cObeforeCI' => __( 'Please check your dates, the check-out date appears to be earlier than the check-in date.', BOS_TEXT_DOMAIN ),
        'calendar_nextMonth' => __( 'Next month', BOS_TEXT_DOMAIN ),
        'calendar_prevMonth' => __( 'Prev month', BOS_TEXT_DOMAIN ),
        'calendar_closeCalendar' => __( 'Close calendar', BOS_TEXT_DOMAIN ),
        'january' => __( 'January', BOS_TEXT_DOMAIN ), 
        'february' => __( 'February', BOS_TEXT_DOMAIN ), 
        'march' => __( 'March', BOS_TEXT_DOMAIN ), 
        'april' => __( 'April', BOS_TEXT_DOMAIN ),
        'may' => __( 'May', BOS_TEXT_DOMAIN ),
        'june' => __( 'June', BOS_TEXT_DOMAIN ),
        'july' => __( 'July', BOS_TEXT_DOMAIN ),
        'august' => __( 'August', BOS_TEXT_DOMAIN ), 
        'september' => __( 'September', BOS_TEXT_DOMAIN ),
        'october' => __( 'October', BOS_TEXT_DOMAIN ),
        'november' => __( 'November', BOS_TEXT_DOMAIN ),
        'december' => __( 'December', BOS_TEXT_DOMAIN ),
        'mo' => __( 'Mo', BOS_TEXT_DOMAIN ),
        'tu' => __( 'Tu', BOS_TEXT_DOMAIN ),
        'we' => __( 'We', BOS_TEXT_DOMAIN ),
        'th' => __( 'Th', BOS_TEXT_DOMAIN ),
        'fr' => __( 'Fr', BOS_TEXT_DOMAIN ),
        'sa' => __( 'Sa', BOS_TEXT_DOMAIN ),
        'su' => __( 'Su', BOS_TEXT_DOMAIN ),
        'close' =>  __( 'Close', BOS_TEXT_DOMAIN ),
        'images_js_path' => BOS_IMG_PLUGIN_DIR //path for images to be called from javascript     
    ) );
         
}

// Add scripts just for admin settings page
add_action( 'admin_print_scripts-settings_page_bos_searchbox', 'bos_searchbox_add_settings_scripts' ) ;
function bos_searchbox_add_settings_scripts() {
    
    wp_enqueue_style( 'bos_sb_main_css' ) ;
    wp_enqueue_script( 'bos_main_js' ) ;
    wp_enqueue_script( 'bos_date_js' ) ; 
    wp_enqueue_script( 'bos_cp_main_js' ) ;  
    wp_enqueue_script( 'bos_cp_eye_js' ) ;
    wp_enqueue_script( 'bos_cp_utils_js' ) ;
    wp_enqueue_script( 'bos_cp_layout_js' ) ; 
    wp_enqueue_script( 'bos_general_js' ) ; 
    
}

// Add style 'n scripts just for public pages after main theme style
add_action( 'wp_enqueue_scripts', 'bos_searchbox_add_sb_style_script', 11 ) ;
function bos_searchbox_add_sb_style_script() {
       
    wp_enqueue_style( 'bos_sb_main_css' ) ;    
    wp_enqueue_script( 'bos_main_js' ) ;
    wp_enqueue_script( 'bos_date_js' ) ;
    
}

?>