<?php 

function resi_admin_page_styles() {
    wp_enqueue_style( 'resi-font-awesome-admin', get_template_directory_uri() . '/fonts/font-awesome.css' ); 
	wp_enqueue_style( 'resi-style-admin', get_template_directory_uri() . '/panel/css/theme-admin-style.css' );
}
add_action( 'admin_enqueue_scripts', 'resi_admin_page_styles' );
     
    add_action('admin_menu', 'resi_setup_menu'); 
     
    function resi_setup_menu(){
            add_theme_page( esc_html__( 'Resi Theme Details', 'resi' ), esc_html__( 'Resi Theme Details', 'resi' ), 'edit_theme_options', 'resi-setup', 'resi_init' );
    } 
     
 	function resi_init(){
	 	echo '<div class="grid grid-pad"><div class="col-1-1"><h1 style="text-align: center;">';
		printf( esc_html__('Thank you for using Resi!', 'resi' ));
        echo "</h1></div></div>";
			
		echo '<div class="grid grid-pad" style="border-bottom: 1px solid #ccc; padding-bottom: 40px; margin-bottom: 30px;" ><div class="col-1-3"><h2>'; 
		printf( esc_html__('Adding Images', 'resi' ));
        echo '</h2>'; 
		
		echo '<p>';
		printf( esc_html__('We created a quick video to show you how you add images to your galleries in Resi. Watch the video with the link below', 'resi' )); 
		echo '</p>'; 
		
		echo '<a href="https://modernthemes.net/resi-documentation/resi-add-images/" target="_blank"><button>';
		printf( esc_html__('View Video', 'resi' ));  
		echo "</button></a></div>";
		
		echo '<div class="col-1-3"><h2>'; 
		printf( esc_html__('Documentation', 'resi' )); 
        echo "</h2>";  
		
		echo '<p>';
		printf( esc_html__('Check out our Resi documentation to learn how to use resi and for tutorials on theme functions. Click the link below.', 'resi' ));  
		echo "</p>";
		
		echo '<a href="http://modernthemes.net/resi-documentation/" target="_blank"><button>'; 
		printf( esc_html__('Read Docs', 'resi' )); 
		echo "</button></a></div>";
		
		echo '<div class="col-1-3"><h2>'; 
		printf( esc_html__('About ModernThemes', 'resi' ));
        echo '</h2>';  
		
		echo '<p>';
		printf( esc_html__('Want to learn more about ModernThemes? Let us help you at modernthemes.net.', 'resi' )); 
		echo '</p>'; 
		
		echo '<a href="http://modernthemes.net/" target="_blank"><button>'; 
		printf( esc_html__('About Us', 'resi' )); 
		echo '</button></a></div></div>'; 
		
		echo '<div class="grid grid-pad senswp"><div class="col-1-1"><h1 style="padding-bottom: 30px; text-align: center;">';
		printf( esc_html__('Want more features? Go Pro.', 'resi' )); 
		echo '</h1></div>';
		
		echo '<div class="col-1-4"><i class="fa fa-image"></i><h4>';
        printf( esc_html__('More Image Filters', 'resi' ));
		echo '</h4>';
		
        echo '<p>';
		printf( esc_html__('Resi Pro offers 15 image filters and the option to set a different filter for each image instead of the same filter for the entire gallery.', 'resi' ));
		echo '</p></div>';
		
		echo '<div class="col-1-4"><i class="fa fa-th"></i><h4>';
		printf( esc_html__('More Theme Options', 'resi' ));
		echo '</h4>';
		
        echo '<p>';
		printf( esc_html__( 'Control the number of photos for your home gallery, hover effects for images in your gallery, and work with extra home widget areas.', 'resi' ));  
		echo '</p></div> ';
		
        echo '<div class="col-1-4"><i class="fa fa-shopping-cart"></i><h4>';
		printf( esc_html__('Sell Your Photos', 'resi' ));
		echo '</h4>';
		
        echo '<p>';
		printf( esc_html__('Make your website a powerful eCommerce machine. Resi Pro is compatible with WooCommerce to turn photos into profit.', 'resi' ));
		echo '</p></div>'; 
            
        echo '<div class="col-1-4"><i class="fa fa-columns"></i><h4>';
		printf( esc_html__( 'Lightbox Content', 'resi' ));
		echo '</h4>';
		
        echo '<p>';
		printf( esc_html__( 'With Resi Pro, add Title and Summary text content to your Lightbox images, which will help with SEO efforts for your images.', 'resi' ));
		echo '</p></div></div>';
            
        echo '<div class="grid grid-pad senswp"><div class="col-1-4"><i class="fa fa-th-list"></i><h4>'; 
		printf( esc_html__( 'Footer Widget Areas', 'resi' ));
		echo '</h4>';
		
        echo '<p>';
		printf( esc_html__( 'Want more content for your footer? Resi Pro has 4 footer widget areas to populate with any content you want.', 'resi' ));
		echo '</p></div>';
		
       	echo '<div class="col-1-4"><i class="fa fa-font"></i><h4>More Google Fonts</h4><p>';
		printf( esc_html__( 'Access over 100 Google fonts with Resi Pro right in the back-end of the WordPress customizer.', 'resi' ));
		echo '</p></div>';
		
       	echo '<div class="col-1-4"><i class="fa fa-file-image-o"></i><h4>';
		printf( esc_html__( 'More Sidebars', 'resi' ));
		echo '</h4>';
		
        echo '<p>';
		printf( esc_html__( 'Sometimes you need different sidebars for different pages. We got you covered, offering up to 5 different sidebars.', 'resi' ));
		echo '</p></div>';
            
        echo '<div class="col-1-4"><i class="fa fa-support"></i><h4>';
		printf( esc_html__( 'Free Support', 'resi' ));
		echo '</h4>';
		
        echo '<p>';
		printf( esc_html__( 'Call on us to help you out. Pro themes come with free support that goes directly to our support staff.', 'resi' ));
		echo '</p></div></div>';
		
		echo '<div class="grid grid-pad" style="border-bottom: 1px solid #ccc; padding-bottom: 50px; margin-bottom: 30px;"><div class="col-1-1"><a href="http://modernthemes.net/wordpress-themes/resi-pro/" target="_blank"><button class="pro">';
		printf( esc_html__( 'View Pro Version', 'resi' )); 
		echo '</button></a></div></div>';
		
		
		echo '<div class="grid grid-pad senswp"><div class="col-1-1"><h1 style="padding-bottom: 30px; text-align: center;">';
		printf( esc_html__('Premium Membership. Premium Experience.', 'resi' )); 
		echo '</h1></div>';
		
        echo '<div class="col-1-4"><i class="fa fa-cogs"></i><h4>'; 
		printf( esc_html__('Plugin Compatibility', 'resi' ));
		echo '</h4>';
		
        echo '<p>';
		printf( esc_html__('Use our new free plugins with this theme to add functionality for things like projects, clients, team members and more. Compatible with all premium themes!', 'resi' ));
		echo '</p></div>';
		
		echo '<div class="col-1-4"><i class="fa fa-desktop"></i><h4>'; 
        printf( esc_html__('Agency Designed Themes', 'resi' ));
		echo '</h4>';
		
        echo '<p>';
		printf( esc_html__('Look as good as can be with our new premium themes. Each one is agency designed with modern styles and professional layouts.', 'resi' ));
		echo '</p></div>'; 
		
        echo '<div class="col-1-4"><i class="fa fa-users"></i><h4>';
        printf( esc_html__('Membership Options', 'resi' ));
		echo '</h4>';
		
        echo '<p>';
		printf( esc_html__('We have options to fit every budget. Choose between a single theme, or access to all current and future themes for a year, or forever!', 'resi' ));
		echo '</p></div>'; 
		
		echo '<div class="col-1-4"><i class="fa fa-calendar"></i><h4>';
		printf( esc_html__( 'Access to New Themes', 'resi' )); 
		echo '</h4>';
		
        echo '<p>';
		printf( esc_html__( 'New themes added monthly! When you purchase a premium membership you get access to all premium themes, with new themes added monthly.', 'resi' ));   
		echo '</p></div>';
		
		
		echo '<div class="grid grid-pad" style="border-bottom: 1px solid #ccc; padding-bottom: 50px; margin-bottom: 30px;"><div class="col-1-1"><a href="https://modernthemes.net/premium-wordpress-themes/" target="_blank"><button class="pro">'; 
		printf( esc_html__( 'Get Premium Membership', 'resi' ));
		echo '</button></a></div></div>'; 
		
		echo '<div class="grid grid-pad"><div class="col-1-1"><h2 style="text-align: center;">'; 
		printf( esc_html__( 'Changelog' , 'resi' ) );
        echo "</h2>";
		
		echo '<p style="text-align: center;">'; 
		printf( __('1.2.3 - Fix: number input bug in theme customizer', 'resi' ));  
		echo '</p>';
		
		echo '<p style="text-align: center;">'; 
		printf( __('1.2.2 - Fix: removed http from Skype social icons', 'resi' ));  
		echo '</p>';
		
		echo '<p style="text-align: center;">'; 
		printf( __('1.2.1 - Update: Tested with WordPress 4.5, Updating Font Awesome icons to 4.6, Added Snapchat and Weibo social icon options', 'resi' ));  
		echo '</p>';
		
		echo '<p style="text-align: center;">'; 
		printf( __('1.1.8 - Update: Added an option for pagination in Gallery and Fullwidth Gallery pages. Go to Appearance => Image Gallery => Gallery Page Pagination to set bottom pagination for gallery pages.', 'resi' ));  
		echo '</p>';
		
		echo '<p style="text-align: center;">'; 
		printf( esc_html__('1.1.7 - Update: added many new social icon options to MT - Social Icons widget', 'resi' ));  
		echo '</p>'; 
		
		echo '<p style="text-align: center;">'; 
		printf( esc_html__('1.1.6 - added Soundcloud, Lastfm, RSS feed, email, and telephone to social menu', 'resi' )); 
		echo '</p>'; 
		
		echo '<p style="text-align: center;">'; 
		printf( esc_html__('1.1.5 - updated demo link in theme description', 'resi' )); 
		echo '</p>'; 
		
		echo '<p style="text-align: center;">'; 
		printf( esc_html__('1.1.4 - added option in theme customizer (Appearance => Customize => Blog) to display excerpt and select the amount of words for excerpt', 'resi' )); 
		echo '</p>';  
		
		echo '<p style="text-align: center;">'; 
		printf( esc_html__('1.1.3 - added option in theme customizer (Appearance => Customize => Blog) to add sidebar to blog pages', 'resi' )); 
		echo '</p>'; 
		
		echo '<p style="text-align: center;">'; 
		printf( esc_html__('1.1.1 - added new Font Awesome 4.5 icons', 'resi' )); 
		echo '</p>';
		
		echo '<p style="text-align: center;">'; 
		printf( esc_html__('1.1.0 - added VK to social icons', 'resi' ));
		echo '</p>'; 
		
		echo '<p style="text-align: center;">'; 
		printf( esc_html__('1.0.21 - minor bug fixes and improvements', 'resi' ));
		echo '</p>'; 
		
		echo '<p style="text-align: center;">'; 
		printf( esc_html__('1.0.0 - New Theme!', 'resi' ));
		echo '</p></div></div>';  
		 	 
    }
?>