<?php
/**
 * carry Theme Options
 *
 * @package carry
 * @since carry 1.0
 */

/**
 * Register the form setting for our carry_options array.
 *
 * This function is attached to the admin_init action hook.
 *
 * This call to register_setting() registers a validation callback, carry_theme_options_validate(),
 * which is used when the option is saved, to ensure that our option values are properly
 * formatted, and safe.
 *
 * @since carry 1.0
 */
function carry_theme_options_init() {
	register_setting(
		'carry_options',       // Options group, see settings_fields() call in carry_theme_options_render_page()
		'carry_theme_options', // Database option, see carry_get_theme_options()
		'carry_theme_options_validate' // The sanitization callback, see carry_theme_options_validate()
	);

	// Register our settings field group
	add_settings_section(
		'general', // Unique identifier for the settings section
		'', // Section title (we don't want one)
		'__return_false', // Section callback (we don't want anything)
		'theme_options' // Menu slug, used to uniquely identify the page; see carry_theme_options_add_page()
	);

	// Register our individual settings fields
	add_settings_field(
		'sample_checkbox', // Unique identifier for the field for this section
		__( 'Sample Checkbox', 'carry' ), // Setting field label
		'carry_settings_field_sample_checkbox', // Function that renders the settings field
		'theme_options', // Menu slug, used to uniquely identify the page; see carry_theme_options_add_page()
		'general' // Settings section. Same as the first argument in the add_settings_section() above
	);

	add_settings_field( 'sample_text_input', __( 'Sample Text Input', 'carry' ), 'carry_settings_field_sample_text_input', 'theme_options', 'general' );
	add_settings_field( 'sample_select_options', __( 'Sample Select Options', 'carry' ), 'carry_settings_field_sample_select_options', 'theme_options', 'general' );
	add_settings_field( 'sample_radio_buttons', __( 'Sample Radio Buttons', 'carry' ), 'carry_settings_field_sample_radio_buttons', 'theme_options', 'general' );
	add_settings_field( 'sample_textarea', __( 'Sample Textarea', 'carry' ), 'carry_settings_field_sample_textarea', 'theme_options', 'general' );
}
add_action( 'admin_init', 'carry_theme_options_init' );

/**
 * Change the capability required to save the 'carry_options' options group.
 *
 * @see carry_theme_options_init() First parameter to register_setting() is the name of the options group.
 * @see carry_theme_options_add_page() The edit_theme_options capability is used for viewing the page.
 *
 * @param string $capability The capability used for the page, which is manage_options by default.
 * @return string The capability to actually use.
 */
function carry_option_page_capability( $capability ) {
	return 'edit_theme_options';
}
add_filter( 'option_page_capability_carry_options', 'carry_option_page_capability' );

/**
 * Add our theme options page to the admin menu.
 *
 * This function is attached to the admin_menu action hook.
 *
 * @since carry 1.0
 */
function carry_theme_options_add_page() {
	$theme_page = add_theme_page(
		__( 'Theme Options', 'carry' ),   // Name of page
		__( 'Theme Options', 'carry' ),   // Label in menu
		'edit_theme_options',                    // Capability required
		'theme_options',                         // Menu slug, used to uniquely identify the page
		'carry_theme_options_render_page' // Function that renders the options page
	);
}
add_action( 'admin_menu', 'carry_theme_options_add_page' );

/**
 * Returns an array of sample select options registered for carry.
 *
 * @since carry 1.0
 */
function carry_sample_select_options() {
	$sample_select_options = array(
		'0' => array(
			'value' =>	'0',
			'label' => __( 'Zero', 'carry' )
		),
		'1' => array(
			'value' =>	'1',
			'label' => __( 'One', 'carry' )
		),
		'2' => array(
			'value' => '2',
			'label' => __( 'Two', 'carry' )
		),
		'3' => array(
			'value' => '3',
			'label' => __( 'Three', 'carry' )
		),
		'4' => array(
			'value' => '4',
			'label' => __( 'Four', 'carry' )
		),
		'5' => array(
			'value' => '3',
			'label' => __( 'Five', 'carry' )
		)
	);

	return apply_filters( 'carry_sample_select_options', $sample_select_options );
}

/**
 * Returns an array of sample radio options registered for carry.
 *
 * @since carry 1.0
 */
function carry_sample_radio_buttons() {
	$sample_radio_buttons = array(
		'yes' => array(
			'value' => 'yes',
			'label' => __( 'Yes', 'carry' )
		),
		'no' => array(
			'value' => 'no',
			'label' => __( 'No', 'carry' )
		),
		'maybe' => array(
			'value' => 'maybe',
			'label' => __( 'Maybe', 'carry' )
		)
	);

	return apply_filters( 'carry_sample_radio_buttons', $sample_radio_buttons );
}

/**
 * Returns the options array for carry.
 *
 * @since carry 1.0
 */
