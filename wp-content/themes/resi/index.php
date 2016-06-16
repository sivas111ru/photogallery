<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package resi
 */

get_header(); ?>

<?php if ( 'option1' == resi_sanitize_index_content( get_theme_mod( 'resi_blog_sidebar_setting', 'option1' ) ) ) : //Fullwidth and no sidebar ?>
	<div class="grid grid-pad solid-background blog-fullwidth">
<?php else : ?>
	<div class="grid grid-pad solid-background blog-sidebar">   
<?php endif; ?>

	<?php if ( 'option1' == resi_sanitize_index_content( get_theme_mod( 'resi_blog_sidebar_setting', 'option1' ) ) ) : //Fullwidth and no sidebar ?>
		<div class="col-1-1">
    <?php else : ?>
		<div class="col-9-12"> 
	<?php endif; ?>


        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
    
            <?php if ( have_posts() ) : ?>
    
                <?php if ( is_home() && ! is_front_page() ) : ?>
                
                    <header>
                        <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                    </header>
                
				<?php endif; ?>
    
                <?php /* Start the Loop */ ?>
                <?php while ( have_posts() ) : the_post(); ?>
    
                    <?php
    
                        /*
                         * Include the Post-Format-specific template for the content.
                         * If you want to override this in a child theme, then include a file
                         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                         */
                        get_template_part( 'template-parts/content', get_post_format() );
                    ?>
    
                <?php endwhile; ?>
    
                <?php the_posts_navigation(); ?>
    
            <?php else : ?>
    
                <?php get_template_part( 'template-parts/content', 'none' ); ?>
    
            <?php endif; ?>
    
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
