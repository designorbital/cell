<?php
/**
 * Cell Theme Customizer
 *
 * @package Cell
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function cell_customize_register ( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	/**
	 * Theme Options Panel
	 */
	$wp_customize->add_panel( 'cell_theme_options', array(
	    'title'     => esc_html__( 'Theme Options', 'cell' ),
	    'priority'  => 1,
	) );

	/**
	 * General Options Section
	 */
	$wp_customize->add_section( 'cell_general_options', array (
		'title'     => esc_html__( 'General Options', 'cell' ),
		'panel'     => 'cell_theme_options',
		'priority'  => 1,
		'description' => esc_html__( 'Personalize the settings of your theme.', 'cell' ),
	) );

	// Theme Style
	$wp_customize->add_setting ( 'cell_theme_style', array (
		'default'           => cell_default( 'cell_theme_style' ),
		'sanitize_callback' => 'cell_sanitize_theme_style',
	) );

	$wp_customize->add_control ( 'cell_theme_style', array (
		'label'    => esc_html__( 'Theme Style', 'cell' ),
		'section'  => 'cell_general_options',
		'priority' => 1,
		'type'     => 'select',
		'choices'  => array(
			'wide' => esc_html__( 'Wide', 'cell'),
			'box'  => esc_html__( 'Box',  'cell'),
		),
	) );

	// Main Sidebar Position
	$wp_customize->add_setting ( 'cell_sidebar_position', array (
		'default'           => cell_default( 'cell_sidebar_position' ),
		'sanitize_callback' => 'cell_sanitize_sidebar_position',
	) );

	$wp_customize->add_control ( 'cell_sidebar_position', array (
		'label'    => esc_html__( 'Main Sidebar Position (if active)', 'cell' ),
		'section'  => 'cell_general_options',
		'priority' => 2,
		'type'     => 'select',
		'choices'  => array(
			'right' => esc_html__( 'Right', 'cell'),
			'left'  => esc_html__( 'Left',  'cell'),
		),
	) );

	// Author Name Control
	$wp_customize->add_setting ( 'cell_author_name', array (
		'default'           => cell_default( 'cell_author_name' ),
		'sanitize_callback' => 'cell_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'cell_author_name', array (
		'label'    => esc_html__( 'Display Author Name', 'cell' ),
		'section'  => 'cell_general_options',
		'priority' => 3,
		'type'     => 'checkbox',
	) );

	/**
	 * Theme Support Section
	 */
	$wp_customize->add_section( 'cell_support', array(
		'title'       => esc_html__( 'Support Options', 'cell' ),
		'description' => esc_html__( 'Thanks for your interest in Cell Lite! Following links will be helpful to you.', 'cell' ),
		'panel'       => 'cell_theme_options',
		'priority'    => 2,
	) );

	// Theme
	$wp_customize->add_setting ( 'cell_theme_about', array(
		'default' => '',
	) );

	$wp_customize->add_control(
		new Cell_WP_Customize_Button_Control(
			$wp_customize,
			'cell_theme_about',
			array(
				'label'         => esc_html__( 'Cell Lite vs Cell Pro', 'cell' ),
				'section'       => 'cell_support',
				'priority'      => 1,
				'type'          => 'button',
				'button_tag'    => 'a',
				'button_class'  => 'button button-primary',
				'button_href'   => 'https://designorbital.com/cell/',
				'button_target' => '_blank',
			)
		)
	);

	// Documentation
	$wp_customize->add_setting ( 'cell_theme_doc', array(
		'default' => '',
	) );

	$wp_customize->add_control(
		new Cell_WP_Customize_Button_Control(
			$wp_customize,
			'cell_theme_doc',
			array(
				'label'         => esc_html__( 'Cell Documentation', 'cell' ),
				'section'       => 'cell_support',
				'priority'      => 2,
				'type'          => 'button',
				'button_tag'    => 'a',
				'button_class'  => 'button button-primary',
				'button_href'   => 'https://designorbital.com/cell-documentation/',
				'button_target' => '_blank',
			)
		)
	);

	// Support
	$wp_customize->add_setting ( 'cell_theme_support', array(
		'default' => '',
	) );

	$wp_customize->add_control(
		new Cell_WP_Customize_Button_Control(
			$wp_customize,
			'cell_theme_support',
			array(
				'label'         => esc_html__( 'General Support', 'cell' ),
				'section'       => 'cell_support',
				'priority'      => 3,
				'type'          => 'button',
				'button_tag'    => 'a',
				'button_class'  => 'button button-primary',
				'button_href'   => 'https://designorbital.com/contact/',
				'button_target' => '_blank',
			)
		)
	);

	/**
	 * Theme Pro Section
	 */
	$wp_customize->add_section( 'cell_pro', array(
		'title'       => esc_html__( 'About Cell Pro', 'cell' ),
		'description' => esc_html__( 'Cell Pro is premium WordPress theme with lot of additional features and support forum access. Please visit the link below to know more about Cell Pro theme.', 'cell' ),
		'panel'       => 'cell_theme_options',
		'priority'    => 3,
	) );

	// Theme
	$wp_customize->add_setting ( 'cell_pro_about', array(
		'default' => '',
	) );

	$wp_customize->add_control(
		new Cell_WP_Customize_Button_Control(
			$wp_customize,
			'cell_pro_about',
			array(
				'label'         => esc_html__( 'Cell Pro', 'cell' ),
				'section'       => 'cell_pro',
				'priority'      => 1,
				'type'          => 'button',
				'button_tag'    => 'a',
				'button_class'  => 'button button-primary',
				'button_href'   => 'https://designorbital.com/cell-pro/',
				'button_target' => '_blank',
			)
		)
	);

}
add_action( 'customize_register', 'cell_customize_register' );

