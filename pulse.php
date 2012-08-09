<?php 
if( defined('PULSE_CPT_VERSION') ): ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php the_pulse(); ?>
	</article><!-- #post-<?php the_ID(); ?> -->
<?php 
endif;
?>