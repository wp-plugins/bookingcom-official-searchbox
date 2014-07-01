<?php 
                    
                        
    function bos_dateSelector( $month_format, $calendar, $checkin, $checkout, $textcolor )  { 
      
        /* create all variables */
        
        if ( $month_format == 'long' ) {  
        $monthName = array( 1 => __( 'January', BOS_TEXT_DOMAIN ), __( 'February', BOS_TEXT_DOMAIN ), __( 'March', BOS_TEXT_DOMAIN ), 
            __( 'April', BOS_TEXT_DOMAIN ), __( 'May', BOS_TEXT_DOMAIN ), __( 'June', BOS_TEXT_DOMAIN ), __( 'July', BOS_TEXT_DOMAIN ), __( 'August', BOS_TEXT_DOMAIN ), 
            __( 'September', BOS_TEXT_DOMAIN ), __( 'October', BOS_TEXT_DOMAIN ), __( 'November', BOS_TEXT_DOMAIN ), __( 'December', BOS_TEXT_DOMAIN ) ) ;
            
        } else {
            
        $monthName = array( 1 => __( 'Jan', BOS_TEXT_DOMAIN ), __( 'Feb', BOS_TEXT_DOMAIN ), __( 'Mar', BOS_TEXT_DOMAIN ), 
            __( 'Apr', BOS_TEXT_DOMAIN ), trim( __( 'May ', BOS_TEXT_DOMAIN ) ), __( 'Jun', BOS_TEXT_DOMAIN ), __( 'Jul', BOS_TEXT_DOMAIN ), __( 'Aug', BOS_TEXT_DOMAIN ), 
            __( 'Sept', BOS_TEXT_DOMAIN ), __( 'Oct', BOS_TEXT_DOMAIN ), __( 'Nov', BOS_TEXT_DOMAIN ), __( 'Dec', BOS_TEXT_DOMAIN ) ) ; 
        } // a space is intentionally added to May in order to differenciate other translations/localizations
        
        $checkin = $checkin ? $checkin : __( 'Check-in date', BOS_TEXT_DOMAIN ) ; 
        $checkout = $checkout ? $checkout : __( 'Check-out date', BOS_TEXT_DOMAIN ) ;        
        $textcolor = $textcolor ? 'color:' . $textcolor . ';' : 'color: #003580;' ;              
        $currentDate = time() ;
        $currentYear = intval( date( "Y", $currentDate ) ) ;
        /* next year */
        $nextYear = $currentYear + 1 ;
        /* add one day to today in seconds*/
        $tomorrow = $currentDate + ( 1 * 24 * 60 * 60 ) ;
        $tomorrowYear = intval( date( "Y", $tomorrow ) ) ;        

        
        /*  CHECKIN STARTS*/
                
        $output = '<div id="b_searchCheckInDate">' ;
        $output .= '<h4 id="checkInDate_h4" style="' . $textcolor . '">' . $checkin . '</h4>' ;
        $output .= '<div class="b_searchDatesInner">' ;
        $output .= $calendar ? '<a id="b_checkinCalPos" class="b_requiresJsInline" href="javascript:showCalendar(\'b_checkinCalPos\', \'b_calendarPopup\', \'b_checkin\', \'b_frm\');" title="'. __('Open calendar and pick a date' , BOS_TEXT_DOMAIN ) . '"><img class="b_seeThrough" src="'. BOS_IMG_PLUGIN_DIR . '/b_calendar_icon.jpg'.'" alt="" title="'. __('Open calendar and pick a date' , BOS_TEXT_DOMAIN ) . '"  /></a>' : '' ;
      
            /* make checkin day selector */ 
        $output .= '<select name="checkin_monthday" id="b_checkin_day" onchange="checkDateOrder(\'b_frm\', \'b_checkin_day\', \'b_checkin_month\', \'b_checkout_day\', \'b_checkout_month\');">' ; 
        for( $currentDay=1; $currentDay < 32; $currentDay++ ) {
            
            $output .= '<option value="' . $currentDay . '"' ; 
            
            if( intval( date( "d", $currentDate ) ) == $currentDay ) {
                 
                $output .= ' selected="selected"' ; 
            }
             
            $output .= ">" . $currentDay . "</option>\n" ; 
        }
 
        $output .= '</select>' ; 
        
        /* make checkin month-year selector */ 
        
        $output .= '<span class="b_noWrap">' ;
        $output .= '<select name="checkin_year_month"  id="b_checkin_month"  onchange="checkDateOrder(\'b_frm\', \'b_checkin_day\', \'b_checkin_month\', \'b_checkout_day\', \'b_checkout_month\');">' ; 
        
        
        for( $currentMonth = intval( date( "m", $currentDate) ); $currentMonth < 13; $currentMonth++ ) {
                
            if( intval( date( "m", $currentDate ) ) == $currentMonth ){ $selected = 'selected="selected"' ; } else { $selected = '' ; }
            $output .= "<option " . $selected . " value='" . $currentYear . "-" . $currentMonth . "'>" . $monthName[ $currentMonth ] . "&nbsp" . $currentYear . "</option>\n" ;
           
        }
        
        for( $currentMonth = 1 ; $currentMonth < ( intval( date( "m", $currentDate) ) ) ; $currentMonth++ ) {
            
            $output .= "<option value='" . $nextYear . "-" . $currentMonth . "'>" . $monthName[ $currentMonth ] ."&nbsp". $nextYear."</option>\n" ;
           
        }
         
        $output .= '</select>' ;        
        $output .= '</span>' ;
        $output .= '</div>' ;        
        $output .= '</div>' ;
        
        
        
        /* CHECKOUT STARTS */
        
        
        /* make checkout day selector - default tomorrow */ 
        $output .= '<div id="b_searchCheckOutDate">' ; 
        $output .= '<h4 id="checkOutDate_h4" style="' . $textcolor . '">' . $checkout . '</h4>' ;
        $output .= '<div class="b_searchDatesInner">';
        $output .= $calendar ? '<a id="b_checkoutCalPos" cclass="b_requiresJsInline" href="javascript:showCalendar(\'b_checkoutCalPos\', \'b_calendarPopup\', \'b_checkout\', \'b_frm\');" title="'. __('Open calendar and pick a date' , BOS_TEXT_DOMAIN ) . '"><img class="b_seeThrough" src="'. BOS_IMG_PLUGIN_DIR . '/b_calendar_icon.jpg'.'" alt="" title="'. __('Open calendar and pick a date' , BOS_TEXT_DOMAIN ).'"  /></a>' : '' ;
        $output .= '<select name="checkout_monthday" id="b_checkout_day">'; 
        for( $tomorrowDay = 1; $tomorrowDay < 32; $tomorrowDay++ ) {
            
            $output .= '<option value="'.$tomorrowDay.'"' ; 
            if( intval( date( "d", $tomorrow) ) == $tomorrowDay ) {
                 
                $output .= ' selected="selected"' ; 
            }
            
            $output .= ">" . $tomorrowDay . "</option>\n" ; 
        }
         
        $output .= '</select>'; 
        
        /* make checkin month-year selector */ 
        $output .= '<span class="b_noWrap">' ;
        $output .= '<select name="checkout_year_month"  id="b_checkout_month">' ;       
        
        for( $currentMonth = intval( date( "m", $currentDate) ); $currentMonth < 13; $currentMonth++ ) {
                
            if( intval( date( "m", $tomorrow ) ) == $currentMonth ) { $selected = 'selected="selected"' ; } else { $selected = '' ; }
            $output .= "<option " . $selected . " value='" . $currentYear . "-" . $currentMonth . "'>" . $monthName[ $currentMonth ] . "&nbsp" . $currentYear . "</option>\n" ;
           
        }
        
        for( $currentMonth = 1 ; $currentMonth < ( intval( date( "m", $currentDate) ) ) ; $currentMonth++ ) {
            
            $output .= "<option value='" . $nextYear . "-" . $currentMonth . "'>" . $monthName[ $currentMonth ] ."&nbsp". $nextYear."</option>\n" ;
           
        }
         
        $output .= '</select>' ;      
        $output .= '</span>' ;
        $output .= '</div>' ;        
        $output .= '</div>' ;
        
        return $output;
               
   }    
     
     
?>