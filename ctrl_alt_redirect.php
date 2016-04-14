<?php
/*
Plugin Name: CTRL ALT Redirect
Plugin URI:  https://github.com/mvdcorput/wordpress-ctrl-alt-redirect
Description: Press 'CTRL ALT Key' to redirect to urls on your website.
Version:     1.0
Author:      Martijn van der Corput
Author URI:  http://www.mvdcorput.nl
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html

{Plugin Name} is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
{Plugin Name} is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
*/
?>
<?
    /* Initialize javascript */
    function ctrl_alt_redirect_init() {
        wp_register_script( 'mousetrap', plugins_url('js/vendor/mousetrap.js',__FILE__ ));
        wp_enqueue_script('mousetrap');
        wp_register_script( 'ctrl_alt_redirect_js', plugins_url('js/ctrl_alt_redirect.js.php',__FILE__ ));
        wp_enqueue_script('ctrl_alt_redirect_js');
    }
    
    add_action('init', 'ctrl_alt_redirect_init');
    
    /* Admin settings */
    require 'ctrl_alt_redirect_settings.php';


	/* - Add to Admin plugin page plugin settings */
	function add_settings_link($links, $file) {
		static $this_plugin;
		
		if (!$this_plugin) $this_plugin = plugin_basename(__FILE__);
		 
		if ($file == $this_plugin){
			$settings_link = '<a href="ctrl-alt-redirect-settings.php">'.__("Settings", "ctrl-alt-redirect").'</a>';
			array_unshift($links, $settings_link);
		}
		return $links;
	}
	add_filter('plugin_action_links', array(&$bwbPS, 'add_settings_link'), 10, 2 );

	/* - Add to Admin Settings menu */
    function ctr_alt_redirect_admin_menu() {
        add_options_page(
            'CTRL ALT Redirect',
            'CTRL ALT Redirect',
            'manage_options',
            'wporg-plugin',
            'ctrl_alt_redirect_options_page'
        );
    }
    add_action( 'admin_menu', 'ctr_alt_redirect_admin_menu' );
?>
