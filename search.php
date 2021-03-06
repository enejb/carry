<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package carry
 * @since carry 1.0
 */

get_header(); ?>

		<section id="primary" class="site-content">
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'carry' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				</header>

				<?php carry_content_nav( 'nav-above' ); ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php 
					$carry_content_template = apply_filters( 'carry_content_template', 'content', $post->post_type );
					get_template_part( $carry_content_template, 'search' ); ?>

				<?php endwhile; ?>

				<?php carry_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<?php get_template_part( 'no-results', 'search' ); ?>

			<?php endif; ?>

			</div><!-- #content -->
		</section><!-- #primary .site-content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>