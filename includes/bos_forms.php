<?php

/**
 * SETTINGS SECTION
 * ----------------------------------------------------------------------------
 */
 

// Fields input arrays 
function bos_searchbox_settings_fields_array() {
    
    $fields = array() ;
    // 'field name', 'input type',  'field label', 'field bonus expl.', 'input maxlenght', 'input size', 'required', 'which section belongs to?'
    $fields[ 'aid' ] =  array( 'aid', 'text', __( 'Your affiliate ID' , BOS_TEXT_DOMAIN ) , __( '<strong>Aid</strong> number - affiliate unique identifier number - is necessary to get commission. If you are not an affiliate yet, please <a href="http://www.booking.com/content/affiliates.html" target="_blank">check our affiliate programme</a> and get yours. It\'s easy, it\'s fast. Start earning money, <a href="https://secure.booking.com/partnerreg.html" target="_blank">sign up now</a>!', BOS_TEXT_DOMAIN ), 6, 10, 0, 'main' ) ;    
    $fields[ 'destination' ] = array( 'destination', 'text', __( 'Destination', BOS_TEXT_DOMAIN ) , __('If you like, you can pre-fill destination field (Ex. Amsterdam)', BOS_TEXT_DOMAIN), '', '', 0, 'main' ) ;
    $fields[ 'widget_width' ] = array( 'widget_width', 'text', __( 'Width' , BOS_TEXT_DOMAIN ) , __( 'Do you need a specific width (Ex. 150 means 150px)? If you leave it empty widget automatically will fit container width' , BOS_TEXT_DOMAIN ), 4, 4, 0, 'main' ) ;
    $fields[ 'calendar' ] = array( 'calendar', 'checkbox', __( 'Need a calendar?' , BOS_TEXT_DOMAIN ) , '', '', '', 0, 'main' ) ;
    $fields[ 'Month format' ] = array( 'month_format', 'radio', __( 'Month format' , BOS_TEXT_DOMAIN ) , '', '', '', 0, 'main' ) ;
    $fields[ 'logodim' ] = array( 'logodim', 'radio', __( 'Dark or white logo and which dimensions?' , BOS_TEXT_DOMAIN ) , '', '', '', 0, 'main' ) ;
    $fields[ 'logopos' ] = array( 'logopos', 'select', __( 'Logo position' , BOS_TEXT_DOMAIN ) , '', '', '', 0, 'main' ) ;    
    $fields[ 'bgcolor' ] = array( 'bgcolor', 'text', __( 'Background color' , BOS_TEXT_DOMAIN ) , '( hexadecimal - Ex. #CCCCCC )', 7, 10, 0, 'color' ) ;
    $fields[ 'textcolor' ] = array( 'textcolor', 'text', __( 'Text color' , BOS_TEXT_DOMAIN ) , '( hexadecimal - Ex. #000000 )', 7, 10, 0, 'color' ) ;
    $fields[ 'submit_bgcolor' ] = array( 'submit_bgcolor','text', __( 'Button background color' , BOS_TEXT_DOMAIN ) , '( hexadecimal - Ex. #000000 )', 7, 10, 0, 'color' ) ;
    $fields[ 'submit_bordercolor' ] = array( 'submit_bordercolor','text', __( 'Button border color' , BOS_TEXT_DOMAIN ) , '( hexadecimal - Ex. #000000 )', 7, 10, 0, 'color' ) ;
    $fields[ 'submit_textcolor' ] = array( 'submit_textcolor','text', __( 'Button text color' , BOS_TEXT_DOMAIN ) , '( hexadecimal - Ex. #000000 )', 7, 10, 0, 'color' ) ;    
    $fields[ 'maintitle' ] = array( 'maintitle','text', __( 'Change default title' , BOS_TEXT_DOMAIN ) , '', '', '', 0, 'wording' ) ;
    $fields[ 'checkin' ] = array( 'checkin','text', __( 'Change checkin text' , BOS_TEXT_DOMAIN ) , '', '', '', 0, 'wording' ) ;
    $fields[ 'checkout' ] = array( 'checkout','text', __( 'Change checkout text' , BOS_TEXT_DOMAIN ) , '', '', '', 0, 'wording' ) ;
    $fields[ 'submit' ] = array( 'submit','text', __( 'Change submit text' , BOS_TEXT_DOMAIN ) , '', '', '', 0, 'wording' ) ;
    
    return $fields;
}

