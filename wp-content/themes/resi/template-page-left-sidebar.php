<?php
/**
Template Name: Page - Left Sidebar
 *
 * @package resi
 */

get_header(); ?>

<div class="grid grid-pad solid-background">
	<div class="col-9-12 push-right">
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
    
                <?php while ( have_posts() ) : the_post(); ?>
    
                    <?php get_template_part( 'template-parts/content', 'page' ); ?>
    
                    <?php
                        // If comments are open or we have at least one comment, load up the comment template.
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;
                    ?>
    
                <?php endwhile; // End of the loop. ?>
    
            </main><!-- #main -->
        </div><!-- #primary -->
	</div>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
