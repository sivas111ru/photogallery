<?php 

			
/*-----------------------------------------------------------------------------------------------------//
	Home Widget One
-------------------------------------------------------------------------------------------------------*/
	
function resi_home_widget_one_style() {

	$widget_column_one = esc_html( get_theme_mod( 'resi_widget_column_one' ));
    			
	if( $widget_column_one != '' ) { 
    
		switch ( $widget_column_one ) {
            	
			case 'option1':
            // 1 Column 
            break;
			
           	case 'option2':
                	
				echo '<style type="text/css">';
                echo '.home-widget-one .widget, .home-widget-one section { width: 50%; float:left; padding-right: 30px; }';
				echo '@media handheld, only screen and (max-width: 767px) {';
				echo '.home-widget-one .widget, .home-widget-one section { width: 100%; float:none; padding-right: 0px; }';
                echo '}';
				echo '</style>';
                break;
				
           	case 'option3': 
			
                echo '<style type="text/css">';
                echo '.home-widget-one .widget, .home-widget-one section { width: 33.33%; float:left; padding-right: 30px; }';
				echo '@media handheld, only screen and (max-width: 767px) {';
				echo '.home-widget-one .widget, .home-widget-one section { width: 100%; float:none; padding-right: 0px; }';
                echo '}';
				echo '</style>';
                break;
				
			case 'option4':
                	
				echo '<style type="text/css">';
                echo '.home-widget-one .widget, .home-widget-one section { width: 25%; float:left; padding-right: 30px; }'; 
				echo '@media handheld, only screen and (max-width: 767px) {';
				echo '.home-widget-one .widget, .home-widget-one section { width: 100%; float:none; padding-right: 0px; }';
                echo '}'; 
				echo '</style>';
                break; 
				
        }
    }
	
}
	
add_action( 'wp_enqueue_scripts', 'resi_home_widget_one_style' );
