<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package resi
 */

get_header(); ?>


<?php if ( 'option1' == resi_sanitize_index_content( get_theme_mod( 'resi_blog_sidebar_setting', 'option1' ) ) ) : //Fullwidth and no sidebar ?>
	<div class="grid grid-pad solid-background single-fullwidth">
<?php else : ?>
	<div class="grid grid-pad solid-background single-sidebar">
<?php endif; ?>

	<?php if ( 'option1' == resi_sanitize_index_content( get_theme_mod( 'resi_blog_sidebar_setting', 'option1' ) ) ) : //Fullwidth and no sidebar ?>
		<div class="col-1-1">
    <?php else : ?>
		<div class="col-9-12"> 
	<?php endif; ?>
    
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
    
            <?php while ( have_posts() ) : the_post(); ?>
    
                <?php get_template_part( 'template-parts/content', 'single' ); ?>
    
                <?php the_post_navigation(); ?>
    
                <?php
                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;
                ?>
    
            <?php endwhile; // End of the loop. ?>
    
            </main><!-- #main -->
        </div><!-- #primary -->
        
	<?php if ( 'option1' == resi_sanitize_index_content( get_theme_mod( 'resi_blog_sidebar_setting', 'option1' ) ) ) : //Fullwidth and no sidebar ?>
		</div>
    <?php else : ?>
		</div> 
	<?php endif; ?> 
    
    <?php if ( 'option1' == resi_sanitize_index_content( get_theme_mod( 'resi_blog_sidebar_setting', 'option1' ) ) ) : //Fullwidth and no sidebar ?>
		
	<?php else : ?>
		<?php get_sidebar(); ?> 
	<?php endif; ?>
    
<?php if ( 'option1' == resi_sanitize_index_content( get_theme_mod( 'resi_blog_sidebar_setting', 'option1' ) ) ) : //Fullwidth and no sidebar ?>
	</div>
<?php else : ?> 
	</div> 
<?php endif; ?>


<?php get_footer(); ?>