function carry_get_theme_options() {
	$saved = (array) get_option( 'carry_theme_options' );
	$defaults = array(
		'sample_checkbox'       => 'off',
		'sample_text_input'     => '',
		'sample_select_options' => '',
		'sample_radio_buttons'  => '',
		'sample_textarea'       => '',
	);

	$defaults = apply_filters( 'carry_default_theme_options', $defaults );

	$options = wp_parse_args( $saved, $defaults );
	$options = array_intersect_key( $options, $defaults );

	return $options;
}

/**
 * Renders the sample checkbox setting field.
 */
function carry_settings_field_sample_checkbox() {
	$options = carry_get_theme_options();
	?>
	<label for"sample-checkbox">
		<input type="checkbox" name="carry_theme_options[sample_checkbox]" id="sample-checkbox" <?php checked( 'on', $options['sample_checkbox'] ); ?> />
		<?php _e( 'A sample checkbox.', 'carry' );  ?>
	</label>
	<?php
}

/**
 * Renders the sample text input setting field.
 */
function carry_settings_field_sample_text_input() {
	$options = carry_get_theme_options();
	?>
	<input type="text" name="carry_theme_options[sample_text_input]" id="sample-text-input" value="<?php echo esc_attr( $options['sample_text_input'] ); ?>" />
	<label class="description" for="sample-text-input"><?php _e( 'Sample text input', 'carry' ); ?></label>
	<?php
}

/**
 * Renders the sample select options setting field.
 */
function carry_settings_field_sample_select_options() {
	$options = carry_get_theme_options();
	?>
	<select name="carry_theme_options[sample_select_options]" id="sample-select-options">
		<?php
			$selected = $options['sample_select_options'];
			$p = '';
			$r = '';

			foreach ( carry_sample_select_options() as $option ) {
				$label = $option['label'];
				if ( $selected == $option['value'] ) // Make default first in list
					$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
				else
					$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
			}
			echo $p . $r;
		?>
	</select>
	<label class="description" for="sample_theme_options[selectinput]"><?php _e( 'Sample select input', 'carry' ); ?></label>
	<?php
}

/**
 * Renders the radio options setting field.
 *
 * @since carry 1.0
 */
function carry_settings_field_sample_radio_buttons() {
	$options = carry_get_theme_options();

	foreach ( carry_sample_radio_buttons() as $button ) {
	?>
	<div class="layout">
		<label class="description">
			<input type="radio" name="carry_theme_options[sample_radio_buttons]" value="<?php echo esc_attr( $button['value'] ); ?>" <?php checked( $options['sample_radio_buttons'], $button['value'] ); ?> />
			<?php echo $button['label']; ?>
		</label>
	</div>
	<?php
	}
}

/**
 * Renders the sample textarea setting field.
 */
function carry_settings_field_sample_textarea() {
	$options = carry_get_theme_options();
	?>
	<textarea class="large-text" type="text" name="carry_theme_options[sample_textarea]" id="sample-textarea" cols="50" rows="10" /><?php echo esc_textarea( $options['sample_textarea'] ); ?></textarea>
	<label class="description" for="sample-textarea"><?php _e( 'Sample textarea', 'carry' ); ?></label>
	<?php
}

/**
 * Renders the Theme Options administration screen.
 *
 * @since carry 1.0
 */
function carry_theme_options_render_page() {
	?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<h2><?php printf( __( '%s Theme Options', 'carry' ), get_current_theme() ); ?></h2>
		<?php settings_errors(); ?>

		<form method="post" action="options.php">
			<?php
				settings_fields( 'carry_options' );
				do_settings_sections( 'theme_options' );
				submit_button();
			?>
		</form>
	</div>
	<?php
}

/**
 * Sanitize and validate form input. Accepts an array, return a sanitized array.
 *
 * @see carry_theme_options_init()
 * @todo set up Reset Options action
 *
 * @param array $input Unknown values.
 * @return array Sanitized theme options ready to be stored in the database.
 *
 * @since carry 1.0
 */
function carry_theme_options_validate( $input ) {
	$output = array();

	// Checkboxes will only be present if checked.
	if ( isset( $input['sample_checkbox'] ) )
		$output['sample_checkbox'] = 'on';

	// The sample text input must be safe text with no HTML tags
	if ( isset( $input['sample_text_input'] ) && ! empty( $input['sample_text_input'] ) )
		$output['sample_text_input'] = wp_filter_nohtml_kses( $input['sample_text_input'] );

	// The sample select option must actually be in the array of select options
	if ( isset( $input['sample_select_options'] ) && array_key_exists( $input['sample_select_options'], carry_sample_select_options() ) )
		$output['sample_select_options'] = $input['sample_select_options'];

	// The sample radio button value must be in our array of radio button values
	if ( isset( $input['sample_radio_buttons'] ) && array_key_exists( $input['sample_radio_buttons'], carry_sample_radio_buttons() ) )
		$output['sample_radio_buttons'] = $input['sample_radio_buttons'];

	// The sample textarea must be safe text with the allowed tags for posts
	if ( isset( $input['sample_textarea'] ) && ! empty( $input['sample_textarea'] ) )
		$output['sample_textarea'] = wp_filter_post_kses( $input['sample_textarea'] );

	return apply_filters( 'carry_theme_options_validate', $output, $input );
}
