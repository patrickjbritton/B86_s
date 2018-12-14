<?php
/**
 * Custom hooks functions for different layout in widget section.
 *
 * @package B86
 * @subpackage B86_s
 * @since 1.0.0
 */

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Block Default Layout
 *
 * @since 1.0.0
 */
if( ! function_exists( 'B86_s_block_default_layout_section' ) ) :
	function B86_s_block_default_layout_section( $cat_slug ) {
		if( empty( $cat_slug ) ) {
			return;
		}
		$B86_s_post_count = apply_filters( 'B86_s_block_default_posts_count', 3 );
		$block_args = array(
			'category_name'  => esc_attr( $cat_slug ),
			'posts_per_page' => absint( $B86_s_post_count ),
		);
		$block_query = new WP_Query( $block_args );
		$total_posts_count = $block_query->post_count;
		if( $block_query->have_posts() ) {
			while( $block_query->have_posts() ) {
				$block_query->the_post();
				?>
				<div class="B86_s-single-post">
					<?php if( has_post_thumbnail() ) { ?>
						<div class="B86_s-post-thumb">
							<?php B86_s_post_date_blog(); ?>
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail( 'B86_s-featured-medium' );?>
							</a>
						</div><!-- .B86_s-post-thumb -->
					<?php } ?>
					<div class="B86_s-post-content">
						<div class="B86_s-post-meta">
							<?php
							B86_s_post_author();
							B86_s_post_comment();
							?>
						</div>
						<h3 class="B86_s-post-title <?php echo esc_attr( $title_size ); ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<div class="B86_s-post-excerpt">
							<?php the_excerpt(); ?>
							<a class="B86_s-read-more" href="<?php the_permalink(); ?>"><?php esc_html_e('Continue Reading','B86_s');?></a>
						</div>
					</div><!-- .B86_s-post-content -->
				</div><!-- .B86_s-single-post -->
				<?php
			}
			wp_reset_postdata();
		}
	}
endif;