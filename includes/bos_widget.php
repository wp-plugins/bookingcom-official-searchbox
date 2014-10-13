<?php
/**
 * WIDGET SECTION
 * ----------------------------------------------------------------------------
 */
  
// use widgets_init action hook to execute custom function
add_action( 'widgets_init', 'bos_searchbox_register_widgets' ) ;
function bos_searchbox_register_widgets() {
    
    register_widget( 'bos_searchbox_widget' );
    
}

class bos_searchbox_widget extends WP_Widget {

    //process the new widget
    function bos_searchbox_widget() {
        $widget_ops = array( 
            'classname' => 'bos_searchbox_widget_class', 
            'description' => __( 'Display an accomodation search box', BOS_TEXT_DOMAIN )
            ); 
        $this->WP_Widget( 'bos_searchbox_widget', BOS_PLUGIN_NAME, $widget_ops ) ;          
        
    } 
    
    //display the widget
    function widget( $args, $instance ) {
        
        extract( $args ) ;
        echo $before_widget ;
        //retrieve all options stored in DB
        $options = bos_searchbox_retrieve_all_user_options() ;
        $preview = false ; //This is the front-end searchbox
        bos_create_searchbox( $options , $preview ) ;          
        echo $after_widget ;
        
    }
    
}

?>