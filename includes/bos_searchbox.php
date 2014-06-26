
<div id="flexi_searchbox" style="<?php echo  $bgcolor ? 'background-color:'. $bgcolor .';' : ''; echo  $textcolor ? 'color:'. $textcolor .';' : '' ; echo $widget_width ? 'width:'. $widget_width . 'px;' : '' ;  ?>" >

    <div id="b_searchboxInc">
        <h3 class="search-box-title-1"  style="<?php echo  $textcolor ? 'color:' . $textcolor . ';' : 'color: #003580;' ; ?>"><?php echo $maintitle ; ?></h3>
         <form id="b_frm" action="<?php echo $target_page ; ?>" method="get" target="_blank" onsubmit="return sp.validation.validSearch();">
            <div id="searchBox_error_msg" class="b_error b_external_searchbox" style="display: none;"></div>
            <div id="b_frmInner">
                
                <input type="hidden" name="error_url" value="<?php echo $target_page ; ?>?aid=<?php echo $aid ; ?>;" />
                <input type="hidden" name="si" value="ai,co,ci,re,di" />
                <input type="hidden" name="label" value="wp-searchbox-widget-<?php echo !empty( $options[ 'aid' ] ) ? $options[ 'aid' ] : BOS_DEFAULT_AID ; ?>" />
                
                                 
                <input type="hidden" name="aid" value="<?php echo $aid ; ?>" />
                <input type="hidden" name="utm_campaign" value="search_box" /> 
                <input type="hidden" name="utm_medium" value="sp" /> 
                <input type="hidden" name="utm_term" value="wp-searchbox-widget-<?php echo $aid ; ?>" /> 

                <div id="b_searchDest">
                    
                    <?php if ( $destination ) { ?>
                        <input type="text" id="b_destination" name="ss" value="<?php echo $destination ; ?>" />
                    <?php } else { ?>
                        <input type="text" id="b_destination" name="ss" placeholder="<?php _e('e.g. city, region, district or specific hotel' , BOS_TEXT_DOMAIN ) ; ?>" title="<?php _e( 'e.g. city, region, district or specific hotel' , BOS_TEXT_DOMAIN ) ;?>" />
                    <?php } ?>
                    
                </div><!-- #b_searchDest -->

                <div id="searchBox_dates_error_msg" class="b_error b_external_searchbox" style="display: none ;"></div>


                 <?php  
                    //Include function generate date
                    include_once BOS_INC_PLUGIN_DIR . '/bos_date_array.php';
                                        
                    echo bos_dateSelector( $month_format, $calendar, $checkin, $checkout, $textcolor );  
                ?>

                <div class="b_avail">
                    <input type="hidden" value="on" name="do_availability_check" />
                </div><!-- .b_submitButton_wrapper-->
                
                
                <?php if ( !empty( $flexible_dates ) ) { ?>                
                <div id="b_flexible_dates">
                    <label class="b-checkbox__container">
                        <input type="checkbox" name="idf" />
                        <span><?php echo __( ' I don\'t have specific dates yet ' , BOS_TEXT_DOMAIN ) ?> </span>
                    </label>
                </div>
                <?php } ?>
                
                <div class="b_submitButton_wrapper">
                    <input class="b_submitButton" type="submit" value="<?php  echo $submit ; ?>" style="<?php echo  $submit_bgcolor ? 'background-color:'. $submit_bgcolor . ';' : '' ; echo  $submit_textcolor ? 'color:'. $submit_textcolor . ';' : '' ; echo $submit_bordercolor ? 'border-color:' . $submit_bordercolor . ';' : '' ;  ?>"/>
                </div><!-- .b_submitButton_wrapper-->
                
                <div id="b_logo" <?php echo  $logopos ? 'style="text-align:' . $logopos . ';"' : '' ;  ?> ><img src="<?php echo BOS_IMG_PLUGIN_DIR .'/booking_logotype_' . $logodim . '.png' ; ?>" alt="Booking.com"></div>                
                <!-- #b_logo" -->                        
                

            </div><!-- #b_frmInner -->
         </form>
    </div><!-- #b_searchboxInc -->


    <div id="b_calendarPopup" class="b_popup">
        <div id="b_calendarInner" class="b_popupInner "></div>
    </div>

</div><!-- #flexi_searchbox -->