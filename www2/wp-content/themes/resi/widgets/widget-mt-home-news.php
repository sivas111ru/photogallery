<?php



class resi_home_news extends WP_Widget {



// constructor

    function resi_home_news() {

		$widget_ops = array('classname' => 'resi_home_news_widget', 'description' => esc_html__( 'Show your blog posts on your home page.', 'resi') );

        parent::__construct(false, $name = esc_html__('MT - Home Posts', 'resi'), $widget_ops); 

		$this->alt_option_name = 'resi_home_news_widget';

		

		add_action( 'save_post', array($this, 'flush_widget_cache') );

		add_action( 'deleted_post', array($this, 'flush_widget_cache') );

		add_action( 'switch_theme', array($this, 'flush_widget_cache') );		

    }

	

	// widget form creation

	function form($instance) {



	// Check values

		$title     		= isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		
		$read_more_text  = isset( $instance['read_more_text'] ) ? esc_html( $instance['read_more_text'] ) : esc_html__( 'View More', 'resi' );

		$category  		= isset( $instance['category'] ) ? esc_attr( $instance['category'] ) : '';
		
		$number    		= isset( $instance['number'] ) ? intval( $instance['number'] ) : 1;
		
		$columnset    	= isset( $instance['columnset'] ) ? intval( $instance['columnset'] ) : 1;

		$see_all_text  	= isset( $instance['see_all_text'] ) ? esc_html( $instance['see_all_text'] ) : esc_html__( 'See All', 'resi' );										
	

	?>



	<p>

	<label for="<?php echo sanitize_text_field( $this->get_field_id('title')); ?>"><?php esc_html_e('Title', 'resi'); ?></label>

	<input class="widefat" id="<?php echo sanitize_text_field( $this->get_field_id('title')); ?>" name="<?php echo sanitize_text_field( $this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />

	</p>
    
    
    <p>

	<label for="<?php echo sanitize_text_field( $this->get_field_id('read_more_text')); ?>"><?php esc_html_e('View More Text', 'resi'); ?></label>

	<input class="widefat" id="<?php echo sanitize_text_field( $this->get_field_id('read_more_text')); ?>" name="<?php echo sanitize_text_field( $this->get_field_name('read_more_text')); ?>" type="text" value="<?php echo esc_html( $read_more_text ); ?>" />

	</p>



	<p><label for="<?php echo sanitize_text_field( $this->get_field_id( 'category' )); ?>"><?php esc_html_e( 'Enter the slug for your category or leave empty to show posts from all categories.', 'resi' ); ?></label>

	<input class="widefat" id="<?php echo sanitize_text_field( $this->get_field_id( 'category' )); ?>" name="<?php echo sanitize_text_field( $this->get_field_name( 'category' )); ?>" type="text" value="<?php echo esc_attr( $category ); ?>" size="3" /></p>
    
    	
    
    <p><label for="<?php echo sanitize_text_field( $this->get_field_id( 'number' )); ?>"><?php esc_html_e( 'Enter the number of posts to display.', 'resi' ); ?></label>

	<input class="widefat" id="<?php echo sanitize_text_field( $this->get_field_id( 'number' )); ?>" name="<?php echo sanitize_text_field( $this->get_field_name( 'number' )); ?>" type="text" value="<?php echo intval( $number ); ?>" size="3" /></p>	
    
    
    <p><label for="<?php echo sanitize_text_field( $this->get_field_id( 'columnset' )); ?>"><?php esc_html_e( 'Enter the number of columns.', 'resi' ); ?></label>

	<input class="widefat" id="<?php echo sanitize_text_field( $this->get_field_id( 'columnset' )); ?>" name="<?php echo sanitize_text_field( $this->get_field_name( 'columnset' )); ?>" type="text" value="<?php echo intval( $columnset ); ?>" size="3" /></p> 	



    <p><label for="<?php echo sanitize_text_field( $this->get_field_id('see_all_text')); ?>"><?php esc_html_e('Button Text. Default is set to See All.', 'resi'); ?></label>

	<input class="widefat" id="<?php echo sanitize_text_field( $this->get_field_id( 'see_all_text' )); ?>" name="<?php echo sanitize_text_field( $this->get_field_name( 'see_all_text' )); ?>" type="text" value="<?php echo esc_html( $see_all_text ); ?>" size="3" /></p> 

	

	<?php

	}



	// update widget

	function update($new_instance, $old_instance) {

		$instance = $old_instance;

		$instance['title'] 			= esc_attr($new_instance['title']);
		
		$instance['read_more_text'] = esc_html($new_instance['read_more_text']);

		$instance['category'] 		= esc_attr($new_instance['category']);
		
		$instance['number'] 		= intval($new_instance['number']); 
		
		$instance['columnset'] 		= intval($new_instance['columnset']);

		$instance['see_all_text'] 	= esc_html($new_instance['see_all_text']);									

		$this->flush_widget_cache();



		$alloptions = wp_cache_get( 'alloptions', 'options' );

		if ( isset($alloptions['resi_home_news']) )

			delete_option('resi_home_news');	  

		  

		return $instance;

	}

	

