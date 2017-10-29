<?php

/*
Plugin Name:  New Fancy Elements
Plugin URI:   http://itextreme.pl/plugins/nfe/
Description:  Shortcode elements for your website
Version:      1.0
Author:       Mariusz Wiśniowski @ ITextreme.pl
Author URI:   http://itextreme.pl
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  new-fancy-elementes
Domain Path:  /languages
*/

  
/* !0. TABLE OF CONTENTS */

/*
  
  1. HOOKS
  
  2. SHORTCODES
    
  3. FILTERS
  	
  4. EXTERNAL SCRIPTS

  	4.1 - nfe_add_scripts_and_styles()
    
  5. ACTIONS
    
  6. HELPERS
    
  7. CUSTOM POST TYPES
  
  8. ADMIN PAGES
  
  9. SETTINGS

*/

if(!class_exists('New_Fancy_Elements')) {

	class New_Fancy_Elements {

		public function New_Fancy_Elements()
		{
			$this->SFS_Slider_Init();			
		}

		public function New_Fancy_Elements_Init()
		{

			/* !1. HOOKS */

			add_action( 'init', array(&$this, 'nfe_register_shortcodes' ));

			add_action('wp_enqueue_scripts', array(&$this, 'nfe_add_scripts_and_styles') );

			//1.9
			add_action('admin_menu', array(&$this, 'sfs_admin_menus') ); 
			
		}


		/* !2. SHORTCODES */

		// 2.1
		public function sfs_register_shortcodes() {
		  add_shortcode( 'nfe_square', array(&$this, 'nfe_square' ));
		}

		// 2.2
		public function nfe_square( $args, $content="") {
		  
		  // setup our output variable - the form html 
		  $output = '

				<div class="itx-slider-wrap">
				<div class="itx-slider">
		  		<div class="sfs-container"><div class="sfs-overlay"></div><ul>';
		  
		  return $output;
		  
		}

		/* !3. FILTERS */

		


		/* !4. EXTERNAL SCRIPTS */

		
		function nfe_add_scripts_and_styles() {


		    wp_register_style( 'nfe_styles',  plugins_url('/css/styles.css',__FILE__));
		    wp_register_script( 'nfe_script', plugins_url('/js/script.js', __FILE__ )  , array( 'jquery' ), '', true );
		    
		   // $arrayOfValues = sfs_get_settings();

		    $arrayOfValues = array( 'timeout' => 6000 );

			wp_localize_script( 'nfe_script', 'sfs_js_data', $arrayOfValues );

		    wp_enqueue_style('nfe_styles');
		    wp_enqueue_script('nfe_script');
		}


		/* !5. ACTIONS */

		/* !6. HELPERS */

		/* !8. ADMIN PAGES */

		function nfe_dashboard_admin_page() {

			$output = '
			<div class="wrap">

				<h2>New Fancy Elements Plugin</h2>
				<p> Here you\'ll find some informations about our plugin. </p>

			</div>';

			echo $output;

		}

		function sfs_admin_menus() {

			$top_menu_item = 'sfs_dashboard_admin_page';

			add_menu_page( '', "New Fancy Elements Plugin", 'manage_options', 'nfe_dashboard_admin_page', array(&$this,'nfe_dashboard_admin_page'), 'dashicons-images-alt2');

			add_submenu_page( $top_menu_item, "Dashboard", "Dashboard", 'manage_options', 'sfs_dashboard_admin_page', array(&$this,'sfs_dashboard_admin_page') );

			add_submenu_page( $top_menu_item, "Slides", "Slides", 'manage_options', 'edit.php?post_type=sfs_slide' );
			
			add_submenu_page( $top_menu_item, "Slider List", "Slider List", 'manage_options', 'edit.php?post_type=sfs_slider' );

			add_submenu_page( $top_menu_item, "Settings", "Settings", 'manage_options', 'sfs_settings_admin_page', array(&$this,'sfs_settings_admin_page') );

		}

	}

}

if(class_exists('New_Fancy_Elements'))
{
	$nfe_plugin = new New_Fancy_Elements();
}





