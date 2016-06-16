<?php
/**
 * resi Theme Customizer
 *
 * @package resi
 */


/**
 * Add CSS in <head> for styles handled by the theme customizer 
 *
 * @since 1.5
 */
function resi_add_customizer_css() { 
	
?>
	<!-- resi customizer CSS --> 
	<style> 
	
	
	
		<?php if ( get_theme_mod( 'resi_nav_bg' ) ) : ?>
		.pre-header { background-color: <?php echo esc_attr( get_theme_mod( 'resi_nav_bg', '#ffffff' )) ?>; }
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'resi_nav_link_color' ) ) : ?>
		.main-navigation a { color: <?php echo esc_attr( get_theme_mod( 'resi_nav_link_color', '#888888' )) ?>; }
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'resi_nav_link_hover_color' ) ) : ?>
		.main-navigation li:hover > a, .main-navigation li.focus > a { color: <?php echo esc_attr( get_theme_mod( 'resi_nav_link_hover_color', '#222222' )) ?>; } 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'resi_nav_link_active_color' ) ) : ?>
		.main-navigation .current_page_item > a, .main-navigation .current-menu-item > a, .main-navigation .current_page_ancestor > a { color: <?php echo esc_attr( get_theme_mod( 'resi_nav_link_active_color', '#222222' )) ?>; } 
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'resi_nav_dropdown_bg_color' ) ) : ?>
		.main-navigation ul ul { background-color: <?php echo esc_attr( get_theme_mod( 'resi_nav_dropdown_bg_color', '#ffffff' )) ?>; } 
		<?php endif; ?>  
		
		<?php if ( get_theme_mod( 'resi_nav_dropdown_border_color' ) ) : ?>
		.main-navigation ul ul, .main-navigation ul ul a { border-color: <?php echo esc_attr( get_theme_mod( 'resi_nav_dropdown_border_color', '#cccccc' )) ?>; } 
		<?php endif; ?>
		
		
		
		<?php if ( get_theme_mod( 'resi_text_color' ) ) : ?> 
		body, textarea, p { color: <?php echo esc_attr( get_theme_mod( 'resi_text_color', '#404040' )) ?>; }
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'resi_link_color' ) ) : ?>
		a { color: <?php echo esc_attr( get_theme_mod( 'resi_link_color', '#222222' )) ?>; } 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'resi_hover_color' ) ) : ?>
		a:hover { color: <?php echo esc_attr( get_theme_mod( 'resi_hover_color', '#666666' )) ?>; }
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'resi_body_size' ) ) : ?>
		body, p { font-size: <?php echo esc_attr( get_theme_mod( 'resi_body_size', '16' )) ?>px; } 
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'resi_site_title_color' ) ) : ?>
		h1.site-title a { color: <?php echo esc_attr( get_theme_mod( 'resi_site_title_color', '#222222' )) ?>; } 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'resi_entry' ) ) : ?>
		.entry-title { color: <?php echo esc_attr( get_theme_mod( 'resi_entry', '#404040' )) ?>; } 
		<?php endif; ?> 
		
		
		
		<?php if ( get_theme_mod( 'resi_button_color' ) ) : ?>
		.pagination span, .pagination a, button, input[type="button"], input[type="reset"], input[type="submit"] { background: <?php echo esc_attr( get_theme_mod( 'resi_button_color', '#222222' )) ?>; }  
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'resi_button_color' ) ) : ?> 
		button, input[type="button"], input[type="reset"], input[type="submit"] { border-color: <?php echo esc_attr( get_theme_mod( 'resi_button_color', '#222222' )) ?>; }    
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'resi_button_hover_color' ) ) : ?>
		.pagination .current, .pagination a:hover, button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover { background: <?php echo esc_attr( get_theme_mod( 'resi_button_hover_color', '#666666' )) ?>; } 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'resi_button_hover_color' ) ) : ?>  
		button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover { border-color: <?php echo esc_attr( get_theme_mod( 'resi_button_hover_color', '#666666' )) ?>; }   
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'resi_page_bg' ) ) : ?>
		.solid-background .content-area, .solid-background .widget-area aside { background-color: <?php echo esc_attr( get_theme_mod( 'resi_page_bg', '#ffffff' )) ?>; } 
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'resi_page_border' ) ) : ?>
		.solid-background .content-area, .solid-background .widget-area aside { border-color: <?php echo esc_attr( get_theme_mod( 'resi_page_border', '#cccccc' )) ?>; } 
		<?php endif; ?>   
		
		<?php if ( get_theme_mod( 'resi_blockquote' ) ) : ?>
		blockquote { border-color: <?php echo esc_attr( get_theme_mod( 'resi_blockquote', '#404040' )) ?>; } 
		<?php endif; ?>   
		
		
		
		
		<?php if ( get_theme_mod( 'resi_social_color' ) ) : ?>
		.social-media-icons li .fa, #menu-social li a::before  { color: <?php echo esc_attr( get_theme_mod( 'resi_social_color', '#222222' )) ?>; } 
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'resi_social_color_hover' ) ) : ?>
		.social-media-icons li .fa:hover, #menu-social li a:hover::before { color: <?php echo esc_attr( get_theme_mod( 'resi_social_color_hover', '#666666' )) ?>; 
		}
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'resi_social_text_size' ) ) : ?>
		.social-media-icons li .fa, #menu-social li a::before { font-size: <?php echo esc_attr( get_theme_mod( 'resi_social_text_size', '16' )) ?>px; }
		<?php endif; ?>
		
		
		
		<?php if ( get_theme_mod( 'resi_footer_text_color' ) ) : ?>
		.site-info { color: <?php echo esc_attr( get_theme_mod( 'resi_footer_text_color', '#404040' )) ?>; }
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'resi_footer_link_color' ) ) : ?>
		.site-info a { color: <?php echo esc_attr( get_theme_mod( 'resi_footer_link_color', '#222222' )) ?>; }
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'resi_footer_link_hover_color' ) ) : ?>
		.site-info a:hover { color: <?php echo esc_attr( get_theme_mod( 'resi_footer_link_hover_color', '#666666' )) ?>; }
		<?php endif; ?> 
		
		
		
		<?php if ( get_theme_mod( 'resi_hw_area_1_bg_color' ) ) : ?>
		.home-widget-one { background-color: <?php echo esc_attr( get_theme_mod( 'resi_hw_area_1_bg_color', '#f9f9f9' )) ?>; } 
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'resi_hw_area_1_heading_color' ) ) : ?>
		.home-widget-one h1, .home-widget-one h2, .home-widget-one h3, .home-widget-one h4, .home-widget-one h5, .home-widget-one h6 { color: <?php echo esc_attr( get_theme_mod( 'resi_hw_area_1_heading_color', '#404040' )) ?>; } 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'resi_hw_area_1_text_color' ) ) : ?> 
		.home-widget-one, .home-widget-one p { color: <?php echo esc_attr( get_theme_mod( 'resi_hw_area_1_text_color', '#404040' )) ?>; } 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'resi_hw_area_1_link_color' ) ) : ?>
		.home-widget-one a { color: <?php echo esc_attr( get_theme_mod( 'resi_hw_area_1_link_color', '#222222' )) ?>; } 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'resi_hw_area_1_link_hover_color' ) ) : ?>
		.home-widget-one a:hover { color: <?php echo esc_attr( get_theme_mod( 'resi_hw_area_1_link_hover_color', '#666666' )) ?>; } 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'resi_hw_area_1_button_color' ) ) : ?>
		.home-widget-one button { background: <?php echo esc_attr( get_theme_mod( 'resi_hw_area_1_button_color', '#222222' )) ?>; } 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'resi_hw_area_1_button_color' ) ) : ?> 
		.home-widget-one button { border-color: <?php echo esc_attr( get_theme_mod( 'resi_hw_area_1_button_color', '#222222' )) ?>; }   
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'resi_hw_area_1_button_hover_color' ) ) : ?>
		.home-widget-one button:hover { background: <?php echo esc_attr( get_theme_mod( 'resi_hw_area_1_button_hover_color', '#666666' )) ?>; } 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'resi_hw_area_1_button_hover_color' ) ) : ?>
		.home-widget-one button:hover { border-color: <?php echo esc_attr( get_theme_mod( 'resi_hw_area_1_button_hover_color', '#666666' )) ?>; } 
		<?php endif; ?>
		
		
		<?php if ( get_theme_mod( 'resi_cover_gallery_title' ) ) : ?>
		.header-cover p.site-description, .header-cover h1.site-title a { color: <?php echo esc_attr( get_theme_mod( 'resi_cover_gallery_title', '#ffffff' )) ?>; } 
		<?php endif; ?>
		
		
		<?php if ( get_theme_mod( 'resi_gallery_lb_text' ) ) : ?>
		.mfp-title p, .mfp-counter, .mfp-title, h3.mfp-title { color: <?php echo esc_attr( get_theme_mod( 'resi_gallery_lb_text', '#ffffff' )) ?>; } 
		<?php endif; ?>  
		
		.blog-fullwidth .content-area { background-color: transparent !important; } 
		
		
	</style>
<?php }


add_action( 'wp_head', 'resi_add_customizer_css' );  

