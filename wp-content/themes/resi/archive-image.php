<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package resi
 */

get_header(); ?>



<div class="grid grid-pad">
    
	<?php if ( 'option1' == resi_sanitize_index_content( get_theme_mod( 'resi_category_layout' ) ) ) : ?>
            
		<div class="col-1-1">
                
    <?php else : ?>
                
        <div class="col-9-12"> 
            
    <?php endif; ?>
            
            
            
	<div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            
            
            
        <?php
		// Check if there are any posts to display
        if ( have_posts() ) : ?>
            
    	<?php if ( 'option1' == resi_sanitize_index_content( get_theme_mod( 'resi_category_title' ) ) ) : ?> 
    
    		<header class="archive-header">
                                
				<h1 class="cat-gallery-title">
					<?php printf( esc_html__( '%s', 'resi' ), single_cat_title( '', false ) ); ?>
                </h1> 

				<?php
				// Display optional category description
 				if ( category_description() ) : ?>
								
            	<div class="archive-meta">
					<?php echo category_description(); ?>
                </div>
                
				<?php endif; ?>
                                    
			</header>
    
    	<?php endif; ?>
        
    
			<section id="gallery-container" class="default-gallery">


				<?php while ( have_posts() ) : the_post();  ?>
		
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
  
				<?php endwhile; ?>
	
        
			</section> 
                    
                     
			<?php the_posts_navigation(); ?> 
					
					
            	<?php else :
		
					
					get_template_part( 'content', 'none' );
						
            endif; ?>
             
        </main><!-- #main -->
    </div><!-- #primary -->
        
        
        
    <?php if ( 'option1' == resi_sanitize_index_content( get_theme_mod( 'resi_category_layout' ) ) ) : ?>
            
		</div><!-- col -->
                
    <?php else : ?>
                
        </div><!-- col -->
            
    <?php endif; ?>
    
            
            
	<?php if ( 'option1' == resi_sanitize_index_content( get_theme_mod( 'resi_category_layout' ) ) ) : ?>
            
	        
	<?php else : ?>
    
    	<?php get_sidebar(); ?>
                
	<?php endif; ?>


</div><!-- grid -->

<?php get_footer(); ?>
