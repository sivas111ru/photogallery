<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package resi
 */

get_header(); ?>

<div class="grid grid-pad solid-background">
	<div class="col-1-1">
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
    
                <section class="error-404 not-found">
                    <header class="page-header">
                        <h1 class="page-title">
							<?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'resi' ); ?>
                        </h1>
                    </header><!-- .page-header -->
    
                    <div class="page-content">
                        <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'resi' ); ?></p>
    
                        <?php get_search_form(); ?>
                     
                    </div><!-- .page-content -->
                </section><!-- .error-404 -->
    
            </main><!-- #main -->
        </div><!-- #primary -->
	</div><!-- col -->
</div><!-- grid -->

<?php get_footer(); ?>
