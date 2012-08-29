<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package carry
 * @since carry 1.0
 */

get_header(); ?>

		<section id="primary" class="site-content">
			<div id="content" role="main">
			
				<header class="page-header">
					<h1 class="page-title"><?php _e( 'Oops! Page not found.', 'carry' ); ?></h1>
				</header>
				<article id="post-<?php the_ID(); ?>" class="content-404">
				
				<div class="column-404 yellow"></div>
				<div class="column-404 aqua"></div>
				<div class="column-404 green"></div>
				<div class="column-404 purple"></div>
				<div class="column-404 red"></div>
				<div class="column-404 blue"></div>
				<div class="column-404 black"></div>
				
				<div class="entry-content">
					<div class="row">
						<div class="half columns">
							<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'carry' ); ?></p>
						</div>
						<div class="half columns">
					<?php get_search_form(); ?>
						</div>
					</div>
					<h2>Posts</h2>
					<div class="row">
						<div class="half columns">
					<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>
						</div>
						<div class="half columns">
							<div class="widget">
								<h2 class="widgettitle"><?php _e( 'Most Used Categories', 'carry' ); ?></h2>
								<ul>
								<?php wp_list_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'show_count' => 1, 'title_li' => '', 'number' => 10 ) ); ?>
								</ul>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="half columns">
							<?php
							/* translators: %1$s: smilie */
							$archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives.', 'carry' ), convert_smilies( ':)' ) ) . '</p>';
							the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
							?>
						</div>
						<div class="half columns">
							<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>
						</div>
					</div>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

			</div><!-- #content -->
		</section><!-- #primary .site-content -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>