<?php
/**
 * The Template for displaying all single posts.
 *
 * @package carry
 * @since carry 1.0
 */

get_header(); ?>

		<div id="primary" class="site-content">
			<div id="content" role="main">
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); 

				
				$carry_content_template = apply_filters( 'carry_content_template', 'content', $post->post_type );
				get_template_part( $carry_content_template, 'single' ); 
				
				carry_content_nav( 'nav-below' ); 

				
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() )
					comments_template( '', true );
				

			endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary .site-content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>