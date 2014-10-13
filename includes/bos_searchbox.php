
<?php
    // Retrieve all meta box values
    $bos_mb_destination = '' ;
    $bos_mb_dest_type = '' ;
    $bos_mb_dest_id = '' ;
    if ( is_page() || is_single() ) {
        
        global $wp_query;
        $postid = $wp_query->post->ID;
        $bos_mb_destination =  get_post_meta( $postid, '_bos_mb_destination', true ) ;
        $bos_mb_dest_type =  get_post_meta( $postid, '_bos_mb_dest_type', true ) ;
        $bos_mb_dest_id =  get_post_meta( $postid, '_bos_mb_dest_id', true ) ;
        wp_reset_query();
        
    }
    
?>

<div id="flexi_searchbox" style="<?php echo  $bgcolor ? 'background-color:'. $bgcolor .';' : ''; echo  $textcolor ? 'color:'. $textcolor .';' : '' ; echo $widget_width ? 'width:'. $widget_width . 'px;' : '' ; ?>" data-ver="<?php echo BOS_PLUGIN_VERSION ; ?>" >

    <div id="b_searchboxInc">
        <h3 class="search-box-title-1"  style="<?php echo  $textcolor ? 'color:' . $textcolor . ';' : 'color: #003580;' ; ?>"><?php echo $maintitle ; ?></h3>
         <form id="b_frm" action="<?php echo $prot . $target_page ; ?>" method="get" target="_blank" onsubmit="return sp.validation.validSearch();">
            <div id="searchBox_error_msg" class="b_error b_external_searchbox" style="display: none;"></div>
            <div id="b_frmInner">
                
                <input type="hidden" name="error_url" value="<?php echo $prot . $target_page ; ?>?aid=<?php echo $aid ; ?>;" />
                <input type="hidden" name="si" value="ai,co,ci,re,di" />
                <input type="hidden" name="label" value="wp-searchbox-widget-<?php echo $aid ; ?>" />
                
                                 
                <input type="hidden" name="aid" value="<?php echo $aid ; ?>" />
                <input type="hidden" name="utm_campaign" value="search_box" /> 
                <input type="hidden" name="utm_medium" value="sp" /> 
                <input type="hidden" name="utm_term" value="wp-searchbox-widget-<?php echo $aid ; ?>" />            
            


                <div id="b_searchDest">
                    <h4 id="b_destination_h4"><?php echo $dest_title ; ?></h4>
                    
                    <?php
                    
                    /*echo 'dest_type:'.$dest_type ;
                    echo 'dest_id:'.$dest_id ;
                    echo 'bos_mb_dest_type:'.$bos_mb_dest_type ;
                    echo 'bos_mb_dest_id:'.$bos_mb_dest_id ; */                  
                    
                    
                    if ( !empty( $bos_mb_destination ) ) {//$bos_mb_destination can have values ONLY on page and single post template 
                        
                       if ( $bos_mb_dest_type != 'select' && !empty( $bos_mb_dest_id ) ) { // Set destination type and id if exists from meta boxes only if page or single post template
                        
                            echo '<span class="b_dest_wrap"><input type="text" id="b_destination"  class="b_destination" name="ss" value="' . $bos_mb_destination . '" readonly="readonly" />' ;
                            echo '<a href="#" id="b_dest_unlocker" title="' . __( 'Click the lock icon to choose another destination', BOS_TEXT_DOMAIN ) . '"><img  style="border: none;cursor:pointer;" src="' . BOS_IMG_PLUGIN_DIR . '/bos_lock_closed_icon.png" alt="lock icon"></a>' ;
                            echo '<div id="b_open_search" style="display: none;">' . __( 'Click the lock icon to choose another destination', BOS_TEXT_DOMAIN ) . '</div>' ;
                            echo '</span>' ;                           
                            echo '<input id="b_dest_type" type="hidden" name="dest_type" value="' . $bos_mb_dest_type . '" />' ;
                            echo '<input id="b_dest_id" type="hidden" name="dest_id" value="' . $bos_mb_dest_id . '" />' ;
                            
                        } // !empty( $bos_mb_dest_type ) && !empty( $bos_mb_dest_id )  
                        
                        else {
                            
                            echo '<input type="text" id="b_destination" name="ss" value="' . $bos_mb_destination . '" />' ;
   
                        }                    
                        
                    }
                    
                    else if ( !empty( $destination ) ) {
                             
                        if ( $dest_type != BOS_DEST_TYPE && !empty( $dest_id ) ) { // Set destination type and id if exists from settings
                            
                            echo '<span class="b_dest_wrap"><input type="text" id="b_destination"  class="b_destination" name="ss" value="' . $destination .'" readonly="readonly" />' ;
                            echo '<a href="#" id="b_dest_unlocker" title="' .  __( 'Click the lock icon to choose another destination', BOS_TEXT_DOMAIN ) . '"><img  style="border: none;cursor:pointer;" src="' . BOS_IMG_PLUGIN_DIR . '/bos_lock_closed_icon.png" alt="lock icon"></a>' ;
                            echo '<div id="b_open_search" style="display: none;">' . __( 'Click the lock icon to choose another destination', BOS_TEXT_DOMAIN ) . '</div>' ;
                            echo '</span>' ;
                            echo '<input id="b_dest_type" type="hidden" name="dest_type" value="' . $dest_type . '" />' ;
                            echo '<input id="b_dest_id" type="hidden" name="dest_id" value="' . $dest_id . '" />' ;
                            
                        }
                        
                        else {
                            
                            echo '<input type="text" id="b_destination" name="ss" value="' . $destination .'" />' ;
   
                        }
                    
                    } else {
                         
                        echo '<input type="text" id="b_destination" name="ss" placeholder="' . __( 'e.g. city, region, district or specific hotel' , BOS_TEXT_DOMAIN ) . '" title="' . __( 'e.g. city, region, district or specific hotel' , BOS_TEXT_DOMAIN ) . '" />' ;
                    
                    }                    
                    
                    
                    ?>
                    
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
                
                
                <?php if ( $flexible_dates ) { ?>                
                <div id="b_flexible_dates">
                    <label class="b_checkbox_container">
                        <input type="checkbox" name="idf" id="b_idf"/>
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