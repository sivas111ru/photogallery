<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package resi
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
    	<div class="grid grid-pad">
        	<div class="col-1-1">
                <div class="site-info">
                
                	<?php if( get_theme_mod( 'active_byline' ) == '') : ?> 
                
						<?php if ( get_theme_mod( 'resi_footerid' ) ) : ?>
                        
        					<?php echo wp_kses_post( get_theme_mod( 'resi_footerid' )); // footer id ?>
                            
						<?php else : ?>
                   
                   <!-- EDITED SIVAS site-info-->
                        
                            
						<?php endif; ?> 
                 
        			<?php endif; ?> 
                    
                </div><!-- .site-info -->
          	</div><!-- col -->
      	</div><!-- grid -->
	</footer><!-- #colophon -->
    
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
