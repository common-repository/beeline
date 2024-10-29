<?php
/*
Plugin Name: Beeline Widget for WordPress
Plugin URI: http://beeline.xnosis.com
Description: Instantly integrate the Beeline Widget into your blog.
Author: Xnosis
Version: 1.0.5
Author URI: http://www.xnosis.com
*/

if( !class_exists( 'XnosisBeelineForWordpress' ) ) {

	class XnosisBeelineForWordpress {

		// SETTINGS

		/**
		 * Default settings for the plugin.  These settings are used when no settings have yet been saved by the user.
		 *
		 * @var array
		 */
		var $defaults = array( 'Beeline Publisher Id' => '' );

		// MISC

		/**
		 * A string containing the version for this plugin.  Always update this when releaseing a new version.
		 *
		 * @var string
		 */
		var $version = '1.0.5';

		/**
		 * Adds all the appropriate actions and filters.
		 *
		 * @return XnosisBeelineForWordpress
		 */
		function XnosisBeelineForWordpress() {
			register_deactivation_hook( __FILE__, array( &$this, 'deleteSettings' ) );
			add_action( 'admin_menu', array( &$this, 'addAdministrativePage' ) );
			add_action( 'init', array( &$this, 'savePluginSettings' ) );
			add_action( 'wp_footer', array( &$this, 'displayRenderingPage' ) );
		}

		/// CALLBACKS

		/**
		 * Registers a new administrative page which displays the settings panel.
		 *
		 */
		function addAdministrativePage() {
			add_options_page( __( 'Beeline' ), __( 'Beeline' ), 'manage_options', 'xnosis-beeline-widget', array( $this, 'displaySettingsPage' ) );
		}

		/**
		 * Attempts to intercept a POST request that is saving the settings for the WordPress plugin.
		 * 
		 */
		function savePluginSettings() {
			$settings = $this->getSettings( );
			if( is_admin() && isset( $_POST[ 'save-xnosis-beeline-for-wordpress-settings' ] ) && check_admin_referer( 'save-xnosis-beeline-for-wordpress-settings' ) ) 
			{
				$settings[ 'beeline_publisher_id' ] = trim( htmlentities( strip_tags( stripslashes( $_POST[ 'beeline_publisher_id' ] ) ) ) );
				$settings[ 'beeline_included_cats' ] = trim( htmlentities( strip_tags( stripslashes( $_POST[ 'beeline_included_cats' ] ) ) ) );

				$this->saveSettings( $settings );
				wp_redirect( 'options-general.php?page=xnosis-beeline-widget&updated=true' );
				exit( );
			}
		}

		/// DISPLAY
		
		/**
		 * Includes the necessary inline JavaScript that will render all the appropriate divs.
		 *
		 */
		function displayRenderingPage() {
			echo("\n<!-- Beeline Widget -->\n");
			include "views/rendering-script.php";
			echo("\n");
		}

		/**
		 * Outputs the correct HTML for the settings page.
		 *
		 */
		function displaySettingsPage() {
			include ( 'views/settings.php' );
		}

		/// SETTINGS

		/**
		 * Removes the settings for the Beeline plugin from the 
		 * database. 
		 *
		 */
		function deleteSettings() {
			delete_option( 'Beeline Widget Settings' );
		}

		/**
		 * Returns the settings for the Beeline plugin.
		 *
		 * @return array An associative array of settings for the 
		 *  	   Beeline plugin.
		 */
		function getSettings() {
			if( $this->settings === null ) {
				$this->settings = get_option('Beeline Widget Settings', $this->defaults);
			}

			return $this->settings;
		}

		/**
		 * Saves the settings for the Beeline plugin.
		 *
		 * @param array $settings An array of settings for the Beeline 
		 *  			plugin.
		 */
		function saveSettings( $settings ) {
			$this->settings = $settings;
			update_option( 'Beeline Widget Settings', $this->settings );
		}
	}
}

if( class_exists( 'XnosisBeelineForWordpress' ) ) {
	$xbfw = new XnosisBeelineForWordpress( );
}