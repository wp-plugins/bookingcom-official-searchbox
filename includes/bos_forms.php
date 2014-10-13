<?php

/**
 * SETTINGS SECTION
 * ----------------------------------------------------------------------------
 */
 

// Fields input arrays 
function bos_searchbox_settings_fields_array() {
    
    $fields = array() ;
    // 'field name', 'input type',  'field label', 'field bonus expl.', 'input maxlenght', 'input size', 'required', 'which section belongs to?'
    $fields[ 'aid' ] =  array( 'aid', 'text', __( 'Your affiliate ID' , BOS_TEXT_DOMAIN ) , __( 'Your affiliate ID is a unique number that allows Booking.com to track commission. If you are not an affiliate yet, <a href="http://www.booking.com/content/affiliates.html" target="_blank">check our affiliate programme</a> and get an affiliate ID. It\'s easy and fast. Start earning money, <a href="https://secure.booking.com/partnerreg.html" target="_blank">sign up now!</a>', BOS_TEXT_DOMAIN ), 6, 10, 0, 'main' ) ;        
    $fields[ 'widget_width' ] = array( 'widget_width', 'text', __( 'Width' , BOS_TEXT_DOMAIN ) , __( 'Need a specific width (e.g. 150px)? You can customise the width of your search box easily - just fill in your pixel requirements. If you leave this field empty, you\'ll get default settings.' , BOS_TEXT_DOMAIN ), 4, 4, 0, 'main' ) ;
    $fields[ 'calendar' ] = array( 'calendar', 'checkbox', __( 'Need a calendar?' , BOS_TEXT_DOMAIN ) , '', '', '', 0, 'main' ) ;
    $fields[ 'month_format' ] = array( 'month_format', 'radio', __( 'Month format' , BOS_TEXT_DOMAIN ) , '', '', '', 0, 'main' ) ;
    $fields[ 'flexible_dates' ] = array( 'flexible_dates', 'checkbox', __( 'Add a &quot;flexible-date&quot; check box' , BOS_TEXT_DOMAIN ) , '' , '', '', 0, 'main' ) ;
    $fields[ 'logodim' ] = array( 'logodim', 'radio', __( 'Select which logo and dimension you prefer' , BOS_TEXT_DOMAIN ) , '', '', '', 0, 'main' ) ;
    $fields[ 'logopos' ] = array( 'logopos', 'select', __( 'Logo position' , BOS_TEXT_DOMAIN ) , '', '', '', 0, 'main' ) ;    
    $fields[ 'prot' ] = array( 'prot', 'select', __( 'Protocol', BOS_TEXT_DOMAIN) , __( 'Choose https only if your pages are on a secure ( https ) enviroment', BOS_TEXT_DOMAIN), '', '', 0, 'main' ) ;
    
    $fields[ 'destination' ] = array( 'destination', 'text', __( 'Destination', BOS_TEXT_DOMAIN ) , __( 'You can pre-fill this field with a specific destination ( e.g. Amsterdam )', BOS_TEXT_DOMAIN ), '', 18, 0, 'destination' ) ;
    $fields[ 'dest_type' ] = array( 'dest_type', 'select', __( 'Destination type', BOS_TEXT_DOMAIN ) , '', '', '', 0, 'destination' ) ;
    $fields[ 'dest_id' ] = array( 'dest_id', 'text', __( 'Destination ID ( e.g. -2140479 for Amsterdam )', BOS_TEXT_DOMAIN ) , '<a href="#" id="bos_info_displayer" title="Info box"><img  style="border: none;" src="' . BOS_IMG_PLUGIN_DIR . '/bos_info_icon.png" alt="info"></a>', '', 25, 0, 'destination' ) ;
       
    $fields[ 'bgcolor' ] = array( 'bgcolor', 'text', __( 'Background colour' , BOS_TEXT_DOMAIN ) , '', 7, 10, 0, 'color' ) ;
    $fields[ 'textcolor' ] = array( 'textcolor', 'text', __( 'Text colour' , BOS_TEXT_DOMAIN ) , '', 7, 10, 0, 'color' ) ;
    $fields[ 'submit_bgcolor' ] = array( 'submit_bgcolor','text', __( 'Button background colour' , BOS_TEXT_DOMAIN ) , '', 7, 10, 0, 'color' ) ;
    $fields[ 'submit_bordercolor' ] = array( 'submit_bordercolor','text', __( 'Button border colour' , BOS_TEXT_DOMAIN ) , '', 7, 10, 0, 'color' ) ;
    $fields[ 'submit_textcolor' ] = array( 'submit_textcolor','text', __( 'Button text colour' , BOS_TEXT_DOMAIN ) , '', 7, 10, 0, 'color' ) ;
        
    $fields[ 'maintitle' ] = array( 'maintitle','text', __( 'Default title ( e.g. Search hotels and more... )' , BOS_TEXT_DOMAIN ) , '', '', '', 0, 'wording' ) ;
    $fields[ 'dest_title' ] = array( 'dest_title','text', __( 'Destination ( e.g. Destination )' , BOS_TEXT_DOMAIN ) , '', '', '', 0, 'wording' ) ;
    $fields[ 'checkin' ] = array( 'checkin','text', __( 'Check-in ( e.g. Check-in date )' , BOS_TEXT_DOMAIN ) , '', '', '', 0, 'wording' ) ;
    $fields[ 'checkout' ] = array( 'checkout','text', __( 'Check-out ( e.g. Check-out date )' , BOS_TEXT_DOMAIN ) , '', '', '', 0, 'wording' ) ;
    $fields[ 'submit' ] = array( 'submit','text', __( 'Submit button ( e.g. Search )' , BOS_TEXT_DOMAIN ) , '', '', '', 0, 'wording' ) ;

    return $fields;
}

