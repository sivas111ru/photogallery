	
    
    <?php if ( get_theme_mod( 'active_hw_1' ) == '' ) : ?>
		<?php if ( is_active_sidebar('home-widget-area-one') ) : ?> 
            
            <div class="home-widget home-widget-one">
                <div class="grid grid-pad">
                    <div class="col-1-1">
                	
						<?php dynamic_sidebar('home-widget-area-one'); ?>
                	
                   	</div> 
                </div><!-- grid -->
            </div><!-- .home-widget -->
                
		<?php endif; ?>
    <?php endif; ?>