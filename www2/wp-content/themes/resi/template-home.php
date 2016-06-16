<?php
/**
Template Name: Home Page - Default
 *
 * @package resi
 */

get_header(); ?>


	<section id="gallery-container" class="default-gallery">
		<div class="grid-wrap">
        
        <?php // loop details
		
		if ( get_theme_mod( 'active_random' ) ) :
			$resi_random_order = 'rand'; 
		else:
			$resi_random_order = 'date';
		endif;  
        
        $resi_photo_order = resi_sanitize_photo_order( get_theme_mod( 'resi_post_order_method', 'DESC' ) );	
	
		$args = array( 
			'post_type' => 'post',
			'order' => $resi_photo_order, 
			'orderby' => $resi_random_order,
			'posts_per_page' => 20, 
			'tax_query' => 				
				array(
					array(
      				'taxonomy' => 'post_format',
      				'field' => 'slug',
      				'terms' => 'post-format-image', 
    	)));
	
		// the query
		$resi_the_query = new WP_Query( $args );
	
			if ( $resi_the_query->have_posts() ) :
	
				while ( $resi_the_query->have_posts() ) : $resi_the_query->the_post(); ?> 
		
        				<?php if ( has_post_format( 'image' ) ) { ?> 
                        
                        	<figure class="gallery-image">
                            
                            	
                            	<?php if ( 'option1' == resi_sanitize_index_content( get_theme_mod( 'resi_image_link', 'option1' ) ) ) : // check for lightbox ?>
                                
									<a 
                                    href="<?php echo wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ) ?>" 
                                    class="gallery-link"
                                    >   
                                    
                                <?php else : ?>  
                                
                                	<a href="<?php the_permalink(); ?>">  
                                      
                                <?php endif; ?> 
                                
                                
            						<?php if ( 'option2' == resi_sanitize_index_content( get_theme_mod( 'resi_filter_options' ) ) ) : // check for filter ?>  
									
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
	
   		</div> 
	</section> 
    
    
    <?php get_template_part( 'template-parts/content', 'view-all' ); ?> 
    
    
    <?php get_template_part( 'template-parts/content', 'home-widgets' ); ?>
    


<?php get_footer(); ?>