function bos_searchbox_retrieve_all_user_options() {
    
    // Retrieve all user options from DB
    $user_options = get_option( 'bos_searchbox_user_options' ) ;    
    return $user_options;
    
}

// Draw the option page
function bos_searchbox_option_page() {
    
    // Include of checkin and checkout select
  
    ?>
    <div class="wrap">
        
        <?php screen_icon(); ?>
        <h2><img src="<?php echo BOS_IMG_PLUGIN_DIR . '/booking_logotype_blue_150x25.png' ; ?>" /></h2>
        
        <div class="updated"><p><?php _e( 'Customise your Booking.com search box below, or use the default search box by navigating to <strong>Appearance &gt; Widgets</strong> now.', BOS_TEXT_DOMAIN ); ?></p></div>
        
        <div id="bos_wrap"  style="background: transparent url( <?php echo BOS_IMG_PLUGIN_DIR . '/sand.jpg' ; ?> ) repeat-y 60% 0;">
            <div id="bos_left">
                <form action="options.php" method="post" id="bos_form">
                    <?php settings_fields('bos_searchbox_settings'); ?>
                    <?php do_settings_sections('bos_searchbox'); ?>
                <p class="submit">
                    <!-- fallback in case no javascript -->
                    <noscript><style>#reset_default, #preview_button, #bos_right { display: none; } #bos_wrap { background: none !important; }</style></noscript>
                    
                    <input type="button" id="preview_button" class="button-primary" value="<?php _e( 'Preview', BOS_TEXT_DOMAIN ); ?>" />
                    <input type="submit" class="button-primary" value="<?php _e( 'Save Changes', BOS_TEXT_DOMAIN ); ?>" />
                    <input type="submit" id="reset_default" class="button-secondary" value="<?php _e( 'Reset to default', BOS_TEXT_DOMAIN ); ?>" />                    
                </p>
                </form>
            </div>      
            <div id="bos_right">
                
                <div id="bos_preview">
                    
                    <div id="bos_preview_title"><img src="<?php echo BOS_IMG_PLUGIN_DIR . '/preview_title.png' ; ?>" alt="Preview" /></div>
                    <?php 
                        $options = bos_searchbox_retrieve_all_user_options() ;                        
                        $preview = true ;               
                        bos_create_searchbox( $options , $preview ) ;
                    ?>
                </div>
            </div>
            
            <div class="clear"></div>
         </div>
    </div>
    <?php
    
}

