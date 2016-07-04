<?php
/**
 * resi functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package resi
 */ 
 

if ( ! function_exists( 'resi_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function resi_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on resi, use a find and replace
	 * to change 'resi' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'resi', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
    
    add_image_size( 'featured-image1', 900, 700, false ); /* EDITED SIVAS */


	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'resi' ),
		'social'  => esc_html__( 'Social', 'resi' ), 
        'topnavigation' => __( 'Top Navigation', 'resi' ),
	) );


	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'image',
	) );
	
	/* Editor styles. */
	add_editor_style( resi_get_editor_styles() ); 

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'resi_custom_background_args', array(
		'default-color' => 'f9f9f9',
		'default-image' => '',
	) ) );
}
endif; // resi_setup
add_action( 'after_setup_theme', 'resi_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function resi_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'resi_content_width', 640 );
}
add_action( 'after_setup_theme', 'resi_content_width', 0 );


/*-----------------------------------------------------------------------------------------------------//
	Register Widgets
	
	@link http://codex.wordpress.org/Function_Reference/register_sidebar
-------------------------------------------------------------------------------------------------------*/


function resi_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'resi' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) ); 
	register_sidebar( array(
		'name'          => esc_html__( 'Home Widget Area', 'resi' ),
		'id'            => 'home-widget-area-one',
		'description'   => esc_html__( 'Use this widget area to display home page content', 'resi' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">', 
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>', 
	) );
	
	//Register the sidebar widgets   
	register_widget( 'resi_Video_Widget' ); 
	register_widget( 'resi_Contact_Info' );
	register_widget( 'resi_social' );
	register_widget( 'resi_home_news' );
	
}
add_action( 'widgets_init', 'resi_widgets_init' );


/*-----------------------------------------------------------------------------------------------------//
	Scripts
-------------------------------------------------------------------------------------------------------*/


/**
 * Enqueue scripts and styles.
 */
