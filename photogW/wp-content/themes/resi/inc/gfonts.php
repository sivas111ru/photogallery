<?php


//Google Fonts

function resi_custom_styles($custom) {   


	//Fonts 

	$resi_headings_font = esc_html(get_theme_mod('headings_fonts'));  

	$resi_body_font = esc_html(get_theme_mod('body_fonts'));  	

	

	if ( $resi_headings_font ) {

		$font_pieces = explode(":", $resi_headings_font);

		$custom .= "h1, h2, h3, h4, h5, h6 { font-family: {$font_pieces[0]}; }"."\n";

	}

	if ( $resi_body_font ) {

		$font_pieces = explode(":", $resi_body_font); 

		$custom .= "body, button, input, select, textarea { font-family: {$font_pieces[0]}; }"."\n";

	}

	//Output all the styles

	wp_add_inline_style( 'resi-style', $custom );	

}

add_action( 'wp_enqueue_scripts', 'resi_custom_styles' );