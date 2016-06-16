

	<?php if ( get_theme_mod( 'resi_view_all_text' ) ) : ?>
    
    	<div class="home-page-button">
    		<div class="grid grid-pad">
    			<div class="col-1-1">
        
                    <a href="<?php echo esc_url( get_page_link( get_theme_mod( 'resi_gallery_button_url' ))) ?>"> 
                		<button class="gallery-archive-button">
							<?php echo esc_html( get_theme_mod( 'resi_view_all_text' )); ?>
                        </button> 
                	</a>
                    
        		</div><!-- col-1-1 -->
        	</div><!-- grid -->
    	</div><!-- home button -->
    
    
    <?php endif; ?>