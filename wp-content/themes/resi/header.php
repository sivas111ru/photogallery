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
    
    
    
    <div id="nav-header">  <!-- class="pre-header"> EDITED-->
       
<div id="menu-bar">
 <div id="topmenud">
       <div id="authorName">
        <h2>KEITH SCHOFIELD</h2>
        <h4>PHOTOGRAPHY</h4></div>
    <div class="navigation-container">

        <nav id="site-navigation" class="main-navigation" role="navigation">
<!-- EDITED SIVAS transfer toggle btn to page.php -->

            <div id="mainMenu">

                <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>

            </div>
        </nav>
        <!-- #site-navigation -->

    </div>
</div>
    </div>
        
        <?php if( get_theme_mod( 'active_social_icons' ) == '') : ?>   
        
			<div class="social-container"> 
        
        		<?php get_template_part( 'menu', 'social' ); ?>
            
        	</div>
            
        <?php endif; ?>
        
        
    </div>


	 <header id="masthead" class="site-header" role="banner">
 
         <!-- deleted -->
	</header><!-- #masthead --> 
    
    <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left">
        <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
    </nav>

	<div id="content" class="site-content">
