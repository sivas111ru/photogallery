<?php
/**
 * resi Theme Customizer.
 *
 * @package resi
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function resi_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	
	//premiums are better 
    class resi_Info extends WP_Customize_Control { 
     
        public $label = '';
        public function render_content() {  ?>

        <?php }} 
	
	
//-------------------------------------------------------------------------------------------------------------------//
// Upgrade
//-------------------------------------------------------------------------------------------------------------------//

    $wp_customize->add_section(
        'resi_theme_info',
        array(
            'title' => esc_html__('Resi Pro', 'resi'),  
            'priority' => 1,  
            'description' => __( 'Want more options for Resi? Resi Pro comes with 15 image filters that can be set by individual image, 5 home page gallery layouts, more home and footer widget areas, cool hover effects for your images, and is WooCommerce-ready so you can sell your photos.<br><br>If you want to see all the additional features Resi Pro has, check them all out by visting the theme page at https://modernthemes.net/wordpress-themes/resi-pro or visiting the following link: <a href="https://modernthemes.net/wordpress-themes/resi-pro/" target="_blank">Get Resi Pro</a>', 'resi' ),
    ));
	
	 //show them what we have to offer
    $wp_customize->add_setting('resi_help', array(
		'sanitize_callback' => 'resi_no_sanitize',
        'type' => 'info_control',
        'capability' => 'edit_theme_options',
    ));
	
    $wp_customize->add_control( new resi_Info( $wp_customize, 'resi_help', array(
        'section' => 'resi_theme_info',
        'settings' => 'resi_help',  
        'priority' => 5
    ))); 
	
	
//-------------------------------------------------------------------------------------------------------------------//
// Move and Replace
//-------------------------------------------------------------------------------------------------------------------// 
	
	//Colors
	$wp_customize->add_panel( 'resi_colors_panel', array(
    'priority'       => 40,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => esc_html__( 'General Colors', 'resi' ),
    'description'    => esc_html__( 'Edit your general color settings.', 'resi' ),
	));
	
	//Nav
	$wp_customize->add_panel( 'resi_nav_panel', array( 
    'priority'       => 22,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => esc_html__( 'Navigation', 'resi' ), 
    'description'    => esc_html__( 'Edit your theme navigation settings.', 'resi' ),
	));
	
	// nav 
	$wp_customize->add_section( 'nav', array( 
	'title' => esc_html__( 'Navigation Settings', 'resi' ),
	'priority' => '10',  
	'panel' => 'resi_nav_panel'
	));
	
	// colors
	$wp_customize->add_section( 'colors', array(
	'title' => esc_html__( 'Theme Colors', 'resi' ), 
	'priority' => '10', 
	'panel' => 'resi_colors_panel' 
	));
	
	// Move sections up 
	$wp_customize->get_section('static_front_page')->priority = 5; 
	
	$wp_customize->remove_section('header_image');
	
	
	
//-------------------------------------------------------------------------------------------------------------------//
// Navigation
//-------------------------------------------------------------------------------------------------------------------//

 
	// Nav menu toggle
	$wp_customize->add_setting( 'resi_menu_toggle', array(
		'default' => 'icon', 
    	'capability' => 'edit_theme_options',
    	'sanitize_callback' => 'resi_sanitize_menu_toggle_display',  
  	));

  	$wp_customize->add_control( 'resi_menu_toggle_radio', array(
    	'settings' => 'resi_menu_toggle',
    	'label'    => esc_html__( 'Menu Toggle Display', 'resi' ), 
    	'section'  => 'nav',
    	'type'     => 'radio',
    	'choices'  => array(
      		'icon' => esc_html__( 'Icon', 'resi' ),
      		'label' => esc_html__( 'Menu', 'resi' ),
      		'icon-label' => esc_html__( 'Icon and Menu', 'resi' ) 
    	), 
	));
	
	// Nav Colors
    $wp_customize->add_section( 'resi_nav_colors_section' , array(
	    'title'       => esc_html__( 'Navigation Colors', 'resi' ),
	    'priority'    => 20, 
	    'description' => esc_html__( 'Set your theme navigation colors.', 'resi'),
		'panel' => 'resi_nav_panel',
	));
	
	$wp_customize->add_setting( 'resi_nav_bg', array(
		 'default'     => '#ffffff', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'resi_nav_bg', array(
        'label'	   => esc_html__( 'Navigation Background', 'resi' ),
        'section'  => 'resi_nav_colors_section',
        'settings' => 'resi_nav_bg', 
		'priority' => 10
    )));
	
	$wp_customize->add_setting( 'resi_nav_link_color', array( 
        'default'     => '#888888',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'resi_nav_link_color', array(
        'label'	   => esc_html__( 'Navigation Link', 'resi' ),
        'section'  => 'resi_nav_colors_section',
        'settings' => 'resi_nav_link_color',
		'priority' => 20 
    )));
	
	$wp_customize->add_setting( 'resi_nav_link_hover_color', array(
		 'default'     => '#222222', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'resi_nav_link_hover_color', array(
        'label'	   => esc_html__( 'Navigation Link Hover', 'resi' ),
        'section'  => 'resi_nav_colors_section',
        'settings' => 'resi_nav_link_hover_color', 
		'priority' => 30 
    )));
	
	$wp_customize->add_setting( 'resi_nav_link_active_color', array(
		 'default'     => '#222222', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'resi_nav_link_active_color', array(
        'label'	   => esc_html__( 'Navigation Active Link', 'resi' ),
        'section'  => 'resi_nav_colors_section', 
        'settings' => 'resi_nav_link_active_color', 
		'priority' => 33
    )));
	
	$wp_customize->add_setting( 'resi_nav_dropdown_bg_color', array(
		 'default'     => '#ffffff', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'resi_nav_dropdown_bg_color', array(
        'label'	   => esc_html__( 'Navigation Dropdown Background', 'resi' ),
        'section'  => 'resi_nav_colors_section',
        'settings' => 'resi_nav_dropdown_bg_color', 
		'priority' => 35
    )));
	
	$wp_customize->add_setting( 'resi_nav_dropdown_border_color', array(
		 'default'     => '#cccccc', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'resi_nav_dropdown_border_color', array(
        'label'	   => esc_html__( 'Navigation Dropdown Border', 'resi' ),
        'section'  => 'resi_nav_colors_section',
        'settings' => 'resi_nav_dropdown_border_color', 
		'priority' => 40
    )));
	
	
	
//-------------------------------------------------------------------------------------------------------------------//
// Logo and Favicons
//-------------------------------------------------------------------------------------------------------------------//
 
 
	// Logo upload
    $wp_customize->add_section( 'resi_logo_section' , array(
	    'title'       => esc_html__( 'Logo', 'resi' ),
	    'priority'    => 21, 
	    'description' => esc_html__( 'Upload a logo to replace the default site name and description in the header. Also, upload your site favicon and Apple Icons.', 'resi'),
	));

	$wp_customize->add_setting( 'resi_logo', array(
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'resi_logo', array( 
		'label'    => esc_html__( 'Logo', 'resi' ),
		'type'           => 'image',
		'section'  => 'resi_logo_section',  
		'settings' => 'resi_logo',
		'priority' => 10,
	))); 
	
	// Logo Width
	$wp_customize->add_setting( 'logo_size', array(
	    'sanitize_callback' => 'absint',
		'default' => '165'
	));

	$wp_customize->add_control( 'logo_size', array( 
		'label'    => esc_html__( 'Logo Size', 'resi' ), 
		'description' => esc_html__( 'Change the width of the Logo in PX. Only enter numeric value.', 'resi' ),
		'section'  => 'resi_logo_section', 
		'settings' => 'logo_size',
		'type'        => 'number',
		'priority'   => 30,
		'input_attrs' => array(
            'style' => 'margin-bottom: 15px;',  
        ), 
	));
	

//-------------------------------------------------------------------------------------------------------------------//
// Photo Gallery Options
//-------------------------------------------------------------------------------------------------------------------//
 
	//Photo Panel
	$wp_customize->add_panel( 'resi_photo_gallery_panel', array( 
    'priority'       => 28,
    'capability'     => 'edit_theme_options', 
    'title'          => esc_html__( 'Image Gallery', 'resi' ),
    'description'    => esc_html__( 'Edit the different options for your images.', 'resi' ), 
	)); 
	
	//Photo Link
	$wp_customize->add_section( 'resi_photo_image_section' , array(
    	'title' => esc_html__( 'Gallery Options', 'resi' ),
    	'priority' => 10, 
    	'description' => esc_html__( 'Edit the options of your Resi galleries.', 'resi' ),
		'panel'		=> 'resi_photo_gallery_panel' 
	));
	
	//do you like a traditional permalink?
	$wp_customize->add_setting( 'resi_image_link', array(
		'default'	        => 'option1',
		'sanitize_callback' => 'resi_sanitize_index_content',
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'resi_image_link', array(
		'description'    => esc_html__( 'Choose to link to a lightbox display or directly to the single post.', 'resi' ),
		'section'  => 'resi_photo_image_section',
		'settings' => 'resi_image_link', 
		'type'     => 'radio',
		'priority'   => 10, 
		'choices'  => array(
			'option1' => esc_html__( 'Lightbox', 'resi' ),  
			'option2' => esc_html__( 'Direct Link to Single Post', 'resi' ), 
			),
	)));
	
	// Which option
	$wp_customize->add_setting( 'resi_post_order_method', array(
		'default'	        => 'DESC',
		'sanitize_callback' => 'resi_sanitize_photo_order',
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'resi_post_order_method', array(
		'label' => esc_html__( 'Image Order', 'resi' ), 
		'description'    => esc_html__( 'Select to display your posts in descending, ascending, or random order.', 'resi' ),
		'section'  => 'resi_photo_image_section', 
		'settings' => 'resi_post_order_method',
		'type'     => 'radio', 
		'priority'   => 15,
		'choices'  => array(
			'DESC' => esc_html__( 'Descending', 'resi' ),
			'ASC' => esc_html__( 'Ascending', 'resi' ),
			),
	))); 
	
	
	//Hide Title
	$wp_customize->add_setting('active_random',
	    array(
	        'sanitize_callback' => 'resi_sanitize_checkbox', 
	)); 
	
	$wp_customize->add_control( 'active_random', array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Random Order', 'resi' ),
        'section'  => 'resi_photo_image_section',
		'priority'   => 17
    ));
	
	
	// Button Text
	$wp_customize->add_setting( 'resi_view_all_text', 
	array(
		'sanitize_callback' => 'resi_sanitize_text',	 
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'resi_view_all_text', array(
    	'label' => esc_html__( 'Home Gallery Button Text', 'resi' ),  
    	'section'  => 'resi_photo_image_section',
    	'settings' => 'resi_view_all_text',  
		'priority'   => 30 
	)));
	
	// Button Page Drop Downs 
	$wp_customize->add_setting( 'resi_gallery_button_url', array( 
		'capability' => 'edit_theme_options', 
        'sanitize_callback' => 'resi_sanitize_int' 
	));
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'resi_gallery_button_url', array( 
    	'label' => esc_html__( 'Home Gallery Button URL', 'resi' ), 
    	'section'  => 'resi_photo_image_section',
		'type' => 'dropdown-pages',
    	'settings' => 'resi_gallery_button_url', 
		'priority'   => 40 
	)));
	
	
	//Photo Effects
	$wp_customize->add_section( 'resi_photo_effects_section' , array(
    	'title' => esc_html__( 'Gallery Effects', 'resi' ),
    	'priority' => 25, 
    	'description' => esc_html__( 'Add effects to your gallery images.', 'resi' ),
		'panel'		=> 'resi_photo_gallery_panel' 
	)); 

	//Filter Settings
	$wp_customize->add_setting( 'resi_filter_options', array(
		'default'	        => 'option1',
		'sanitize_callback' => 'resi_sanitize_index_content',
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'resi_filter_options', array(
		'label' => esc_html__( 'Filter Effect', 'resi' ), 
		'description'    => esc_html__( 'Choose a filter effect for your gallery images.', 'resi' ),
		'section'  => 'resi_photo_effects_section',
		'settings' => 'resi_filter_options',  
		'type'     => 'radio', 
		'priority'   => 30, 
		'choices'  => array(
			'option1' => esc_html__( 'None', 'resi' ),
			'option2' => esc_html__( 'Grayscale', 'resi' ),
			),
	))); 
	
	//Cover Gallery
	$wp_customize->add_section( 'resi_cover_gallery_section' , array(
    	'title' => esc_html__( 'Home Page Cover Gallery', 'resi' ),
    	'priority' => 30, 
    	'description' => esc_html__( 'Adjust your Cover Gallery settings.', 'resi' ),
		'panel'		=> 'resi_photo_gallery_panel' 
	)); 
	
	//Hide Title
	$wp_customize->add_setting('active_cover_title',
	    array(
	        'sanitize_callback' => 'resi_sanitize_checkbox',
	)); 
	
	$wp_customize->add_control( 'active_cover_title', array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Hide Cover Gallery Title', 'resi' ),
        'section' => 'resi_cover_gallery_section', 
		'priority'   => 10
    ));
	
	$wp_customize->add_setting( 'resi_cover_gallery_title', array(
        'default'     => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'resi_cover_gallery_title', array(
        'label'	   => esc_html__( 'Cover Gallery Title', 'resi' ),
         'section' => 'resi_cover_gallery_section', 
        'settings' => 'resi_cover_gallery_title',
		'priority' => 20 
    )));
	
	// Pagination Setting 
	$wp_customize->add_section( 'resi_pagination_section', array( 
		'title'          => esc_html__( 'Gallery Page Pagination', 'resi' ),
		'priority'       => 60,
		'panel'		  => 'resi_photo_gallery_panel'
	));
	
	$wp_customize->add_setting( 'resi_pagination_option', array(
		'default'	        => 'option1',
		'sanitize_callback' => 'resi_sanitize_index_content',  
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'resi_pagination_option', array(
		'label' => esc_html__( 'Pagination', 'resi' ), 
		'description'    => esc_html__( 'Set a pagination option for gallery or fullwidth gallery pages.', 'resi' ),
		'section'  => 'resi_pagination_section',
		'settings' => 'resi_pagination_option',
		'type'     => 'radio',  
		'priority'   => 10,
		'choices'  => array(
			'option1' => esc_html__( 'All Photos', 'resi' ), 
			'option2' => esc_html__( 'Pagination', 'resi' ), 
			),
	)));
	
	//Number of Pictures
    $wp_customize->add_setting(
        'resi_pagi_photos_length',
        array(
            'sanitize_callback' => 'absint',
			'default' => '15', 
    ));
	
    $wp_customize->add_control( 'resi_pagi_photos_length', array(  
        'type'        => 'number',
        'priority'    => 20,
        'section'  => 'resi_pagination_section', 
        'label'       => esc_html__('Number of Pagination Images', 'resi'),
        'description' => esc_html__('Choose the number of photos to display with the pagination option in the gallery pages. Default is set to 15.', 'resi'),  
        'input_attrs' => array(
            'min'   => -1, 
            'max'   => 100,
            
        ),
	));


//-------------------------------------------------------------------------------------------------------------------//
// Category Gallery
//-------------------------------------------------------------------------------------------------------------------//
	
	
	//Category Gallery
	$wp_customize->add_section( 'resi_category_section', array( 
		'title'          => esc_html__( 'Category Gallery', 'resi' ), 
		'priority'       => 35,
		'description' => esc_html__( 'Select the layout of your category galleries.', 'resi' ),
		'panel'		  => 'resi_photo_gallery_panel' 
	)); 
	
	//How your posts will display
	$wp_customize->add_setting( 'resi_category_layout', array( 
		'default'	        => 'option1',
		'sanitize_callback' => 'resi_sanitize_index_content',
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'resi_category_layout', array(
		'label'	   =>  esc_html__( 'Category Gallery Layout', 'resi' ),
		'description' 	   =>  esc_html__( '(Note: only for image gallery layouts)', 'resi' ),
		'section'  => 'resi_category_section', 
		'settings' => 'resi_category_layout',
		'type'     => 'radio', 
		'priority'    => 10, 
		'choices'  => array(
			'option1' => esc_html__( 'Full-width Page', 'resi' ),
			'option2' => esc_html__( 'Page with Sidebar', 'resi' ),
			),
	))); 
	
	//Display the Title?
	$wp_customize->add_setting( 'resi_category_title', array(
		'default'	        => 'option1',
		'sanitize_callback' => 'resi_sanitize_index_content', 
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'resi_category_title', array(
		'label'	   =>  esc_html__('Title Display', 'resi' ),
		'section'  => 'resi_category_section',
		'settings' => 'resi_category_title',
		'priority'    => 20, 
		'type'     => 'radio', 
		'choices'  => array(
			'option1' => esc_html__( 'Show Category Title', 'resi' ),
			'option2' => esc_html__( 'Hide Category Title', 'resi' ),  
			),
	)));
	
	
//-------------------------------------------------------------------------------------------------------------------//
// Social Icons
//-------------------------------------------------------------------------------------------------------------------//

	//Social Section
	$wp_customize->add_section( 'resi_settings', array(
            'title'          => esc_html__( 'Social Media Icons', 'resi' ),
			'description'    => esc_html__( 'Edit your social media icon settings.', 'resi' ),
            'priority'       => 38, 
    )); 
	
	//Hide Title
	$wp_customize->add_setting('active_social_icons',
	    array(
	        'sanitize_callback' => 'resi_sanitize_checkbox',
	)); 
	
	$wp_customize->add_control( 'active_social_icons', array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Hide Social Icons', 'resi' ),
       	'section'     => 'resi_settings',  
		'priority'   => 10
    ));
	
	//social font size
    $wp_customize->add_setting( 
        'resi_social_text_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '16',
    ));
	
    $wp_customize->add_control( 'resi_social_text_size', array(
        'type'        => 'number', 
        'priority'    => 15,
        'section'     => 'resi_settings', 
        'label'       => esc_html__('Social Icon Size', 'resi'), 
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 32, 
            'step'  => 1,
            'style' => 'margin-bottom: 10px;',
        ),
  	));
	
	
	//Social Icon Colors
	$wp_customize->add_setting( 'resi_social_color', array(
        'default'     => '#222222',
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'resi_social_color', array(
        'label'	   => esc_html__( 'Social Icon Color', 'resi' ),
        'section'  => 'resi_settings',
        'settings' => 'resi_social_color', 
		'priority' => 20
    )));
	
	$wp_customize->add_setting( 'resi_social_color_hover', array( 
        'default'     => '#666666',  
		'sanitize_callback' => 'sanitize_hex_color',  
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'resi_social_color_hover', array(
        'label'	   => esc_html__( 'Social Icon Hover Color', 'resi' ), 
        'section'  => 'resi_settings',
        'settings' => 'resi_social_color_hover', 
		'priority' => 30
    )));
	
	
//-------------------------------------------------------------------------------------------------------------------//
// Home Page
//-------------------------------------------------------------------------------------------------------------------//
	
	
	$wp_customize->add_panel( 'resi_home_page_panel', array(
    'priority'       => 30,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => esc_html__( 'Home Page', 'resi' ),
    'description'    => esc_html__( 'Edit your home page settings', 'resi' ),
	));
	
	//Home Widget Area
    $wp_customize->add_section( 'resi_home_widget_section_1' , array(  
	    'title'       => esc_html__( 'Home Widget Area', 'resi' ),
	    'priority'    => 10, 
	    'description' => esc_html__( 'Edit the options for the home page widget area.', 'resi'),
		'panel' 	  => 'resi_home_page_panel', 
	));

	// Number of Widget Columns 
	$wp_customize->add_setting( 'resi_widget_column_one', array(
		'default'	        => 'option1',
		'sanitize_callback' => 'resi_sanitize_widget_content', 
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'resi_widget_column_one', array(
		'label'    => esc_html__( 'Number of Widget Columns', 'resi' ),
		'description'    => esc_html__( '1 Column will take up the entire widget area, while 4 columns will give space to use 4 widgets for content in one row.', 'resi' ),
		'section'  => 'resi_home_widget_section_1', 
		'settings' => 'resi_widget_column_one', 
		'type'     => 'radio',
		'priority'   => 5,  
		'choices'  => array(
			'option1' => esc_html__( '1 Column', 'resi' ),
			'option2' => esc_html__( '2 Columns', 'resi' ), 
			'option3' => esc_html__( '3 Columns', 'resi' ),
			'option4' => esc_html__( '4 Columns', 'resi' ),
			),
		'input_attrs' => array(
            'style' => 'margin-bottom: 10px;',
        ),
	)));
	
	//Hide Section 
	$wp_customize->add_setting('active_hw_1',
	    array(
	        'sanitize_callback' => 'resi_sanitize_checkbox',
	)); 
	
	$wp_customize->add_control( 'active_hw_1', array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Hide Home Widget Area', 'resi' ),
        'section' => 'resi_home_widget_section_1', 
		'priority'   => 10
    ));
	
	$wp_customize->add_setting( 'resi_hw_area_1_bg_color', array(
        'default'     => '#f9f9f9',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'resi_hw_area_1_bg_color', array(
        'label'	   => esc_html__( 'Background Color', 'resi' ),
        'section'  => 'resi_home_widget_section_1',
        'settings' => 'resi_hw_area_1_bg_color',
		'priority' => 20 
    )));
	
	$wp_customize->add_setting( 'resi_hw_area_1_text_color', array(
        'default'     => '#404040',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'resi_hw_area_1_text_color', array(
        'label'	   => esc_html__( 'Text Color', 'resi' ),
        'section'  => 'resi_home_widget_section_1',
        'settings' => 'resi_hw_area_1_text_color',
		'priority' => 30 
    )));
	
	$wp_customize->add_setting( 'resi_hw_area_1_heading_color', array(
        'default'     => '#404040',
        'sanitize_callback' => 'sanitize_hex_color',
    )); 
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'resi_hw_area_1_heading_color', array(
        'label'	   => esc_html__( 'Heading Color', 'resi' ),
        'section'  => 'resi_home_widget_section_1',
        'settings' => 'resi_hw_area_1_heading_color',
		'priority' => 35
    )));
	
	$wp_customize->add_setting( 'resi_hw_area_1_link_color', array(
        'default'     => '#222222',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'resi_hw_area_1_link_color', array(
        'label'	   => esc_html__( 'Link Color', 'resi' ),
        'section'  => 'resi_home_widget_section_1',
        'settings' => 'resi_hw_area_1_link_color', 
		'priority' => 38
    )));
	
	$wp_customize->add_setting( 'resi_hw_area_1_link_hover_color', array(
        'default'     => '#666666',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'resi_hw_area_1_link_hover_color', array(
        'label'	   => esc_html__( 'Link Hover Color', 'resi' ),
        'section'  => 'resi_home_widget_section_1',
        'settings' => 'resi_hw_area_1_link_hover_color', 
		'priority' => 39
    )));
	
	$wp_customize->add_setting( 'resi_hw_area_1_button_color', array(
        'default'     => '#222222',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'resi_hw_area_1_button_color', array(
        'label'	   => esc_html__( 'Button Color', 'resi' ),
        'section'  => 'resi_home_widget_section_1',
        'settings' => 'resi_hw_area_1_button_color',
		'priority' => 40 
    ))); 
	
	$wp_customize->add_setting( 'resi_hw_area_1_button_hover_color', array(
        'default'     => '#666666', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'resi_hw_area_1_button_hover_color', array(
        'label'	   => esc_html__( 'Button Hover Color', 'resi' ),
        'section'  => 'resi_home_widget_section_1',
        'settings' => 'resi_hw_area_1_button_hover_color',
		'priority' => 50  
    )));
	
	
//-------------------------------------------------------------------------------------------------------------------//
// Footer
//-------------------------------------------------------------------------------------------------------------------//

	
	// Add Footer Section
	$wp_customize->add_section( 'footer-custom' , array(
    	'title' => esc_html__( 'Footer', 'resi' ),
    	'priority' => 30,
    	'description' => esc_html__( 'Customize your footer area', 'resi' ),
	)); 
	
	// Footer Byline Text 
	$wp_customize->add_setting( 'resi_footerid',
	    array(
	        'sanitize_callback' => 'resi_sanitize_text',
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'resi_footerid', array(
    'label' => esc_html__( 'Footer Byline Text', 'resi' ),
    'section' => 'footer-custom', 
    'settings' => 'resi_footerid',
	'priority'   => 10
	))); 
	
	//Hide Section 
	$wp_customize->add_setting('active_byline',
	    array(
	        'sanitize_callback' => 'resi_sanitize_checkbox',
	)); 
	
	$wp_customize->add_control( 'active_byline', array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Hide Footer Byline', 'resi' ),
        'section' => 'footer-custom',  
		'priority'   => 20
    ));
	
	$wp_customize->add_setting( 'resi_footer_text_color', array(  
        'default'     => '#404040', 
        'sanitize_callback' => 'sanitize_hex_color', 
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'resi_footer_text_color', array(
        'label'	   => esc_html__( 'Footer Text', 'resi'),  
        'section'  => 'footer-custom',
        'settings' => 'resi_footer_text_color', 
		'priority' => 30
    )));
	
	$wp_customize->add_setting( 'resi_footer_link_color', array(   
        'default'     => '#222222', 
        'sanitize_callback' => 'sanitize_hex_color', 
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'resi_footer_link_color', array(
        'label'	   => esc_html__( 'Footer Link', 'resi'),  
        'section'  => 'footer-custom',
        'settings' => 'resi_footer_link_color', 
		'priority' => 40
    )));
	
	$wp_customize->add_setting( 'resi_footer_link_hover_color', array(  
        'default'     => '#666666', 
        'sanitize_callback' => 'sanitize_hex_color', 
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'resi_footer_link_hover_color', array(
        'label'	   => esc_html__( 'Footer Link Hover', 'resi'),  
        'section'  => 'footer-custom', 
        'settings' => 'resi_footer_link_hover_color', 
		'priority' => 50
    )));


//-------------------------------------------------------------------------------------------------------------------//
// Blog
//-------------------------------------------------------------------------------------------------------------------//	
	
	//Blog Sidebar
    $wp_customize->add_section(
        'resi_blog_section',
        array(
            'title' => esc_html__( 'Blog', 'resi' ),   
            'priority' => 40,
    ));
	
	//sidebar placement
	$wp_customize->add_setting( 'resi_blog_sidebar_setting', array(
		'default' => 'option1',
		'sanitize_callback' => 'resi_sanitize_index_content',
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'resi_blog_sidebar_setting', array(
		'label' => esc_html__( 'Blog Sidebar', 'resi' ), 
		'description' => esc_html__( 'An option to add a sidebar to your Blog Archive and Single Post pages', 'resi' ),
		'section'  => 'resi_blog_section',
		'settings' => 'resi_blog_sidebar_setting',
		'type'     => 'radio',
		'priority' => 10, 
		'choices'  => array(
			'option1' => esc_html__( 'No (Default)', 'resi' ),
			'option2' => esc_html__( 'Yes', 'resi' ), 
		), 
	)));
	
	//Post Content
	$wp_customize->add_setting( 'resi_post_content', array(
		'default'	        => 'option2',
		'sanitize_callback' => 'resi_sanitize_index_content',
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'resi_post_content', array(
		'label'    => esc_html__( 'Post content', 'resi' ),
		'section'  => 'resi_blog_section',
		'settings' => 'resi_post_content', 
		'priority'   => 20,
		'type'     => 'radio',
		'choices'  => array(
			'option1' => esc_html__( 'Excerpts', 'resi' ),
			'option2' => esc_html__( 'Full content', 'resi' ),
			),
	))); 
	
	//Excerpt
    $wp_customize->add_setting(
        'exc_length',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '50',
    ));
	
    $wp_customize->add_control( 'exc_length', array( 
        'type'        => 'number',
        'priority'    => 2, 
        'section'     => 'resi_blog_section',
        'label'       => esc_html__('Excerpt Length', 'resi'),
        'description' => esc_html__('Choose the blog excerpt length. Default: 50 words', 'resi'),
		'priority'   => 30, 
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 200,
            'step'  => 5
        ),
	));
	
	
//-------------------------------------------------------------------------------------------------------------------//
// Colors
//-------------------------------------------------------------------------------------------------------------------//
	
	// Colors
	$wp_customize->add_setting( 'resi_text_color', array(
        'default'     => '#404040',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'resi_text_color', array(
        'label'	   => esc_html__( 'Text Color', 'resi' ),
        'section'  => 'colors',
        'settings' => 'resi_text_color',
		'priority' => 10 
    )));
	
    $wp_customize->add_setting( 'resi_link_color', array( 
        'default'     => '#222222',   
        'sanitize_callback' => 'sanitize_hex_color', 
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'resi_link_color', array(
        'label'	   => esc_html__( 'Link Color', 'resi'),
        'section'  => 'colors',
        'settings' => 'resi_link_color', 
		'priority' => 20
    )));
	
	$wp_customize->add_setting( 'resi_hover_color', array( 
        'default'     => '#666666',  
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'resi_hover_color', array(
        'label'	   => esc_html__( 'Hover Color', 'resi' ), 
        'section'  => 'colors',
        'settings' => 'resi_hover_color',
		'priority' => 25
    )));
	
	$wp_customize->add_setting( 'resi_site_title_color', array(
        'default'     => '#222222', 
        'sanitize_callback' => 'sanitize_hex_color',
    )); 
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'resi_site_title_color', array(
        'label'	   => esc_html__( 'Site Title Color', 'resi' ),  
        'section'  => 'colors',
        'settings' => 'resi_site_title_color',
		'priority' => 5
    )));
	
	
	//Page Colors
    $wp_customize->add_section( 'resi_page_colors_section' , array(  
	    'title'       => esc_html__( 'Page Colors', 'resi' ),
	    'priority'    => 20, 
	    'description' => esc_html__( 'Set your page colors.', 'resi'),
		'panel' => 'resi_colors_panel',
	));
	
	$wp_customize->add_setting( 'resi_page_bg', array(
        'default'     => '#ffffff', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'resi_page_bg', array(
        'label'	   => esc_html__( 'Page Content Background', 'resi' ), 
        'section'  => 'resi_page_colors_section',
        'settings' => 'resi_page_bg', 
		'priority' => 20
    )));
	
	$wp_customize->add_setting( 'resi_page_border', array(
        'default'     => '#cccccc', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'resi_page_border', array(
        'label'	   => esc_html__( 'Page Border', 'resi' ), 
        'section'  => 'resi_page_colors_section',
        'settings' => 'resi_page_border', 
		'priority' => 25 
    )));
	
	$wp_customize->add_setting( 'resi_entry', array(
        'default'     => '#404040', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'resi_entry', array(
        'label'	   => esc_html__( 'Entry Title Color', 'resi' ), 
        'section'  => 'resi_page_colors_section',
        'settings' => 'resi_entry', 
		'priority' => 50 
    )));
	
	$wp_customize->add_setting( 'resi_button_color', array(  
        'default'     => '#222222',  
		'sanitize_callback' => 'sanitize_hex_color',
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'resi_button_color', array(
        'label'	   => esc_html__( 'Button Color', 'resi' ), 
        'section'  => 'resi_page_colors_section',
        'settings' => 'resi_button_color', 
		'priority' => 60
    )));
	
	$wp_customize->add_setting( 'resi_button_hover_color', array(  
        'default'     => '#666666',  
		'sanitize_callback' => 'sanitize_hex_color',
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'resi_button_hover_color', array(
        'label'	   => esc_html__( 'Button Hover Color', 'resi' ), 
        'section'  => 'resi_page_colors_section', 
        'settings' => 'resi_button_hover_color', 
		'priority' => 65 
    ))); 
	
	$wp_customize->add_setting( 'resi_blockquote', array(  
        'default'     => '#404040',  
		'sanitize_callback' => 'sanitize_hex_color',
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'resi_blockquote', array(
        'label'	   => esc_html__( 'Blockquote Border', 'resi' ), 
        'section'  => 'resi_page_colors_section', 
        'settings' => 'resi_blockquote',  
		'priority' => 75  
    ))); 
	
	
//-------------------------------------------------------------------------------------------------------------------//
// Fonts
//-------------------------------------------------------------------------------------------------------------------//	
	
	
	// Fonts  
    $wp_customize->add_section(
        'resi_typography',
        array(
            'title' => esc_html__('Fonts', 'resi' ),   
            'priority' => 45, 
    ));
	
    $font_choices = 
        array(
			'',
			'Source Sans Pro:400,700,400italic,700italic' => 'Source Sans Pro',
			'Playfair Display:400,700,400italic' => 'Playfair Display', 
			'Open Sans:400italic,700italic,400,700' => 'Open Sans',
			'Oswald:400,700' => 'Oswald',
			'Montserrat:400,700' => 'Montserrat',
			'Raleway:400,700' => 'Raleway',
            'Droid Sans:400,700' => 'Droid Sans',
            'Lato:400,700,400italic,700italic' => 'Lato',
            'Arvo:400,700,400italic,700italic' => 'Arvo',
            'Lora:400,700,400italic,700italic' => 'Lora',
			'Merriweather:400,300italic,300,400italic,700,700italic' => 'Merriweather',
			'Oxygen:400,300,700' => 'Oxygen',
			'PT Serif:400,700' => 'PT Serif', 
            'PT Sans:400,700,400italic,700italic' => 'PT Sans',
            'PT Sans Narrow:400,700' => 'PT Sans Narrow',
			'Cabin:400,700,400italic' => 'Cabin',
			'Fjalla One:400' => 'Fjalla One',
			'Francois One:400' => 'Francois One',
			'Josefin Sans:400,300,600,700' => 'Josefin Sans',  
			'Libre Baskerville:400,400italic,700' => 'Libre Baskerville',
            'Arimo:400,700,400italic,700italic' => 'Arimo',
            'Ubuntu:400,700,400italic,700italic' => 'Ubuntu',
            'Bitter:400,700,400italic' => 'Bitter',
            'Droid Serif:400,700,400italic,700italic' => 'Droid Serif',
			'Lobster:400' => 'Lobster',
            'Roboto:400,400italic,700,700italic' => 'Roboto',
            'Open Sans Condensed:700,300italic,300' => 'Open Sans Condensed',
            'Roboto Condensed:400italic,700italic,400,700' => 'Roboto Condensed',
            'Roboto Slab:400,700' => 'Roboto Slab',
            'Yanone Kaffeesatz:400,700' => 'Yanone Kaffeesatz',
            'Mandali:400' => 'Mandali',
			'Vesper Libre:400,700' => 'Vesper Libre',
			'NTR:400' => 'NTR',
			'Dhurjati:400' => 'Dhurjati',
			'Faster One:400' => 'Faster One',
			'Mallanna:400' => 'Mallanna',
			'Averia Libre:400,300,700,400italic,700italic' => 'Averia Libre',
			'Galindo:400' => 'Galindo',
			'Titan One:400' => 'Titan One',
			'Abel:400' => 'Abel',
			'Nunito:400,300,700' => 'Nunito',
			'Poiret One:400' => 'Poiret One',
			'Signika:400,300,600,700' => 'Signika',
			'Muli:400,400italic,300italic,300' => 'Muli',
			'Play:400,700' => 'Play',
			'Bree Serif:400' => 'Bree Serif',
			'Archivo Narrow:400,400italic,700,700italic' => 'Archivo Narrow',
			'Cuprum:400,400italic,700,700italic' => 'Cuprum',
			'Noto Serif:400,400italic,700,700italic' => 'Noto Serif',
			'Pacifico:400' => 'Pacifico',
			'Alegreya:400,400italic,700italic,700,900,900italic' => 'Alegreya',
			'Asap:400,400italic,700,700italic' => 'Asap',
			'Maven Pro:400,500,700' => 'Maven Pro',
			'Dancing Script:400,700' => 'Dancing Script',
			'Karla:400,700,400italic,700italic' => 'Karla',
			'Merriweather Sans:400,300,700,400italic,700italic' => 'Merriweather Sans',
			'Exo:400,300,400italic,700,700italic' => 'Exo',
			'Varela Round:400' => 'Varela Round',
			'Cabin Condensed:400,600,700' => 'Cabin Condensed',
			'PT Sans Caption:400,700' => 'PT Sans Caption',
			'Cinzel:400,700' => 'Cinzel',
			'News Cycle:400,700' => 'News Cycle',
			'Inconsolata:400,700' => 'Inconsolata',
			'Architects Daughter:400' => 'Architects Daughter',
			'Quicksand:400,700,300' => 'Quicksand',
			'Titillium Web:400,300,400italic,700,700italic' => 'Titillium Web',
			'Quicksand:400,700,300' => 'Quicksand',
			'Monda:400,700' => 'Monda',
			'Didact Gothic:400' => 'Didact Gothic',
			'Coming Soon:400' => 'Coming Soon',
			'Ropa Sans:400,400italic' => 'Ropa Sans',
			'Tinos:400,400italic,700,700italic' => 'Tinos',
			'Glegoo:400,700' => 'Glegoo',
			'Pontano Sans:400' => 'Pontano Sans',
			'Fredoka One:400' => 'Fredoka One',
			'Lobster Two:400,400italic,700,700italic' => 'Lobster Two',
			'Quattrocento Sans:400,700,400italic,700italic' => 'Quattrocento Sans',
			'Covered By Your Grace:400' => 'Covered By Your Grace',
			'Changa One:400,400italic' => 'Changa One',
			'Marvel:400,400italic,700,700italic' => 'Marvel',
			'BenchNine:400,700,300' => 'BenchNine',
			'Orbitron:400,700,500' => 'Orbitron',
			'Crimson Text:400,400italic,600,700,700italic' => 'Crimson Text',
			'Bangers:400' => 'Bangers',
			'Courgette:400' => 'Courgette',
    );
	
	//body font size
    $wp_customize->add_setting(
        'resi_body_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '18', 
        )
    );
	
    $wp_customize->add_control( 'resi_body_size', array(
        'type'        => 'number', 
        'priority'    => 10,
        'section'     => 'resi_typography',
        'label'       => esc_html__('Body Font Size', 'resi'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 28,
            'step'  => 1,
            'style' => 'margin-bottom: 10px;',
        ),
  	));
    
    $wp_customize->add_setting(
        'headings_fonts',
        array(
            'sanitize_callback' => 'resi_sanitize_fonts',
    ));
    
    $wp_customize->add_control(
        'headings_fonts',
        array(
            'type' => 'select',
			'default'           => '20', 
            'description' => esc_html__('Select your desired font for the headings. Helvetica Neue is the default Heading font.', 'resi'),
            'section' => 'resi_typography',
            'choices' => $font_choices
    ));
    
    $wp_customize->add_setting(
        'body_fonts',
        array(
            'sanitize_callback' => 'resi_sanitize_fonts',
    ));
    
    $wp_customize->add_control(
        'body_fonts',
        array(
            'type' => 'select',
			'default'           => '30', 
            'description' => esc_html__( 'Select your desired font for the body. Helvetica Neue is the default Body font.', 'resi' ), 
            'section' => 'resi_typography',  
            'choices' => $font_choices 
    )); 
	
	
	
	
}
add_action( 'customize_register', 'resi_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function resi_customize_preview_js() {
	wp_enqueue_script( 'resi_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'resi_customize_preview_js' );
