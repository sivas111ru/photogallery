<?php
/**
 * Template Name: Gallery Page - Fullwidth 
 *
 * @package resi
 */

get_header(); ?>

<div class="grid grid-pad">
	<div class="col-1-1">
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
    
               <section id="gallery-container" class="default-gallery">

				<?php 
		
				if ( get_theme_mod( 'active_random' ) ) : 
					$resi_random_order = 'rand'; 
				else: 
					$resi_random_order = 'date'; 
				endif; 
        
        		$resi_photo_order = resi_sanitize_photo_order( get_theme_mod( 'resi_post_order_method', 'DESC' ) );	
	
				if ( 'option1' == resi_sanitize_index_content( get_theme_mod( 'resi_pagination_option', 'option1' ) ) ) :
						
							$args = array( 
								'post_type' => 'post',
								'order' => $resi_photo_order, 
								'orderby' => $resi_random_order, 
								'posts_per_page' => -1, 
								'tax_query' => 				
								array(
									array(
      								'taxonomy' => 'post_format',
      								'field' => 'slug',
      								'terms' => 'post-format-image', 
    						))); 
							
				else:
				
							$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
							$args = array( 
								'post_type' => 'post',
								'order' => $resi_photo_order, 
								'orderby' => $resi_random_order,
								'posts_per_page' => intval( get_theme_mod( 'resi_pagi_photos_length', '15' )), 
								'paged' => $paged,
								'tax_query' => 				
								array(
									array(
      								'taxonomy' => 'post_format',
      								'field' => 'slug',
      								'terms' => 'post-format-image',  
    						))); 	
						
				endif;	
	
				// the query
				$resi_the_query = new WP_Query( $args ); 
	
				if ( $resi_the_query->have_posts() ) :
	
					while ( $resi_the_query->have_posts() ) : $resi_the_query->the_post(); ?>
		
        				<?php if ( has_post_format( 'image' )) { ?>  
                        
                        		
                            <figure class="gallery-image">
                            
                            	 
                            	<?php if ( 'option1' == resi_sanitize_index_content( get_theme_mod( 'resi_image_link', 'option1' ) ) ) : ?>
                                
									<a 
                                    	href="<?php echo wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ) ?>" 
                                        class="gallery-link"
                                    >  
                                    
                                <?php else : ?>   
                                
                                	<a href="<?php the_permalink(); ?>"> 
                                      
                                <?php endif; ?> 
                                
                                
            							<?php if ( 'option2' == resi_sanitize_index_content( get_theme_mod( 'resi_filter_options' ) ) ) : ?>
									
                       						<?php the_post_thumbnail( 'full', array( 'class' => 'grayscale' )); ?>
                                        
                                    	<?php else : ?> 
                                    
                                    		<?php the_post_thumbnail( 'full' ); ?> 
										
										<?php endif; ?> 
                                        
                                     
                                <?php if ( 'option1' == resi_sanitize_index_content( get_theme_mod( 'resi_image_link', 'option1' ) ) ) : ?>
                                
									</a>
                                    
                                <?php else : ?>
                                
                                	</a> 
                                    
                                <?php endif; ?>
                                
                            
                            </figure>
                                
                        
                        <?php } ?> 
  
					<?php endwhile; 
	
				endif; 

				// Reset Post Data
				wp_reset_postdata(); ?>
	
        
			</section> 
            
            
            <?php  if ( 'option1' == resi_sanitize_index_content( get_theme_mod( 'resi_pagination_option', 'option1' ) ) ) :
						
						
			else:
				
				if (function_exists("pagination")) { ?> 
                
					<div class="grid grid-pad">
                		<div class="col-1-1">
                           
    						<?php pagination($resi_the_query->max_num_pages); ?>
                            
                        </div> 
                    </div>
                    
				<?php }
					
			endif; ?>
            
    
            </main><!-- #main --> 
        </div><!-- #primary -->
	</div>
</div>
<?php get_footer(); ?>