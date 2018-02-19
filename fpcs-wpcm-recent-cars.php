<?php
/*
 * Plugin Name:       FPCS WPCM Recent Cars
 * Plugin URI:        https://github.com/FPCSJames/fpcs-wpcm-recent-cars
 * Description:       Displays a row of clickable social media icons. Best in footer sections.
 * Version:           1.0.0
 * Author:            James M. Joyce, Flashpoint Computer Services, LLC
 * Author URI:        http://www.flashpointcs.net
 * Text Domain:       fpcs-basic-social-widget
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * GitHub Plugin URI: https://github.com/FPCSJames/fpcs-wpcm-recent-cars
 */

if ( ! defined ( 'ABSPATH' ) ) {
	exit;
}

class FPCS_WPCM_Recent_Cars extends WP_Widget {

    /**
     * Unique identifier for this widget.
     *
     * @since    1.0.0
     * @var      string
     */
    protected $widget_slug = 'fpcs-wpcm-recent-cars';

	/**
     * Plugin/widget version.
     *
     * @since    1.0.0
     * @var      string
     */
    protected $widget_version = '1.0.0';



	/**
	 * Specifies the classname and description, instantiates the widget,
	 * and includes necessary stylesheets.
	 */
	public function __construct() {

		parent::__construct(
			$this->widget_slug,
			__( 'FPCS WPCM Recent Cars', 'fpcs-wpcm-recent-cars' ),
			array(
				'classname'  => $this->widget_slug,
				'description' => __( 'Displays the most recent cars added to WP Car Manager.', $this->widget_slug )
			)
		);
		// Register site styles and scripts
		add_action( 'wp_enqueue_scripts', array( $this, 'register_widget_styles' ) );

		// Refresh the widget's cached output with each new post
		add_action( 'save_post',    array( $this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'flush_widget_cache' ) );

	}

	/*--------------------------------------------------*/
	/* Widget API Functions
	/*--------------------------------------------------*/

	/**
	 * Outputs the content of the widget.
	 *
	 * @param array args  The array of form elements
	 * @param array instance The current instance of the widget
	 */
	public function widget( $args, $instance ) {

		// Check if there is a cached output
		$cache = wp_cache_get( $this->widget_slug, 'widget' );

		if ( !is_array( $cache ) )
			$cache = array();

		if ( ! isset ( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset ( $cache[ $args['widget_id'] ] ) )
			return print $cache[ $args['widget_id'] ];

		extract( $args, EXTR_SKIP );

		$instance = wp_parse_args(
			(array) $instance,
			[
				'number_cars' => '5',
				'enqueue_style' => true,
				'title' => ''
			]
		);

		extract( $instance );
		$color_background_hover = esc_attr( $number_cars );

		$widget_string = $before_widget;
		if( $title ) {
			$widget_string .= $before_title . $title . $after_title;
		}

		ob_start();
      include( plugin_dir_path( __FILE__ ) . 'view-widget.php' );
		$widget_string .= ob_get_clean();
		$widget_string .= $after_widget;

		$cache[ $args['widget_id'] ] = $widget_string;

		wp_cache_set( $this->widget_slug, $cache, 'widget' );

		print $widget_string;

	}

	public function flush_widget_cache() {
    	wp_cache_delete( $this->widget_slug, 'widget' );
	}

	/**
	 * Processes the widget's options to be saved.
	 *
	 * @param array new_instance The new instance of values to be generated via the update.
	 * @param array old_instance The previous instance of values before the update.
	 */
	public function update( $new_instance, $old_instance ) {

      $number = intval( trim( $new_instance['number_cars'] ) );
		$instance['number_cars'] = !empty( $number ) ? $number : 5;
		$instance['enqueue_style'] = !empty( $new_instance['enqueue_style'] ) ? true : false;
		$instance['title'] = strip_tags( trim( $new_instance['title'] ) );

		return $instance;

	}

	/**
	 * Generates the administration form for the widget.
	 *
	 * @param array instance The array of keys and values for the widget.
	 */
	public function form( $instance ) {

		$instance = wp_parse_args(
			(array) $instance,
			[
				'number_cars' => '5',
				'enqueue_style' => true,
				'title' => ''
			]
		);

		extract($instance);

		// Display the admin form
      include( plugin_dir_path(__FILE__) . 'view-admin.php' );

	}

	/*--------------------------------------------------*/
	/* Public Functions
	/*--------------------------------------------------*/

	/**
	 * Registers and enqueues widget-specific styles.
	 */
	public function register_widget_styles() {

		$instance = $this->get_settings()[ str_replace( $this->widget_slug. '-', '', $this->id ) ];
		if ( $instance['enqueue_style'] ) {
			wp_enqueue_style( $this->widget_slug , plugins_url( 'css/widget.min.css', __FILE__ ), $this->widget_version );
      }

	}

}
add_action( 'widgets_init', function() {
   if( function_exists( 'wp_car_manager' ) ) {
      register_widget("FPCS_WPCM_Recent_Cars");
   }
} );
