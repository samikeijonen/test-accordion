<?php
/**
 * Plugin Name: Test Accordion
 * Plugin URI:  https://foxland.fi/
 * Description: Test Foundation Accordion
 * Version:     1.0.0
 * Author:      Sami Keijonen
 * Author URI:  http://foxnet.fi/
 * Text Domain: test-accordion
 * Domain Path: /languages
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License version 2, as published by the Free Software Foundation.  You may NOT assume
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @package   TestAccordion
 * @author    Sami Keijonen <sami.keijonen@foxnet.fi>
 * @copyright Copyright (c) 2016, Sami Keijonen
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/**
 * Singleton class that sets up and initializes the plugin.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
final class Test_Accordion {

	/**
	 * Directory path to the plugin folder.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $dir_path = '';

	/**
	 * Directory URI to the plugin folder.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $dir_uri = '';

	/**
	 * JavaScript directory URI.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $js_uri = '';

	/**
	 * CSS directory URI.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $css_uri = '';

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup();
			$instance->includes();
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Initial plugin setup.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup() {

		$this->dir_path = trailingslashit( plugin_dir_path( __FILE__ ) );
		$this->dir_uri  = trailingslashit( plugin_dir_url(  __FILE__ ) );

		$this->js_uri  = trailingslashit( $this->dir_uri . 'js'  );
		$this->css_uri = trailingslashit( $this->dir_uri . 'css' );
		
	}
	

	/**
	 * Loads include and admin files for the plugin.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function includes() {

		// Load functions files.
		require_once( $this->dir_path . 'inc/post-types.php' );
		require_once( $this->dir_path . 'inc/shortcodes.php' );

	}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {
		
		// Enqueue scripts.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		// Internationalize the text strings used.
		add_action( 'plugins_loaded', array( $this, 'i18n' ), 2 );
		
	}
	
	/**
	 * Enqueues scripts and styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_scripts() {
		
		// Add Foundation accordion styles.
		wp_enqueue_style( 'test-accordion-styles', $this->css_uri . 'styles.css', array(), '1.0.0' );

		// Add Foundation accordion scripts.
		wp_enqueue_script( 'test-accordion-foundation', $this->js_uri . 'foundation.js', array( 'jquery' ), '1.0.0', true );
		wp_enqueue_script( 'test-accordion-app', $this->js_uri . 'app.js', array( 'test-accordion-foundation' ), '1.0.1', true );
	
	}

	/**
	 * Loads the translation files.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function i18n() {

		load_plugin_textdomain( 'test-accordion', false, trailingslashit( dirname( plugin_basename( __FILE__ ) ) ) . 'languages' );
	}

}

/**
 * Gets the instance of the `Test_Accordion` class.  This function is useful for quickly grabbing data
 * used throughout the plugin.
 *
 * @since  1.0.0
 * @access public
 * @return object
 */
function test_accordion() {
	return Test_Accordion::get_instance();
}

// Let's do this thang!
test_accordion();