<?php
/**
 * The template for displaying search forms in carry
 *
 * @package carry
 * @since carry 1.0
 */
?>
	<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
		<label for="s" class="assistive-text"><?php _e( 'Search', 'carry' ); ?></label>
		<input type="text" class="field" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" id="s" placeholder="<?php esc_attr_e( 'Search &hellip;', 'carry' ); ?>" />
		<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'carry' ); ?>" />
	</form>
