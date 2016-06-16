<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package resi
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
    
    	<?php if ( has_post_thumbnail() ) : ?>
            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
            	<?php the_post_thumbnail( 'full', array( 'class' => 'archive-img' ) ); ?>
            </a>
        <?php endif; ?>
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
		
        	<div class="entry-meta">
				<?php resi_posted_on(); ?>
			</div><!-- .entry-meta -->
        
		<?php endif; ?>
        
	</header><!-- .entry-header -->

	<div class="entry-content">
    
    	<?php
				if ( 'option2' == resi_sanitize_index_content( get_theme_mod( 'resi_post_content' ) ) ) :
				the_content( sprintf( 
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'resi' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );
				else :
				the_excerpt( __( '<span class="screen-reader-text">"', '"</span>', false  ) );  
				endif;
		?> 

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