function bos_searchbox_retrieve_all_options() {
    
    // Retrieve all options from DB
    $options = get_option( 'bos_searchbox_options' ) ;    
    return $options;
    
}

// Draw the option page
function bos_searchbox_option_page() {
    
    // Include of checkin and checkout select
  
    ?>
    <div class="wrap">
        
        <?php screen_icon(); ?>
        <h2><img src="<?php echo BOS_IMG_PLUGIN_DIR . '/booking_logotype_blue_150x25.png' ; ?>" /></h2>
        
        <div class="updated"><p><?php _e( 'If you like you can customise Booking.com searchbox with the settings panel below, or you can just start using the default one in <strong>Appearance > Widgets</strong> section now.', BOS_TEXT_DOMAIN ); ?></p></div>
        
        <div id="bos_wrap"  style="background: transparent url( <?php echo BOS_IMG_PLUGIN_DIR . '/sand.jpg' ; ?> ) repeat-y 60% 0;">
            <div id="bos_left">
                <form action="options.php" method="post" id="bos_form">
                    <?php settings_fields('bos_searchbox_settings'); ?>
                    <?php do_settings_sections('bos_searchbox'); ?>
                <p class="submit">
                    <input type="button" id="preview_button" class="button-primary" value="<?php _e( 'Preview', BOS_TEXT_DOMAIN ); ?>" />
                    <input type="submit" class="button-primary" value="<?php _e( 'Save Changes', BOS_TEXT_DOMAIN ); ?>" />
                </p>
                </form>
            </div>      
            <div id="bos_right">
                
                <div id="bos_preview">
                    
                    <div id="bos_preview_title"><img src="<?php echo BOS_IMG_PLUGIN_DIR . '/preview_title.png' ; ?>" alt="Preview" /></div>
                    <?php 
                        $options = bos_searchbox_retrieve_all_options() ;
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
        'bos_searchbox_options',
        'bos_searchbox_validate_options'
    ) ;
    add_settings_section(//Main settings 
        'bos_searchbox_main', //id
        __('Main settings', BOS_TEXT_DOMAIN ), //title
        'bos_searchbox_section_main', //callback
        'bos_searchbox' //page
    ) ;    
    add_settings_section(//Color settings
        'bos_searchbox_color',
        __('Color scheme', BOS_TEXT_DOMAIN ),
        'bos_searchbox_section_color',
        'bos_searchbox'
    ) ;    
    add_settings_section(//Wording settings
        'bos_searchbox_wording',
        __('Wordings', BOS_TEXT_DOMAIN ),
        'bos_searchbox_section_wording',
        'bos_searchbox'
    ) ;
    
    $arrayFields = bos_searchbox_settings_fields_array();
    
    foreach( $arrayFields as $field ) {
            
        add_settings_field(            
            'bos_searchbox_'.$field[ 0 ], //id
            __($field[ 2 ], BOS_TEXT_DOMAIN ), //title
            'bos_searchbox_settings_field', //callback
            'bos_searchbox',//page
            'bos_searchbox_'.$field[ 7 ],//section
             $args = array( $field[ 0 ], $field[ 1 ], $field[ 3 ], $field[ 4 ], $field[ 5 ] ) //args
         
        ) ;
        
    }   

}

// Draw section header
function bos_searchbox_section_main() {
    
    echo '<p><em>'. __('Enter your main settings here.', BOS_TEXT_DOMAIN) .'</em></p>'; 
    echo '<span id="bos_ajax_nonce" class="hidden" style="visibility: hidden;">' . wp_create_nonce( 'bos_ajax_nonce' ) . '</span>';
    
}

// Draw color section header
function bos_searchbox_section_color() {
    
    echo '<p><em>' . __('Enter your color settings here.', BOS_TEXT_DOMAIN) .'</em></p>';
     
}

// Draw wording section header
function bos_searchbox_section_wording() {
    
    echo '<p><em>' . __('Change wordings here.', BOS_TEXT_DOMAIN) .'</em></p>'; 

}