// Register and define the settings
add_action('admin_init', 'bos_searchbox_admin_init') ;
function bos_searchbox_admin_init(){
    
    register_setting(
        'bos_searchbox_settings',
        'bos_searchbox_user_options',
        'bos_searchbox_validate_options'
    ) ;
    add_settings_section(//Main settings 
        'bos_searchbox_main', //id
        __( 'Main settings', BOS_TEXT_DOMAIN ), //title
        'bos_searchbox_section_main', //callback
        'bos_searchbox' //page
    ) ;
    add_settings_section(//Destination
        'bos_searchbox_destination', //id
        __( 'Preset destination', BOS_TEXT_DOMAIN ), //title
        'bos_searchbox_section_destination', //callback
        'bos_searchbox' //page
    ) ;        
    add_settings_section(//Color settings
        'bos_searchbox_color',
        __( 'Colour scheme', BOS_TEXT_DOMAIN ),
        'bos_searchbox_section_color',
        'bos_searchbox'
    ) ;    
    add_settings_section(//Wording settings
        'bos_searchbox_wording',
        __( 'Search box text', BOS_TEXT_DOMAIN ),
        'bos_searchbox_section_wording',
        'bos_searchbox'
    ) ;
    
    $arrayFields = bos_searchbox_settings_fields_array();
    
    foreach( $arrayFields as $field ) {
            
        add_settings_field(            
            'bos_searchbox_'.$field[ 0 ], //id
            __( $field[ 2 ], BOS_TEXT_DOMAIN ), //title
            'bos_searchbox_settings_field', //callback
            'bos_searchbox',//page
            'bos_searchbox_'.$field[ 7 ],//section
             $args = array( $field[ 0 ], $field[ 1 ], $field[ 3 ], $field[ 4 ], $field[ 5 ] ) //args
         
        ) ;
        
    }   

}

// Draw section header
function bos_searchbox_section_main() {
    
    echo '<p><em>'. __( 'Use these settings to customise your search box.', BOS_TEXT_DOMAIN ) .'</em></p>'; 
    echo '<span id="bos_ajax_nonce" class="hidden" style="visibility: hidden;">' . wp_create_nonce( 'bos_ajax_nonce' ) . '</span>';
    
}

function bos_searchbox_section_destination() {
    
    echo '<p><em>'. __( 'Use the following fields to select a specific destination. <em>Destination types</em> and <em>IDs</em> make guest searches more accurate.', BOS_TEXT_DOMAIN ) .'</em></p>'; 
    
}

// Draw color section header
function bos_searchbox_section_color() {
    
    echo '<p><em>' . __( 'Enter your colour scheme settings here.', BOS_TEXT_DOMAIN ) .'</em></p>';
     
}

// Draw wording section header
function bos_searchbox_section_wording() {
    
    echo '<p><em>' . __( 'Customise the search box text here.', BOS_TEXT_DOMAIN ) .'</em></p>'; 

}