function resi_scripts() {
	wp_enqueue_style( 'resi-style', get_stylesheet_uri() );
	
	$resi_headings_font = esc_html(get_theme_mod('headings_fonts'));
	$resi_body_font = esc_html(get_theme_mod('body_fonts'));  
	
	if( $resi_headings_font ) {
		wp_enqueue_style( 'resi-headings-fonts', '//fonts.googleapis.com/css?family='. $resi_headings_font );	
	} else {
		
	}	
	if( $resi_body_font ) {
		wp_enqueue_style( 'resi-body-fonts', '//fonts.googleapis.com/css?family='. $resi_body_font );	
	} else { 
		
	} 
	
	wp_enqueue_style( 'resi-font-awesome', get_template_directory_uri() . '/fonts/font-awesome.css' );
	
	$resi_filter_setting = get_theme_mod( 'resi_filter_options', 'option1' );
    													
    switch ( $resi_filter_setting ) {
		
   		case 'option1': 
	
		break;
	
    	case 'option2': 
	
		wp_enqueue_style( 'resi-grayscale-effect', get_template_directory_uri() . '/css/resi-grayscale-filter.css' ); 
	
    	break;
	
	} 

	wp_enqueue_style( 'resi-animate', get_template_directory_uri() . '/css/animate.css' );
	
	wp_enqueue_style( 'resi-menu', get_template_directory_uri() . '/css/jPushMenu.css' );

	wp_enqueue_script( 'resi-menu', get_template_directory_uri() . '/js/jPushMenu.js', array('jquery'), false, true );

	wp_enqueue_script( 'resi-menu-script', get_template_directory_uri() . '/js/menu.script.js', array(), false, true );

	wp_enqueue_script( 'resi-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'resi-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
    
    wp_enqueue_script( 'fixHeader', get_template_directory_uri() . '/js/custom/fixHeader.js', array('jquery'), false, true ); 
    
    wp_enqueue_script( 'grid_image_resize', get_template_directory_uri() . '/js/custom/grid_image_resize.js', array('jquery'), false, true );

	
	if ( is_page_template( 'template-home.php' ) || is_page_template( 'template-home-cover.php' ) || is_page_template( 'template-page-fullwidth-gallery.php' ) || is_page_template( 'template-page-gallery.php' ) ) {  
	
	wp_enqueue_style( 'resi-lightbox-css', get_template_directory_uri() . '/css/magnific-popup.css' ); 
	
	wp_enqueue_script( 'resi-images-loaded', get_template_directory_uri() . '/js/imagesloaded.pkgd.js', array(), false, true );
	
	wp_enqueue_script( 'resi-masonry', get_template_directory_uri() . '/js/masonry.pkgd.js', array(), false, true );
	
	wp_enqueue_script( 'resi-masonry-scripts', get_template_directory_uri() . '/js/masonry.script.js', array(), false, true );
	
	wp_enqueue_script( 'resi-lightbox', get_template_directory_uri() . '/js/jquery.magnific-popup.js', array('jquery'), false, true );
	
	wp_enqueue_script( 'resi-lightbox-popup', get_template_directory_uri() . '/js/lightbox.script.js', array('jquery'), false, true );
    
	
	}
	

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) { 
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_style( 'fixes', get_template_directory_uri() . '/css/custom/fixes.css' );
}
add_action( 'wp_enqueue_scripts', 'resi_scripts' );



/**
 * only files for category galleries
 */
function resi_gallery_script_includes( $template ) { 
	 
	    // Check if the taxonomy query contains only image formats
	    if ( is_category() || is_tag() ) {
	        $gallery_view = true;
	        global $wp_query;
	        if ( $wp_query->have_posts() ) :
	            while ( $wp_query->have_posts() ) : $wp_query->the_post();
	                $format = get_post_format();
	                if ( ( $format != 'image' ) ) {
	                     $gallery_view = false;
	                }
	            endwhile;
	        endif;
	        if ( $gallery_view ) {
	            
				// grid files
				wp_enqueue_style( 'resi-lightbox-css', get_template_directory_uri() . '/css/magnific-popup.css' ); 
	
				wp_enqueue_script( 'resi-images-loaded', get_template_directory_uri() . '/js/imagesloaded.pkgd.js', array(), false, true );
	
				wp_enqueue_script( 'resi-masonry', get_template_directory_uri() . '/js/masonry.pkgd.js', array(), false, true );
	
				wp_enqueue_script( 'resi-masonry-scripts', get_template_directory_uri() . '/js/masonry.script.js', array(), false, true );
	
				wp_enqueue_script( 'resi-lightbox', get_template_directory_uri() . '/js/jquery.magnific-popup.js', array('jquery'), false, true );
	
				wp_enqueue_script( 'resi-lightbox-popup', get_template_directory_uri() . '/js/lightbox.script.js', array('jquery'), false, true ); 
                
					
	        }
	    }

	    wp_enqueue_script( 'hide_header_on_scroll', get_template_directory_uri() . '/js/custom/hide_header_on_scroll.js', array ( 'jquery' ), false, true); // new
	 
	    return $template; 
	}
add_filter( 'template_include', 'resi_gallery_script_includes' );  

/* ADDED BY SIVAS*/
add_filter( 'image_size_names_choose', 'custom_image_sizes_choose' );

function custom_image_sizes_choose( $sizes ) {
    $custom_sizes = array(
        'featured-image1' => 'Type1 (16:9)'
    );
    return array_merge( $sizes, $custom_sizes );
}
/* end ADDED BY SIVAS*/

/**
 * Load html5shiv
 */
function resi_html5shiv() {
    echo '<!--[if lt IE 9]>' . "\n";
    echo '<script src="' . esc_url( get_template_directory_uri() . '/js/html5shiv.js' ) . '"></script>' . "\n";
    echo '<![endif]-->' . "\n";
}
add_action( 'wp_head', 'resi_html5shiv' );


/**
 * Change the excerpt length
 */
function resi_excerpt_length( $length ) {
	
	$excerpt = get_theme_mod('exc_length', '50'); 
	return $excerpt; 

}

add_filter( 'excerpt_length', 'resi_excerpt_length', 999 ); 


/*-----------------------------------------------------------------------------------------------------//
	Includes
-------------------------------------------------------------------------------------------------------*/

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Include additional custom admin panel features. 
 */
require get_template_directory() . '/panel/functions-admin.php';
require get_template_directory() . '/panel/theme-admin-page.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/resi-sanitize.php';
require get_template_directory() . '/inc/resi-styles.php'; 
require get_template_directory() . '/inc/resi-sidebar-columns.php'; 

/**
 * Google Fonts
 */
require get_template_directory() . '/inc/gfonts.php'; 

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php'; 

/**
 * Logged in CSS
 */
require get_template_directory() . '/inc/resi-logged-in-css.php';  

/**
 * register your custom widgets
 */ 
require get_template_directory() . "/widgets/contact-info.php"; 
require get_template_directory() . "/widgets/video-widget.php";
require get_template_directory() . "/widgets/widget-mt-social.php";
require get_template_directory() . "/widgets/widget-mt-home-news.php"; 

/**
 * get out of that loop
 */
function resi_exclude_post_formats_from_blog( $query ) {

	if( $query->is_main_query() && $query->is_home() ) {
		$tax_query = array( array(
			'taxonomy' => 'post_format',
			'field' => 'slug',
			'terms' => array( 'post-format-image' ),
			'operator' => 'NOT IN',
		) );
		$query->set( 'tax_query', $tax_query );
	}

}
add_action( 'pre_get_posts', 'resi_exclude_post_formats_from_blog' ); 


/**
 * category galleries for all
 */
function resi_gallery_template_chooser( $template ) {
	 
	    // Check if the taxonomy query contains only image formats
	    if ( is_category() || is_tag() ) {
	        $gallery_view = true;
	        global $wp_query;
	        if ( $wp_query->have_posts() ) :
	            while ( $wp_query->have_posts() ) : $wp_query->the_post();
	                $format = get_post_format();
	                if ( ( $format != 'image' ) ) {
	                     $gallery_view = false;
	                }
	            endwhile;
	        endif;
	        if ( $gallery_view ) {
	            // gallery template
	            $template = get_query_template( 'archive-image' );  
	        }
	    }
	 
	    return $template;
	}
add_filter( 'template_include', 'resi_gallery_template_chooser' );


// allow skype names in social menu
function resi_allow_skype_protocol( $protocols ){
    $protocols[] = 'skype';
    return $protocols;
}
add_filter( 'kses_allowed_protocols' , 'resi_allow_skype_protocol' );


// numbered pagination
function pagination($pages = '', $range = 4) {
	  
     $showitems = ($range * 2)+1;  
 
     global $paged;
     if(empty($paged)) $paged = 1;
 
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   
 
     if(1 != $pages)
     {
         echo "<div class=\"pagination\"><span>".$paged." of ".$pages."</span>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'></a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'></a>"; 
 
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
             }
         }
 
         if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\"></a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'></a>"; 
         echo "</div>\n";
     }
}

function mason_script() {
    wp_enqueue_script( 'jquery-masonry' );
}
add_action( 'wp_enqueue_scripts', 'mason_script' );