/**
 * Sanitize the Theme style value.
 *
 * @param string $theme_style - Style type.
 * @return string Filtered theme style type (wide|box).
 */
function cell_sanitize_theme_style( $theme_style ) {
	if ( ! in_array( $theme_style, array( 'wide', 'box' ) ) ) {
		$theme_style = cell_default( 'cell_theme_style' );
	}

	return $theme_style;
}

/**
 * Sanitize the Sidebar position value.
 *
 * @param string $sidebar_position - Sidebar position.
 * @return string Filtered sidebar position (right|left).
 */
function cell_sanitize_sidebar_position( $sidebar_position ) {
	if ( ! in_array( $sidebar_position, array( 'right', 'left' ) ) ) {
		$sidebar_position = cell_default( 'cell_sidebar_position' );
	}

	return $sidebar_position;
}

/**
 * Sanitize the checkbox.
 *
 * @param boolean $input.
 * @return boolean
 */
function cell_sanitize_checkbox( $input ) {
	if ( true === $input ) {
		return true;
	}

	return false;
}

/**
 * Button Control Class
 */
if ( class_exists( 'WP_Customize_Control' ) ) {

	class Cell_WP_Customize_Button_Control extends WP_Customize_Control {
		/**
		 * @access public
		 * @var string
		 */
		public $type = 'button';

		/**
		 * HTML tag to render button object.
		 *
		 * @var  string
		 */
		protected $button_tag = 'button';

		/**
		 * Class to render button object.
		 *
		 * @var  string
		 */
		protected $button_class = 'button button-primary';

		/**
		 * Link for <a> based button.
		 *
		 * @var  string
		 */
		protected $button_href = 'javascript:void(0)';

		/**
		 * Target for <a> based button.
		 *
		 * @var  string
		 */
		protected $button_target = '';

		/**
		 * Click event handler.
		 *
		 * @var  string
		 */
		protected $button_onclick = '';

		/**
		 * ID attribute for HTML tab.
		 *
		 * @var  string
		 */
		protected $button_tag_id = '';

		/**
		 * Render the control's content.
		 */
		public function render_content() {
		?>
			<span class="center">
				<?php
				// Print open tag
				echo '<' . esc_html( $this->button_tag );

				// button class
				if ( ! empty( $this->button_class ) ) {
					echo ' class="' . esc_attr( $this->button_class ) . '"';
				}

				// button or href
				if ( 'button' == $this->button_tag ) {
					echo ' type="button"';
				} else {
					echo ' href="' . esc_url( $this->button_href ) . '"' . ( empty( $this->button_tag ) ? '' : ' target="' . esc_attr( $this->button_target ) . '"' );
				}

				// onClick Event
				if ( ! empty( $this->button_onclick ) ) {
					echo ' onclick="' . esc_js( $this->button_onclick ) . '"';
				}

				// ID
				if ( ! empty( $this->button_tag_id ) ) {
					echo ' id="' . esc_attr( $this->button_tag_id ) . '"';
				}

				echo '>';

				// Print text inside tag
				echo esc_html( $this->label );

				// Print close tag
				echo '</' . esc_html( $this->button_tag ) . '>';
				?>
			</span>
		<?php
		}
	}

}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function cell_customize_preview_js() {
	wp_enqueue_script( 'cell_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20140120', true );
}
add_action( 'customize_preview_init', 'cell_customize_preview_js' );
