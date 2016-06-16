<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package resi
 */

get_header(); ?>


<?php if ( 'option1' == resi_sanitize_index_content( get_theme_mod( 'resi_blog_sidebar_setting', 'option1' ) ) ) : //Fullwidth and no sidebar ?>
	<div class="grid grid-pad blog-fullwidth">
<?php else : ?>
	<div class="grid grid-pad blog-sidebar">
<?php endif; ?>

	<?php if ( 'option1' == resi_sanitize_index_content( get_theme_mod( 'resi_blog_sidebar_setting', 'option1' ) ) ) : //Fullwidth and no sidebar ?>
		<div class="col-1-1">
    <?php else : ?>
		<div class="col-9-12"> 
	<?php endif; ?>

        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
    
            <?php if ( have_posts() ) : ?>
    
                <header class="page-header">
                    <?php
                        the_archive_title( '<h1 class="page-title">', '</h1>' );
                        the_archive_description( '<div class="taxonomy-description">', '</div>' );
                    ?>
                </header><!-- .page-header -->
    
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
