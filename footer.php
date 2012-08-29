<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package carry
 * @since carry 1.0
 */
?>

	</div><!-- #main -->

	<div class="clear"></div>
</div><!-- .shell .hfeed .site -->
<footer id="colophon" class="site-footer" role="contentinfo">
		<div class=" shell">
			
			<div class="site-info">
			<?php do_action( 'carry_credits' ); ?>
			Proudly powered by  <a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'carry' ); ?>" rel="generator"><?php printf(  'WordPress', 'carry' ); ?></a>
			<span class="sep"> and </span>
			<?php printf( __( '%1$s by %2$s.', 'carry' ), 'Carry', '<a href="http://blog.ubc.ca/beta/" rel="designer">CTLT Dev</a>' ); ?>
			</div>
			
		</div><!-- .site-info -->
		
	</footer><!-- .site-footer .site-footer -->
<?php wp_footer(); ?>

</body>
</html>