// Display and fill general fields
function bos_searchbox_settings_field( $args ) {
           
        // get options value from the database        
        $options = bos_searchbox_retrieve_all_user_options() ;        
        $fields_array =  $args[ 0 ];
        $fields_value = '' ;
                            
        if( !empty( $options[ $fields_array ]) ) {
            
            $fields_value = $options[ $fields_array ]; // if user eneterd values fields_value
            
        }         
        
        $output = '' ;
         
        // echo the fields
        if ( $args[ 1 ] == 'text' ) {            
           
            
            $output .= '<input name="bos_searchbox_user_options[' . $fields_array . ']" id="' .$args[ 0 ] . '" type="' . $args[ 1 ] . '" ';            
            if ( !empty( $args[ 3 ] ) ) { $output .= ' maxlength="'. $args[ 3 ]. '" '; }
            if ( !empty( $args[ 4 ] ) ) { $output .= ' size="' . $args[ 4 ] . '" '; }

            // If default plugin values empty show default values  ( but for aid as we do not want the default aid is shown on the input field )
                        
            if ( $args[ 0 ] == 'aid' && ( $fields_value == BOS_DEFAULT_AID || empty( $fields_value ) || $fields_value == '' || $fields_value == ' ' || !is_numeric( $fields_value ) ) ) {
                $fields_value = '' ; 
                $output .= 'placeholder="' . __( 'e.g.' , BOS_TEXT_DOMAIN ) . ' ' . BOS_DEFAULT_AID . '"' ;
            }
            
            if ( $args[ 0 ] == 'destination' && ( empty( $fields_value ) || $fields_value == '' || $fields_value == ' ' ) )  {
                
                $output .= 'placeholder="' . __( 'e.g. Amsterdam' , BOS_TEXT_DOMAIN ) . '"' ;
                               
            }
            
            if ( $args[ 0 ] == 'dest_id' && ( empty( $fields_value ) || $fields_value == '' || $fields_value == ' ' ) )  {
                
                $output .= 'placeholder="' . __( 'e.g. -2140479 for Amsterdam' , BOS_TEXT_DOMAIN ) . '"' ;
                               
            }
            
            // Color scheme default values in case no custom values
            
            if ( $args[ 0 ] == 'bgcolor' && ( empty( $fields_value ) || $fields_value == '' || $fields_value == ' ' ) )  {
                
                $fields_value = BOS_BGCOLOR ;
                                
            }
            
            if ( $args[ 0 ] == 'textcolor' && ( empty( $fields_value ) || $fields_value == '' || $fields_value == ' ' ) )  {
                
                $fields_value = BOS_TEXTCOLOR ;
                                 
            }
            
            if ( $args[ 0 ] == 'submit_bgcolor' && ( empty( $fields_value ) || $fields_value == '' || $fields_value == ' ' ) )  {
                
                $fields_value = BOS_SUBMIT_BGCOLOR ;
                 
            }
            
            if ( $args[ 0 ] == 'submit_bordercolor' && ( empty( $fields_value ) || $fields_value == '' || $fields_value == ' ' ) )  {
                
                $fields_value = BOS_SUBMIT_BORDERCOLOR ;
                 
            }
            
            if ( $args[ 0 ] == 'submit_textcolor' && ( empty( $fields_value ) || $fields_value == '' || $fields_value == ' ' ) )  {
                
                $fields_value = BOS_SUBMIT_TEXTCOLOR ;
                 
            }
            
            // Wordings scheme default values in case no custom values
            
            if ( $args[ 0 ] == 'maintitle' && ( empty( $fields_value ) || $fields_value == '' || $fields_value == ' ' || $fields_value == trim( __( 'Search hotels and more...', BOS_TEXT_DOMAIN ) ) ) )  {
                
                $fields_value = '' ; 
                $output .= 'placeholder="' . __( 'Search hotels and more...', BOS_TEXT_DOMAIN ) . '"' ; 
                
            }
            
            if ( $args[ 0 ] == 'dest_title' && ( empty( $fields_value ) || $fields_value == '' || $fields_value == ' ' || $fields_value == trim( __( 'Destination', BOS_TEXT_DOMAIN ) ) ) )  {
                
                $fields_value = '' ; 
                $output .= 'placeholder="' . __( 'Destination', BOS_TEXT_DOMAIN ) . '"' ; 
                
            }
            
            if ( $args[ 0 ] == 'checkin' && ( empty( $fields_value ) || $fields_value == '' || $fields_value == ' ' || $fields_value == trim( __( 'Check-in date', BOS_TEXT_DOMAIN ) ) ) )  {
                
                $fields_value = '' ; 
                $output .= 'placeholder="' . __( 'Check-in date', BOS_TEXT_DOMAIN ) . '"' ;
                 
            }
            
            if ( $args[ 0 ] == 'checkout' && ( empty( $fields_value ) || $fields_value == '' || $fields_value == ' ' || $fields_value == trim( __( 'Check-out date', BOS_TEXT_DOMAIN ) ) ) )  {
                
                $fields_value = '' ; 
                $output .= 'placeholder="' . __( 'Check-out date', BOS_TEXT_DOMAIN ) .' "' ;
                 
            }
            
            if ( $args[ 0 ] == 'submit' && ( empty( $fields_value ) || $fields_value == '' || $fields_value == ' ' ) || $fields_value == trim( __( 'Search', BOS_TEXT_DOMAIN ) ) ) {
                
                $fields_value = '' ; 
                $output .= 'placeholder="' . __( 'Search', BOS_TEXT_DOMAIN ) .' "' ; 
                 
            }

            $output .= 'value="' . $fields_value . '" />&nbsp;' . __( $args[ 2 ], BOS_TEXT_DOMAIN );
            
            
            if ( $args[ 0 ] == 'dest_id' ) {
                
                $output .= '<div id="bos_info_box" style="display: none;padding: 0 0.6em; background-color:#FFFFE0;border:1px solid  #E6DB55; margin:10px 0 10px;">' ;
                $output .= __( 'For more info on your destination ID, login to the <a href="https://admin.booking.com/partner/" target="_blank">Partner Center</a>. Check <em>&quot;URL constructor&quot;</em> section to find your destination ID. These IDs, also known as UFIs, are usually a negative number ( e.g. <strong>-2140479 is for Amsterdam</strong> , but can be positive ones in the US ) while regions, district and landmarks are always positive ( e.g. <strong>725 is for Ibiza</strong> ).' , BOS_TEXT_DOMAIN) ;
                $output .= '</div>' ;                
                
            }
            
                  
               
        }  // $args[ 1 ] == 'text'
        
        elseif ( $args[ 1 ] == 'checkbox' ) {            
                
                if ( $args[ 0 ] == 'calendar' ) {
                                    
                    if ( empty( $fields_value ) ) { $fields_value = BOS_CALENDAR ; }// default value

                }     
               
                else if ( $args[ 0 ] == 'flexible_dates' )  {
                   
                    if ( empty( $fields_value ) ) { $fields_value = BOS_FLEXIBLE_DATES ; } // default values
     
                }
                
                $output .= '<input name="bos_searchbox_user_options[' . $fields_array . ']" id="' . $args[ 0 ] . '" type="' . $args[ 1 ] . '"  ' . checked( 1, $fields_value, false ) . ' />';
                
        } //$args[ 1 ] == 'checkbox'
            
        
        elseif ( $args[ 1 ] == 'radio' ) {
            
            if ( $args[ 0 ] == 'month_format' ) {
                
                if ( empty( $fields_value ) ) { $fields_value = BOS_MONTH_FORMAT ; } // default values
                
                //if( empty( $fields_value ) ) { $fields_value = 'short' ; }// set defaults value
                $output .= '<input name="bos_searchbox_user_options[' . $fields_array . ']" class="' . $args[ 0 ] . '" type="' . $args[ 1 ] . '"  value="long" ' . checked( 'long', $fields_value, false ) . ' />&nbsp;' . __( 'long', BOS_TEXT_DOMAIN ) ;
                $output .= '&nbsp;<input name="bos_searchbox_user_options[' . $fields_array . ']" class="' . $args[ 0 ] . '" type="' . $args[ 1 ] . '"  value="short" ' . checked( 'short', $fields_value, false ) . ' />&nbsp;' . __( 'short', BOS_TEXT_DOMAIN );
                
            } // $args[ 0 ] == 'month_format'
            
            if ( $args[ 0 ] == 'logodim' ) {                        
                
                //if( empty( $fields_value ) ) { $fields_value = 'blue_150x25' ; }// set defaults value
                $bgcolor = $options[ 'bgcolor' ] ? $options[ 'bgcolor' ] : BOS_BGCOLOR ; // default values
                if ( empty( $fields_value ) ) { $fields_value = BOS_LOGODIM ; } // default values
                
                $output .= '<span id="bos_img_blue_logo" class="bos_logo_dim_box" style="background: ' . $bgcolor . ';"><img  src="' . BOS_IMG_PLUGIN_DIR . '/booking_logotype_blue_150x25.png" alt="Booking.com logo" /></span>';
                $output .= '<input name="bos_searchbox_user_options[' . $fields_array . ']" class="' . $args[ 0 ] . '" type="' . $args[ 1 ] . '"  value="blue_150x25"  ' . checked( 'blue_150x25', $fields_value, false ) . ' />&nbsp;( 150x25 )&nbsp;' ;
                $output .= '<input name="bos_searchbox_user_options[' . $fields_array . ']" class="' . $args[ 0 ] . '" type="' . $args[ 1 ] . '"  value="blue_200x33"  ' . checked( 'blue_200x33', $fields_value, false ) . ' />&nbsp;( 200x33 )&nbsp;' ;
                $output .= '<input name="bos_searchbox_user_options[' . $fields_array . ']" class="' . $args[ 0 ] . '" type="' . $args[ 1 ] . '"  value="blue_300x50" ' . checked( 'blue_300x50', $fields_value, false ) . ' />&nbsp;( 300x50 )&nbsp;' ;
                $output .= '<br /><br />' ;
                $output .= '<span id="bos_img_white_logo" class="bos_logo_dim_box" style="background: ' . $bgcolor . ';"><img src="' . BOS_IMG_PLUGIN_DIR . '/booking_logotype_white_150x25.png" alt="Booking.com logo" /></span>';
                $output .= '<input name="bos_searchbox_user_options[' . $fields_array . ']" class="' . $args[ 0 ] . '" type="' . $args[ 1 ] . '"  value="white_150x25" ' . checked( 'white_150x25', $fields_value, false ) . ' />&nbsp;( 150x25 )&nbsp;' ;
                $output .= '<input name="bos_searchbox_user_options[' . $fields_array . ']" class="' . $args[ 0 ] . '" type="' . $args[ 1 ] . '"  value="white_200x33" ' . checked( 'white_200x33', $fields_value, false ) . ' />&nbsp;( 200x33 )&nbsp;' ;
                $output .= '<input name="bos_searchbox_user_options[' . $fields_array . ']" class="' . $args[ 0 ] . '" type="' . $args[ 1 ] . '"  value="white_300x50" ' . checked( 'white_300x50', $fields_value, false ) . ' />&nbsp;( 300x50 )&nbsp;' ;                
                
            } // $args[ 0 ] == 'logodim'            
            
        } // $args[ 1 ] == 'radio'      
        
        elseif ( $args[ 1 ] == 'select' ) {
                    
            if ( $args[ 0 ] == 'logopos' ) {           
                
                $output .= '<select name="bos_searchbox_user_options['. $fields_array .']" id="' . $args[ 0 ] . '" >';
                $output .= '<option value="left" ' . selected( 'left', $fields_value, false ) . ' >' . __( 'Left' , BOS_TEXT_DOMAIN) . '</option>' ;
                $output .= '<option value="center" ' . selected( 'center', $fields_value, false ) . ' >' . __( 'Centre' , BOS_TEXT_DOMAIN) . '</option>' ;
                $output .= '<option value="right" ' . selected( 'right', $fields_value, false ) . ' >' . __( 'Right' , BOS_TEXT_DOMAIN) . '</option>' ;
                $output .= '</select>' ;
            
            } // $args[ 0 ] == 'logopos'
            
            if ( $args[ 0 ] == 'prot' ) {
                
                $output .= '<select name="bos_searchbox_user_options['. $fields_array .']" id="' . $args[ 0 ] . '" >';
                $output .= '<option value="http://" ' . selected( 'http://', $fields_value, false ) . ' >http</option>' ;
                $output .= '<option value="https://" ' . selected( 'https://', $fields_value, false ) . ' >https</option>' ;
                $output .= '</select>&nbsp;' . __( $args[ 2 ], BOS_TEXT_DOMAIN ) ;
            
            } // $args[ 0 ] == 'prot'
            
            if ( $args[ 0 ] == 'dest_type' ) {
                
                $output .= '<select name="bos_searchbox_user_options['. $fields_array .']" id="' . $args[ 0 ] . '" >';
                $output .= '<option value="select" ' . selected( 'select', $fields_value, false ) . ' >' . __( 'select...' , BOS_TEXT_DOMAIN) . '</option>' ;
                $output .= '<option value="city" ' . selected( 'city', $fields_value, false ) . ' >' . __( 'city' , BOS_TEXT_DOMAIN) . '</option>' ;
                $output .= '<option value="landmark" ' . selected( 'landmark', $fields_value, false ) . ' >' . __( 'landmark' , BOS_TEXT_DOMAIN) . '</option>' ;
                $output .= '<option value="district" ' . selected( 'district', $fields_value, false ) . ' >' . __( 'district' , BOS_TEXT_DOMAIN) . '</option>' ;
                $output .= '<option value="region" ' . selected( 'region', $fields_value, false ) . ' >' . __( 'region' , BOS_TEXT_DOMAIN) . '</option>' ;
                $output .= '</select>' ;
                
            }
                
        } // $args[ 1 ] == 'select'       
            
        echo $output;
}

