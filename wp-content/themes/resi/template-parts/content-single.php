<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package resi
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
    	<?php if ( has_post_thumbnail() ) : ?>
            
            	
				<?php if ( has_post_format( 'image' ) ) : ?> 
                	
                    <div class="single-gallery-box">
                    	<figure>
                		
                        	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"> 
                        
                        
                        		<div class="single-gallery-image">
                        	
                            		<?php if ( 'option2' == resi_sanitize_index_content( get_theme_mod( 'resi_filter_options' ) ) ) : ?>  
									
                       					<?php the_post_thumbnail( 'full', array( 'class' => 'archive-img', 'class' => 'grayscale' )); ?> 
                                        
                                    <?php else : ?> 
                                    
                                    	<?php the_post_thumbnail( 'full', array( 'class' => 'archive-img' ) ); ?>   
										
									<?php endif; ?> 
                                	
                                </div>
                                        
                                        
                    		</a> 
                            
                    	</figure>
                    </div>
            
                <?php else : ?>
                
            		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                    	<?php the_post_thumbnail( 'full', array( 'class' => 'archive-img' ) ); ?>
                    </a>
                
                <?php endif; ?>
         
           
        <?php endif; ?> 
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?> 

		<div class="entry-meta">
			<?php resi_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'resi' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php resi_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