	function flush_widget_cache() {

		wp_cache_delete('resi_home_news', 'widget');

	}

	

	// display widget

	function widget($args, $instance) {

		$cache = array();

		if ( ! $this->is_preview() ) {

			$cache = wp_cache_get( 'resi_home_news', 'widget' );

		}



		if ( ! is_array( $cache ) ) {

			$cache = array();

		}



		if ( ! isset( $args['widget_id'] ) ) {

			$args['widget_id'] = $this->id;

		}



		if ( isset( $cache[ $args['widget_id'] ] ) ) {

			echo $cache[ $args['widget_id'] ];

			return;

		}



		ob_start();

		extract($args);



		/** This filter is documented in wp-includes/default-widgets.php */

		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		
		$read_more_text  = isset( $instance['read_more_text'] ) ? esc_html( $instance['read_more_text'] ) : esc_html__( 'View More', 'resi' );

		$category = isset( $instance['category'] ) ? esc_attr($instance['category']) : '';
		
		$number = ( ! empty( $instance['number'] ) ) ? intval( $instance['number'] ) : 1; 

		if ( ! $number )

			$number = -1;
			
		$columnset 		= ( ! empty( $instance['columnset'] ) ) ? intval( $instance['columnset'] ) : 1;
		
		if ( ! $columnset ) 

			$columnset = 1;

		$see_all_text = isset( $instance['see_all_text'] ) ? esc_html($instance['see_all_text']) : esc_html__( 'See All', 'resi' );	
		
		$tax_query = array( array(
			'taxonomy' => 'post_format',
			'field' => 'slug',
			'terms' => array( 'post-format-image' ),
			'operator' => 'NOT IN',
		));


		/**

		 * Filter the arguments for the Recent Posts widget.

		 *

		 * @since 3.4.0

		 *

		 * @see WP_Query::get_posts()

		 *

		 * @param array $args An array of arguments used to retrieve the recent posts.

		 */

		$mt = new WP_Query( apply_filters( 'widget_posts_args', array(

			'no_found_rows'       => true,

			'post_status'         => 'publish',

			'posts_per_page'	  => $number,

			'category_name'		  => $category,
			
			'tax_query'			  => $tax_query 

		) ) );



		if ($mt->have_posts()) :

?>

		<section id="home-news" class="home-news-area">
        
        
        <?php if ( $title ) : ?>
        
        	<div class="grid grid-pad">
            	<div class="col-1-1">
                    <?php if ( $title ) echo $before_title . wp_kses_post( $title ) . $after_title; ?> 
                </div><!-- col-1-1 -->  
            </div><!-- grid -->
            
        <?php endif; ?>	

			<div class="grid grid-pad">
                        
            	<?php while ( $mt->have_posts() ) : $mt->the_post(); ?>
             
                	
                    	
                	<div class="news-box">
                        <div class="news-content">
                        	<div>
                            <span>
                            	
								<?php if (has_post_thumbnail( get_the_id() ) ): ?>
								
                                <div class="news-image" style="background-image: url('<?php echo wp_get_attachment_url( get_post_thumbnail_id() , 'full' ); ?>');">
                                </div>
                                    
								<?php endif; ?> 
                                    
                                <?php if (has_post_thumbnail( get_the_id() ) ): ?>
                                
                        			<div class="news-info"> 
                                    
								<?php else: ?>
                                    	
                                    <div class="news-info-no-pic"> 
                                    
								<?php endif; ?>
                                    
                                    	<div>
                                    		
											<?php the_title( '<h3>', '</h3>' ); ?> 
                                        	<h6><?php the_date(); ?></h6> 
                                            
                        					<a href="<?php the_permalink(); ?>">
                                            	<button>
													<?php echo esc_html( $read_more_text ); ?>
                                                </button>
                                            </a>
                                    	
                                        </div> 
                                        
                               	<?php if (has_post_thumbnail( get_the_id() ) ): ?> 
                        			
                                    </div>
                                    
								<?php else: ?>
                                    	
                                    </div> 
                                    
								<?php endif; ?>
                                    
                        	</span>
                        	</div>
                   		</div>
                	</div>
                        
            	<?php endwhile; ?>
                        
            </div><!-- grid -->
            
            	
				<?php if ( $see_all_text ) : ?> 
					
                    <a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>" class="all-news">
						<button><?php echo esc_html( $see_all_text ); ?></button> 
                	</a>

				<?php endif; ?>	
            	

		</section>		

	<?php

		// Reset the global $the_post as this query will have stomped on it

		wp_reset_postdata();



		endif;



		if ( ! $this->is_preview() ) {

			$cache[ $args['widget_id'] ] = ob_get_flush();

			wp_cache_set( 'resi_home_news', $cache, 'widget' ); 

		} else {

			ob_end_flush(); 

		}

	}


	

}