// Display and fill general fields
function bos_searchbox_settings_field( $args ) {
           
        // get options value from the database        
        $options = bos_searchbox_retrieve_all_options();
        $fields_array =  $args[ 0 ];
                            
        if( !empty( $options[ $fields_array ]) ) {
            $fields_value = $options[ $fields_array ];
        } else  { $fields_value = ''; }      
        
         $output = '' ;
         
        // echo the fields
        if ( $args[ 1 ] == 'text' ) {
            
            $output .= '<input name="bos_searchbox_options[' . $fields_array . ']" id="' .$args[ 0 ] . '" type="' . $args[ 1 ] . '" ';            
            if ( !empty( $args[ 3 ] ) ) { $output .= ' maxlength="'. $args[ 3 ]. '" '; }
            if ( !empty( $args[ 4 ] ) ) { $output .= ' size="' . $args[ 4 ] . '" '; }

            // If default plugin values empty show default values  ( but for aid as we do not want the default aid is shown on the input field )
            if ( $args[ 0 ] == 'aid' && $fields_value == BOS_DEFAULT_AID ) { $fields_value = '' ; }
            if ( $args[ 0 ] == 'maintitle' && ( $fields_value == '' || empty( $fields_value ) ) ) { $fields_value = __( 'Need a hotel?' , BOS_TEXT_DOMAIN ) ; }
            if ( $args[ 0 ] == 'checkin' && ( $fields_value == '' || empty( $fields_value ) ) ) { $fields_value = __( 'Check-in date', BOS_TEXT_DOMAIN ) ; }
            if ( $args[ 0 ] == 'checkout' && ( $fields_value == '' || empty( $fields_value ) ) ) { $fields_value = __( 'Check-out date', BOS_TEXT_DOMAIN ) ; }
            if ( $args[ 0 ] == 'submit' && ( $fields_value == '' || empty( $fields_value ) ) ) { $fields_value = __( 'search' , BOS_TEXT_DOMAIN ) ; }

            $output .= 'value="' . $fields_value. '" />&nbsp;' . __( $args[ 2 ], BOS_TEXT_DOMAIN );      
               
        }  // $args[ 1 ] == 'text'
        
        elseif ( $args[ 0 ] == 'calendar' ) {               
                
                $output .= '<input name="bos_searchbox_options[' . $fields_array . ']" id="' . $args[ 0 ] . '" type="' . $args[ 1 ] . '"  value="1" ' . checked( 1, $fields_value, false ) . ' />';                
                
        } // $args[ 0 ] == 'calendar'
        
        elseif ( $args[ 1 ] == 'radio' ) {
            
            if ( $args[ 0 ] == 'month_format' ) {
                
                $output .= '<input name="bos_searchbox_options[' . $fields_array . ']" class="' . $args[ 0 ] . '" type="' . $args[ 1 ] . '"  value="long" ' . checked( 'long', $fields_value, false ) . ' />&nbsp;' . __( 'long', BOS_TEXT_DOMAIN ) ;
                $output .= '&nbsp;<input name="bos_searchbox_options[' . $fields_array . ']" class="' . $args[ 0 ] . '" type="' . $args[ 1 ] . '"  value="short" ' . checked( 'short', $fields_value, false ) . ' />&nbsp;' . __( 'short', BOS_TEXT_DOMAIN );
                
            } // $args[ 0 ] == 'month_format'
            
            if ( $args[ 0 ] == 'logodim' ) {               
                
                $bgcolor = $options[ 'bgcolor' ] ? $options[ 'bgcolor' ] : '#FEBA02' ;          
                
                $output .= '<span id="bos_img_blue_logo" class="bos_logo_dim_box" style="background: ' . $bgcolor . ';"><img  src="' . BOS_IMG_PLUGIN_DIR . '/booking_logotype_blue_150x25.png" alt="Booking.com logo" /></span>';
                $output .= '<input name="bos_searchbox_options[' . $fields_array . ']" class="' . $args[ 0 ] . '" type="' . $args[ 1 ] . '"  value="blue_150x25"  ' . checked( 'blue_150x25', $fields_value, false ) . ' />&nbsp;( 150x25 )&nbsp;' ;
                $output .= '<input name="bos_searchbox_options[' . $fields_array . ']" class="' . $args[ 0 ] . '" type="' . $args[ 1 ] . '"  value="blue_200x33"  ' . checked( 'blue_200x33', $fields_value, false ) . ' />&nbsp;( 200x33 )&nbsp;' ;
                $output .= '<input name="bos_searchbox_options[' . $fields_array . ']" class="' . $args[ 0 ] . '" type="' . $args[ 1 ] . '"  value="blue_300x50" ' . checked( 'blue_300x50', $fields_value, false ) . ' />&nbsp;( 300x50 )&nbsp;' ;
                $output .= '<br /><br />' ;
                $output .= '<span id="bos_img_white_logo" class="bos_logo_dim_box" style="background: ' . $bgcolor . ';"><img src="' . BOS_IMG_PLUGIN_DIR . '/booking_logotype_white_150x25.png" alt="Booking.com logo" /></span>';
                $output .= '<input name="bos_searchbox_options[' . $fields_array . ']" class="' . $args[ 0 ] . '" type="' . $args[ 1 ] . '"  value="white_150x25" ' . checked( 'white_150x25', $fields_value, false ) . ' />&nbsp;( 150x25 )&nbsp;' ;
                $output .= '<input name="bos_searchbox_options[' . $fields_array . ']" class="' . $args[ 0 ] . '" type="' . $args[ 1 ] . '"  value="white_200x33" ' . checked( 'white_200x33', $fields_value, false ) . ' />&nbsp;( 200x33 )&nbsp;' ;
                $output .= '<input name="bos_searchbox_options[' . $fields_array . ']" class="' . $args[ 0 ] . '" type="' . $args[ 1 ] . '"  value="white_300x50" ' . checked( 'white_300x50', $fields_value, false ) . ' />&nbsp;( 300x50 )&nbsp;' ;                
                
            } // $args[ 0 ] == 'logodim'            
            
        } // $args[ 1 ] == 'radio'      
        
        elseif ( $args[ 1 ] == 'select' ) {
                
                $output .= '<select name="bos_searchbox_options['. $fields_array .']" id="' . $args[ 0 ] . '" >';
                $output .= '<option value="left" ' . selected( 'left', $fields_value, false ) . ' >' . __( 'left' , BOS_TEXT_DOMAIN) . '</option>' ;
                $output .= '<option value="center" ' . selected( 'center', $fields_value, false ) . ' >' . __( 'center' , BOS_TEXT_DOMAIN) . '</option>' ;
                $output .= '<option value="right" ' . selected( 'right', $fields_value, false ) . ' >' . __( 'right' , BOS_TEXT_DOMAIN) . '</option>' ;
                $output .= '</select>' ;
                
        } // $args[ 0 ] == 'logopos'
        
            
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
                
                if ( !empty( $input[ $field[ 0 ] ] ) &&  $input[ $field[ 0 ] ] != '' && !is_numeric( $input[ $field[ 0 ] ] )  ) {
                                 
                    $error = true ;                    
                    $message[] = '"' . $field[ 2 ] . '": '. __( 'needs to be an integer', BOS_TEXT_DOMAIN ) . '<br>' ;
                
                }
                               
            } //$field[ 0 ] != 'aid'
            
            else {
                
                $valid[ $field[ 0 ] ] = sanitize_text_field( $input[ $field[ 0 ] ] ); //sanitize and escape malicius input
                
                if( $valid[ $field[ 0 ] ] != $input[ $field[ 0 ] ] ) {
                                  
                    $error = true ;                    
                    $message[] = '"' .$field[ 2 ] . '": '. __( 'Incorrect values entered!', BOS_TEXT_DOMAIN ) . '<br>' ;
                    
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
            
        }       
       
        else {
        
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
                   
        } //logopos entries      
        

    } //foreach( $arrayFields as $field)
        
    if( $error ) {                    
        
            add_settings_error(
                'bos_searchbox_options',//setting
                'bos_searchbox_texterror', //code added to tag #id            
                 implode( '' , $message ),           
                 'error'                
            );       
   
    }
    
    return $valid ;
       
}

?>