<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package resi
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"> 
<?php wp_head(); ?> 
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site animated fadeIn delay">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'resi' ); ?></a>
    
    <div id="nav-header" class="pre-header">
    	<div class="navigation-container">
        
    	 <nav id="site-navigation" class="main-navigation" role="navigation">
         
             <button class="menu-toggle toggle-menu menu-left push-body" aria-controls="primary-menu" aria-expanded="false">
			 	
				<?php $resi_menu_toggle_option = get_theme_mod( 'resi_menu_toggle', 'icon' ); 

					$resi_menu_display = '';

					if ( $resi_menu_toggle_option == 'icon' ) {
				
						$resi_menu_display = sprintf( '<i class="fa fa-bars"></i>' );
			
					} else if ( $resi_menu_toggle_option == 'label' ) {
				
						$resi_menu_display = esc_html__( 'Menu', 'resi' );
			
					} else if ( $resi_menu_toggle_option == 'icon-label' ) {
				
						$resi_menu_display = sprintf( '<i class="fa fa-bars"></i>', esc_html__( 'Menu', 'resi' ) );    
			
					}

					echo $resi_menu_display; ?>
            
             </button>
             
             <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
             
         </nav><!-- #site-navigation -->
         
       	</div>
        
        
        <?php if( get_theme_mod( 'active_social_icons' ) == '') : ?>   
        
			<div class="social-container"> 
        
        		<?php get_template_part( 'menu', 'social' ); ?>
            
        	</div>
            
        <?php endif; ?>
        
        
    </div>


	<?php if( get_theme_mod( 'active_cover_title' ) == '') : ?>  

	<header id="masthead" class="site-header header-cover" role="banner">
                <div class="site-branding">
                	
                   
                    
					<?php if ( get_theme_mod( 'resi_logo' ) ) : ?>
              
    					<div class="site-logo site-title"> 
       						<a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'>
                            
                    			<img 
                                
                                	src='<?php echo esc_url( get_theme_mod( 'resi_logo' ) ); ?>' 
                                
									<?php if ( get_theme_mod( 'logo_size' ) ) : ?>
                                    	width="<?php echo esc_attr( get_theme_mod( 'logo_size', '165' )); ?>"
									<?php endif; ?> 
                                    
                                    alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"
                                >
                                
                    		</a> 
    					</div><!-- site-logo -->  
                
					<?php else : ?>
            
    					<hgroup>
       						<h1 class='site-title'> 
                            
                    			<a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'>
									<?php bloginfo( 'name' ); ?>
                    			</a>
                                
                    		</h1>
    					</hgroup>
                
					<?php endif; ?>
        
					<?php if( get_bloginfo('description') <> '') : ?>
        			
                    	<p class="site-description">
							<?php bloginfo( 'description' ); ?>   
                        </p>
                        
                    <?php endif; ?>
                    
                
                    
                </div><!-- .site-branding -->
                
	</header><!-- #masthead -->
    
    <?php endif; ?> 
    
    <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left">
        <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
    </nav>

	<div id="content" class="site-content">