// Validate user inputs 
function bos_searchbox_validate_options( $input ) {
    
    $valid = array();
    $message = array();       
    $error = false;
        
    $arrayFields = bos_searchbox_settings_fields_array();    
    
    foreach( $arrayFields as $field) {
                
        if ( $field[ 1 ] == 'text' ) {                       
            
            if( $field[ 0 ] == 'aid' || $field[ 0 ] == 'widget_width' ) {                

                $valid[ $field[ 0 ] ] = $input[ $field[ 0 ] ] ;
                
                if ( !empty( $input[ $field[ 0 ] ] ) && $input[ $field[ 0 ] ] != '' && !is_numeric( $input[ $field[ 0 ] ] )  ) {
                                 
                    $error = true ;                    
                    $message[] = '"' . $field[ 2 ] . '": '. __( 'needs to be an integer', BOS_TEXT_DOMAIN ) . '<br>' ;
                
                }
                               
            } //$field[ 0 ] != 'aid'
            
            else {
                
                $valid[ $field[ 0 ] ]   = sanitize_text_field(  $input[ $field[ 0 ] ] ) ; //sanitize and escape malicius input
                
                if( $valid[ trim( $field[ 0 ] ) ] != trim( $input[ $field[ 0 ] ] ) ) {              
                                  
                    $error = true ;                    
                    $message[] = '"' .$field[ 2 ] . '": '. __( 'Missing or incorrect information', BOS_TEXT_DOMAIN ) . '<br>' ;
                    
                }
                                               
            }           
            
        } //if ( $field[ 1 ] == 'text' )
        
        elseif ( $field[ 1 ] == 'radio') {
                    
            if ( $field[ 0 ] == 'month_format' ) {
                    
                switch( $input[ $field[ 0 ] ] ) {
                      
                    case 'short':
                        $valid[ $field[ 0 ] ] = $input[ $field[ 0 ] ] ;
                        break ; 
                    case 'long' :
                    default:
                        $valid[ $field[ 0 ] ] = 'long' ; //default : long
                        break ;
       
                }
                
            } //$field[ 0 ] == 'month_format'
       
           
            if( $field[ 0 ] == 'logodim' ) {  
            
                switch( $input[ $field[ 0 ] ] ) {
                      
                    case 'blue_200x33':
                    case 'blue_300x50':
                    case 'white_150x25':
                    case 'white_200x33':
                    case 'white_300x50':  
                        $valid[ $field[ 0 ] ] = $input[ $field[ 0 ] ] ;
                        break ; 
                    case 'blue_150x25' :
                    default:
                        $valid[ $field[ 0 ] ] = 'blue_150x25' ; //default : blue_150x25
                        break ;        
                }
                 
            } //$field[ 0 ] == 'logodim'           
            
            
       } //elseif ( $field[ 1 ] == 'radio'  )
       
       
       elseif ( $field[ 1 ] == 'checkbox'  ) {
           
            if ( $field[ 0 ] == 'calendar' ) {
            
                $valid[ $field[ 0 ] ] = empty( $input[ $field[ 0 ] ] ) ? 0 : 1 ;                     
                
                
            } //if ( $field[ 0 ] == 'calendar' )
            
            if ( $field[ 0 ] == 'flexible_dates' ) {
            
                $valid[ $field[ 0 ] ] = empty( $input[ $field[ 0 ] ] ) ? 0 : 1 ;                  
                
                
            } //if ( $field[ 0 ] == 'flexible_dates' )
            
            /* if ( $field[ 0 ] == 'sticky' ) {
            
                $valid[ $field[ 0 ] ] = empty( $input[ $field[ 0 ] ] ) ? 0 : 1 ;                     
                
            } */ //if ( $field[ 0 ] == 'sticky' )
            
        }       
       
        else {
            
            if ( $field[ 0 ] == 'prot' ) {
                
                switch( $input[ $field[ 0 ] ] ) {   
  
                    case 'https://' :
                        $valid[ $field[ 0 ] ] = $input[ $field[ 0 ] ] ; 
                        break ;
                    case 'http://' :
                    default:
                        $valid[ $field[ 0 ] ] = 'http://' ; //default : http://
                        break ;        
                }
                
                
            }
            
            elseif ( $field[ 0 ] == 'logopos' ) {
                
                switch( $input[ $field[ 0 ] ] ) {                  
                    case 'center':
                    case 'right' :
                        $valid[ $field[ 0 ] ] = $input[ $field[ 0 ] ] ; 
                        break ;
                    case 'left' :
                    default:
                        $valid[ $field[ 0 ] ] = 'left' ; //default : left
                        break ;        
                }
                
                
            } 
            
            else {
                
                switch( $input[ $field[ 0 ] ] ) {                  
                    case 'city':
                    case 'region' :
                    case 'district' :
                    case 'landmark' :
                        $valid[ $field[ 0 ] ] = $input[ $field[ 0 ] ] ; 
                        break ;
                    case 'select' :
                    default:
                        $valid[ $field[ 0 ] ] = 'select' ; //default : select
                        break ;
                                
                }
                
            }     
            
                   
        } //logopos entries      
        

    } //foreach( $arrayFields as $field)
        
    if( $error ) {                    
        
            add_settings_error(
                'bos_searchbox_user_options',//setting
                'bos_searchbox_texterror', //code added to tag #id            
                 implode( '' , $message ),           
                 'error'                
            );       
   
    }
    
    return $valid ;
       
}

?>