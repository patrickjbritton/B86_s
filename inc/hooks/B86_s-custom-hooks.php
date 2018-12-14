<?php
/**
 * Custom hooks functions are define.
 *
 * @package AquariusThemes
 * @subpackage B86_s
 * @since 1.0.0
 */

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Related Posts start
 *
 * @since 1.0.0
 */
if( ! function_exists( 'B86_s_related_posts_start' ) ) :
	function B86_s_related_posts_start() {
		echo '<div class="B86_s-related-section-wrapper">';
	}
endif;

/**
 * Related Posts section
 *
 * @since 1.0.0
 */
if( ! function_exists( 'B86_s_related_posts_section' ) ) :
	function B86_s_related_posts_section() {
		$B86_s_related_option = get_theme_mod( 'B86_s_related_posts_option', 'show' );
		if( $B86_s_related_option == 'hide' ) {
			return;
		}
		$B86_s_related_title = get_theme_mod( 'B86_s_related_posts_title', __( 'Related Posts', 'B86_s' ) );
		if( !empty( $B86_s_related_title ) ) {
			echo '<h2 class="B86_s-related-title B86_s-clearfix">'. esc_html( $B86_s_related_title ) .'</h2>';
		}
		global $post;
        if( empty( $post ) ) {
            $post_id = '';
        } else {
            $post_id = $post->ID;
        }
        $categories = get_the_category( $post_id );
        if ( $categories ) {
            $category_ids = array();
            foreach( $categories as $category_ed ) {
                $category_ids[] = $category_ed->term_id;
            }
        }
		$B86_s_post_count = apply_filters( 'B86_s_related_posts_count', 3 );
		
		$related_args = array(
				'no_found_rows'            	=> true,
                'update_post_meta_cache'   	=> false,
                'update_post_term_cache'   	=> false,
                'ignore_sticky_posts'      	=> 1,
                'orderby'                  	=> 'rand',
                'post__not_in'             	=> array( $post_id ),
                'category__in'				=> $category_ids,
				'posts_per_page' 		   	=> $B86_s_post_count
			);
		$related_query = new WP_Query( $related_args );
		if( $related_query->have_posts() ) {
			echo '<div class="B86_s-related-posts-wrap B86_s-clearfix">';
			while( $related_query->have_posts() ) {
				$related_query->the_post();
	?>
				<div class="B86_s-single-post B86_s-clearfix">
					<div class="B86_s-post-thumb">
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( 'B86_s-block-medium' ); ?>
						</a>
					</div><!-- .B86_s-post-thumb -->
					<div class="B86_s-post-content">
						<h3 class="B86_s-post-title small-size"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<div class="B86_s-post-meta">
							<?php B86_s_posted_on(); ?>
						</div>
					</div><!-- .B86_s-post-content -->
				</div><!-- .B86_s-single-post -->
	<?php
			}
			echo '</div><!-- .B86_s-related-posts-wrap -->';
			wp_reset_postdata();
		}
	}
endif;

/**
 * Related Posts end
 *
 * @since 1.0.0
 */
if( ! function_exists( 'B86_s_related_posts_end' ) ) :
	function B86_s_related_posts_end() {
		echo '</div><!-- .B86_s-related-section-wrapper -->';
	}
endif;

/**
 * Managed functions for related posts section
 *
 * @since 1.0.0
 */
add_action( 'B86_s_related_posts', 'B86_s_related_posts_start', 5 );
add_action( 'B86_s_related_posts', 'B86_s_related_posts_section', 10 );
add_action( 'B86_s_related_posts', 'B86_s_related_posts_end', 15 );